<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/linea.controlador.php";
	require_once "../modelos/linea.modelo.php";
	
	class AjaxLineas
		{
		// Validar si existe una Linea.
		public $validarLinea;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarLinea()
		{
			$item = "descripcion";
			$valor = $this->validarLinea;

			$respuesta = ControladorLineas::ctrMostrarLineas($item,$valor);
			echo json_encode($respuesta);
		}

		// Editar Lineas
		public $idLinea;
		public function ajaxEditarLinea()
		{
			$item = "id_linea";
			$valor = $this->idLinea;
			$respuesta = ControladorLineas::ctrMostrarLineas($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxLineas

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Linea.
	// datos.append("idLinea",idLinea); // Se crea la variable "POST", "idLinea"
	if (isset($_POST["idLinea"]))
	{
		$linea = new AjaxLineas();
		$linea->idLinea = $_POST["idLinea"];
		$linea->ajaxEditarLinea();
	}

	// Validar que NO se repita la Linea.
	if (isset($_POST["validarLinea"]))
	{
		$valLinea = new AjaxLineas();
		$valLinea->validarLinea = $_POST["validarLinea"];
		$valLinea->ajaxValidarLinea();
	}

?>