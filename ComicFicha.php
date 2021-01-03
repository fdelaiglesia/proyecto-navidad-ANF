<?php
require_once "_com/DAO.php";


$idComic = (int)$_REQUEST["idComic"];

$nuevaEntrada = ($idComic == -1);
$categorias = DAO::categoriaObtenerTodos();
if ($nuevaEntrada) {
    $tituloComic = "";
    $precioComic = "";
    $cantidadComic = "";
    $portadaComic = "";
    $comicIdCategoria = 0;
} else {
    $comic = DAO::comicObtenerPorId($idComic);
    $id = $comic->getId();
    $tituloComic = $comic->getTituloComic();
    $precioComic = $comic->getPrecioComic();
    $cantidadComic = $comic->getCantidadComic();
    $portadaComic = $comic->getPortadaComic();
    $comicIdCategoria = $comic->getIdCategoriaDeComic();
}
?>




<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

    <?php if ($nuevaEntrada) { ?>
        <h1>Nueva ficha de comix</h1>
    <?php } else { ?>
        <h1>Ficha de comic</h1>
    <?php } ?>

    <form method='post' action='ComicGuardar.php'>

        <input type='hidden' name='idComic' value='<?= $idComic ?>' />

        <label for='titulo'>Titulo</label>
        <input type='text' name='tituloComic' value='<?= $tituloComic ?>' placeholder="Titulo del comic" />
        <br />

        <label for='precio'> Precio</label>
        <input type='text' name='precioComic' value='<?= $precioComic ?>' placeholder="Precio del comic" />
        <br />

        <label for='cantidad'> Cantidad</label>
        <input type='text' name='cantidadComic' value='<?= $cantidadComic ?>' placeholder="Cantidad de comics" />
        <br />
        <label for='estrella'>Portada</label>
        <input type='text' name='portadaComic' value='<?= $portadaComic ?>' placeholder="Portada del comic" />
        <br />
        <label for='comicIdCategoria'>Categoría</label>
        <select name='idCategoria'>
            <?php
            foreach ($categorias as $categoria) {
                $categoriaId = (int) $categoria->getId();
                $categoriaNombre = $categoria->getNombreCategoria();

                if ($categoriaId == $comicIdCategoria) $seleccion = "selected='true'";
                else                                     $seleccion = "";

                echo "<option value='$categoriaId' $seleccion>$categoriaNombre</option>";
            }
            ?>
        </select>
        <br />



        <br />

        <?php if ($nuevaEntrada) { ?>
            <input type='submit' name='crear' value='Crear ficha comic' />
        <?php } else { ?>
            <input type='submit' name='guardar' value='Guardar cambios' />
        <?php } ?>

    </form>
    <?php if (!$nuevaEntrada) { ?>
<img src="<?=$portadaComic?>" style="position: absolute;top: 20px;right: 500px;" height="300" width="200">
<?php }else{ ?>
    <img src="https://image.freepik.com/vector-gratis/plantilla-pagina-comic-portada-revista_11554-900.jpg" style="position: absolute;top: 20px;right: 500px;" height="300" width="200">
    <?php } ?>
    <?php if (!$nuevaEntrada) { ?>
        <br />
        <a href='ComicEliminar.php?idComic=<?= $id ?>'>Eliminar Ficha Comic</a>
    <?php } ?>

    <br />
    <br />

    <a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>