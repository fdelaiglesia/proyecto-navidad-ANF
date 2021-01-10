<?php
require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}
$pedidos = DAO::pedidoObtetenerTodos($_REQUEST['idCliente']);

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
    <h1>Mis pedidos</h1>

    <table border='1'>

        <tr>
            <th>Direccion de envio</th>
            <th>Fecha</th>
        
        </tr>

        <?php
        foreach ($pedidos as $pedido) { ?>


            <tr>
                <td>
                    <a href="PedidoRealizadoMostrar.php?idPedido=<?=$pedido->getIdPedido()?>"><?=  $pedido->getDireccionEnvio()?></a>
                </td>
                <td>
                    <p><?php echo date("d/m/Y",strtotime($pedido->getFechaConfirmacion()));?></p>
                </td>
            </tr>

        <?php } ?>


    </table>
    <hr>
    <a href='ComicListado.php'>Ver más comics</a>
    <a href='SesionCerrar.php'>Cerrar Session</a>

</body>

</html>