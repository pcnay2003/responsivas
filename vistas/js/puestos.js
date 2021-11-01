// =======================================
// Editar Puesto:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarModelos" la siguiente "function"


$(".tablas tbody").on("click","button.btnEditarPuesto",function(){
	// Se obtiene el valor de "idPuesto"
	var idPuesto = $(this).attr("idPuesto");
	
	//console.log("id_Puesto",idPuesto);
	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPuesto",idPuesto); // Se crea la variable "POST", "idPuesto"

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
			$("#editarPuesto").val(respuesta["descripcion"]);
			$("#idPuesto").val(respuesta["id_puesto"]); // viene desde el campo oculto de <input type="hidden"  name="idPuesto"  id="idPuesto" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarPuesto")

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoPuesto").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarPuesto").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el "puesto" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPuesto" id="nuevoPuesto" placeholder = "Ingresar un Puesto" required>
$("#nuevoPuesto").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPuesto.
	var puesto = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarPuesto",puesto);
	$.ajax({
		url:"ajax/puestos.ajax.php",
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
				$("#nuevoPuesto").parent().after('<div class="alert alert-warning" >Este Puesto Existe </div>');
				$("#nuevoPuesto").val("");
			}

		}
	})
 
}) // $("#nuevoPuesto").change(function(){

// Revisando que el "puesto" no este repetido, cuando se edita
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPuesto" id="nuevoPuesto" placeholder = "Ingresar un Puesto" required>
$("#editarPuesto").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPuesto.
	var puesto = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarPuesto",puesto);
	$.ajax({
		url:"ajax/puestos.ajax.php",
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
				$("#editarPuesto").parent().after('<div class="alert alert-warning" >Este Puesto Existe </div>');
				$("#editarPuesto").val("");
			}

		}
	})
 
}) // $("#nuevoPuesto").change(function(){

//=======================================================
// Eliminar Puesto.
//=======================================================
// $(".btnEliminarPuesto").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarPuesto", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarPuesto",function()
	{	

		// Obteniendo los valores de "idPuesto"
		var idPuesto = $(this).attr("idPuesto");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Puesto",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Puesto'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=puestos&idPuesto="+idPuesto;
			}
		})	

}) // $(".btnEliminarPuesto").click(function(){

