<?php
	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "empleados.ajax.php"

	class AjaxEmpleados
	{

		// Validar si existe un NTID
		public $validarNTID;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNTid()
		{
			$item = "ntid";
			$valor = $this->validarNTID;
			$orden = "apellidos";

			$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
			echo json_encode($respuesta);

		}

		// Validar si existe un Correo Electronico
		public $validarCorreoElect;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarCorreoElect()
		{
			$item = "correo_electronico";
			$valor = $this->validarCorreoElect;
			$orden = "apellidos";

			$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
			echo json_encode($respuesta);

		}



		// Editar "Empleado"
		// Para obtener el Empleado que se va a editar.
		public $idEmpleado;
		public $traerEmpleado;
		public $nombreEmpleado;

		public function ajaxEditarEmpleado()
		{
			// Para el caso de que se edita utilizando un dispositivo movil
			if ($this->traerEmpleado == "ok")
			{
				$item = null;
				$valor = null;
				$orden = "apellidos";
				$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
				echo json_encode($respuesta);	
			}
			else if($this->nombreEmpleado != "")
			{
				// Para poder obtener el registro que se selecciono del ComboBox.
				$item = "nombre";
				$valor = $this->nombreEmpleado;
				$orden = "id_empleado";
				$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
				echo json_encode($respuesta);
			}			
			else 
			{
				$item = "id_empleado";
				$valor = $this->idEmpleado;
				$orden = "apellidos";
				$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
				echo json_encode($respuesta);
			}

		}


	} // class AjaxEmpleados

	
	// Para editar el empleado.
	if (isset($_POST["idEmpleado"]))
	{
		$editarEmpleado = new AjaxEmpleados();
		$editarEmpleado->idEmpleado = $_POST["idEmpleado"];
		$editarEmpleado->ajaxEditarEmpleado();
	}
	
	// Traer el Empleado, para dispositivos mobiles.
	if (isset($_POST["traerEmpleado"]))
	{
		$traerEmpleado = new AjaxEmpleados();
		$traerEmpleado->traerEmpleado = $_POST["traerEmpleado"];
		$traerEmpleado->ajaxEditarEmpleado();
	}

	// Para obtener el nombre del Empleado.	
	if (isset($_POST["nombreEmpleado"]))
	{
		$traerEmpleado = new AjaxEmpleados();
		$traerEmpleado->nombreEmpleado = $_POST["nombreEmpleado"];
		$traerEmpleado->ajaxEditarEmpleado();
	}

	// Validar que NO se repita el NTID.
	if (isset($_POST["validaNtid"]))
	{
		$valNTID = new AjaxEmpleados();
		$valNTID->validarNTID = $_POST["validaNtid"];
		$valNTID->ajaxValidarNTid();
	}

	// Validar que NO se repita el Correo Electronico.
	if (isset($_POST["validaCorreoElect"]))
	{
		$valCorreoElect = new AjaxEmpleados();
		$valCorreoElect->validarCorreoElect = $_POST["validaCorreoElect"];
		$valCorreoElect->ajaxValidarCorreoElect();
	}

?>