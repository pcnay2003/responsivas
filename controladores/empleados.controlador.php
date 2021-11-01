<?php
	require_once "funciones.php";

	class ControladorEmpleados
	{
		// Mostrar Empleados
		static public function ctrMostrarEmpleados($item,$valor,$orden)
		{
			$tabla = "t_Empleados";
			$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden);
			return $respuesta;			
		}

		// Imprimir Empleados
		static public function ctrMostrarEmpleadosRep($item,$valor)
		{
			$tabla = "t_Empleados";
			$respuesta = ModeloEmpleados::mdlMostrarEmpleadosRep($tabla,$item,$valor);
			return $respuesta;			
		}
		
		// Imprimir Responsiva  Empleado
		static public function ctrMostrarEmpleadosImpResp($item,$valor)
		{
			$respuesta = ModeloEmpleados::mdlMostrarEmpleadosImpResp($item,$valor);
			return $respuesta;			
		}


		// Crear Empleado
		static public function ctrCrearEmpleado()
		{
			if (isset($_POST["nuevoNombre"]))
			{
		//		if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) &&
		//			preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoApellido"]) &&
		//			preg_match('/^[a-zA-Z0-9@_ñÑáéíóúÁÉÍÓÚ. ]+$/',$_POST["nuevoCorreoElect"]))
				{
					$tabla = "t_Empleados";

					$ruta = "vistas/img/empleados/default/anonymous.png";
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.
          */
          
					// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/empleados.php" seccion de "modalAgregarEmpleado" etiqueta tipo "File" "nuevaImagen"
			
          if (isset($_FILES["nuevaImagen"]["tmp_name"]))
          {
            // Crea un nuevo array
            //Definiendo el tamaño de la foto de 500X500.
						// getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
						//var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 
            list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
            

            // Los tamaños de la foto a guardar en la computadora
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Crear el directorio donde se guardara la foto del usuario
			$directorio = "vistas/img/empleados/".$_POST["nuevo_ntid"];
			// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos".
            mkdir ($directorio,0777); // 0755

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
              $ruta = "vistas/img/empleados/".$_POST["nuevo_ntid"]."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							
			  // Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
			 // imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
							
            }

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/png")
            {
              $aleatorio = mt_rand(100,999);
              $ruta = "vistas/img/empleados/".$_POST["nuevo_ntid"]."/".$aleatorio.".png";
              $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
              $destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
              imagejpeg($destino,$ruta);
            }
            
          }
				

					// Estos campos se extraen de las etiquetas de la captura de form de los Empleados, y se colocan en un arreglo.					
					$datos = array("id_puesto" =>$_POST["nuevoPuesto"],
                        "id_depto" =>$_POST["nuevoDepto"],
                        "id_supervisor" =>$_POST["nuevoSupervisor"],
												"id_ubicacion" =>$_POST["nuevaUbicacion"],
												"id_centro_costos" =>$_POST["nuevoCentro_Costos"],
                        "nombre" =>$_POST["nuevoNombre"],
                        "apellidos" =>$_POST["nuevoApellido"],
                        "ntid" =>$_POST["nuevo_ntid"],
                        "correo_electronico" =>$_POST["nuevoCorreoElect"],
                        "imagen" =>$ruta);

					//var_dump($datos);
					//exit;

					$respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Empleado ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value)
									{
										window.location="empleados";
									}
		
									});
			
							</script>';          

					}
				}
/*
				else // if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) && ...
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "NO se permiten campo vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="empleados";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevo_ntid"] && ..... ))  
*/
			} //if (isset($_POST["nuevoNombre"]))
		
		} // 	static public function ctrCrearEmpleado() 


	// ******************************************************************
	// Editar Empleado
	// ******************************************************************	
	static public function ctrEditarEmpleado()
	{
		// Se toma este campo como referencia, ya que esta validado para que no deje espacios y se utiliza para determinar que existe datos en los Text de la forma y validaro los campos
		if (isset($_POST["editarNombre"]))
		{
			/*
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPuesto"]) && 
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarDepto"]) &&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarSupervisor"]) &&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarUbicacion"]) &&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCentro_Costos"]) &&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editar_ntid"]) &&
					preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]) &&
					preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarApellido"]) &&
					preg_match('/^[a-zA-Z0-9@ñÑáéíóúÁÉÍÓÚ. ]+$/',$_POST["editarCorreoElect"]) &&
					preg_match('/^[0-9]+$/',$_POST["id_empleado"]))				
			{
*/				
				$tabla = "t_Empleados";

				// "vistas/img/empleados/default/anonymous.png"; se cambia por es la misma foto
				$ruta = $_POST["imagenActual"];
				//print_r ($ruta);
				//exit;

				/* Para guardar las fotos, sera de la siguiente manera: 
				1.- En una carpeta del servidor se subira la foto
				2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.
					*/
				
				// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/empleados.php" seccion de "modalAgregarEmpleado" etiqueta tipo "File" "nuevaImagen"
				// Se agrega otra condicion "!empty($_FIL...." para que cuando no se modifique la foto no realize de nuevo el proceso 
				if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
				{
					// Crea un nuevo array
					//Definiendo el tamaño de la foto de 500X500.
					// getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
					list($ancho,$alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
					//var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 

					// Los tamaños de la foto a guardar en la computadora
					$nuevoAncho = 500;
					$nuevoAlto = 500;


					// Crear el directorio donde se guardara la foto del producto
					$directorio = "vistas/img/empleados/".$_POST["editar_ntid"];
					
					if (!empty($_POST["imagenActual"]) && ($_POST["imagenActual"] != "vistas/img/empleados/default/anonymous.png"))
					{
						// Borrar la foto
						unlink ($_POST["imagenActual"]);
					}
					else
					{
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos" 0755.
						mkdir ($directorio,0777);
					}
					
					// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
					if ($_FILES["editarImagen"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
						$ruta = "vistas/img/empleados/".$_POST["editar_ntid"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
						// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						
						// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
						// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
						// Guardar la foto en la computadora.
						imagejpeg($destino,$ruta);
						
					}

					// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
					if ($_FILES["editarImagen"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/empleados/".$_POST["editar_ntid"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
						// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
						// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
						// Guardar la foto en la computadora.
						imagejpeg($destino,$ruta);
					}
					
				}

				// Estos campos se extraen de las etiquetas de la captura de form de los empleados, y se colocan en un arreglo.					
				$tabla = "t_Empleados";
				$datos = array("id_puesto" =>$_POST["editarPuesto"],
											 "id_depto" =>$_POST["editarDepto"],
											 "id_supervisor" =>$_POST["editarSupervisor"],
											 "id_ubicacion" =>$_POST["editarUbicacion"],
											 "id_centro_costos" =>$_POST["editarCentro_Costos"],		
											 "id_empleado" =>$_POST["id_empleado"],												 
											"ntid" =>$_POST["editar_ntid"],
											"nombre" =>$_POST["editarNombre"],
											"apellidos" =>$_POST["editarApellido"],
											"correo_electronico" =>$_POST["editarCorreoElect"],
											"imagen" =>$ruta);
					
				//var_dump($datos);
				//return;

				$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Empleado ha sido Editado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="empleados";
								}
	
								});
		
						</script>';          

				}
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "No puede grabar la informacion ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="empleados";
							}
							});
		
						</script>';          
	
	
				}
/*	
			}
			else
			{
				echo '<script>           
				Swal.fire ({
					type: "error",
					title: "No puede ir con los campos vacios o llevar caracteres especiales ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							window.location="empleados";
						}
						});
	
					</script>';          

			} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarApellido"]).....)  
*/

		} //if (isset($_POST["editarApellido"]))
	
	} // static public function ctrEditarEmpleado() 



	// ******************************************************************
	// Borrar Empleado
	// ******************************************************************
	static public function ctrEliminarEmpleado()
	{
		// Si viene en camino la siguiente variable GET : idEmpleado
		if (isset($_GET['idEmpleado']))
		{
			$tabla = "t_Empleados";
			$datos = $_GET["idEmpleado"];
			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/empleados/default/anonymous.png")
			{
				// Borrar el archivo
				unlink ($_GET["imagen"]);
				//$borrar_directorio = new EliminarDirectorio();
				//$borrar_directorio->eliminar_directorio('vistas/img/empleados/'.$_GET["codigo"]);
				rmdir('vistas/img/empleados/'.$_GET["ntid"]);				
			}

			$respuesta = ModeloEmpleados::mdlEliminarEmpleado($tabla,$datos);
			if ($respuesta = "ok")
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "El Empleado ha sido borrada correctamente ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							window.location="empleados";
						}

						});
	
					</script>';          

			} // if ($respuesta = "ok")

		}
	} // static public function ctrEliminarEmpleado() 

	// ===================================================
	// Mostrar Suma De Ventas 
	// ===================================================
	static public function ctrMostrarSumaVentas()
	{
		$tabla = "t_Productos";
		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
		return $respuesta;
	}

	// Buscar "Puesto" en la capturas del "Empleado"
	static public function ctrBuscarPuesto($buscar)
	{
		$tabla = "t_Puesto";
		$respuesta = ModeloEmpleados::mdlBuscarPuesto($tabla,$buscar);
		return $respuesta;
	}

	// Buscar "Centro De Costos" en la capturas del "Empleado"
	static public function ctrBuscarCC($buscar)
	{
		$tabla = "t_Centro_Costos";
		$respuesta = ModeloEmpleados::mdlBuscarCC($tabla,$buscar);
		return $respuesta;
	}
	
} // class ControladorProductos



?>
