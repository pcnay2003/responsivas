<?php
	require_once "../../controladores/productos.controlador.php";
	require_once "../../modelos/productos.modelo.php";

	$crearExpProducto = new ControladorProductos();
	$crearExpProducto->ctrExpProductosExcel();					
?>
