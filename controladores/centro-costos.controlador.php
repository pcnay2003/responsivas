<?php
	// Manejando los Centros de Costos.
  class ControladorCentro_Costos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Centros de Costos.
		// ==================================================================
		static public function ctrMostrarCentro_Costos($item,$valor)
		{
			$tabla = "t_Centro_Costos";
			$respuesta = ModeloCentro_Costos::mdlMostrarCentro_Costos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarCentro_Costos()


		// Crear el Centro de Costo.
		static public function ctrCrearCentro_Costos()
    {
			if (isset($_POST["nuevoCentro_Costos"]))
			{
				if (preg_match('/^[0-9]+$/',$_POST["nuevoCentro_Costos"]) &&
						preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaDesc_cc"]) )
				{
					// Enviar la información al Modelo.
					$tabla = "t_Centro_Costos";

					//$datos=array();				
					
					$datos = array("num_centro_costos" =>$_POST["nuevoCentro_Costos"],
												"descripcion" =>$_POST["nuevaDesc_cc"]);

					var_dump($datos);
					//exit;
					$respuesta = ModeloCentro_Costos::mdlIngresarCentro_Costos($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Centro De Costos ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="centro-costos";
								}
	
								});
			
							</script>';          
	
					}
					else
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al Grabar el Centro de Costos",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="centro-costos";
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
						title: "El Centro de Costos no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="centro-costos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoCentro_Costos"]))

			}

    } // static public function ctrCrearCentro_Costos()


		// ==============================================
		// Editar Centro de Costos
		// ==============================================
		static public function ctrEditarCentro_Costos()
		{
			if (isset($_POST["editarCentro_Costos"]))
			{
				if (preg_match('/^[0-9]+$/',$_POST["editarCentro_Costos"]) && 
						preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarDesc_cc"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Centro_Costos";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("num_centro_costos"=>$_POST["editarCentro_Costos"],
													"descripcion"=>$_POST["editarDesc_cc"],
													"id_centro_costos"=>$_POST["idCentro_Costos"]);

					$respuesta = ModeloCentro_Costos::mdlEditarCentro_Costos($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Centro De Costos ha sido cambiado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="centro-costos";
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
						title: "El Centro Costo y/o Descripcion equipo no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="centro-costos";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[0-9]+$/',$_POST["nuevoCentro_Costos"]))

			}

		} // static public function ctrEditarCentro_Costos()

		// =========================================
		// Borrar Centro De Costos
		// =========================================
		static public function ctrBorrarCentro_Costos()
		{
			// "idCentro_Costos" = se origina 
			/*
			//$(document).on("click",".btnEliminarCentro_Costos",function()
		//	{	
		
				// Obteniendo los valores de "idCentro_Costos"
				var idCentro_Costos = $(this).attr("idCentro_Costos");
		*/

			if (isset($_GET["idCentro_Costos"]))
			{
				$tabla = "t_Centro_Costos";
				$datos = $_GET["idCentro_Costos"]; // Obtiene el valor.
				$respuesta = ModeloCentro_Costos::mdlBorrarCentro_Costos($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Centro de Costos ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="centro-costos";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idCentro_Costos"]))

		} // static public function ctrBorrarCentro_Costos()

  } // class ControladorCentro_Costos

?> 
  