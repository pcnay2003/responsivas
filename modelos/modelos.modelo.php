<?php
	require_once "conexion.php";
	class ModeloModelos
	{
		// Crear Modelo
		static public function mdlIngresarModelo($tabla,$datos)
		{
			// Para el "id_modelo" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevoModelo"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarModelo($tabla,$datos)

		// ======================================================
		// Editar Modelo.
		// ======================================================
		static public function mdlEditarModelo($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_modelo = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_modelo"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarModelo($tabla,$datos)

		// ==============================================
		// Editar Modelo.
		// ==============================================
		static public function mdlBorrarModelo($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_modelo = :id");
			
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

		} // static public function mdlBorrarModelo($tabla,$datos)

		// Mostrar Modelo.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarModelos($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY descripcion ");
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
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descripcion");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;				
			}

		} // static public function mdlMostrarModelos($tabla,$item,$valor)


	} // class ModeloModelos

?>