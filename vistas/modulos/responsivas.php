  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Responsivas
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Responsiva</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
				<!-- Se coloca un enlace para abrir la ventana de "Crear Responsiva" -->				
					<a href="cap-responsiva">

					<!-- NO se utilizan ventanas de tipo modal por lo que se tiene que suprimir : data-toggle= "modal" data-target="#modalAgregarProducto", se utilizara una ventana normal exclusiva para la captura de Responsiva-->
						<button class="btn btn-primary" >
							Agregar Responsiva
						</button>       
					</a>

        </div>
 
        <div class="box-body">

					<!-- Es la tabla donde se mostrara los datos iniciales para la Venta. -->
          <table class="table table-bordered table-striped dt-responsive tablaResponsivas" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Num Resp.</th>
								<th># Empleado</th>
								<th>Apellidos</th>
								<th>Modalidad</th>
								<th>Fecha Asignado</th>								
								<th>Fecha Devolucion</th>
                <th>Acciones </th>								
              </tr>
            </thead>
						
            <!-- Cuerpo de la Tabla -->
            <!-- <tbody> -->
							<!-- Se va ha utilizar el quemado de datos en el HTML, dado el volumen de los datos, pero se puede arreglar para que se utilize el "TDataTable"-->
						

							<?php 
							/*
								// Para mostrar los datos en pantalla.
								$item = null;
								$valor = null;
								$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
								// var_dump ($clientes);
								foreach ($clientes as $key => $value)
								{
									echo ' 
										<tr>
											<td>'.($key+1).'</td>
											<td>'.$value["nombre"].'</td>
											<td>'.$value["documento"].'</td>
											<td>'.$value["email"].'</td>
											<td>'.$value["telefono"].'</td>
											<td>'.$value["direccion"].'</td>
											<td>'.$value["fecha_nacimiento"].'</td>
											<td>'.$value["compras"].'</td>
											<td>0000-00-00 00:00:00</td>
											<td>'.$value["fecha"].'</td>
			
											<td>
												<div class="btn-group">
													<button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>
												</div>
											</td>
										</tr>	';
								}
								*/

							?>
             
            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped"> -->
					
					<input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

					<!-- Para que se pueda mostrar arriba de la tabla -->
					<?php 
						$eliminarResponsiva = new ControladorResponsivas();
						$eliminarResponsiva->ctrEliminarResponsiva();
						
					?>

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


