<?php
require_once "_com/DAO.php";
$productos = DAO::carritoObtenerIdCliente($_REQUEST['idCliente']);
$comics = DAO::comicObtenerTodos();
$totalProductos = 0;
$precioTotal = 0;
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
  <a href='CarritoMostrar.php?idCliente=<?= $_SESSION['idCliente'] ?>' style="float: right;">Ver Carrito</a>
  <h1>Carrito</h1>

  <table border='1'>

    <tr>
      <th>Producto</th>
      <th>Unidades</th>
    </tr>

    <?php
    foreach ($productos as $producto) {
      $totalProductos++; ?>


      <tr>
        <td>
          <p><?php echo DAO::carritoObtenerComic($producto->getIdComic()); ?></p>
        </td>
        <td>
          <form action="CarritoModificarUnidades.php?idComic=<?= $producto->getIdComic()?>" method="post">
            <input type="number" name="unidades" value="<?= $producto->getUnidades() ?>" max="<?php
               echo DAO::carritoObtenerStock($producto->getIdComic()); ?>">
            <input type="submit" value="Modificar">
          </form>
        </td>
        <td>
          <p><?php echo (DAO::carritoObtenerPrecio($producto->getIdComic()) * $producto->getUnidades()); ?>€</p>
        </td>
        <td>
          <a href='CarritoEliminar.php?idPedido=<?= $producto->getIdPedido() ?>&idComic=<?= $producto->getIdComic() ?>'>Quitar de mi carrito</a>
        </td>
        <?php $precioTotal += (DAO::carritoObtenerPrecio($producto->getIdComic()) * $producto->getUnidades()); ?>
      </tr>

    <?php } ?>


  </table>
  <p>Total de productos = <?= $totalProductos ?></p>
  <br>
  <p>Precio del pedido = <?= $precioTotal ?> €</p>
  <a href='ComicListado.php'>Ver más comics</a>
  <a href='SesionCerrar.php'>Cerrar Session</a>

</body>

</html>