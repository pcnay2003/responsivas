<?php
	Class SubirCsv
	{
		static public function ctrSubirCintas($item,$valor)
		{
			$tabla = "t_Cintas";
			$respuesta = ModeloSubirCsv::mdlSubirCsv($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarMarcas()

	}
?>