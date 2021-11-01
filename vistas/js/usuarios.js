// Se agrega la foto del usuario., viene desde el formulario de captura (vistas/modulos/usuarios.php)
$(".nuevaFoto").change(function(){
  var imagen = this.files[0]; // propiedad de la etiqueta "File" de JavaScript
	// Solo obtiene los datos de la foto.
	//console.log("imagen",imagen);

	// Validando que el formato de la imagen sea JPE o PNG
	/*
		1 Kbyte -> 1,000 bytes
		1 Mbyte -> 1,000 Kbytes
		1 Gbyte -> 1,000 Mbytes
		1 Tbyte -> 1,000 Gbytes

	*/
	// Valida que la imagen imagen sea "Jpg", "Png"
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaFoto").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaFoto").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
		// Clase para  lectura de archivo
		// Iniciando la carga de imagen 
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})

/* Editar Usuario*/
// Esta modificacion se realiza para cuando se esta utilizando pantallas pequeñas, como celulares, Tablets, 
// Debido a que cuando se carga, muestra unos botones al editar, los campos se muestran vacios debido a que aun no se define ".btnEditarUsuario" , por lo que se define el comportamiento
// $(".btnEditarUsuario").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarUsuario", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
$(document).on("click",".btnEditarUsuario",function(){	
	/* <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id "] .'" data-toggle="modal"  */
	var identifUsuario=$(this).attr("idUsuario");
	// console.log(idUsuario);
	// Obtener los datos desde la base de datos.
	var datos = new FormData();
	// idUsuario = Variable POST
	datos.append("idUsuario",identifUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data: datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta",respuesta);
			// Se asigna el valor que viene de las tablas "t_Usuarios", que se obtienen por Ajax.
			// a las etiquetas de la ventana de "Editar" usuario.
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]); // Es un etiqueta <option>
			$("#editarPerfil").val(respuesta["perfil"]); // Para mantener el valor del perfil, cuando no se cambie.			
			$("#passwordActual").val(respuesta["clave"]);
		
			$("#fotoActual").val(respuesta["foto"]); // Para mantener el valor del perfil, cuando no se cambie.

			if (respuesta["foto"] != "")
			{
				//<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
				 $(".previsualizar").attr("src",respuesta["foto"]);
			}			 

		}

	}); 

})

/* 	ACTIVAR EL USUARIO, 
echo ' <td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0" >Activado</button></td>';
*/

	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnActivar", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  

//$(".btnActivar").click(function(){

$(document).on("click",".btnActivar",function(){		
	// Obtiene los valores de las etiquetas del formulario de Mostrar Usuarios.
	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	// Usando Ajax realizara la actualizacion para la base de datos.
	var datos = new FormData();

	// Estos valores se pasan como parametros POST["activarId"], POST["activarUsuario"]  para "usuarios.ajax.php"
	datos.append("activarId",idUsuario);
	datos.append("activarUsuario",estadoUsuario);

	// Se pasaran estos parámetros POST
	$.ajax
	({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta)
		{
			
			if (window.matchMedia("(max-width:767px)").matches)
			{
				Swal.fire({
					title: "El Usuario ha sido actualizado",					
					type: 'success',
					confirmButtonText: "¡ Cerrar !"
				}).then(function(result){ 
						if (result.value)
						{
							window.location = "usuarios";
						}

					}); // .then(function(result)
					
			}	// if (window.matchMedia("(max-width:767px)").matches)		 

		} // success:function(respuesta)

	}) // $.ajax({

	// Cambiando el color del boton, una vez que se haya actualizado en la base de datos.
	if(estadoUsuario == 0)
	{
		// Se remueve la etiqueta donde le asigna el color, se coloca nuevo texto.
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);
	}
	else
	{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);
	}
})

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoNombre").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z-Ññáéíóú ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarNombre").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z-Ññáéíóú ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el Nombre del usuario no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder = "Ingresar Usuario" required>
$("#nuevoNombre").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();

	// Obtienedo el valor del id=nuevoUsuario.
	var usuario_nom = $(this).val();
	//console.log ("usuario desde la etiqueta ",usuario);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	datos.append("validarUsuario_nom",usuario_nom);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				// "parent" sale del "div" y se coloca fuera del recuadro.
				$("#nuevoNombre").parent().after('<div class="alert alert-warning" >El Nombre Del Usuario Ya Existe </div>');
				$("#nuevoNombre").val("");
			}

		}
	})
 
}); // $("#nuevoNombre").change(function(){

// Revisando que el Nombre del Usuario no este repetido, cuando se edita.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder = "Ingresar Usuario" required>
$("#editarNombre").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();

	// Obtienedo el valor del id=nuevoUsuario.
	var usuario_nom = $(this).val();
	//console.log ("usuario desde la etiqueta ",usuario);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	datos.append("validarUsuario_nom",usuario_nom);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				// "parent" sale del "div" y se coloca fuera del recuadro.
				$("#editarNombre").parent().after('<div class="alert alert-warning" >El Nombre Del Usuario Ya Existe </div>');
				$("#editarNombre").val("");
			}

		}
	})
 
}); // $("#editarNombre").change(function(){

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoUsuario").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarUsuario").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el usuario no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder = "Ingresar Usuario" required>
$("#nuevoUsuario").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();

	// Obtienedo el valor del id=nuevoUsuario.
	var usuario = $(this).val();
	//console.log ("usuario desde la etiqueta ",usuario);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	datos.append("validarUsuario",usuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				// "parent" sale del "div" y se coloca fuera del recuadro.
				$("#nuevoUsuario").parent().after('<div class="alert alert-warning" >Este Usuario Ya Existe </div>');
				$("#nuevoUsuario").val("");
			}

		}
	})
 
})

// Revisando que el usuario no este repetido, cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder = "Ingresar Usuario" required>
$("#editarUsuario").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();

	// Obtienedo el valor del id=nuevoUsuario.
	var usuario = $(this).val();
	//console.log ("usuario desde la etiqueta ",usuario);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	datos.append("validarUsuario",usuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				// "parent" sale del "div" y se coloca fuera del recuadro.
				$("#editarUsuario").parent().after('<div class="alert alert-warning" >Este Usuario Ya Existe </div>');
				$("#editarUsuario").val("");
			}

		}
	})
 
})

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoPassword").bind('keypress', function(event) {	
  var regex = new RegExp("^[A-Za-z0-9*-@+/]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarPassword").bind('keypress', function(event) {	
  let regex = new RegExp("^[A-Za-z0-9*-@+/]+$");
  let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// ================================================
// Eliminar USUARIO.
// =================================================
// $(".btnEliminarUsuario").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarUsuario", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarUsuario",function()
	{	
		// Obteniendo los valores de "idUsuario" y "fotoUsuario", son los capturados desde usuario.php en los registros que se muestran 
		var idUsuario = $(this).attr("idUsuario");
		var fotoUsuario = $(this).attr("fotoUsuario");
		var usuario = $(this).attr("usuario");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Usuario",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar Usuarios'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&foto="+fotoUsuario;
			}
		})	

}) // $(".btnEliminarUsuario").click(function(){

