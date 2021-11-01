<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/telefonia.controlador.php";
	require_once "../modelos/telefonia.modelo.php";
	
	class AjaxTelefonia
		{
		// Validar si existe una Cia. Telefonica.
		public $validarTelefonia;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarTelefonia()
		{
			$item = "nombre";
			$valor = $this->validarTelefonia;

			$respuesta = ControladorTelefonias::ctrMostrarTelefonias($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Telefonia
		public $idTelefonia;
		public function ajaxEditarTelefonia()
		{
			$item = "id_telefonia";
			$valor = $this->idTelefonia;
			$respuesta = ControladorTelefonias::ctrMostrarTelefonias($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxTelefonia

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Telefonia.
	// datos.append("idTelefonia",idTelefonia); // Se crea la variable "POST", "idTelefonia"
	if (isset($_POST["idTelefonia"]))
	{
		$telefonia = new AjaxTelefonia();
		$telefonia->idTelefonia = $_POST["idTelefonia"];
		$telefonia->ajaxEditarTelefonia();
	}

	// Validar que NO se repita la Cia. Telefonica.
	if (isset($_POST["validarTelefonia"]))
	{
		$valTelefonia = new AjaxTelefonia();
		$valTelefonia->validarTelefonia = $_POST["validarTelefonia"];
		$valTelefonia->ajaxValidarTelefonia();
	}

?>