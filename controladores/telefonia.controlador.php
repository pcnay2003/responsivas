<?php
	// Manejando Marcas.
  class ControladorTelefonias
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Telefonias.
		// ==================================================================
		static public function ctrMostrarTelefonias($item,$valor)
		{
			$tabla = "t_Telefonia";
			$respuesta = ModeloTelefonias::mdlMostrarTelefonias($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarAlmacenes()


		// Crear Cia. Telefonicas.
		static public function ctrCrearTelefonia()
    {
			if (isset($_POST["nuevaTelefonia"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaTelefonia"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Telefonia";

					$datos=array();									
					$datos = array("nuevaTelefonia"=>$_POST["nuevaTelefonia"]);

					$respuesta = ModeloTelefonias::mdlIngresarTelefonia($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Cia. Telefoninica ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="telefonia";
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
						title: "El Nombre de la Cia. Telefonica no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="telefonia";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoAlmacen"]))
				*/

			}

    } // static public function ctrCrearTelefonia()


		// ==============================================
		// Editar Cia. Telefonica.
		// ==============================================
		static public function ctrEditarTelefonia()
		{
			if (isset($_POST["editarTelefonia"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarTelefonia"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Telefonia";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre"=>$_POST["editarTelefonia"],
													"id_telefonia"=>$_POST["idTelefonia"]);

					$respuesta = ModeloTelefonias::mdlEditarTelefonia($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Cia. Telefonica ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="telefonia";
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
						title: "El nombre de la Cia. Telefonica no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="telefonia";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaTelefonia"]))
				*/
				
			}

		} // static public function ctrCrearTelefonia()

		// =========================================
		// Borrar Telefonia
		// =========================================
		static public function ctrBorrarTelefonia()
		{
			// "idTelefonia" = se origina 
			/*
			//$(document).on("click",".btnEliminarTelefonia",function()
		//	{	
		
				// Obteniendo los valores de "idTelefonia"
				var idTelefonia = $(this).attr("idTelefonia");
		*/

			if (isset($_GET["idTelefonia"]))
			{
				$tabla = "t_Telefonia";
				$datos = $_GET["idTelefonia"]; // Obtiene el valor.
				$respuesta = ModeloTelefonias::mdlBorrarTelefonia($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Cia. Telefonica ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="telefonia";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idTelefonia"]))

		} // static public function ctrBorrarTelefonia()

	} // class ControladorTelefonias
?> 
  