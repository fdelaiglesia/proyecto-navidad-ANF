<?php
require_once "_com/DAO.php";


$idComic = (int)$_REQUEST["idComic"];

$nuevaEntrada = ($idComic == -1);

if ($nuevaEntrada) { 
    $tituloComic = "<introduzca el titulo del comic>";
    $precioComic="<introduzca el precio>";
    $cantidadComic="<introduzca una cantidad>";
    $portadaComic=false;
    $comicIdCategoria = 0;

}else{
    $comic = DAO::comicObtenerPorId($idComic);
    $tituloComic = $comic-> getTituloComic();
    $precioComic= $comic-> getPrecioComic();
    $cantidadComic=$comic-> getCantidadComic();
    $portadaComic=($comic-> getPortadaComic()==1);
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

        <input type='hidden' name='id' value='<?= $id ?>' />

        <label for='titulo'>Titulo</label>
        <input type='text' name='titulo' value='<?= $tituloComic ?>' />
        <br />

        <label for='precio'> Precio</label>
        <input type='text' name='precio' value='<?= $precioComic ?>' />
        <br />

        <label for='cantidad'> Cantidad</label>
        <input type='text' name='cantidad' value='<?= $cantidadComic ?>' />
        <br />
        <label for='estrella'>Portada</label>
        <input type='checkbox' name='estrella' <?= $portadaComic ? "checked" : "" ?> />
        <br />
        <label for='comicIdCategoria'>Categoría</label>
        <select name='categoriaId'>
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
        <br />
        <a href='ComicEliminar.php?id=<?= $id ?>'>Eliminar Ficha Comic</a>
    <?php } ?>

    <br />
    <br />

    <a href='ComicListado.php'>Volver al listado de Comics.</a>

</body>

</html>

