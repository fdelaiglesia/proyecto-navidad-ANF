<?php
require_once "_com/DAO.php";

$id = (int)$_REQUEST["idComic"];

$bienEjectado=DAO::comicEleminarPorId($id) ;

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($bienEjectado) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el comic seleccionado.</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>

<?php } ?>

<a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>