<?php
	// El vendedor no puede entrar a Perifericos
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
        Administrar Patch Panel
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Patch Panel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarPatchPanel">
            Agregar Patch Panel
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>PatchPanel</th>								
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
								$patchpanel = ControladorPatchPanel::ctrMostrarPatchPanel($item,$valor);
								// Probando mostrando lo que contiene la variable "$patchpanel"
								// var_dump($patchpanel);
								foreach ($patchpanel as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap"-->
													<td class="text-uppercase">'.$value["descripcion"].'</td>						
													
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditarPatchPanel" para activar una ventana modal -->
															<!-- "btnEditarPatchPanel" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarPatchPanel" idPatchPanel="'.$value["id_patch_panel"].'" data-toggle="modal" data-target="#modalEditarPatchPanel"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarPatchPanel, idPatchPanel="'.$value["id_patch_panel"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarPatchPanel" idPatchPanel="'.$value["id_patch_panel"].'"><i class="fa fa-times"></i></button>';
															}
																
														echo '</div>
													</td>
												</tr>';
								}

							?>

            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped" tablas> -->

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Agregar Patch Panel" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarPatchPanel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Patch Panel</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoPatchPanel" placeholder = "Ingresar Patch Panel " id="nuevoPatchPanel" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

				<!-- Pie Del Modal-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Patch Panel</button>
        </div>

				<?php 
					// Para grabar la Marcas.
					$crearPatchPanel = new ControladorPatchPanel();
					$crearPatchPanel->ctrCrearPatchPanel();
				?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarPatchPanel" class="modal fade" role="dialog"> --> 


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Patch Panel" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Patch Panel
	====================================================
-->
<div id="modalEditarPatchPanel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Patch Panel</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarPatchPanel"  id="editarPatchPanel" required>
								<!-- Se envía como campo oculto para enviar el "id" del Patch Panel -->
								<input type="hidden"  name="idPatchPanel"  id="idPatchPanel" required>
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
						// Para grabar la modifiacion del Patch Panel.
						$editarPatchP = new ControladorPatchPanel();
						$editarPatchP->ctrEditarPatchPanel();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarPeriferico" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar un Patch Panel.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarPatchPanel = new ControladorPatchPanel();
	$borrarPatchPanel->ctrBorrarPatchPanel();
?>
