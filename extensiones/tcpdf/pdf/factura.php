<?php
// Para llegar a este archivo, se regresan tres carpetas : /pdf/tcpdf/extenciones

require_once("../../../controladores/ventas.controlador.php");
require_once("../../../modelos/ventas.modelo.php");

require_once("../../../controladores/clientes.controlador.php");
require_once("../../../modelos/clientes.modelo.php");

require_once("../../../controladores/usuarios.controlador.php");
require_once("../../../modelos/usuarios.modelo.php");

require_once("../../../controladores/productos.controlador.php");
require_once("../../../modelos/productos.modelo.php");

// Include the main TCPDF library (search for installation path).
// Se debe respetar esta alineacion a la izquierda.
require_once('tcpdf_include.php');

 
class imprimirFactura
{
	public $codigo;
	public function traerImpresionFactura()
	{

		// Traer la información de la Venta.
		$itemVenta = "codigo";
		$valorVenta = $this->codigo;
		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta,$valorVenta);
		$fecha = substr($respuestaVenta["fecha"],0,-8); // Le quita la hora al campo 
		
		// Viene en formato Json, es la venta realizada, lo decofica pasando a Arreglo.
		$productos = json_decode($respuestaVenta["productos"],true);
		$neto = number_format($respuestaVenta["neto"],2);
		$impuesto = number_format($respuestaVenta["impuesto"],2);
		$total = number_format($respuestaVenta["total"],2);

		// Traer información del Cliente.
		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];
		$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

		// Traer información del Vendedor.
		$itemVendedor = "id";
		$valorVendedor = $respuestaVenta["id_vendedor"];
		$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor,$valorVendedor);



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Agrega varias páginas para diferentes maquetaciones.
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
		
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					NIT:71.759.963-9
					<br>
					Dirección: Calle 44B 92-11
				</div>
			</td>
		</tr>


	</table>

EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');


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

/*
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
*/



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

//	} // foreach ($productos as $key => $item)


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
$pdf->Output('factura.pdf');

	} // public function traerImpresionFactura()

} // class imprimirFactura

$factura = new imprimirFactura();
//$factura->codigo = '10'; //$_GET["codigo"];
$factura->traerImpresionFactura();



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

