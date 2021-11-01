<?php
  require_once "conexion.php";

  class ModeloUsuarios
  {
    // Mostrar usuarios.
		// "static" debido a que tiene parámetros.
		// Algunos servidores requieren que lleve la palabra "static"
    static public function mdlMostrarUsuarios($tabla,$item,$valor)
    {
			// Determinar si se quiere un registro o todos.
			if ($item != null)
			{
				// :$item = Es un parametroa enlazar, PDO lo requiere para hacerlo mas seguro.
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				// Enlazar parametro.
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;				
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
		} // static public function mdlMostrarUsuarios($tabla,$item,$valor)

		// =====================================================
		// Registrar Usuario.
		// ====================================================
    static public function mdlIngresarUsuario($tabla,$datos)
    {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, clave, perfil,foto) VALUES (:nombre,:usuario,:password,:perfil,:ruta)");

      $stmt->bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);
      $stmt->bindParam(":password",$datos["password"], PDO::PARAM_STR);
      $stmt->bindParam(":perfil",$datos["perfil"], PDO::PARAM_STR);
      $stmt->bindParam(":ruta",$datos["ruta"], PDO::PARAM_STR);
      
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
		}
		
		// ==============================================
		// EDITAR USUARIO:
		// =============================================
		static public function mdlEditarUsuario($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, clave = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);	
			$stmt->bindParam(":perfil",$datos["perfil"],PDO::PARAM_STR);	
			$stmt->bindParam(":foto",$datos["ruta"],PDO::PARAM_STR);	
			$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);	

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
		}

		// Actualizar Usuario 
		static public function mdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2)
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
		} // 		static public function mdlActualizarUsuario.......


		// =================================================
		// Borrar Usuario.
		// =================================================
		static public function mdlBorrarUsuario($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id AND id_usuario != 1");
			$stmt->bindParam(":id",$datos,PDO::PARAM_INT);
			if ($datos == 1)
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}
			
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
		}
 
  } // class ModeloUsuarios
?>