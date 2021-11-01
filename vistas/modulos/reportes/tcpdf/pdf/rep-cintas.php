<?php

// /pdf/tcpdf/reportes/modulos/vistas/controladores/cintas.controlador.php
//require_once("../../../../../controladores/cintas.controlador.php");
require_once("../../../../../modelos/cintas.modelo.php");

// Include the main TCPDF library (search for installation path).
// Se debe respetar esta alineacion a la izquierda.
require_once('tcpdf_include.php');

//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */


 // /pdf/tcpdf/reportes/modulos/vistas/controladores/cintas.controlador.php

 class ObtenerCintas
 {
	 public function ctrMostrarCintas($item,$valor)
		 {
			 $tabla = "t_Cintas";
			 $respuesta = ModeloCintas::mdlMostrarCintas($tabla,$item,$valor);
			 return $respuesta;
 
		 } // static public function ctrMostrarCintas()
 
 } // class ObtenerCintas

 
 class imprimirCintas
 {
 	 public function traerImpresionCintas()
	 {
		 // Imprimir las cintas.
		 $item = null;
		 $valor = null;
		 $respuestaCintas = ObtenerCintas::ctrMostrarCintas($item,$valor);
 
		 //var_dump($respuestasCintas);
	 }

 }

 $cintas = new imprimirCintas();
 $cintas->traerImpresionCintas();
 
 $serial = '23232323'; //$respuestaCintas['num_serial'];

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

$html = <<<EOD
		<table>
		<tr>
			<td style ="width:150px"><img src="images/logo-negro-bloque.png"></td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
						$serial
					<br>
					Dirección: Calle 44B 92-11
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Telefono: 300 786 62 49
					<br>
					ventas@inventorysystem.com
				</div>
			</td>
			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br>
				<br>FACTURA N.<br>$serial</td>

			</td>

		</tr>

		</table>




<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+







/*
class ObtenerCintas
{
	public function ctrMostrarCintas($item,$valor)
		{
			$tabla = "t_Cintas";
			$respuesta = ModeloCintas::mdlMostrarCintas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarCintas()

} // class ObtenerCintas


class imprimirCintas
{

	public $codigo;
	
	public function traerImpresionCintas()
	{
		// Imprimir las cintas.
		$item = null;
		$valor = null;
		$respuestaCintas = ObtenerCintas::ctrMostrarCintas($item,$valor);

		//var_dump($respuestasCintas);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Agrega varias páginas para diferentes maquetaciones.
$pdf->startPageGroup();
$pdf->AddPage();
$num_serial = '2323232'; 


// El primer bloque de la maquetacion
// Dentro de esta seccion se pueden utilizar tab sin problemas
// Se recomienda utilizar tablas para trabajar en TCPDF
// Ancho maximo para la hoja carta es de 540 pixeles.
// Se debe revisar la longuitud cuando se colocan los titulos en la hoja.
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style ="width:150px"><img src="images/logo-negro-bloque.png"></td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					$num_serial
					<br>
					Dirección: Calle 44B 92-11
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Telefono: 300 786 62 49
					<br>
					ventas@inventorysystem.com
				</div>
			</td>
			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br>
				<br>FACTURA N.<br>$num_serial</td>

			</td>

		</tr>


	</table>

EOF;
//$pdf->writeHTML($bloque1,false,false,false,false,'');
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

/*
$bloque2 = <<<EOF
	<table>
		<tr>
			<!-- Se coloca una imagen vacia, solo es para ocupar un espacio de 540px -->
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<!-- Dibuja un recuadro en el campo de Nombre Cliente -->
			<td style="border:1px solid #666; background-color:white; width:390px">
				Cliente: $respuestaCliente[nombre]
			</td>
	
			<td style="border:1px solid #666; background-color:white; width:150px; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="border:1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>
		</tr>
		<tr>
			<!-- Para insertar un renglon en blanco -->
			<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');


$bloque3 = <<<EOF
	<!-- Imprime los encabezados de las ventas -->
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Productos</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>


EOF;

$pdf->writeHTML($bloque3,false,false,false,false,'');


// Se va a imprimir el desglose de las ventas.
foreach ($productos as $key => $item)
{
	$itemProducto = "descripcion";
	$valorProducto = $item["descripcion"];
	$orden = "id";

	$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);

	// Se debe utilizar variable de lo contrario muestra error.
	$valorUnitario = number_format($respuestaProducto["precio_venta"],2);
	$precioTotal = number_format($item["total"],2);


$bloque4 = <<<EOF
		<table style="font-size:10px; padding:5px 10px;">
			<tr>
				<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
					$item[descripcion]
				</td>
				<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; 	text-align:center">
					$item[cantidad]
				</td>

				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center">
					$ $valorUnitario
				</td>

				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center">
					$ $precioTotal
			</td>

			</tr>
		</table>

EOF;
	
$pdf->writeHTML($bloque4,false,false,false,false,'');

	} // foreach ($productos as $key => $item)


$bloque5 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; 	text-align:center"></td>
			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center"></td>
		</tr>
		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; 	text-align:center">
				neto
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $neto
			</td>
		</tr>

		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				impuesto
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $impuesto
			</td>		 
		</tr>
		
		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $total
			</td>		 
		</tr>

		</table>

EOF;

$pdf->writeHTML($bloque5,false,false,false,false,'');

	
// Para imprimir la factura.

$pdf->Output('cintas.pdf', 'I');

	} // public function traerImpresionCintas()

} // class imprimirCintas

$cintas = new imprimirCintas();
$cintas->traerImpresionCintas();

*/

