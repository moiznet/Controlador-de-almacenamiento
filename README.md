
Instrucciones detalladas de instalación y configuración.

Requerimientos:
Tener instalado Composer.
tener innstalado php y mysql (Xamp)

Instalación

Iniciar xamp mysql y apache.

1. clonar el proyecto laravel desde el repositorio "https://github.com/moiznet/Controlador-de-almacenamiento" por git o descargando el .zip.
2. crear un Base de datos con nombre y "controlador_de_almacenamiento" en msyql phpmyadmin
3. En la raiz del proyecto copiar archivo .env.example y renombrar como .env 
4. Abrir el CMD y ejecutar la linea de comando en la raiz del proyecto "composer install"
5. Ejecutar comando "php artisan key:generate"
6. Ejecutar comando "php artisan migrate"
7. Ejecutar el comando "php artisan storage:link"
8. ejecutar "cd public" y ejecutar el servidor con  "php -S localhost:8000" (abrira en http://localhost:8000/)
9. Hace click en "register" Recuerde que el Primer Registro Sera El super Administrador recordar la contraseña.
 




(clonación, composer
install, configuración de .env, migración de base de datos, etc.).
○ Credenciales de ejemplo para un Administrador y un Usuario.

