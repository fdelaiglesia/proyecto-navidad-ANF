<?php
require_once "_com/DAO.php";

$sql = DAO::pedidoConfirmar($_REQUEST['idPedido'],$_REQUEST['direccionEnvioPedido'],$_SESSION['idCliente']);
$idPedido=$_REQUEST['idPedido'];
?>
<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>
<?php if($sql){ ?>
    <h1>Pedido finalizado</h1>
    <p>¿Quieres <a href="FacturaGenerarPDF.php?idPedido=<?=$idPedido?>">descargar</a> la factura?</p><br>
<?php }else{ ?>
    <h1>Pedido no finalizado</h1>
    <p>Contacte con administrador</p>

<?php } ?>
<a href="ComicListado.php">Seguir comprando...</a>
</body>

</html>