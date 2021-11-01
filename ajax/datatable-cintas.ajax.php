<?php
	// Para poder extraer los datos de la tabla de "t_Cintas" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "cintas.php", se carga mucho después.

	require_once "../controladores/cintas.controlador.php";
	require_once "../modelos/cintas.modelo.php";

	class TablaCintas
	{
		// Mostrar la tabla de t_Cintas.
		public function mostrarTablaCintas()
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
			$orden = "num_serial";
			$cintas = ControladorCintas::ctrMostrarCintas($item,$valor,$orden);
	
			//var_dump($cintas);

			// Aqui se genera la variable tipo JSon.
			// Es importante que no se agrege un caracter demas en la cadena $datosJson
			$datosJson = '{
				"data": [';
					for ($i=0;$i<count($cintas);$i++)
					{
						if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador")
						{
							// Se agrega los botones con las clases y id para "editar" y "borrar"
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarCinta' idCinta = '".$cintas[$i]["id_cintas"]."' data-toggle='modal' data-target = '#modalEditarCinta'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCinta' idCinta = '".$cintas[$i]["id_cintas"]."'><i class='fa fa-times'></i></button></div>";
						}
						else
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarCinta' idCinta = '".$cintas[$i]["id_cintas"]."' data-toggle='modal' data-target = '#modalEditarCinta'><i class='fa fa-pencil'></i></div>";
						}

						$datosJson .= '[
							"'.($i+1).'",														
							"'.$cintas[$i]['num_serial'].'",
							"'.$cintas[$i]['fecha_inic'].'",
							"'.$cintas[$i]['fecha_final'].'",
							"'.$cintas[$i]['ubicacion'].'",
							"'.$cintas[$i]['comentarios'].'",
							"'.$botones.'"
						],';	
					}
					
					$datosJson = substr($datosJson,0,-1);
					$datosJson .= ']}';
					
					
					echo $datosJson;

			//return; 

		} // public function mostrarTablaCintas()

	} // class TablaCintas

	// Activar la tabla de Empleados.
	$activarCintas = new TablaCintas();
	$activarCintas->mostrarTablaCintas();


?>