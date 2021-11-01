<?php
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
// Para llegar a este archivo, se regresan tres carpetas : /pdf/tcpdf/extenciones

require_once("../../../controladores/cintas.controlador.php");
require_once("../../../modelos/cintas.modelo.php");

// Include the main TCPDF library (search for installation path).
// Se debe respetar esta alineacion a la izquierda.
require_once('tcpdf_include.php');

// Se crea una clase Extendida del TCPDF para manejar Encabezados y Pie de Pagina Personalizados.
class MYPDF extends TCPDF 
{
	//Page header
	public function Header() 
	{
			// Logo
			$image_file = K_PATH_IMAGES.'logo_jabil1.png';

			// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
			$this->Image($image_file, 5, 10, 30, 15, 'PNG', '', 'T', false, 250, '', false, false, 0, false, false, false);
			$this->Ln(10);
			// Set font
			$this->SetFont('helvetica', 'B', 18);
			// Title
			//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
			// $w = 0; abarcar por defecto las 200px lo ancho de la hoja
			// $ln=0(false) ; No pasa a las siguiente linea.
			$this->SetLeftMargin(60);
			$this->Cell(120,15,'REPORTES DE CINTAS MAGNETICAS - DEPTO T.I.', 0,1, 'C', 0, '', 0, false, 'M', 'M');					
			$this->SetLeftMargin(5);
			
	}

	// Page footer
	public function Footer() 
	{
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

} // class MYPDF extends TCPDF {


class imprimirCintas
{
	public function traerImpresionCintas()
	{

		// Traer la información de las Cintas.
		$item = null;
		$valor = null;
		$respuestaCintas = ControladorCintas::ctrMostrarCintas($item,$valor);

// create new PDF document
$pdf = new MYPDF (PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Agrega varias páginas para diferentes maquetaciones.
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ramon');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetTitle("Reportes Desde TCPDF"); // Titulo en la pestaña del Navegador.
$pdf->setPrintHeader(True);
$pdf->setPrintFooter(True);

$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//$pdf->SetFont('times','B',15); // Cambia la fuente a todo el reporte.
$pdf->SetLeftMargin(5);
//$pdf->SetRightMargin(5);
//$pdf->startPageGroup();
$pdf->AddPage();


// El primer bloque de la maquetacion
// Dentro de esta seccion se pueden utilizar tab sin problemas
// Se recomienda utilizar tablas para trabajar en TCPDF
// Ancho maximo para la hoja carta es de 540 pixeles.
// Se debe revisar la longuitud cuando se colocan los titulos en la hoja.

$pdf->Ln(8); // Para que quede pegada las tablas de Encabezado y 
$pdf->Ln(10);
// 37 Renglones por hoja
$contador = 0;

foreach ($respuestaCintas as $key => $item)
{
	$contador++;

	if ($contador==37)
	{
		$contador = 1;

	}

	if ($contador == 1) 
	{
		
		$bloque2 = <<<EOF
		<!-- Imprime los encabezados de las ventas -->

		<table style="font-size:9px; padding:3px 5px;">
			<tr>
				<!-- <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Num. Serial</td> -->
				<td style="border: 1px solid #666; background-color:yellow; width:80px; text-align:center">Num. Serial</td>
				<td style="border: 1px solid #666; background-color:yellow; width:80px; text-align:center">Fecha Inicio</td>
				<td style="border: 1px solid #666; background-color:yellow; width:80px; text-align:center">Fecha final</td>
				<td style="border: 1px solid #666; background-color:yellow; width:90px; text-align:center">Ubicacion</td>
				<td style="border: 1px solid #666; background-color:yellow; width:220px; text-align:center">Comentarios</td>			
			</tr>		
		</table>
		EOF;

		$pdf->writeHTML($bloque2,false,false,false,false,'');

	}


	$bloque3 = <<<EOF
			<!-- <table style="font-size:10px; padding:5px 10px;"> -->
		<table style="font-size:9px; padding:3px 5px;">
	
			<tr>
				
				<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
					$item[num_serial]
				</td>
	
				<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
					$item[fecha_inic]
				</td>
	
				<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[fecha_final]
				</td>
	
				<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center"> 
				$item[ubicacion]
				</td>

				<td style="border: 1px solid #666; color:#333; background-color:white; width:220px; text-align:center"> 
				$item[comentarios]
				</td>

	
			</tr>
	
		</table>
		
	EOF;
	
	$pdf->writeHTML($bloque3, false, false, false, false, '');

	/*
	if ($contador==37)
	{
		$contador = 0;
	}
	*/

} //foreach ($respuestaCintas as $key => $item)

// $pdf->AddPage();

// Para imprimir las Cintas.
$pdf->Output('cintas.pdf');

	} // public function traerImpresionFactura()

} // class imprimirFactura

$cintas = new imprimirCintas();
//$factura->codigo = '10'; //$_GET["codigo"];
$cintas->traerImpresionCintas();


?>

