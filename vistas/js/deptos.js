
// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoDepto").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9-. ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarDepto").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9-. ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


// =======================================
// Editar Deptos:
// ======================================

//$(".btnEditarDepto").click(function(){
	// Se tiene que agrgar esta instrucción ya que de lo contrario cuando se Edite no onbtendra los datos.
	$(".tablas tbody").on("click","button.btnEditarDepto",function(){
	// Se obtiene el valor de "idDepto"
	var idDepto = $(this).attr("idDepto");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idDepto",idDepto); // Se crea la variable "POST", "idDepto"

	$.ajax({
		url:"ajax/deptos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarMarca" class="modal fade" role="dialog">, "marcas.php", se le asigna el valor que se retorno el Ajax.
			$("#editarDepto").val(respuesta["descripcion"]);
			$("#idDepto").val(respuesta["id_depto"]); // viene desde el campo oculto de <input type="hidden"  name="idDepto"  id="idDepto" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarDepto")


// Revisando que la "depto" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoDepto" id="nuevoDepto" placeholder = "Ingresar el Depto" required>
$("#nuevoDepto").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoDepto.
	var depto = $(this).val();
	
	//console.log("Depto",depto);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarDepto",depto);
	$.ajax({
		url:"ajax/deptos.ajax.php",
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
				$("#nuevoDepto").parent().after('<div class="alert alert-warning" >Este Depto Existe </div>');
				$("#nuevoDepto").val("");
			}

		}
	})
 
}) // $("#nuevoDepto").change(function(){

// Revisando que la "depto" no este repetido, cuando se edita.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoDepto" id="nuevoDepto" placeholder = "Ingresar el Depto" required>
$("#editarDepto").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoDepto.
	var depto = $(this).val();
	
	//console.log("Depto",depto);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarDepto",depto);
	$.ajax({
		url:"ajax/deptos.ajax.php",
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
				$("#editarDepto").parent().after('<div class="alert alert-warning" >Este Depto Existe </div>');
				$("#editarDepto").val("");
			}

		}
	})
 
}) // $("#nuevoDepto").change(function(){


//=======================================================
// Eliminar Depto.
//=======================================================
// $(".btnEliminarDepto").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarDepto", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarDepto",function()
	{	

		// Obteniendo los valores de "idDepto"
		var idDepto = $(this).attr("idDepto");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Marca",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Depto'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=deptos&idDepto="+idDepto;
			}
		})	

}) // $(".btnEliminarDepto").click(function(){


$(".tablas").on("draw.dt",function()
{
	//console.log("tabla");
});


