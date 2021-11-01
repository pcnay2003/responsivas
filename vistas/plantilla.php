<?php
  session_start();    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Sistema de Responsivas | Blank Page</title>

  <!-- Plugins de JavaScript -->
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Para colocar el icono cuando se minimiza la ventana -->
  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome 
		https://fontawesome.com/	--> 
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  
	
	<!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables-->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

		<!-- Se agrega el "css" para el plug ins de DateRangePicker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

		<!-- Morris Chart  para los graficos en los reportes, seccion de CSS -->
		<link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">


	<!-- <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script> NO FUNCIONA -->
	<!-- https://www.jsdelivr.com/package/npm/sweetalert2 : Se tiene que agregar por separado este archivo, ya que si se agrega solo uno como "sweetalert2.all.js" no funciona, se debe bajar l archivo en formato ".tar", descomprimir y buscar en la carpeta "packages" los dos archivos, tanto ".css" y ".js" -->
		<link rel="stylesheet" href="vistas/plugins/sweetalert2/sweetalert2.css">

	<!-- iCheck for checkboxes and radio inputs, con mascarilla en la presentacion -->
	<link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

	<!-- By default Sweetalert2 doesn´t support IE. To enable IE 11 support, include Promise polyfill -->	
	<!-- <script scr = "https://cdnjs.cloudflare.com/ajax/libs/core-js/2.6.11/core.min.js"></ script> -->
	<!-- <script src="vistas/plugins/core-js-2.6.11/core.min.js"></script> -->

  <!-- Plugins de JavaScript -->
    <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
	
	<!-- AdminLTE for demo purposes -->
  <!-- <script src="vistas/dist/js/demo.js"></script> -->
  
  <!-- DataTables-->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


  <!-- SweetAlert 2 -->
  <!-- <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script> NO FUNCIONA -->
	<!-- https://www.jsdelivr.com/package/npm/sweetalert2 : Se tiene que agregar por separado este archivo, ya que si se agrega solo uno como "sweetalert2.all.js" no funciona, se debe bajar l archivo en formato ".tar", descomprimir y buscar en la carpeta "packages" los dos archivos, tanto ".css" y ".js" -->
	<script src="vistas/plugins/sweetalert2/sweetalert2.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="vistas/plugins/iCheck/icheck.min.js"></script>

	<!-- InputMask, mascaras para las capturas de Número Teléfonico  -->
	<script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="vistas/plugins/jQueryNumber/jquerynumber.min.js"></script>

	<!-- El archivo de JS para el DateRangePicker, http://www.daterangepicker.com/ -->
	<script src="vistas/bower_components/moment/min/moment.min.js"></script>
	<script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- Morris.js Charts  Para las gráficas en los reportes
				https://morrisjs.github.io/morris.js/
	-->
	<script src="vistas/bower_components/raphael/raphael.min.js"></script>
	<script src="vistas/bower_components/morris.js/morris.min.js"></script>
	<!-- Graficos de Pastel http://www.chartjs.org -->
	<script src="vistas/bower_components/chart.js/Chart.js"></script>
</head>

<!-- Cuerpo de Documento -->
<!-- Se agrega "sidebar-collapse" para ocultar  el submenu  del lado izq. donde viene la fato. -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <?php
    // Valida si el usuario esta logueado 
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok")
    {
      // Si tiene la sesion iniciada muestra la pantalla principal del sistema.
      //<!-- Site wrapper -->
      // Se agrega esta linea debido a que la pantalla "login" agrega una clase diferente, además se va separar la pantalla del menu general y login.
      echo '<div class="wrapper">';
  
        include "modulos/cabezote.php";
        include "modulos/menu.php";
        // Agregando un Contenido temporal para utilizar la pantalla principal.
        // Generando las URL Amigables., cuando se teclea en la barra de direcciones o cuando se seleccione el icono "inicio" o tras rutas.
        if (isset($_GET["ruta"]))
        {
					//print_r($_GET["ruta"]);
          if ($_GET["ruta"]=="inicio" || $_GET["ruta"]=="usuarios" || $_GET["ruta"]=="perifericos" || $_GET["ruta"]=="tareas" || $_GET["ruta"]=="productos" || $_GET["ruta"]=="prod-gral" || $_GET["ruta"]=="prod-tel" || $_GET["ruta"]=="prod-prod" || $_GET["ruta"]=="clientes"|| $_GET["ruta"]=="responsivas" || $_GET["ruta"]=="cap-responsiva" || $_GET["ruta"]=="editar-responsiva" || $_GET["ruta"]=="crear-venta" || $_GET["ruta"]=="marcas" || $_GET["ruta"]=="linea" ||  $_GET["ruta"]=="Modelos" || $_GET["ruta"]=="ubicaciones" ||  $_GET["ruta"]=="supervisores" || $_GET["ruta"]=="puestos" || $_GET["ruta"]=="deptos" || $_GET["ruta"]=="empleados" || $_GET["ruta"]=="reportes" || $_GET["ruta"]=="respaldo_bd" || $_GET["ruta"]=="edo-epo" || $_GET["ruta"]=="almacen" || $_GET["ruta"]=="cintas"|| $_GET["ruta"]=="centro-costos" || $_GET["ruta"]=="telefonia" || $_GET["ruta"]=="plan-telefonia"  || $_GET["ruta"]=="subir_cintas" || $_GET["ruta"]=="inv_it" || $_GET["ruta"]=="importar_cintas" || $_GET["ruta"]=="cap-rap-prod" || $_GET["ruta"]=="salir" )
          {						
            include "modulos/".$_GET["ruta"].".php";
          }
          else
          {
            include "modulos/404.php";      
          }
        }
        else // Cuando no se este utilizando las variables global GET["ruta"]
        {
          include "modulos/404.php"; 
        
        }

        include "modulos/footer.php";

      echo '</div> '; // '<div class="wrapper">';

    } // if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok")
    else // Si no se ha logeado
    {
      include "modulos/login.php";
    }
  ?>
</div>  
	<!-- ./wrapper -->

	<!-- Los archivos de "JavaScript" incian las busquedas desde el directorio raíz.  -->
	<script src="vistas/js/plantilla.js"></script>
	<!-- Agregar las fotografias de los usuarios del sistema -->
	<script src="vistas/js/usuarios.js"></script>
	<!-- Agregar las capturas, ediciones y validaciones para las perifericos -->
	<script src="vistas/js/perifericos.js"></script>
	<!-- Agregar las capturas, ediciones y validaciones para los Productos -->
	<script src="vistas/js/productos.js"></script>
	<!-- se edita los Clientes -->
	<script src="vistas/js/clientes.js"></script>
	<!-- se muestra los productos en el modulo Crear Venta  -->
	<script src="vistas/js/ventas.js"></script>
	<!-- se muestra las Marcas  -->
	<script src="vistas/js/marcas.js"></script>
	<!-- se muestra los Modelos  -->
	<script src="vistas/js/modelos.js"></script>
	<!-- se muestra la Ubicacion  -->
	<script src="vistas/js/ubicaciones.js"></script>
	<!-- se muestra los Supervisores  -->
	<script src="vistas/js/supervisores.js"></script>
	<!-- se muestra los Puestos  -->
	<script src="vistas/js/puestos.js"></script>
	<!-- se muestra los Deptos  -->
	<script src="vistas/js/deptos.js"></script>
	<!-- se muestra los Empleados  -->
	<script src="vistas/js/empleados.js"></script>
	<!-- se muestra el Estado de los Equipos -->
	<script src="vistas/js/edo-epo.js"></script>
	<!-- Se muestra el Almacen -->
	<script src="vistas/js/almacen.js"></script>
	<!-- Se muestra el CINTAS -->
	<script src="vistas/js/cintas.js"></script>
	<!-- Se muestra el CINTAS -->
	<script src="vistas/js/centro-costos.js"></script>
	<!-- Se muestra la telefonia -->
	<script src="vistas/js/telefonia.js"></script>
	<!-- Se muestra el plan telefonia -->
	<script src="vistas/js/plan-telefonia.js"></script>
	<!-- Se muestra la linea -->
	<script src="vistas/js/lineas.js"></script>
	<!-- Para las capturas de las responsivas  -->
	<script src="vistas/js/responsivas.js"></script>


	<!-- Es para los reportes que se utilizaran en el sistema  -->	
	<script src="vistas/js/reportes.js"></script>	

</body>
</html>
