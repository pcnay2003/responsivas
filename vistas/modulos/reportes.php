<?php
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
/*
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
	*/
	
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes Varios
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

			<div class="row">
				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Por Almacen: </label>						
					</div>

				<!-- enctype= "multipart/form-data = Para subir archivos. -->
				
					<!-- Captura el Almacen -->
					<div class= "col-xs-12 col-sm-5">
						<div class="form-group">							
							<div class = "input-group">
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<select class="form-control input-lg" id= "rep_Almacen" name="rep_Almacen" required>
									<option value="">Seleccionar Almacen</option>
									<?php
										// Se obtendrán el Almacen desdes la base de datos.
										$item = null;
										$valor = null;
										$almacen = ControladorAlmacenes::ctrMostrarAlmacenes($item,$valor);
										foreach ($almacen as $key => $value)
										{
											echo '<option value = "'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
										}
									?>
								</select>                							

							</div> <!-- <div class = "input-group"> -->  
							<br>         							
							<?php
								//echo '<a href="/responsivas/extensiones/tcpdf/pdf/rep-cintas.php?id_Almacen='.$value["id_almacen"].'" target="_blank" >';
							?>
							<button class="btn btn-success btnImpProdAlm" id="imp_cintas">
								Imprimir
							</button>       
							<!-- </a> -->

							<!--<button type="submit" class='btn btn-info btnImpProdAlm'>Imprimir					
							</button>       -->
										
						</div> <!-- <div class="form-group"> -->

					</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	
					
				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Telefonos Asignado: </label>						
					</div>

					<button class="btn btn-success btnImpTelAsig" id="imp_tel">Imprimir</button>

				</div>

			</div> <!-- <div class="row"> -->
			
			<div class="row">
				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Existencia de Perifericos: </label>
						<br>
					</div>
					
					<button class="btn btn-success btnExistenciaPerif" id="exist_perif">Imprimir</button>
				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Historial del Periferico: </label>						
					</div>

					<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_num_tel">Capturar El Serial Del Periferico</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" class="form-control input-lg" id = "num_serie" name="num_serie" placeholder = "Ingresar Numero De Serie">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

					<button class="btn btn-success btnHistPerif" id="imp_HistPerif">Imprimir</button>

				</div>

			</div> <!-- <div class="row"> -->


			<div class="row">

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Equipos Entregado Al Usuario: </label>
						<br>
					</div>

					<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_num_tel">Capturar Numero Empleado:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" class="form-control input-lg" id = "numEmp" name="numEmp" placeholder = "Ingresar Numero Empleado">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

					<button class="btn btn-success btnEpoEntregEmp" id="id_EpoEntregEmp">Imprimir</button> 
				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Perifericos Por Linea Produccion: </label>
						<br>
					</div>

					<div class= "col-xs-12 col-sm-5">
						<div class="form-group">							
							<div class = "input-group">
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<select class="form-control input-lg" id= "rep_LineaProd" name="rep_LineaProd" required>
									<option value="">Seleccionar Linea Prod</option>
									<?php
										// Se obtendrán las lineas de Produccion.
										$item = null;
										$valor = null;
										$lineas = ControladorLineas::ctrMostrarLineas($item,$valor);
										foreach ($lineas as $key => $value)
										{
											echo '<option value = "'.$value["id_linea"].'">'.$value["descripcion"].'</option>';
										}
									?>
								</select>                							

							</div> <!-- <div class = "input-group"> -->  
							<br>         							
							<?php
								//echo '<a href="/responsivas/extensiones/tcpdf/pdf/rep-cintas.php?id_Almacen='.$value["id_almacen"].'" target="_blank" >';
							?>
							<button class="btn btn-success btnPerifProd" id="perif_lineas">
								Imprimir
							</button>       
							<!-- </a> -->

							<!--<button type="submit" class='btn btn-info btnImpProdAlm'>Imprimir					
							</button>       -->
										
						</div> <!-- <div class="form-group"> -->

					</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

					<!-- <button class="btn btn-success btnPerifProd" id="Perif_Prod">Imprimir</button> -->

				</div>

			</div> <!-- <div class="row"> -->
			
			<div class="row">
				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Equipos Prestados : </label>
						<br>				
					</div>									
						<button class="btn btn-success btnEposPrestados" id="epo_prestado">Imprimir</button>					
				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Subir Varias : </label>
						<br>						
					</div>					
						<button class="btn btn-success btnSubirCinta" id="subir_cinta" disabled >Subir Cintas</button>	
						<button class="btn btn-success btnSubirInvIT" id="inv_it" >Inv I.T.</button>						
						<br>

				</div>

			</div> <!-- <div class="row"> -->

			<div class="row">

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Subir Documentos Empleado: </label>
						<br>
					</div>

					<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_num_tel">Capturar Numero Empleado:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" class="form-control input-lg" id = "ntid_Emp" name="ntid_Emp" placeholder = "Ingresar Numero Empleado">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

					<button class="btn btn-success btnSubirResp" id="subir_responsiva">Subir</button> 
				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Reporte Mensual Finanzas IT</label>
						<br>
					</div>

					<div class= "col-xs-12 col-sm-5">
						<label>Fecha Inicial:</label>
						<div class="form-group">							
							<div class = "input-group">											
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<input type="date" class="form-control input-lg" id = "fecha_inicial" name="fecha_inicial" placeholder = "YYYY-MM-DD">
																				
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<input type="date" class="form-control input-lg" id = "fecha_final" name="fecha_final" placeholder = "YYYY-MM-DD">
							</div> <!-- <div class = "input-group"> -->  
							
							<br>         							
							<button class="btn btn-success btnRep_Finanzas" id="rep_Finanzas">
								Imprimir
							</button>  

							<button class="btn btn-success btnRep_Finanzas_Excel" id="rep_Finanzas_Excel">
								Exportar Excel
							</button>  

							<!-- </a> -->

							<!--<button type="submit" class='btn btn-info btnImpProdAlm'>Imprimir					
							</button>       -->
										
						</div> <!-- <div class="form-group"> -->

					</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

				</div> <!-- <div class = "col-lg-6 col-xs-12">  -->

			</div> <!-- <div class="row"> -->

			<div class="row">

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Equipos Dañados: </label>
						<br>
					</div>

					<button class="btn btn-success btnEpo_Danado" id="epo_danado">Imprimir</button> 

				</div>

				<div class = "col-lg-6 col-xs-12">
					<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
					<div class="box box-success">
						<div class="box-header with-border"></div>
						<label>Reporte Nuevos</label>
						
					</div>							
					
					<button class="btn btn-success btnRep_Finanzas" id="rep_Finanzas">
						Imprimir
					</button>  

							<!-- </a> -->

							<!--<button type="submit" class='btn btn-info btnImpProdAlm'>Imprimir					
							</button>       -->
										
						</div> <!-- <div class="form-group"> -->

					</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

				</div> <!-- <div class = "col-lg-6 col-xs-12">  -->

			</div> <!-- <div class="row"> -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
