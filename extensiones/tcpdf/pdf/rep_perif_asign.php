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
require_once ('tcpdf_include.php');
require_once "../../../controladores/responsivas.controlador.php";
require_once "../../../modelos/responsivas.modelo.php"; 	
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


// No se debe tabular las lineas de codigo.

class imprimirPerifAsign
{
// Se utiliza para obtener el valor de la variable Global $_GET["idResponsiva"] que se pasa en la URL de "responsivas.js" (window.open("extensiones/tcpdf/pdf/responsiva.php?idResponsiva="+id_Responsiva,"_blank"))
public $id_NumEmp;

public function ObtenerPerifAsign()
{
	date_default_timezone_set('America/Tijuana');
	$fecha_actual = date("m-d-Y");

	// Traer la informacion de la Responsiva.
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	
	$item = "id_empleado";
	$valor_emp = $this->id_NumEmp;
	$respuestaResponsiva = ControladorResponsivas::ctrMostrarResponsivasPerifAsign($item,$valor_emp);

	//$productosResp = json_decode($respuestaResponsiva[0]["productos"],true);
	// Funciona este "var_dump" en TCPDF, solo que no despliega el PDF

	//var_dump($respuestaResponsiva[0]["num_folio"]);
	//var_dump($respuestaResponsiva);
	//var_dump($productosResp);

	//Se utiliza arreglos bidimencional porque en la consulta esta retornando varios elementos,

	// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Para que permita varias paginas
$pdf->startPageGroup();
$pdf->AddPage();

// Crear un primer bloque de maquetacion.
// En esta parte se puede utiizar las tabulaciones.
// Los estilos se colocan en linea, es decir en esta parte.

$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:160px;"><img src="images/logo_jabil1.png"></td>
			<td style="background-color:white; width:255px">
				<div style="font-size:9.0px; text-align:left; line-height:15px;">	
					       No. Maquila : 411 Baja	
					<br>
								    Blvd. Terarn Teran No. 20662 L-388 Fracc. 
								 Murua Oriente,      Tel.: 999-999-99-99, email:info@jabil.com
					<br>
								 Tijuana, B.C. Mexico
						     
				</div>
			</td>
			<td style="background-color:white; width:120px; text-align:right; color:red">				
				<div style="font-size:12.5px; text-align:right; line-height:15px;">				
						Fecha : $fecha_actual
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:13.5px; color:blue; text-align:center; line-height:15px;">
					EQUIPO Y ACCESORIOS DE COMPUTO ASIGNADO AL EMPLEADO
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');
/*
	Para insertar un espacio en la hoja 
 	<table>
		<tr>
		<td style="width:540px"><img src="images/back.jpg"></td>
	</tr>
</table>


*/


// Imprimir las responisvas asignadas al Empleado 
$total = 0;
for ($i =0;$i<count($respuestaResponsiva);$i++)
{
	$fecha_asignadoResp = date("m-d-Y",strtotime($respuestaResponsiva[$i]["fecha_asignado"]));
	$num_resp = $respuestaResponsiva[$i]["num_folio"];

	$bloque2 = <<<EOF
		<table style="font-size:11px; padding:5px 10px; color:green">
			<tr>
				<td style="background-color:white; width:135px">
					No. Responsiva : $num_resp
				</td>
				<td  style="background-color:white; width:200px,color:green">
					Fecha Asignada : $fecha_asignadoResp
				</td>
			</tr>
			<tr>
				<td style="border:1px solid #666;background-color:white; width:45px; text-align:center;color:black">Cant</td>
				<td style="border:1px solid #666;background-color:white; width:95px; text-align:center;color:black">Componente</td>
				<td style="border:1px solid #666;background-color:white; width:210px; text-align:center;color:black">Descripcion</td>
				<td style="border:1px solid #666;background-color:white; width:110px; text-align:center;color:black">Serial</td>
				<td style="border:1px solid #666;background-color:white; width:80px; text-align:center;color:black">Costo</td>		
			</tr>			
		</table>
	
	EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');

// pasando de JSon a Arreglos para que PHP los pueda imprimir
$productosResp = json_decode($respuestaResponsiva[$i]["productos"],true);

for ($n =0;$n<count($productosResp);$n++)
{
	$cantidad = $productosResp[$n]["cantidad"];
	$total = $total+$productosResp[$n]["precio"];

	$precio = number_format($productosResp[$n]["precio"],2);

	// Obtener el "Periferico" y el "Serial"
	$item = "id_producto";
	$valor = $productosResp[$n]["id"];
	$producto = ControladorProductos::ctrMostrarProductos($item,$valor);

$bloque3 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:45px; text-align:center">
				$cantidad
			</td>
			<td style="border:1px solid #666;background-color:white; width:95px; text-align:center">
				$producto[Periferico]
			</td>
			<td style="border:1px solid #666;background-color:white; width:210px; text-align:center">
				$producto[Marca] $producto[Modelo]
			</td>
			<td style="border:1px solid #666;background-color:white; width:110px; text-align:center">
				$producto[Serial]
			</td>
			<td style="border:1px solid #666;background-color:white; width:80px; text-align:right">
				$precio
			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3,false,false,false,false,'');

} // for ($n =0;$n<count($productosResp);$n++)

/*
echo '<br>';
/*
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>
		</tr>

*/
} // for ($i =0;$i<count($respuestaResponsiva);$i++)

//number_format($productosResp[$n]["precio"],2);
if (count($respuestaResponsiva) != 0)
{ 
	$granTotal = number_format($total,2);
	$bloque4 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="background-color:white; width:460px; text-align:rigth">
				TOTAL $
			</td>
			<td style="border:1px solid #666;background-color:white; width:80px; text-align:right">
				$granTotal
			</td>
		</tr>
	</table>

	EOF;
	$pdf->writeHTML($bloque4,false,false,false,false,'');
}

// Salida del Archivo.
$pdf->Output ('PerifAsign-'.$_GET["num_Emp"].'.pdf');
 
} // public function traerImpresionResponsiva()

} // class imprimirResponsiva

$perif_asign = new imprimirPerifAsign();
$perif_asign->id_NumEmp = $_GET["num_Emp"];
$perif_asign->ObtenerPerifAsign();

?>