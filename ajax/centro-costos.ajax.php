<?php

	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/centro-costos.controlador.php";
	require_once "../modelos/centro-costos.modelo.php";
	
	class AjaxCentro_Costos
		{
		// Validar si existe un Centro de Costos.
		public $validarCentro_Costos;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarCentro_Costos()
		{
			$item = "num_centro_costos";
			$valor = $this->validarCentro_Costos;

			$respuesta = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
			echo json_encode($respuesta);

		}


		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarDescripCentro_Costos()
		{
			$item = "descripcion";
			$valor = $this->validarDescripCentro_Costos;

			$respuesta = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
			echo json_encode($respuesta);

		}
		// ==========================================
		// Editar Centro De Costos
		// ==========================================
		public $idCentro_Costos;
		public function ajaxEditarCentro_Costos()
		{
			$item = "id_centro_costos";
			$valor = $this->idCentro_Costos;
			$respuesta = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxCentro_Costos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando el Centro de Costos.
	// datos.append("idCentro_Costos",idCentro_Costos); // Se crea la variable "POST", "idCentro_Costos"
	if (isset($_POST["idCentro_Costos"]))
	{
		$centro_costos = new AjaxCentro_Costos();
		$centro_costos->idCentro_Costos = $_POST["idCentro_Costos"];
		$centro_costos->ajaxEditarCentro_Costos();
	}

	// Validar que NO se repita el Centro de Costos.
	if (isset($_POST["validarCentro_Costos"]))
	{
		$valCentro_Costos = new AjaxCentro_Costos();
		$valCentro_Costos->validarCentro_Costos = $_POST["validarCentro_Costos"];
		$valCentro_Costos->ajaxValidarCentro_Costos();
	}

	// Validar que NO se repita la descripcion del Centro de Costos.
	if (isset($_POST["validarDescripCentro_Costos"]))
	{
		$valDescripCentro_Costos = new AjaxCentro_Costos();
		$valDescripCentro_Costos->validarDescripCentro_Costos = $_POST["validarDescripCentro_Costos"];
		$valDescripCentro_Costos->ajaxValidarDescripCentro_Costos();
	}

?>