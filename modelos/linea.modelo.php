<?php
	require_once "conexion.php";
	class ModeloLineas
	{
		// Crear Linea.
		static public function mdlIngresarLinea($tabla,$datos)
		{
			// Para el "id_linea" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevaLinea"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarLinea($tabla,$datos)

		// ======================================================
		// Editar Linea.
		// ======================================================
		static public function mdlEditarLinea($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_linea = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_linea"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarLinea($tabla,$datos)

		// ==============================================
		// Borrar Linea.
		// ==============================================
		static public function mdlBorrarLinea($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_linea = :id");
			
		 	$stmt->bindParam(":id",$datos,PDO::PARAM_INT); 

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

		} // static public function mdlBorrarLinea($tabla,$datos)


		// Mostrar Linea.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarLineas($tabla,$item,$valor)
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


		} // static public function mdlMostrarLinea($tabla,$item,$valor)


	} // class ModeloLineas

?>