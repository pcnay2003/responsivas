/* Cargar los datos - Cintas de forma dinámica
	formatos de JSon.

*/

/*
// Se puede utilizar para verificar en caso de error.

$.ajax({		
	url:"ajax/datatable-cintas.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})

*/
/* 
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  Estos tres parametros son para optimizar el DataTable.
*/
// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();

$('.tablaCintas').DataTable({
	"ajax":"ajax/datatable-cintas.ajax.php?perfilOculto="+perfilOculto,
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

/*
// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);

// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaCintas').DataTable({
	"ajax":"ajax/datatable-cintas.ajax.php?perfilOculto="+perfilOculto,
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
*/

/*
// Se agrega la foto del Empleado, viene desde el formulario de captura (vistas/modulos/empleados.php)
$(".nuevaImagen").change(function(){

	// propiedad de la etiqueta "File" de JavaScript, obtiene la imagen en el indice 0
	var imagen = this.files[0]; 
  //console.log("imagen",imagen);

  // Validando que el formato de la imagen sea JPE o PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})
*/

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nueva_cinta").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editar_num_serial").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


// Revisando que el "Numero de Serie" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nueva_cinta" id="nueva_cinta" placeholder = "Ingresar una Cinta" required>
$("#nueva_cinta").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nueva_cinta.
	var cinta = $(this).val();
	
	//console.log("Num Serie",marca);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarCinta",cinta);
	$.ajax({
		url:"ajax/cintas.ajax.php",
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
				$("#nueva_cinta").parent().after('<div class="alert alert-warning" >Esta Numero Serie Existe </div>');
				$("#nueva_cinta").val("");
			}

		}
	})
 
}) // $("#nueva_cinta").change(function(){

// Editar Cintas
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cunado se haya cargado ().tablaCintas tbody).on se asigna el evento "on("click") a la clase "btnEditarCinta" la siguiente "function"
$(".tablaCintas tbody").on("click","button.btnEditarCinta",function(){
	// "idCinta" viene desde el archivo : "datatable-cintas.ajax.php -> $botones"
	var idCinta = $(this).attr("idCinta");
	//console.log("idCinta",idCinta);
	
	
	// Se utilizara Ajax para obtener la información de las cintas desde la base de datos.
	// Se esta agregando un dato al Ajax.
	var datos = new FormData();
	datos.append("idcinta",idCinta);
	$.ajax
	({
		url:"ajax/cintas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta Editar Cinta desde el boton Editar ",respuesta);
			

			// Asignando el valor a los campos
			//console.log("respuesta Editar Empleado desde el boton Editar ",respuesta);
			$("#id_cintas").val(respuesta["id_cintas"]);
			$("#editar_num_serial").val(respuesta["num_serial"]);
			$("#editar_fecha_inic").val(respuesta["fecha_inic"]);
			$("#editar_fecha_fin").val(respuesta["fecha_final"]);
			$("#editar_ubicacion").val(respuesta["ubicacion"]);
			$("#editar_comentarios").val(respuesta["comentarios"]);
			
			// console.log("id_Empleado javaScript ",respuesta["id_empleado"]);

		} // success:function(respuesta) 

	});

}) // $(".tablaCintas tbody").on("click","button.btnEditarCinta",function(){


// Borrar Cinta
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaCintas tbody").on("click","button.btnEliminarCinta",function(){
	var idCinta = $(this).attr("idCinta");
	//console.log("idCinta",idCinta);

	Swal.fire ({
	    title: "Esta seguro de Borrar la Cinta ",
		text : "De lo contrario puede cancelar la Acción ",
		type:'warning',
		showCancelButton:true,		
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText:'Si Para Borrar',
		closeOnConfirm: false
		}).then(function(result){
			if (result.value)
			{
				window.location="index.php?ruta=cintas&idCinta="+idCinta;
			}

			});	


})

// ==================================================================
// IMPRIMIR FACTURA 
// ==================================================================

$(".tablas").on("click",".btnImprimirFactura",function(){
	// Esta variable viene desde el archivo "ventas.php" donde se agrega el atributo de 
	// <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>
	var codigoVenta = $(this).attr("codigoVenta");
	// Busca este archivos (pdf.php) y abre una página nueva.
	// Para pasarlo como variable "$_GET"
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
	// Se tiene que renombrar el archivo que esta en la carpeta de /pdf/image_demo.jpg"
})
