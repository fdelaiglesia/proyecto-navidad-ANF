<?php
require_once "_com/DAO.php";

if(isset($_POST["guardar"])){
    $usuarioACtual=$_SESSION["usuarioCliente"];
    $resultados=DAO::obtenerClienteConUsuario($usuarioACtual);
    $contraActual=$_POST["actual"];
    $contraNueva=$_POST["nueva"];
    $contraConfirmar=$_POST["confirmar"];
    if(password_verify($contraActual,$resultados[0]["contrasennaCliente"])
        && $contraNueva==$contraConfirmar) {

        $sql = "UPDATE cliente SET contrasennaCliente=? WHERE usuarioCliente=?";
        $contraNueva=password_hash($contraNueva,PASSWORD_BCRYPT);

        if(DAO::ejecutarConsultaActualizar($sql,[$contraNueva,$usuarioACtual])==1){
            $_SESSION["cambiarContraseña"]="La contraseña se ha actualizado correctamente";
            redireccionar("SesionCerrar.php");
        }else {
            $_SESSION["cambiarContraseña"] = "La contraseña no se ha actualizado correctamente";
            redireccionar("UsuarioCambiarContrasenna.php");
        }
    }else{
        $_SESSION["cambiarContraseña"]="La contraseña no se ha actualizado correctamente";
         redireccionar("UsuarioCambiarContrasenna.php");
    }
}

?>
<html>

<head>
    <meta charset='UTF-8'>
</head>
<body>
<?php if(isset($_SESSION["cambiarContraseña"])){?>
    <p><?=$_SESSION["cambiarContraseña"]?></p>
    <?php session_unset();}?>

<form action="UsuarioCambiarContrasenna.php" method="post">
    <label>Contraseña Actual</label> <input type="text" name="actual" placeholder="Contraseña actual" required><br><br>
    <label>Contraseña Nueva</label> <input type="password" name="nueva" placeholder="Contraseña nueva" required><br><br>
    <label>Confirmar Contraseña Nueva</label> <input type="password" name="confirmar" placeholder="Confirmar contraseña" required><br><br>
    <input type="submit" name="guardar" value="Guardar Cambios">
</form>

</body>

</html>
