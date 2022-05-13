<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" >

    <head>
        <title>Generador de archivos .htaccess y .htpasswd</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <body>

<?php
    if(isset($_POST['submit'])) {
        if(empty($_POST['user']) || empty($_POST['password']) ||
           empty($_POST['htaccess_path']) || empty($_POST['htpasswd_path'])) {
           echo "<p>Debe rellenar todos los datos del formulario.</p>";
        }
        else {
            echo "<h1>Archivo <code>.htaccess</code></h1>\n";
            echo "<p>Cree el archivo <code>" . $_POST['htaccess_path'] .
                 "/.htaccess</code> con el siguiente contenido:</p>\n";
            echo "<pre>\n";
            echo "AuthType Basic\n";
            echo "AuthName \"Acceso restringido\"\n";
	    echo "AuthUserFile " . dirname(__FILE__) . "/" . $_POST['htpasswd_path'] . "/.htpasswd\n";
            echo "Require valid-user\n";
            echo "</pre>";
            echo "<h1>Archivo <code>.htpasswd</code></h1>\n";
            echo "<p>Cree el archivo <code>" . $_POST['htpasswd_path'] .
                 "/.htpasswd</code> con el siguiente contenido:</p>\n";
            echo "<pre>\n";
            echo $_POST['user'] . ":" . crypt($_POST['password']) . "\n";
            echo "</pre>";
        }
    }
?>

    <p>Rellene los campos del siguiente formulario con los valores deseados
       para generar los archivos <code>.htaccess</code> y
       <code>.htpasswd</code>:</p>
    <form action="<?php echo "https://" . $_SERVER['SERVER_NAME'] .
    $_SERVER['PHP_SELF']; ?>" method="post">

        Usuario: <input type="text" name="user" /><br />
        Contrase&ntilde;a: <input type="password" name="password" /><br />
        Directorio del archivo <code>.htaccess</code> (relativo al directorio donde se encuentra esta página):
        <input type="text" name="htaccess_path" /><br />

        Directorio del archivo <code>.htpasswd</code> (relativo al directorio donde se encuentra esta página):
        <input type="text" name="htpasswd_path" /><br />
        <input type="submit" name="submit" value="Generar" />
    </form>
    </body>

</html>

