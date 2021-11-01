
// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoEdo_Epo").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarEdo_Epo").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// =======================================
// Editar Estado De Equipo:
// ======================================
$(".btnEditarEdo_Epo").click(function(){
	// Se obtiene el valor de "idEdo_Epo"
	var idEdo_Epo = $(this).attr("idEdo_Epo");

	//console.log("idEdo_Epo",idEdo_Epo);

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idEdo_Epo",idEdo_Epo); // Se crea la variable "POST", "idEdo_Epo"

	$.ajax({
		url:"ajax/edo-epo-ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarEdo_Epo" class="modal fade" role="dialog">, "edo_epo.php", se le asigna el valor que se retorno el Ajax.
			$("#editarEdo_Epo").val(respuesta["descripcion"]);
			$("#idEdo_Epo").val(respuesta["id_edo_epo"]); // viene desde el campo oculto de <input type="hidden"  name="idEdo_Epo"  id="idEdo_Epo" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarEdo_Epo")


// Revisando que la "Estado Del Equipo" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoEdo_Epo" id="nuevoEdo_Epo" placeholder = "Ingresar un Estado de Equipo" required>
$("#nuevoEdo_Epo").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoEdo_Epo.
	var edo_epo = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarEdo_Epo",edo_epo);
	$.ajax({
		url:"ajax/edo-epo-ajax.php",
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
				$("#nuevoEdo_Epo").parent().after('<div class="alert alert-warning" >Este Estado Equipo Existe </div>');
				$("#nuevoEdo_Epo").val("");
			}

		}
	})
 
}) // $("#nuevoEdo_Epo").change(function(){


// Revisando que la "Estado Del Equipo" no este repetido, cuando se edite "Estado Equipo"
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoEdo_Epo" id="nuevoEdo_Epo" placeholder = "Ingresar un Estado de Equipo" required>
$("#editarEdo_Epo").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoEdo_Epo.
	var edo_epo = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarEdo_Epo",edo_epo);
	$.ajax({
		url:"ajax/edo-epo-ajax.php",
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
				$("#editarEdo_Epo").parent().after('<div class="alert alert-warning" >Este Estado Equipo Existe </div>');
				$("#editarEdo_Epo").val("");
			}

		}
	})
 
}) // $("#nuevoEdo_Epo").change(function(){

//=======================================================
// Eliminar Estado Del Equipo.
//=======================================================
// $(".btnEliminarEdo_Epo").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarEdo_Epo", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarEdo_Epo",function()
	{	

		// Obteniendo los valores de "idEdo_Epo"
		var idEdo_Epo = $(this).attr("idEdo_Epo");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Estado Del Equipo",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Estado Equipo'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=edo-epo&idEdo_Epo="+idEdo_Epo;
			}
		})	

}) // $(".btnEliminarEdo_Epo").click(function(){

