// =======================================
// Editar Patch Panel:
// ======================================
$(".btnEditarPatchPanel").click(function(){
	// Se obtiene el valor de "idPatchPanel"
	var idPatchPanel = $(this).attr("idPatchPanel");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPatchPanel",idPatchPanel); // Se crea la variable "POST", "idPatchPanel"

	$.ajax({
		url:"ajax/patchpanel.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarPatchPanel" class="modal fade" role="dialog">, "patchpanel.php", se le asigna el valor que se retorno el Ajax.
			$("#editarPatchPanel").val(respuesta["descripcion"]);
			$("#idPatchPanel").val(respuesta["id_patch_panel"]); // viene desde el campo oculto de <input type="hidden"  name="idPatchPanel"  id="idPatchPanel" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarPatchPanel")


// Revisando que el "Patch Panel" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPatchPanel" id="nuevoPatchPanel" placeholder = "Ingresar un Patch Panel" required>
$("#nuevoPatchPanel").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPatchPanel.
	var PatchPanel = $(this).val();
	
	//console.log("Patch Panel",PatchPanel);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarPatchPanel",PatchPanel);
	$.ajax({
		url:"ajax/patchpanel.ajax.php",
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
				$("#nuevoPatchPanel").parent().after('<div class="alert alert-warning" >Patch Panel Existente</div>');
				$("#nuevoPatchPanel").val("");
			}

		}
	})
 
}) // $("#nuevoPatchPanel").change(function(){

//=======================================================
// Eliminar Patch Panel.
//=======================================================
// $(".btnEliminarPatchPanel").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarPatchPanel", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarPatchPanel",function()
	{	

		// Obteniendo los valores de "idPatchPanel"
		var idPatchPanel = $(this).attr("idPatchPanel");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Patch Panel",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Patch Panel'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=patchpanel&idPatchPanel="+idPatchPanel;
			}
		})	

}) // $(".btnEliminarPatchPanel").click(function(){

