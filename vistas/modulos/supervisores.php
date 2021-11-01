<?php
/*
	// El vendedor no puede entrar a Perifericos
	if ($_SESSION["perfil"] == "Vendedor")
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
        Administrar Supervisores
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Supervisores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarSupervisores">
            Agregar Supervisores
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
                <th>Supervisores</th>								
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
								$supervisores = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
								// Probando mostrando lo que contiene la variable "$supervisores"
								// var_dump($supervisores);
								foreach ($supervisores as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap" <td class="text-uppercase">-->
													<td>'.$value["descripcion"].'</td>							
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditarSupervisor" para activar una ventana modal -->
															<!-- "btnEditarSupervisor" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarSupervisor" idSupervisor="'.$value["id_supervisor"].'" data-toggle="modal" data-target="#modalEditarSupervisor"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarSupervisor, idSupervisor="'.$value["id_supervisor"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarSupervisor" idSupervisor="'.$value["id_supervisor"].'"><i class="fa fa-times"></i></button>';
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
Cuando el usuario oprima el boton de "Agregar Supervisor" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarSupervisores" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Supervidores</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoSupervisor" placeholder = "Ingresar Nombre del Supervisor" id="nuevoSupervisor" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Supervisor</button>
          </div>

					<?php 
						// Para grabar el Supervisor.
						$crearSupervisor = new ControladorSupervisores();
						$crearSupervisor->ctrCrearSupervisores();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarSupervisores class="modal fade" role="dialog"> --> 


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Supervisor" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Supervisor
	====================================================
-->
<div id="modalEditarSupervisor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Supervisor</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarSupervisor"  id="editarSupervisor" required>
								<!-- Se envía como campo oculto para enviar el "id" del Supervisor -->
								<input type="hidden"  name="idSupervisor"  id="idSupervisor" required>
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
						// Para grabar la modifiacion del Supervisor.
						$editarSupervisor = new ControladorSupervisores();
						$editarSupervisor->ctrEditarSupervisor();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarSupervisor" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar un Supervisor.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarSupervisor = new ControladorSupervisores();
	$borrarSupervisor->ctrBorrarSupervisor();
?>
