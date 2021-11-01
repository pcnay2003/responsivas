<?php
	// Manejando Ubicaciones.
  class ControladorUbicaciones
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Ubciaciones.
		// ==================================================================
		static public function ctrMostrarUbicaciones($item,$valor)
		{
			$tabla = "t_Ubicacion";
			$respuesta = ModeloUbicaciones::mdlMostrarUbicaciones($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarUbicaciones()


		// Crear Ubicaciones.
		static public function ctrCrearUbicacion()
    {
			if (isset($_POST["nuevaUbicacion"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ- ]+$/',$_POST["nuevaUbicacion"]))
				//{
					// Enviar la información a la Ubicacion.
					$tabla = "t_Ubicacion";

					$datos=array();									
					$datos = array("nuevaUbicacion"=>$_POST["nuevaUbicacion"]);

					$respuesta = ModeloUbicaciones::mdlIngresarUbicacion($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Ubicacion ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="ubicaciones";
								}
	
								});
			
							</script>';          
	
					}
			//	}
			/*	else
			//	{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Ubicacion no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="ubicaciones";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaUbiacion"]))
*/
			}

    } // static public function ctrCrearUbicacion()


		// ==============================================
		// Editar Ubicacion
		// ==============================================
		static public function ctrEditarUbicacion()
		{
			if (isset($_POST["editarUbicacion"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarUbicacion"]))
				{
					// Enviar la información a la Ubicacion.
					$tabla = "t_Ubicacion";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarUbicacion"],
													"id_ubicacion"=>$_POST["idUbicacion"]);

					$respuesta = ModeloUbicaciones::mdlEditarUbicacion($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Ubicaciones ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="ubicaciones";
								}
	
								});
			
							</script>';          
	
					}
				}
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Ubicacion no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="ubicaciones";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaUbicacion"]))

			}

		} // static public function ctrCrearUbicacion()

		// =========================================
		// Borrar Ubicacion
		// =========================================
		static public function ctrBorrarUbicacion()
		{
			// "idUbicacion" = se origina 
			/*
			//$(document).on("click",".btnEliminarUbicacion",function()
		//	{	
		
				// Obteniendo los valores de "idUbicacion"
				var idUbicacion = $(this).attr("idUbicacion");
		*/

			if (isset($_GET["idUbicacion"]))
			{
				$tabla = "t_Ubicacion";
				$datos = $_GET["idUbicacion"]; // Obtiene el valor.
				$respuesta = ModeloUbicaciones::mdlBorrarUbicacion($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Ubicacion ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="ubicaciones";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idUbicaciones"]))

		} // static public function ctrBorrarUbicacion()

  } // class ControladorUbicaciones

?> 
  