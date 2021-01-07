<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";

$comics = DAO::comicObtenerTodos();
$resultados=DAO::obtenerClienteConUsuario($_SESSION['usuarioCliente']);
//print_r($_SESSION['usuarioCliente']);
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
        <th>Unidades</th>
        <th>Precio</th>
    </tr>

    <?php
    foreach ($comics as $comic) { ?>
        <tr>
            <td>
             <a href="ComicFicha.php?idComic=<?=$comic->getId();?>" ><?= $comic->getTituloComic();?></a>
            </td>
            <td>
              <?php echo DAO::comicObtenerCategoria($comic->getIdCategoriaDeComic());?>
            </td>
            <td>
            <?= $comic->getCantidadComic();?>
            </td>
            <td>
            <p><?= $comic->getPrecioComic();?>€</p>
            </td>
            <td>
            <a href='ComicEliminar.php?idComic=<?=$comic->getId()?>'> (X)</a>
            </td>   
            <td>
            <a href='CarritoAnadir.php?idComic=<?=$comic->getId()?>&idCliente=<?=$_SESSION["idCliente"]?>'> Añadir al carrito</a>
            </td>    
        </tr>

    <?php } ?>

</table>
<a href="UsuarioPerfilVer.php?usuarioCliente=<?=$_SESSION["usuarioCliente"]?>" >Ver Perfil</a>

<a href="ComicFicha.php?idComic=-1" >Añadir comic</a>
<br>
<a href='CategoriaListado.php'>Volver al listado de Categorias.</a>
<a href='SesionCerrar.php'>Cerrar Session</a>


</body>
</html>
