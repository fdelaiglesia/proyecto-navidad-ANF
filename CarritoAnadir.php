<?php

require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}
$idComic = $_REQUEST['idComic'];
$idCliente = $_REQUEST['idCliente'];
DAO::pedidoCrearParaCliente($idCliente);
DAO::carritoAnadirComic($idComic,$idCliente);
redireccionar("ComicListado.php");