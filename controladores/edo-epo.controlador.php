<?php
	// Manejando los estados de los equipos.
  class ControladorEdo_Epos
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los estados de los equipos.
		// ==================================================================
		static public function ctrMostrarEdo_Epos($item,$valor)
		{
			$tabla = "t_Edo_epo";
			$respuesta = ModeloEdo_Epos::mdlMostrarEdo_Epos($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarEdo_Epos()


		// Crear Estados de los equipos.
		static public function ctrCrearEdo_Epo()
    {
			if (isset($_POST["nuevoEdo_Epo"]))
			{
				//if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoEdo_Epo"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Edo_epo";

					//$datos=array();									
					$datos = array("nuevoEdo_Epo"=>$_POST["nuevoEdo_Epo"]);

					$respuesta = ModeloEdo_Epos::mdlIngresarEdo_Epo($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Estado Del Equipo ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="edo-epo";
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
						title: "El Estado del Equipo no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="edo-epo";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoEdo_Epo"]))
				*/

			}

    } // static public function ctrCrearEdo_Epo()


		// ==============================================
		// Editar Estado Del Equipo
		// ==============================================
		static public function ctrEditarEdo_Epo()
		{
			if (isset($_POST["editarEdo_Epo"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarEdo_Epo"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Edo_epo";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarEdo_Epo"],
													"id_edo_epo"=>$_POST["idEdo_Epo"]);

					$respuesta = ModeloEdo_Epos::mdlEditarEdo_Epo($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Estado Del Equipo ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="edo-epo";
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
						title: "El estado del equipo no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="edo-epo";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["neditarEdo_Epo"]))
				*/

			}

		} // static public function ctrCrearEdo_Epo()

		// =========================================
		// Borrar Estado del Equipo
		// =========================================
		static public function ctrBorrarEdo_Epo()
		{
			// "idEdo_Epo" = se origina 
			/*
			//$(document).on("click",".btnEliminarEdo_Epo",function()
		//	{	
		
				// Obteniendo los valores de "idEdo_Epo"
				var idEdo_Epo = $(this).attr("idEdo_Epo");
		*/

			if (isset($_GET["idEdo_Epo"]))
			{
				$tabla = "t_Edo_epo";
				$datos = $_GET["idEdo_Epo"]; // Obtiene el valor.
				$respuesta = ModeloEdo_Epos::mdlBorrarEdo_Epo($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Estado del Equipo ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="edo-epo";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idMarca"]))

		} // static public function ctrBorrarEdo_Epo()

  } // class ControladorEdo_Epos

?> 
  