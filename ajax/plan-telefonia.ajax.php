<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/plan-telefonia.controlador.php";
	require_once "../modelos/plan-telefonia.modelo.php";
	
	class AjaxPlanTelefonia
		{
		// Validar si existe un Plan de Telefonia.
		public $validarPlanTelefonia;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxPlanValidarTelefonia()
		{
	
			$item = "nombre";
			$valor = $this->validarPlanTelefonia;
			
			$respuesta = ControladorPlanTelefonias::ctrMostrarPlanTelefonias($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Plan de Telefonia
		public $idPlanTelefonia;
		public function ajaxEditarPlanTelefonia()
		{
			$item = "id_plan_tel";
			$valor = $this->idPlanTelefonia;
			$respuesta = ControladorPlanTelefonias::ctrMostrarPlanTelefonias($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxPlanTelefonia

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Plan de Telefonia.
	// datos.append("idPlanTelefonia",idPlanTelefonia); // Se crea la variable "POST", "idPlanTelefonia"
	if (isset($_POST["idPlanTelefonia"]))
	{
		$plan_telefonia = new AjaxPlanTelefonia();
		$plan_telefonia->idPlanTelefonia = $_POST["idPlanTelefonia"];
		$plan_telefonia->ajaxEditarPlanTelefonia();
	}

	// Validar que NO se repita el Plan de Telefonia.
	if (isset($_POST["validarPlanTelefonia"]))
	{

		$valPlanTelefonia = new AjaxPlanTelefonia();
		$valPlanTelefonia->validarPlanTelefonia = $_POST["validarPlanTelefonia"];
		$valPlanTelefonia->ajaxPlanValidarTelefonia();
	}

?>