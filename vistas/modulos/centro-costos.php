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
        Administrar Centro De Costos
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fas-donate"></i> Inicio</a></li>
        <li class="active">Administrar Centro De Costos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarCentro_Costos">
            Agregar Centro Costos
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
                <th>Num. Centro Costos</th>
								<th>Descripcion</th>								
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
								$centro_costos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
								// Probando mostrando lo que contiene la variable "$centro_costos"
								// var_dump($centro_costos);
								foreach ($centro_costos as $key => $value)
								{
									echo '
												<tr>
													<!-- Se incrementa en 1, ya que los arreglos comienzan desde 0-->
													<td>'.($key+1).'</td>
													<!-- Para mostrar todas las palabras en mayusculas, utilizando clases de "Bootstrap" <td class="text-uppercase"> -->
													<td>'.$value["num_centro_costos"].'</td>		<td >'.$value["descripcion"].'</td>							
													<td>
														<div class="btn-group">
															<!-- data-toggle="modal" data-target="#modalEditarCentro_Costo" para activar una ventana modal -->
															<!-- "btnEditarCentro_Costo" = Para utilizar JavaScript para conectarse a la base de datos.-->
															<button class="btn btn-warning btnEditarCentro_Costos" idCentro_Costos="'.$value["id_centro_costos"].'" data-toggle="modal" data-target="#modalEditarCentro_Costos"><i class="fa fa-pencil"></i></button>';
															if ($_SESSION["perfil"] == "Administrador")
															{
																echo '<!-- Se pasa btnEliminarCentro_Costos, idCentro_Costos="'.$value["id_centro_costos"].'" para utilizarlo con Ajax, como variable GET en la URL -->
															<button class="btn btn-danger btnEliminarCentro_Costos" idCentro_Costos="'.$value["id_centro_costos"].'"><i class="fa fa-times"></i></button>';
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
Cuando el usuario oprima el boton de "Agregar Centro De Costo" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarCentro_Costos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Centro De Costos</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="30" class="form-control input-lg" name="nuevoCentro_Costos" placeholder = "Ingresar Numero Centro De Costo" id="nuevoCentro_Costos" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="80" class="form-control input-lg" name="nuevaDesc_cc" placeholder = "Ingresar Descripcion Centro De Costo" id="nuevaDesc_cc" required>
              </div> <!-- <div class = "input-group"> -->  

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Centro Costos</button>
          </div>

					<?php 
						// Para grabar el Centro De Costos.
						$crearCentro_Costos = new ControladorCentro_Costos();
						$crearCentro_Costos->ctrCrearCentro_Costos();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarEdo_Epo -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Centro De Costos" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Centro De Costos 
	====================================================
-->
<div id="modalEditarCentro_Costos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Centros De Costos</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="30" class="form-control input-lg" name="editarCentro_Costos"  id="editarCentro_Costos" required>
								<!-- Se envía como campo oculto para enviar el "id" del Centro Centros -->
								<input type="hidden"  name="idCentro_Costos"  id="idCentro_Costos" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarDesc_cc"  id="editarDesc_cc" required>

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
						// Para grabar la modifiacion del Centro De Costos.
						$editarCentro_Costos = new ControladorCentro_Costos();
						$editarCentro_Costos->ctrEditarCentro_Costos();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarCentro_Costos" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar un Centro De Costo.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarCentro_Costos = new ControladorCentro_Costos();
	$borrarCentro_Costos->ctrBorrarCentro_Costos();
?>


