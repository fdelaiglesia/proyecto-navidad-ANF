<?php
require_once "_com/DAO.php";

$idComic = (int)$_REQUEST["idComic"];
$tituloComic = (string)$_REQUEST["tituloComic"];
$precio = (int)$_REQUEST["precioComic"];
$cantidad = (int)$_REQUEST["cantidadComic"];
$portadaComic = (string)$_REQUEST["portadaComic"];
$idCategoria = (int)$_REQUEST["idCategoria"];
$nuevaEntrada = ($idComic == -1);
$correcto = "";
$datosNoModificados = "";
if ($nuevaEntrada) {
    $correcto = DAO::comicCrear($tituloComic, $precio, $cantidad, $portadaComic, $idCategoria);
} else {
    $datosNoModificados = DAO::comicModificar($tituloComic, $precio, $cantidad, $portadaComic, $idCategoria, $idComic);
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
            <p>Se ha insertado correctamente la nueva entrada de <?= $tituloComic ?>.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos de <?= $tituloComic ?>.</p>

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
            <p>No se han podido guardar los datos del Comic <?= $tituloComic ?>.</p>
        <?php } ?>

    <?php
    }
    ?>

    <a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>