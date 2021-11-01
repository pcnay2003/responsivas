  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Productos Produccion
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarProducto">
						Agregar Productos
					</button>       
					<?php
						echo '<a href="/responsivas/vistas/modulos/exp_prod_excel.php" target="_blank">';
					?>
					<button class="btn btn-info" id="exp_excel">
            Exportar Productos A Excel
          </button>       
					</a>



        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDataTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>Descripcion</th>
								<th>Modelo</th>
                <th>Serial</th>
								<th>Hostname</th>
								<th>Asset</th>                
								<th>Tel</th>
								<th>IMEI</th>
                <th>Stock</th>								
								<th>NTID</th>
                <th>Empleado</th>
                <th>Acciones </th>
              </tr>
            </thead>
            
						<!-- Cuerpo de la Tabla -->
            <!-- <tbody>


							<?php
							/*
								Se suprime para agregar el contenido de la tabla con Ajax al plugin DataTable.
								
								$item = null;
								$valor = null;
								$orden = "id";

								$productos = controladorProductos::ctrMostrarProductos($item,$valor,$orden);
								// Para mostrarlos en pantalla en las pruebas
								// var_dump($productos); 
								foreach ($productos as $key => $value)
								{
									echo ' 
									  <tr>
											<td>'.($key+1).'</td>
											<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
											<td>'.$value["codigo"].'</td>
											<!-- Clase de BootStrap -->
											<td>'.$value["descripcion"].'</td>';
											
											$item = "id";
											$valor = $value["id_categoria"];
											$categoria = ControladorCategorias::ctrMostrarCategorias($item,$valor);

											echo '<td>'.$categoria["nombre"].'</td>
											<td>'.$value["stock"].'</td>
											<td>'.$value["precio_compra"].'</td>
											<td>'.$value["precio_venta"].'</td>
											<td>'.$value["fecha"].'</td>
											<td>
												<div class="btn-group">
													<button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger"><i class="fa fa-times"></i></button>
												</div>
											</td>
										</tr>'; 
								}
								*/
							?>

            </tbody> -->

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

					<!-- Se agrega esta modificacion para poder utilizar las variables de sesion en el plugin DataTable el “id” se logra permiter el ingreso  -->
					<input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- // Agregar productos. -->
<!-- Modal -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Producto</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<div class="modal-body">
          <div class="box-body">

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

            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturar el Número De Serie -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_serial">Serial:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "nuevoSerial" name="nuevoSerial" placeholder = "Ingresar Serial">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->


						<!-- Captura el Marca -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_marca">Marca:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoMarca" name="nuevoMarca" required>
	                  <option value="">Seleccionar Marca</option>
										<?php
											// Se obtendrán la Marca desdes la base de datos.
											$item = null;
											$valor = null;
											$Marca = ControladorMarcas::ctrMostrarMarcas($item,$valor);
											foreach ($Marca as $key => $value)
											{
												echo '<option value = "'.$value["id_marca"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class = "form-group"> -->           	
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

						<!-- Captura el Almacen -->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_almacen">Almacen:</label>										
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoAlmacen" name="nuevoAlmacen" required>
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
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	


						<!-- Captura el Estado Del Equipo -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_edo_epo">Estado Del Periferico:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoEdoEpo" name="nuevoEdoEpo" required>
	                  <option value="">Seleccionar Edo Epo</option>
										<?php
											// Se obtendrán el Estado Del Equipo desdes la base de datos.
											$item = null;
											$valor = null;
											$edoEpo = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
											foreach ($edoEpo as $key => $value)
											{
												echo '<option value = "'.$value["id_edo_epo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->  								         
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturar la Nomenclatura -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_nomenclatura">Nomenclatura:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "nuevaNomenclatura" name="nuevaNomenclatura" placeholder = "Ingresar Nomenclatura">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Captura el Asset del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_asset">Asset:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="text" maxlength="15" class="form-control input-lg" id="nuevoAsset" name="nuevoAsset"  placeholder = "Ingresar Asset">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura el NPA -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_npa">NPA:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="text" maxlength="15" class="form-control input-lg" id="nuevoNpa" name="nuevoNpa"  placeholder = "Ingresar El NPA">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura el Número de Loftware que le corresponde en la impresora -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_lower">No. Loftware:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="text" maxlength="10" class="form-control input-lg" id="nuevoLoftware" name="nuevoLoftware"  placeholder = "Ingresar No. Loftware">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura el Area -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_ubicacion">Area:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevaArea" name="nuevaArea" required>
	                  <option value="">Seleccionar Area</option>
										<?php
											// Se obtendrán la Ubicacion desde la base de datos.
											$item = null;
											$valor = null;
											$ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
											foreach ($ubicacion as $key => $value)
											{
												echo '<option value = "'.$value["id_ubicacion"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Captura el Linea -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_linea">Linea:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevaLinea" name="nuevaLinea" required>
	                  <option value="">Seleccionar Linea</option>
										<?php
											// Se obtendrán la Linea desde la base de datos.
											$item = null;
											$valor = null;
											$linea = ControladorLineas::ctrMostrarLineas($item,$valor);
											foreach ($linea as $key => $value)
											{
												echo '<option value = "'.$value["id_linea"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Captura la Estacion -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_estacion">Estacion:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>								
									<input type="text" maxlength="50" class="form-control input-lg" id="nuevaEstacion" name="nuevaEstacion"  placeholder = "Ingresar La Estacion">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Numero de IP -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_num_ip">IP :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="20" class="form-control input-lg" id = "nuevoNumIp" name="nuevoNumIp" placeholder = "Numero de IP">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar el IDF -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_idf">IDF :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "nuevoIdf" name="nuevoIdf" placeholder = "Capturar de IDF">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar el Patch Panel -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_patchPanel">Patch Panel :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "nuevoPatchPanel" name="nuevoPatchPanel" placeholder = "Capturar Patch Panel">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar el Puerto -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_puerto">Puerto :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "nuevoPuerto" name="nuevoPuerto" placeholder = "Capturar Puerto">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar en que  funcion realiza en la linea -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_funcion">Funcion :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="20" class="form-control input-lg" id = "nuevaFuncion" name="nuevaFuncion" placeholder = "Capturar La Funcion">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar el JLS -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_jls">JLS :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="15" class="form-control input-lg" id = "nuevoJls" name="nuevoJls" placeholder = "Capturar El JLS">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Capturar el QDC -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_qdc">QDC :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="15" class="form-control input-lg" id = "nuevoQdc" name="nuevoQdc" placeholder = "Capturar El QDC">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Captura del Stock del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_stock">Stock:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" maxlength="3"class="form-control input-lg" id="nuevoStock" name="nuevoStock" min="1"  placeholder = "Ingresar Cantidad" required>
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura de Precio Compra -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group"> <!-- <div class="form-group row">-->
							
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->
							<div class="col-xs-12 col-sm-6">
								<label for="cap_precio_compra">Precio Compra:</label>										

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder = "Ingresar Precio Compra" required>
								</div> <!-- <div class = "input-group"> -->
							</div> <!-- 	<div class="col-xs-6">	-->
						</div> <!-- <div class="form-group row"> -->

							<!-- Captura de Precio Venta -->
							<!-- Clases de BootStrap para las formularios -->
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores  -->

						<div class="form-group"> <!-- <div class="form-group row"> -->
							<div class="col-xs-12 col-sm-6">
								<label for="cap_precio_venta">Precio Venta:</label>			

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales. -->
									
									<input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder = "Ingresar Precio Venta" required>
								</div> <!-- <div class = "input-group"> -->
								</div>
						
						</div> <!-- <div class="form-group">--> 

						<!-- Checkbox para porcentaje 
						<div class="form-group">
							<div class="col-xs-6">								
									<label>
										<!-- minimal, minimal-red, flat-red se debe activar en el "Plantilla.js"
										<input type="checkbox" id="porcentaje" name = "porcentaje" lass = "minimal porcentaje" checked>
										Utilizar porcentaje
									</label>

								</div> <!-- <div class="col-xs-6"> 

						</div> <!-- <div class="form-group">  -->

						<!-- Captura el Empleado asignado al producto. Este campo solo se utiliza para mostrar el nombre completo del empleado .-->
					<?php	
						$item = "id_empleado";
						$valor = 1;
						$orden = "apellidos";
						$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);
						$completo = $respuesta["nombre"].$respuesta["apellidos"];
						//var_dump($respuesta); Muestra el contenido del arreglo
						//print_r($completo); Muestra el contenido de la variable
						
					
						echo '<div class="form-group">
							<label for="cap_empleado_asignado">Usuario Asignado:</label>			
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nombreEmpleado" id="nombreEmpleado" placeholder = "'.$respuesta["nombre"].' '.$respuesta["apellidos"].'" readonly>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->'
          ?>		

						<div class="form-group">
							<label for="comentarios">Comentarios:</label>
							<textarea class="form-control" rows="5" name="nuevoComent" id="nuevoComent" placeholder="Comentarios">
							</textarea>
						</div>

						<!-- Subir Imagen del producto 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del producto.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->


					</div> <!-- <div class="box-body">  -->	
				</div> <!-- <div class="modal-body">  -->				


          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
          </div>

        </form>

				<!-- Para Guardar la información. -->
				<?php
					$crearProducto = new ControladorProductos();
					$tipo_prod = 'Produccion';
					$crearProducto->ctrCrearProducto($tipo_prod);
					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarProducto" class="modal fade" role="dialog"> -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Producto" se activa esta ventana.
-->
<!-- // Editar productos. -->
<!-- Modal -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Producto</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<div class="modal-body">
          <div class="box-body">

						<!-- Los valores se cargaran desdes Javascritp -->		
						
						<!-- Editar Periferico -->
						
            <div class= "col-xs-12 col-sm-6">							
							<div class="form-group">			
								<label for="periferico">Periferico:</label>				
	              <div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>									
	                <select class="form-control input-lg"  name="editarPeriferico" required>
	                  <option id="editarPeriferico"></option>
										<?php
											$item = null;
											$valor = null;
											$perifericos = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
											foreach ($perifericos as $key => $value)
											{
												echo '<option value = "'.$value["id_periferico"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	


            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar el Número De Serie -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="serial">Serial:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "editarSerial" name="editarSerial">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar Compañia Telefonica-->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="telefonia">Cia. Telefonica:</label>							
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg"  name="editarTelefonia" required>
	                  <option id="editarTelefonia"> </option>
										<?php
											$item = null;
											$valor = null;
											$telefonias = ControladorTelefonias::ctrMostrarTelefonias($item,$valor);
											foreach ($telefonias as $key => $value)
											{
												echo '<option value = "'.$value["id_telefonia"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Capturar Plan Telefonia-->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">							
							<label for="plan_celular">Plan Celular:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" name="editarPlanTelefonia" required>
	                  <option id= "editarPlanTelefonia"></option>
										<?php
											$item = null;
											$valor = null;
											$Plan_telefonias = ControladorPlanTelefonias::ctrMostrarPlanTelefonias($item,$valor);
											foreach ($Plan_telefonias as $key => $value)
											{
												echo '<option value = "'.$value["id_plan_tel"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar numero de telefono. -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="num_tel">Número Tel:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="25" class="form-control input-lg" id = "editarNumTel" name="editarNumTel" >
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar numero de Cuenta. -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="plan_celular">Numero Cta. Celular:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "editarCuenta" name="editarCuenta">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar Direccion MAC del Telefono. -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="direcc_mac">Direccion MAC Celular:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="20" class="form-control input-lg" id = "editarDireccMac" name="editarDireccMac">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar Direccion IMEI del Telefono. -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="imei_tel">IMEI Celular:</label>
	              <div class = "input-group">									
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="30" class="form-control input-lg" id = "editarImei" name="editarImei">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Estado del Telefono-->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="edo_tel">Estado Telefono:</label>							
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "editarEdoTel" name="editarEdoTel" required>
	                  <option value="">Estado Linea Tel</option>										
										<option value="Disponible">Disponible</option>
										<option value="Asignado">Asignado</option>
										<option value="NO Aplica">NO Aplica</option>
									</select>                
	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Editar el Marca -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="marca">Marca :</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" name="editarMarca" required>
	                  <option id= "editarMarca"></option>
										<?php
											$item = null;
											$valor = null;
											$marcas = ControladorMarcas::ctrMostrarMarcas($item,$valor);
											foreach ($marcas as $key => $value)
											{
												echo '<option value = "'.$value["id_marca"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class = "form-group"> -->           	
            </div> <!-- <div class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el Modelo -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="modelo">Modelo:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" name="editarModelo" required>
	                  <option id= "editarModelo"></option>
										<?php
											$item = null;
											$valor = null;
											$modelos = ControladorModelos::ctrMostrarModelos($item,$valor);
											foreach ($modelos as $key => $value)
											{
												echo '<option value = "'.$value["id_modelo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Editar el Almacen -->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="almacen">Almacen:</label>							
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" name="editarAlmacen" required>
	                  <option id= "editarAlmacen"></option>
										<?php
											$item = null;
											$valor = null;
											$almacenes = ControladorAlmacenes::ctrMostrarAlmacenes($item,$valor);
											foreach ($almacenes as $key => $value)
											{
												echo '<option value = "'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	


						<!-- Editar el Estado Del Equipo -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="edo_epo">Estado Equipo:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg"  name="editarEdoEpo" required>
	                  <option id= "editarEdoEpo"></option>
										<?php
											$item = null;
											$valor = null;
											$edo_epos = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
											foreach ($edo_epos as $key => $value)
											{
												echo '<option value = "'.$value["id_edo_epo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                

	              </div> <!-- <div class = "input-group"> -->  								         
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Editar la Nomenclatura -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="nomenclatura">Nomenclatura:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="45" class="form-control input-lg" id = "editarNomenclatura" name="editarNomenclatura">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el Asset del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="editar_asset">Asset:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="text" maxlength="15" class="form-control input-lg" id="editarAsset" name="editarAsset">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Editar el NPA -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="editar_npa">NPA:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>									
									<input type="text" maxlength="15" class="form-control input-lg" id="editarNpa" name="editarNpa">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Editar el Número de Loftware que le corresponde en la Impresora -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="cap_lower">No. Loftware:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>									
									<input type="text" maxlength="10" class="form-control input-lg" id="editarLoftware" name="editarLoftware">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Editar el Area -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_ubicacion">Area:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg"  name="editarArea" required>
	                  <option id= "editarArea"></option>
										<?php
											// Se obtendrán la Ubicacion desde la base de datos.
											$item = null;
											$valor = null;
											$ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
											foreach ($ubicacion as $key => $value)
											{
												echo '<option value = "'.$value["id_ubicacion"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Editar la Linea -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
								<label for="cap_linea">Linea:</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" name="editarLinea" required>
	                  <option id= "editarLinea"></option>
										<?php
											// Se obtendrán la Linea desde la base de datos.
											$item = null;
											$valor = null;
											$linea = ControladorLineas::ctrMostrarLineas($item,$valor);
											foreach ($linea as $key => $value)
											{
												echo '<option value = "'.$value["id_linea"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

						<!-- Editar la Estacion -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="editar_estacion">Estacion:</label>			
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>								
									<input type="text" maxlength="50" class="form-control input-lg" id="editarEstacion" name="editarEstacion">
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Numero de IP -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
							<label for="perif_ip">IP Periferico:</label>
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="20" class="form-control input-lg" id = "editarNumIp" name="editarNumIp">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el IDF -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="editar_idf">IDF :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "editarIdf" name="editarIdf">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el Patch Panel -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="editar_patchPanel">Patch Panel :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "editarPatchPanel" name="editarPatchPanel" placeholder = "Capturar Patch Panel">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el Puerto -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="editar_puerto">Puerto :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="5" class="form-control input-lg" id = "editarPuerto" name="editarPuerto">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar en que  funcion realiza en la linea -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="editar_funcion">Funcion :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="20" class="form-control input-lg" id = "editarFuncion" name="editarFuncion">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el JLS -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_jls">JLS :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="15" class="form-control input-lg" id = "editarJls" name="editarJls">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Editar el QDC -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
								<label for="cap_qdc">QDC :</label>			
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" maxlength="15" class="form-control input-lg" id = "editarQdc" name="editarQdc">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->


						<!-- Editar del Stock del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="stock">Stock:</label>
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" maxlength="3" class="form-control input-lg" id="editarStock" name="editarStock" required>
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Editar Precio Compra -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group"> <!-- <div class="form-group row">-->
							
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->
							
							<div class="col-xs-12 col-sm-6">							
							<label for="precio_compra">Precio Compra:</label>					
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" required>
								</div> <!-- <div class = "input-group"> -->
							</div> <!-- 	<div class="col-xs-6">	-->
						</div> <!-- <div class="form-group row"> -->

						<!-- Editar de Precio Venta -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group"> <!-- <div class="form-group row">-->
							
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->
							
							<div class="col-xs-12 col-sm-6">							
								<label for="precio_venta">Precio Venta:</label>
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" required>
								</div> <!-- <div class = "input-group"> -->

							<br>
						</div> <!-- <div class="form-group row"> -->

						<!-- Captura el Empleado asignado al producto. Este campo solo se utiliza para mostrar el nombre completo del empleado .-->
					
					<div class="form-group row">
						<div class="col-lg-12 col-sm-12">
							<label for="empleado_asignado">Empleado Asignado:</label>			
							<div class = "input-group">								
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<input type="text" class="form-control input-lg" name="editarNombreEmpleado_E" id="editarNombreEmpleado_E" readonly>
							</div> <!-- <div class = "input-group"> -->           
						</div> <!-- <div class="col-xm-12 col-sm-12" -->           	
					</div> <!-- <div class="form-group"> -->          	

					<div class="form-group">
						<label for="comentarios">Comentarios:</label>
						<textarea class="form-control" rows="5" name="editarComent" id="editarComent" placeholder="Comentarios">
						</textarea>
					</div>

						<!-- Subir Imagen del producto 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del producto.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
							
							<!-- En el caso de que no Editen la Imagen.	-->
							<input type="hidden" name="imagenActual" id="imagenActual">

            </div> <!-- <div class="form-group"> -->


					</div> <!--  class="modal-body"> -->
        </div> <!-- class="box-body"> -->
					
					<!-- Enviar el "id_producto" -->
					<input type="hidden"  name="IdProducto"  id="IdProducto" required>

					<div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Producto</button>
          </div>
			
			</form>
				<!-- Para Guardar lo editado del Producto. -->
				<?php
					$editarProducto = new ControladorProductos();					
					$editarProducto->ctrEditarProducto();					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarProducto" class="modal fade" role="dialog"> -->
<?php
	// Eliminar producto.
	$eliminarProducto = new ControladorProductos();
	$eliminarProducto->ctrEliminarProducto();					

?>
