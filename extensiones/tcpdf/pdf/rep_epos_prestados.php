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
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class Epos_Prestados
{

public $id_NumSerie;
public function ObtenerEposPrestados()	
{

	date_default_timezone_set('America/Tijuana');
	$fecha_actual = date("m-d-Y");
	
	
// Traer la informacion del Periferico en Productos
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	
	// Obtiene el "id_producto" del serial a Buscar.
	$respuestaResponsivas = ControladorResponsivas::ctrMostrarRespEposPrestados();
	//var_dump($respuestaResponsivas);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Para que permita varias paginas
$pdf->startPageGroup();
$pdf->AddPage('L'); // Para cambiar la orientacion a Horizontal 'Landscape'
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
				<td style="background-color:white; width:380px; text-align:right; color:red">				
					<div style="font-size:12.5px; text-align:right; line-height:15px;">				
							Fecha : $fecha_actual
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:810px">
					<div style="font-size:8.5px; text-align:right; line-height:10px;">	
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:810px">
					<div style="font-size:13.5px; color:blue; text-align:center; line-height:15px;">
						E Q U I P O S  E N  P R E S T A M O S  
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:810px">
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
			<td style="border:1px solid #666;background-color:white; width:180px; text-align:left">
				<strong>Nombre Completo</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:40px; text-align:left">
				<strong>Resp</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:130Px; text-align:left">
				<strong>Periferico</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:115px; text-align:left">
				<strong>Serial</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:115px; text-align:left">
				<strong>Modelo</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:60px; text-align:left">
				<strong>F. Entrega</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:60px; text-align:left">
				<strong>F. Devol</strong>
			</td>
			<td style="border:1px solid #666;background-color:white; width:45px; text-align:left">
				<strong>Vencido</strong>
			</td>
		</tr>		
	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');

	for ($i=0;$i<count($respuestaResponsivas);$i++)
	{
		$productos = json_decode($respuestaResponsivas[$i]["productos"],true);
				
		// Obtener el contenido de la responsiva.
		for ($n=0;$n<count($productos);$n++)
		{			
			//print_r ($id_ProductoResp);
			//echo "<br>";

			// Obtener los datos del periferico como : Nombre, Serial, Modelo
			$item = "id_producto";
			$valor = $productos[$n]["id"];
			$perifericos = ControladorProductos::ctrMostrarProductos($item,$valor);


		
		// Imprimir el contenido de los equipos prestado al empleado.
		
		// Obtener los datos del empleado
		//$item = "id_empleado";
		//$valor = $respuestaResponsivas[$i]["id_empleado"];
		//$orden = "apellidos";
		//$empleado = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
		$ntid_emp = $respuestaResponsivas[$i]["ntid"];
		$nombre_emp = $respuestaResponsivas[$i]["nombre"].' '.$respuestaResponsivas[$i]["apellidos"];
		$num_folio = $respuestaResponsivas[$i]["num_folio"];
		$periferico = $perifericos["Periferico"];
		$num_serie = $perifericos["Serial"];
		$modelo = $perifericos["Modelo"];
		
		$fecha_asig = date("m-d-Y",strtotime($respuestaResponsivas[$i]["fecha_asignado"]));

		if ($respuestaResponsivas[$i]["fecha_devolucion"] != null)
		{
			$fecha_devol = date("m-d-Y",strtotime($respuestaResponsivas[$i]["fecha_devolucion"]));
		}
		else
		{
			$fecha_devol = null;
		}

		// Calculando la diferencias de dias 
		//echo "Diferencias de dias ";

		$f_devolucion = new DateTime($respuestaResponsivas[$i]["fecha_devolucion"]);

		$fecha_actual = date('Y-m-d');

		$fecha_hoy = date_create($fecha_actual);
		
		//$date2 = date('Y-m-d');

	
		$interval = date_diff($f_devolucion,$fecha_hoy);

		// Imprimiendo por usuario lo que tiene prestado

		/*
		$dias_vencidos = $interval->format('%a');
		if ($dias_vencidos > 0)
		{
			$rangos = '0'." Dias";
		}
		else
		{
			$rangos = $interval->format('%a')." Dias ";
		}
	
		$vencido = $rangos;
*/
		if (($respuestaResponsivas[$i]["fecha_devolucion"] < $fecha_actual) && ($respuestaResponsivas[$i]["activa"]=='S'))
		{
			$vencido = $interval->format('%a')." Dias ";
		}
		else
		{
			$vencido = '0'." Dias";
		}

		$bloque3 = <<<EOF
		<table style="font-size:10px; padding:3px 3px;">
			<tr>
				<td style="border:1px solid #666;background-color:white; width:50px; text-align:left">
					$ntid_emp
				</td>
				<td style="border:1px solid #666;background-color:white; width:180px; text-align:left">
					$nombre_emp
				</td>
				<td style="border:1px solid #666;background-color:white; width:40px; text-align:left">
					$num_folio
				</td>
				<td style="border:1px solid #666;background-color:white; width:130px; text-align:left">
					$periferico
				</td>
				<td style="border:1px solid #666;background-color:white; width:115px; text-align:left">
					$num_serie
				</td>
				<td style="border:1px solid #666;background-color:white; width:115px; text-align:left">
					$modelo
				</td>
				<td style="border:1px solid #666;background-color:white; width:60px; text-align:left">
					$fecha_asig
				</td>
				<td style="border:1px solid #666;background-color:white; width:60px; text-align:left">
					$fecha_devol
				</td>
				<td style="border:1px solid #666;background-color:white; width:45px; text-align:left">
					$vencido
				</td>
			</tr>		
		</table>
	
	EOF;
	
	$pdf->writeHTML($bloque3,false,false,false,false,'');



		} // for ($n=0;$n<count($productos);$n++)

	} // for ($i=0;$i<count($respuestaResponsivas);$i++)




// Salida del Archivo.
$pdf->Output ('EposPrestados-'.'pdf');

	} // public function ObtenerEposPrestados())		

} // class Epos_Prestados()

$obtiene_perif = new Epos_Prestados();
$obtiene_perif->ObtenerEposPrestados();

?>

