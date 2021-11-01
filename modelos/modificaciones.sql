/*
	Tipos de datos de MariaDB
  https://www.anerbarrena.com/tipos-dato-mysql-5024/

/*

-- Ejecutarlo desde una terminal de Mysql 
-- Cuando sea la PRIMERA VEZ que se esta generando la base de datos, se debe enttrar como root en la computadora y accesar a "mysql"
		mysql -u root -p

Para ejecutar el "script"
-- Ejecutarlo desde una terminal de Mysql 
-- Se debe accesar al directorio donde se encuentra el "script.sql" y ejecutar el comenado "mysql" desde una terminal


-- $ mysql -u nom-usr -p NombreBaseDatos < script.sql
-- Otra Forma : Es el usuario y contraseña que se definio cuando se creo el usuario (asignando permisos para crear, borrar tablas.)
--    mysql -u usuario -p NombreBaseDatos
--    source script.sql ó \. script.sql
*/


/*
-- Se debe accesar al directorio donde se encuentra el "script.sql" y ejecutar el comanado "mysql" desde una terminal
-- $ mysql -u nom-usr -p NombreBaseDatos < script.sql
-- Otra Forma 
--    mysql -u usuario -p NombreBaseDatos
--    source script.sql ó \. script.sql

			Borrar tabla: DROP TABLE <nombre Tabla>
			Borrar Base Datos : DROP DATABASE <nombre Base Datos>
			Borrar el contenido de la tabla : 
					truncate table nombre-tabla;
*/


USE bd_responsivas;
/*
CREATE TABLE t_Estatus
(
  id_estatus SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(20) NOT NULL	
);

CREATE TABLE t_Categorias
(
  id_categoria SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(40) NOT NULL	
);

CREATE TABLE t_Tareas
(	
  id_tarea SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
	id_estatus SMALLINT UNSIGNED NOT NULL,
	id_usuario SMALLINT UNSIGNED NOT NULL,
	id_empleado SMALLINT UNSIGNED NOT NULL,
	id_categoria SMALLINT UNSIGNED NOT NULL,
	id_ubicacion SMALLINT UNSIGNED NOT NULL,
	tareas varchar(120) NULL,
	ticket varchar(25) NULL,
	fecha DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	comentarios TEXT NULL,
	FOREIGN KEY(id_estatus) REFERENCES t_Estatus(id_estatus)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_usuario) REFERENCES t_Usuarios(id_usuario)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_empleado) REFERENCES t_Empleados(id_empleado)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_categoria) REFERENCES t_Categorias(id_categoria)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_ubicacion) REFERENCES t_Ubicacion(id_ubicacion) ON DELETE RESTRICT ON UPDATE CASCADE
);

*/


/* DROP TABLE t_Tareas; */

/*
CREATE TABLE t_Rep_Finanzas
(
  id_rep_finanzas SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	ntid VARCHAR(20) NULL,
  fecha_asignado DATE NULL,
	nombre VARCHAR(20) NULL,
	apellidos VARCHAR(45) NULL,
	num_centro_costos VARCHAR(30) NULL,
	descrip_depto VARCHAR(50) NULL,
	periferico VARCHAR(80) NULL,
	marca VARCHAR(45) NULL,
	modelo VARCHAR(45) NULL,
	num_serial VARCHAR(45) NULL,
	precio_compra decimal(10,2) DEFAULT NULL  
);

*/

/*
ALTER TABLE t_Productos ADD qdc VARCHAR(15) DEFAULT NULL;
ALTER TABLE t_Productos ADD jls VARCHAR(15) DEFAULT NULL;
 Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Productos ADD asset VARCHAR(15) DEFAULT NULL;
	ALTER TABLE t_Productos ADD loftware VARCHAR(10) DEFAULT NULL;
	ALTER TABLE t_Productos ADD area VARCHAR(20) DEFAULT NULL;
	ALTER TABLE t_Productos ADD linea VARCHAR(25) DEFAULT NULL;
	ALTER TABLE t_Productos ADD estacion VARCHAR(50) DEFAULT NULL;
	ALTER TABLE t_Productos ADD npa VARCHAR(15) DEFAULT NULL;
	ALTER TABLE t_Productos ADD idf VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD patch_panel VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD puerto VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD funcion VARCHAR(20) DEFAULT NULL;
/*
INSERT INTO t_Usuarios (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Administrador','admin','Resp2020Ene','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/

/*
 Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Responsivas ADD fecha_devolucion date NULL;
*/


/*
CREATE TABLE t_Centro_Costos
(
  id_centro_costos SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	num_centro_costos VARCHAR(30) NOT NULL,
  descripcion VARCHAR(80) NOT NULL	
);
*/



/* Para agregar una columna a la tabla t_Empleados .  */
	/*
	ALTER TABLE 't_Empleados' CHANGE 'id_centro_costos' 'id_centro_costos' SMALLINT(5) UNSIGNED NOT NULL;
*/

/*
	ALTER TABLE t_Empleados ADD FOREIGN KEY(id_centro_costos) REFERENCES t_Centro_Costos(id_centro_costos) ON DELETE RESTRICT ON UPDATE CASCADE;
*/




/*
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');

INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
*/

/* Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Productos ADD stock SMALLINT UNSIGNED DEFAULT 0;
*/

/* Para agregar una columna a la tabla t_Empleados.
	ALTER TABLE t_Empleados ADD foto varchar(100) NOT NULL;
*/


/* Para agregar una columna a la tabla t_Productos . 
	ALTER TABLE t_Productos ADD especificaciones TEXT NULL ;

*/

/*
CREATE TABLE t_Cintas
(
  id_cintas SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  num_serial VARCHAR(15) NOT NULL,
  fecha_inic DATE NULL,
	fecha_final DATE NULL,
  ubicacion VARCHAR(20) NOT NULL,
	comentarios TEXT
  
);
*/




/*
INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreUno','apellidoUno','ntidUno','correoelectronicoUno','centrocostoUno','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);
*/

/*

INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),	
	(0,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),
	(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);
/*
	......
	.......
	......

(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);

*/


