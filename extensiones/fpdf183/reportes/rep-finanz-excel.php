
<?php 
	if ($_SESSION["perfil"] == "Operador" )
		{
			echo '
				<script>
					window.location = "inicio";
				</script>';
				return;			
		}
	
  require_once('../fpdf.php');
	require_once('../../../controladores/responsivas.controlador.php');
	require_once('../../../modelos/responsivas.modelo.php');
	require_once('../../../controladores/productos.controlador.php');
	require_once('../../../modelos/productos.modelo.php');
	require_once('../../../controladores/empleados.controlador.php');
	require_once('../../../modelos/empleados.modelo.php');
	require_once('../../../controladores/centro-costos.controlador.php');
	require_once('../../../modelos/centro-costos.modelo.php');
	require_once('../../../controladores/deptos.controlador.php');
	require_once('../../../modelos/deptos.modelo.php');
	require_once('../../../controladores/perifericos.controlador.php');
	require_once('../../../modelos/perifericos.modelo.php');
	require_once('../../../controladores/marcas.controlador.php');
	require_once('../../../modelos/marcas.modelo.php');
	require_once('../../../controladores/modelos.controlador.php');
	require_once('../../../modelos/modelos.modelo.php');
	


class Rep_Finanzas
{
	public $fecha_inic,$fecha_fin;
	public function Obtener_reporte()
	{

		if ($this->fecha_inic > $this->fecha_fin)
		{
			$this->fecha_inic = $this->fecha_fin;
		}
		
		//echo "Fecha Inicio : ".$fecha_inicio;
		//echo "Fecha Final : ".$fecha_final;

		//$datos = array ("fecha_inicial"=>$fecha_inic,
		//								"fecha_final"=>$fecha_fin);
		
		//var_dump($datos);
		$fecha_inic = $this->fecha_inic;
		$fecha_fin = $this->fecha_fin;
		$rangoResponsivas = ControladorResponsivas::ctrMostrarRespRangosFecha($fecha_inic,$fecha_fin);

		//$productosResp = json_decode($rangoResponsivas[1]["productos"],true);
		//var_dump($rangoResponsivas);
		/*
		for ($l=0;$l<count($rangoResponsivas);$l++)
		{
			print_r($rangoResponsivas[$l]["fecha_asignado"].' - ');
			echo "</br>";
		}
		*/

		//print_r(count($rangoResponsivas));

		$total = 0;
		$contador = 0;
		// En este arreglo se agregaran todos los datos del rango de fechas de las responsivas.
		$rep_mensual = array();

		// Ciclo donde se encuentran el rango de las responsivas por Fecha.
		for ($i =0;$i<count($rangoResponsivas);$i++)
		{
			//$fecha_asignadoResp = date("m-d-Y",strtotime($rangoResponsivas[$i]["fecha_asignado"]));	
			$rep_mensual[$contador]["fecha_asignado"] = date("m-d-Y",strtotime($rangoResponsivas[$i]["fecha_asignado"]));
			// Obtener los datos del empleado.			
			$item = "id_empleado";
			$valor = $rangoResponsivas[$i]["id_empleado"];
			$orden = "apellidos";
			$datosEmpleado = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);

			//Agregando los datos del empleado.
			$rep_mensual[$contador]["ntid"] = $datosEmpleado["ntid"];
			$rep_mensual[$contador]["nombre"] = $datosEmpleado["nombre"];
			$rep_mensual[$contador]["apellidos"] = $datosEmpleado["apellidos"];

			// Obteniendo el centro de Costos.
			$item = "id_centro_costos";
			$valor = $datosEmpleado["id_centro_costos"]; 
			$datosCentroCostos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);

			$rep_mensual[$contador]["num_centro_costos"] = $datosCentroCostos["num_centro_costos"];

			//Obteniendo el Depto. del Empleado.
			$item = "id_depto";
			$valor = $datosEmpleado["id_depto"];
			$datosDepto = ControladorDeptos::ctrMostrarDeptos($item,$valor);
			$rep_mensual[$contador]["descrip_depto"] = $datosDepto["descripcion"];

			// pasando de JSon a Arreglos para que PHP los pueda imprimir
			$productosResp = json_decode($rangoResponsivas[$i]["productos"],true);		

			//print_r($productosResp);
			//echo "</br>";
			//print_r(count($productosResp));

			//Se van a revisar cada producto que tiene la responsiva.
			$renglones = 0;
			for ($n =0;$n<count($productosResp);$n++)
			{
				//$cantidad = $productosResp[$n]["cantidad"];
				//$total = $total+$productosResp[$n]["precio"];
			
				//$precio = number_format($productosResp[$n]["precio"],2);
			
				// Obtener los datos del producto
				$item = "id_producto";
				$valor = $productosResp[$n]["id"];
				$producto = ControladorProductos::ctrMostrarProductos($item,$valor);	
				$rep_mensual[$contador]["periferico"] = $producto["Periferico"];
				$rep_mensual[$contador]["marca"] = $producto["Marca"];
				$rep_mensual[$contador]["modelo"] = $producto["Modelo"];
				$rep_mensual[$contador]["num_serie"] = $producto["Serial"];
				$rep_mensual[$contador]["precio_compra"] = $producto["precio_compra"];
				$renglones++;

				if ($renglones < count($productosResp))
				{
					$contador++;
					
					$rep_mensual[$contador]["fecha_asignado"] = $rep_mensual[$contador-1]["fecha_asignado"];
					$rep_mensual[$contador]["ntid"] = $rep_mensual[$contador-1]["ntid"];
					$rep_mensual[$contador]["nombre"] = $rep_mensual[$contador-1]["nombre"];
					$rep_mensual[$contador]["apellidos"] = $rep_mensual[$contador-1]["apellidos"];
					$rep_mensual[$contador]["num_centro_costos"] = $rep_mensual[$contador-1]["num_centro_costos"];
					$rep_mensual[$contador]["descrip_depto"] = $rep_mensual[$contador-1]["descrip_depto"];
					$rep_mensual[$contador]["periferico"] = $rep_mensual[$contador-1]["periferico"];
					$rep_mensual[$contador]["marca"] = $rep_mensual[$contador-1]["marca"];
					$rep_mensual[$contador]["modelo"] = $rep_mensual[$contador-1]["modelo"];
					$rep_mensual[$contador]["num_serie"] = $rep_mensual[$contador-1]["num_serie"];
					$rep_mensual[$contador]["precio_compra"] = $rep_mensual[$contador-1]["precio_compra"];
				}

			} // for ($n =0;$n<count($productosResp);$n++)
			
			$contador++;

		} // for ($i =0;$i<count($rangoResponsiva);$i++)
		/*
		
		for ($m=0;$m<count($rep_mensual);$m++)
		{
			print_r($rep_mensual[$m]["ntid"].' - ');			
			print_r($rep_mensual[$m]["fecha_asignado"].' - ');
			print_r($rep_mensual[$m]["nombre"].' - ');
			print_r($rep_mensual[$m]["apellidos"].' - ');			
			print_r($rep_mensual[$m]["num_centro_costos"].' - ');			
			print_r($rep_mensual[$m]["descrip_depto"].' - ');
			print_r($rep_mensual[$m]["periferico"].' - ');
			print_r($rep_mensual[$m]["marca"].' - ');
			print_r($rep_mensual[$m]["modelo"].' - ');
			print_r($rep_mensual[$m]["num_serie"].' - ');
			print_r($rep_mensual[$m]["precio_compra"].' - ');
			echo "</br>";
		}
		*/

		// Grabarlo a una tabla para poder ordenar por Centro de Costos y fecha.
		$crearRep_Finanzas = new ControladorResponsivas();
		$crearRep_Finanzas->ctrCrearRep_Finanzas($rep_mensual);
				
		$reporte = ControladorResponsivas::ctrMostrarRep_Finanzas();
		$borrar = ControladorResponsivas::ctrBorrarRep_Finanzas();
		
/*
		for ($i=0;$i<count($reporte);$i++)
		{
			print_r($reporte[$i]["fecha_asignado"].' - ');
			print_r($reporte[$i]["num_centro_costos"].' - ');			
			print_r($reporte[$i]["ntid"].' - ');		
			print_r($reporte[$i]["nombre"].' - ');
			print_r($reporte[$i]["apellidos"].' - ');						
			print_r($reporte[$i]["descrip_depto"].' - ');
			print_r($reporte[$i]["periferico"].' - ');
			print_r($reporte[$i]["marca"].' - ');
			print_r($reporte[$i]["modelo"].' - ');
			print_r($reporte[$i]["num_serial"].' - ');
			print_r($reporte[$i]["precio_compra"].' - ');
			echo "</br>";
		}
*/


		/*
		for ($m=0;$m<count($rep_mensual);$m++)
		{
			$ntid = $rep_mensual[$m]["ntid"];
			$stmt = Conexion::conectar()->prepare ("INSERT INTO t_Rep_Finanzas(ntid) VALUES (:ntid)");
			$stmt->bindParam(":ntid",$rep_mensual[$m]["ntid"],PDO::PARAM_STR);

			if ($stmt->execute())			
			{
				// Cerrar la conexion de la instancia de la base de datos.
				print_r("Se grabo el registro");
				//return "ok";				
			}

		} // for ($m=0;$m<count($rep_mensual);$m++)

			$stmt->closeCursor();
			$stmt=null;
		*/

	// ===========================
	// Crear el archivo de Excel
	// ==========================
	$Name = 'ExcelRep_Finanz'.'.xls';
	header('Expires: 0');
	header('Cache-control: private');
	header("Content-type: application/vnd.ms-excel");
	header("Cache-Control: cache, must-revalidate");
	header('Content-Description: File Transfer');
	header('Last-Modified: '.date('D, d M Y H:i:s'));
	header("Pragma: public");
	header('Content-Disposition:; filename="'.$Name.'"');
	header("Content-Transfer-Encoding: binary");

	// Creando la tabla de Excel
	// utf8_decode = Para poder trabajar con tildes, acentos, ñ, Ñ
	// Creando los encabezados de la tabla.
	echo utf8_decode("<table border='0'>
		<tr>
			<td style='font-weight:bold; border:1px solid #eee;'>FECHA ASIGNADO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>NUM CENTRO COSTOS</td>
			<td style='font-weight:bold; border:1px solid #eee;'>NTID</td>
			<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td>
			<td style='font-weight:bold; border:1px solid #eee;'>APELLIDOS</td>
			<td style='font-weight:bold; border:1px solid #eee;'>DEPTO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>PERIFERICO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>MARCA</td>
			<td style='font-weight:bold; border:1px solid #eee;'>MODELO</td>
			<td style='font-weight:bold; border:1px solid #eee;'>SERIAL</td>
			<td style='font-weight:bold; border:1px solid #eee;'>PRECIO COMPRA</td>
		</tr>");

		foreach ($reporte as $row => $item)
		{
			echo utf8_decode("<tr>
				<td style='border:1px solid #eee;'>".$item["fecha_asignado"]."</td>
				<td style='border:1px solid #eee;'>".$item["num_centro_costos"]."</td>
				<td style='border:1px solid #eee;'>".$item["ntid"]."</td>
				<td style='border:1px solid #eee;'>".$item["nombre"]."</td>
				<td style='border:1px solid #eee;'>".$item["apellidos"]."</td>
				<td style='border:1px solid #eee;'>".$item["descrip_depto"]."</td>
				<td style='border:1px solid #eee;'>".$item["periferico"]."</td>
				<td style='border:1px solid #eee;'>".$item["marca"]."</td>
				<td style='border:1px solid #eee;'>".$item["modelo"]."</td>
				<td style='border:1px solid #eee;'>".$item["num_serial"]."</td>
				<td style='border:1px solid #eee;'>".$item["precio_compra"]."</td>
				</tr>");					
			
			}
		echo "</table>"; 

	} // public function Obtener_reporte()


} // class Rep_finanzas

	//$fecha_inic = $_GET["fechaInic"];
	//$fecha_fin = $_GET["fechaFin"];


$Ejecutar_reporte = new Rep_finanzas();
$Ejecutar_reporte->fecha_inic = $_GET["fechaInic"];
$Ejecutar_reporte->fecha_fin = $_GET["fechaFin"];
$Ejecutar_reporte->Obtener_reporte();





?>