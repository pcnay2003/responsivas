<?php
	require_once "conexion.php";
	
	class ModeloResponsivas
	{
		// Mostrar las responsivas que tiene el empleado asignadas
		static public function mdlMostrarResponsivasPerifAsign($tabla,$item,$valor)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT r.id_empleado,r.num_folio,e.ntid,r.num_folio,r.fecha_asignado,r.productos FROM t_Responsivas r INNER JOIN t_Empleados e ON r.id_empleado = e.id_empleado  WHERE (activa = 'S' && e.ntid = :$item && r.modalidad_entrega = 'Permanente') ORDER BY r.num_folio ASC");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();	
			$registros = $stmt->fetchAll();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;					
		}

		// Mostrar las responsivas activas e inactivas 
		static public function mdlMostrarRespHistPerif($tabla)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT r.id_responsiva,r.id_empleado,r.fecha_asignado,r.productos,r.num_folio FROM t_Responsivas r ");
			
			$stmt->execute();	
			$registros = $stmt->fetchAll();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;			
		}

		static public function mdlMostrarNumResponsiva($tabla)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT MAX(id_responsiva) AS ultima FROM $tabla");
			$stmt->execute();
			$registros = $stmt->fetchAll();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;			
		}
		
		static public function mdlMostrarRespEposPrestados()
		{
			$stmt = Conexion::conectar()->prepare ("SELECT tr.id_responsiva, tr.num_folio,tr.id_empleado,te.ntid,te.nombre, te.apellidos,tr.fecha_asignado,tr.fecha_devolucion,tr.productos,tr.activa FROM t_Responsivas tr INNER JOIN t_Empleados te ON tr.id_empleado = te.id_empleado WHERE tr.activa = 'S' AND modalidad_entrega = 'Prestamo' ");
			$stmt->execute();
			$registros = $stmt->fetchAll();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;			
		}

		// Mostrar las responsivas en el Rango de Fechas.
		static public function mdlMostrarRespRangosFecha($fecha_inic,$fecha_fin)
		{

			//$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			$stmt = Conexion::conectar()->prepare ("SELECT id_empleado,fecha_asignado,productos FROM t_Responsivas WHERE fecha_asignado BETWEEN '$fecha_inic' AND '$fecha_fin' ORDER BY fecha_asignado ");

			
			$stmt->execute();	
			$registros=null;
			$registros = $stmt->fetchAll();			
			// Cerrar la conexion de la instancia de la base de datos.
			$stmt->closeCursor();
			$stmt=null;
			return $registros;					
		}

		// Mostrar Responsivas
		static public function mdlMostrarResponsivas($tabla,$item,$valor,$ordenar)
		{
			if ($item != null)
			{
				if ($ordenar == 'ConsultaSencilla')
				{
					$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item && activa = 'S' ORDER BY fecha_asignado ASC");
					$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
					$stmt->execute();	
				}
				if ($ordenar == 'ConsultaCompleja')
				{
					$stmt = Conexion::conectar()->prepare ("SELECT tr.id_responsiva,tr.id_empleado,tu.id_usuario,tu.nombre AS  nombre_usuario,tr.num_folio,tr.activa,tr.modalidad_entrega,tr.productos,tr.num_ticket,tr.id_empleado,tr.comentario,tr.impuesto,tr.neto,tr.total,tr.fecha_devolucion,tr.fecha_asignado,te.ntid,te.nombre AS nombre_empleado,te.apellidos AS apellidos_empleado,tr.id_almacen,ta.nombre AS nombre_planta FROM t_Responsivas tr INNER JOIN t_Empleados te ON tr.id_empleado = te.id_empleado INNER JOIN t_Almacen ta ON tr.id_almacen = ta.id_almacen INNER JOIN t_Usuarios tu ON tr.id_usuario = tu.id_usuario WHERE $item = :$item && tr.activa = 'S' ");
					$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
					$stmt->execute();
				}
				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;							
			}
			else
			{
				// Para que tome el último número de factura de la tabla.
				switch ($ordenar)
				{
					case ('id_responsiva'):
						$condicion = 'id_responsiva';
						$sube_baja = 'ASC';
					break;
					case ('por_fecha'):
						$condicion = 'fecha_asignado';
						$sube_baja = 'DESC';
					break;	

		
				}	// switch ($ordenar)			

				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE activa = 'S' ORDER BY $condicion $sube_baja");
				$stmt->execute();

				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;			
			} // if ($item != null)

		} // static public function mdlMostrarVentas($tabla, $item, $valor)


		// $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);
		// Guardar Responsiva en la Tabla 
		static public function mdlIngresarResponsiva($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare ("INSERT INTO $tabla(id_empleado,id_usuario,id_almacen,activa,num_folio,modalidad_entrega,num_ticket,comentario,productos,impuesto,neto,total,fecha_devolucion,fecha_asignado) VALUES (:id_empleado,:id_usuario,:id_almacen,:activa,:num_folio,:modalidad_entrega,:num_ticket,:comentario,:productos,:impuesto,:neto,:total,:fecha_devolucion,:fecha_asignado)");

			$stmt->bindParam(":id_empleado",$datos["id_empleado"],PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":activa",$datos["activa"],PDO::PARAM_STR);
			$stmt->bindParam(":num_folio",$datos["num_folio"],PDO::PARAM_INT);			
			$stmt->bindParam(":modalidad_entrega",$datos["modalidad_entrega"],PDO::PARAM_STR);
			$stmt->bindParam(":num_ticket",$datos["num_ticket"],PDO::PARAM_STR);
			$stmt->bindParam(":comentario",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":productos",$datos["productos"],PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
			$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
			$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_devolucion",$datos["fecha_devolucion"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_asignado",$datos["fecha_asignado"],PDO::PARAM_STR);

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

	} // static public function mdlIngresarResponsiva($tabla,$datos)


// $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);
		// Guardar Responsiva en la Tabla 
		static public function mdlEditarResponsiva($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare ("UPDATE $tabla SET id_empleado=:id_empleado,id_usuario=:id_usuario,id_almacen=:id_almacen,activa=:activa,num_folio=:num_folio,modalidad_entrega=:modalidad_entrega,num_ticket=:num_ticket,comentario=:comentario,productos=:productos,impuesto=:impuesto,neto=:neto,total=:total,fecha_devolucion=:fecha_devolucion,fecha_asignado=:fecha_asignado WHERE id_responsiva = :id_responsiva");

			$stmt->bindParam(":id_responsiva",$datos["id_responsiva"],PDO::PARAM_INT);
			$stmt->bindParam(":id_empleado",$datos["id_empleado"],PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":activa",$datos["activa"],PDO::PARAM_STR);
			$stmt->bindParam(":num_folio",$datos["num_folio"],PDO::PARAM_INT);			
			$stmt->bindParam(":modalidad_entrega",$datos["modalidad_entrega"],PDO::PARAM_STR);
			$stmt->bindParam(":num_ticket",$datos["num_ticket"],PDO::PARAM_STR);
			$stmt->bindParam(":comentario",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":productos",$datos["productos"],PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
			$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
			$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_devolucion",$datos["fecha_devolucion"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_asignado",$datos["fecha_asignado"],PDO::PARAM_STR);

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

	} // static public function mdlEditarResponsiva($tabla,$datos)

	// Eliminar Responsiva.

	static public function mdlEliminarResponsiva($tabla,$datos)
	{
		//$stmt = Conexion::conectar()->prepare ("DELETE FROM $tabla WHERE id_responsiva = :id_responsiva");
		$stmt = Conexion::conectar()->prepare ("UPDATE $tabla SET activa = 'N' WHERE id_responsiva = :id_responsiva");
		$stmt->bindParam(":id_responsiva",$datos,PDO::PARAM_INT);
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

	// Guardar Reporte Finanzas en la Tabla 
	static public function mdlIngresarRep_Finanzas($tabla,$rep_mensual)
	{
	//	$stmt = Conexion::conectar()->prepare ("INSERT INTO $tabla(ntid,fecha_asignado,nombre,apellidos,num_centro_costos,descrip_depto,periferico,marca,modelo,num_serial,precio_compra) VALUES (:ntid,:fecha_asignado,:nombre,:apellidos,:num_centro_costos,:descrip_depto,:periferico,:marca,:modelo,:num_serial,:precio_compra)");

	for ($m=0;$m<count($rep_mensual);$m++)
	{
		$stmt = Conexion::conectar()->prepare ("INSERT INTO $tabla(ntid,fecha_asignado,nombre,apellidos,num_centro_costos,descrip_depto,periferico,marca,modelo,num_serial,precio_compra) VALUES (:ntid,:fecha_asignado,:nombre,:apellidos,:num_centro_costos,:descrip_depto,:periferico,:marca,:modelo,:num_serial,:precio_compra)");

		
		$stmt->bindParam(":ntid",$rep_mensual[$m]["ntid"],PDO::PARAM_STR);	
		$rep_mensual[$m]["fecha_asignado"] = date("Y-m-d",strtotime($rep_mensual[$m]["fecha_asignado"]));
		if ($rep_mensual[$m]["fecha_asignado"]=="1970-01-01")
		{
			$rep_mensual[$m]["fecha_asignado"]= null;
		}
		$stmt->bindParam(":fecha_asignado",$rep_mensual[$m]["fecha_asignado"],PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$rep_mensual[$m]["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":apellidos",$rep_mensual[$m]["apellidos"],PDO::PARAM_STR);
		$stmt->bindParam(":num_centro_costos",$rep_mensual[$m]["num_centro_costos"],PDO::PARAM_STR);			
		$stmt->bindParam(":descrip_depto",$rep_mensual[$m]["descrip_depto"],PDO::PARAM_STR);
		$stmt->bindParam(":periferico",$rep_mensual[$m]["periferico"],PDO::PARAM_STR);
		$stmt->bindParam(":marca",$rep_mensual[$m]["marca"],PDO::PARAM_STR);
		$stmt->bindParam(":modelo",$rep_mensual[$m]["modelo"],PDO::PARAM_STR);
		$stmt->bindParam(":num_serial",$rep_mensual[$m]["num_serie"],PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra",$rep_mensual[$m]["precio_compra"],PDO::PARAM_STR);

		$stmt->execute();

	} // for ($m=0;$m<count($rep_mensual);$m++)

	$stmt->closeCursor();
	$stmt=null;

	} // static public function mdlIngresarRep_Finanzas($tabla,$rep_mensual)

	static public function mdlMostrarRep_Finanzas($tabla)
	{
		$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY fecha_asignado,num_centro_costos ASC");
		$stmt->execute();	
		$registros = $stmt->fetchAll();			
		// Cerrar la conexion de la instancia de la base de datos.
		$stmt->closeCursor();
		$stmt=null;
		return $registros;					
	}

	static public function mdlBorrarRep_Finanzas($tabla)
	{
		$stmt = Conexion::conectar()->prepare ("DELETE FROM $tabla");
		$stmt->execute();			
		// Cerrar la conexion de la instancia de la base de datos.
		$stmt->closeCursor();
		$stmt=null;
		return "ok";					
	}
	
}	// 	class ModeloResponsivas

?>