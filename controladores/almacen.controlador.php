<?php
	// Manejando Marcas.
  class ControladorAlmacenes
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar los Almacenes.
		// ==================================================================
		static public function ctrMostrarAlmacenes($item,$valor)
		{
			$tabla = "t_Almacen";
			$respuesta = ModeloAlmacenes::mdlMostrarAlmacenes($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarAlmacenes()


		// Crear Almacen
		static public function ctrCrearAlmacen()
    {
			if (isset($_POST["nuevoAlmacen"]))
			{
				// Enviar la información al Modelo.
				$tabla = "t_Almacen";

				$datos=array();									
				$datos = array("nuevoAlmacen"=>$_POST["nuevoAlmacen"]);

				$respuesta = ModeloAlmacenes::mdlIngresarAlmacen($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Almacen ha sido guardada correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="almacen";
							}

							});
		
						</script>';          
				} // 

			} //if (isset($_POST["nuevoAlmacen"]))

    } // static public function ctrCrearAlmacen()


		// ==============================================
		// Editar Almacen
		// ==============================================
		static public function ctrEditarAlmacen()
		{
			if (isset($_POST["editarAlmacen"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarAlmacen"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Almacen";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre"=>$_POST["editarAlmacen"],
													"id_almacen"=>$_POST["idAlmacen"]);

					$respuesta = ModeloAlmacenes::mdlEditarAlmacen($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Almacen ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="almacen";
								}
	
								});
			
							</script>';          
	
					}
				//}
				//else
				//{
					/*
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "El nombre del Almacen no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="almacen";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoAlmacen"]))
				*/
				
			}

		} // static public function ctrCrearAlmacen()

		// =========================================
		// Borrar Almacen
		// =========================================
		static public function ctrBorrarAlmacen()
		{
			// "idAlmacen" = se origina 
			/*
			//$(document).on("click",".btnEliminarAlmacen",function()
		//	{	
		
				// Obteniendo los valores de "idAlmacen"
				var idAlmacen = $(this).attr("idAlmacen");
		*/

			if (isset($_GET["idAlmacen"]))
			{
				$tabla = "t_Almacen";
				$datos = $_GET["idAlmacen"]; // Obtiene el valor.
				$respuesta = ModeloAlmacenes::mdlBorrarAlmacen($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "El Almacen ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="almacen";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idAlmacen"]))

		} // static public function ctrBorrarAlmacen()

	} // class ControladorAlmacen
?> 
  