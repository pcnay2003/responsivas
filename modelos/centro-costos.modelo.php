<?php
	require_once "conexion.php";
	class ModeloCentro_Costos
	{
		// Crear el Centro de Costos.
		static public function mdlIngresarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_centro_costos,descripcion) VALUES (:num_centro_costos,:descripcion)");

			$stmt->bindParam(":num_centro_costos",$datos["num_centro_costos"],PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 

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

		} // static public function mdlIngresarCentro_Costos($tabla,$datos)

		// ======================================================
		// Editar Centro de Costos.
		// ======================================================
		static public function mdlEditarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET num_centro_costos = :num_centro_costos, descripcion = :descripcion WHERE id_centro_costos = :id");

			$stmt->bindParam(":num_centro_costos",$datos["num_centro_costos"],PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_centro_costos"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarCentro_Costos($tabla,$datos)

		// ==============================================
		// Borrar Centro De Costos.
		// ==============================================
		static public function mdlBorrarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_centro_costos = :id");
			
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

		} // static public function mdlBorrarCentro_Costos($tabla,$datos)


		// Mostrar los Centros de Costos.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarCentro_Costos($tabla,$item,$valor)
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
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descripcion ");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}

		} // static public function mdlMostrarCentro_Costoso($tabla,$item,$valor)


	} // class ModeloCentro_Costos
?>