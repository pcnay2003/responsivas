<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/deptos.controlador.php";
	require_once "../modelos/deptos.modelo.php";
	
	class AjaxDeptos
		{
		// Validar si existe un Depto
		public $validarDepto;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarDepto()
		{
			$item = "descripcion";
			$valor = $this->validarDepto;

			$respuesta = ControladorDeptos::ctrMostrarDeptos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Deptos
		public $idDepto;
		public function ajaxEditarDepto()
		{
			$item = "id_depto";
			$valor = $this->idDepto;
			$respuesta = ControladorDeptos::ctrMostrarDeptos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxDeptos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Depto.
	// datos.append("idDepto",idDepto); // Se crea la variable "POST", "idDepto"
	if (isset($_POST["idDepto"]))
	{
		$depto = new AjaxDeptos();
		$depto->idDepto = $_POST["idDepto"];
		$depto->ajaxEditarDepto();
	}

	// Validar que NO se repita el Depto.
	if (isset($_POST["validarDepto"]))
	{
		$valDepto = new AjaxDeptos();
		$valDepto->validarDepto = $_POST["validarDepto"];
		$valDepto->ajaxValidarDepto();
	}

?>