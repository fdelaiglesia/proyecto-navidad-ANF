<?php
session_start();
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Crear Cuenta nueva</h1>
<?php if(isset($_SESSION["txt"])){?>
<p><?=$_SESSION["txt"]?></p>
<?php session_unset();}?>

<div class="formulario">
    <form method="post" action="UsuarioNuevoCrear.php">
        <input type="text" name="nombreCliente" placeholder="Introduce tu nombre"><br><br>
        <input type="text" name="apellidosCliente" placeholder="Introduce tus apellidos"><br><br>
        <input type="text" name="usuarioCliente" placeholder="Introduce tu usuario"><br><br>
        <input type="text" name="emailCliente" placeholder="Introduce tu email"><br><br>
        <input type="password" name="contrasennaCliente" placeholder="Introduce tu contraseña" ><br><br>
        <input type="file" name="fotoDePerfilCliente" ><br><br>
        <input type="submit" name="Crear" value="Crear Cuenta">
    </form>
</div>

</body>

</html>

