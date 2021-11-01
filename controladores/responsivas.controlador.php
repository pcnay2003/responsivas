<?php
	
	require_once "funciones.php";
	
	class ControladorResponsivas
	{
		
		static public function buscarEnArreglo($valor,$arreglo)
		{
			for ($i=0;$i<count($arreglo);$i++)
			{				
				if ($arreglo[$i]["id"]==$valor)
				{
					$encontrado = true;
					break;
				}
				else
				{
					$encontrado = false;
				}
					

			} // ($i=0;$i<count($arreglo);$i++)
				
			return $encontrado;

		} // static public buscarEnArreglo($valor,$arreglo)


		static public function ctrMostrarResponsivas($item,$valor,$ordenar)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
			return $respuesta;
		}

		static public function ctrMostrarNumResponsiva()
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarNumResponsiva($tabla);
			return $respuesta;
		}

		static public function ctrMostrarResponsivasPerifAsign($item,$valor)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivasPerifAsign($tabla,$item,$valor);
			return $respuesta;
		}

		// Obtiene los equipos que estan prestados.
		static public function ctrMostrarRespEposPrestados()
		{
			$respuesta = ModeloResponsivas::mdlMostrarRespEposPrestados();
			return $respuesta;
		}

		// Obtiene las Responsivas de un Rango de Fechas.
		static public function ctrMostrarRespRangosFecha($fecha_inic,$fecha_fin)
		{			
			$respuesta = ModeloResponsivas::mdlMostrarRespRangosFecha($fecha_inic,$fecha_fin);
			return $respuesta;
		}


		// Crear Responsiva.
		static public function ctrCrearResponsiva()
		{
			// Debe existir la variable Global de tipo POST
			if (isset($_POST["nuevoNumResp"]))
			{
				// Actualizar las compras del Empleado.
				
				// Reducir el Stock y Aumnetar las ventas de los productos.
				// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.

				$listarProductos = json_decode($_POST["listaProductos"],true);
				//var_dump($listarProductos);

					// Se obtiene los productos que se utilizan en la responsiva
				// $listarProductos = Contiene los renglones(productos) de la responsiva.
				foreach ($listarProductos as $key => $value)
				{
					// Se obtienen los productos desde la tabla de acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
					$tablaProducto = "t_Productos";
					$item = "id_producto";
					$valor = $value["id"];
					$orden = "nombre";
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProducto,$item,$valor,$orden);
					// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.
					
					// var_dump($traerProducto);
					// Muestra el contenido del campo "Serial"
					// var_dump($traerProducto["Serial"]);

					// Actualizando la existencia y el numero de veces que se ha vendido.
				
					// Numero de veces que se ha vendido.
					/*
						// Ingresando en Json el los productos de la responsiva 
								listarProductos.push({"id" : $(descripcion[i]).attr("idProducto"),
																			"descripcion" : $(descripcion[i]).val(),
																			"cantidad" : $(cantidad[i]).val(),
																			"stock" : $(cantidad[i]).attr("nuevoStock"),
																			"precio" : $(precio[i]).attr("precioReal"),
																			"total" : $(precio[i]).val()});	 
							} 
	
					*/

					$item1a = "cuantas_veces";
					$valor1a = $value["cantidad"]+$traerProducto["Cuantas_veces"];

					// Actualizar "cuantas veces" en la tabla de "Productos"
					// $valor = Es el contenido del "Id"
					// $item1a = "cuantas_veces" es el campo que se utilizara a modificar
					// $valor1a = Es el nuevo valor de "Cuantas_veces".

					// static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1a,$valor1a,$valor);

					if ($nuevasVentas=="error")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al actualizar cuantas veces ",
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


					// Modificacion del "Stock". 
					
					$item1b = "stock"; // Es el campo que se modificara
					$valor1b = $value["stock"]; // Es el stock actual (utilizado en los renglones de la responsiva).

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1b,$valor1b,$valor);

					// Asignando el empleado que tiene el "Periferico". 
					
					$item1b = "id_empleado"; // Es el campo que se modificara
					$valor1b = $_POST["idEmpleado"]; // Se asigna el empleado que tiene el periferico(renglons de la responsiva).

					$empleadoAsignado = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1b,$valor1b,$valor);
					
					if ($empleadoAsignado == "error")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al asignar al empleado",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="cap-responsivas";
								}

								});
			
							</script>';          
					}


				} // foreach ($listarProductos as $key => $value)

				// Guardar la responsiva, en la base de datos.
				
				
				// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
				$fecha_asig = date("Y-m-d",strtotime($_POST["nuevaFechaAsignado"]));
				$fecha_devol = date("Y-m-d",strtotime($_POST["nuevaFechaDevolucion"]));

				if ($fecha_devol == '1970-01-01')
					$fecha_devol = null;

				$tabla = "t_Responsivas";
				$datos = array ("id_empleado"=>$_POST["idEmpleado"],
												"id_usuario"=>$_POST["idUsuario"],
												"id_almacen"=>$_POST["nuevaPlanta"],
												"activa"=>'S',
												"num_folio"=>$_POST["nuevoNumResp"],
												"modalidad_entrega"=>$_POST["nuevoMetodoPago"],												
												"num_ticket"=>$_POST["nuevoTicket"],
												"comentarios"=>rtrim($_POST["nuevoComentario"]),
												"productos"=>$_POST["listaProductos"],
												"impuesto"=>$_POST["nuevoPrecioImpuesto"],
												"neto"=>$_POST["nuevoPrecioNeto"],
												"total"=>$_POST["totalVenta"],
												"fecha_asignado"=>$fecha_asig, 
												"fecha_devolucion"=>$fecha_devol);

				//var_dump($datos);
				//return;

			 $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);

			if ($respuesta == "ok")
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "La Responsiva ha sido Guardada correctamente ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							window.location="responsivas";
							//window.location="cap-responsiva";
						}

						});
	
					</script>';          
			}
			else
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "Error Al Grabar la Responsivas, revisar los campos de Capturas",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							// window.location="responsivas";
							window.location="cap-responsiva";
						}

						});
	
					</script>';
			}


			} // if (isset($_POST["nuevoNumResp"]))

		} // static public functio ctrCrearVenta()


		// Editar Responsiva.
		static public function ctrEditarResponsiva()
		{
			// Debe existir la variable Global de tipo POST
			if (isset($_POST["editarNumResp"]))
			{
				// Antes de realizar la edicion de la Responsiva, se tiene formatear la tabla para que tenga los valores antes de haber realizado la edicion de la responsiva. Ya que puede ser que se eliminen productos por lo que se tiene que actualizar el inventario de productos.

				// Se obtienen los productos desde la tabla de responsiva.
				// Dee acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
				$tabla = "t_Responsivas";
				$item = "num_folio";
				$valor = $_POST["editarNumResp"];
				$orden = "ConsultaCompleja";
				$traerResponsiva = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$orden);

				// Se decodifica de formato JSon a Arreglo
				$artRespOriginal = json_decode($traerResponsiva["productos"],true);
				
				/* $prodActualizar = json_decode($traerResponsiva["productos"],true);
				print_r('<pre>');
				print_r('<br>');
				print_r ($artRespOriginal);
				print_r('</pre>');
				exit;
				*/
				
				// Para evitar el error de que se borren los datos de JSon en el "productos" de a tabla de "Responsivas". Si no se editaron productos de la responsiva.				

					$cambioProducto = false;
					if ($_POST["listaProductos"] == "")
					{
						// Si no se modificaron los productos de la Responsiva.
						$listaProductos = $traerResponsiva["productos"];
						// Para identificar cuando cambio el producto.
						// Ya que actualiza mal el inventario 
						$cambioProducto = false;

					}
					else
					{
						// Si se editaron los productos de la Responsiva
						$listaProductos = $_POST["listaProductos"];
						$cambioProducto = true;

					}

					if ($cambioProducto)
					{
						// Lo convierte de JSon a Arreglos para poder utilizarlo en la base de datos.
						$prodActualizar = json_decode($traerResponsiva["productos"],true);


						// Actualizar la tabla de productos con los productos que tiene la responsiva antes de que se agregen los que estan en la edicion de la responsiva.

						// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.

						// Actualizar las compras del Empleado.
						
						// Reducir el Stock y Aumentar las ventas de los productos. Si se modificaron en la responsivas.
						// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.

						$listarProductos_2 = json_decode($listaProductos,true);
						//$artRespOriginal = json_decode($traerResponsiva["productos"],true);

						//print_r('<pre>');print_r($listarProductos_2);print_r('</pre>');
						//exit;
						//return;

						//print_r('<pre>');print_r('<br>');print_r ($listarProductos_2);print_r('</pre>');
						//exit;

							// Se obtiene los productos que se utilizan en la responsiva
						// $listarProductos_2 = Contiene los renglones(productos) de la responsiva.
						if (count($listarProductos_2)>(count($artRespOriginal)))
						{
							// En la edicion de la Responsiva se agrega un articulo mas.
							$articulosNuevosEdicion = 'S';
						}
						else
						{
							$articulosNuevosEdicion = 'N';
						}

						//print_r('<pre>');print_r('<br>');print_r($articulosNuevosEdicion);print_r('</pre>');
						//print_r('<pre>');print_r('<br>');print_r ($value["cantidad"]);print_r('</pre>');
						//print_r('<pre>');print_r('<br>');print_r ($valor1b_2);print_r('</pre>');
						//exit;

						foreach ($listarProductos_2 as $key => $value)
						{
							// Se obtienen los productos desde la tabla de acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
							$tablaProducto_2 = "t_Productos";
							$item_2 = "id_producto";
							$valor_2 = $value["id"];
							$orden_2 = "nombre";
							$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProducto_2,$item_2,$valor_2,$orden_2);
							// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.
							
							// var_dump($traerProducto_2);
							// Muestra el contenido del campo "Serial"
							// var_dump($traerProducto_2["Serial"]);

							// Actualizando la existencia y el numero de veces que se ha vendido.
						

							$item1a_2 = "cuantas_veces";
							$valor1a_2 = $value["cantidad"]+$traerProducto_2["Cuantas_veces"];

							// Actualizar "cuantas veces" en la tabla de "Productos"
							// $valor_2 = Es el contenido del "Id"
							// $item1a_2 = "cuantas_veces" es el campo que se utilizara a modificar
							// $valor1a_2 = Es el nuevo valor de "Cuantas_veces".

							// static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)

							$cuantasVeces_2 = ModeloProductos::mdlActualizarProducto($tablaProducto_2,$item1a_2,$valor1a_2,$valor_2);
/*
							if ($cuantasVeces_2=="error")
							{
								echo '<script>           
								Swal.fire ({
									type: "error",
									title: "Error al actualizar cuantas veces ",
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

*/
							if ($articulosNuevosEdicion == 'S')
							{

								$existe = ControladorResponsivas::buscarEnArreglo($value["id"], $artRespOriginal);
																
								if ($existe)
								{
									$encontrado = 'SI';
								}
								else
								{
									$encontrado = 'NO';
								}
								//print_r('<pre>');print_r('<br>');print_r ($encontrado);print_r('</pre>');
								//exit;


								if ($encontrado == 'NO')
								{			
									// Modificacion del "Stock". 			
									$tablaProducto_2 = "t_Productos";
									$item1b_2 = "stock"; // Es el campo que se modificara
									$valor1b_2 = $traerProducto_2["Stock"]-$value["cantidad"]; 
									/*
									print_r('<pre>');print_r('<br>');print_r ($traerProducto_2["Serial"]);print_r('</pre>');
									print_r('<pre>');print_r('<br>');print_r ($traerProducto_2["id_producto"]);print_r('</pre>');

									print_r('<pre>');print_r('<br>');print_r ($traerProducto_2["Stock"]);print_r('</pre>');
									print_r('<pre>');print_r('<br>');print_r ($value["cantidad"]);print_r('</pre>');
									print_r('<pre>');print_r('<br>');print_r ($valor1b_2);print_r('</pre>');
									exit;
									*/

									// Es el stock actual (utilizado en los renglones de la responsiva ya que se actualiza automaticamente.).

									$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProducto_2,$item1b_2,$valor1b_2,$valor_2);

			
									// Asignando el empleado que tiene el "Periferico". 
									
									$item1b_2 = "id_empleado"; // Es el campo que se modificara
									$valor1b_2 = $_POST["idEmpleado"]; // Se asigna el empleado que tiene el periferico(renglons de la responsiva).

									$empleadoAsignado_2 = ModeloProductos::mdlActualizarProducto($tablaProducto_2,$item1b_2,$valor1b_2,$valor_2);
									
									if ($empleadoAsignado_2 == "error")
									{
										echo '<script>           
										Swal.fire ({
											type: "error",
											title: "Error al asignar al empleado",
											showConfirmButton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
											}).then(function(result){
												if (result.value)
												{
													window.location="editar-responsivas";
												}

												});
							
											</script>';          
									}

								} // if (existe)

							} // if ($articulosNuevosEdicion == 'S')

							
						};// foreach ($listarProductos_2 as $key => $value)

						// Asignando el usuario IT a productos que se eliminaron de la lista de la Responsiva ylaumentando la existencia si se eliminaron o editaron depediendo del caso.

						// Productos de la Responsiva sin editar.
						//$artRespOriginal
						//print_r('<pre>');print_r('<br>');print_r ($artRespOriginal);print_r('</pre>');
						//print_r('<pre>');print_r('<br>');print_r ($listarProductos_2);print_r('</pre>');
						//exit;
						
						// $artRespOriginal = json_decode($traerResponsiva["productos"],true);

						if ($articulosNuevosEdicion == 'N')
						{
							for ($i=0;$i<count($artRespOriginal);$i++)
							{
								//$prodEliminado = 'N';
								// Arreglo que contiene los productos que se editaron en la Responsiva
								for ($y=0;$y<count($listarProductos_2);$y++)
								{
									if ($artRespOriginal[$i]["id"]==$listarProductos_2[$y]["id"])
									{
										$prodEliminado = 'N';
										break;
									}
									else
									{
										$prodEliminado = 'S';
										$id_ProductoBuscar = $artRespOriginal[$i]["id"];								
										$stockEnResp = $artRespOriginal[$i]["cantidad"];
									}
									

								} // for ($y=0;y<count($listarProductos_2);$y++)

								if ($prodEliminado == 'S')
								{
									// Traer el stock de la tabla de Productos para actualizarlo.
									$tablaProducto = "t_Productos";
									$item = "id_producto";
									$valor = $id_ProductoBuscar;
									$orden = "Ascendente";
									$stockActualTabla = ModeloProductos::mdlMostrarProductos($tablaProducto,$item,$valor,$orden);	

									// Actualizar la existencia del producto que se elimino.
									// $item1 = Actualizar de forma dinamica, Stok, precio, descripicon,
									// $valor1 = Es el valor del campo($item1) a modificar
									// $valor2 = Es el valor del "id" que se quiere modificar.
									$item1 = "stock";
									$valor1 = $stockActualTabla["Stock"]+$stockEnResp;
									$valor = $id_ProductoBuscar;
									$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1,$valor1,$valor);

									// Actualizando el Usuario asignado es es "DeptoIT"
									$item1 = "id_empleado";
									$valor1 = 1;
									$valor = $id_ProductoBuscar;
									$empleadoAsignado = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1,$valor1,$valor);

									/*
									print_r('<pre>');print_r('<br>');
									print_r ("Serial ".$stockActualTabla["Serial"]);
									print_r ("Stock Producto ".$stockActualTabla["Stock"]);
									print_r ("Stock En Responsiva ".$stockEnResp);
									print_r('</pre>');																	
									*/
									
								}


							}	// for ($i=0;i<count($artRespOrignal);$i++)										
						
						} // if ($articulosNuevosEdicion == 'N')

					} // if ($cambioProducto )						


						// Guardar la Edicion de la Responsiva, en la base de datos.

						// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
						$fecha_asig_2 = date("Y-m-d",strtotime($_POST["nuevaFechaAsignado"]));
						$fecha_devol_2 = date("Y-m-d",strtotime($_POST["nuevaFechaDevolucion"]));

						if ($fecha_devol_2 == '1970-01-01')
							$fecha_devol_2 = null;

						$tabla = "t_Responsivas";
						$datos = array ("id_responsiva"=>$_GET["idResponsiva"],
														"id_empleado"=>$_POST["idEmpleado"],
														"id_usuario"=>$_POST["idUsuario"],
														"id_almacen"=>$_POST["editarPlanta"],
														"activa"=>'S',
														"num_folio"=>$_POST["editarNumResp"],
														"modalidad_entrega"=>$_POST["nuevoMetodoPago"],												
														"num_ticket"=>$_POST["editarTicket"],
														"comentarios"=>rtrim($_POST["editarComentario"]),
														"productos"=>$listaProductos,
														"impuesto"=>$_POST["nuevoPrecioImpuesto"],
														"neto"=>$_POST["nuevoPrecioNeto"],
														"total"=>$_POST["totalVenta"],
														"fecha_asignado"=>$fecha_asig_2, 
														"fecha_devolucion"=>$fecha_devol_2);

					$respuesta = ModeloResponsivas::mdlEditarResponsiva($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Responsiva ha sido Editada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									// window.location="responsivas";
									window.location="responsivas";
								}

								});

							</script>';          
					}
					else
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "Error Al Grabar la Responsivas, revisar los campos de Capturas",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									// window.location="responsivas";
									window.location="responsivas";
								}

								});

							</script>';
					}	// else if ($respuesta == "ok")				

			} // if (isset($_POST["editarNumResp"]))

		} // static public functio ctrEditarResponsiva()

		
		// Eliminar Responsiva
		static public function ctrEliminarResponsiva()
		{
			if(isset($_GET["idResponsiva"]))
			{
				/*
				$tabla = "t_Responsivas";
				$item = "id_responsiva";
				$valor = $_GET["idResponsiva"];
				$ordenar = "ConsultaSencilla";
				$traerResponsiva = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
				*/


				// Se obtienen los productos desde la tabla de acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
				$tabla = "t_Responsivas";
				$item = "id_responsiva";
				$valor = $_GET["idResponsiva"];
				$orden = "ConsultaCompleja";
				$traerResponsiva = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$orden);

				$prodActualizar = json_decode($traerResponsiva["productos"],true);

				// Actualizar la tabla de productos con los productos que tiene la responsiva antes de que se agregen los que estan en la edicion de la responsiva.
				foreach ($prodActualizar as $key => $value)
				{
					$tablaProducto = "t_Productos";
					$item = "id_producto";
					$valor = $value["id"];
					$orden = "nombre";
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProducto,$item,$valor,$orden);

					// Para actualizar cuantas veces se ha utilizado este producto.
					$item1a = "cuantas_veces";
					$valor1a = $traerProducto["Cuantas_veces"] - $value["cantidad"];

					$cuantasVeces = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1a,$valor1a,$valor);	

					// Actualizar el "Stock" en Productos con la existencia antes de aplicar si se modificaron en la edicion de la Responsiva.

					// Modificacion del "Stock". 					
					$tablaProducto = "t_Productos";
					$item1b = "stock"; // Es el campo que se modificara
					$valor1b = $value["cantidad"]+$traerProducto["Stock"]; // Es el stock actual (utilizado en los renglones de la responsiva).

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1b,$valor1b,$valor);	

					// Asignando el empleado que tiene el "Periferico". 

					$item1b = "id_empleado"; // Es el campo que se modificara
					$valor1b = '1'; // Empleado "Depto IT", se asigna el empleado que tiene el periferico(renglons de la responsiva).
					/* Para mostrar en pantalla cuando se esta ejecutando el programa 
					echo "<pre>";
					echo ("tabla: ".$tablaProducto);
					echo ("<br>");
					echo ("item1b: ".$item1b);
					echo ("<br>");
					echo ("valor1b: ".$valor1b);
					echo ("<br>");
					echo ("Id Producto: ".$valor);
					echo ("<br>");
					echo "</pre>";
					return;
					*/

					$empleadoAsignado = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1b,$valor1b,$valor);
					
					if ($empleadoAsignado == "error")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al asignar al empleado",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="cap-responsivas";
								}

								});
			
							</script>';          
					}
					

				} // foreach ($prodActualizar as $key => $value)
				
				// Actualizar las compras del Empleado.
				
				// Reducir el Stock y Aumentar las ventas de los productos. Si se modificaron en la responsivas.
				// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.

		/*		
				$listarProductos_2 = json_decode($listaProductos,true);
				//var_dump($listarProductos);

					// Se obtiene los productos que se utilizan en la responsiva
				// $listarProductos_2 = Contiene los renglones(productos) de la responsiva.
				foreach ($listarProductos_2 as $key => $value)
				{
					// Se obtienen los productos desde la tabla de acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
					$tablaProducto_2 = "t_Productos";
					$item_2 = "id_producto";
					$valor_2 = $value["id"];
					$orden_2 = "nombre";
					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProducto_2,$item_2,$valor_2,$orden_2);
					// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.
					
					// var_dump($traerProducto_2);
					// Muestra el contenido del campo "Serial"
					// var_dump($traerProducto_2["Serial"]);

					// Actualizando la existencia y el numero de veces que se ha vendido.
				

					$item1a_2 = "cuantas_veces";
					$valor1a_2 = $value["cantidad"]+$traerProducto_2["Cuantas_veces"];

					// Actualizar "cuantas veces" en la tabla de "Productos"
					// $valor_2 = Es el contenido del "Id"
					// $item1a_2 = "cuantas_veces" es el campo que se utilizara a modificar
					// $valor1a_2 = Es el nuevo valor de "Cuantas_veces".

					// static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)

					$cuantasVeces_2 = ModeloProductos::mdlActualizarProducto($tablaProducto_2,$item1a_2,$valor1a_2,$valor_2);

					if ($cuantasVeces_2=="error")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al actualizar cuantas veces ",
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


					// Modificacion del "Stock". 					
					$item1b_2 = "stock"; // Es el campo que se modificara
					$valor1b_2 = $value["stock"]; // Es el stock actual (utilizado en los renglones de la responsiva ya que se actualiza automaticamente.).

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProducto_2,$item1b_2,$valor1b_2,$valor_2);


				} // foreach ($listarProductos_2 as $key => $value)
		*/
				$item = "id_responsiva";
				$datos = $_GET["idResponsiva"];
	//			print_r ($valor);
	//			return;
		
				$respuesta = ModeloResponsivas::mdlEliminarResponsiva($tabla,$datos);

				if ($respuesta == "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Responsiva Esta dada De Baja correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="responsivas";
							}

						});		
						</script>';          
				}

			}	// if(isset($_GET["idResponsiva"]))

		} // 		static public function ctrEliminarResponsiva()


		static public function ctrCrearRep_Finanzas($rep_mensual)
		{			
			$tabla = "t_Rep_Finanzas";
			$respuesta = ModeloResponsivas::mdlIngresarRep_Finanzas($tabla,$rep_mensual);
			/*
			if ($respuesta != "ok" )
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "Error Al Grabar los Datos, revisar los campos de Capturas",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							// window.location="responsivas";
							//window.location="responsivas";
						}

						});

					</script>';
			}	// else if ($respuesta == "ok")				
			*/
			
		}

		static public function ctrMostrarRep_Finanzas()
		{
			$tabla = "t_Rep_Finanzas";			
			$respuesta = ModeloResponsivas::mdlMostrarRep_Finanzas($tabla);
			return $respuesta;
		}

		static public function ctrBorrarRep_Finanzas()
		{
			$tabla = "t_Rep_Finanzas";			
			$respuesta = ModeloResponsivas::mdlBorrarRep_Finanzas($tabla);
			return $respuesta;
		}

	} // class ControladorResponsivas





