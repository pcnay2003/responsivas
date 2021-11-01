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
			$image_file = K_PATH_IMAGES.'logo_jabil2.jpg';
			$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 150, '', false, false, 0, false, false, false);
			// Set font
			$this->SetFont('helvetica', 'B', 20);
			// Title
			$this->Cell(0, 15, 'REPORTES DE CINTAS MAGNETICAS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
		//var_dump($respuestaCintas);
		//exit;


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Agrega varias páginas para diferentes maquetaciones.
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ramon');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 004', PDF_HEADER_STRING);

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
$pdf->SetRightMargin(5);
$pdf->startPageGroup();
$pdf->AddPage();


// El primer bloque de la maquetacion
// Dentro de esta seccion se pueden utilizar tab sin problemas
// Se recomienda utilizar tablas para trabajar en TCPDF
// Ancho maximo para la hoja carta es de 540 pixeles.
// Se debe revisar la longuitud cuando se colocan los titulos en la hoja.

$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>			
			<td style="background-color:white; width:390px">
				<div style="font-size:15px; text-align:center; line-height:20px;">
					<br>
					REPORTES DE CINTAS MAGNETICAS 
				</div>
			</td>
		</tr>
	</table>
	<!-- Para insertar espacios entre cada tabla  -->
	<table>
		<tr>
			<td>
			</td>
		</tr>
	</table>


EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');

/*
$bloque2 = <<<EOF
	<!-- Imprime los encabezados de las ventas -->
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Num. Serial</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Fecha Inicio</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Fecha final</td>
			<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Ubicacion</td>
			<td style="border: 1px solid #666; background-color:white; width:210px; text-align:center">Comentarios</td>
			
		</tr>
		
	</table>


EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');


foreach ($respuestaCintas as $key => $item)
{
	$bloque3 = <<<EOF
	
		<table style="font-size:10px; padding:5px 10px;">
	
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

				<td style="border: 1px solid #666; color:#333; background-color:white; width:210px; text-align:center"> 
				$item[comentarios]
				</td>

	
			</tr>
	
		</table>
		
	EOF;
	
	$pdf->writeHTML($bloque3, false, false, false, false, '');
	
	}
*/

$pdf->SetFont ('helvetica','B',9);
$image_file = K_PATH_IMAGES.'logo_jabil1.png';
$pdf->Image($image_file,10,10,10,'','PNG','','T',false,200,'',false,false,0,false,false);
//$image_file = K_PATH_IMAGES.'logo_jabil2.jpg';
//$pdf->Image($image_file,10,10,10,'','JPG','','T',false,200,'',false,false,0,false,false);


//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// $w = 0; abarcar por defecto las 200px lo ancho de la hoja
// $ln=0(false) ; No pasa a las siguiente linea.

$pdf->Ln(10);
$pdf->Cell(200,5,'TEXTO ESCRITO UTILIZANDO -CELL- ABARCA TODA LA HOJA',1,1,'L',0,'',0,false,'M','M');
//$pdf->Ln(10);
$pdf->Cell(100,5,'TEXTO ESCRITO UTILIZANDO -CELL- SOLO 1/2',1,1,'C',0,'',0,false,'M','M');
//$pdf->Ln(10);
$pdf->Cell(50,5,'TEXTO 1/4 Reng',1,1,'C',0,'',0,false,'M','M');
//$pdf->Ln(10);
$pdf->SetLeftMargin(105);
$pdf->Cell(50,5,'TEXTO 1/4 Reng',1,1,'C',0,'',0,false,'M','M');
$pdf->SetLeftMargin(5);
$inf = "Reportes Generales";

// Otra manera de desplegar los datos.
foreach ($respuestaCintas as $rows)
{
	$pdf->Ln(12);
	$pdf->Cell(0,8,'NUMERO SERIAL '.$rows[1],0,false,'L',0,'',0,false,'M','M');
	$pdf->Ln(3);
	/*
	$pdf->Cell(0,8,'FECHA INICIO',0,0);
	$pdf->Ln(4);
	$pdf->Cell(0,8,'FECHA FINAL',0,0);
	$inf = "INFORMACION CINTAS";
	*/
	$pdf->writeHTML($inf,true,false,false,false,'C');

} // foreach ($respuestaCintas as $key => $item)

// Para imprimir las Cintas.
$pdf->Output('cintas.pdf');

	} // public function traerImpresionFactura()

} // class imprimirFactura

$cintas = new imprimirCintas();
//$factura->codigo = '10'; //$_GET["codigo"];
$cintas->traerImpresionCintas();



/*
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: 71.759.963-9

					<br>
					Dirección: Calle 44B 92-11

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 300 786 52 49
					
					<br>
					ventas@inventorysystem.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf', 'D');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

*/

?>

