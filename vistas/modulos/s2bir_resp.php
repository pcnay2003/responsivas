<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title> Subir Documentos Empleados></title>
		<link rel ="stylesheet" href="../dist/css/subir_archivo.css">	
	</head>

	<body>
		<div classs="principal">
			<h1>Subir Documentos de Empleados</h1>
				<form action="" id="form_subir">
					<div class="form1-1-2">
						<label for ="">Documento a Subir</label>
						<input type="file" name="archivo" required>
					</div> <!--	<div class="form1-1-2"> -->
					
					<div class="barra">
						<div class="barra_azul" id="barra_estado">
							<!-- Mostrara el porcentaje de Subida del archivo y un mensaje si se completo -->
							<span></span>
						</div>
					</div>

					<div class="acciones">
						<input type="submit" class="btn" value="Enviar">
						<input type="button" class="cancel" value="Cancelar">
					</div>

				
				</form>
		
		</div> <!-- <div classs="principal"> -->
		<script src="../js/subir_archivo.js"></script>

	</body>

</html>


