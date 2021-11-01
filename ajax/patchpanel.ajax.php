<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/patchpanel.controlador.php";
	require_once "../modelos/patchpanel.modelo.php";
	
	class AjaxPatchPanel
		{
		// Validar si existe un Patch Panel.
		public $validarPatchPanel;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarPatchPanel()
		{
			$item = "descripcion";
			$valor = $this->validarPatchPanel;

			$respuesta = ControladorPatchPanel::ctrMostrarPatchPanel($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Patch Panel
		public $idPatchPanel;
		public function ajaxEditarPatchPanel()
		{
			$item = "id_patch_panel";
			$valor = $this->idPatchPanel;
			$respuesta = ControladorPatchPanel::ctrMostrarPatchPanel($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxPatchPanel

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Patch Panel.
	// datos.append("idPatchPanel",idPatchPanel); // Se crea la variable "POST", "idPatchPanel"
	if (isset($_POST["idPatchPanel"]))
	{
		$patchpanel = new AjaxPatchPanel();
		$patchpanel->idPatchPanel = $_POST["idPatchPanel"];
		$patchpanel->ajaxEditarPatchPanel();
	}

	// Validar que NO se repita el Patch Panel.
	if (isset($_POST["validarPatchPanel"]))
	{
		$valPatchPanel = new AjaxPatchPanel();
		$valPatchPanel->validarPatchPanel = $_POST["validarPatchPanel"];
		$valPatchPanel->ajaxValidarPatchPanel();
	}

?>