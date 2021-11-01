<?php
	/* Database connection start */
	$servername = "localhost";
	$username = "usuario_responsiva";
	$password = "responsivas-2020";
	$dbname = "bd_responsivas";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (mysqli_connect_errno())
	{
		printf("Connect failed: %sn", mysqli_connect_error());
		exit();
	}
?>