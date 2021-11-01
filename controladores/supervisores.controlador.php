<?php
	// Manejando Supervisores.
  class ControladorSupervisores
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Supervisores.
		// ==================================================================
		static public function ctrMostrarSupervisores($item,$valor)
		{
			$tabla = "t_Supervisor";
			$respuesta = ModeloSupervisores::mdlMostrarSupervisores($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarSupervisores()


		// Crear Supervisor.
		static public function ctrCrearSupervisores()
    {
			if (isset($_POST["nuevoSupervisor"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoSupervisor"]))
				//{
					// Enviar la información al Supervisor.
					$tabla = "t_Supervisor";

					$datos=array();									
					$datos = array("nuevoSupervisor"=>$_POST["nuevoSupervisor"]);

					$respuesta = ModeloSupervisores::mdlIngresarSupervisor($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Supervisor ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="supervisores";
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
						title: "El Supervisor no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="supervisores";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoSupervisor"]))
				*/

			}

    } // static public function ctrCrearSupervisores()


		// ==============================================
		// Editar Supervisor
		// ==============================================
		static public function ctrEditarSupervisor()
		{
			if (isset($_POST["editarSupervisor"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarSupervisor"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Supervisor";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarSupervisor"],
													"id_supervisor"=>$_POST["idSupervisor"]);

					$respuesta = ModeloSupervisores::mdlEditarSupervisor($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Supervisor ha sido cambiado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="supervisores";
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
						title: "El Supervisor no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="supervisores";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoSupervisor"]))
				*/
				
			}

		} // static public function ctrCrearSupervisores()

		// =========================================
		// Borrar Supervisor
		// =========================================
		static public function ctrBorrarSupervisor()
		{
			// "idSupervisor" = se origina 
			/*
			//$(document).on("click",".btnEliminarSupervisor",function()
		//	{	
		
				// Obteniendo los valores de "idSupervisor"
				var idSupervisor = $(this).attr("idSupervisor");
		*/

			if (isset($_GET["idSupervisor"]))
			{
				$tabla = "t_Supervisor";
				$datos = $_GET["idSupervisor"]; // Obtiene el valor.
				$respuesta = ModeloSupervisores::mdlBorrarSupervisor($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Supervisor ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="supervisores";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idSupervisor"]))

		} // static public function ctrBorrarSupervisor()

  } // class ControladorSupervisores

?> 
  