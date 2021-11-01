<?php
	require_once("db_connect.php")
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System | Blank Page</title>

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<div class="panel panel-default">
	<div class="panel-body">
	<br>
	<div class="row">
	<form action="subir_cintas.php" method="post" enctype="multipart/form-data" id="import_form_cinta">
	<div class="col-md-3">
	<input type="file" name="file" />
	</div>
	<div class="col-md-5">
	<input type="submit" class="btn btn-primary" name="import_data_cintas" value="IMPORT">
	</div>
	</form>
	</div>
	<br>
	<div class="row">
	<table class="table table-bordered">
	<thead>
	<tr>
		<th>Numero Serie</th>
	<th>Fecha Inicio</th>
	<th>Fecha Fin</th>
	<th>Ubicacion</th>
	<th>comentarios</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$sql = "SELECT num_serial,fecha_inic,fecha_final,ubicacion,comentarios FROM t_Cintas ORDER BY num_serial DESC";
		$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
		if(mysqli_num_rows($resultset)) {
		while( $rows = mysqli_fetch_assoc($resultset) )
		 {
			?>
				<tr>
				<td><?php echo $rows['num_serial']; ?></td>
				<td><?php echo $rows['fecha_inic']; ?></td>
				<td><?php echo $rows['fecha_final']; ?></td>
				<td><?php echo $rows['ubicacion']; ?></td>
				<td><?php echo $rows['comentarios']; ?></td>
				</tr>
			<?php } }
			 else { ?>
		<tr><td colspan="5">No records to display.....</td></tr>
		<?php } ?>

	</tbody>

	</table>

	</div>
	</div>
	</div>
	</div>
</body>
