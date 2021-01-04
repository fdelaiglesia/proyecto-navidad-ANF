<?php
require_once "_com/DAO.php";
/*Si no hay session iniciada redirigimos a la pagina de CONTENIDO PRIADO 1*/

/*if(iniciarSessionConCookie()){
        $identificador=$_COOKIE["identificador"];
        $codigoCookie=$_COOKIE["clave"];
        $arrayUsuario=obtenerUsuario($identificador);
        generarCookieRecordar($arrayUsuario); // Generar otro codigo cookie nuevo
        marcarSesionComoIniciada($arrayUsuario); // Canjear la session
}*/

?>




<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Iniciar Sesión</h1>
<?php
if(isset($_SESSION["txto"])){
?>
<p><?= $_SESSION["txto"]?></p>

<?php
    unset($_SESSION["txto"]);
}
?>
<div class="formulario">
    <form method="post" action="SesionInicioComprobar.php">
        <input type="text" name="usuarioCliente" placeholder="Introduce tu usuario" required><br><br>
        <input type="password" name="contrasennaCliente" placeholder="Introduce tu contraseña" required><br><br>
        Recuerdame: <input type='checkbox' name='recordar' id='recordar'><br><br>
        <input type="submit" name="Iniciar Session" value="Iniciar Session">
    </form>
</div>

</body>

</html>
