<?php
	// Manejando Puerto.
  class ControladorPuertos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Puertos.
		// ==================================================================
		static public function ctrMostrarPuertos($item,$valor)
		{
			$tabla = "t_Puerto";
			$respuesta = ModeloPuertos::mdlMostrarPuerto($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarPuertos()


		// Crear Puertos.
		static public function ctrCrearPuerto()
    {
			if (isset($_POST["nuevoPuerto"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuerto"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Puerto";

					$datos=array();									
					$datos = array("nuevoPuerto"=>$_POST["nuevoPuerto"]);

					$respuesta = ModeloPuertos::mdlIngresarPuerto($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Puerto ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="puerto";
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
						title: "El Puerto no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puerto";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuerto"]))

			}

    } // static public function ctrCrearPuerto()


		// ==============================================
		// Editar Puerto
		// ==============================================
		static public function ctrEditarPuerto()
		{
			if (isset($_POST["editarPuerto"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPuerto"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Puerto";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarPuerto"],
													"id_puerto"=>$_POST["idPuerto"]);
					
					
					$respuesta = ModeloPuertos::mdlEditarPuerto($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Puerto ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="puerto";
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
						title: "El Puerto no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puerto";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPuerto"]))

			}

		} // static public function ctrCrearPuertos()

		// =========================================
		// Borrar Puerto
		// =========================================
		static public function ctrBorrarPuerto()
		{
			// "idPuerto" = se origina 
			/*
			//$(document).on("click",".btnEliminarPuerto",function()
		//	{	
		
				// Obteniendo los valores de "idPuerto"
				var idPuerto = $(this).attr("idPuerto");
		*/

			if (isset($_GET["idPuerto"]))
			{
				$tabla = "t_Puerto";
				$datos = $_GET["idPuerto"]; // Obtiene el valor.
				$respuesta = ModeloPuertos::mdlBorrarPuerto($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Puerto ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="puerto";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idPuerto"]))

		} // static public function ctrBorrarPuerto()

  } // class ControladorPuertos

?> 
  