<?php
require_once "_com/DAO.php";

$categorias = DAO::categoriaObtenerTodos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Listado Comic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
<h1>Listado de Categorias</h1>

<table border='1'>

    <tr>
        <th>Categorias</th>
    </tr>

    <?php
    foreach ($categorias as $categoria) { ?>
        <tr>
        <td><a href='CategoriaFicha.php?id=<?=$categoria->getId()?>'> <?=$categoria->getNombreCategoria()?> </a></td>
        <td><a href='CategoriaEliminar.php?id=<?=$categoria->getId()?>'> (X)                            </a></td>                           </a></td>

           
        </tr>
    <?php } ?>

</table>
</body>
</html>
