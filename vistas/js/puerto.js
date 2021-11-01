// =======================================
// Editar Puerto:
// ======================================
$(".btnEditarPuerto").click(function(){
	// Se obtiene el valor de "idPuerto"
	var idPuerto = $(this).attr("idPuerto");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPuerto",idPuerto); // Se crea la variable "POST", "idPuerto"

	$.ajax({
		url:"ajax/puerto.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarMarca" class="modal fade" role="dialog">, "puerto.php", se le asigna el valor que se retorno el Ajax.
			$("#editarPuerto").val(respuesta["descripcion"]);
			$("#idPuerto").val(respuesta["id_puerto"]); // viene desde el campo oculto de <input type="hidden"  name="idPuerto"  id="idPuerto" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarPuerto")


// Revisando que la "puerto" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPuerto" id="nuevoPuerto" placeholder = "Ingresar un Puerto" required>
$("#nuevoPuerto").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPuerto.
	var puerto = $(this).val();
	
	//console.log("Puerto",puerto);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarPuerto",puerto);
	$.ajax({
		url:"ajax/puerto.ajax.php",
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
				$("#nuevoPuerto").parent().after('<div class="alert alert-warning" >Este Puerto Existe </div>');
				$("#nuevoPuerto").val("");
			}

		}
	})
 
}) // $("#nuevoPuerto").change(function(){

//=======================================================
// Eliminar Puerto.
//=======================================================
// $(".btnEliminarPuerto").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarPuerto", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarPuerto",function()
	{	

		// Obteniendo los valores de "idPuerto"
		var idPuerto = $(this).attr("idPuerto");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Puerto",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Puerto'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=puerto&idPuerto="+idPuerto;
			}
		})	

}) // $(".btnEliminarPuerto").click(function(){

