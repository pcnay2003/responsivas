  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Empleados
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Empleados</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarEmpleado">
            Agregar Empleado
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js Se define "tablaEmpleados" para utilizar JSon para mostrar los datos, ya que son bastantes -->
          <table class="table table-bordered table-striped dt-responsive tablaEmpleados" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>NTID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo Elect</th>
								<th>Puesto</th>
                <th>Depto</th>
								<th>Supervisor</th>
								<th>Centro Costo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            
						<!-- Cuerpo de la Tabla -->
            <tbody>

            </tbody> 

          </table> <!-- table table-bordered table-striped dt-responsive tablaEmpleados -->

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


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Agregar Empleados" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Empleado</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->

				<!-- Captura el NT ID del empleado -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Capturar el NT ID -->
						<label for="ntid_empleado">NTID Empleado:</label>			
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-id-card"></i></span>
                <input type="text" maxlength="20" class="form-control input-lg" id = "nuevo_ntid" name="nuevo_ntid" placeholder = "Ingresar NT ID" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura de nombre del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" maxlength="20" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder = "Ingresar Nombre" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Capturar el Apelllido del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>

                <input type="text" maxlength="45" class="form-control input-lg" id="nuevoApellido" name="nuevoApellido" placeholder = "Ingresar Apellidos" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Capturar el correo electronico -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-envelope"></i></span>

                <input type="email" maxlength="50" class="form-control input-lg" id="nuevoCorreoElect" name="nuevoCorreoElect" placeholder = "Ingresar Correo Electronico" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el puesto del empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" maxlength="45" class="form-control input-lg" id="nuevo_Puesto" name="nuevo_Puesto" placeholder = "Ingresar El Puesto" required>
								<input type="hidden"  name="nuevoPuesto"  id="nuevoPuesto" required>

              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Es donde se muestra la tabla cuando el usuario teclea el puesto -->
						<div id = "tablaPuestos"> </div>
						
						<!-- 		
                <select class="form-control input-lg" id= "nuevoPuesto" name="nuevoPuesto" required>
                  <option value="">Seleccionar Puesto</option>
									<?php
										// Se obtendrán los Puestos desdes la base de datos.
										//$item = null;
										//$valor = null;						

										//$puestos = ControladorPuestos::ctrMostrarPuestos($item,$valor);
										//foreach ($puestos as $key => $value)
										//{
										//	echo '<option value = "'.$value["id_puesto"].'">'.$value["descripcion"].'</option>';
									//	}
									?>
                </select>                
              </div> <div class = "input-group">
						 -->           



            </div> <!-- <div class="form-group"> -->


						<!-- Captura el Depto que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" id= "nuevoDepto" name="nuevoDepto" required>
                  <option value="">Seleccionar Depto</option>
									<?php
										// Se obtendrán los Deptos desdes la base de datos.
										$item = null;
										$valor = null;						

										$depto = ControladorDeptos::ctrMostrarDeptos($item,$valor);
										foreach ($depto as $key => $value)
										{
											echo '<option value = "'.$value["id_depto"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Supervisor que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id= "nuevoSupevisor" name="nuevoSupervisor" required>
                  <option value="">Seleccionar Supervisor</option>
									<?php
										// Se obtendrán el Supervisor desdes la base de datos.
										$item = null;
										$valor = null;						

										$supervisor = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
										foreach ($supervisor as $key => $value)
										{
											echo '<option value = "'.$value["id_supervisor"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura la Ubicacion que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-street-view"></i></span>
                <select class="form-control input-lg" id= "nuevaUbicacion" name="nuevaUbicacion" required>
                  <option value="">Seleccionar Ubicacion</option>
									<?php
										// Se obtendrán la Ubicacion desdes la base de datos.
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

					<!-- 
						<!-- Captura el Centro De Costos del empleado 
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" id= "nuevoCentro_Costos" name="nuevoCentro_Costos" required>
                  <option value="">Seleccionar Centro De Costos</option>
									<?php
									/*
										// Se obtendrán el Centro De Costos desde de la base de datos.
										$item = null;
										$valor = null;						

										$centro_costos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
										foreach ($centro_costos as $key => $value)
										{
											echo '<option value = "'.$value["id_centro_costos"].'">'.$value["num_centro_costos"].'</option>';
										}
										*/
									?>
                </select>                
              </div> <!-- <div class = "input-group"> 
            </div> <!-- <div class="form-group"> -->
					
						<!-- Captura el Centro De Costos -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" maxlength="10" class="form-control input-lg" id="nuevo_CC" name="nuevo_CC" placeholder = "Ingresar El Centro Costos" required>
								<input type="hidden"  name="nuevoCentro_Costos"  id="nuevoCentro_Costos" required>

              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Es donde se muestra la tabla cuando el usuario teclea el puesto -->
						<div id = "tablaCC"> </div>


						<!-- Subir Imagen del Usuario 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del Usuario.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL EMPLEADO</div> 
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
          </div>

        </form>

				<!-- Para Guardar la información en la base de datos  -->
				<?php
					$crearEmpleado = new ControladorEmpleados();
					$crearEmpleado->ctrCrearEmpleado();
					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarEmpleado" class="modal fade" role="dialog"> -->


<!-- // Editar empleados. -->
<!-- Modal -->
<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Empleado</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<!-- Editar el NTID del Empleado -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Editar el NT ID -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fad fa-id-card"></i></span>
                <input type="hidden"  name="id_empleado"  id="id_empleado" required>
                <input type="text" maxlength="20" class="form-control input-lg" id = "editar_ntid" name="editar_ntid" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Editar de nombre del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" maxlength="20" class="form-control input-lg" id="editarNombre" name="editarNombre" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Editar el Apelllido del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" maxlength="45" class="form-control input-lg" id="editarApellido" name="editarApellido" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Capturar el correo electronico -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-envelope"></i></span>

                <input type="text" maxlength="50" class="form-control input-lg" id="editarCorreoElect" name="editarCorreoElect" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Editar el Puesto del empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg"  name="editarPuesto" required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id="editarPuesto"></option>
									<?php
										$item = null;
										$valor = null;
										$puestos = ControladorPuestos::ctrMostrarPuestos($item,$valor);
										foreach ($puestos as $key => $value)
										{
											echo '<option value = "'.$value["id_puesto"].'">'.$value["descripcion"].'</option>';
										}
									?>

                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->


						<!-- Editar el Depto que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" name="editarDepto" required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                <option id="editarDepto"></option>
									<?php
										$item = null;
										$valor = null;
										$deptos = ControladorDeptos::ctrMostrarDeptos($item,$valor);
										foreach ($deptos as $key => $value)
										{
											echo '<option value = "'.$value["id_depto"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                

              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Editar el Supervisor que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarSupervisor" required>
                  <option id="editarSupervisor"></option>
									<?php
										$item = null;
										$valor = null;
										$supervisores = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
										foreach ($supervisores as $key => $value)
										{
											echo '<option value = "'.$value["id_supervisor"].'">'.$value["descripcion"].'</option>';
										}
									?>

	              </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Editar la Ubicacion que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-street-view"></i></span>
                <select class="form-control input-lg" name="editarUbicacion" required>
                  <option id="editarUbicacion"></option>
									<?php
										$item = null;
										$valor = null;
										$ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
										foreach ($ubicaciones as $key => $value)
										{
											echo '<option value = "'.$value["id_ubicacion"].'">'.$value["descripcion"].'</option>';
										}
									?>

	              </select>                
  
	            </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Editar el Centro De Costos del empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-street-view"></i></span>
                <select class="form-control input-lg" name="editarCentro_Costos" required>
                  <option id="editarCentro_Costos"></option>
									<?php
										$item = null;
										$valor = null;
										$centro_costos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
										foreach ($centro_costos as $key => $value)
										{
											echo '<option value = "'.$value["id_centro_costos"].'">'.$value["num_centro_costos"].'</option>';
										}
									?>

	              </select>                
  
	            </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Subir Imagen del producto 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del producto.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
							<!-- Se manda el nombre de la imagen actual, en el caso de que no se modifique la imagen y manda a Javascript utilizando un campo oculto -->
							<input type = "hidden" name = "imagenActual" id="imagenActual">							 

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">						
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Cambios</button>
          </div>

        </form>

				<!-- Para Guardar la Edicion del Empleado -->
				<?php
					$editarEmpleado = new ControladorEmpleados();
					$editarEmpleado->ctrEditarEmpleado();					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarEmpleado" class="modal fade" role="dialog"> -->
<?php
	$eliminarEmpleado = new ControladorEmpleados();
	$eliminarEmpleado->ctrEliminarEmpleado();
?>