<?php
	// Crear clientes:
	
	class ControladorClientes
	{
		static public function ctrCrearCliente()
		{
			// Verifica si esta creada la variable Get de la forma.
			if (isset($_POST["nuevoCliente"]))
			{
				// Validando los datos
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoCliente"]) && preg_match('/^[0-9]+$/',$_POST["nuevoDocumentoId"]) && 
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]))			
				{

					$tabla = "t_Clientes";
					$datos = array ("nombre"=>$_POST["nuevoCliente"],
					"documento"=>$_POST["nuevoDocumentoId"],
					"email"=>$_POST["nuevoEmail"],
					"telefono"=>$_POST["nuevoTelefono"],					
					"direccion"=>$_POST["nuevaDireccion"],
					"fecha_nacimiento"=>$_POST["nuevaFechaNacimiento"]);
					$respuesta = ModeloClientes::mdlIngresarCliente($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Cliente ha sido guardado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="clientes";
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
						title: "El cliente no puede ir vacio o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="clientes";
							}

						});
		
					</script>';          

				}

			} // if (isset($_POST["nuevoCliente"]))

		} // static public function ctrCrearCliente()

		// Mostrar Clientes.
		static public function ctrMostrarClientes($item,$valor)
		{
			$tabla = "t_Clientes";
			$respuesta = ModeloClientes::mdlMostrarClientes($tabla,$item,$valor);
			//$respuesta = $tabla;

			return $respuesta;
		}

		// ******************************************
		// Editar Cliente.
		// ******************************************

		static public function ctrEditarCliente()
		{
			// Verifica si esta creada la variable Get de la forma.
			if (isset($_POST["editarCliente"]))
			{
				// Validando los datos
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCliente"]) && preg_match('/^[0-9]+$/',$_POST["editarDocumentoId"]) && 
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"]))			
				{

					$tabla = "t_Clientes";
					$datos = array ("id"=>$_POST["idCliente"],
					"nombre"=>$_POST["editarCliente"],
					"documento"=>$_POST["editarDocumentoId"],
					"email"=>$_POST["editarEmail"],
					"telefono"=>$_POST["editarTelefono"],					
					"direccion"=>$_POST["editarDireccion"],
					"fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);
					$respuesta = ModeloClientes::mdlEditarCliente($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Cliente ha sido Editado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="clientes";
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
						title: "El cliente no puede ir vacio o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="clientes";
							}

						});
		
					</script>';          

				}

			} // if (isset($_POST["nuevoCliente"]))

		} // static public function ctrCrearCliente()

		// ==========================================
		// Eliminar Cliente 
		// ==========================================
		static public function ctrEliminarCliente()
		{
			if (isset($_GET["idCliente"]))
			{
				$tabla = "t_Clientes";
				$datos = $_GET["idCliente"];

				$respuesta = ModeloClientes::mdlEliminarCliente($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "El cliente ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="clientes";
							}

						});
		
					</script>';

				} // if ($respuesta == "ok")

			} // if (isset($_GET["idCliente"]))

		}

	} // class ControladorClientes
?>
