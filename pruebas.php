<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//Si se quiere subir una imagen
if (isset($_POST['subir'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
        else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'uploads/'.$archivo)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('uploads/'.$archivo, 777);
                //Mostramos el mensaje de que se ha subido co éxito
                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                //Mostramos la imagen subida
                echo '<p><img src="uploads/'.$archivo.'"></p>';
            }
            else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            }
        }
    }
}
?>

<form action="pruebas.php" method="POST" enctype="multipart/form-data"/>
Añadir imagen: <input name="archivo" id="archivo" type="file"/>
<input type="submit" name="subir" value="Subir imagen"/>
</form>
