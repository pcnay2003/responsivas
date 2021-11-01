
var perfilOculto = $("#perfilOculto").val();

$('.tablaLineas').DataTable({
	"ajax":"ajax/datatable-lineas.ajax.php?perfilOculto="+perfilOculto,
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

	$("#nuevaLineas").bind('keypress', function(event) {
		var regex = new RegExp("^[0-9A-Za-z- ]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	});



// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarLineas").bind('keypress', function(event) {
  var regex = new RegExp("^[0-9A-Za-z- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// =======================================
// Editar Ubicacion:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarLinea" la siguiente "function"
$(".tablaLineas tbody").on("click","button.btnEditarLineas",function(){ 
	// Se obtiene el valor de "idLinea"
	var id_Linea = $(this).attr("idLinea");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idLinea",id_Linea); // Se crea la variable "POST", "idLinea"

	$.ajax({
		url:"ajax/lineas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarMarca" class="modal fade" role="dialog">, "linea.php", se le asigna el valor que se retorno el Ajax.
			$("#editarLineas").val(respuesta["descripcion"]);
			$("#idLinea").val(respuesta["id_linea"]); // viene desde el campo oculto de <input type="hidden"  name="idLinea"  id="idLinea" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarLineas")


// Revisando que la "Linea" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaLinea id="nuevaLinea" placeholder = "Ingresar una Linea" required>
$("#nuevaLineas").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaLinea.
	var linea = $(this).val();
	
	//console.log("Linea",linea);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarLinea",linea);
	$.ajax({
		url:"ajax/lineas.ajax.php",
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
				console.log ("Se encuentra Linea ",respuesta["descripcion"]);
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaLineas").parent().after('<div class="alert alert-warning" >Esta Linea Existe </div>');
				$("#nuevaLineas").val("");
			}

		}
	})
 
}) // $("#nuevaLineas").change(function(){

// Revisando que la "Linea" no este repetido, cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaLineas" id="nuevaLinea" placeholder = "Ingresar una Linea" required>
$("#editarLineas").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaLinea.
	var linea = $(this).val();
	
	//console.log("Linea",linea);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarLinea",linea);
	$.ajax({
		url:"ajax/lineas.ajax.php",
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
				//console.log ("Se encuentra Linea ",respuesta["descripcion"]);
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#editarLineas").parent().after('<div class="alert alert-warning" >Esta Linea Existe </div>');
				$("#editarLineas").val("");
			}

		}
	})
 
}) // $("#editarLinea").change(function(){

//=======================================================
// Eliminar Linea.
//=======================================================
// $(".btnEliminarLinea").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarLinea", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarLineas",function()
	{	
		// Obteniendo los valores de "idLinea"
		var idLinea = $(this).attr("idLinea");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Linea",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Linea'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=linea&idLinea="+idLinea;
			}
		})	

}) // $(".btnEliminarLinea").click(function(){

