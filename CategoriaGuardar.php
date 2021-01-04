<?php
require_once "_com/DAO.php";


$idCategoria = (int)$_REQUEST["id"];
$nombreCategoria= (string)$_REQUEST["nombre"];



$nuevaEntrada = ($idCategoria == -1);
$correcto = "";
$datosNoModificados = "";
if ($nuevaEntrada) {
    $correcto = DAO::categoriaCrear($nombreCategoria);
} else {
    $datosNoModificados = DAO::categoriaModificar($idCategoria,$nombreCategoria);
}


?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php
if ($correcto|| $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?= $nombreCategoria ?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?= $nombreCategoria ?>.</p>

        <?php if ($datosNoModificados == 0) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva entrada.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos del la categoria <?= $nombreCategoria ?>.</p>
    <?php } ?>

    <?php
}
?>

<a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>