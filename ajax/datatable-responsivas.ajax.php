<?php
	// Para poder extraer los datos de la tabla de "t_Responsivas" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "responsivas.php", se carga mucho después.

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";
	require_once "../controladores/responsivas.controlador.php";
	require_once "../modelos/responsivas.modelo.php";
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";
	

	class TablaResponsivas
	{
		// Mostrar la tabla de Responsivas
		public function mostrarTablaResponsivas()
		{
			// Extraer la información de la tabla "Responsivas"
			$item = null;
			$valor = null;
			$ordenar = 'por_fecha';

			$responsivas = ControladorResponsivas::ctrMostrarResponsivas($item,$valor,$ordenar);

			//var_dump($responsivas);
			//return;
			//exit;

			// Comienza a generar los datos JSon.
			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($responsivas);$i++)
				{
					//Para obtener el nombre y el NTID del empleado
					$item = "id_empleado";
					$valor = $responsivas[$i]["id_empleado"];
					$orden = 'nombre';
					$empleado = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
						
					/*
					// Para obtener el "Periferico", "Serial" del equipo que tiene la responsiva.
					// Primero decodificar el formato Json que esta guardado en la base de datos pasarlo a un arreglo para accesar a cada uno de los componentes.
					$listarProductos = json_decode($responsivas[$i]["productos"],true);
					$item = "id_producto";
					$valor = $listarProductos["id_producto"];
					$orden = "id_producto";
					// Obtiene el "id_periferico", pero esta consulta obtiene el "nombre" -> Periferico, solo s llamara.
					// $producto["id_periferico"], $producto["num_serie"],$producto["Periferico"]

					$producto = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
					*/

					// Se utilizan estos datos para pasarlos con Ajax a las funciones de JavaScript para obtener la información del "Empleado" 
					// se agrega btnEditarResponsiva" = Boton para editar 
					// idResponsiva='".$responsivas[$i]["id_responsiva"]."' para editar la responsiva.
					// data-toggle='modal' = Para desplegar una ventanta Modal.
					// data-target='#modalEditarResponsiva' = Pantalla para editar las "Responsivas" 
					// btnEliminarResponsiva= Boton para eliminar Responsiva
					// idResponsiva='".$responsivas[$i]["id_responsiva"]."' = Para obtener el código de la "Responsiva"
					

					// Esta parte se utiliza para utilizar las variables de sesion en DataTable.
					// recuperarBoton = Se utiliza cuando se quita un producto de la lista y vuelva estar activo.
					if ((isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Admin") || $_GET["perfilOculto"] == "Administrador")
					{
						$botones = "<div class='btn-group'><button class='btn btn-info btnImpResponsiva' idResponsiva = '".$responsivas[$i]["id_responsiva"]."'><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditarResponsiva' idResponsiva = '".$responsivas[$i]["id_responsiva"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarResponsiva' idResponsiva = '".$responsivas[$i]["id_responsiva"]."'><i class='fa fa-times'></i></button></div>";						
					}
					else
					{
						$botones = "<div class='btn-group'><button class='btn btn-info btnImpResponsiva' idResponsiva = '".$responsivas[$i]["id_responsiva"]."'><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditarResponsiva' idResponsiva = '".$responsivas[$i]["id_responsiva"]."'><i class='fa fa-pencil'></i></button>";
					}					

					$datosJson  .= '[
							"'.($i+1).'",
							"'.$responsivas[$i]["num_folio"].'",
							"'.$empleado["ntid"].'",
							"'.$empleado["apellidos"].'",
							"'.$responsivas[$i]["modalidad_entrega"].'",
							"'.$responsivas[$i]["fecha_asignado"].'",
							"'.$responsivas[$i]["fecha_devolucion"].'",
							"'.$botones.'"
						],';

				} // for ($i =0;$i<count($responsivas);$i++)
				// Una vez que se termina el ciclo, al final de la cadena "$datosJson" se le elimina ","
				$datosJson = substr($datosJson,0,-1);
				$datosJson .=	']}';

			echo  $datosJson;

			//return; // para que no continue la ejecución.


			// Se utilizan las variables de PHP para no romper la cadena en el JSON.
		 
		} // public function mostrarTablaProductos()

	} // class TablaProductos

	// Activar la tabla de productos.
	$activarResponsivas = new TablaResponsivas();
	$activarResponsivas->mostrarTablaResponsivas();

	

?>