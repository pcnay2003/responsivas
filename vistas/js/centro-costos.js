// =======================================
// Editar Supervisores:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarCentro_Costos" la siguiente "function"
// Se tiene que escribir de esta manera, de lo contrario cuando se este navengando no obtiene los datos a editar.
$(".tablas tbody").on("click","button.btnEditarCentro_Costos",function(){
	// Se obtiene el valor de "idCentro_Costos"
	var idCentro_Costos = $(this).attr("idCentro_Costos");

	console.log("idCentro_Costos",idCentro_Costos);

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idCentro_Costos",idCentro_Costos); // Se crea la variable "POST", "idCentro_Costos"

	$.ajax({
		url:"ajax/centro-costos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarCentro_Costos" class="modal fade" role="dialog">, "centro-costos.php", se le asigna el valor que se retorno el Ajax.
			$("#editarCentro_Costos").val(respuesta["num_centro_costos"]);
			$("#editarDesc_cc").val(respuesta["descripcion"]);
			$("#idCentro_Costos").val(respuesta["id_centro_costos"]); // viene desde el campo oculto de <input type="hidden"  name="idCentro_Costos"  id="idCentro_Costos" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarCentro_Costos")

// Validar la entrada.
$("#nuevoCentro_Costos").bind('keypress', function(event) {
  var regex = new RegExp("^[0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


$("#nuevaDesc_cc").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9 ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

$("#editarDesc_cc").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9 ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

$("#editarCentro_Costos").bind('keypress', function(event) {
  var regex = new RegExp("^[0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


// Revisando que el "Centro De Costos" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoCentro_Costos" id="nuevoCentro_Costos" placeholder = "Ingresar un Centro de Costos" required>
$("#nuevoCentro_Costos").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoCentro_Costos.
	var centro_costos = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarCentro_Costos",centro_costos);
	$.ajax({
		url:"ajax/centro-costos.ajax.php",
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
				$("#nuevoCentro_Costos").parent().after('<div class="alert alert-warning" >Centro de Costos Existe </div>');
				$("#nuevoCentro_Costos").val("");
			}

		}
	})
 
}) // $("#nuevoCentro_Costos").change(function(){

// Revisando que la descripcion del "Centro De Costos" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarCentro_Costos" id="editarCentro_Costos" 

$("#editarCentro_Costos").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoCentro_Costos.
	var centro_costos = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarCentro_Costos",centro_costos);
	$.ajax({
		url:"ajax/centro-costos.ajax.php",
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
				$("#editarCentro_Costos").parent().after('<div class="alert alert-warning" >El Centro de Costos Existe </div>');
				$("#nuevoCentro_Costos").val("");
			}

		}
	})
 
}) // $("#nuevoCentro_Costos").change(function(){

// Revisando que la descripcion del "Centro De Costos" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarCentro_Costos" id="editarCentro_Costos" 

$("#editarDesc_cc").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=editarDescr_cc.
	var descrip_centro_costos = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarDescripCentro_Costos",descrip_centro_costos);
	$.ajax({
		url:"ajax/centro-costos.ajax.php",
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
				$("#editarDesc_cc").parent().after('<div class="alert alert-warning" >La Descripcion Del Centro de Costos Existe </div>');
				$("#editarDesc_cc").val("");
			}

		}
	})
 
}) // $("#nuevoCentro_Costos").change(function(){

//=======================================================
// Eliminar Centro De Costos.
//=======================================================
// $(".btnEliminarCentro_Costos").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarCentro_Costos", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarCentro_Costos",function()
	{	

		// Obteniendo los valores de "idCentro_Costos"
		var idCentro_Costos = $(this).attr("idCentro_Costos");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Centro De Costos",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Centro De Costos'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=centro-costos&idCentro_Costos="+idCentro_Costos;
			}
		})	

}) // $(".btnEliminarCentro_Costos").click(function(){

