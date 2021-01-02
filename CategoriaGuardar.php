<?php
require_once "Com/DAO.php";

$id = (int)$_REQUEST["idCategoria"];
$nombre = $_REQUEST["nombreCategoria"];


$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
	$nuevaInsercion = DAO::categoriaCrear($nombreCategoria);
} else {
	$actualizar = DAO::categoriaActualizar($id, $nombreCategoria);
}

?>


<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>
	<?php

	if ($nuevaInsercion > 0 || $actualizar > 0) { ?>
		<?php if ($nuevaEntrada) { ?>
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?= $nombreCategoria ?>.</p>
		<?php } else { ?>
			<h1>Guardado completado</h1>
			<p>Se han guardado correctamente los datos de <?= $nombreCategoria ?>.</p>
		<?php }
		?>

	<?php
	} else {
	?>

		<?php if ($nuevaEntrada) { ?>
			<h1>Error en la creación.</h1>
			<p>No se ha podido crear la nueva categoría.</p>
		<?php } else { ?>
			<h1>Error en la modificación.</h1>
			<p>No se han podido guardar los datos de la categoría.</p>
		<?php } ?>

	<?php
	}
	?>

	<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>