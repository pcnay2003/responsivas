  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CAPTURAS RAPIDAS DE PRODUCTOS
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Capturas</li>
      </ol>
    </section>

		<div class="panel panel-default">
			<div class="panel-body">
			<br>
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Capturas Rapidas - Agregar Producto</h4>
        </div>

			<!-- Capturar Periferico -->
			<div class= "col-xs-12 col-sm-6">
				<div class="form-group">
					<label for="cap_periferico">Periferico:</label>			
					<div class = "input-group">
						<span class="input-group-addon"><i class="fa fa-th"></i></span>
						<select class="form-control input-lg" id= "nuevoPeriferico" name="nuevoPeriferico" required>
							<option value="">Seleccionar Periferico</option>
							<?php
								// Se obtendrán el Perifico desdes la base de datos.
								$item = null;
								$valor = null;
								$periferico = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
								foreach ($periferico as $key => $value)
								{
									echo '<option value = "'.$value["id_periferico"].'">'.$value["nombre"].'</option>';
								}
							?>
						</select>                
					</div> <!-- <div class = "input-group"> -->           							
				</div> <!-- <div class="form-group"> -->
			</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

			<!-- Captura el Modelo -->
			<div class= "col-xs-12 col-sm-6">
				<div class="form-group">
					<label for="cap_modelo">Modelo:</label>			
					<div class = "input-group">
						<span class="input-group-addon"><i class="fa fa-th"></i></span>
						<select class="form-control input-lg" id= "nuevoModelo" name="nuevoModelo" required>
							<option value="">Seleccionar Modelo</option>
							<?php
								// Se obtendrán el Modelo desde la base de datos.
								$item = null;
								$valor = null;
								$Modelo = ControladorModelos::ctrMostrarModelos($item,$valor);
								foreach ($Modelo as $key => $value)
								{
									echo '<option value = "'.$value["id_modelo"].'">'.$value["descripcion"].'</option>';
								}
							?>
						</select>                
					</div> <!-- <div class = "input-group"> -->           
				</div> <!-- <div class="form-group"> -->
			</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">

				<!-- CUERPO DE LA VENTANA MODAL -->
				<div class="modal-body">
          <div class="box-body">

            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturar el Número De Serie -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_serial">Serial:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "rap-nuevoSerial" name="rap-nuevoSerial" placeholder = "Ingresar Serial">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->
      </form>



			</div> <!-- <div class="panel-body"> -->

 		</div> <!-- class="panel panel-default"-->

	</div><!-- <div class="content-wrapper" -->

<?php



?>