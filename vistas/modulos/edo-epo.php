<?php
	// El vendedor no puede entrar a Estado de Equipo
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
        Administrar Estado De Equipo
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Estado Del Equipo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarEdo_Epo">
            Agregar Estado Del Equipo
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
                <th>Estado Equipo</th>								
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
								$edo_epos = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
								// Probando mostrando lo que contiene la variable "$edo_epos"
								// var_dump($edo_epos);
								foreach ($edo_epos as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap"-->
													<td>'.$value["descripcion"].'</td>							
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditarEdo_Epo" para activar una ventana modal -->
															<!-- "btnEditarEdo_Epo" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarEdo_Epo" idEdo_Epo="'.$value["id_edo_epo"].'" data-toggle="modal" data-target="#modalEditarEdo_Epo"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarEdo_Epo, idEdo_Epo="'.$value["id_edo_epo"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarEdo_Epo" idEdo_Epo="'.$value["id_edo_epo"].'"><i class="fa fa-times"></i></button>';
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
Cuando el usuario oprima el boton de "Agregar Estado Del Equipo" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarEdo_Epo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Estado Del Equipo</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="80" class="form-control input-lg" name="nuevoEdo_Epo" placeholder = "Ingresar Estado Del Equipo" id="nuevoEdo_Epo" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Edo Epo</button>
          </div>

					<?php 
						// Para grabar el Estado Del Equipo.
						$crearEdo_Epo = new ControladorEdo_Epos();
						$crearEdo_Epo->ctrCrearEdo_Epo();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarEdo_Epo -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Estado Equipo" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Estado Equipo 
	====================================================
-->
<div id="modalEditarEdo_Epo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Estado Equipo</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="80" class="form-control input-lg" name="editarEdo_Epo"  id="editarEdo_Epo" required>
								<!-- Se envía como campo oculto para enviar el "id" de la Estado Equipo -->
								<input type="hidden"  name="idEdo_Epo"  id="idEdo_Epo" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Cambios</button>
          </div>

					<?php 
						// Para grabar la modifiacion de Estado Equipos.
						$editarEdo_Epo = new ControladorEdo_Epos();
						$editarEdo_Epo->ctrEditarEdo_Epo();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarEdo_Epo" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar un Estado Equipo.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarEdo_Epo = new ControladorEdo_Epos();
	$borrarEdo_Epo->ctrBorrarEdo_Epo();
?>


