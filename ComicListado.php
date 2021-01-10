<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";
if(DAO::iniciarSessionConCookie()){
    $usuarioCliente = $_COOKIE["usuarioCliente"];
    $rs=DAO::obtenerClienteConUsuario($usuarioCliente);
    DAO::marcarSesionComoIniciada($rs);
}
if(!DAO::haySesionIniciada() ){
    redireccionar("SessionInicioFormulario.php");
}


$clausulaWhere = "";
if (isset($_REQUEST["buscar"]) && !empty($_REQUEST["busqueda"])) {
  $busqueda = $_REQUEST["busqueda"];
  $clausulaWhere = "WHERE tituloComic LIKE '%" . $busqueda . "%'";
}
$comics = DAO::comicObtenerTodos($clausulaWhere);
$resultados=DAO::obtenerClienteConUsuario($_SESSION['usuarioCliente']);
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
<a style="float: right;margin-left: 15px;" href="UsuarioPerfilVer.php?usuarioCliente=<?=$_SESSION["usuarioCliente"]?>" >Ver Perfil</a>
<a href='SesionCerrar.php' style="float: right;margin-left: 15px;">Cerrar Session</a>
<a href='CarritoMostrar.php?idCliente=<?=$_SESSION['idCliente']?>' style="float: right;margin-left: 15px;">Ver Carrito</a>
<a href='PedidoMostrar.php?idCliente=<?=$_SESSION['idCliente']?>' style="float: right;margin-left: 15px;">Ver Pedidos</a>
<p style="float: left;margin-right: 15px;">Usuario: <?=$_SESSION["usuarioCliente"]?></p>
<p style="float: left;margin-right: 15px;">Nombre: <?=$_SESSION["nombreCliente"]?></p>
<p style="float: left;margin-right: 15px;">Apellidos: <?=$_SESSION["apellidosCliente"]?></p><br><br>
<h1>Listado de Comics</h1>

<form action="ComicListado.php" method="post">
        <input type="text" name="busqueda" placeholder="Buscar comic" class="busqueda">
        <input type="submit" name="buscar" value="Buscar">
    </form>
<table border='1'>

    <tr>
        <th>Comic</th>
        <th>Categoría</th>
        <th>Unidades</th>
        <th>Precio</th>
    </tr>

    <?php
    foreach ($comics as $comic) { ?>
        <tr>
            <td>
             <a href="ComicFicha.php?idComic=<?=$comic->getId();?>" ><?= $comic->getTituloComic();?></a>
            </td>
            <td>
              <?php echo DAO::comicObtenerCategoria($comic->getIdCategoriaDeComic());?>
            </td>
            <td>
            <?= $comic->getCantidadComic();?>
            </td>
            <td>
            <p><?= $comic->getPrecioComic();?>€</p>
            </td>
            <td>
            <?php if($_SESSION["usuarioCliente"]=="admin"){?>
            <a href='ComicEliminar.php?idComic=<?=$comic->getId()?>'> (X)</a>
            <?php };?>
            </td>   
            <td>
            <a href='CarritoAnadir.php?idComic=<?=$comic->getId()?>&idCliente=<?=$_SESSION["idCliente"]?>'> Añadir al carrito</a>
            </td>    
        </tr>

    <?php } ?>

</table>
<?php 
if (isset($_REQUEST["buscar"]) && !empty($_REQUEST["busqueda"])) {?>
<a href="ComicListado.php" >Ver todos los comics</a>
<?php } ?>
<br>
<br>
<a href="ComicFicha.php?idComic=-1" >Añadir comic</a>
<a style="margin-left: 15px;" href='CategoriaListado.php'>Volver al listado de Categorias.</a>
<br>


</body>
</html>
