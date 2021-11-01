// =======================================
// Editar Almacenes:
// ======================================
$(".btnEditarAlmacen").click(function(){
	// Se obtiene el valor de "idAlmacen"
	var idAlmacen = $(this).attr("idAlmacen");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idAlmacen",idAlmacen); // Se crea la variable "POST", "idAlmacen"

	$.ajax({
		url:"ajax/almacen.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarAlmacen" class="modal fade" role="dialog">, "almacen.php", se le asigna el valor que se retorno el Ajax.
			$("#editarAlmacen").val(respuesta["nombre"]);
			$("#idAlmacen").val(respuesta["id_almacen"]); // viene desde el campo oculto de <input type="hidden"  name="idAlmacen"  id="idAlmacen" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarAlmacen")


// Validar la entrada.
$("#nuevoAlmacen").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar la entrada.
$("#editarAlmacen").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Revisando que el "Almacen" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoAlmacen" id="nuevoAlmacen" placeholder = "Ingresar un Almacen" required>
$("#nuevoAlmacen").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoAlmacen.
	var almacen = $(this).val();
	
	//console.log("Almacen",modelo);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarAlmacen",almacen);
	$.ajax({
		url:"ajax/almacen.ajax.php",
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
				$("#nuevoAlmacen").parent().after('<div class="alert alert-warning" >Este Almacen Existe </div>');
				$("#nuevoAlmacen").val("");
			}

		}
	})
 
}) // $("#nuevoAlmacen").change(function(){

//=======================================================
// Eliminar Almacen.
//=======================================================
// $(".btnEliminarAlmacen").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarAlmacen", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarAlmacen",function()
	{	

		// Obteniendo los valores de "idAlmacen"
		var idAlmacen = $(this).attr("idAlmacen");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Almacen",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Almacen'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=almacen&idAlmacen="+idAlmacen;
			}
		})	

}) // $(".btnEliminarAlmacen").click(function(){

