<?php
require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}
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
        <?php if($_SESSION["usuarioCliente"]=="admin"){?>
        <td><a href='CategoriaEliminar.php?id=<?=$categoria->getId()?>'> (X)                            </a></td>                           </a></td>
        <?php };?>
           
        </tr>
    <?php } ?>

</table>
<a href="CategoriaFicha.php?id=-1" >Añadir Categoria</a>
<br>
<br>

<a href='ComicListado.php'>Volver al listado de Comics.</a>
</body>
</html>
