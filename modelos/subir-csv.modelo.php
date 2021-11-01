<?php
	require_once "conexion.php";
	
	class ModeloSubirCsv
	{
		// Subir Cintas.
		static public function mdlSubirCsv($tabla,$datos)
		{
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES (0,:num_serial,:fecha_inic,:fecha_final,:ubicacion,:comentarios)");
			$stmt->bindParam(":num_serial",$datos["num_serial"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_inic",$datos["fecha_inic"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_final",$datos["fecha_final"],PDO::PARAM_STR); 
			$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR); 
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR); 

			if ($stmt->execute())
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "ok";				
			}
			else
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}
			
		} // static public function mdlIngresarMarca($tabla,$datos)

		// Localizar Cintas.
		static public function localizarCinta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("SELECT num_serial,fecha_inic,fecha_final,ubicacion,comentarios FROM  $tabla WHERE num_serial = :num_serial");
			$stmt->bindParam(":num_serial",$datos["num_serial"],PDO::PARAM_STR); 
			$stmt->execute();
			$registros = $stmt->fetch();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;			
		} // static public function localizarCinta($tabla,$datos)
		
		// Actualizar el campo que se requiera de las "Cintas"
		static public function actualizarCsvCinta($tabla,$item1,$valor1,$item2,$valor2)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1  WHERE $item2 = :$item2");
			$stmt->bindParam(":".$item1, $valor1,PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2,PDO::PARAM_STR);

			if($stmt->execute())
			{				
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "ok";
			}
			else
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}
			
		} // static public function localizarCinta($tabla,$datos)
	

	} //	class ModeloSubirCsv
?>
