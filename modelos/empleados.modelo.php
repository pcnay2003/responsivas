<?php
	require_once "conexion.php";
	class ModeloEmpleados
	{
		// Mostrar Empleados.
		static public function mdlMostrarEmpleados($tabla,$item,$valor,$orden)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden ASC ");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();
				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");				
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
		}

		static public function mdlMostrarEmpleadosRep($tabla,$item,$valor)
		{
			if ($item != null)
			{

			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT emp.ntid,emp.apellidos,emp.nombre,emp.correo_electronico,cc.num_centro_costos,puesto.descripcion AS Puesto,depto.descripcion AS Depto FROM t_Empleados emp INNER JOIN t_Centro_Costos cc ON emp.id_centro_costos = cc.id_centro_costos INNER JOIN t_Puesto puesto ON emp.id_puesto = puesto.id_puesto INNER JOIN t_Depto depto ON emp.id_depto = depto.id_depto ORDER BY emp.apellidos ASC");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
		}

		static public function mdlMostrarEmpleadosImpResp($item,$valor)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT emp.nombre,emp.apellidos,emp.ntid,emp.correo_electronico,pto.descripcion AS puesto, depto.descripcion AS depto, superv.descripcion AS supervisor,cc.num_centro_costos FROM t_Empleados emp INNER JOIN t_Puesto pto ON emp.id_puesto = pto.id_puesto INNER JOIN t_Depto depto ON emp.id_depto = depto.id_depto INNER JOIN t_Supervisor superv ON emp.id_supervisor = superv.id_supervisor INNER JOIN t_Centro_Costos cc ON emp.id_centro_costos = cc.id_centro_costos WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();

				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
		}

		// Guardar el Empleado, en la tabla "t_Empleados"
		static public function mdlIngresarEmpleado($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_puesto,id_depto,id_supervisor,id_ubicacion,id_centro_costos,ntid,nombre,apellidos,correo_electronico,foto) VALUES (:id_puesto,:id_depto,:id_supervisor,:id_ubicacion,:id_centro_costos,:ntid,:nombre,:apellidos,:correo_electronico,:imagen)");

			$stmt->bindParam(":id_puesto",$datos["id_puesto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_depto",$datos["id_depto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_supervisor",$datos["id_supervisor"],PDO::PARAM_INT);
			$stmt->bindParam(":id_ubicacion",$datos["id_ubicacion"],PDO::PARAM_INT);
			$stmt->bindParam(":id_centro_costos",$datos["id_centro_costos"],PDO::PARAM_INT);
			$stmt->bindParam(":ntid",$datos["ntid"],PDO::PARAM_STR);
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":apellidos",$datos["apellidos"],PDO::PARAM_STR);
			$stmt->bindParam(":correo_electronico",$datos["correo_electronico"],PDO::PARAM_STR);			
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);

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

		} //static public function mdlIngresarEmpleado($tabla,$datos)

		// Editar Empleado.

		static public function mdlEditarEmpleado($tabla,$datos)
		{
			// var_dump($datos);

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_puesto = :id_puesto, id_depto = :id_depto, id_supervisor = :id_supervisor, id_ubicacion = :id_ubicacion,id_centro_costos = :id_centro_costos,id_empleado = :id_empleado, ntid = :ntid, nombre = :nombre, apellidos = :apellidos, correo_electronico = :correo_electronico,foto = :imagen WHERE id_empleado = :id_empleado");

			$stmt->bindParam(":id_puesto",$datos["id_puesto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_depto",$datos["id_depto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_supervisor",$datos["id_supervisor"],PDO::PARAM_INT);
			$stmt->bindParam(":id_ubicacion",$datos["id_ubicacion"],PDO::PARAM_INT);
			$stmt->bindParam(":id_empleado",$datos["id_empleado"],PDO::PARAM_INT);
			$stmt->bindParam(":id_centro_costos",$datos["id_centro_costos"],PDO::PARAM_INT);

			$stmt->bindParam(":ntid",$datos["ntid"],PDO::PARAM_STR);
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":apellidos",$datos["apellidos"],PDO::PARAM_STR);
			$stmt->bindParam(":correo_electronico",$datos["correo_electronico"],PDO::PARAM_STR);			
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
			
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

		} //static public function mdlIngresarEmpleado($tabla,$datos)
		
		// ==============================================================================
		// Borrar Empleado 
		// ==============================================================================
		static public function mdlEliminarEmpleado($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_empleado = :id");
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

		}

		// Buscar Puesto 		
		static public function mdlBuscarPuesto($tabla,$buscar)
		{
			//$buscar = '%'.$buscar.'%';			
			$buscar = $buscar.'%';			
			$stmt = Conexion::conectar()->prepare("SELECT id_puesto,descripcion FROM t_Puesto WHERE descripcion LIKE :buscar");
			$stmt->bindParam(":buscar",$buscar,PDO::PARAM_STR);
			if ($stmt->execute())
			{
				$registros = $stmt->fetchAll();			
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
			else
			{
				$stmt->closeCursor();
				$stmt=null;
				return " ";
			}

		}


		// Buscar Centro De Costos 		
		static public function mdlBuscarCC($tabla,$buscar)
		{
			//$buscar = '%'.$buscar.'%';			
			$buscar = '%'.$buscar.'%';			
			$stmt = Conexion::conectar()->prepare("SELECT id_centro_costos,num_centro_costos,descripcion FROM t_Centro_Costos WHERE num_centro_costos LIKE :buscar");
			$stmt->bindParam(":buscar",$buscar,PDO::PARAM_STR);
			if ($stmt->execute())
			{
				$registros = $stmt->fetchAll();			
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
			else
			{
				$stmt->closeCursor();
				$stmt=null;
				return " ";
			}

		}		
		/*
		// Actualizar Producto, cuando se realiza la Venta. 
		static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1  WHERE id = :id");
			$stmt->bindParam(":".$item1, $valor1,PDO::PARAM_STR);
			$stmt->bindParam(":id", $valor2,PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}
			else
			{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		} // 		static public function mdlActualizarProducto.......

		

		static public function mdlMostrarSumaVentas($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt = null;
		}
	*/

	} // class ModeloEmpleados

?>