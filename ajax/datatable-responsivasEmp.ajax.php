<?php
	// Para poder extraer los datos de la tabla de "empleados" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "productos.php", se carga mucho después.

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";
	require_once "../controladores/puestos.controlador.php";
	require_once "../modelos/puestos.modelo.php";


	class TablaEmpleadosResponsivas
	{
		// Mostrar la tabla de Empleados.
		public function mostrarTablaEmpleadosResponsivas()
		{
			// Extraer la información de la tabla.
			$item = null;
			$valor = null;
			$orden = "apellidos";

			$empleados = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);

			//var_dump($productos);
			//return;
			//exit;

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($empleados);$i++)
				{
					// Se obtiene la imagen del empleado, se pasa a variable para agregarlo al JSon.
					$imagen = "<img src='".$empleados[$i]["foto"]."' width='40px'>";

					//Para obtener el puesto:
					$item = "id_puesto";
					$valor = $empleados[$i]["id_puesto"];
					$puesto = ControladorPuestos::ctrMostrarPuestos($item,$valor);
					
				

					// $imagen = "<img src='vistas/img/empleados/ApellidosNovUno/630.png' width='40px'>";
					// Se utilizan estos datos para pasarlos con Ajax a las funciones de JavaScript para obtener la información del "Empleado" 
					// se agrega btnEditarEmpleado" = Boton para editar 
					// idEmpleado='".$empleados[$i]["id_empleado"]."' para editar el empleado.
					// data-toggle='modal' = Para desplegar una ventanta Modal.
					// data-target='#modalEditarEmpleado' = Pantalla para editar los productos 
					// btnEliminarEmpleado= Boton para eliminar Empleado
					// idEmpleado='".$empleados[$i]["id_empleado"]."' = Para obtener el código del empleado
					// imagen='".$empleados[$i]["foto"]."' = Para obtener la ruta de la imagen.

					// Esta parte se utiliza para utilizar las variables de sesion en DataTable.
					// recuperarBoton = Se utiliza cuando se quita un producto de la lista y vuelva estar activo.
					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Admin")
					{
						$botones = "<div class='btn-group'><button class='btn btn-primary agregarEmpleado recuperarBotonEmp' idEmpleado='".$empleados[$i]["id_empleado"]."'>Agregar </button></div>";
					}
					else
					{
						$botones = "<div class='btn-group'><button class='btn btn-primary agregarEmpleado recuperarBotonEmp' idEmpleado='".$empleados[$i]["id_empleado"]."'>Agregar </button></div>";
						
						// se extrae los datos utilizados para el boton de "Editar" y "Borrar"

						//$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id_producto"]."' imagen='".$productos[$i]["Imagen"]."' ><i class='fa fa-times'></i></button></div>";
					}					


					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$empleados[$i]["ntid"].'",
							"'.$empleados[$i]["nombre"].'",
							"'.$empleados[$i]["apellidos"].'",
							"'.$puesto["descripcion"].'",
							"'.$botones.'"
						],';
				}
				// Una vez que se termina el ciclo, al final de la cadena "$datosJson" se le elimina ","
				$datosJson = substr($datosJson,0,-1);
				$datosJson .=	']}';

			echo  $datosJson;

			//return; // para que no continue la ejecución.


			// Se utilizan las variables de PHP para no romper la cadena en el JSON.
		 
		} // public function mostrarTablaProductos()

	} // class TablaProductos

	// Activar la tabla de productos.
	$activarEmpleadosResponsivas = new TablaEmpleadosResponsivas();
	$activarEmpleadosResponsivas->mostrarTablaEmpleadosResponsivas();

	

?>