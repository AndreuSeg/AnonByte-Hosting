<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function view()
    {
        $username = auth()->user()->username;
        return view('dashboard.home', [
            'username' => $username
        ]);
    }

    public function viewSugests()
    {
        return view('dashboard.sugests');
    }

    public function viewStackForm()
    {
        return view('dashboard.createstack');
    }

    public function createStack()
    {
        $ruta = '/containers/';
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
        }

        $nombreArchivo = "docker-compose.yml";

        $dockerCompose = "version: '3.8'
services:

    # PHP service
    app:
      build: ../docker/php
      image: php-prueba
      container_name: prueba_php
      working_dir: /var/www/
      networks:
        AnonByte:

    # MySQL database service
    db:
      image: mysql:8.0
      container_name: prueba_mysql
      ports:
          - '3307:3306'
      environment:
        MYSQL_DATABASE: prueba
        MYSQL_USER: prueba
        MYSQL_PASSWORD: prueba
        MYSQL_ROOT_PASSWORD: prueba
      networks:
        AnonByte:

    phpmyadmin:
      image: phpmyadmin/phpmyadmin
      container_name: prueba_phpmyadmin
      labels:
      - 'traefik.enable=true'
      - 'traefik.http.routers.phpmyadmin.rule=Host(`pma.localhost`)'
      - 'traefik.http.routers.phpmyadmin.entrypoints=web'
      environment:
        PMA_ARBITRARY: 1
      networks:
        AnonByte:

    # Nginx service
    nginx:
      image: nginx:latest
      container_name: prueba_nginx
      labels:
      - 'traefik.enable=true'
      - 'traefik.http.routers.nginx.rule=Host(`nginx.localhost`)'
      - 'traefik.http.routers.nginx.entrypoints=web'
      networks:
        AnonByte:

networks:
  AnonByte:
      external: true
        ";
        Storage::put("$ruta$nombreArchivo", $dockerCompose);
        getcwd();
        chdir('../storage/app/containers/');
        shell_exec('docker-compose up -d');
    }
}


/*
    volumes:
      - ./project:/var/www

    volumes:
      - './mysql/:/var/lib/mysql'

    labels:
      - 'traefik.enable=true'
      - 'traefik.http.routers.phpmyadmin.rule=Host(`phpmyadmin.localhost`)'
      - 'traefik.http.routers.phpmyadmin.entrypoints=web'
      - 'traefik.http.services.phpmyadmin.loadbalancer.server.port=8080'

    volumes:
      - ./docker/conf.d/:/etc/nginx/conf.d/
    labels:
      - 'traefik.enable=true'
      - 'traefik.http.routers.nginx.rule=Host(`nginx.localhost`)'
      - 'traefik.http.routers.nginx.entrypoints=web'
      - 'traefik.http.services.nginx.loadbalancer.server.port=80'
 */
