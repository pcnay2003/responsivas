<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/puestos.controlador.php";
	require_once "../modelos/puestos.modelo.php";
	
	class AjaxPuestos
		{
		// Validar si existe un Puesto.
		public $validarPuestos;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarPuesto()
		{
			$item = "descripcion";
			$valor = $this->validarPuestos;

			$respuesta = ControladorPuestos::ctrMostrarPuestos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Puesto
		public $idPuesto;
		public function ajaxEditarPuesto()
		{
			$item = "id_Puesto";
			$valor = $this->idPuesto;
			$respuesta = ControladorPuestos::ctrMostrarPuestos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxPuestos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Puesto.
	// datosPuesto.append("idPuesto",respuesta["id_puesto"]); // Se crea la variable "POST", "idPuesto"
	if (isset($_POST["idPuesto"]))
	{
		$puesto = new AjaxPuestos();
		$puesto->idPuesto = $_POST["idPuesto"];
		$puesto->ajaxEditarPuesto();
	}

	// Validar que NO se repita el Puesto.
	if (isset($_POST["validarPuesto"]))
	{
		$valPuesto = new AjaxPuestos();
		$valPuesto->validarPuestos = $_POST["validarPuesto"];
		$valPuesto->ajaxValidarPuesto();
	}

?>