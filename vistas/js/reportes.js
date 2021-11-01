 
// Variables Local Storage, para el boton que se encuentra en "Administrar Ventas" permanezca la fecha.
if (localStorage.getItem("capturarRango2") != null)
{
	// Se va asignar en boton donde despliega el rango seleccionado.
	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));	
}
else
{
	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i>Rango De Fecha');
}

// =============================================================
// Boton de Rango de Fecha.
// =============================================================
// Por la razon de que se agrega al final el archivo "reportes.js"
//	<!-- se muestra los productos en el modulo Crear Venta  -->
//	<script src="vistas/js/ventas.js"></script>
//	<!-- Es para los reportes que se utilizaran en el sistema  -->
//	<script src="vistas/js/reportes.js"></script>
// El funcionamiento de las clases es afectado , este archivo "reportes.js" altera el funcionamiento


$('#daterange-btn2').daterangepicker(
	{
		ranges : {
			'Hoy'						: [moment(),moment()],
			'Ayer'				: [moment().subtract(1,'days'),moment().subtract(1,'days')],
			'Ultimos 7 Dias'			: [moment().subtract(6,'days'),moment()],
			'Ultimos 30 Dias'		: [moment().subtract(29,'days'),moment()],
			'Este Mes'			: [moment().startOf('month'),moment().endOf('month')],
			'Ultimo Mes'			: [moment().subtract(1,'month').startOf('month'),moment().subtract(1,'month').endOf('month')] 
		},
		startDate: moment(),
		endDate: moment()
	},
	function (start,end)
	{
		$('#daterange-btn2 span').html(start.format('MMMM D, YYYY')+' - '+end.format('MMMM D, YYYY'));

		// Obteniendo la fecha inicial
		var fechaInicial = start.format('YYYY-MM-DD');
		 //console.log("fechaInicial",fechaInicial);
		var fechaFinal = end.format('YYYY-MM-DD');
		 //console.log("fechaFinal",fechaFinal);

		var capturarRango = $("#daterange-btn2 span").html();
		// console.log("Rango Fecha ",capturarRango);
		// Se va enviar por $_GET esta variable, se utilizara "LocalStorage"
		localStorage.setItem("capturarRango2",capturarRango);

		// Se va a pasar los datos por $_GET debido a que se maneja el Plugin DataTable, ya que si se utiliza Ajax afectaria.
		// En el archivo "ventas.php" se tiene que capturar estas variables globales.
		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal

	}
)


// =======================================================================================
// Cancelar Rangos de Fecha
// =======================================================================================
// Es la ubicacion del boton.
// Despues de que haya cargado en el HTML.
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click",function(){
	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
})

// ===================================================================
// Capturar la opción HOY desde el menu de "Rangos de Fecha"
// ===================================================================
// Se busca toda la ruta del Boton en el Rango de fecha para capturar el evento "click"
$(".daterangepicker.opensright .ranges li").on("click",function(){	
	// Se los nombres de clases no se escriben correctamente no muestra nada en el console.log, y no muestra error.
	var textoHoy = $(this).attr("data-range-key");
	if (textoHoy == "Hoy")
	{
		var d = new Date(); // Se va obtener la fecha, desde JavaScript
		//console.log("d",d);

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anno = d.getFullYear();

		// En la base de datos se registra la fecha : 2020-09-09, por esta razon se realizan las siguientes condicionales.
		if (mes < 10)
		{
			var fechaInicial = anno+"-0"+mes+"-"+dia;
			var fechaFinal = anno+"-0"+mes+"-"+dia;
		}
		if(dia < 10)
		{
			var fechaInicial = anno+"-"+mes+"-0"+dia;
			var fechaFinal = anno+"-"+mes+"-0"+dia;
		}
		if ((mes < 10) && (dia < 10))
		{
			var fechaInicial = anno+"-0"+mes+"-0"+dia;
			var fechaFinal = anno+"-0"+mes+"-0"+dia;
			var texto = "mes < 10, dia < 10";
		}
		if ((mes > 10) && (dia > 10))
		{
			var fechaInicial = anno+"-"+mes+"-"+dia;
			var fechaFinal = anno+"-"+mes+"-"+dia;	
		}

		localStorage.setItem("capturarRango2","Hoy");
		//console.log ("fecha Inicial ",fechaInicial);
		//console.log ("fecha Final ",fechaFinal);
		//console.log("texto ",texto);

		// Se llama a la pantalla para la ventas, asignando los parámetros  de fechas.
		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
})

$(".btnImpProdAlm").click(function(){

	// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
 	let Select = document.getElementById("rep_Almacen");
	//let Opcion = document.getElementsByTagName("option");

		//console.log("Click Boton Imprimirr ",Select.value);

	//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
	// console.log("idResponsiva",id_Responsiva);
	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");
	window.open("extensiones/fpdf183/reportes/rep_por_alm.php?num_AlmImp="+Select.value,"_blank");

	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_empleados.php

})

// Reporte De Telefonos Asignados
$(".btnImpTelAsig").click(function(){
	window.open("extensiones/fpdf183/reportes/rep_tel_asig.php","_blank");

	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_tel_asig.php

});

// Reporte De Existencia de Perifericos 
$(".btnExistenciaPerif").click(function(){
	window.open("extensiones/fpdf183/reportes/rep_exist_perif.php","_blank");

	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_tel_asig.php

});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#numEmp").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#num_serie").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9-]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

$(".btnEpoEntregEmp").click(function(){

	// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
 	// let Num_Emp = document.getElementById("numEmp");
	// Para obtener el numero de empleado. Esta variable viene desde "reportes.php" donde se define el Boton.
	 let Num_Emp= $("#numEmp").val();
	 
	 //console.log("Click Boton ObtenerResp ",Num_Emp);

	//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
	// console.log("idResponsiva",id_Responsiva);
	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	window.open("extensiones/tcpdf/pdf/rep_perif_asign.php?num_Emp="+Num_Emp,"_blank");
	//window.open("extensiones/fpdf183/reportes/rep_perif_asign.php?num_Emp="+Num_Emp,"_blank");

	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_empleados.php

})

$(".btnHistPerif").click(function(){

	// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
 	// let Num_Emp = document.getElementById("numEmp");
	// Para obtener el numero de empleado. Esta variable viene desde "reportes.php" donde se define el Boton.
	 let Num_Serie= $("#num_serie").val();
	 
	 //console.log("Click Boton ObtenerNumSerie ",Num_Serie);

	//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
	// console.log("idResponsiva",id_Responsiva);
	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	window.open("extensiones/tcpdf/pdf/rep_hist_perif.php?num_serie="+Num_Serie,"_blank");
	//window.open("extensiones/fpdf183/reportes/rep_perif_asign.php?num_Emp="+Num_Emp,"_blank");

	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_empleados.php

})

$(".btnSubirCinta").click(function(){

	window.open("index.php?ruta=subir_cintas","_blank");
	

})

// Subir el Inventario de I.T. (Hoja de Excel) 
$(".btnSubirInvIT").click(function(){
	//console.log("Se oprimio el boton de Inv I.T.")
	window.open("index.php?ruta=inv_it","_blank");
})

$(".btnPerifProd").click(function(){

// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
let Select = document.getElementById("rep_LineaProd");
//let Opcion = document.getElementsByTagName("option");

	//console.log("Click Boton Imprimirr ",Select.value);

//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
// console.log("idResponsiva",id_Responsiva);

// Abrir en una ventana, que contiene la carpeta de la extension PDF.
//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");
window.open("extensiones/fpdf183/reportes/rep_perif_linea.php?num_Linea="+Select.value,"_blank");

})

// Evento Click para Imprimir los equipos Prestado.
$(".btnEposPrestados").click(function(){

	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");
	window.open("extensiones/tcpdf/pdf/rep_epos_prestados.php","_blank");
	
	})
	
// Evento Click para subir responsivas del empleado.
$(".btnSubirResp").click(function(){
	let idNtid = $(this).attr("id_ntid");
	//console.log(idNtid);
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");
	//window.open("extensiones/tcpdf/pdf/rep_epos_prestados.php","_blank");
	
	})
	
// Validar los caracteres permitidos 
// Validar la entrada.
$("#ntid_Emp").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
// Obteniendo el valor del input del Numero de Empledo para subir las responsivas.
$(".btnSubirResp").click(function(){

	// let Num_Emp = document.getElementById("numEmp");
	// Para obtener el numero de empleado. Esta variable viene desde "reportes.php" donde se define el Boton.
	 let Num_Emp= $("#ntid_Emp").val();
	 
	 //console.log("Click Boton SubirArchivo ",Num_Emp);

	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/rep_perif_asign.php?num_Emp="+Num_Emp,"_blank");
	//window.open("extensiones/fpdf183/reportes/rep_perif_asign.php?num_Emp="+Num_Emp,"_blank");
	window.open("vistas/modulos/subir_resp.php?Ntid_Emp="+Num_Emp,"_blank");	
	//https://www.miportalweb.org/responsivas/extensiones/fpdf183/reportes/rep_empleados.php

})

// Obteniendo el reporte para finanzas por parte de IT
$(".btnRep_Finanzas").click(function(){

	// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
	let Fecha_Inicial = document.getElementById("fecha_inicial");
	let Fecha_Final = document.getElementById("fecha_final");

	//let Opcion = document.getElementsByTagName("option");
	
		//console.log("Click Boton Fecha Inicial ",Fecha_Inicial.value);
		//console.log("Click Boton Fecha Final ",Fecha_Final.value);
	
	//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
	// console.log("idResponsiva",id_Responsiva);
	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");

//	window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	window.open("extensiones/fpdf183/reportes/rep_finanzas.php?ruta=rep_finanzas&fechaInic="+Fecha_Inicial.value+"&fechaFin="+Fecha_Final.value,"_blank");
	
	})
	
// Obteniendo el reporte para finanzas por parte de IT
$(".btnRep_Finanzas_Excel").click(function(){

	// Para obtener el valor del "Select" que se utiliza en la pantalla de "Reportes"
	let Fecha_Inicial = document.getElementById("fecha_inicial");
	let Fecha_Final = document.getElementById("fecha_final");

	//let Opcion = document.getElementsByTagName("option");
	
		//console.log("Click Boton Fecha Inicial ",Fecha_Inicial.value);
		//console.log("Click Boton Fecha Final ",Fecha_Final.value);
	
	//window.location="index.php?ruta=editar-responsiva&idResponsiva="+id_Responsiva;
	// console.log("idResponsiva",id_Responsiva);
	
	// Abrir en una ventana, que contiene la carpeta de la extension PDF.
	//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");

	//window.location = "index.php?ruta=r-finanza-excel&fechaInicial="+Fecha_Inicial.value+"&fechaFinal="+Fecha_Final.value;

	//window.open("rep-finanz-excel.php?ruta=rep_finanzas&fechaInic="+Fecha_Inicial.value+"&fechaFin="+Fecha_Final.value,"_blank");
	
	window.open("extensiones/fpdf183/reportes/rep-finanz-excel.php?rep_finanzas.php&fechaInic="+Fecha_Inicial.value+"&fechaFin="+Fecha_Final.value,"_blank");
	
	})

	// Evento Click para Imprimir los equipos Dañados.
	$(".btnEpo_Danado").click(function(){
		console.log("Click en Boton Equipo Dañado ..")
		
		// Abrir en una ventana, que contiene la carpeta de la extension PDF.
		//window.open("extensiones/tcpdf/pdf/imp_responsiva.php?idResponsiva="+id_Responsiva,"_blank");
		// window.open("extensiones/tcpdf/pdf/rep_epos_prestados.php","_blank");
		window.open("extensiones/fpdf183/reportes/rep-epodanado.php","_blank");
		
		})
