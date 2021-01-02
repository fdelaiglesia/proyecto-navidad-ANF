<?php
require_once "Com/DAO.php";

$idComic = (int)$_REQUEST["idComic"];
$titloComic= (string)$_REQUEST["tituloComic"];
$precio=(int)$_REQUEST["precio"];
$cantidad=(int)$_REQUEST["cantidad"];
$portadaComic=(string)$_REQUEST["portadaComic"];
$nuevaEntrada = ($idComic == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO Comic (tituloComic,precio,cantidad,portadaComic) VALUES (?,?,?,?)";
    $parametros = [$titloComic,$precio,$cantidad,$portadaComic];
    $correcto = DAO::ejecutarConsultaActualizar($sql,$parametros);
} else {
    $sql = "UPDATE Comic SET tituloComic=?,precio=?,cantidad=?,portadaComic=? WHERE idComic=?";
    $parametros = [$titloComic,$precio,$cantidad,$portadaComic,$idComic];
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