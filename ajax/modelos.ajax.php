<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/modelos.controlador.php";
	require_once "../modelos/modelos.modelo.php";
	
	class AjaxModelos
		{
		// Validar si existe un Modelos.
		public $validarModelos;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarModelo()
		{
			$item = "descripcion";
			$valor = $this->validarModelo;

			$respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Marcas
		public $idModelo;
		public function ajaxEditarModelo()
		{
			$item = "id_modelo";
			$valor = $this->idModelo;
			$respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxModelos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Modelo.
	// datos.append("idModelo",idModelo); // Se crea la variable "POST", "idModelo"
	if (isset($_POST["idModelo"]))
	{
		$modelo = new AjaxModelos();
		$modelo->idModelo = $_POST["idModelo"];
		$modelo->ajaxEditarModelo();
	}

	// Validar que NO se repita el Modelo.
	if (isset($_POST["validarModelo"]))
	{
		$valModelo = new AjaxModelos();
		$valModelo->validarModelo = $_POST["validarModelo"];
		$valModelo->ajaxValidarModelo();
	}

?>