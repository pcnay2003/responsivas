<?php
	require_once "funciones.php";

	class ControladorProductos
	{
		// Mostrar productos Ajax
		static public function ctrMostrarProductosAjax($item,$valor)
		{
			$tabla = "t_Productos";
			$respuesta = ModeloProductos::mdlMostrarProductosAjax($tabla,$item,$valor);
			return $respuesta;			
		}

		// Mostrar productos DataTable
		static public function ctrMostrarProductos($item,$valor)
		{
			$tabla = "t_Productos";
			$orden = "nomenclatura";
			$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
			return $respuesta;			
		}
			
		// Mostrar productos DataTable
		static public function ctrMostrarProductosImpAlm($item,$valor)
		{
			$tabla = "t_Productos";
			$orden = "nomenclatura";
			$respuesta = ModeloProductos::mdlMostrarProductosImpAlm($tabla,$item,$valor,$orden);
			return $respuesta;			
		}

		// Mostrar Telefonos Asignados.
		static public function ctrMostrarProductosTelAsig($item,$valor)
		{
			$tabla = "t_Productos";			
			$respuesta = ModeloProductos::mdlMostrarProductosTelAsig($tabla,$item,$valor);
			return $respuesta;			
		}

		// Mostrar Existencia De Perifericos.
		static public function ctrMostrarProductosExistPerif($item,$valor)
		{
			$tabla = "t_Productos";			
			$respuesta = ModeloProductos::mdlMostrarProductosExistPerif($tabla,$item,$valor);
			return $respuesta;			
		}

		// Mostrar Lineas De Produccion.
		static public function ctrMostrarProductosLineas($item,$valor)
		{
			$tabla = "t_Productos";			
			$respuesta = ModeloProductos::mdlMostrarProductosLineas($tabla,$item,$valor);
			return $respuesta;
		}

		// Crear producto
		static public function ctrCrearProducto($tipo_prod)
		{
			if (isset($_POST["nuevoPeriferico"]))
			{
				// if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoSerial"]))
				if (preg_match('/^[0-9]+$/',$_POST["nuevoPeriferico"]))
				{
					/*
					(preg_match('/^[0-9]+$/',$_POST["nuevoPeriferico"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoMarca"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoModelo"]) &&					
					preg_match('/^[0-9]+$/',$_POST["nuevoAlmacen"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoEdoEpo"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoIdf"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPatchPanel"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPuerto"]) &&
					preg_match('/^[0-9.]+$/',$_POST["nuevoStock"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPrecioCompra"]) && 
					preg_match('/^[0-9]+$/',$_POST["porcentaje"]))				

					//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["especificaciones"]) && 
					//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["comentarios"]))
					*/

					$tabla = "t_Productos";

					$ruta = "vistas/img/productos/default/anonymous.png";
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.

           */
          
		// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/usuarios.php" seccion de "modalAgregarUsuario" etiqueta tipo "File" "nuevaImagen"
          if (isset($_FILES["nuevaImagen"]["tmp_name"]))
          {
            // Crea un nuevo array
            //Definiendo el tamaño de la foto de 500X500.
            // getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
            list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
            //var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 

            // Los tamaños de la foto a guardar en la computadora
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Crear el directorio donde se guardara la foto del producto
						// $directorio = "vistas/img/productos/".$_POST["nuevoPeriferico"];
						$directorio = "vistas/img/productos/varios";
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos".
            mkdir ($directorio,0777);

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
							// $ruta = "vistas/img/productos/".$_POST["nuevoPeriferico"]."/".$aleatorio.".jpg";
							$ruta = "vistas/img/productos/varios"."/".$aleatorio.".jpg";
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
              $ruta = "vistas/img/productos/varios"."/".$aleatorio.".png";
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

					// Estos campos se extraen de las etiquetas de la captura de form de los productos, y se colocan en un arreglo.		
					$veces = 0;			
					$tabla = "t_Productos";
					// "id_empleado" Solo se utiliza para guardar su ID, pero no se relacionan con la tabla "t_Empleados", para asignar nombre de quien lo tiene asignado.
					
					if ($tipo_prod == 'Completa')
					{
						$datos = array("id_periferico" =>$_POST["nuevoPeriferico"],
													"num_serie" =>$_POST["nuevoSerial"],
													"id_telefonia" =>$_POST["nuevaTelefonia"],
													"id_plan_tel" =>$_POST["nuevoPlanTelefonia"],
													"num_tel" =>$_POST["nuevoNumTel"],
													"cuenta" =>$_POST["nuevaCuenta"],
													"direcc_mac_tel" =>$_POST["nuevaDireccMac"],
													"imei_tel" =>$_POST["nuevoImei"],
													"num_ip" =>$_POST["nuevoNumIp"],
													"edo_tel" =>$_POST["nuevoEdoTel"],
													"id_empleado" =>1,
													"id_marca" =>$_POST["nuevoMarca"],
													"id_modelo" =>$_POST["nuevoModelo"],
													"id_almacen" =>$_POST["nuevoAlmacen"],
													"id_edo_epo" =>$_POST["nuevoEdoEpo"],
													"nomenclatura" =>$_POST["nuevaNomenclatura"],
													"stock" =>$_POST["nuevoStock"],												
													"precio_compra" =>$_POST["nuevoPrecioCompra"],
													"precio_venta" =>$_POST["nuevoPrecioVenta"],									
													"comentarios" =>rtrim($_POST["nuevoComent"]),
													"asset" =>$_POST["nuevoAsset"],
													"loftware" =>$_POST["nuevoLoftware"],
													"id_ubicacion" =>$_POST["nuevaArea"],
													"id_linea" =>$_POST["nuevaLinea"],
													"estacion" =>$_POST["nuevaEstacion"],
													"npa" =>$_POST["nuevoNpa"],
													"idf" =>$_POST["nuevoIdf"],
													"patch_panel" =>$_POST["nuevoPatchPanel"],
													"puerto" =>$_POST["nuevoPuerto"],
													"funcion" =>$_POST["nuevaFuncion"],
													"jls" =>$_POST["nuevoJls"],
													"qdc" =>$_POST["nuevoQdc"],
													"cuantas_veces" =>$veces,												
													"imagen" =>$ruta);
					}

					if ($tipo_prod == 'General')
					{
						$datos = array("id_periferico" =>$_POST["nuevoPeriferico"],
													"num_serie" =>$_POST["nuevoSerial"],
													"id_telefonia" =>1,
													"id_plan_tel" =>1,
													"num_tel" =>'',
													"cuenta" =>'',
													"direcc_mac_tel" =>'',
													"imei_tel" =>'',
													"num_ip" =>'',
													"edo_tel" =>'NO Aplica',
													"id_empleado" =>1,
													"id_marca" =>$_POST["nuevoMarca"],
													"id_modelo" =>$_POST["nuevoModelo"],
													"id_almacen" =>$_POST["nuevoAlmacen"],
													"id_edo_epo" =>$_POST["nuevoEdoEpo"],
													"nomenclatura" =>$_POST["nuevaNomenclatura"],
													"stock" =>$_POST["nuevoStock"],												
													"precio_compra" =>$_POST["nuevoPrecioCompra"],
													"precio_venta" =>$_POST["nuevoPrecioVenta"],									
													"comentarios" =>rtrim($_POST["nuevoComent"]),
													"asset" =>$_POST["nuevoAsset"],
													"loftware" =>'',
													"id_ubicacion" =>$_POST["nuevaArea"],
													"id_linea" =>1,
													"estacion" =>'',
													"npa" =>'',
													"idf" =>'',
													"patch_panel" =>'',
													"puerto" =>'',
													"funcion" =>'',
													"jls" =>'',
													"qdc" =>'',
													"cuantas_veces" =>$veces,												
													"imagen" =>$ruta);
					}
					
					if ($tipo_prod == 'Produccion')
					{
						$datos = array("id_periferico" =>$_POST["nuevoPeriferico"],
													"num_serie" =>$_POST["nuevoSerial"],
													"id_telefonia" =>1,
													"id_plan_tel" =>1,
													"cuantas_veces" =>$veces,
													"num_ip" =>$_POST["nuevoNumIp"],
													"edo_tel" =>'NO Aplica',
													"id_empleado" =>1,
													"id_marca" =>$_POST["nuevoMarca"],
													"id_modelo" =>$_POST["nuevoModelo"],
													"id_almacen" =>$_POST["nuevoAlmacen"],
													"id_edo_epo" =>$_POST["nuevoEdoEpo"],
													"id_ubicacion" =>$_POST["nuevaArea"],
													"id_linea" =>$_POST["nuevaLinea"],												
													"num_tel" =>'',
													"cuenta" =>'',
+													"direcc_mac_tel" =>'',
													"imei_tel" =>'',
													"nomenclatura" =>$_POST["nuevaNomenclatura"],
													"stock" =>$_POST["nuevoStock"],												
													"precio_compra" =>$_POST["nuevoPrecioCompra"],
													"precio_venta" =>$_POST["nuevoPrecioVenta"],									
													"comentarios" =>rtrim($_POST["nuevoComent"]),
													"asset" =>$_POST["nuevoAsset"],
													"loftware" =>$_POST["nuevoLoftware"],
													"estacion" =>$_POST["nuevaEstacion"],
													"npa" =>$_POST["nuevoNpa"],
													"idf" =>$_POST["nuevoIdf"],
													"patch_panel" =>$_POST["nuevoPatchPanel"],
													"puerto" =>$_POST["nuevoPuerto"],
													"funcion" =>$_POST["nuevaFuncion"],
													"jls" =>$_POST["nuevoJls"],
													"qdc" =>$_POST["nuevoQdc"],														
													"imagen" =>$ruta);
					}

					if ($tipo_prod == 'Telefono')
					{
						$datos = array("id_periferico" =>$_POST["nuevoPeriferico"],
													"num_serie" =>$_POST["nuevoSerial"],
													"id_telefonia" =>$_POST["nuevaTelefonia"],
													"id_plan_tel" =>$_POST["nuevoPlanTelefonia"],
													"num_tel" =>$_POST["nuevoNumTel"],
													"cuenta" =>$_POST["nuevaCuenta"],
													"direcc_mac_tel" =>$_POST["nuevaDireccMac"],
													"imei_tel" =>$_POST["nuevoImei"],
													"num_ip" =>'',
													"edo_tel" =>$_POST["nuevoEdoTel"],
													"id_empleado" =>1,
													"id_marca" =>$_POST["nuevoMarca"],
													"id_modelo" =>$_POST["nuevoModelo"],
													"id_almacen" =>$_POST["nuevoAlmacen"],
													"id_edo_epo" =>1,
													"nomenclatura" =>'',
													"stock" =>$_POST["nuevoStock"],												
													"precio_compra" =>$_POST["nuevoPrecioCompra"],
													"precio_venta" =>$_POST["nuevoPrecioVenta"],									
													"comentarios" =>rtrim($_POST["nuevoComent"]),
													"asset" =>'',
													"loftware" =>'',
													"id_ubicacion" =>$_POST["nuevaArea"],
													"id_linea" =>1,
													"estacion" =>'',
													"npa" =>'',
													"idf" =>'',
													"patch_panel" =>'',
													"puerto" =>'',
													"funcion" =>'',
													"jls" =>'',
													"qdc" =>'',
													"cuantas_veces" =>$veces,												
													"imagen" =>$ruta);
					}

					//var_dump($datos);
					//exit;
					$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos);

					if ($respuesta != "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al Grabar el Producto",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="productos";
								}
	
								});
			
							</script>';          	
					}

					if (($respuesta == "ok") && ($tipo_prod == 'General'))
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Producto ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value)
									{
										window.location="prod-gral";
									}
		
									});			
							</script>';          
					}
					
					if (($respuesta == "ok") && ($tipo_prod == 'Produccion'))
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Producto ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value)
									{
										window.location="prod-prod";
									}
		
									});			
							</script>';          
					}

					if (($respuesta == "ok") && ($tipo_prod == 'Telefono'))
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Producto ha sido guardado correctamente ",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result){
									if (result.value)
									{
										// window.location="prod-gral";
										window.location="prod-tel";
									}
		
									});			
							</script>';          
					}

				}
				else // if (preg_match('/^[A-Z0-9-]+$/',$_POST["nuevoSerial"]) && preg_match('/^[0-9-]+$/',$_POST ....
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "Error al Capturar Datos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="productos";
							}

							});			
					</script>';	
				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))  


			} //if (isset($_POST["nuevaDescripcion"]))
		
		} // 	static public function ctrCrearProducto() 

	// ******************************************************************
	// Editar
	// ******************************************************************

	// Editar Producto
	static public function ctrEditarProducto()
	{
		if (isset($_POST["editarPeriferico"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPeriferico"]))
			{
				$tabla = "t_Productos";

				// "vistas/img/productos/default/anonymous.png"; se cambia por es la misma foto
				$ruta = $_POST["imagenActual"];
				//print_r ($ruta);
				//exit;

				/* Para guardar las fotos, sera de la siguiente manera: 
				1.- En una carpeta del servidor se subira la foto
				2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.
					*/
				
				// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/productos.php" seccion de "modalEditarProducto" etiqueta tipo "File" "nuevaImagen"
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
					$directorio = "vistas/img/productos/varios";
					
					if (!empty($_POST["imagenActual"]) && ($_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"))
					{
						// Borrar la foto
						unlink ($_POST["imagenActual"]);
					}
					else
					{
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos" 0755.
						// mkdir ($directorio,0755);
						mkdir ($directorio,0777);
					}
					
					// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
					if ($_FILES["editarImagen"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
						$ruta = "vistas/img/productos/varios"."/".$aleatorio.".jpg";
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
						$ruta = "vistas/img/productos/varios"."/".$aleatorio.".png";
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

				// Estos campos se extraen de las etiquetas de la captura de form de los productos, y se colocan en un arreglo.					
				$datos = array("id_producto" => $_POST["IdProducto"],
											"id_periferico" =>$_POST["editarPeriferico"],
											"num_serie" =>$_POST["editarSerial"],
											"id_telefonia" =>$_POST["editarTelefonia"],
											"id_plan_tel" =>$_POST["editarPlanTelefonia"],
											"num_tel" =>$_POST["editarNumTel"],
											"cuenta" =>$_POST["editarCuenta"],
											"direcc_mac_tel" =>$_POST["editarDireccMac"],
											"imei" =>$_POST["editarImei"],
											"num_ip" =>$_POST["editarNumIp"],
											"edo_tel" =>$_POST["editarEdoTel"],
											"id_marca" =>$_POST["editarMarca"],
											"id_modelo" =>$_POST["editarModelo"],
											"id_almacen" =>$_POST["editarAlmacen"],
											"id_edo_epo" =>$_POST["editarEdoEpo"],
											"nomenclatura" =>$_POST["editarNomenclatura"],
											"stock" =>$_POST["editarStock"],
											"precio_compra" =>$_POST["editarPrecioCompra"],
											"precio_venta" =>$_POST["editarPrecioVenta"],
											"comentarios" =>$_POST["editarComent"],
											"asset" =>$_POST["editarAsset"],
											"loftware" =>$_POST["editarLoftware"],
											"id_ubicacion" =>$_POST["editarArea"],
											"id_linea" =>$_POST["editarLinea"],
											"estacion" =>$_POST["editarEstacion"],
											"npa" =>$_POST["editarNpa"],
											"idf" =>$_POST["editarIdf"],
											"patch_panel" =>$_POST["editarPatchPanel"],
											"puerto" =>$_POST["editarPuerto"],
											"funcion" =>$_POST["editarFuncion"],
											"jls" =>$_POST["editarJls"],
											"qdc" =>$_POST["editarQdc"],
											"imagen" =>$ruta);

				//var_dump($datos);
				//return;
							
				$respuesta = ModeloProductos::mdlEditarProducto($tabla,$datos);
				
				if ($respuesta == "ok")
				{
					echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Producto ha sido Editado correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="prod-gral";
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
					title: "El producto no puede ir con los campos vacios o llevar caracteres especiales ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							window.location="prod-gral";
						}
						});
	
					</script>';          

			} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))  

		} //if (isset($_POST["nuevaDescripcion"]))
	
	} // static public function ctrEditarProducto() 



	// ******************************************************************
	// Borrar Producto
	// ******************************************************************
	static public function ctrEliminarProducto()
	{
		// Si viene en camino la siguiente variable GET : idProducto
		if (isset($_GET['idProducto']))
		{
			$tabla = "t_Productos";
			$datos = $_GET["idProducto"];
			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png")
			{
				// Borrar el archivo
				unlink ($_GET["imagen"]);
				//$borrar_directorio = new EliminarDirectorio();
				//$borrar_directorio->eliminar_directorio('vistas/img/productos/'.$_GET["codigo"]);
				rmdir($_GET["imagen"]);				
			}

			$respuesta = ModeloProductos::mdlEliminarProductos($tabla,$datos);
			if ($respuesta = "ok")
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "El Producto ha sido borrada correctamente ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							window.location="prod-gral";
						}

						});
	
					</script>';          

			} // if ($respuesta = "ok")

		}
	} // static public function ctrEliminarProducto() 

	// ===================================================
	// Mostrar Suma De Ventas 
	// ===================================================
	
	static public function ctrSumaTotalPerifericos($id_periferico,$id_edo_epo)
	{
		$tabla = "t_Productos";
		$respuesta = ModeloProductos::mdlMostrarSumaPerifericos($id_periferico,$id_edo_epo,$tabla);
		return $respuesta;
	}

	static public function ctrExpProductosExcel()
	{
		// Traer la información de los Productos.
		$item = null;
		$valor = null;
		$tabla = "t_Productos";
		$orden = "";
		
		$respuestaProductos = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
		//echo "Se proceso respuestaProductos ";

		/* 
		SELECT tp.id_producto AS id_producto,tp.id_telefonia,tp.id_plan_tel,tp.id_empleado,tp.imagen_producto AS Imagen, tp.cuantas_veces AS Cuantas_veces,tp.asset,tp.loftware,tp.id_ubicacion,tp.id_linea,tp.estacion,tp.npa,tp.idf,tp.patch_panel,tp.puerto,tp.funcion,tp.jls,tp.qdc,tperif.id_periferico,tperif.nombre AS Periferico,tp.num_serie AS Serial,tp.num_tel,tp.direcc_mac_tel,tp.imei_tel,tp.edo_tel,tp.num_ip,tp.comentarios,tp.id_marca,tp.id_almacen,tp.id_modelo,tp.cuenta,tp.id_edo_epo,tp.nomenclatura,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta, tp.precio_compra,emp.nombre AS Nom_emp,emp.apellidos AS Empleado, emp.ntid AS Ntid

		1 - asset
		2 - nomenclatura
		3 - Serial
		4 - Periferico
		5 - Marca
		6 - Modelo
		7 - Edo_Epo
		8 - Stock
		9 - precio_compra
		10 - Precio_venta		
		11 - num_tel
		12 - direcc_mac_tel
		13 - imei_tel
		14 - edo_tel		
		15 - Nom_linea
		16 - Ubicacion
		17 - estacion
		18 - loftware		
		19 - npa
		20 - num_ip
		21 - idf
		22 - patch_panel
		23 - puerto
		24 - funcion
		25 - jls
		26 - qdc		
		27 - comentarios
*/

		// ===========================
		// Crear el archivo de Excel
		// ==========================
		$Name = 'Productos'.'.xls';
		header('Expires: 0');
		header('Cache-control: private');
		header("Content-type: application/vnd.ms-excel");
		header("Cache-Control: cache, must-revalidate");
		header('Content-Description: File Transfer');
		header('Last-Modified: '.date('D, d M Y H:i:s'));
		header("Pragma: public");
		header('Content-Disposition:; filename="'.$Name.'"');
		header("Content-Transfer-Encoding: binary");

		// Creando la tabla de Excel
		// utf8_decode = Para poder trabajar con tildes, acentos, ñ, Ñ
		// Creando los encabezados de la tabla.
		echo utf8_decode("<table border='0'>
			<tr>
				<td style='font-weight:bold; border:1px solid #eee;'>ASSET</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NOMENCLATURA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>SERIAL</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PERIFERICO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>MARCA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>MODELO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>EDO. EPO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>STOCK</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PRECIO COMPRA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PRECIO VENTA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NUM. TEL</td>
				<td style='font-weight:bold; border:1px solid #eee;'>DIRECC. MAC WIFI</td>
				<td style='font-weight:bold; border:1px solid #eee;'>IMEI TEL.</td>
				<td style='font-weight:bold; border:1px solid #eee;'>EDO. TEL</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE LINEA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>UBICACION</td>
				<td style='font-weight:bold; border:1px solid #eee;'>ESTACION</td>
				<td style='font-weight:bold; border:1px solid #eee;'>LOFTWARE</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NPA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NUM. IP</td>
				<td style='font-weight:bold; border:1px solid #eee;'>IDF</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PATCH PANEL</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PUERTO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>FUNCION</td>
				<td style='font-weight:bold; border:1px solid #eee;'>JLS</td>
				<td style='font-weight:bold; border:1px solid #eee;'>QDC</td>
				<td style='font-weight:bold; border:1px solid #eee;'>COMENTARIOS</td>

			</tr>");
	
			foreach ($respuestaProductos as $row => $item)
			{
				echo utf8_decode("
					<tr>
						<td style='border:1px solid #eee;'>".$item["asset"]."</td>
						<td style='border:1px solid #eee;'>".$item["nomenclatura"]."</td>
						<td style='border:1px solid #eee;'>".$item["Serial"]."</td>
						<td style='border:1px solid #eee;'>".$item["Periferico"]."</td>
						<td style='border:1px solid #eee;'>".$item["Marca"]."</td>
						<td style='border:1px solid #eee;'>".$item["Modelo"]."</td>
						<td style='border:1px solid #eee;'>".$item["Edo_Epo"]."</td>
						<td style='border:1px solid #eee;'>".$item["Stock"]."</td>
						<td style='border:1px solid #eee;'>".$item["precio_compra"]."</td>
						<td style='border:1px solid #eee;'>".$item["Precio_Venta"]."</td>
						<td style='border:1px solid #eee;'>".$item["num_tel"]."</td>
						<td style='border:1px solid #eee;'>".$item["direcc_mac_tel"]."</td>
						<td style='border:1px solid #eee;'>".$item["imei_tel"]."</td>
						<td style='border:1px solid #eee;'>".$item["edo_tel"]."</td>
						<td style='border:1px solid #eee;'>".$item["Nom_linea"]."</td>
						<td style='border:1px solid #eee;'>".$item["Ubicacion"]."</td>
						<td style='border:1px solid #eee;'>".$item["estacion"]."</td>
						<td style='border:1px solid #eee;'>".$item["loftware"]."</td>
						<td style='border:1px solid #eee;'>".$item["npa"]."</td>
						<td style='border:1px solid #eee;'>".$item["num_ip"]."</td>
						<td style='border:1px solid #eee;'>".$item["idf"]."</td>
						<td style='border:1px solid #eee;'>".$item["patch_panel"]."</td>
						<td style='border:1px solid #eee;'>".$item["puerto"]."</td>
						<td style='border:1px solid #eee;'>".$item["funcion"]."</td>
						<td style='border:1px solid #eee;'>".$item["jls"]."</td>
						<td style='border:1px solid #eee;'>".$item["qdc"]."</td>
						<td style='border:1px solid #eee;'>".$item["comentarios"]."</td>
					</tr>");					
				
				}
			echo "</table>"; 

	} // static public function ctrExpProdExcel()

	// Buscar "Modelo" en la capturas del "Producto"
	static public function ctrBuscarModelo($buscar)
	{
		$tabla = "t_Modelo";
		$respuesta = ModeloProductos::mdlBuscarModelo($tabla,$buscar);
		return $respuesta;
	}
 

} // class ControladorProductos



?>
