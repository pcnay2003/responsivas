<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/puerto.controlador.php";
	require_once "../modelos/puerto.modelo.php";
	
	class AjaxPuertos
		{
		// Validar si existe una Puerto.
		public $validarPuerto;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarPuerto()
		{
			$item = "descripcion";
			$valor = $this->validarPuerto;

			$respuesta = ControladorPuertos::ctrMostrarPuertos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Puerto
		public $idPuerto;
		public function ajaxEditarPuerto()
		{
			$item = "id_puerto";
			$valor = $this->idPuerto;
			$respuesta = ControladorPuertos::ctrMostrarPuertos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxPuertos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Puerto.
	// datos.append("idPuerto",idPuerto); // Se crea la variable "POST", "idPuerto"
	if (isset($_POST["idPuerto"]))
	{
		$puerto = new AjaxPuertos();
		$puerto->idPuerto = $_POST["idPuerto"];
		$puerto->ajaxEditarPuerto();
	}

	// Validar que NO se repita la Puerto.
	if (isset($_POST["validarPuerto"]))
	{
		$valPuerto = new AjaxPuertos();
		$valPuerto->validarPuerto = $_POST["validarPuerto"];
		$valPuerto->ajaxValidarPuerto();
	}

?>