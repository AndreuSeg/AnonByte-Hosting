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
        if (count($rows) != 4) {
            // Si el número de elementos es diferente de 4, devuelve un mensaje de error.
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

    public function viewDash()
    {
        $username = auth()->user()->username;
        $stats = $this->stats();

        return view('dashboard.dashboard', [
            'username' => $username,
            'stats' => $stats,
        ]);
    }

    public function viewInfo()
    {
        $username = auth()->user()->username;
        $id = Auth::id();
        $stack = Stack::where('user_id', $id)->first();
        $appname = $stack->stack_name;
        return view('dashboard.info', [
            'username' => $username,
            'appname' => $appname,
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
        $dbname = 'wordpress';
        $dbuser = $request->input('db_user');
        $dbpass = $request->input('db_pass');
        $dbrootpass = $request->input('db_root_pass');

        // Recuperamos el ID del usuario
        $id = (Auth::id());
        // Lo pasamos a str
        $ids = strval($id);

        $idConts = '_' . $ids . '_';
        // Creamos la ruta para almacenar los archivos
        $ruta = '/containers/user_' . $ids . '/';

        // Si no existe la ruta la creamos
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
        }

        // Creamos la segunda ruta
        $ruta2 = $ruta . 'wordpress/';
        Storage::makeDirectory($ruta2);

        // Y nos movemos a la ruta deseada
        chdir('../storage/app/' . $ruta);

        $nombreArchivo = 'docker-compose-' . $ids . '.yml';

        $dockerCompose = "version: '3'
services:

    # PHP service
    wordpress$appname:
      container_name: Wordpress$idConts
      image: wordpress:latest
      deploy:
        resources:
          limits:
            cpus: '0.01'
            memory: '200M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.http.routers.wordpress$appname.rule=Host(`wordpress$appname.localhost`)'
        - 'traefik.http.routers.wordpress$appname.entrypoints=web'
        - 'traefik.http.services.wordpress$appname.loadbalancer.server.port=80'
      environment:
        - WORDPRESS_DB_HOST=db$appname:3306
        - WORDPRESS_DB_USER=$dbuser
        - WORDPRESS_DB_PASSWORD=$dbpass
        - WORDPRESS_DB_NAME=$dbname
      depends_on:
        - db$appname
      volumes:
        - './wordpress:/var/www/html'
      restart: always
      networks:
        AnonByte:

    # MySQL database service
    db$appname:
      container_name: Mysql$idConts
      image: mysql:latest
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
      container_name: PhpMyAdmin$idConts
      image: phpmyadmin/phpmyadmin
      deploy:
        resources:
          limits:
            cpus: '0.01'
            memory: '200M'
      labels:
        - 'traefik.enable=true'
        - 'traefik.http.routers.phpmyadmin$appname.rule=Host(`pma$appname.localhost`)'
        - 'traefik.http.routers.phpmyadmin$appname.entrypoints=web'
        - 'traefik.http.services.phpmyadmin$appname.loadbalancer.server.port=80'
      environment:
        PMA_ARBITRARY: 1
      depends_on:
        - db$appname
      restart: always
      networks:
        AnonByte:

networks:
  AnonByte:
    external: true
";

        /*
          Diferenciar domini de nom de app.
         */

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
