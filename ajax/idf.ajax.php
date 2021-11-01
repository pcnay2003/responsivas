<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/idf.controlador.php";
	require_once "../modelos/idf.modelo.php";
	
	class AjaxIdf
		{
		// Validar si existe una Idf.
		public $validarIdf;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarIdf()
		{
			$item = "descripcion";
			$valor = $this->validarIdf;

			$respuesta = ControladorIdf::ctrMostrarIdf($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Idf
		public $idIdf;
		public function ajaxEditarIdf()
		{
			$item = "id_idf";
			$valor = $this->idIdf;
			$respuesta = ControladorIdf::ctrMostrarIdf($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxIdf

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Idf.
	// datos.append("idIdf",idIdf); // Se crea la variable "POST", "idIdf"
	if (isset($_POST["idIdf"]))
	{
		$idf = new AjaxIdf();
		$idf->idIdf = $_POST["idIdf"];
		$idf->ajaxEditarIdf();
	}

	// Validar que NO se repita el Idf.
	if (isset($_POST["validarIdf"]))
	{
		$valIdf = new AjaxIdf();
		$valIdf->validarIdf = $_POST["validarIdf"];
		$valIdf->ajaxValidarIdf();
	}

?>