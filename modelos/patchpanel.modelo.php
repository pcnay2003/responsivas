<?php
	require_once "conexion.php";
	class ModeloPatchPanel
	{
		// Crear PatchPanel.
		static public function mdlIngresarPatchPanel($tabla,$datos)
		{
			// Para el "id_patch_panel" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevoPatchPanel"],PDO::PARAM_STR); 
			
			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlIngresarPatchPanel($tabla,$datos)

		// ======================================================
		// Editar Patch Panel.
		// ======================================================
		static public function mdlEditarPatchPanel($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_patch_panel = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_patch_panel"],PDO::PARAM_STR); 

			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlEditarPatchPanel($tabla,$datos)

		// ==============================================
		// Borrar Patch Panel.
		// ==============================================
		static public function mdlBorrarPatchPanel($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_patch_panel = :id");
			
		 	$stmt->bindParam(":id",$datos,PDO::PARAM_INT); 

			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlBorrarPatchPanel($tabla,$datos)

		// Mostrar Patch Panel.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarPatchPanel($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
	
				return $stmt->fetch(); // Retorna solo una linea.	
			}
			else // Cuando son todos los registros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();

				return $stmt->fetchAll(); // Retorna solo una linea.	
			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarPatchPanel($tabla,$item,$valor)


	} // class ModelPatchPanel

?>