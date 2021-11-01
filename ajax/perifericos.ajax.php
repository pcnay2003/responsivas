<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/perifericos.controlador.php";
	require_once "../modelos/perifericos.modelo.php";
	
	class AjaxPerifericos
		{
		// Validar si existe un Periferico.
		public $validarPeriferico;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarPeriferico()
		{
			$item = "nombre";
			$valor = $this->validarPeriferico;

			$respuesta = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Perifericos
		public $idPeriferico;
		public function ajaxEditarPeriferico()
		{
			$item = "id_periferico";
			$valor = $this->idPeriferico;
			$respuesta = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
			echo json_encode($respuesta);
		}

		// Obtener Los perifericos 
		
		public function ajaxObtenerPerifericos()
		{
			$item = null;
			$valor = null;
			$respuesta = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
			echo json_encode($respuesta);
		}
		

	} // class AjaxPerifericos

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Periferico.
	// datos.append("idPeriferico",idPeriferico); // Se crea la variable "POST", "idPeriferico"
	if (isset($_POST["idPeriferico"]))
	{
		$periferico = new AjaxPerifericos();
		$periferico->idPeriferico = $_POST["idPeriferico"];
		$periferico->ajaxEditarPeriferico();
	}

	// Validar que NO se repita el Periferico.
	if (isset($_POST["validarPeriferico"]))
	{
		$valPeriferico = new AjaxPerifericos();
		$valPeriferico->validarPeriferico = $_POST["validarPeriferico"];
		$valPeriferico->ajaxValidarPeriferico();
	}

	// Obtener los perifericos 
	if (isset($_POST["obtenerPerifericos"]))
	{
		$ObtenerPeriferico = new AjaxPerifericos();
		$ObtenerPeriferico->ajaxObtenerPerifericos();
	}

?>