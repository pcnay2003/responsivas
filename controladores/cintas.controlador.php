<?php
	// Manejando Cintas.
  class ControladorCintas
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Cintas.
		// ==================================================================
		static public function ctrMostrarCintas($item,$valor)
		{
			$tabla = "t_Cintas";
			$respuesta = ModeloCintas::mdlMostrarCintas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarCintas()

		// Crear Cintas.
		static public function ctrCrearCintas()
    {
			if (isset($_POST["nueva_cinta"]))
			{
				//if (preg_match('/^[a-zA-Z0-9- ]+$/',$_POST["nueva_cinta"])) //&&
				//preg_match('/^[a-zA-Z0-9,- ]+$/',$_POST["nueva_ubic"])			
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Cintas";

					// Se debe agregar la instruccion "rtrim" para eliminar espacios de la derecha, d elo contrario el DataTable falla
					$datos=array();									
					$datos = array("nueva_cinta"=>$_POST["nueva_cinta"],
						"nueva_fecha_inic"=>$_POST["nueva_fecha_inic"],
						"nueva_fecha_fin"=>$_POST["nueva_fecha_fin"],
						"nueva_ubic"=>$_POST["nueva_ubic"],
						"nuevoComent"=>rtrim($_POST["nuevoComent"]));

					$respuesta = ModeloCintas::mdlIngresarCinta($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Cinta ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="cintas";
								}
	
								});
			
							</script>';          
	
					}
				//}
				/*
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Cinta no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="cintas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nueva_cinta"]))
				*/
				
			}

    } // static public function ctrCrearCintas()


		// ==============================================
		// Editar Cintas
		// ==============================================
		static public function ctrEditarCinta()
		{
			if (isset($_POST["editar_num_serial"]))
			{
				//if (preg_match('/^[a-zA-Z0-9-]+$/',$_POST["editar_num_serial"]))
				// && 	preg_match('/^[a-zA-Z0-9-]+$/',$_POST["editar_ubicacion"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Cintas";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("num_serial"=>$_POST["editar_num_serial"],
												"fecha_inic"=>$_POST["editar_fecha_inic"],
												"fecha_final"=>$_POST["editar_fecha_fin"],
												"ubicacion"=>$_POST["editar_ubicacion"],
												"comentarios"=>rtrim(ltrim($_POST["editar_comentarios"])),
												"id_cintas"=>$_POST["id_cintas"]);
					//var_dump($datos);
					//exit;


					$respuesta = ModeloCintas::mdlEditarCinta($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Cinta ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="cintas";
								}
	
								});
			
							</script>';          
	
					}
					else
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "Error al Editar la Cinta",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="cintas";
								}
	
								});
			
							</script>';          

					}
				//}
				/*
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Cinta no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="cintas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nueva_Cinta"])....)
				*/

			}

		} // static public function ctrEditarCinta()

		// =========================================
		// Borrar Cintas
		// =========================================
		static public function ctrBorrarCinta()
		{
			// "idCinta" = se origina 
			/*
			//$(document).on("click",".btnEliminarCinta",function()
		//	{	
		
				// Obteniendo los valores de "idCinta"
				var idCinta = $(this).attr("idCinta");
		*/

			if (isset($_GET["idCinta"]))
			{
				$tabla = "t_Cintas";
				$datos = $_GET["idCinta"]; // Obtiene el valor.
				$respuesta = ModeloCintas::mdlBorrarCinta($tabla,$datos);
				
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Cinta ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="cintas";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idCinta"]))

		} // static public function ctrBorrarCinta()

		static public function ctrExportarExcelCintas()
		{
			// Traer la información de las Cintas.
			$item = null;
			$valor = null;
			$respuestaCintas = ControladorCintas::ctrMostrarCintas($item,$valor);

			// ===========================
			// Crear el archivo de Excel
			// ==========================
			$Name = 'ExportarExcel'.'.xls';
			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel");
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			// Creando la tabla de Excel
			// utf8_decode = Para poder trabajar con tildes, acentos, ñ, Ñ
			// Creando los encabezados de la tabla.
			echo utf8_decode("<table border='0'>
				<tr>
					<td style='font-weight:bold; border:1px solid #eee;'>NUMERO_SERIE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA_INICIAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA_FINAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>UBICACION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>COMENTARIOS</td>
				</tr>");
		
				foreach ($respuestaCintas as $row => $item)
				{
					echo utf8_decode("<tr>
						<td style='border:1px solid #eee;'>".$item["num_serial"]."</td>
						<td style='border:1px solid #eee;'>".$item["fecha_inic"]."</td>
						<td style='border:1px solid #eee;'>".$item["fecha_final"]."</td>
						<td style='border:1px solid #eee;'>".$item["ubicacion"]."</td>
						<td style='border:1px solid #eee;'>".$item["comentarios"]."</td>
						</tr>");					
					
					}
				echo "</table>"; 

		} // static public function ctrExportarExcelCintas()

  } // class ControladorCintas

 
  