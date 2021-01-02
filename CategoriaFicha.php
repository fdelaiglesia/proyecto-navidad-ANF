<?php
require_once "Com/DAO.php";

$idCategoria = (int)$_REQUEST["id"];


	$nuevaEntrada = ($idCategoria == -1);

	if ($nuevaEntrada) { 
		$nombreCategoria = "<introduzca nombre>";
	} else { 
		$categoria = DAO::categoriaObtenerPorId($idCategoria);
		$nombreCategoria = $categoria->getNombreCategoria();
		}



?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
	<h1>Nueva ficha de categoría</h1>
<?php } else { ?>
	<h1>Ficha de categoría</h1>
<?php } ?>

<form method='post' action='CategoriaGuardar.php'>

<input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre</label>
	<input type='text' name='nombre' value='<?=$nombreCategoria?>' />
    <br/>

    <br/>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear categoría' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<br />

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='CategoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
<?php } ?>

<br />
<br />

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>