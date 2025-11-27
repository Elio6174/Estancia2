# Manual de Instalación

## 1. Requisitos
- Windows 10 o superior
- XAMPP instalado
- Navegador web

Descargar XAMPP:
https://www.apachefriends.org/es/download.html

---

## 2. Instalar XAMPP
1. Ejecutar el instalador.
2. Seleccionar los módulos:
   - Apache
   - MySQL
   - PHP
   - phpMyAdmin
3. Finalizar instalación y abrir *XAMPP Control Panel*.

---

## 3. Mover el proyecto a la carpeta htdocs
1. Ir a la carpeta donde se instaló XAMPP:`C:\xampp\htdocs\`

2. Copiar o mover la carpeta del proyecto dentro de `htdocs`.

Ejemplo: `C:\xampp\htdocs\vista\`


---

## 4. Insertar la base de datos en phpMyAdmin

Para que el sistema funcione correctamente es necesario importar la base de datos incluida en el proyecto.

### Pasos para insertar la base de datos:

1. Iniciar MySQL desde XAMPP Control Panel.
2. Abrir phpMyAdmin en el navegador: `http://localhost/phpmyadmin`
3. En el panel izquierdo, hacer clic en **Nueva** para crear una base de datos.
4. Escribir el nombre de la base de datos `clinica_citas_db`.
5. Seleccionar el cotejamiento recomendado: `utf8_general_ci`
6. Presionar **Crear**.
7. Una vez creada, seleccionar la base de datos en el panel izquierdo.
8. Ir a la pestaña **Importar** en la parte superior.
9. En "Archivo a importar", seleccionar el archivo `.sql` incluido en el proyecto `initial_data.sql`.
10. Dar clic en **Continuar**.
11. Esperar a que phpMyAdmin confirme que la importación fue exitosa.

---


## 5. Activar la extensión GD en PHP (necesario para generación de imágenes y PDFs)

Para que el proyecto pueda generar imágenes, miniaturas o ciertos tipos de PDF, es necesario activar la extensión **GD** en PHP. Esta función viene incluida en XAMPP, pero está desactivada por defecto.

### Pasos para habilitar GD en XAMPP

1. Ir a la carpeta donde está instalado XAMPP: `C:\xampp\php\`


2. Abrir el archivo: `php.ini`

Puedes abrirlo con:
- Bloc de notas
- Notepad++
- Visual Studio Code

3. Buscar la siguiente línea (Ctrl + F):
;extension=gd


4. Quitar el punto y coma **;** para habilitarla:


5. Guardar el archivo `php.ini`.

6. Reiniciar Apache desde el XAMPP Control Panel:
- Detener **Apache**
- Iniciar **Apache** nuevamente

### Verificar que GD está activado

1. Crear un archivo llamado: `info.php`

2. Colocar dentro:
<?php phpinfo(); ?>

3. Abrir en navegador:
http://localhost/info.php

Buscar el bloque que diga:
GD Support => enabled

una vez activado podras ejecutar el proyecto sin problemas

### Para acceder al sistema se incluyen los siguientes usuarios de prueba:

Administrador

Usuario: admin@clinica.com

Contraseña: admin123




