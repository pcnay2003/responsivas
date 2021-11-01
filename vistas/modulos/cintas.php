<?php
// Los perfiles que no tiene permitido 
	/*
	if ($_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Operador" )
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
        Administrar Cintas de Respaldo
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Cintas de Respaldo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarCintas">
            Agregar 
          </button>       

					<?php
					echo '<a href="/responsivas/extensiones/tcpdf/pdf/rep-cintas.php" target="_blank" >';
					?>
					<button class="btn btn-success" id="imp_cintas">
            Imprimir
          </button>       
					</a>

					<?php
					echo '<a href="/responsivas/vistas/modulos/descargar-excel.php" target="_blank">';
					?>
					<button class="btn btn-info" id="exp_excel">
            Exportar A Excel
          </button>       
					</a>

        </div>
 

        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js Se define "tablaCintas" para utilizar JSon para mostrar los datos, ya que son bastantes -->
          <table class="table table-bordered table-striped dt-responsive tablaCintas" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Numero Serie</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Ubicacion</th>
                <th>Comentarios</th>
                <th>Acciones</th>
              </tr>
            </thead>
            
						<!-- Cuerpo de la Tabla -->
            <tbody>

            </tbody> 

          </table> <!-- table table-bordered table-striped dt-responsive tablaCintas -->

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
Cuando el usuario oprima el boton de "Agregar Cintas" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarCintas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cintas</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->

				<!-- Captura el Numero de Serie -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Capturar el Numero De Serie de la Cinta -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-id-card"></i></span>
                <input type="text" class="form-control input-lg" id = "nueva_cinta" name="nueva_cinta" placeholder = "Ingresar Serial Cinta" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->


						<!-- Captura la Fecha Inicio -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="date" class="form-control input-lg" id="nueva_fecha_inic" name="nueva_fecha_inic" placeholder = "Ingresar La Fecha Inicial" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura la Fecha final -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="date" class="form-control input-lg" id="nueva_fecha_fin" name="nueva_fecha_fin" placeholder = "Ingresar La Fecha Final" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura la Ubicacion -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nueva_ubic" name="nueva_ubic" placeholder = "Ingresar La Ubicacion" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura de Comentarios -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoComent" name="nuevoComent" placeholder = "Ingresar Los Comentarios" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura los Comentarios 
						<div class="form-group">						
						  <label for="comentarios">Comentarios:</label>
							<textarea class="form-control" rows="5" cols="30" name="nuevoComent" id="nuevoComent">							       
							</textarea>
						</div>
						-->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cinta</button>
          </div>

        </form>

				<!-- Para Guardar la información en la base de datos  -->
				<?php
					$crearCinta = new ControladorCintas();
					$crearCinta->ctrCrearCintas();
					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarEmpleado" class="modal fade" role="dialog"> -->


<!-- // Editar Cintas -->
<!-- Modal -->
<div id="modalEditarCinta" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Cintas</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<!-- Editar el Numero de Serie -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Editar el Número de Serie -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fad fa-id-card"></i></span>
                <input type="hidden"  name="id_cintas"  id="id_cintas" required>
                <input type="text" class="form-control input-lg" id = "editar_num_serial" name="editar_num_serial" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Editar de Fecha Inicio -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="date" class="form-control input-lg" id="editar_fecha_inic" name="editar_fecha_inic" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Editar de Fecha Fin -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="date" class="form-control input-lg" id="editar_fecha_fin" name="editar_fecha_fin" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Editar Ubicacion -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editar_ubicacion" name="editar_ubicacion" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Editar Comentarios -->

						<!-- Captura los Comentarios 
						<div class="form-group">						
						  <label for="comentarios">Comentarios:</label>
							<textarea class="form-control" rows="5" cols="30" name="editar_comentarios" id="editar_comentarios">							       
							</textarea>
						</div>
						-->		

	           <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editar_comentarios" name="editar_comentarios" required>
              </div>  <!-- <div class = "input-group"> -->
            </div>  <!-- <div class="form-group"> -->


          <div class="modal-footer">						
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Cambios</button>
          </div>

        </form>

				<!-- Para Guardar la Edicion de la Cinta -->
				<?php
					$editarCinta = new ControladorCintas();
					$editarCinta->ctrEditarCinta();					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarCinta" class="modal fade" role="dialog"> -->

<?php
	$eliminarCinta = new ControladorCintas();
	$eliminarCinta->ctrBorrarCinta();
?>