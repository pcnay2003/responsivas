<?php
	//require_once "../../../controladores/productos.controlador.php";
	//require_once "../../../modelos/productos.modelo.php";

	// Sumando las Desktop que se tienen en el Inventario y operables
	$id_periferico = 1;
	$id_edo_epo = 1;
	$productosDesktop = ControladorProductos::ctrSumaTotalPerifericos($id_periferico,$id_edo_epo);
	
	// Sumando las Desktop que estan en el Inventario y NO operables
	$id_periferico = 1;
	$id_edo_epo = 2;
	$productosDesktopDescomp = ControladorProductos::ctrSumaTotalPerifericos($id_periferico,$id_edo_epo);
	
	// Sumando las Laptops que se tienen en e Inventario y operables
	$id_periferico = 2;
	$id_edo_epo = 1;
	$productosLaptop = ControladorProductos::ctrSumaTotalPerifericos($id_periferico,$id_edo_epo);

	// Sumando las Laptops que se tienen en e Inventario y NO operables
	$id_periferico = 2;
	$id_edo_epo = 2;
	$productosLaptopDescomp = ControladorProductos::ctrSumaTotalPerifericos($id_periferico,$id_edo_epo);
	
	
	/*
	$item = null;
	$valor = null;

	$perifericos = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
	// var_dump($Perifericos);
	$totalPerifericos = count($perifericos);

/*

	$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
	$totalClientes = count($clientes);

	$orden = "id";
	$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
	$totalProductos = count($productos);
	*/
		
	
	$totalClientes = 0;
	$totalProductos = 0;
?>

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?php echo $productosDesktop["total"]; ?></h3>

				<p>Desktop</p>
			</div>
			<div class="icon">
				<i class="ion ion-social-usd"></i>
			</div>
			<a href="#" class="small-box-footer">Mas Ventas<i class="fa fa-arrow-circle-right"></i></a>
			<!-- <a href="ventas" class="small-box-footer">Mas Ventas<i class="fa fa-arrow-circle-right"></i></a> -->
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo $productosLaptop["total"]; ?></h3>

				<p>Laptopss</p>
			</div>
			<div class="icon">
				<i class="ion ion-clipboard"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo $productosDesktopDescomp["total"]; ?></h3>
				<p>Desktop Descompuestas</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo $productosLaptopDescomp["total"]; ?></h3>
				<p>Laptop Descompuestas</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-cast"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
