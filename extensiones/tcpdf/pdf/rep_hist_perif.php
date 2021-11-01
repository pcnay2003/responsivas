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
//require_once "../../../controladores/perifericos.controlador.php";
//require_once "../../../modelos/perifericos.modelo.php";
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirHistPerif
{

public $id_NumSerie;
public function ObtenerHistPerif()	
{
	date_default_timezone_set('America/Tijuana');
	$fecha_actual = date("m-d-Y");
	
	
// Traer la informacion del Periferico en Productos
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	
	// Obtiene el "id_producto" del serial a Buscar.
	$item = "num_serie";
	$valor_serie = $this->id_NumSerie;
	$respuestaProducto = ControladorProductos::ctrMostrarProductos($item,$valor_serie);
	//var_dump($respuestaProducto);

	$idProd_prod = $respuestaProducto["id_producto"];	
	// print_r("Id Producto ".$id_Producto."\n");

	// Obtener el Periferico.	
	//$item = "id_periferico";
	//$valor = $respuestaProducto["id_periferico"];
	//$perifericos = ControladorPerifericos::ctrMostrarPerifericos($item,$valor); 
	$nombre_periferico = $respuestaProducto["Periferico"];	;

	
	// Obtener todas las responsivas.
	$tabla = "t_Responsivas";	
	$respuestaResponsivas = ModeloResponsivas::mdlMostrarRespHistPerif($tabla);
	//var_dump($respuestaResponsivas);

	// Buscar en todas las responsivas si existe este numero de Producto.
	$perif_asignado = array();
	$contador = 0;
	for ($i =0;$i<count($respuestaResponsivas);$i++)
	{
		//$fecha_asignadoResp = date("m-d-Y",strtotime($respuestaResponsiva[$i]["fecha_asignado"]));
		$productos = json_decode($respuestaResponsivas[$i]["productos"],true);
		
		for ($n =0;$n<count($productos);$n++)
		{
			// Obtiene los "Id" de los productos que se tienen en los renglones de las responsivas.
			$id_ProductoResp = $productos[$n]["id"];
			//print_r("Id Renglon Resp".$id_ProductoResp);
			//echo "<br>";
			if ($idProd_prod == $id_ProductoResp)
			{
				$perif_asignado[$contador]["id_empleado"] = $respuestaResponsivas[$i]["id_empleado"];
				$perif_asignado[$contador]["fecha_asignado"] = $respuestaResponsivas[$i]["fecha_asignado"];
				$perif_asignado[$contador]["num_folio"] = $respuestaResponsivas[$i]["num_folio"];
				$contador++;
			}

			/*
			// Obtener el "Periferico" y el "Serial"
			$item = "id_producto";
			$valor = $productosResp[$n]["id"];
			$producto = ControladorProductos::ctrMostrarProductos($item,$valor);
			*/

		} // for ($n =0;$n<count($productos);$n++)

	
	} // for ($i =0;$i<count($respuestaResponsivas);$i++)
	
	//var_dump($perif_asignado);
	//print_r($perif_asignado[0]["id_empleado"]);
	//print_r($perif_asignado[1]["id_empleado"]);

	/*
	for ($n =0;$n<count($perif_asignado);$n++)
	{
		
		print_r($perif_asignado[$n]["id_empleado"]);
		echo "<br>";
		print_r($perif_asignado[$n]["num_folio"]);
		echo "<br>";
		print_r($perif_asignado[$n]["fecha_asignado"]);
		echo "<br>";
	}
*/

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Para que permita varias paginas
$pdf->startPageGroup();
$pdf->AddPage();
$pdf->SetLeftMargin(0);

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
						HISTORIAL DE PERIFERICO :  $nombre_periferico - $valor_serie 
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

	$bloque2 = <<<EOF
	<table style="font-size:10px; padding:3px 3px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:50px; text-align:left">
				<strong>NtId</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:210px; text-align:left">
				<strong>Nombre Completo</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:200px; text-align:left">
				<strong>Correo Electronico</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:30px; text-align:left">
				<strong>R</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:65px; text-align:left">
				<strong>F. Resp</strong>
			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');

	for ($n =0;$n<count($perif_asignado);$n++)
	{
		/*
		print_r($perif_asignado[$n]["id_empleado"]);
		echo "<br>";
		print_r($perif_asignado[$n]["num_folio"]);
		echo "<br>";
		print_r($perif_asignado[$n]["fecha_asignado"]);
		echo "<br>";
*/	

		$item = "id_empleado";
		$valor = $perif_asignado[$n]["id_empleado"];
		$orden = "apellidos";
		$obtener_empleado = controladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);

		$ntId = $obtener_empleado["ntid"];
		$nombre_apellido = $obtener_empleado["nombre"].' '.$obtener_empleado["apellidos"];
		$correo_elect = $obtener_empleado["correo_electronico"];

		$num_responsiva = $perif_asignado[$n]["num_folio"];
		$fecha_resp = date("m-d-Y",strtotime($perif_asignado[$n]["fecha_asignado"]));
		
	
	$bloque3 = <<<EOF
	<table style="font-size:10px; padding:3px 3px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:50px; text-align:left">
				$ntId
			</td>
			<td style="border:1px solid #666;background-color:white; width:210px; text-align:left">
				$nombre_apellido
			</td>
			<td style="border:1px solid #666;background-color:white; width:200px; text-align:left">
				$correo_elect
			</td>
			<td style="border:1px solid #666;background-color:white; width:30px; text-align:left">
				$num_responsiva
			</td>
			<td style="border:1px solid #666;background-color:white; width:65px; text-align:left">
				$fecha_resp
			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3,false,false,false,false,'');


} // 	for ($n =0;$n<count($perif_asignado);$n++)

// Salida del Archivo.
$pdf->Output ('HistPerif-'.$_GET["num_serie"].'.pdf');

	} // public function ObtenerHistPerif()		

} // class imprimirHistPerif

$hist_perif = new imprimirHistPerif();
$hist_perif->id_NumSerie = $_GET["num_serie"];
$hist_perif->ObtenerHistPerif();

?>

