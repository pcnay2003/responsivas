USE bd_responsivas;

INSERT INTO t_Usuarios (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Administrador','admin','Resp2020Ene','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
/*
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'SerialCintaUno',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'UbicacionUno','Comentarios VariosUno'),
	(0,'SerialCintaDos',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'UbicacionDos','Comentarios VariosDos'),
	(0,'SerialCintaTres',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'UbicacionTres','Comentarios VariosTres');

INSERT INTO t_Periferico (id_periferico,nombre,fecha) VALUES
  (0,'Desktop',CURRENT_TIMESTAMP),
	(0,'Laptop',CURRENT_TIMESTAMP),
	(0,'Monitor',CURRENT_TIMESTAMP);

INSERT INTO t_Almacen (id_almacen,nombre) VALUES
  (0,'NombrePerifericoUno'),
	(0,'NombrePerifericoDos'),
	(0,'NombrePerifericoTres');

INSERT INTO t_Edo_epo (id_edo_epo,descripcion) VALUES
  (0,'Operable'),
	(0,'No operable'),
	(0,'EstadoEpoTres');

INSERT INTO t_Marca (id_marca,descripcion) VALUES
  (0,'MarcaUno'),
	(0,'MarcaDos'),
	(0,'MarcaTres');

INSERT INTO t_Modelo (id_modelo,descripcion) VALUES
  (0,'ModeloUno'),
	(0,'ModeloDos'),
	(0,'ModeloTres');

INSERT INTO t_Telefonia (id_telefonia,nombre) VALUES
  (0,'TelefoniaUno'),
	(0,'TelefoniaDos'),
	(0,'TelefoniaTres');

INSERT INTO t_PlanTelefonia (id_plan_tel,nombre) VALUES
  (0,'PlanTelefoniaUno'),
	(0,'PlanTelefoniaDos'),
	(0,'PlanTelefoniaTres');

INSERT INTO t_Usuarios (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (0,'nombreUsuarioUno','UsuarioUno','claveUno','Banca Talento','VendedorUno','fotoUno',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	(0,'nombreUsuarioDos','UsuarioDos','claveDos','Banca Talento','VendedorDos','fotoDos',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
	(0,'nombreUsuarioTres','UsuarioTres','claveTres','Banca Talento','VendedorTres','fotoTres',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

INSERT INTO t_Puesto (id_puesto,descripcion) VALUES
  (0,'PuestoUno'),
	(0,'PuestoDos'),
	(0,'PuestoTres');

INSERT INTO t_Ubicacion (id_ubicacion,descripcion) VALUES
  (0,'UbicacionUno'),
	(0,'UbicacionDos'),
	(0,'UbicacionTres');

INSERT INTO t_Supervisor (id_supervisor,descripcion) VALUES
  (0,'SupervisorUno'),
	(0,'SupervisorDos'),
	(0,'SupervisorTres');

INSERT INTO t_Depto (id_depto,descripcion) VALUES
  (0,'DepartamentoUno'),
	(0,'DepartamentoDos'),
	(0,'DepartamentoTres');

INSERT INTO t_Centro_Costos (id_centro_costos,num_centro_costos,descripcion) VALUES
  (0,'NumCentroCostosUno','DescripcionUno'),
	(0,'NumCentroCostosDos','DescripcionDos'),
	(0,'NumCentroCostosTres','DescripcionTres');

INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_supervisor,id_depto,id_centro_costos,nombre,apellidos,ntid,correo_electronico,foto,fecha) VALUES
  (0,1,1,1,1,1,'Depto TI','Depto TI','NTIDUno','correoElectronicoUno','FotoUno',CURRENT_TIMESTAMP),
	(0,1,1,1,1,1,'NombreEmpleadoDos','ApellidosEmpleadoDos','NTIDDos','correoElectronicoDos','FotoDos',CURRENT_TIMESTAMP),
	(0,1,1,1,1,1,'NombreEmpleadoTres','ApellidosEmpleadoTres','NTIDTres','correoElectronicoTres','FotoTres',CURRENT_TIMESTAMP);

INSERT INTO t_Productos (id_producto,id_almacen,id_edo_epo,id_marca,id_modelo,id_periferico,id_empleado,id_telefonia,id_plan_tel,num_tel,cuenta,direcc_mac_tel,imei_tel,nomenclatura,num_serie,imagen_producto,stock,precio_compra,precio_venta,cuantas_veces,asignado,fecha_arribo,comentarios) VALUES
  (0,1,1,1,1,1,1,1,1,'num_telUno','CuentaUno','AE:FD:23:ER:23:AE','20342938472827323','NomenclaturaUno','numSerieUno','imagenProductoUno','30','10.20','15.20',3,'N',CURRENT_TIMESTAMP,'ComentariosUno'),
  (0,1,1,1,1,2,1,1,1,'num_telDos','CuentaDos','AE:FD:23:ER:23:AE','20342938472827323','NomenclaturaDos','numSerieDos','imagenProductoDos','30','10.20','15.20',3,'N',CURRENT_TIMESTAMP,'ComentariosDos'),
	(0,1,1,1,1,3,1,1,1,'num_telTres','CuentaTres','AE:FD:23:ER:23:AE','20342938472827323','NomenclaturaTres','numSerieTres','imagenProductoTres','30','10.20','15.20',3,'N',CURRENT_TIMESTAMP,'Comentari,CURRENT_TIMESTAMP');

	INSERT INTO t_Responsivas (id_responsiva,id_empleado,id_usuario,id_almacen,activa,num_folio,modalidad_entrega,num_ticket,responsiva_firmada,comentario,comentario_devolucion,productos,impuesto,neto,total,fecha_devolucion,fecha_asignado) VALUES
		(0,1,1,1,'N',1,'modalidadEntregaUno','numTicketUno','responsivas_firmadaUno','ComentarioUno','ComentarioDevolucionUno','productosUno','10','100','110',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
		(0,1,1,1,'N',2,'modalidadEntregaDos','numTicketDos','responsivas_firmadaDos','ComentarioDos','ComentarioDevolucionDos','productosDos','10','100','110',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
		(0,1,1,1,'N',3,'modalidadEntregaTres','numTicketTres','responsivas_firmadaTres','ComentarioTres','ComentarioDevolucionTres','productosTres','10','100','110',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);


	INSERT INTO t_Tareas (id_tarea,id_empleado,id_almacen,id_usuario,tarea_asignada,ticket,comentario1,comentario2,fecha_inicio,fecha_fin) VALUES
		(0,1,1,1,'tareaAsignadaUno','TicketUno','comentario1Uno','comentario2Uno',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
		(0,1,1,1,'tareaAsignadaDos','TicketDos','comentario1Dos','comentario2Dos',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
		(0,1,1,1,'tareaAsignadaTres','TicketTres','comentario1Tres','comentario2Tres',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

		*/
		