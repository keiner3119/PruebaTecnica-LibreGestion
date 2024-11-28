# Prueba Técnica
Este es mi repositorio que contiene la prueba técnica desarrollada, utilizando PHP nativo (puro) con una arquitectura MVC para el backend, y HTML, CSS y JavaScript para el frontend.

# Requisitos Previos
    - Antes de comenzar, asegúrate de tener los siguientes requisitos y/o aplicativos instalados en tu máquina:
        - PHP (versión 7.4 o superior; viene incluído en un paquete de herramientas llamado servidor local XAMPP, Laragon, entre otros).
        - Un servidor local como XAMPP o Laragon (Con una versión de PHP 7.4 o superior, estos servidores traen incoporado el PHP, verificar la versión de éste).
        - Herramienta Git en su última versión.
        - Un navegador web actualizado.
        - Un editor de texto como Intellij IDEA, Visual Studio Code o Sublime Text (Opcional).

# Instrucciones para clonar el proyecto
    - Crea un directorio donde quieres clonar las carpetas subidas al repositorio.
    - Clona el Repositorio en tú máquina local
        - Con Power Shell o CMD, ve a tú directorio creado: cd 'C:/{path_del_directorio_creado/seleccionado}'.
        - Ejecuta el siguiente comando: git clone https://github.com/keiner3119/PruebaTecnica-LibreGestion.git (Si es por primera vez, Git te pedirá iniciar sesión y en algunos casos permisos)
        - La nomenclatura de los directorios clonados quedaría así:
            |__SQL
            |__Documentos
            |__Test

# Configurar el servidor Local (XAMPP, Laragon o el de su elección)
    - Copia el directorio del proyecto a la carpeta correspondiente del servidor:
        - En XAMPP: C:/xampp/htdocs/.
        - En Laragon: C:/laragon/www/.
    - Inicia el servidor abriendo XAMPP o Laragon y activa los servicios de Apache y MySQL, pero no abras aún la aplicación si sabes hacerlo.
    
# Configurar la Base de Datos.
    - Accede a phpMyAdmin desde el panel del servidor local.
        - Crea una base de datos con nombre "test" y cotejamiento "utf8_unicode_ci".
        - Ahora seleccionando la base de datos que creaste (test) y le das en las opciones superiores, escoges la opción Importar, se te abrirá un apartado para seleccionar un archivo y seleccionas el archivo .sql que clonaste del repositorio; se encuentra en la carpeta SQL.

# Configurar el proyecto (Si es necesario)
    - Si estas utilizando un servidor de aplicaciones remoto o distinto en su sintaxis, puedes modificar los parámetros de conexión:
        - Abre el siguiente archivo en el directorio: Test/LayerEntity/Connection.php.
        - Encontraras las credenciales del servidor, modifica lo que necesites y guarda los cambios.

# Abre la aplicación
    - Abre tu navegador de prefetencia y accede a la URL:
        - En XAMPP: http://localhost/test/layerviews/index.html
        - En Laragon: http://test/layerviews/index.html.test

Con los pasos anteriores se te abrirá el aplicativo, si algo falla verifica cada paso.

