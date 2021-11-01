<?php
	// Para poder extraer los datos de la tabla de "empleados" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "empleados.php", se carga mucho después.

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";

	require_once "../controladores/perifericos.controlador.php";
	require_once "../modelos/perifericos.modelo.php";

	require_once "../controladores/puestos.controlador.php";
	require_once "../modelos/puestos.modelo.php";

	require_once "../controladores/deptos.controlador.php";
	require_once "../modelos/deptos.modelo.php";

	require_once "../controladores/supervisores.controlador.php";
	require_once "../modelos/supervisores.modelo.php";

	require_once "../controladores/ubicaciones.controlador.php";
	require_once "../modelos/ubicaciones.modelo.php";

	require_once "../controladores/centro-costos.controlador.php";
	require_once "../modelos/centro-costos.modelo.php";

	class TablaEmpleados
	{
		// Mostrar la tabla de Empleados.
		public function mostrarTablaEmpleados()
		{
			// https://datatables.net/examples/ajax/simple.html
			// donde se toman los ejercicios para el uso de DataTable.
			
			// Para poder introducir etiquetas HTML en Ajax.
			// Se tiene que utilizar variables de PHP y asignarle las etiquetas de HTML como de texto
			// Se deben eliminar los espacios en blanco del contenido de la variable "$botones"
			//$imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>"; 
			// data-toggle = 'modal' Para abrir una ventana flotante.


			$item = null;
			$valor = null;
			$orden = "apellidos";
			$empleados = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
			//var_dump($empleados);

			// Aqui se genera la variable tipo JSon.
			// Es importante que no se agrege un caracter demas en la cadena $datosJson
			$datosJson = '{
				"data": [';
					for ($i=0;$i<count($empleados);$i++)
					{
						$imagen = "<img src='".$empleados[$i]["foto"] ."' width='40px'>"; 

						//Para obtener el puesto:
						$item = "id_puesto";
						$valor = $empleados[$i]["id_puesto"];
						$puestos = ControladorPuestos::ctrMostrarPuestos($item,$valor);

						//Para obtener el Depto:
						$item = "id_depto";
						$valor = $empleados[$i]["id_depto"];
						$deptos = ControladorDeptos::ctrMostrarDeptos($item,$valor);

						//Para obtener los Supervisores:
						$item = "id_supervisor";
						$valor = $empleados[$i]["id_supervisor"];
						$supervisores = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);

						//Para obtener el centro de Costos:
						$item = "id_centro_costos";
						$valor = $empleados[$i]["id_centro_costos"];
						$centro_costos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
						
						// Se agrega los botones con las clases y id para "editar" y "borrar"
						if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador")
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado = '".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target = '#modalEditarEmpleado'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarEmpleado' idEmpleado = '".$empleados[$i]["id_empleado"]."' apellidos='".$empleados[$i]["apellidos"]."' imagen='".$empleados[$i]["foto"]."' ><i class='fa fa-times'></i></button><button class='btn btn-info btnSubirArchivos' id_Ntid = '".$empleados[$i]["ntid"]."'><i class='fa fa-file'></i></button></div>"; 
						}
						else
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado = '".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target = '#modalEditarEmpleado'><i class='fa fa-pencil'></i></button><button class='btn btn-info btnSubirArchivos' id_Ntid = '".$empleados[$i]["ntid"]."'><i class='fa fa-file'></i></button></div>";	
						}

						
						$datosJson .= '[
							"'.($i+1).'",							
							"'.$imagen.'",
							"'.$empleados[$i]['ntid'].'",
							"'.$empleados[$i]['nombre'].'",
							"'.$empleados[$i]['apellidos'].'",
							"'.$empleados[$i]['correo_electronico'].'",
							"'.$puestos['descripcion'].'",
							"'.$deptos['descripcion'].'",
							"'.$supervisores['descripcion'].'",
							"'.$centro_costos['num_centro_costos'].'",
							"'.$botones.'"
						],';	
					}
					
					$datosJson = substr($datosJson,0,-1);
					$datosJson .= ']}';
					
					echo $datosJson;

			//return; 

		} // public function mostrarTablaEmpleados()

	} // class TablaEmpleados

	// Activar la tabla de Empleados.
	$activarEmpleados = new TablaEmpleados();
	$activarEmpleados->mostrarTablaEmpleados();


?>