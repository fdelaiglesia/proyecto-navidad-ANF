<?php

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}

if(isset($_REQUEST["usuarioCliente"])){
    $usuarioCliente=$_REQUEST["usuarioCliente"];
    $resultados=DAO::obtenerClienteConUsuario($usuarioCliente);
        if ($resultados[0]["fotoDePerfilCliente"] == "NULL"){
            $foto="uploads/Unknown-person.gif";
        }else{
            $foto=$resultados[0]["fotoDePerfilCliente"];
        }

}else{
    $resultados="";
    redireccionar("SessionInicioFormulario.php");
}

?>
<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Perfil de <?=$resultados[0]["usuarioCliente"]?></h1>
<?php if(isset($_SESSION["msg"])){?>
    <p><?=$_SESSION["msg"]?></p>
    <?php unset($_SESSION["msg"]);
}?>
<?php if(isset($_SESSION["notif"])){?>
    <p><?=$_SESSION["notif"]?></p>
    <?php unset($_SESSION["notif"]);
}?>

<div class="formulario">
    <img src="uploads/<?=$foto?>" height="280" width="280">
    <p>Usuario : <?=$resultados[0]["usuarioCliente"]?></p>
    <p>Nombre : <?=$resultados[0]["nombreCliente"]?></p>
    <p>Apellidos : <?=$resultados[0]["apellidosCliente"]?></p>
    <p>Email : <?=$resultados[0]["emailCliente"]?></p>
</div>
<a href='ComicListado.php'>Volver al listado de Comics</a>
<a href='UsuarioCambiarContrasenna.php'>Cambiar contraseña</a>
<a href='SesionCerrar.php'>Cerrar Session</a>


</body>

</html>


