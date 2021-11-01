var perfilOculto = $("#perfilOculto").val();

$('.tablaModelos').DataTable({
	"ajax":"ajax/datatable-modelos.ajax.php?perfilOculto="+perfilOculto,
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

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoModelo").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9-/ ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarModelo").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9-/ ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


// =======================================
// Editar Modelos:
// ======================================

// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarModelos" la siguiente "function"

$(".tablaModelos tbody").on("click","button.btnEditarModelo",function(){
	// Se obtiene el valor de "idModelo"
	var idModelo = $(this).attr("idModelo");
	//console.log("Id Modelo : ",idModelo);

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idModelo",idModelo); // Se crea la variable "POST", "idModelo"

	// Asigna los valores a la pantalla, para cuando se edita el modelo
	$.ajax({
		url:"ajax/modelos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarModelo" class="modal fade" role="dialog">, "modelos.php", se le asigna el valor que se retorno el Ajax.
			$("#editarModelo").val(respuesta["descripcion"]);
			$("#idModelo").val(respuesta["id_modelo"]); // viene desde el campo oculto de <input type="hidden"  name="idModelo"  id="idModelo" required>
		}

	}); // $.ajax({ ......


}) // $(":btnEditarModelo")


// Revisando que la "modelo" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo" placeholder = "Ingresar un Modelo" required>
$("#nuevoModelo").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoModelo.
	var modelo = $(this).val();
	
	//console.log("descripcion",modelo);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarModelo",modelo);
	$.ajax({
		url:"ajax/modelos.ajax.php",
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
				$("#nuevoModelo").parent().after('<div class="alert alert-warning" >Esta Modelo Existe </div>');
				$("#nuevoModelo").val("");
			}

		}
	})
 
}) // $("#nuevoModelo").change(function(){

// Revisando que el "modelo" no este repetido, cuando se edita.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo" placeholder = "Ingresar un Modelo" required>
$("#editarModelo").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoModelo.
	var modelo = $(this).val();
	
	//console.log("descripcion",modelo);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarModelo",modelo);
	$.ajax({
		url:"ajax/modelos.ajax.php",
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
				$("#editarModelo").parent().after('<div class="alert alert-warning" >Esta Modelo Existe </div>');
				$("#editarModelo").val("");
			}

		}
	})
 
}) // $("#nuevoModelo").change(function(){

//=======================================================
// Eliminar Modelo.
//=======================================================
// $(".btnEliminarModelo").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarModelo", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarModelo",function()
	{	
		// Obteniendo los valores de "idModelo"
		var idModelo = $(this).attr("idModelo");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Modelo",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Modelo'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=Modelos&idModelo="+idModelo;
			}
		})	

}) // $(".btnEliminarModelo").click(function(){

