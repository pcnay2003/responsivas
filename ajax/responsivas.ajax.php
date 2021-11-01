<?php
	require_once "../controladores/responsivas.controlador.php";
	require_once "../modelos/responsivas.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "responsivas.ajax.php"

	class AjaxResponsivas
	{
		
		// Editar "Responsiva"
		// Para obtener la "Responsiva" que se va a editar.
		public $idResponsiva;

		public function ajaxEditarResponsiva()
		{
				$item = "id_responsiva";
				$valor = $this->idResponsiva;
				$orden = "ConsultaCompleja";
				$respuesta = ControladorResponsivas::ctrMostrarResponsivas($item,$valor,$orden);
				echo json_encode($respuesta);		

		}

	} // class AjaxResponsivas

	
	// Para editar una Responsiva
	if (isset($_POST["idResponsiva"]))
	{
		$editarResponsiva = new AjaxResponsivas();
		$editarResponsiva->idResponsiva = $_POST["idResponsiva"];
		$editarResponsiva->ajaxEditarResponsiva();
	}
	

?>