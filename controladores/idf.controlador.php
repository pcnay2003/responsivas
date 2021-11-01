<?php
	// Manejando Idfs.
  class ControladorIdf
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Idf
		// ==================================================================
		static public function ctrMostrarIdf($item,$valor)
		{
			$tabla = "t_Idf";
			$respuesta = ModeloIdf::mdlMostrarIdf($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarIdf()


		// Crear Idf.
		static public function ctrCrearIdf()
    {
			if (isset($_POST["nuevoIdf"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoIdf"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Idf";

					$datos=array();									
					$datos = array("nuevoIdf"=>$_POST["nuevoIdf"]);

					$respuesta = ModeloIdf::mdlIngresarIdf($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Idf ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="idf";
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
						title: "El Idf no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="idf";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoIdf"]))

			}

    } // static public function ctrCrearIdf()


		// ==============================================
		// Editar Idf
		// ==============================================
		static public function ctrEditarIdf()
		{
			if (isset($_POST["editarIdf"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarIdf"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Idf";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarIdf"],
													"id_idf"=>$_POST["idIdf"]);

					$respuesta = ModeloIdf::mdlEditarIdf($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Idf ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="idf";
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
						title: "El Idf no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="idf";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoIdf"]))

			}

		} // static public function ctrCrearIdf()

		// =========================================
		// Borrar Idf
		// =========================================
		static public function ctrBorrarIdf()
		{
			// "idIdf" = se origina 
			/*
			//$(document).on("click",".btnEliminarIdf",function()
		//	{	
		
				// Obteniendo los valores de "idIdf"
				var idIdf = $(this).attr("idIdf");
		*/

			if (isset($_GET["idIdf"]))
			{
				$tabla = "t_Idf";
				$datos = $_GET["idIdf"]; // Obtiene el valor.
				$respuesta = ModeloIdf::mdlBorrarIdf($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Idf ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="idf";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idIdf"]))

		} // static public function ctrBorrarIdf()

  } // class ControladorIdf

?> 
  