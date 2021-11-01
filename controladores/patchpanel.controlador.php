<?php
	// Manejando el Patch Panel.
  class ControladorPatchPanel
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar el Patch Panel.
		// ==================================================================
		static public function ctrMostrarPatchPanel($item,$valor)
		{
			$tabla = "t_Patch_panel";
			$respuesta = ModeloPatchPanel::mdlMostrarPatchPanel($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarPatchPanel()


		// Crear Patch Panel
		static public function ctrCrearPatchPanel()
    {
			if (isset($_POST["nuevoPatchPanel"]))
			{
				if (preg_match('/^[a-zA-Z0-9-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPatchPanel"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Patch_panel";

					$datos=array();									
					$datos = array("nuevoPatchPanel"=>$_POST["nuevoPatchPanel"]);

					$respuesta = ModeloPatchPanel::mdlIngresarPatchPanel($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Patch Panel ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="patchpanel";
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
						title: "El Patch Panel no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="patchpanel";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPatchPanel"]))

			}

    } // static public function ctrCrearPatchPanel()


		// ==============================================
		// Editar Patch Panel
		// ==============================================
		static public function ctrEditarPatchPanel()
		{
			if (isset($_POST["editarPatchPanel"]))
			{
				if (preg_match('/^[a-zA-Z0-9-ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPatchPanel"]))
				{
					// Enviar la información al Modelo.
					$tabla = "t_Patch_panel";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("descripcion"=>$_POST["editarPatchPanel"],
													"id_patch_panel"=>$_POST["idPatchPanel"]);

					$respuesta = ModeloPatchPanel::mdlEditarPatchPanel($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Patch Panel ha sido cambiado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="patchpanel";
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
						title: "El Patch Panel no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="patchpanel";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoPatchPanel"]))

			}

		} // static public function ctrCrearPatchPanel()

		// =========================================
		// Borrar Patch Panel 
		// =========================================
		static public function ctrBorrarPatchPanel()
		{
			// "idPatchPanel" = se origina 
			/*
			//$(document).on("click",".btnEliminarPatchPanel",function()
		//	{	
		
				// Obteniendo los valores de "idPatchPanel"
				var idPatchPanel = $(this).attr("idPatchPanel");
		*/

			if (isset($_GET["idPatchPanel"]))
			{
				$tabla = "t_Patch_panel";
				$datos = $_GET["idPatchPanel"]; // Obtiene el valor.
				$respuesta = ModeloPatchPanel::mdlBorrarPatchPanel($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Patch Panel ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="patchpanel";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idPatchPanel"]))

		} // static public function ctrBorrarPatchPanel()

  } // class ControladorPatchPanel

?> 
  