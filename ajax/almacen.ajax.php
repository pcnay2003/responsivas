<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/almacen.controlador.php";
	require_once "../modelos/almacen.modelo.php";
	
	class AjaxAlmacenes
		{
		// Validar si existe un Almacen.
		public $validarAlmacen;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarAlmacen()
		{
			$item = "nombre";
			$valor = $this->validarAlmacen;

			$respuesta = ControladorAlmacenes::ctrMostrarAlmacenes($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Almacen
		public $idAlmacen;
		public function ajaxEditarAlmacen()
		{
			$item = "id_almacen";
			$valor = $this->idAlmacen;
			$respuesta = ControladorAlmacenes::ctrMostrarAlmacenes($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxAlmacenes

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Almacen.
	// datos.append("idAlmacen",idAlmacen); // Se crea la variable "POST", "idAlmacen"
	if (isset($_POST["idAlmacen"]))
	{
		$almacen = new AjaxAlmacenes();
		$almacen->idAlmacen = $_POST["idAlmacen"];
		$almacen->ajaxEditarAlmacen();
	}

	// Validar que NO se repita el Almacen.
	if (isset($_POST["validarAlmacen"]))
	{
		$valAlmacen = new AjaxAlmacenes();
		$valAlmacen->validarAlmacen = $_POST["validarAlmacen"];
		$valAlmacen->ajaxValidarAlmacen();
	}

?>