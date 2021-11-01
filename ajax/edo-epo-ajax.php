<?php

	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/edo-epo.controlador.php";
	require_once "../modelos/edo-epo.modelo.php";
	
	class AjaxEdo_Epo
		{
		// Validar si existe un Estado de Equipo.
		public $validarEdo_Epo;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarEdo_Epo()
		{
			$item = "descripcion";
			$valor = $this->validarEdo_Epo;

			$respuesta = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
			echo json_encode($respuesta);

		}
		// ==========================================
		// Editar Estado de Equipos
		// ==========================================
		public $idEdo_Epo;
		public function ajaxEditarEdo_Epo()
		{
			$item = "id_edo_epo";
			$valor = $this->idEdo_Epo;
			$respuesta = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxEdo_Epo

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Estado Del Equipo.
	// datos.append("idEdo_Epo",idEdo_Epo); // Se crea la variable "POST", "idEdo_Epo"
	if (isset($_POST["idEdo_Epo"]))
	{
		$edo_epo = new AjaxEdo_Epo();
		$edo_epo->idEdo_Epo = $_POST["idEdo_Epo"];
		$edo_epo->ajaxEditarEdo_Epo();
	}

	// Validar que NO se repita el Estado del Equipo.
	if (isset($_POST["validarEdo_Epo"]))
	{
		$valEdo_Epo = new AjaxEdo_Epo();
		$valEdo_Epo->validarEdo_Epo = $_POST["validarEdo_Epo"];
		$valEdo_Epo->ajaxValidarEdo_Epo();
	}

?>