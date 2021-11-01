<?php
	require_once "conexion.php";
	class ModeloAlmacenes
	{
		// Crear Almacen.
		static public function mdlIngresarAlmacen($tabla,$datos)
		{
			// Para el "id_almacen" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos["nuevoAlmacen"],PDO::PARAM_STR); 
			
			if ($stmt->execute())
			{
				$stmt->closeCursor();
				$stmt=null;	
				return "ok";
			}
			else
			{
				$stmt->closeCursor();
				$stmt=null;	
				return "error";
			}

		} // static public function mdlIngresarAlmacen($tabla,$datos)

		// ======================================================
		// Editar Almacen.
		// ======================================================
		static public function mdlEditarAlmacen($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_almacen = :id");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_almacen"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarAlmacen($tabla,$datos)

		// ==============================================
		// Editar Almacen.
		// ==============================================
		static public function mdlBorrarAlmacen($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_almacen = :id");
			
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

		} // static public function mdlBorrarAlmacen($tabla,$datos)

		// Mostrar Almacen.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarAlmacenes($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY nombre");
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
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY nombre");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}

		} // static public function mdlMostrarAlmacen($tabla,$item,$valor)


	} // class ModeloAlmacenes

?>