<?php
require_once "_com/DAO.php";
?>
<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

    <h1>Finalizar pedido</h1>
    <form method="post" action="PedidoConfirmar.php">
        <input type="hidden" name="idPedido" value="<?= $_REQUEST['idPedido'] ?>">
        <label for="direccionEnvioPedido">¿A que direccion mandamos tu pedido?</label>
        <input type="text" name="direccionEnvioPedido" required>
        <input type="submit" value="Confirmar pedido">
    </form>
<hr>
<a href="CarritoMostrar.php?idCliente=<?php echo $_SESSION['idCliente'];?>">Modificar pedido</a>
</body>

</html>