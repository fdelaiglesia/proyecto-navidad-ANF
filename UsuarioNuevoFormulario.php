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
<?php if(isset($_SESSION["cambiarContraseña"])){?>
    <p><?=$_SESSION["cambiarContraseña"]?></p>
    <?php session_unset();}?>
<div class="formulario">
    <form method="post" action="UsuarioNuevoCrear.php" enctype="multipart/form-data">
        <input type="text" name="nombreCliente" placeholder="Introduce tu nombre" required><br><br>
        <input type="text" name="apellidosCliente" placeholder="Introduce tus apellidos"required><br><br>
        <input type="text" name="usuarioCliente" placeholder="Introduce tu usuario" required><br><br>
        <input type="email" name="emailCliente" placeholder="ejemplo@gmail.com" pattern=".+@gmail.com" required><br><br>
        <input type="password" name="contrasennaCliente" placeholder="Introduce tu contraseña" required><br><br>
        <input type="file" name="fotoDePerfilCliente" accept="image/x-png,image/gif,image/jpeg"><br><br>
        <input type="submit" name="Crear" value="Crear Cuenta">
    </form>
</div>
<a href="SessionInicioFormulario.php">Ya tengo cuenta...</a>
</body>

</html>

