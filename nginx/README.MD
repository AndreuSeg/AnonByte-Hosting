# Configuraciones NGINX

Configuracion:

Con esta linea limitamos el tamaño de las peticiones.

```bash
# Limite de tamaño de petición
client_max_body_size 10M;
```

Limitamos el numero de conexiones por IP.

```bash
# Límite de conexiones por IP
limit_conn_zone $binary_remote_addr zone=conn_limit_per_ip:10m;
limit_conn conn_limit_per_ip 20;
```

Limitamos las peticiones por segundo por IP.

```bash
# Límite de peticiones por segundo por IP
limit_req_zone $binary_remote_addr zone=req_limit_per_ip:10m rate=10r/s;
limit_req zone=req_limit_per_ip burst=5;
```

Reverse Proxy.

```bash
server {
    # Puerto en el que escuchará el servidor
    listen 80;

    # Dominio o IP del servidor
    # server_name example.com;

    # Configuración de reescritura de URL
    location / {
        # Dirección IP y puerto de la aplicación que se está sirviendo detrás del proxy
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }
}
```

Otro possible Reverse Proxy prodria ser:

```bash
server {
    listen 127.0.0.1:80;

    location / {
        proxy_pass http://127.0.0.1:8000;
        # No estandar
        proxy_set_header X-Forwarded-For $proxy_add_x_forward_for;
        proxy_set_header X-Forwarded-Port $remote_port;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Forwarded-Proto $scheme;
        
        # Estandar
        proxy_set_header Forwarded "by=$server_addr;for=$proxy_add_x_forwarded_for"
    }
}
```

Archivo: AnonByte.com. Es un host virutal con Reverse Proxy.

```bash
server {
    listen 80;

    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```
