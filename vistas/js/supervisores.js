// =======================================
// Editar Supervisores:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarSupervisor" la siguiente "function"
// Se tiene que escribir de esta manera, de lo contrario cuando se este navengando no obtiene los datos a editar.
$(".tablas tbody").on("click","button.btnEditarSupervisor",function(){
	// Se obtiene el valor de "idSupervisor"
	var idSupervisor = $(this).attr("idSupervisor");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idSupervisor",idSupervisor); // Se crea la variable "POST", "idSupervisor"

	$.ajax({
		url:"ajax/supervisores.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarSupervisor" class="modal fade" role="dialog">, "supervisores.php", se le asigna el valor que se retorno el Ajax.
			$("#editarSupervisor").val(respuesta["descripcion"]);
			$("#idSupervisor").val(respuesta["id_supervisor"]); // viene desde el campo oculto de <input type="hidden"  name="idSupervisor"  id="idSupervisor" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarSupervisor")


// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoSupervisor").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-zÑñáéíóú ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que la "Supervisor" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoSupervisor" id="nuevoSupervisor" placeholder = "Ingresar un Supervisor" required>
$("#nuevoSupervisor").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoSupervisor.
	var supervisor = $(this).val();
	
	//console.log("Supervisor",supervisor);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarSupervisor",supervisor);
	$.ajax({
		url:"ajax/supervisores.ajax.php",
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
				$("#nuevoSupervisor").parent().after('<div class="alert alert-warning" >Este Supervisor Existe </div>');
				$("#nuevoSupervisor").val("");
			}

		}
	})
 
}) // $("#nuevoSupervisor").change(function(){

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarSupervisor").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-zÑñáéíóú ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que la "Supervisor" no este repetido, cuando se edita
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarSupervisor" id="editarSupervisor"  required>
$("#editarSupervisor").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoSupervisor.
	var supervisor = $(this).val();
	
	//console.log("Supervisor",supervisor);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarSupervisor",supervisor);
	$.ajax({
		url:"ajax/supervisores.ajax.php",
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
				$("#editarSupervisor").parent().after('<div class="alert alert-warning" >Este Supervisor Existe </div>');
				$("#editarSupervisor").val("");
			}

		}
	})
 
}) // $("#editarSupervisor").change(function(){


//=======================================================
// Eliminar Supervisor.
//=======================================================
// $(".btnEliminarSupervisor").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarSupervisor", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarSupervisor",function()
	{	

		// Obteniendo los valores de "idSupervisor"
		var idSupervisor = $(this).attr("idSupervisor");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Supervisor",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Supervisor'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=supervisores&idSupervisor="+idSupervisor;
			}
		})	

}) // $(".btnEliminarSupervisor").click(function(){

