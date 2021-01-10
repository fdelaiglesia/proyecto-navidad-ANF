<?php
require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}
$productos = DAO::pedidoRealizadoMostrar($_REQUEST['idPedido']);
$totalProductos = 0;
$precioTotal = 0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Carrito</title>
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
            $totalProductos++;
            $idPedido = $producto->getIdPedido(); ?>


            <tr>
                <td>
                    <p><?php echo DAO::carritoObtenerComic($producto->getIdComic()); ?></p>
                </td>
                <td>
                    <p><?= $producto->getUnidades() ?></p>

                </td>
                <td>
                    <p><?php echo (DAO::carritoObtenerPrecio($producto->getIdComic()) * $producto->getUnidades()); ?>€</p>
                </td>
                <?php $precioTotal += (DAO::carritoObtenerPrecio($producto->getIdComic()) * $producto->getUnidades()); ?>
            </tr>

        <?php } ?>


    </table>
    <p>Total de productos = <?= $totalProductos ?></p>
    <br>
    <p>Precio del pedido = <?= $precioTotal ?> €</p>

    <a href='PedidoMostrar.php?idCliente=<?= $_SESSION['idCliente'] ?>'>Ver mis pedidos</a>
    <hr>
    <a href='ComicListado.php'>Ver más comics</a>
    <a href='SesionCerrar.php'>Cerrar Session</a>

</body>

</html>