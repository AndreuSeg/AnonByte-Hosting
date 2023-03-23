<?php

namespace App\Http\Controllers;

use App\Http\Requests\StackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Stack;
use Illuminate\Support\Carbon;
use ZipArchive;

class DashboardController extends Controller
{
    public function stats()
    {
        // Recuperamos el ID del usuario
        $id = (Auth::id());
        // Lo pasamos a str
        $ids = strval($id);
        $ids = "_" . $ids . "_";
        $output = shell_exec("docker stats --no-stream --format 'table {{.Name}}\t{{.CPUPerc}}\t{{.MemPerc}}\t{{.MemUsage}}\t{{.NetIO}}' $(docker ps --format '{{.ID}} {{.Names}}' | grep '$ids' | awk '{print $1}')");
        $rows = explode("\n", trim($output));

        // Verifica si el número de elementos en el array es diferente de 5.
        if (count($rows) != 5) {
            // Si el número de elementos es diferente de 5, devuelve un mensaje de error.
            $result = "No tienes contenedores encendidos";
        } else {
            ob_start(); // Inicia el buffer de salida
            echo "<table>";
            $isHeader = true;
            foreach ($rows as $index => $row) {
                $row = explode(" ", $row);
                $row = array_filter($row, function ($valor) {
                    return !empty($valor);
                });

                // Ejecutamos la funcion privada para ordenar los indices del array.
                $reorderedArray = $this->_reorderArrayIndexes($row);
                $newArray = [];

                // Agregar los elementos según el orden especificado
                if ($index == 0) {
                    $newArray = $this->_element0($reorderedArray);
                    echo "<thead><tr>";
                    foreach ($newArray as $item) {
                        echo "<td>$item</td>";
                    }
                    echo "</tr></thead><tbody>";
                } else {
                    $newArray = $this->_otherElements($reorderedArray);
                    echo "<tr>";
                    foreach ($newArray as $item) {
                        echo "<td>$item</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</tbody></table>";
            $result = ob_get_clean(); // Obtiene y limpia el contenido del buffer de salida
        }
        return $result;
    }

    public function view()
    {
        $username = auth()->user()->username;
        $stats = $this->stats();
        return view('dashboard.home', [
            'username' => $username,
            'stats' => $stats,
        ]);
    }

    public function viewStackForm()
    {
        return view('dashboard.createstack');
    }

    public function createStack(StackRequest $request)
    {
        $request->validated();

        $appname = $request->input('app_name');
        $dbname = $request->input('db_name');
        $dbuser = $request->input('db_user');
        $dbpass = $request->input('db_pass');
        $dbrootpass = $request->input('db_root_pass');

        // Recupera el archivo enviado
        $file = $request->file('file');

        // Recuperamos el ID del usuario
        $id = (Auth::id());
        // Lo pasamos a str
        $ids = strval($id);
        // Creamos la ruta para almacenar los archivos
        $ruta = '/containers/user_' . $ids . '/';

        // Si no existe la ruta la creamos
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
        }

        // Guarda el archivo en la ruta creada
        $file->storeAs($ruta, 'user_' . $ids . '.zip');

        // Creamos la segunda ruta
        $ruta2 = $ruta . 'src/';
        Storage::makeDirectory($ruta2);

        // Y nos movemos a la ruta deseada
        chdir('../storage/app/' . $ruta);
        // Unzipeamos el zip del usuario
        system('unzip user_' . $ids . '.zip -d src/');

        $defaultNginxConf = 'server {
    listen 80;
    index index.php index.html;
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    ## define root path
    root /var/www/src;
    ## define location php
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app' . $appname . ':9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }
}';
        Storage::put($ruta . "docker/nginx/conf.d/default.conf", $defaultNginxConf);

        $nombreArchivo = 'docker-compose-' . $ids . '.yml';

        $dockerCompose = "version: '3'
services:

    # PHP service
    app$appname:
      container_name: PHP-$appname
      build: ../../docker/php
      image: php
      working_dir: /var/www/
      deploy:
        resources:
          limits:
            cpus: '0.05'
            memory: '200M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.http.routers.app$appname.rule=Host(`php$appname.localhost`)'
        - 'traefik.http.routers.app$appname.entrypoints=web'
        - 'traefik.http.services.app$appname.loadbalancer.server.port=80'
      volumes:
        - './src:/var/www/src'
      restart: always
      networks:
        AnonByte:

    # MySQL database service
    db$appname:
      container_name: Mysql-$appname
      image: mysql:8.0
      deploy:
        resources:
          limits:
            cpus: '0.10'
            memory: '800M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.tcp.routers.db$appname.rule=HostSNI(`*`)'
        - 'traefik.tcp.routers.db$appname.entrypoints=database'
        - 'traefik.tcp.services.db$appname.loadbalancer.server.port=3306'
      environment:
        MYSQL_DATABASE: $dbname
        MYSQL_USER: $dbuser
        MYSQL_PASSWORD: $dbpass
        MYSQL_ROOT_PASSWORD: $dbrootpass
      volumes:
        - './docker/mysql/:/var/lib/mysql'
      restart: always
      networks:
        AnonByte:

    phpmyadmin$appname:
      container_name: PhpMyAdmin-$appname
      image: phpmyadmin/phpmyadmin
      deploy:
        resources:
          limits:
            cpus: '0.05'
            memory: '200M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.http.routers.phpmyadmin$appname.rule=Host(`pma$appname.localhost`)'
        - 'traefik.http.routers.phpmyadmin$appname.entrypoints=web'
        - 'traefik.http.services.phpmyadmin$appname.loadbalancer.server.port=80'
      environment:
        PMA_ARBITRARY: 1
      restart: always
      networks:
        AnonByte:

    # Nginx service
    nginx$appname:
      container_name: Nginx-$appname
      image: nginx:latest
      deploy:
        resources:
          limits:
            cpus: '0.05'
            memory: '200M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.http.routers.nginx$appname.rule=Host(`$appname.localhost`)'
        - 'traefik.http.routers.nginx$appname.entrypoints=web'
        - 'traefik.http.services.nginx$appname.loadbalancer.server.port=80'
      volumes:
        - './src:/var/www/src'
        - './docker/nginx/conf.d:/etc/nginx/conf.d'
        - './log/nginx:/var/log/nginx'
      restart: always
      networks:
        AnonByte:

networks:
  AnonByte:
    external: true
        ";
        // Almacenamos el docker-compose
        Storage::put("$ruta$nombreArchivo", $dockerCompose);
        // Ejecutamos el comando para arrancar los contenedores
        shell_exec('docker-compose -f ' . $nombreArchivo . ' up -d');

        $user = User::find($id);
        $user->stack_created = true;
        $user->save();

        $dbpass = $this->_safePassword($dbpass);
        $dbrootpass = $this->_safePassword($dbrootpass);

        Stack::create([
            'user_id' => $id,
            'stack_name' => $appname,
            'mysql_database' => $dbname,
            'mysql_user' => $dbuser,
            'mysql_password' => $dbpass,
            'mysql_root_password' => $dbrootpass,
            'created_at' => Carbon::now(),
            'updated_at' => null,
            'deleted_At' => null,
        ]);

        return redirect()->route('dashboard-home');
    }

    // FUNCIONES PRIVADAS

    private function _reorderArrayIndexes($array)
    {
        $keys = array_keys($array);
        sort($keys);
        $result = array();
        foreach ($keys as $index => $key) {
            $result[$index] = $array[$key];
        }
        return $result;
    }

    private function _element0($row)
    {
        // Agregar los elementos según el orden especificado
        $newArray[0] = $row[0];
        $newArray[1] = $row[1] . " " . $row[2];
        $newArray[2] = $row[3] . " " . $row[4];
        $newArray[3] = $row[5] . " " . $row[6] . " " . $row[7] . " " . $row[8];
        $newArray[4] = $row[9] . " " . $row[10];

        return $newArray;
    }

    private function _otherElements($row)
    {
        // hacer algo para los otros elementos
        $newArray[0] = $row[0];
        $newArray[1] = $row[1];
        $newArray[2] = $row[2];
        $newArray[3] = $row[3] . " " . $row[4] . " " . $row[5];
        $newArray[4] = $row[6] . " " . $row[7] . " " . $row[8];

        return $newArray;
    }

    private function _safePassword($password)
    {
        $password = Hash::make($password);
        return $password;
    }
}
