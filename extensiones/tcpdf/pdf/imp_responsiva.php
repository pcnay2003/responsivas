<?php
	/*
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
	*/
	
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


class imprimirResponsiva
{
// Se utiliza para obtener el valor de la variable Global $_GET["idResponsiva"] que se pasa en la URL de "responsivas.js" (window.open("extensiones/tcpdf/pdf/responsiva.php?idResponsiva="+id_Responsiva,"_blank"))
public $id_Responsiva;
public function traerImpresionResponsiva()
{

	// Traer la informacion de la Responsiva.
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	$tabla = "t_Responsivas";
	$item = "id_responsiva";
	$valor_responsiva = $this->id_Responsiva;
	$ordenar = "ConsultaSencilla";

	
	$respuestaResponsiva = ControladorResponsivas::ctrMostrarResponsivas($item,$valor_responsiva,$ordenar);

	// Funciona este "var_dump" en TCPDF, solo que no despliega el PDF
	//var_dump($respuestaResponsiva["productos_asignado"]);
	
	//$fecha_asig = date("Y-m-d",strtotime($_POST["nuevaFechaAsignado"]));
	
	$Comentario = "Comentarios : ".$respuestaResponsiva["comentario"];
	$productosResp = json_decode($respuestaResponsiva["productos"],true);
	$neto = number_format($respuestaResponsiva["neto"],2);
	$impuesto = number_format($respuestaResponsiva["impuesto"],2);
	$total = number_format($respuestaResponsiva["total"],2);
	//$total = $respuestaResponsiva["total"];
	$fecha_asignadoResp = date("m-d-Y",strtotime($respuestaResponsiva["fecha_asignado"]));

	if ($respuestaResponsiva["fecha_devolucion"] == null)
	{
		$fecha_devolucionResp = "";
		$fechas = $fecha_asignadoResp.$fecha_devolucionResp;
	}
	else
	{
		$fecha_devolucionResp = date("m-d-Y",strtotime($respuestaResponsiva["fecha_devolucion"]));
		$fechas = $fecha_asignadoResp.' - '.$fecha_devolucionResp;
	}

//	var_dump($productosResp[0]["id"]);

	// Traer la informacion del Empleado
	$itemEmp = "id_empleado";
	$valorEmp = $respuestaResponsiva["id_empleado"];	
	$respuestaEmp = ControladorEmpleados::ctrMostrarEmpleadosImpResp($itemEmp,$valorEmp);
	
	// Traer la informacion del Usuario.
	$itemUsuario = "id_usuario";
	$valorUsuario = $respuestaResponsiva["id_usuario"];
	$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);



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
						Responsiva No. $valor_responsiva
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
					Recibo De Propiedad De La Compañia NPA De Mexico, S. de R.L. De C.V.
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


// Imprimira los datos del Empleado.
$bloque2 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:135px">
				NTI: $respuestaEmp[ntid]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:405px">
				Nombre : $respuestaEmp[nombre]  $respuestaEmp[apellidos]
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:240px">
				Depto : $respuestaEmp[depto]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:200px">
				E-Mail : $respuestaEmp[correo_electronico]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:100px">
				CC. : $respuestaEmp[num_centro_costos]
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:200px">
				Puesto : $respuestaEmp[puesto]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:220px">
				Jefe : $respuestaEmp[supervisor]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:120px">
				Fecha : $fecha_asignadoResp
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:540px text-align:center;
			color:green">
				<div style="font-size:12.5px; text-align:center; line-height:15px;">							
					Entrego Por :$respuestaUsuario[nombre]
				</div>
			</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');

// Imprimira los Encabezados de los renglones de las responsivas.
/*
$bloque3 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:45px; text-align:center">Cant</td>
			<td style="border:1px solid #666;background-color:white; width:95px; text-align:center">Componente</td>
			<td style="border:1px solid #666;background-color:white; width:210px; text-align:center">Descripcion</td>
			<td style="border:1px solid #666;background-color:white; width:110px; text-align:center">Serial</td>
			<td style="border:1px solid #666;background-color:white; width:80px; text-align:center">Costo</td>
		</tr>

	</table>
*/
$bloque3 = <<<EOF
	<table style="font-size:9px; padding:2px 2px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:25px; text-align:left">Cant</td>
			<td style="border:1px solid #666;background-color:white; width:85px; text-align:left">Componente</td>
			<td style="border:1px solid #666;background-color:white; width:140px; text-align:left">Descripcion</td>
			<td style="border:1px solid #666;background-color:white; width:95px; text-align:left">Serial</td>
			<td style="border:1px solid #666;background-color:white; width:75px; text-align:left">Nomenclatura</td>
			<td style="border:1px solid #666;background-color:white; width:75px; text-align:left">Asset</td>
			<td style="border:1px solid #666;background-color:white; width:45px; text-align:right">Costo</td>
		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque3,false,false,false,false,'');


/* De esta manera NO Funciona
foreach ($productosResp as $key => $item)
{
	$itemProducto = "id_producto";
	$valorIdProducto = $item["id"]; // Id del Producto a buscar.
	//var_dump ($productosResp["id"]);

	//$respuestaProductos = ControladorProductos::ctrMostrarProductos($itemProducto,$valorIdProducto);

	// Imprimira el Contenido de los renglones de las responsivas.
*/

// Se van a recoger los productos que se encuentran en el campo de tipo Json en la Base de datos.
$contador = 0;
$cadena = 'S';
$NumTelMacImei = '';

for ($i =0;$i<count($productosResp);$i++)
{
	$itemProducto = "id_producto";
	$valorIdProducto = $productosResp[$i]["id"];
	//print_r ($productosResp[$i]["id"]);
	//var_dump($productosResp[$i]["id"]);
	
	$respuestaProductos = ControladorProductos::ctrMostrarProductos($itemProducto,$valorIdProducto);
	
	$cantidad = $productosResp[$i]["cantidad"];
	$precio = number_format(($cantidad*$productosResp[$i]["precio"]),2);

	/*print_r ("Direccion Mac : \n",$respuestaProductos["direcc_mac_tel"]);
	print_r ("IMEI Tel : \n",$respuestaProductos["imei_tel"]);
	print_r ("Num Tel : \n",$respuestaProductos["num_tel"]);
*/

	if (($cadena == 'S') && (!empty($respuestaProductos["direcc_mac_tel"]) || !empty($respuestaProductos["imei_tel"])))
	{
		/*
		$NumTel= $respuestaProductos["num_tel"];
		$WifiAddr = $respuestaProductos["direcc_mac_tel"];
		$Imei = $respuestaProductos["imei_tel"];
		*/
		$NumTelMacImei = "Num Tel : ".$respuestaProductos["num_tel"]." ; "."IMEI : ".$respuestaProductos["imei_tel"]."  ;  "."Wifi Address : ".$respuestaProductos["direcc_mac_tel"];
		$cadena = 'N';

	}

	
	//$precio = $respuestaProductos["Precio_Venta"];

	// <table style="font-size:10px; padding:5px 10px;">
$bloque4 = <<<EOF
	<table style="font-size:9px; padding:2px 2px;">
		<tr>
			<td style="border:1px solid #666;background-color:white; width:25px; text-align:left">
				$cantidad
			</td>
			<td style="border:1px solid #666;background-color:white; width:85px; text-align:left">
				$respuestaProductos[Periferico]
			</td>
			<td style="border:1px solid #666;background-color:white; width:140px; text-align:left">
				$respuestaProductos[Marca] $respuestaProductos[Modelo]
			</td>
			<td style="border:1px solid #666;background-color:white; width:95px; text-align:left">
				$respuestaProductos[Serial]
			</td>
			<td style="border:1px solid #666;background-color:white; width:75px; text-align:left">
				$respuestaProductos[nomenclatura]
			</td>			
			<td style="border:1px solid #666;background-color:white; width:75px; text-align:left">
				$respuestaProductos[asset]
			</td>			
			<td style="border:1px solid #666;background-color:white; width:45px; text-align:right">
				$precio
			</td>			
		</tr>

	</table>
EOF;

$pdf->writeHTML($bloque4,false,false,false,false,'');

} // for ($i =0;$i<count($productosResp);$i++)

// <td style="color:#333; background-color:white; width:350px; text-align:center"></td>			
//<tr>			
//<td style="border-bottom: 1px solid #666; background-color:white; width:80px; text-align:center"></td>			
//<td style="border-bottom: 1px solid #333; background-color:white; width:110px; text-align:center"></td>			
//</tr>

// Imprimir el total de la Responsiva 
/* Para insertar una columna de 350 para posicionar las columnas de "Importe" y "Total",
45 + 95 + 210 = 350 que son las sumnas de las tres columnas de la tabla donde se imprime los productos de las responsiva.

			<td style="background-color:white; width:350px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>

*/

$bloque5 = <<<EOF
	<table style ="font-size:9px; padding:2px 2px;">
		<tr>
			<td style="background-color:white; width:419.7px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>

			<td style="border: 1px solid #666; background-color:white; width:75px; text-align:right">
	
			Importe:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:45px; text-align:right">
				$total
			</td>
		</tr>	
	</table>

EOF;
$pdf->writeHTML($bloque5,false,false,false,false,'');

// Imprimir el texto y la seccion de firmas
/*
<td style="background-color:white; width:190px">
<div style="font-size:10.5px; text-align:right; line-height:10px;">	
	Hostname : $impHostname
</div>
</td>
*/

// Num. Tel : $respuestaProductos[num_tel] , IMEI : $respuestaProductos[imei_tel] , Wifi Addrress : $respuestaProductos[direcc_mac_tel]

$bloque6 = <<<EOF
	<table>	
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
			</div>
		</td>
		</tr>
		<tr>		
			<td style="background-color:white; width:500px; text-align:left">
				<div style="font-size:10.5px; text-align:left line-height:10px;">	
					$Comentario
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
			<td style="background-color:white; width:500px; text-align:left">
				<div style="font-size:10.5px; text-align:left line-height:10px;">	
					$NumTelMacImei
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:140px; text-align:left">
				<div style="font-size:10.5px; text-align:left line-height:10px;">	
					Modalidad : $respuestaResponsiva[modalidad_entrega]
				</div>
			</td>
			<td style="background-color:white; width:210px; text-align:left">
				<div style="font-size:10.5px; text-align:left line-height:10px;">	
					Fecha : $fechas	
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
			<div style="font-size:10.0px; text-align:left; line-height:15px;">	
			*** CUANDO SE ENTREGA UN EQUIPO DE PRESTAMO *** Comentario :
				<br>
				_________________________________________________________________________________________________

			</div>			
		</td>		
	</tr>	
<tr>
	<td style="background-color:white; width:270px">
		<div style="font-size:10.0px; text-align:center; line-height:15px;">	
			ENTREGO
			<br>
			_________________________________
			<br>
			Nombre Completo, Firma y Fecha

		</div>			
	</td>		
	<td style="background-color:white; width:270px">
		<div style="font-size:10.0px; text-align:center; line-height:15px;">	
			RECIBIO			
			<br>
			_________________________________
			<br>
			Nombre Completo, Fecha y Fecha

		</div>			
	</td>		
</tr>
</table>
<table>
	<tr>
		<td style="background-color:white; width:540px">
			<div style="font-size:8.5px; text-align:right; line-height:10px;">	
			</div>
		</td>
	</tr>
	<tr>
		<td style="background-color:white; width:540px">
			<div style="font-size:10.0px; text-align:left; line-height:15px;">	
				*** RECIBI EQUIPO Y/O ACCESORIOS DE COMPUTO ***
				Reconozco que recibo el equipo antes mencionado como propiedad de la empresa. Covengo en mantener el equipo en buenas condiciones y regresarlo cuando deje de laborar oara la empresa, o si los represenante de la misma lo requieran.
					Prometo reportar cualquier pérdida o daño inmediatamente. Estoy de acuerdo en utilizar dicha propiedad solo para propósitos relacionados con el trabajo.CONCUERDO EN CUBRIR HASTA EL VALOR ESPECIFICO O EL DEDUCIBLE SEGUN APLIQUE, EN CASO DE PERDIDA, DAÑO Y/O ROBO DEL EQUIPO
			</div>			
		</td>		
	</tr>
	<tr>
		<td style="background-color:white; width:540px">
			<div style="font-size:12.0px; text-align:center; line-height:15px;">	
					A T E N T A M E N T E					
				<br>
			</div>			
		</td>		
	</tr>
	<tr>
	<td style="background-color:white; width:270px">
		<div style="font-size:10.0px; text-align:center; line-height:15px;">	
			
			_______________________________________
			<br>
			Nombre Completo, Firma Del Empleado y Fecha

		</div>			
	</td>		
	<td style="background-color:white; width:270px">
		<div style="font-size:10.0px; text-align:center; line-height:15px;">	

		________________________________________
			<br>
			Nombre Completo , Firma Del Supervisor y Fecha

		</div>			
	</td>		
</tr>

</table>


EOF;
$pdf->writeHTML($bloque6,false,false,false,false,'');



// Salida del Archivo.
$pdf->Output ('Responsiva-'.$valor_responsiva.'.pdf');
 
} // public function traerImpresionResponsiva()

} // class imprimirResponsiva

$responsiva = new imprimirResponsiva();
$responsiva->id_Responsiva = $_GET["idResponsiva"];
$responsiva->traerImpresionResponsiva();


/*

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

$html = <<<EOF

<img src="images/image_demo.jpg" style="width:300px">

EOF;

$pdf->writeHTML($html, false, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('pdf.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
  ?>
 */

 ?>