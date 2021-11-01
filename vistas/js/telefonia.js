// =======================================
// Editar Plan Telefonia:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarTelefonia" la siguiente "function"
// Se tiene que escribir de esta manera, de lo contrario cuando se este navengando no obtiene los datos a editar.
$(".tablas tbody").on("click","button.btnEditarTelefonia",function(){
	// Se obtiene el valor de "idTelefonia"
	var idTelefonia = $(this).attr("idTelefonia");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idTelefonia",idTelefonia); // Se crea la variable "POST", "idTelefonia"

	$.ajax({
		url:"ajax/telefonia.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarTelefonia" class="modal fade" role="dialog">, "telefonia.php", se le asigna el valor que se retorno el Ajax.
			$("#editarTelefonia").val(respuesta["nombre"]);
			$("#idTelefonia").val(respuesta["id_telefonia"]); // viene desde el campo oculto de <input type="hidden"  name="idTelefonia"  id="idTelefonia" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarTelefonia")

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevaTelefonia").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el "Telefonia" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaTelefonia" id="nuevaTelefonia" placeholder = "Ingresar una Cia. Telefonica" required>
$("#nuevaTelefonia").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaTelefonia.
	var telefonia = $(this).val();
	
	//console.log("Telefonia",telefonia);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarTelefonia",telefonia);
	$.ajax({
		url:"ajax/telefonia.ajax.php",
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
				$("#nuevaTelefonia").parent().after('<div class="alert alert-warning" >Ya existe la Cia Telefonica</div>');
				$("#nuevaTelefonia").val("");
			}

		}
	})
 
}) // $("#nuevaTelefonia").change(function(){

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarTelefonia").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el "Telefonia" no este repetido, cuando se edita la "Telefonia"
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarTelefonia" id="editarTelefonia" placeholder = "Ingresar una Cia. Telefonica" required>
$("#editarTelefonia").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaTelefonia.
	var telefonia = $(this).val();
	
	//console.log("Telefonia",telefonia);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarTelefonia",telefonia);
	$.ajax({
		url:"ajax/telefonia.ajax.php",
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
				$("#editarTelefonia").parent().after('<div class="alert alert-warning" >Ya existe la Cia Telefonica</div>');
				$("#editarTelefonia").val("");
			}

		}
	})
 
}) // $("#editarTelefonia").change(function(){

//=======================================================
// Eliminar Cia Telefonica.
//=======================================================
// $(".btnEliminarTelefonia").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarTelefonia", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarTelefonia",function()
	{	
		// Obteniendo los valores de "idTelefonia"
		var idTelefonia = $(this).attr("idTelefonia");

		Swal.fire ({
			title: "Esta Seguro(a) De Borrar La Cia Telefonica",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Cia Telefonica'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=telefonia&idTelefonia="+idTelefonia;
			}
		})	

}) // $(".btnEliminarTelefonia").click(function(){

