<?php
	// Manejando Modelos.
  class ControladorModelos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Modelos.
		// ==================================================================
		static public function ctrMostrarModelos($item,$valor)
		{
			$tabla = "t_Modelo";
			$respuesta = ModeloModelos::mdlMostrarModelos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarModelos()


		// Crear Modelo.
		static public function ctrCrearModelos()
    {
			if (isset($_POST["nuevoModelo"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ -]+$/',$_POST["nuevoModelo"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Modelo";

					$datos=array();									
					$datos = array("nuevoModelo"=>$_POST["nuevoModelo"]);

					$respuesta = ModeloModelos::mdlIngresarModelo($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Modelo ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="Modelos";
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
						title: "La Modelo no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="Modelos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ- ]+$/',$_POST["nuevoModelo"]))
				*/

			}

    } // static public function ctrCrearModelo()


		// ==============================================
		// Editar Modelo
		// ==============================================
		static public function ctrEditarModelo()
		{
			if (isset($_POST["editarModelo"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ -]+$/',$_POST["editarModelo"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Modelo";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarModelo"],
													"id_modelo"=>$_POST["idModelo"]);

					$respuesta = ModeloModelos::mdlEditarModelo($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Modelo ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="Modelos";
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
						title: "El Modelo no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="Modelos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ -]+$/',$_POST["nuevoModelo"]))
				*/
				
			}

		} // static public function ctrCrearModelos()

		// =========================================
		// Borrar Modelo
		// =========================================
		static public function ctrBorrarModelo()
		{
			// "idModelo" = se origina 
			/*
			//$(document).on("click",".btnEliminarModelo",function()
		//	{	
		
				// Obteniendo los valores de "idModelo"
				var idModelo = $(this).attr("idModelo");
		*/

			if (isset($_GET["idModelo"]))
			{
				$tabla = "t_Modelo";
				$datos = $_GET["idModelo"]; // Obtiene el valor.
				$respuesta = ModeloModelos::mdlBorrarModelo($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Modelo ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="Modelos";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idModelo"]))

		} // static public function ctrBorrarModelo()

  } // class ControladorModelos

?> 
  