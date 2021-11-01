<?php
	// Manejando Marcas.
  class ControladorLineas
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Lineas.
		// ==================================================================
		static public function ctrMostrarLineas($item,$valor)
		{
			$tabla = "t_Linea";
			$respuesta = ModeloLineas::mdlMostrarLineas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarLineas()


		// Crear Linea.
		static public function ctrCrearLinea()
    {
			if (isset($_POST["nuevaLineas"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Linea";

					$datos=array();									
					$datos = array("nuevaLinea"=>$_POST["nuevaLineas"]);

					$respuesta = ModeloLineas::mdlIngresarLinea($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Linea ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="linea";
								}
	
								});
			
							</script>';          
	
					}
				//}
				//else
				/*
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Marca no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="marcas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				*/

			}

    } // static public function ctrCrearLinea()


		// ==============================================
		// Editar Linea
		// ==============================================
		static public function ctrEditarLinea()
		{
			if (isset($_POST["editarLineas"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Linea";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarLineas"],
													"id_linea"=>$_POST["idLinea"]);

					$respuesta = ModeloLineas::mdlEditarLinea($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Linea ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="linea";
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
						title: "La Marca no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="marcas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				*/
				
			}

		} // static public function ctrEditarLinea()

		// =========================================
		// Borrar Linea
		// =========================================
		static public function ctrBorrarLinea()
		{
			// "idLinea" = se origina 
			/*
			//$(document).on("click",".btnEliminarEditar",function()
		//	{	
		
				// Obteniendo los valores de "idLinea"
				var idLinea = $(this).attr("idLinea");
		*/

			if (isset($_GET["idLinea"]))
			{
				$tabla = "t_Linea";
				$datos = $_GET["idLinea"]; // Obtiene el valor.
				$respuesta = ModeloLineas::mdlBorrarLinea($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Linea ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="linea";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idLinea"]))

		} // static public function ctrBorrarLinea()

  } // class ControladorLineas

?> 
  