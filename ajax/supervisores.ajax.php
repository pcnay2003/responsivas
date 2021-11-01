<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/supervisores.controlador.php";
	require_once "../modelos/supervisores.modelo.php";
	
	class AjaxSupervisores
		{
		// Validar si existe el Supervisor.
		public $validarSupervisores;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarSupervisor()
		{
			$item = "descripcion";
			$valor = $this->validarSupervisores;

			$respuesta = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Supervisor
		public $idSupervisor;
		public function ajaxEditarSupervisor()
		{
			$item = "id_supervisor";
			$valor = $this->idSupervisor;
			$respuesta = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxSupervisores

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Supervisor.
	// datos.append("idSupervisor",idSupervisor); // Se crea la variable "POST", "idSupervisor"
	if (isset($_POST["idSupervisor"]))
	{
		$supervisor = new AjaxSupervisores();
		$supervisor->idSupervisor = $_POST["idSupervisor"];
		$supervisor->ajaxEditarSupervisor();
	}

	// Validar que NO se repita el Supervisor.
	if (isset($_POST["validarSupervisor"]))
	{
		$valSupervisor = new AjaxSupervisores();
		$valSupervisor->validarSupervisores = $_POST["validarSupervisor"];
		$valSupervisor->ajaxValidarSupervisor();
	}

?>