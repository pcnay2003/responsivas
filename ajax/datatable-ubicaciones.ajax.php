<?php
	// Para poder extraer los datos de la tabla de "Ubicaciones" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "empleados.php", se carga mucho después.

	require_once "../controladores/ubicaciones.controlador.php";
	require_once "../modelos/ubicaciones.modelo.php";


	class TablaUbicaciones
	{
		// Mostrar la tabla de Ubicaciones.
		public function mostrarTablaUbicaciones()
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
			$ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
			//var_dump($modelos);

			// Aqui se genera la variable tipo JSon.
			// Es importante que no se agrege un caracter demas en la cadena $datosJson
			$datosJson = '{
				"data": [';
					for ($i=0;$i<count($ubicaciones);$i++)
					{						
						// Se agrega los botones con las clases y id para "editar" y "borrar"
						if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador")
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarUbicacion' idUbicacion = '".$ubicaciones[$i]["id_ubicacion"]."' data-toggle='modal' data-target = '#modalEditarUbicacion'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarUbicacion' idUbicacion = '".$ubicaciones[$i]["id_ubicacion"]."'><i class='fa fa-times'></i></button></div>"; 
						}
						else
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarUbicacion' idUbicacion = '".$ubicaciones[$i]["id_ubicacion"]."' data-toggle='modal' data-target = '#modalEditarUbicacion'><i class='fa fa-pencil'></i></button></div>";	
						}

						
						$datosJson .= '[
							"'.($i+1).'",							
							"'.$ubicaciones[$i]['descripcion'].'",
							"'.$botones.'"
						],';	
					}
					
					$datosJson = substr($datosJson,0,-1);
					$datosJson .= ']}';
					
					echo $datosJson;

			//return; 

		} // public function mostrarTablaUbicaciones()

	} // class TablaUbicaciones

	// Instanciar la clase
	$activarUbicaciones = new TablaUbicaciones();
	$activarUbicaciones->mostrarTablaUbicaciones();


?>