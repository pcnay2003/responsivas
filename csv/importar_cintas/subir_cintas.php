<?php
	include_once("db_connect.php");

	if(isset($_POST['import_data_cintas']))
	{
		// validate to check uploaded file is a valid csv file
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				while(($cinta_record = fgetcsv($csv_file)) !== FALSE)
				{
					/*
					// Check if employee already exists with same email
					$sql_query = "SELECT id, id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta, ventas, fecha FROM t_Productos WHERE codigo = '".$emp_record[2]."'";
					$resultset = mysqli_query($conn, $sql_query) or die("database error: - Select". mysqli_error($conn));
					*/
					// if employee already exist then update details otherwise insert new record
//					if(mysqli_num_rows($resultset)) 
//					{
						/*
						//print_r(' Fecha  = '.$emp_record[8]);
						$sql_update = "UPDATE t_Productos set id_categoria ='".$emp_record[1]."', codigo ='".$emp_record[2]."',descripcion ='".$emp_record[3]."',imagen ='".$emp_record[4]."',stock ='".$emp_record[6]."',precio_venta ='".$emp_record[7]."',precio_venta ='".$emp_record[8]."',ventas ='".$emp_record[9]."',fecha ='".$emp_record[10]."' WHERE codigo = '".$emp_record[2]."'";
						mysqli_query($conn, $sql_update) or die("database error: - Update". mysqli_error($conn));
						*/
//					} 
//					else
//					{
						// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
//						$fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

						$fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));
						$fecha_fin = date("Y-m-d",strtotime($cinta_record[2]));
						$comentario_adic = $cinta_record[5];

						if ($cinta_record[1] == null || $cinta_record[1] == "" || strlen($cinta_record[1]) <= 6)
						{						
							$comentario_adic = $cinta_record[5].'       <===> Fecha Incompleta '.$cinta_record[1];
						}

						if ($cinta_record[2] == null || $cinta_record[2] == "" || strlen($cinta_record[2]) <= 6)
						{	
							if (strlen($cinta_record[1]) <= 6)					
							{

							}
							else
							{
								$comentario_adic = $cinta_record[5].'       <===> Fecha Incompleta '.$cinta_record[2];
							}
						}

						//else
						//{
							
							
							//$comentario_adic = $cinta_record[5];
						//}

/*
						print_r('Serial = '.$cinta_record[0].' ');
						print_r('Fecha Inicial = '.$fecha_inicio.' ');
						print_r('Fecha Final = '.$fecha_fin.' ');						
						print_r('Ubicacion  = '.$cinta_record[4].' ');
						print_r('Comentarios = '.$comentario_adic.' ');						
						print "<br>";
*/						
						$serial = $cinta_record[0];
						$ubicacion = $cinta_record[4];

						$mysql_insert = "INSERT INTO t_Cintas (num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES($serial,$fecha_inicio,$fecha_fin,$ubicacion)";
						mysqli_query($conn, $mysql_insert) or die("database error: - Insert ". mysqli_error($conn));
					
//					}

				} //while(($cinta_record = fgetcsv($csv_file)) !== FALSE)


				fclose($csv_file);
				$import_status = '?import_status=success';
			}
			else
			{
				$import_status = '?import_status=error';

			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} 
		else
		{
			$import_status = '?import_status=invalid_file';

		} // if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))

	} // if(isset($_POST['import_data']))

	header("Location: index.php".$import_status);

?>
