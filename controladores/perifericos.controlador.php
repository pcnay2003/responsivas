<?php
	// Manejando Perifericos.
  class ControladorPerifericos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los perifericos.
		// ==================================================================
		static public function ctrMostrarPerifericos($item,$valor)
		{
			$tabla = "t_Periferico";
			$respuesta = ModeloPerifericos::mdlMostrarPerifericos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarPerifericos()

		// Crear Periferico.
		static public function ctrCrearPeriferico()
    {
			if (isset($_POST["nuevoPeriferico"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPeriferico"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Periferico";

					$datos=array();									
					$datos = array("nuevoPeriferico"=>$_POST["nuevoPeriferico"]);

					$respuesta = ModeloPerifericos::mdlIngresarPeriferico($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Periferico ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="perifericos";
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
						title: "El Periferico no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="perifericos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPerifico"]))
				*/

			}

    } // static public function ctrCrearPeriferico()


		// ==============================================
		// EDITAR Periferico
		// ==============================================
		static public function ctrEditarPeriferico()
		{
			if (isset($_POST["editarPeriferico"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPeriferico"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Periferico";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre"=>$_POST["editarPeriferico"],
													"id_periferico"=>$_POST["idPeriferico"]);

					$respuesta = ModeloPerifericos::mdlEditarPeriferico($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Periferico ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="perifericos";
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
						title: "El Periferico no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="perifericos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPeriferico"]))
				*/
				
			}

		} // static public function ctrCrearPeriferico()

		// =========================================
		// Borrar Periferico
		// =========================================
		static public function ctrBorrarPeriferico()
		{
			// "idPeriferico" = se origina 
			/*
			//$(document).on("click",".btnEliminarPeriferico",function()
		//	{	
		
				// Obteniendo los valores de "idPeriferico"
				var idPeriferico = $(this).attr("idPeriferico");
		*/

			if (isset($_GET["idPeriferico"]))
			{
				$tabla = "t_Periferico";
				$datos = $_GET["idPeriferico"]; // Obtiene el valor.
				$respuesta = ModeloPerifericos::mdlBorrarPeriferico($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Periferico ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="perifericos";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idPeriferico"]))

		} // static public function ctrBorrarPeriferico()

  } // class ControladorPerifericos

?> 
  