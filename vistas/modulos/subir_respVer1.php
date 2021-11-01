<?php
	//print_r ("variable ".$_GET["Ntid_Emp"]);
	
	$formatos = array('.jpg','.png','.doc','.xlsx','.pdf');
	$directorio = '../img/empleados/'.$_GET['Ntid_Emp'];
	$contador = 0;

	if (isset($_POST['boton']))
	{
		$nombreArchivo = $_FILES['archivo']['name'];
		$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
		$ext = substr($nombreArchivo,strrpos($nombreArchivo,'.'));
		if (in_array($ext,$formatos))
		{
			if (move_uploaded_file($nombreTmpArchivo,$directorio.'/'.$nombreArchivo))
			{
				echo "Subido correctamente $nombreArchivo";
			}
			else
			{
				echo "Error al subir el archivo";
			}
		}
		else
		{
			echo "Archivo no permitido";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title> Subir Documentos Empleados></title>
		<link rel ="stylesheet" href="../dist/css/subir_archivo.css">	
	</head>

	<body>
		<div class="caja">
			<h1>Documentos del Empleado</h1>
			<?php
				if ($dir = opendir($directorio))
				{
					while ($archivo=readdir($dir))
					{						
						if ($archivo != '.' && $archivo != '..')
						{							
							$contador++;
							echo "<a href=<strong>$archivo</strong> download=$archivo</a><br/>";
						}
					}

					echo "Total De Documentos : $contador";
				}
			?>

		</div>
		<div classs="caja">			
				<form method="post" action="" enctype="multipart/form-data">
					<h1>Subir Documentos de Empleados</h1>
					<input type="file" name="archivo"/>					
					<input type="submit" name="boton" value="Enviar">										
				</form>		
		</div> <!-- <div classs="cajas"> -->

		

	</body>

</html>


