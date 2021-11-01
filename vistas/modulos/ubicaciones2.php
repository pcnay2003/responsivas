<?php
	// El vendedor no puede entrar a Ubicacion
	if ($_SESSION["perfil"] == "Vendedor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Ubicaciones
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Ubicacion</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarUbicacion">
            Agregar Ubicacion
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablaUbicaciones">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Ubicacion</th>								
                <th>Acciones </th>
              </tr>
            </thead>

            <!-- Cuerpo de la Tabla, se modifica para agregarlas dinamicamente -->
            <tbody>

							<?php
								// Mostrar los registros desde la base de datos.
								// Se asignan nulo para que extraiga todos los registros.
								$item = null;
								$valor = null;
								$ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
								// Probando mostrando lo que contiene la variable "$ubicaciones"
								// var_dump($ubicaciones);
								foreach ($ubicacion as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap"-->
													<td class="text-uppercase">'.$value["descripcion"].'</td>							
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditaUbicacion" para activar una ventana modal -->
															<!-- "btnEditarUbicacion" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarUbicacion" idUbicacion="'.$value["id_ubicacion"].'" data-toggle="modal" data-target="#modalEditarUbicacion"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarUbicacion, idUbicacion="'.$value["id_ubicacion"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarUbicacion" idUbicacion="'.$value["id_ubicacion"].'"><i class="fa fa-times"></i></button>';
															}
																
														echo '</div>
													</td>
												</tr>';
								}

							?>

            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Agregar Ubicacion" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarUbicacion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Ubicacion</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaUbicacion" placeholder = "Ingresar Ubicacion" id="nuevaUbicacion" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Ubicacion</button>
          </div>

					<?php 
						// Para grabar la Ubicacion.
						$crearUbicacion = new ControladorUbicaciones();
						$crearUbicacion->ctrCrearUbicacion();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarUbicacion" class="modal fade" role="dialog"> --> 


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Ubicacion" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Ubicacion
	====================================================
-->
<div id="modalEditarUbicacion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Ubicacion</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarUbicacion"  id="editarUbicacion" required>
								<!-- Se envía como campo oculto para enviar el "id" de la Ubicacion -->
								<input type="hidden"  name="idUbicacion"  id="idUbicacion" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>

					<?php 
						// Para grabar la modifiacion de Marca.
						$editarUbicacion = new ControladorUbicaciones();
						$editarUbicacion->ctrEditarUbicacion();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarPeriferico" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar un Ubicacion.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarUbicacion = new ControladorUbicaciones();
	$borrarUbicacion->ctrBorrarUbicacion();
?>
