<?php
	/*
	// El vendedor no puede entrar a Perifericos
	if ($_SESSION["perfil"] == "Operador")
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
        Administrar Planes De Telefonia
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Planes De Telefonia</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarPlanTelefonia">
            Agregar Plan Telefonia
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara TdataTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>								
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
								$plan_telefonia = ControladorPlanTelefonias::ctrMostrarPlanTelefonias($item,$valor);
								// Probando mostrando lo que contiene la variable "$plan_telefonias"
								// var_dump($telefonias);
								foreach ($plan_telefonia as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap" <td class="text-uppercase"> -->
													<td>'.$value["nombre"].'</td>							
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditarPlanTelefonia" para activar una ventana modal -->
															<!-- "btnEditarPlanTelefonia" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarPlanTelefonia" idPlanTelefonia="'.$value["id_plan_tel"].'" data-toggle="modal" data-target="#modalEditarPlanTelefonia"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarPlanTelefonia, idPlanTelefonia="'.$value["id_plan_tel"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarPlanTelefonia" idPlanTelefonia="'.$value["id_plan_tel"].'"><i class="fa fa-times"></i></button>';
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
Cuando el usuario oprima el boton de "Agregar Telefonia" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarPlanTelefonia" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Plan De Telefonica</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoPlanTelefonia" placeholder = "Ingresar Plan De Telefonica" id="nuevoPlanTelefonia" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Plan Telefonia</button>
          </div>

					<?php 
						// Para grabar el Plan Telefonia 
						$crearPlanTelefonia = new ControladorPlanTelefonias();
						$crearPlanTelefonia->ctrCrearPlanTelefonia();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarTelefonia" class="modal fade" role="dialog"> --> 


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Plan Telefonia" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Plan Telefonia 
	====================================================
-->
<div id="modalEditarPlanTelefonia" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Plan De Telefonia</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarPlanTelefonia"  id="editarPlanTelefonia" required>
								<!-- Se envía como campo oculto para enviar el "id" del Plan De Telefonia -->
								<input type="hidden"  name="idPlanTelefonia"  id="idPlanTelefonia" required>
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
						// Para grabar la modifiacion de Almacen.
						$editarPlanTelefonia = new ControladorPlanTelefonias();
						$editarPlanTelefonia->ctrEditarPlanTelefonia();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarPlanTelefonia" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar Plan De Telefonia
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarPlanTelefonia = new ControladorPlanTelefonias();
	$borrarPlanTelefonia->ctrBorrarPlanTelefonia();
?>
