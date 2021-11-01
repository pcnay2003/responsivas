
var perfilOculto = $("#perfilOculto").val();

$('.tablaUbicaciones').DataTable({
	"ajax":"ajax/datatable-ubicaciones.ajax.php?perfilOculto="+perfilOculto,
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


// =======================================
// Editar Ubicacion:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarUbicacion" la siguiente "function"
$(".tablaUbicaciones tbody").on("click","button.btnEditarUbicacion",function(){ 
	// Se obtiene el valor de "idUbicacion"
	var idUbicacion = $(this).attr("idUbicacion");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idUbicacion",idUbicacion); // Se crea la variable "POST", "idUbicacion"

	$.ajax({
		url:"ajax/ubicaciones.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarUbicacion" class="modal fade" role="dialog">, "ubicaciones.php", se le asigna el valor que se retorno el Ajax.
			$("#editarUbicacion").val(respuesta["descripcion"]);
			$("#idUbicacion").val(respuesta["id_ubicacion"]); // viene desde el campo oculto de <input type="hidden"  name="idUbicacion"  id="idUbicacion" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarUbicacion")


// Revisando que la "ubicacion" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaUbicacion" id="nuevaUbicacion" placeholder = "Ingresar la Ubicacion" required>
$("#nuevaUbicacion").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaUbicacion.
	var ubicacion = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarUbicacion",ubicacion);
	$.ajax({
		url:"ajax/ubicaciones.ajax.php",
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
				$("#nuevaUbicacion").parent().after('<div class="alert alert-warning" >Ubicacion Existe </div>');
				$("#nuevaUbicacion").val("");
			}

		}
	})
 
}) // $("#nuevaUbicacion").change(function(){

//=======================================================
// Eliminar Ubicacion.
//=======================================================
// $(".btnEliminarUbicacion").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarUbicacion", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarUbicacion",function()
	{	

		// Obteniendo los valores de "idUbicacion"
		var idUbicacion = $(this).attr("idUbicacion");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Ubicacion",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Ubicacion'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=ubicaciones&idUbicacion="+idUbicacion;
			}
		})	

}) // $(".btnEliminarUbicacion").click(function(){

// Validar los caracteres permitidos 
// Validar la entrada.

$("#nuevaUbicacion").bind('keypress', function(event) {
	var regex = new RegExp("^[0-9A-Za-z- ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarUbicacion").bind('keypress', function(event) {
var regex = new RegExp("^[0-9A-Za-z- ]+$");
var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
if (!regex.test(key)) {
	event.preventDefault();
	return false;
}
});
