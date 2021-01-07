<?php
require_once "_com/DAO.php";
DAO::carritoEliminar($_REQUEST['idPedido'],$_REQUEST['idComic']);
$idCliente = $_SESSION['idCliente'];
redireccionar("CarritoMostrar.php?idCliente=" . $idCliente);