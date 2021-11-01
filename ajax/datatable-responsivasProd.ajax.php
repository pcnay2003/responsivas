<?php
	// Para poder extraer los datos de la tabla de "productos" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "productos.php", se carga mucho después.

	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	require_once "../controladores/perifericos.controlador.php";
	require_once "../modelos/perifericos.modelo.php";

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";


	class TablaProductosResponsivas
	{
		// Mostrar la tabla de productos.
		public function mostrarTablaProductosResponsivas()
		{
			// Extraer la información de la tabla.
			$item = null;
			$valor = null;

			$productos = ControladorProductos::ctrMostrarProductos($item,$valor);

			//var_dump($productos);
			//return;
			//exit;

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($productos);$i++)
				{
					// Se obtiene la imagen del producto, se pasa a variable para agregarlo al JSon.
					$imagen = "<img src='".$productos[$i]["Imagen"]."' width='40px'>";

					/*
					// se extrae la categoria
					$item = "id";
					$valor = $productos[$i]["id_categoria"];
					$categoria = ControladorCategorias::ctrMostrarCategorias($item,$valor);
					*/ 

					/*
					$periferico = $productos[$i]["Periferico"];
					$serial = $productos[$i]["Serial"];
					$marca = $productos[$i]["Marca"];
					$modelo = $productos[$i]["Modelo"];
					$edo_epo = $productos[$i]["Edo_Epo"];
					*/
					

					// Se utilizara un color para determinar el "Stock" de los productos.
					if ($productos[$i]["Stock"] <= 10)
					{
						$stock = "<button class='btn btn-danger'>".$productos[$i]["Stock"]."</button>";
					}
					else if ($productos[$i]["Stock"] > 11 && $productos[$i]["Stock"] <=15)
					{
						$stock = "<button class='btn btn-warning'>".$productos[$i]["Stock"]."</button>";
					}
					else // if ($productos[$i][stock] <= 10)
					{
						$stock = "<button class='btn btn-success'>".$productos[$i]["Stock"]."</button>";
					}
					$precio_venta = $productos[$i]["Precio_Venta"];
					

					// $imagen = "<img src='/vistas/img/productos/101/105.png' width='40px'>";
					// Se utilizan estos datos para pasarlos con Ajax a las funciones de JavaScript para obtener la información del "Producto" 
					// se agrega btnEditarProducto" = Boton para editar 
					// idProducto='".$productos[$i]["id"]."' para editar el producto.
					// data-toggle='modal' = Para desplegar una ventanta Modal.
					// data-target='#modalEditarProducto' = Pantalla para editar los productos 
					// btnEliminarProducto= Boton para eliminar producto
					// idProducto='".$productos[$i]["id"]."' = Para obtener el código del producto
					// imagen='".$productos[$i]["imagen"]."' = Para obtener la ruta de la imagen.

					// Esta parte se utiliza para utilizar las variables de sesion en DataTable.
					// recuperarBoton = Se utiliza cuando se quita un producto de la lista y vuelva estar activo.
					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Admin")
					{
						$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar </button></div>";
					}
					else
					{
						$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar </button></div>";
						
						// se extrae los datos utilizados para el boton de "Editar" y "Borrar"

						//$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id_producto"]."' imagen='".$productos[$i]["Imagen"]."' ><i class='fa fa-times'></i></button></div>";
					}					


					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$productos[$i]["Periferico"].'",							
							"'.$productos[$i]["Serial"].'",
							"'.$productos[$i]["asset"].'",
							"'.$productos[$i]["num_tel"].'",
							"'.$productos[$i]["imei_tel"].'",
							"'.$stock.'",							
							"'.$botones.'"
						],';
				}
				// Una vez que se termina el ciclo, al final de la cadena "$datosJson" se le elimina ","
				$datosJson = substr($datosJson,0,-1);
				$datosJson .=	']}';

			echo  $datosJson;

			//return; // para que no continue la ejecución.


			// Se utilizan las variables de PHP para no romper la cadena en el JSON.
		 
		} // public function mostrarTablaProductos()

	} // class TablaProductos

	// Activar la tabla de productos.
	$activarProductosResponsivas = new TablaProductosResponsivas();
	$activarProductosResponsivas->mostrarTablaProductosResponsivas();

	

?>