<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";

if(isset($_POST["Crear"])){
    if(empty($_POST["usuarioCliente"])|| empty($_POST["contrasennaCliente"]) || empty($_POST["nombreCliente"])
        || empty($_POST["apellidosCliente"]) || empty($_POST["emailCliente"])){
        $_SESSION["txt"]="¡Asegurate de rellenar todos los campos!";
        redireccionar("UsuarioNuevoFormulario.php");
    }else{
        $emailCliente=(string)$_POST["emailCliente"];
        $usuarioCliente=(string)$_POST["usuarioCliente"];
        $contrasennaCliente=(string)$_POST["contrasennaCliente"];
        $nombreCliente=(string)$_POST["nombreCliente"];
        $apellidosCliente=(string)$_POST["apellidosCliente"];
        if(isset($_FILES["fotoDePerfilCliente"])){
            $foto= $_FILES["fotoDePerfilCliente"]["name"];
        }else{
            $foto= "NULL";
        }
       // $foto= $_FILES["fotoDePerfilCliente"]["name"];
        $ruta= $_FILES["fotoDePerfilCliente"]["tmp_name"];

        /* CARGAR EL ARRAY CON DATOS*/
        $informacionUsuario= array(
            "usuarioCliente"=>$usuarioCliente,
            "contrasennaCliente"=>$contrasennaCliente,
            "emailCliente"=>$emailCliente,
            "nombreCliente"=>$nombreCliente,
            "apellidosCliente"=>$apellidosCliente,
            "foto"=>$foto,
            "ruta"=>$ruta
        );

        DAO::crearUsuario($informacionUsuario);


    }
}


