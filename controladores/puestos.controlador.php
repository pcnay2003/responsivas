<?php
	// Manejando Puestos.
  class ControladorPuestos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Puestos.
		// ==================================================================
		static public function ctrMostrarPuestos($item,$valor)
		{
			$tabla = "t_Puesto";
			$respuesta = ModeloPuestos::mdlMostrarPuestos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarPuestos()


		// Crear Puestos.
		static public function ctrCrearPuestos()
    {
			if (isset($_POST["nuevoPuesto"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuesto"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Puesto";

					$datos=array();									
					$datos = array("nuevoPuesto"=>$_POST["nuevoPuesto"]);

					$respuesta = ModeloPuestos::mdlIngresarPuesto($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Puesto ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="puestos";
								}
	
								});
			
							</script>';          
	
					}
				//}
				/*
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "El Puesto no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puestos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuesto"]))
				*/
			}

    } // static public function ctrCrearPuesto()


		// ==============================================
		// Editar Puesto
		// ==============================================
		static public function ctrEditarPuesto()
		{
			if (isset($_POST["editarPuesto"]))
			{
			//	if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPuesto"]))
			//	{
					// Enviar la información al Modelo.
					$tabla = "t_Puesto";
					// Se pasan los valores para  la consulta en la base de datos.
					// $_POST["idPuesto"], se origino en el "Input "hidden" de "puestos.php"
					$datos = array("descripcion"=>$_POST["editarPuesto"],
													"id_puesto"=>$_POST["idPuesto"]);

					$respuesta = ModeloPuestos::mdlEditarPuesto($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Puesto ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="puestos";
								}
	
								});
			
							</script>';          
	
					}
				//}
				/*
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "El Puesto no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puestos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuesto"]))
				*/
				
			}


		} // static public function ctrCrearPuesto()

		// =========================================
		// Borrar Puesto
		// =========================================
		static public function ctrBorrarPuesto()
		{
			// "idPuesto" = se origina 
			/*
			//$(document).on("click",".btnEliminarPuesto",function()
		//	{	
		
				// Obteniendo los valores de "idPuesto"
				var idPuesto = $(this).attr("idPuesto");
		*/

			if (isset($_GET["idPuesto"]))
			{
				$tabla = "t_Puesto";
				$datos = $_GET["idPuesto"]; // Obtiene el valor.
				$respuesta = ModeloPuestos::mdlBorrarPuesto($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Puesto ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puestos";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idPuesto"]))

		} // static public function ctrBorrarPuesto()

  } // class ControladorPuestos

?> 
  