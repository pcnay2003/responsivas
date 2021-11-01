<?php
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "productos.ajax.php"

	class AjaxProductos
	{
		// Validar si existe el Serial.
		public $validarSerial;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarSerial()
		{
			$item = "num_serie";
			$valor = $this->validarSerial;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Validar si existe el Numero de Telefono
		public $validarNumTel;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNumTel()
		{
			$item = "num_tel";
			$valor = $this->validarNumTel;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Validar si existe la Direccion MAC del telefono
		public $validarDireccMac;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarDireccMac()
		{
			$item = "direcc_mac_tel";
			$valor = $this->validarDireccMac;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Validar si existe el IMEI del telefono
		public $validarImei;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarImei()
		{
			$item = "imei_tel";
			$valor = $this->validarImei;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);
		}

		// Validar si existe la IP
		public $validarNumIp;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNumIp()
		{
			$item = "num_ip";
			$valor = $this->validarNumIp;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);
		}
	
		// Validar si existe la Cuenta asignada al Telefono
		public $validarCuenta;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarCuenta()
		{
			$item = "cuenta";
			$valor = $this->validarCuenta;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}
		
		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNomenclatura()
		{
			$item = "nomenclatura";
			$valor = $this->validarNomenclatura;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarAsset()
		{
			$item = "asset";
			$valor = $this->validarAsset;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}
		
		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarLoftware()
		{
			$item = "loftware";
			$valor = $this->validarLoftware;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNpa()
		{
			$item = "npa";
			$valor = $this->validarNpa;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar "Productos"
		// Para obtener un producto que se va a editar.
		// Esta se reutiliza en "Responsiva.js" para agregar los productos en la responsiva, ya que se genera de forma dinamica.
		public $idProducto;
		public $traerProductos;
		public $nombreProducto;

		public function ajaxEditarProducto()
		{
			$item = "id_producto";
			$valor = $this->idProducto;
			$orden = "nombre";
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
			echo json_encode($respuesta);

		} // public function ajaxEditarProducto()

		public $id_Producto;
		public $regresar_stock;
		public function ajaxActProducto()
		{
			$tabla = "t_Productos";
			$item1b = "id_empleado";
			$valor1b = '1';
			$valor = $this->id_Producto;				
			
			$respuesta = ModeloProductos::mdlActualizarProducto($tabla,$item1b,$valor1b,$valor);
			echo json_encode($respuesta);

			
			// Actualizando el stock del producto.
			$item1b = "stock";
			$valor1b = $this->regresar_stock;
			$valor = $this->id_Producto;			
			$respuesta = ModeloProductos::mdlActualizarProducto($tabla,$item1b,$valor1b,$valor);
			echo json_encode($respuesta);					
			

		} // public function ajaxEditarProducto()



	} // class AjaxProductos

	
	// Para editar el producto.
	if (isset($_POST["idProducto"]))
	{
		$editarProducto = new AjaxProductos();
		// Se genero en "productos.js" "btnEditarProducto", datos.append....
		$editarProducto->idProducto = $_POST["idProducto"]; 
		$editarProducto->ajaxEditarProducto();
	}
	
	// Traer el Producto, para dispositivos mobiles.
	if (isset($_POST["traerProductos"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->traerProductos = $_POST["traerProductos"];
		$traerProductos->ajaxEditarProducto();
	}

	// Para obtener el nombre del producto.	
	if (isset($_POST["nombreProducto"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->nombreProducto = $_POST["nombreProducto"];
		$traerProductos->ajaxEditarProducto();
	}

	// Validar que NO se repita el Serial.
	if (isset($_POST["validarSerial"]))
	{
		$valSerial = new AjaxProductos();
		$valSerial->validarSerial = $_POST["validarSerial"];
		$valSerial->ajaxValidarSerial();
	}

	// Validar que NO se repita el Numero de Telefono.
	if (isset($_POST["validarNumTel"]))
	{
		$valNumTel = new AjaxProductos();
		$valNumTel->validarNumTel = $_POST["validarNumTel"];
		$valNumTel->ajaxValidarNumTel();
	}

	// Validar que NO se repita la Direccion MAC del Tel.
	if (isset($_POST["validarDireccMac"]))
	{
		$valDireccMac = new AjaxProductos();
		$valDireccMac->validarDireccMac = $_POST["validarDireccMac"];
		$valDireccMac->ajaxValidarDireccMac();
	}

	// Validar que NO se repita el Imei del Tel.
	if (isset($_POST["validarImei"]))
	{
		$valImei = new AjaxProductos();
		$valImei->validarImei = $_POST["validarImei"];
		$valImei->ajaxValidarImei();
	}

	// Validar que NO se repita la IP.
	if (isset($_POST["validarNumIp"]))
	{
		$valNumIp = new AjaxProductos();
		$valNumIp->validarNumIp = $_POST["validarNumIp"];
		$valNumIp->ajaxValidarNumIp();
	}

	// Validar que NO se repita la Cuenta del Tel.
	if (isset($_POST["validarNumCta"]))
	{
		$valCtaTel = new AjaxProductos();
		$valCtaTel->validarCuenta = $_POST["validarNumCta"];
		$valCtaTel->ajaxValidarCuenta();
	}
	
	// Validar que NO se repita la Nomenclatura.
	if (isset($_POST["validarNomenclatura"]))
	{
		$valNomenclatura = new AjaxProductos();
		$valNomenclatura->validarNomenclatura = $_POST["validarNomenclatura"];
		$valNomenclatura->ajaxValidarNomenclatura();
	}

	// Validar que NO se repita el Asset.
	if (isset($_POST["validarAsset"]))
	{
		$valAsset = new AjaxProductos();
		$valAsset->validarAsset = $_POST["validarAsset"];
		$valAsset->ajaxValidarAsset();
	}

	// Validar que NO se repita el Loftware.
	if (isset($_POST["validarLoftware"]))
	{
		$valLoftware = new AjaxProductos();
		$valLoftware->validarLoftware = $_POST["validarLoftware"];
		$valLoftware->ajaxValidarLoftware();
	}

	// Validar que NO se repita el NPA.
	if (isset($_POST["validarNpa"]))
	{
		$valNpa = new AjaxProductos();
		$valNpa->validarNpa = $_POST["validarNpa"];
		$valNpa->ajaxValidarNpa();
	}

	if (isset($_POST["id_Producto"]))
	{
		$actualizarProd = new AjaxProductos();
		// Se genero en "productos.js" on("click","button.quitarProducto", datos.append....
		$actualizarProd->id_Producto = $_POST["id_Producto"]; 
		$actualizarProd->regresar_stock = $_POST["regresar_stock"]; 
		$actualizarProd->ajaxActProducto();
	}


?>