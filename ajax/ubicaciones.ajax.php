<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/ubicaciones.controlador.php";
	require_once "../modelos/ubicaciones.modelo.php";
	
	class AjaxUbicaciones
		{
		// Validar si existe una Ubicaciones.
		public $validarUbicacion;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarUbicacion()
		{
			$item = "descripcion";
			$valor = $this->validarUbicacion;

			$respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
			echo json_encode($respuesta);

		}

		// Editar Ubicaciones
		public $idUbicacion;
		public function ajaxEditarUbicacion()
		{
			$item = "id_ubicacion";
			$valor = $this->idUbicacion;
			$respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxUbicaciones

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Ubicacion.
	// datos.append("idUbicacion",idUbicacion); // Se crea la variable "POST", "idUbicacion"
	if (isset($_POST["idUbicacion"]))
	{
		$ubicacion = new AjaxUbicaciones();
		$ubicacion->idUbicacion = $_POST["idUbicacion"];
		$ubicacion->ajaxEditarUbicacion();
	}

	// Validar que NO se repita la Ubicacion.
	if (isset($_POST["validarUbicacion"]))
	{
		$valUbicacion = new AjaxUbicaciones();
		$valUbicacion->validarUbicacion = $_POST["validarUbicacion"];
		$valUbicacion->ajaxValidarUbicacion();
	}

?>