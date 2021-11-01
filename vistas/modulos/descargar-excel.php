<?php
	require_once "../../controladores/cintas.controlador.php";
	require_once "../../modelos/cintas.modelo.php";
	
	$Cintas = new ControladorCintas();
	$Cintas->ctrExportarExcelCintas();
?>