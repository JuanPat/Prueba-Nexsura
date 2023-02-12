1. Descargar carpeta con los archivos y pegarlos en htdocs.

2. Crear la base de datos en el phpMyadmin en este caso nombre de la base de datos "prueba_tecnica".

3. Ingresar a la carpeta descargada de Github mediante CMD y ejecutar el comando (php artisan migrate:refresh --seed) este comando cargara las tablas e informacion guardada.

4. Ejecutar comando (php artisan serve) e ingresar a la URL http://127.0.0.1:8000/empleados.
