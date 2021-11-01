/* Cargar los datos - Empleados de forma dinamica
	formatos de JSon.

*/

/*
// Se puede utilizar para verificar en caso de error.

$.ajax({		
	url:"ajax/datatable-empleados.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})

*/
/* 
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  Estos tres parametros son para optimizar el DataTable.
*/
var perfilOculto = $("#perfilOculto").val();

$('.tablaEmpleados').DataTable({
	"ajax":"ajax/datatable-empleados.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  "language":{ 
    "sProcessing": "Procesando ...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros",
    "sInfoPostFix": "",
    "sSearch": "Buscar",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando ...",
    "oPaginate":{
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",
		},
		"oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
	}

});





/*
// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);

// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaEmpleados').DataTable({
	"ajax":"ajax/datatable-empleados.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  "language":{ 
    "sProcessing": "Procesando ...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros",
    "sInfoPostFix": "",
    "sSearch": "Buscar",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando ...",
    "oPaginate":{
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",
		},
		"oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
	}

});
*/


// Aplicando expresiones regulares para validar campos del formulario
function validarCampoEmp(campoValid,queCampo,Editar)
{
	$(".alert").remove();
	
	switch (queCampo)
	{
		case ('NT_ID'):
			cadenaComparar = "^[A-Z0-9]";
			Editar == 'S'?etiqueta = "#editar_ntid":etiqueta = "#nuevo_ntid";
			break;
		case ('Correo_Elect'):
			cadenaComparar = "^[a-zA-Z0-9_@.]";
			Editar == 'S'?etiqueta = "#editarCorreoElect":etiqueta = "#nuevoCorreoElect";
			break;	
	}

	let expresionreg = new RegExp(cadenaComparar);
	if (!expresionreg.test(campoValid))
	{
		//console.log("Valor ",expreg.test(campoValid));
		$(etiqueta).parent().after('<div class="alert alert-warning" >NO Cumple la condicion</div>');
		//$("#nuevoSerial").val("");		
	}

} // function validarCampoEmp(campoValid,queCampo,Editar)



// Se agrega el código para obtener el último número del codigo a utilizar
$("#nuevaCategoria").change(function(){
	
	// Obtener el último de "codigo" desde la tabla "productos"
	var idCategoria = $(this).val();
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta",respuesta);
			// Para el caso de que no exista una categoria en la tabla de "t_Productos".
			if (!respuesta)
			{
				// No Categoria mas 01 para completar el numero, ejemplo 9 + 01 = 901
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			else
			{
				// Se obtiene el código de la tabla de "t_Productos"
				var nuevoCodigo = Number(respuesta["codigo"])+1;
				//console.log("respuesta",nuevoCodigo);
				// Se asigna a la etiqueta "codigo" de la vista Captura de Productos.
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			

		}
	})
})


// Se agrega la foto del Empleado, viene desde el formulario de captura (vistas/modulos/empleados.php)
$(".nuevaImagen").change(function(){

	// propiedad de la etiqueta "File" de JavaScript, obtiene la imagen en el indice 0
	var imagen = this.files[0]; 
  //console.log("imagen",imagen);

  // Validando que el formato de la imagen sea JPE o PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})

// Editar Empleado
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cunado se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarEmpleado" la siguiente "function"
$(".tablaEmpleados tbody").on("click","button.btnEditarEmpleado",function(){
	// "idEmpleados" viene desde el archivo : "datatable-empleados.ajax.php -> $botones"
	var idEmpleado = $(this).attr("idEmpleado");
	//console.log("idEmpleado",idEmpleado);
	
	
	// Se utilizara Ajax para obtener la información del empleados desde la base de datos.
	// Se esta agregando un dato al Ajax.
	var datos = new FormData();
	datos.append("idEmpleado",idEmpleado);
	$.ajax
	({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta Editar Empleado desde el boton Editar ",respuesta);
			
			// Obtener el Puesto, la descripcion					
			var datosPuesto = new FormData();

			// respuesta["id_puesto"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosPuesto" = es una variable POST que se envia a "puesto.ajax.php".
			datosPuesto.append("idPuesto",respuesta["id_puesto"]);
			$.ajax
			({
				url:"ajax/puestos.ajax.php",
				method:"POST",
				data:datosPuesto,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(puesto)
				{
					console.log("respuesta",puesto);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarPuesto").val(puesto["id_puesto"]);
					$("#editarPuesto").html(puesto["descripcion"]);		
				}
		
			})

			// Obtener el Depto, la descripcion					
			var datosDepto = new FormData();

			// respuesta["id_depto"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosDepto" = es una variable POST que se envia a "deptos.ajax.php".
			datosDepto.append("idDepto",respuesta["id_depto"]);
			$.ajax
			({
				url:"ajax/deptos.ajax.php",
				method:"POST",
				data:datosDepto,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(depto)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarDepto").val(depto["id_depto"]);
					$("#editarDepto").html(depto["descripcion"]);		
				}
		
			})

			// Obtener el Supervisor, la descripcion					
			var datosSupervisor = new FormData();

			// respuesta["id_supervisor"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosSupervisor" = es una variable POST que se envia a "supervisores.ajax.php".
			datosSupervisor.append("idSupervisor",respuesta["id_supervisor"]);
			$.ajax
			({
				url:"ajax/supervisores.ajax.php",
				method:"POST",
				data:datosSupervisor,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(supervisor)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarSupervisor").val(supervisor["id_supervisor"]);
					$("#editarSupervisor").html(supervisor["descripcion"]);		
				}
		
			})

			// Obtener la Ubicacion, la descripcion					
			var datosUbicacion = new FormData();

			// respuesta["id_ubicacion"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosSupervisor" = es una variable POST que se envia a "ubicaciones.ajax.php".
			datosUbicacion.append("idUbicacion",respuesta["id_ubicacion"]);
			$.ajax
			({
				url:"ajax/ubicaciones.ajax.php",
				method:"POST",
				data:datosUbicacion,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(ubicacion)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarUbicacion").val(ubicacion["id_ubicacion"]);
					$("#editarUbicacion").html(ubicacion["descripcion"]);		
				}
		
			})

			// Obtener el Centro De Costos					
			var datosCentro_Costos = new FormData();

			// respuesta["id_centro_costos"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosCentro_Costos" = es una variable POST que se envia a "ubicaciones.ajax.php".
			datosCentro_Costos.append("idCentro_Costos",respuesta["id_centro_costos"]);
			$.ajax
			({
				url:"ajax/centro-costos.ajax.php",
				method:"POST",
				data:datosCentro_Costos,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(Centro_Costos)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarCentro_Costos").val(Centro_Costos["id_centro_costos"]);
					$("#editarCentro_Costos").html(Centro_Costos["num_centro_costos"]);		
				}
		
			})
			
			
			// Asignando los campos restantes 
			//console.log("respuesta Editar Empleado desde el boton Editar ",respuesta);
			$("#id_empleado").val(respuesta["id_empleado"]);
			$("#editar_ntid").val(respuesta["ntid"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellidos"]);
			$("#editarCorreoElect").val(respuesta["correo_electronico"]);

			if (respuesta["foto"] != "")
			{
				$("#imagenActual").val(respuesta["foto"]);
				$(".previsualizar").attr("src",respuesta["foto"]);
			}
			// console.log("id_Empleado javaScript ",respuesta["id_empleado"]);

		} // success:function(respuesta) 

	});

}) // $(".tablaEmpleados tbody").on("click","button.btnEditarEmpleado",function(){


// Borrar Empleado
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaEmpleados tbody").on("click","button.btnEliminarEmpleado",function(){
	var idEmpleado = $(this).attr("idEmpleado");
	//console.log("idEmpleado",idEmpleado);

    // Obtener el NtId del "empleado" y la ruta de la imagen que esta grabada en la Tabla.
	var apellidos = $(this).attr("apellidos");
	var imagen = $(this).attr("imagen");

	
	Swal.fire ({
	    title: "Esta seguro de Borrar el Empleado ",
		text : "De lo contrario puede cancelar la Acción ",
		type:'warning',
		showCancelButton:true,		
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText:'Si Para Borrar',
		closeOnConfirm: false
		}).then(function(result){
			if (result.value)
			{
				window.location="index.php?ruta=empleados&idEmpleado="+idEmpleado+"&imagen="+imagen+"&apellidos="+apellidos;
			}

			});	

})

$("#nuevo_ntid").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

$("#editar_ntid").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el "NTID" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevo_ntid" id="nuevo_ntid" placeholder = "Ingresar el NT Id del Usuario" required>
$("#nuevo_ntid").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevo_ntid.
	let nt_id = $(this).val();
	
	//let Editar = 'N';
	//validarCampoEmp(nt_id,'NT_ID',Editar);

	//console.log("NT Id",nt_id);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validaNtid",nt_id);
	$.ajax({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevo_ntid").parent().after('<div class="alert alert-warning" >Este NTID Existe !! </div>');
				$("#nuevo_ntid").val("");
			}

		}
	})
 
}) // $("#nuevo_ntid").change(function(){


// Valida los caracteres del correo electronico.
	$("#nuevoCorreoElect").bind('keypress', function(event) {
		var regex = new RegExp("^[A-Za-z0-9@_.]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	});

// Valida los caracteres del correo electronico.
$("#editarCorreoElect").bind('keypress', function(event) {
	var regex = new RegExp("^[A-Za-z0-9@_.]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});

	
// Revisando que el "Correo Electronico" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoCorreoElect" id="nuevoCorreoElect" placeholder = "Ingresar el Correo Electronico" required>
$("#nuevoCorreoElect").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevo_ntid.
	let correo_elect = $(this).val();
	
	let Editar = 'N';
	//validarCampoEmp(correo_elect,'Correo_Elect',Editar);

	//console.log("NT Id",nt_id);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validaCorreoElect",correo_elect);
	$.ajax({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevoCorreoElect").parent().after('<div class="alert alert-warning" >Ya existe el Correo Electronico !! </div>');
				$("#nuevoCorreoElect").val("");
			}

		}
	})
 
}) // $("#nuevoCorreoElect").change(function(){

// Revisando que el "Correo Electronico" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoCorreoElect" id="nuevoCorreoElect" placeholder = "Ingresar el Correo Electronico" required>
$("#editarCorreoElect").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevo_ntid.
	let correo_elect = $(this).val();
	
	//let Editar = 'N';
	//validarCampoEmp(correo_elect,'Correo_Elect',Editar);

	//console.log("NT Id",nt_id);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validaCorreoElect",correo_elect);
	$.ajax({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#editarCorreoElect").parent().after('<div class="alert alert-warning" >Ya existe el Correo Electronico !! </div>');
				$("#editarCorreoElect").val("");
			}

		}
	})
 
}) // $("#nuevoCorreoElect").change(function(){

// Valida los caracteres del Nombre.
$("#nuevoNombre").bind('keypress', function(event) {
	var regex = new RegExp("^[A-Za-z ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});

// Valida los caracteres permitidos para Nombre.
$("#editarNombre").bind('keypress', function(event) {
	var regex = new RegExp("^[A-Za-z ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});

// Valida los caracteres de los Apellidos.
$("#nuevoApellido").bind('keypress', function(event) {
	var regex = new RegExp("^[A-Za-z ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});

// Valida los caracteres de los Apellidos.
$("#editarApellido").bind('keypress', function(event) {
	var regex = new RegExp("^[A-Za-z ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});


// ================================================================================
// Subir los documentos de los empleados
// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cunado se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarEmpleado" la siguiente "function"
$(".tablaEmpleados tbody").on("click","button.btnSubirArchivos",function(){
	// "idEmpleados" viene desde el archivo : "datatable-empleados.ajax.php -> $botones"
	var idEmpleado = $(this).attr("id_Ntid");
	// console.log("idEmpleado",idEmpleado);
	window.open("vistas/modulos/subir_resp.php?Ntid_Emp="+idEmpleado,"_blank");	
	
	});

	// Para buscar los puestos desde una etiqueta Input, de la captura de Empleados.
	function buscar_puesto(nombre_puesto)
	{
		$.ajax({
			url:'ajax/buscar_puestos.php',
			type:'POST',
			dataType:'html',
			data:{buscar:nombre_puesto},
		})
		.done (function(respuesta){
			// Agrega los puestos encontrados en el Div "tablaPuestos"
			$("#tablaPuestos").html(respuesta);
			if ($("#tablaPuestos").html() == "No hay Datos")
			{
				// Para que cuando graben no lo permita hasta que tenga un Modelo válido.
				$("#nuevo_Puesto").val(null)
			}
			//console.log($("#nuevo_modelo").val());

		})
		.fail(function(){
			//$("#tablaPuestos").html ("<p>Puesto NO encontrado</p>");
		})
	}

	// Evento donde oprimen la tecla en la etiqueta "nuevo_Puesto"
	$(document).on('keyup','#nuevo_Puesto',function()
	{
		let valor = $(this).val();
		if (valor != "")
		{
			//console.log("Teclas Oprimidas : ",valor);
			buscar_puesto(valor);
		}
		else{
			$(".tablas").hide();
		}	
	
	})

	// Cuando se oprime el boton para obtener el id_puesto del Input
	$(document).on("click",".btnSeleccPuesto",function(){	
	/* <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id "] .'" data-toggle="modal"  */
	var ObtenerIdPuesto =$(this).attr("idPuestoSelecc");
	//console.log("El Id del Puesto : ",ObtenerIdPuesto);

	//console.log("id_Puesto",idPuesto);
	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPuesto",ObtenerIdPuesto); // Se crea la variable "POST", "idPuesto"

	$.ajax({
		url:"ajax/puestos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarPuesto" class="modal fade" role="dialog">, "puestos.php", se le asigna el valor que se retorno el Ajax.
			$("#nuevo_Puesto").val(respuesta["descripcion"]);
		}	

	}); // $.ajax({ ......

		$("#nuevoPuesto").val(parseInt(ObtenerIdPuesto));
		$(".tablas").hide();
		$("#nuevoDepto").focus();
	});


	// Buscar un Centro De Costos, a tráves del campo "Input"
		// Evento donde oprimen la tecla en la etiqueta "nuevo_CC"
		$(document).on('keyup','#nuevo_CC',function()
		{
			let valor = $(this).val();
			if (valor != "")
			{
				//console.log("Teclas Oprimidas : ",valor);
				buscar_centroCostos(valor);
			}
			else{
				$(".tablas").hide();
			}
		
		})
	
		// Para buscar el Centro De Costos dessde una etiqueta Input, de la captura de Empleados.
	function buscar_centroCostos(centro_costos)
	{
		$.ajax({
			url:'ajax/buscar_cc.ajax.php',
			type:'POST',
			dataType:'html',
			data:{buscar:centro_costos},
		})
		.done (function(respuesta){
			// Agrega los centros de costos encontrados en el Div "tablaPuestos"
			$("#tablaCC").html(respuesta);
			//$("#nuevo_modelo").html(respuesta);
			//texto = $("#tablaModelo").html();
			
			if ($("#tablaCC").html() == "No hay Datos")
			{
				// Para que cuando graben no lo permita hasta que tenga un Modelo válido.
				$("#nuevo_CC").val(null)
			}
			//console.log($("#nuevo_modelo").val());

		})
		.fail(function(){
			//$("#tablaPuestos").html ("<p>Puesto NO encontrado</p>");
		})
	}

	// Cuando se oprime el boton para obtener el "id" Centro Costos del Input
	$(document).on("click",".btnSeleccCC",function(){	
		/* <button class="btn btn-warning btnSeleccCC" idCCSelecc="'.$value["id_centro_costos "] .'" data-toggle="modal"  */
		var ObtenerIdCC =$(this).attr("idCCSelecc");
		//console.log("El Id del Centro De Costos : ",ObtenerIdCC);
	
		//console.log("id_Puesto",idPuesto);
		// Para agregar datos 
		var datos = new FormData();
		datos.append("idCentro_Costos",ObtenerIdCC); // Se crea la variable "POST", "idCC"
	
		$.ajax({
			url:"ajax/centro-costos.ajax.php",
			method:"POST",
			data:datos,
			cache:false,
			contentType:false,	
			processData:false,
			dataType:"json",
			success:function(respuesta){
				//console.log("respuesta",respuesta);
				// Viene desde : <div id="modalEditarPuesto" class="modal fade" role="dialog">, "puestos.php", se le asigna el valor que se retorno el Ajax.
				$("#nuevo_CC").val(respuesta["num_centro_costos"]);
			}	
	
		}); // $.ajax({ ......
	
			$("#nuevoCentro_Costos").val(parseInt(ObtenerIdCC));
			$(".tablas").hide();
			$("#nuevaImagen").focus();
		});
	