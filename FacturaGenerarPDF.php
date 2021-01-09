<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "FPDF/fpdf.php";
require_once "_com/DAO.php";
if(!isset($_REQUEST["idPedido"]) && DAO::haySesionIniciada()){
    redireccionar("ComicListado.php");
}
class PDF extends FPDF
{
// En-tête
    function Header()
    {

        // Logo
       // $this->Image('logo.png',10,6,30);
        // Police Arial gras 15
        $this->SetFont('Arial','B',12);
        // mover la celda
        $this->Cell(55);
        // Titulo
        $this->Cell(90,10,'FACTURA DE COMPRAS',1,0,'C');
        // Salto linea
        $this->Ln(20);
        // CABECERA DE LA TABLA
        $this->Cell(60,10,utf8_decode("Nombre Producto"),1,0,"C");
        $this->Cell(40,10,utf8_decode("Unidades"),1,0,"C");
        $this->Cell(60,10,utf8_decode("Precio Unitario"),1,0,"C");
        $this->Cell(35,10,utf8_decode("Precio Total"),1,1,"C");

    }

// Pied de page
    function Footer()
    {
        // Posicion desde abajo
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numero de pagina
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}
$idPedido=$_REQUEST["idPedido"];
//Extraer los detalles del pedido
$consultaPedido="SELECT * FROM comic_pedido c,pedido p WHERE p.idCliente =?
                                        AND c.idPedido = p.idPedido
                                        AND p.fechaConfrmacionPedido IS NOT NULL
                                        AND c.idPedido=?";
$resultados=DAO::ejecutarConsultaObtener($consultaPedido,[$_SESSION["idCliente"],$idPedido]);
$consultaCliente="SELECT * FROM cliente WHERE idCliente=?";
$resultadosCliente=DAO::ejecutarConsultaObtener($consultaCliente,[$resultados[0]["idCliente"]]);


// Llamar a la clase
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$limit=count($resultados);
$precioPagar=0;//precio a pagar de todos los productos

for($i=0;$i<$limit;$i++){
    $consultaComic="SELECT * FROM comic WHERE idComic=?";
    $resultadosComic=DAO::ejecutarConsultaObtener($consultaComic,[$resultados[$i]["idComic"]]);

    //Extraer datos del array
    $nombreProducto=$resultadosComic[0]["tituloComic"];//titulo del comic
    $precioUnitario=$resultadosComic[0]["precioComic"];// precio unitario del comic
    $unidades=$resultados[$i]["unidades"];// unidades compradas
    $precioTotal=(int)$precioUnitario*(int)$unidades;// precio total de esas unidades

    // IMPRIMIR LOS DATOS
    $pdf->Cell(60,10,utf8_decode($nombreProducto),1,align: "C");
    $pdf->Cell(40,10,utf8_decode($unidades),1,align: "C");
    $pdf->Cell(60,10,utf8_decode($precioUnitario." euros"),1,align:"C");
    $pdf->Cell(35,10,utf8_decode($precioTotal." euros"),1,align:"C" ,ln: 1);
    $precioPagar=$precioPagar+$precioTotal;
}
// infos del cliente
$pdf->Cell(60,10,utf8_decode("Fecha de confirmacion: ".$resultados[0]["fechaConfrmacionPedido"]),0,1);
$pdf->Cell(60,10,utf8_decode("Direccion Envio: ".$resultados[0]["direccionEnvioPedido"]),0,1);
$pdf->Cell(60,10,utf8_decode("Nombre Cliente: ".$_SESSION["nombreCliente"]." ".$_SESSION["apellidosCliente"]),0,1);
$pdf->Cell(60,10,utf8_decode("Precio a pagar: ".$precioPagar." euros"),0,1);
$pdf->Output();
?>