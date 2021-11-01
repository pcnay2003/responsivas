<?php
	require_once "conexion.php";
	class ModeloCintas
	{
		// Crear Modelo.
		static public function mdlIngresarCinta($tabla,$datos)
		{
			// Para el "id_cintas" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES (:num_serial,:fecha_inic,:fecha_final,:ubicacion,:comentarios)");
			$stmt->bindParam(":num_serial",$datos["nueva_cinta"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_inic",$datos["nueva_fecha_inic"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_final",$datos["nueva_fecha_fin"],PDO::PARAM_STR);
			$stmt->bindParam(":ubicacion",$datos["nueva_ubic"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["nuevoComent"],PDO::PARAM_STR);

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

		} // static public function mdlIngresarCinta($tabla,$datos)

		// ======================================================
		// Editar Cintas
		// ======================================================
		static public function mdlEditarCinta($tabla,$datos)
		{
			//$datos["editar_num_serial"] = 'SERIAL1';
			//$datos["editar_fecha_inic"] = '2021/01/10';
			//$datos["editar_fecha_final"] = '2021/01/05';
			//$datos["editar_ubicacion"] = 'Ubicacion 1';
			//$datos["editar_comentarios"] = 'Comentarios1';
			//$datos["id_cintas"] = '8';

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET num_serial = :num_serial, fecha_inic = :fecha_inic, fecha_final = :fecha_final, ubicacion = :ubicacion, comentarios = :comentarios WHERE id_cintas = :id");
			
			$stmt->bindParam(":num_serial",$datos["num_serial"],PDO::PARAM_STR);			
			$stmt->bindParam(":fecha_inic",$datos["fecha_inic"],PDO::PARAM_STR);			
			$stmt->bindParam(":fecha_final",$datos["fecha_final"],PDO::PARAM_STR);			
			$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR);			
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datos["id_cintas"],PDO::PARAM_STR); 
			

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

		} // static public function mdlEditarCinta($tabla,$datos)

		// ==============================================
		// Borrar Cinta.
		// ==============================================
		static public function mdlBorrarCinta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cintas = :id");
			
		 	$stmt->bindParam(":id",$datos,PDO::PARAM_INT); 

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

		} // static public function mdlBorrarMarca($tabla,$datos)

		// Mostrar Cintas.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarCintas($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;	

			}
			else // Cuando son todos los registros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY num_serial ASC");			
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}

		} // static public function mdlMostrarCintas($tabla,$item,$valor)

	} // class ModeloCintas

?>