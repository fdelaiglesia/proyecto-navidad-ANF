<?php
require_once "_com/DAO.php";


$idCategoria= (int)$_REQUEST["id"];
$eliminar = DAO::eliminarCategoriaPorId($idCategoria);


?>

<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($eliminar) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la categoría.</p>

<?php }  else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la categoría.</p>

<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>