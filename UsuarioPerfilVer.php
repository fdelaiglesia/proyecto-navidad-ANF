<?php
require_once "_com/DAO.php";

if(isset($_REQUEST["usuarioCliente"])){
    $usuarioCliente=$_REQUEST["usuarioCliente"];
    $resultados=DAO::obtenerClienteConUsuario($usuarioCliente);


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
    <form>
        <input type="hidden" name="idCliente" value="<?=$resultados[0]["idCliente"]?>"><br><br>
        <?php if($resultados[0]["fotoDePerfilCliente"]==NULL){?>
        <img src="uploads/Unknown-person.gif" width="280" height="280" ;><br><br>
        <? }else{?>
        <img src="FotosDePerfil/<?=$resultados[0]["fotoDePerfilCliente"]?>" width="280" height="280";><br><br>
        <?};?>
        <label>Usuario: </label><input type="text" name="usuarioCliente" value="<?=$resultados[0]["usuarioCliente"]?>" readonly><br><br>
        <label>Nombre: </label><input type="text" name="nombreCliente" value="<?=$resultados[0]["nombreCliente"]?>" readonly><br><br>
        <label>Apellidos: </label><input type="text" name="apellidosCliente" value="<?=$resultados[0]["apellidosCliente"]?>" readonly><br><br>
        <label>Email: </label><input type="text" name="email" value="<?=$resultados[0]["emailCliente"]?>" readonly><br><br>
    </form>
    <a href='UsuarioCambiarContra.php?idContrasenna=<?=$resultados[0]["idCliente"]?>'>Cambiar la contraseña</a>

</div>

</body>

</html>


