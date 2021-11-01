<?php
	// Manejando Planes de Telefonia.
  class ControladorPlanTelefonias
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Planes Telefonicos
		// ==================================================================
		static public function ctrMostrarPlanTelefonias($item,$valor)
		{
			$tabla = "t_PlanTelefonia";
			$respuesta = ModeloPlanTelefonias::mdlMostrarPlanTelefonias($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarPlanTelefonias()


		// Crear Planes De Telefonia
		static public function ctrCrearPlanTelefonia()
    {
			if (isset($_POST["nuevoPlanTelefonia"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPlanTelefonia"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_PlanTelefonia";

					$datos=array();									
					$datos = array("nuevoPlanTelefonia"=>$_POST["nuevoPlanTelefonia"]);

					$respuesta = ModeloPlanTelefonias::mdlIngresarPlanTelefonia($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El plan de Telefonia ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="plan-telefonia";
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
						title: "El Nombre del Plan de la Telefonia no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="plan-telefonia";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPlanTelefonia"]))
				*/

			}

    } // static public function ctrCrearPlanTelefonia()


		// ==============================================
		// Editar Plan De Telefonia.
		// ==============================================
		static public function ctrEditarPlanTelefonia()
		{
			if (isset($_POST["editarPlanTelefonia"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPlanTelefonia"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_PlanTelefonia";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre"=>$_POST["editarPlanTelefonia"],
													"id_plan_tel"=>$_POST["idPlanTelefonia"]);

					$respuesta = ModeloPlanTelefonias::mdlEditarPlanTelefonia($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Plan de Telefonia ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="plan-telefonia";
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
						title: "El nombre del Plan de Telefonia no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="plan-telefonia";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPlanTelefonia"]))
				*/
				
			}

		} // static public function ctrCrearPlanTelefonia()

		// =========================================
		// Borrar Plan De Telefonia
		// =========================================
		static public function ctrBorrarPlanTelefonia()
		{
			// "idPlanTelefonia" = se origina 
			/*
			//$(document).on("click",".btnEliminarPlanTelefonia",function()
		//	{	
		
				// Obteniendo los valores de "idPlanTelefonia"
				var idPlanTelefonia = $(this).attr("idPlanTelefonia");
		*/

			if (isset($_GET["idPlanTelefonia"]))
			{
				$tabla = "t_PlanTelefonia";
				$datos = $_GET["idPlanTelefonia"]; // Obtiene el valor.
				$respuesta = ModeloPlanTelefonias::mdlBorrarPlanTelefonia($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Plan de la Telefonia ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="plan-telefonia";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idPlanTelefonia"]))

		} // static public function ctrBorrarPlanTelefonia()

	} // class ControladorPlanTelefonias
?> 
  