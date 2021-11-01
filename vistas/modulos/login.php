<!-- Se coloca una imagen de fondo en la pantalla del "Login", en el archivo "bower_componente/dis/css/AdminLTE.css"-->
<div id="back"  ></div>

<div class="login-box">
  <div class="login-logo">
    <img src="vistas/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding:30pxs 100px 0px 100px">

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar Al Sistema</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name = "ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- Para dispositivo moviles. -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
			<?php 
				// Valida si el usuario se encuentra en la base de datos.
        $login = new ControladorUsuarios();
        $login->ctrIngresoUsuario();

      ?>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
