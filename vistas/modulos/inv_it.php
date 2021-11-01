  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUBIR INVENTARIO I.T. - CSV
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

		<div class="panel panel-default">
			<div class="panel-body">
			<br>
				<div class="row">
					<form action="" method="post" enctype="multipart/form-data" id="import_form">
						<div class="col-md-3">
							<input type="file" name="file" />
						</div>
						<div class="col-md-5">
							<input type="submit" class="btn btn-primary" name="import_inv" value="IMPORTAR">
						</div>
					</form>
				</div>
  		</div>
		</div>	
  <!-- /.content-wrapper -->

<?php

	// Obtener los Modelos, Marcas, Perifericos.
	$tabla = "t_Modelo";
	$item = null;
	$valor = null;
	$Arreglo_modelos = ModeloModelos::mdlMostrarModelos($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo los modelos");
	//var_dump($Arreglo_modelos);

	$tabla = "t_Marca";
	$item = null;
	$valor = null;
	$Arreglo_marcas = ModeloMarcas::mdlMostrarMarcas($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo las Marcas");
	//var_dump($Arreglo_marcas);

	$tabla = "t_Periferico";
	$item = null;
	$valor = null;
	$Arreglo_perifericos = ModeloPerifericos::mdlMostrarPerifericos($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo los Perifericos");
	//var_dump($Arreglo_perifericos);

	$tabla = "t_Ubicacion";
	$item = null;
	$valor = null;
	$Arreglo_ubicaciones = ModeloUbicaciones::mdlMostrarUbicaciones($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo las Ubicaciones");
	//var_dump($Arreglo_ubicacion);

	$tabla = "t_Linea";
	$item = null;
	$valor = null;
	$Arreglo_linea = ModeloLineas::mdlMostrarLineas($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo las Lineas");
	//var_dump($Arreglo_linea);


	// Pasandolo a un arreglo bidimencional los Modelos obtenidos
	$Modelos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Modelos_Obtenidos[$q][$a] = $Arreglo_modelos[$q]["id_modelo"];
			if ($a == 1)
				$Modelos_Obtenidos[$q][$a] = strtolower($Arreglo_modelos[$q]["descripcion"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Marcas obtenidas
	$Marcas_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_marcas);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Marcas_Obtenidas[$q][$a] = $Arreglo_marcas[$q]["id_marca"];
			if ($a == 1)
				$Marcas_Obtenidas[$q][$a] = strtolower($Arreglo_marcas[$q]["descripcion"]);
		}
		
	}

	//var_dump($Marcas_Obtenidas);

	// Pasandolo a un arreglo bidimencional los Perifericos obtenidos
	$Perifericos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_perifericos);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Perifericos_Obtenidos[$q][$a] = $Arreglo_perifericos[$q]["id_periferico"];
			if ($a == 1)
				$Perifericos_Obtenidos[$q][$a] = strtolower($Arreglo_perifericos[$q]["nombre"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Ubicaciones obtenidas
	$Ubicaciones_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_ubicaciones);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Ubicaciones_Obtenidas[$q][$a] = $Arreglo_ubicaciones[$q]["id_ubicacion"];
			if ($a == 1)
				$Ubicaciones_Obtenidas[$q][$a] = strtolower($Arreglo_ubicaciones[$q]["descripcion"]);
		}
		
	}

	//var_dump($Ubicaciones_Obtenidas);


	// Pasandolo a un arreglo bidimencional las Lineas obtenidas
	$Lineas_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_linea);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Lineas_Obtenidas[$q][$a] = $Arreglo_linea[$q]["id_linea"];
			if ($a == 1)
				$Lineas_Obtenidas[$q][$a] = strtolower($Arreglo_linea[$q]["descripcion"]);
		}
		
	}
	

	// Obtener la Marca.
	function Obtener_IdMarca($Arreglo_marca,$reg_csv_marca)
	{
		$columna_1 = 0;					
		
		//var_dump($Arreglo_marca);
		$separar_cadena = explode(" ",$reg_csv_marca);
		//print ("Tamaño -separar_cadena- : ".count($separar_cadena));

		$Marcas = 'Sin Marcas';
		for ($l=0;$l<count($Arreglo_marca);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{
					$encontro = strpos($Arreglo_marca[$l][$n],$separar_cadena[$k]);

					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
					}
				} // for ($k=0;$k<count($separar_cadena);$k++)

				if ($contador_pal == count($separar_cadena))
				{
					$Marcas = $Arreglo_marca[$l][$n-1];
					return $Marcas;
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_marca);$l++)

		return $Marcas;

	} // function Obtener_IdMarca() 

	// Obtener el Modelo	
	function Obtener_IdModelo($Arreglo_modelos,$reg_csv)
	{
		$columna_1 = 0;					

		$separar_cadena = explode(" ",$reg_csv);

		$Modelos = "Sin Modelos";
		for ($l=0;$l<count($Arreglo_modelos);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{

					$encontro = strpos($Arreglo_modelos[$l][$n],$separar_cadena[$k]);
					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
						//print_r("Valor encontrado ".$separar_cadena[$k].' '.$encontro);
						//print("<br>");
					}
				} // for ($k=0;$k<2;$k++)

				if ($contador_pal == count($separar_cadena))
				{
//					print("<br>");
//					print_r ("Valor del indice modelo = ".$Arreglo_modelos[$l][$n-1]);
						$Modelos = $Arreglo_modelos[$l][$n-1];
					return $Modelos;
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_modelo);$l++)

		return $Modelos;

	} // function Obtener_IdModelo() 


	// Obtener el periferico.
	function Obtener_IdPeriferico($Arreglo_perifericos,$reg_csv_perif)
	{
		$columna_1 = 0;					
		$Perifericos = "Sin Perifericos";
		$separar_cadena = explode(" ",$reg_csv_perif);
		for ($l=0;$l<count($Arreglo_perifericos);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{				
					$encontro = strpos($Arreglo_perifericos[$l][$n],$separar_cadena[$k]);
					
					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
					}

				} // for ($k=0;$k<2;$k++)

					if ($contador_pal == count($separar_cadena))
					{
						//print_r("Valor NO encontrado ");
//						print("<br>");
//						print_r ("Valor del indice periferico = ".$Arreglo_perifericos[$l][$n-1]);
							$Perifericos = $Arreglo_perifericos[$l][$n-1];
						return $Perifericos;					
					}				

			} // for ($n=0;$n<2;$n++)			

		} // for ($l=0;$l<count($Arreglo_periferico);$l++)
		return $Perifericos;

	} // function Obtener_IdPerifericos() 


// Obtener la Ubicacion.
function Obtener_IdUbicacion($Arreglo_ubicaciones,$reg_csv_ubic)
{
	$columna_1 = 0;					
	$Ubicacion = "Sin Ubicacion";
	$separar_cadena = explode(" ",$reg_csv_ubic);
	for ($l=0;$l<count($Arreglo_ubicaciones);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$contador_pal = 0;
			for ($k=0;$k<count($separar_cadena);$k++)
			{				
				$encontro = strpos($Arreglo_ubicaciones[$l][$n],$separar_cadena[$k]);
				
				if ($encontro === false)
				{
					//print_r("Valor NO encontrado ");
				}
				else
				{
					$contador_pal++;
				}

			} // for ($k=0;$k<2;$k++)

				if ($contador_pal == count($separar_cadena))
				{
					//print_r("Valor NO encontrado ");
//						print("<br>");
//						print_r ("Valor del indice periferico = ".$Arreglo_ubicaciones[$l][$n-1]);
						$Ubicacion = $Arreglo_ubicaciones[$l][$n-1];
					return $Ubicacion;					
				}				

		} // for ($n=0;$n<2;$n++)			

	} // for ($l=0;$l<count($Arreglo_ubicaciones);$l++)
	return $Ubicacion;

} // function Obtener_IdUbicaciones() 

// Obtener la Linea.
function Obtener_IdLinea($Arreglo_linea,$reg_csv_linea)
{
	$columna_1 = 0;					
	$Linea = "Sin Linea";
	$separar_cadena = explode(" ",$reg_csv_linea);
	for ($l=0;$l<count($Arreglo_linea);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$contador_pal = 0;
			for ($k=0;$k<count($separar_cadena);$k++)
			{				
				$encontro = strpos($Arreglo_linea[$l][$n],$separar_cadena[$k]);
				
				if ($encontro === false)
				{
					//print_r("Valor NO encontrado ");
				}
				else
				{
					$contador_pal++;
				}

			} // for ($k=0;$k<2;$k++)

				if ($contador_pal == count($separar_cadena))
				{
					//print_r("Valor NO encontrado ");
//						print("<br>");
//						print_r ("Valor del indice periferico = ".$Arreglo_ubicaciones[$l][$n-1]);
						$Linea = $Arreglo_linea[$l][$n-1];
					return $Linea;					
				}				

		} // for ($n=0;$n<2;$n++)			

	} // for ($l=0;$l<count($Arreglo_linea);$l++)
	return $Linea;

} // function Obtener_IdLinea() 


	/*
	//Desṕlegando el contenido  del arrenglo recien creado 
	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		for($a=0;$a<2;$a++)
		{
			print_r("Contenido de -arreglo-".$arreglo[$q][$a]);
			print_r("<br>");
		}
	}
*/



	//var_dump($Arreglo_modelos);

// Importando el archivo CSV
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file_it = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				
				$datos_grabar = array();
				$num_reg_no_existen = 0;
				$num_reg_existen = 0;
				$ruta = "vistas/img/productos/default/anonymous.png";

				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{
					// **** Para subir el inventario de IT
								
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

					// Revisando si el Serial esta vacio.
					if (!empty($inv_it[8])) 
					{
						$valor = $inv_it[8]; // Serial
						$item = "num_serie";
						$tabla = "t_Productos";
						$orden = "nombre";

						// Descomentar para que detemrine si existe el producto.
						$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
						
						// if (!empty($exite_prod))
						// if (!$exite_prod)
						
						// Verifica si ya existe el serial en la tabla
						//$existe_prod = "";
						if (empty($exite_prod))
						{
							$Modelo = Obtener_IdModelo($Modelos_Obtenidos,strtolower($inv_it[7]));
							$Marca = Obtener_IdMarca($Marcas_Obtenidas,strtolower($inv_it[6]));
							$Periferico = Obtener_IdPeriferico($Perifericos_Obtenidos,strtolower($inv_it[5]));
							$Precio = 0;
							
							switch ($Periferico)
							{
								case (1):
									$Precio = 800;
									break;
								case (2):	
									$Precio = 1200;
									break;
								case (3):
									$Precio = 220;
									break;
								case (4):
									$Precio = 220;
									break;								
								case (32):
									$Precio = 1000;
									break;
								case (33):
									$Precio = 200;
									break;
								case (12):
									$Precio = 800;
									break;
								case (88):	
									$Precio = 370;
									break;
								case (13):
									$Precio = 800;
									break;
								case (15):
									$Precio = 2540;
									break;								
								case (14):
									$Precio = 2350;
									break;
								case (25):
									$Precio = 850;
									break;
								case (16):
									$Precio = 6000;
									break;	
								}

							$datos_grabar = array("id_modelo"=>$Modelo,		
																		"id_marca"=>$Marca,
																		"id_periferico"=>$Periferico,
																		"nomenclatura"=>$inv_it[4],
																		"num_serie"=>$inv_it[8],
																		"asset"=>$inv_it[0],
																		"id_telefonia" =>1,
																		"id_plan_tel" =>1,
																		"num_tel" =>'',
																		"cuenta" =>'',
																		"direcc_mac_tel" =>'',
																		"imei_tel" =>'',
																		"num_ip" =>'',
																		"edo_tel" =>'NO Aplica',
																		"id_empleado" =>1,
																		"id_almacen" =>1,
																		"id_edo_epo" =>1,
																		"stock" =>1,
																		"precio_compra" =>$Precio,
																		"precio_venta" =>$Precio,
																		"comentarios" =>rtrim(" "),
																		"loftware" =>'',
																		"id_ubicacion" =>3,
																		"id_linea" =>1,
																		"estacion" =>'',
																		"npa" =>'',
																		"idf" =>'',
																		"patch_panel" =>'',
																		"puerto" =>'',
																		"funcion" =>'',
																		"jls" =>'',
																		"qdc" =>'',
																		"cuantas_veces" =>1,
																		"imagen"=>$ruta
																	);
					
							//print_r('Registros GRABADOS ======> ');																								
							print_r('Asset = '.$inv_it[0].' ; ');
							print_r('Current Hostname = '.$inv_it[4].' ; ');
							print_r('Periferico  Kind = '.$datos_grabar["id_periferico"].' ; ');						
							print_r('Brand  Marca = '.$datos_grabar["id_marca"].' ; ');
							print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');						
							print_r('Serial = '.$inv_it[8].' ; ');						
							print "<br>";
														
							//$num_reg_no_existen++;
							// Grabar el registro en la tabla.
							if (($datos_grabar["id_modelo"] != "Sin Modelos") && ($datos_grabar["id_marca"] != "Sin Marcas") && ($datos_grabar["id_periferico"] != "Sin Perifericos"))
							{
								$respuesta = "error";
								//$respuesta = "ok";
								$tabla = "t_Productos";
								// Descomentarla para que grabe en la tabla
								$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos_grabar);

								if ($respuesta == "ok")
								{	
									$num_reg_no_existen++;	
								}
								else
								{
									print_r ("error al grabar el registros en la Base de Datos  : ".$datos_grabar["num_serie"]);
									print ("<br>");									
								}
							}
							else   // if ($datos_grabar["id_modelo"] != "Sin Modelos") ....
							{
								print_r("Registros NO GRABADOS ===> : ");
								print_r('Asset = '.$inv_it[0].' ; ');
								print_r('Current Hostname = '.$inv_it[4].' ; ');
								print_r('Periferico  Kind = '.$datos_grabar["id_periferico"].' ; ');						
								print_r('Brand  Marca = '.$datos_grabar["id_marca"].' ; ');
								print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');						
								print_r('Serial = '.$inv_it[8].' ; ');						
								print "<br>";
							}
							
						}
						else // if (empty($exite_prod))
						{
							$num_reg_existen++;
						}

					} // if (!empty($inv_it[8]))
		
			/*
					// **** Para subir el Inventario de Máquinas de Producción.
									
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

					// Revisando si el Serial esta vacio.
					if (!empty($inv_it[5])) 
					{
						$valor = $inv_it[5]; // Serial
						$item = "num_serie";
						$tabla = "t_Productos";
						$orden = "nombre";

						// Descomentar para que detemrine si existe el producto.
						$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
						
						// if (!empty($exite_prod))
						// if (!$exite_prod)
						
						// Verifica si ya existe el serial en la tabla
						//$existe_prod = "";
						if (empty($exite_prod))
						{
							$Modelo = Obtener_IdModelo($Modelos_Obtenidos,strtolower($inv_it[4]));
							$Marca = Obtener_IdMarca($Marcas_Obtenidas,strtolower($inv_it[3]));
							$Periferico = Obtener_IdPeriferico($Perifericos_Obtenidos,strtolower($inv_it[2]));
							switch ($Periferico)
							{
								case (1):
									$Precio = 800;
									break;
								case (2):	
									$Precio = 1200;
									break;
								case (3):
									$Precio = 220;
									break;
								case (4):
									$Precio = 220;
									break;								
								case (32):
									$Precio = 1000;
									break;
								case (33):
									$Precio = 200;
									break;
							}

							$datos_grabar = array("id_modelo"=>$Modelo,		
																		"id_marca"=>$Marca,
																		"id_periferico"=>$Periferico,
																		"nomenclatura"=>$inv_it[1],
																		"num_serie"=>$inv_it[5],
																		"asset"=>$inv_it[0],
																		"id_telefonia" =>1,
																		"id_plan_tel" =>1,
																		"num_tel" =>'',
																		"cuenta" =>'',
																		"direcc_mac_tel" =>'',
																		"imei_tel" =>'',
																		"num_ip" =>'',
																		"edo_tel" =>'NO Aplica',
																		"id_empleado" =>1,
																		"id_almacen" =>1,
																		"id_edo_epo" =>1,
																		"stock" =>1,
																		"precio_compra" =>$Precio,
																		"precio_venta" =>$Precio,
																		"comentarios" =>rtrim(" "),
																		"loftware" =>'',
																		"id_ubicacion" =>3,
																		"id_linea" =>1,
																		"estacion" =>$inv_it[9],
																		"npa" =>$inv_it[8],
																		"idf" =>$inv_it[10],
																		"patch_panel" =>$inv_it[11],
																		"puerto" =>$inv_it[12],
																		"funcion" =>$inv_it[13],
																		"jls" =>'',
																		"qdc" =>'',
																		"cuantas_veces" =>1,
																		"imagen"=>$ruta
																	);
					
																								
							print_r('Asset = '.$inv_it[0].' ; ');
							print_r('Current Hostname = '.$inv_it[1].' ; ');
							print_r('Periferico  Kind = '.$datos_grabar["id_periferico"].' ; ');						
							print_r('Brand  Marca = '.$datos_grabar["id_marca"].' ; ');
							print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');						
							print_r('Serial = '.$inv_it[5].' ; ');						
							print "<br>";
														
							$num_reg_no_existen++;
												// Grabar el registro en la tabla.
							$respuesta = "error";
							$tabla = "t_Productos";
							// Descomentarla para que grabe en la tabla
							$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos_grabar);
							
							if ($respuesta != "ok")
							{
								print_r ("error al grabar el registros : ".$datos_grabar["num_serie"]);
								print ("<br>");
							}
						}
						else
						{
							$num_reg_existen++;
						}

					} // if (!empty($inv_it[8]))
			*/

	/*	
					// **** Para subir el Inventario de Máquinas de Producción.
									
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

					// Revisando si el Serial esta vacio.
					if (!empty($inv_it[4])) 
					{
						$valor = $inv_it[4]; // Serial
						$item = "num_serie";
						$tabla = "t_Productos";
						$orden = "nombre";

						// Descomentar para que detemrine si existe el producto.
						$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
						
						// if (!empty($exite_prod))
						// if (!$exite_prod)
						
						// Verifica si ya existe el serial en la tabla
						//$existe_prod = "";
						if (empty($exite_prod))
						{
							$Modelo = Obtener_IdModelo($Modelos_Obtenidos,strtolower($inv_it[3]));
							$Marca = 5;
							$Periferico = 14;
							$Ubicacion = Obtener_IdUbicacion($Ubicaciones_Obtenidas,strtolower($inv_it[5]));
							$Linea = Obtener_IdLinea($Lineas_Obtenidas,strtolower($inv_it[6]));
							if ($Linea == "Sin Linea")
							{
								$Linea = 13;
							}

							switch ($Modelo)
							{						
								case (12):
									$Precio = 800;
									break;
								case (88):	
									$Precio = 370;
									break;
								case (13):
									$Precio = 800;
									break;
								case (15):
									$Precio = 2540;
									break;								
								case (14):
									$Precio = 2350;
									break;
							case (25):
									$Precio = 850;
									break;
								case (16):
									$Precio = 6000;
									break;	
							}

							$datos_grabar = array("id_modelo"=>$Modelo,		
																		"id_marca"=>$Marca,
																		"id_periferico"=>$Periferico,
																		"nomenclatura"=>'',
																		"num_serie"=>$inv_it[4],
																		"asset"=>$inv_it[0],
																		"id_telefonia" =>1,
																		"id_plan_tel" =>1,
																		"num_tel" =>'',
																		"cuenta" =>'',
																		"direcc_mac_tel" =>'',
																		"imei_tel" =>'',
																		"num_ip" =>$inv_it[9],
																		"edo_tel" =>'NO Aplica',
																		"id_empleado" =>1,
																		"id_almacen" =>1,
																		"id_edo_epo" =>1,
																		"stock" =>1,
																		"precio_compra" =>$Precio,
																		"precio_venta" =>$Precio,
																		"comentarios" =>rtrim($inv_it[14]),
																		"loftware" =>$inv_it[1],
																		"id_ubicacion" =>$Ubicacion,
																		"id_linea" =>$Linea,
																		"estacion" =>$inv_it[8],
																		"npa" =>$inv_it[7],
																		"idf" =>$inv_it[10],
																		"patch_panel" =>$inv_it[11],
																		"puerto" =>$inv_it[12],
																		"funcion" =>$inv_it[13],
																		"jls" =>'',
																		"qdc" =>'',
																		"cuantas_veces" =>1,
																		"imagen"=>$ruta
																	);
					
																								
							print_r('Asset = '.$inv_it[0].' ; ');							
							print_r('Periferico  Kind = Impresora Termica ');						
							print_r('Brand  Marca = Zebra ');
							print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');					
							print_r('Linea  = '.$datos_grabar["id_linea"].' ; ');
							print_r('Area  = '.$datos_grabar["id_ubicacion"].' ; ');
							print_r('Serial = '.$inv_it[4].' ; ');						
							print "<br>";
														
							$num_reg_no_existen++;
												// Grabar el registro en la tabla.
							$respuesta = "error";
							$tabla = "t_Productos";
							// Descomentarla para que grabe en la tabla
							$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos_grabar);
							
							if ($respuesta != "ok")
							{
								print_r ("error al grabar el registros : ".$datos_grabar["num_serie"]);
								print ("<br>");
							}
						}
						else
						{
							$num_reg_existen++;
						}

					} // if (!empty($inv_it[8]))			
*/


				} //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

				print_r('<br>');
				print_r("Seriales NO Grabados =  ".$num_reg_existen);
				print_r('<br>');
				print_r("Seriales Grabados = ".$num_reg_no_existen);

				fclose($csv_file_it);


			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>