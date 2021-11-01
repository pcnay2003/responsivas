<?php
	require_once "conexion.php";
	class ModeloUbicaciones
	{
		// Crear Ubicaciones.
		static public function mdlIngresarUbicacion($tabla,$datos)
		{
			// Para el "id_ubicacion" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevaUbicacion"],PDO::PARAM_STR); 
			
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
		} // static public function mdlIngresarUbicacion($tabla,$datos)

		// ======================================================
		// Editar Ubicacion.
		// ======================================================
		static public function mdlEditarUbicacion($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_ubicacion = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_ubicacion"],PDO::PARAM_STR); 

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
		} // static public function mdlEditarUbicacion($tabla,$datos)

		// ==============================================
		// Editar Ubicacion.
		// ==============================================
		static public function mdlBorrarUbicacion($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_ubicacion = :id");
			
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
		} // static public function mdlBorrarUbicacion($tabla,$datos)

		// Mostrar Ubicacion.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarUbicaciones($tabla,$item,$valor)
    {
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
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descripcion");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;				
			}
		} // static public function mdlMostrarUbicaciones($tabla,$item,$valor)
	} // class ModeloUbicaciones

?>