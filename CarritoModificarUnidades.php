<?php
require_once "_com/DAO.php";
DAO::carritoModificarUnidades($_REQUEST['unidades'],$_REQUEST['idComic']);
$idCliente= ($_REQUEST['idCliente']);
redireccionar("CarritoMostrar.php?idCliente=" . $idCliente);