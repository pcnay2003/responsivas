<?php
	// Manejando Deptos.
  class ControladorDeptos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Deptos.
		// ==================================================================
		static public function ctrMostrarDeptos($item,$valor)
		{
			$tabla = "t_Depto";
			$respuesta = ModeloDeptos::mdlMostrarDeptos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarDeptos()


		// Crear Deptos.
		static public function ctrCrearDeptos()
    {
			if (isset($_POST["nuevoDepto"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoDepto"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Depto";

					$datos=array();									
					$datos = array("nuevoDepto"=>$_POST["nuevoDepto"]);

					$respuesta = ModeloDeptos::mdlIngresarDepto($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Depto ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="deptos";
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
						title: "El Depto no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="deptos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoDepto"]))
				*/
			}

    } // static public function ctrCrearDepto()


		// ==============================================
		// Editar Depto
		// ==============================================
		static public function ctrEditarDepto()
		{
			if (isset($_POST["editarDepto"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarDepto"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Depto";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarDepto"],
													"id_depto"=>$_POST["idDepto"]);

					$respuesta = ModeloDeptos::mdlEditarDepto($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Depto ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="deptos";
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
						title: "El Depto no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="deptos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoDepto"]))
				*/
				
			}

		} // static public function ctrCrearDeptos()

		// =========================================
		// Borrar Depto
		// =========================================
		static public function ctrBorrarDepto()
		{
			// "idDepto" = se origina 
			/*
			//$(document).on("click",".btnEliminarDepto",function()
		//	{	
		
				// Obteniendo los valores de "idDepto"
				var idDepto = $(this).attr("idDepto");
		*/

			if (isset($_GET["idDepto"]))
			{
				$tabla = "t_Depto";
				$datos = $_GET["idDepto"]; // Obtiene el valor.
				$respuesta = ModeloDeptos::mdlBorrarDepto($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Depto ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="deptos";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idDepto"]))

		} // static public function ctrBorrarDepto()

  } // class ControladorDeptos

?> 
  