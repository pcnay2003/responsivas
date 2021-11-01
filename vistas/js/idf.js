// =======================================
// Editar Idf:
// ======================================
$(".btnEditarIdf").click(function(){
	// Se obtiene el valor de "idIdf"
	var idIdf = $(this).attr("idIdf");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idIdf",idIdf); // Se crea la variable "POST", "idIdf"

	$.ajax({
		url:"ajax/idf.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarIdf" class="modal fade" role="dialog">, "idf.php", se le asigna el valor que se retorno el Ajax.
			$("#editarIdf").val(respuesta["descripcion"]);
			$("#idIdf").val(respuesta["id_idf"]); // viene desde el campo oculto de <input type="hidden"  name="idIdf"  id="idIdf" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarIdf")


// Revisando que la "Idf" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoIdf" id="nuevoIdf" placeholder = "Ingresar el Idf" required>
$("#nuevoIdf").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoIdf.
	var idf = $(this).val();
	
	//console.log("Idf",idf);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarIdf",idf);
	$.ajax({
		url:"ajax/idf.ajax.php",
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
				$("#nuevoIdf").parent().after('<div class="alert alert-warning" >Este IDF Existe </div>');
				$("#nuevoIdf").val("");
			}

		}
	})
 
}) // $("#nuevoIdf").change(function(){

//=======================================================
// Eliminar Idf.
//=======================================================
// $(".btnEliminarIdf").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarIdf", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarIdf",function()
	{	

		// Obteniendo los valores de "idIdf"
		var idIdf = $(this).attr("idIdf");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Idf",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Idf'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=idf&idIdf="+idIdf;
			}
		})	

}) // $(".btnEliminarIdf").click(function(){

