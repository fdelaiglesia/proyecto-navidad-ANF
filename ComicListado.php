<?php
require_once "_com/DAO.php";

$comics = DAO::comicObtenerTodos();

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
<h1>Listado de Comics</h1>

<table border='1'>

    <tr>
        <th>Comic</th>
        <th>Categoría</th>
    </tr>

    <?php
    foreach ($comics as $comic) { ?>
        <tr>
            <td>
              <?= $comic->getTituloComic();?>
            </td>
            <td>
              <?php echo DAO::comicObtenerCategoria($comic->getIdCategoriaDeComic());?>
            </td>
        </tr>
    <?php } ?>

</table>
</body>
</html>
