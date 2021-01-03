<?php
require_once "_com/DAO.php";

$idComic = (int)$_REQUEST["idComic"];
$titloComic= (string)$_REQUEST["tituloComic"];
$precio=(int)$_REQUEST["precioComic"];
$cantidad=(int)$_REQUEST["cantidadComic"];
$portadaComic=(string)$_REQUEST["portadaComic"];
$idCategoria=(int)$_REQUEST["idCategoria"];
$nuevaEntrada = ($idComic == -1);
$correcto = '';
if ($nuevaEntrada) {
    $sql = "INSERT INTO comic (tituloComic,precioComic,cantidadComic,portadaComic,idCategoria) VALUES (?,?,?,?,?)";
    $parametros = [$titloComic,$precio,$cantidad,$portadaComic,$idCategoria];
    $correcto = DAO::ejecutarConsultaActualizar($sql,$parametros);
} else {
    $sql = "UPDATE comic SET tituloComic=?,precioComic=?,cantidadComic=?,portadaComic=?,idCategoria=? WHERE idComic=?";
    $parametros = [$titloComic,$precio,$cantidad,$portadaComic,$idCategoria,$idComic];
    $datosNoModificados = DAO::ejecutarConsultaActualizar($sql,$parametros);
}


?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php
if ($correcto == 1 || $datosNoModificados == 1) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$titloComic?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$titloComic?>.</p>

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
        <p>No se han podido guardar los datos del Comic <?=$titloComic?>.</p>
    <?php } ?>

    <?php
}
?>

<a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>