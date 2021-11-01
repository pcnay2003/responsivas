// Ejecutar el código cuando se oprime el boton "Submit"
document.addEventListener("DOMContentLoaded",() => 
{
	let form = document.getElementById('form_subir');
	form.addEventListener("submit", function(event)
	{
		event.preventDefault();
		subir_archivos(this);
	});

});

function subir_archivos(form)
{
	// Acceder al '<div class="barra">'
	let barra_estado = form.children[1].children[0],
			span = barra_estado.children[0],
			// Acceder al '<div class="acciones">'
			boton_cancelar = form.children[2].children[1];
	
	barra_estado.classList.remove('barra_verde','barra_roja');
	//peticion
	let peticion = new XMLHttpRequest();
	//progreso
	peticion.upload.addEventListener("progress",(event) => 
		{
			//event.loaded = Bytes que se estan enviando.
			//event.total = El tamaño total del archivo.
			let porcentaje = Math.round((event.loaded/event.total)*100);
			console.log(porcentaje);
			barra_estado.style.width = porcentaje+"%";
			span.innerHTML = porcentaje+"%";
		});
	
		// Finalizado.
		peticion.addEventListener("load",() => 
		{
			barra_estado.classList.add('barra_verde');
			span.innerHTML = "PROCESOS COMPLETADO";
		});

		//Enviar Datos
		let idEmpleado = '2794304'; //$(this).attr("idEmpleado");
		
		peticion.open('post','../modulos/sube_doc.php?Ntid_Emp='+idEmpleado);
		peticion.send(new FormData(form));

		//Cancelar
		boton_cancelar.addEventListener("click", () =>
		{
			peticion.abort();
			barra_estado.classList.remove('barra_verde');
			barra_estado.classList.add('barra_roja');
			span.innerHTML = "PROCESO CANCELADO";
		});

}