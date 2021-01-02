<?php
require_once "_com/DAO.php";

if(isset($_POST["Crear"])){

    if(empty($_POST["usuarioCliente"])|| empty($_POST["contrasennaCliente"]) || empty($_POST["nombreCliente"])
        || empty($_POST["apellidosCliente"]) || empty($_POST["emailCliente"])){
        $_SESSION["txt"]="¡Asegurate de rellenar todos los campos!";
        redireccionar("UsuarioNuevoFormulario.php");
    }else{
        $usuarioCliente=(string)$_POST["usuarioCliente"];
        $contrasennaCliente=(string)$_POST["contrasennaCliente"];
        $nombreCliente=(string)$_POST["nombreCliente"];
        $apellidosCliente=(string)$_POST["apellidosCliente"];
        $foto= $_FILES["fotoDePerfilCliente"]["name"];
        $ruta= $_FILES["fotoDePerfilCliente"]["tmp_name"];
        $informacionUsuario=array("usuarioCliente"=>$usuarioCliente,"contrasennaCliente"=>$contrasennaCliente,
            "nombreCliente"=>$nombreCliente,"apellidosCliente"=>$apellidosCliente,"foto"=>$foto,
            "ruta"=>$ruta);
        crearUsuario($informacionUsuario);


    }
}


// TODO ¿Excepciones?

