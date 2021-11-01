<?php
	// Manejando Marcas.
  class ControladorMarcas
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Marcas.
		// ==================================================================
		static public function ctrMostrarMarcas($item,$valor)
		{
			$tabla = "t_Marca";
			$respuesta = ModeloMarcas::mdlMostrarMarcas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarMarcas()


		// Crear Marca.
		static public function ctrCrearMarcas()
    {
			if (isset($_POST["nuevaMarca"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Marca";

					$datos=array();									
					$datos = array("nuevaMarca"=>$_POST["nuevaMarca"]);

					$respuesta = ModeloMarcas::mdlIngresarMarca($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Marca ha sido guardada correctamente ",
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

    } // static public function ctrCrearMarca()


		// ==============================================
		// Editar Marca
		// ==============================================
		static public function ctrEditarMarca()
		{
			if (isset($_POST["editarMarca"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Marca";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarMarca"],
													"id_marca"=>$_POST["idMarca"]);

					$respuesta = ModeloMarcas::mdlEditarMarca($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Marca ha sido cambiada correctamente ",
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

		} // static public function ctrCrearMarcas()

		// =========================================
		// Borrar Marca
		// =========================================
		static public function ctrBorrarMarca()
		{
			// "idMarca" = se origina 
			/*
			//$(document).on("click",".btnEliminarMarca",function()
		//	{	
		
				// Obteniendo los valores de "idMarca"
				var idMarca = $(this).attr("idMarca");
		*/

			if (isset($_GET["idMarca"]))
			{
				$tabla = "t_Marca";
				$datos = $_GET["idMarca"]; // Obtiene el valor.
				$respuesta = ModeloMarcas::mdlBorrarMarca($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Marca ha sido borrado correctamente ",
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

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idMarca"]))

		} // static public function ctrBorrarMarca()

  } // class ControladorMarca

?> 
  