<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/marcas.controlador.php";
	require_once "../modelos/marcas.modelo.php";
	
	class AjaxMarcas
		{
		// Validar si existe una Marca.
		public $validarMarca;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarMarca()
		{
			$item = "descripcion";
			$valor = $this->validarMarca;

			$respuesta = ControladorMarcas::ctrMostrarMarcas($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Marcas
		public $idMarca;
		public function ajaxEditarMarca()
		{
			$item = "id_marca";
			$valor = $this->idMarca;
			$respuesta = ControladorMarcas::ctrMostrarMarcas($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxMarcas

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Marca.
	// datos.append("idMarca",idMarca); // Se crea la variable "POST", "idMarca"
	if (isset($_POST["idMarca"]))
	{
		$marca = new AjaxMarcas();
		$marca->idMarca = $_POST["idMarca"];
		$marca->ajaxEditarMarca();
	}

	// Validar que NO se repita la Marca.
	if (isset($_POST["validarMarca"]))
	{
		$valMarca = new AjaxMarcas();
		$valMarca->validarMarca = $_POST["validarMarca"];
		$valMarca->ajaxValidarMarca();
	}

?>