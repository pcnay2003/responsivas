-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bd_responsivas
-- ------------------------------------------------------
-- Server version	10.3.25-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_Almacen`
--
/* DROP DATABASE IF EXISTS bd_responsivas; */


DROP TABLE IF EXISTS `t_Almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Almacen` (
  `id_almacen` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id_almacen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Almacen`
--

LOCK TABLES `t_Almacen` WRITE;
/*!40000 ALTER TABLE `t_Almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Depto`
--

DROP TABLE IF EXISTS `t_Depto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Depto` (
  `id_depto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Depto`
--

LOCK TABLES `t_Depto` WRITE;
/*!40000 ALTER TABLE `t_Depto` DISABLE KEYS */;
INSERT INTO `t_Depto` VALUES (1,'Depto 1'),(4,'Depto2'),(5,'Depto3'),(6,'DeptoCuatro'),(7,'DeptoCinco');
/*!40000 ALTER TABLE `t_Depto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Edo_epo`
--

DROP TABLE IF EXISTS `t_Edo_epo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Edo_epo` (
  `id_edo_epo` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id_edo_epo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Edo_epo`
--

LOCK TABLES `t_Edo_epo` WRITE;
/*!40000 ALTER TABLE `t_Edo_epo` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Edo_epo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Empleados`
--

DROP TABLE IF EXISTS `t_Empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Empleados` (
  `id_empleado` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_ubicacion` smallint(5) unsigned NOT NULL,
  `id_puesto` smallint(5) unsigned NOT NULL,
  `id_supervisor` smallint(5) unsigned NOT NULL,
  `id_depto` smallint(5) unsigned NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `ntid` varchar(20) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `centro_costos` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `id_ubicacion` (`id_ubicacion`),
  KEY `id_puesto` (`id_puesto`),
  KEY `id_supervisor` (`id_supervisor`),
  KEY `id_depto` (`id_depto`),
  CONSTRAINT `t_Empleados_ibfk_1` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_Ubicacion` (`id_ubicacion`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_2` FOREIGN KEY (`id_puesto`) REFERENCES `t_Puesto` (`id_puesto`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_3` FOREIGN KEY (`id_supervisor`) REFERENCES `t_Supervisor` (`id_supervisor`) ON UPDATE CASCADE,
  CONSTRAINT `t_Empleados_ibfk_4` FOREIGN KEY (`id_depto`) REFERENCES `t_Depto` (`id_depto`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Empleados`
--

LOCK TABLES `t_Empleados` WRITE;
/*!40000 ALTER TABLE `t_Empleados` DISABLE KEYS */;
INSERT INTO `t_Empleados` VALUES (3,1,1,1,1,'nombreUno','apellidoUno','ntidUno','correoelectronicoUno','centrocostoUno','2020-10-27 05:12:25','vistas/img/productos/default/anonymous.png'),(4,1,1,1,1,'Princesa','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','2020-10-27 05:16:08','vistas/img/productos/default/anonymous.png'),(5,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','2020-10-27 05:16:08','vistas/img/productos/default/anonymous.png'),(6,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:16:08','vistas/img/productos/default/anonymous.png'),(7,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','2020-10-27 05:17:52','vistas/img/productos/default/anonymous.png'),(8,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','2020-10-27 05:17:52','vistas/img/productos/default/anonymous.png'),(9,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:17:52','vistas/img/productos/default/anonymous.png'),(10,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(11,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(12,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(13,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(14,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(15,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(16,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(17,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(18,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(19,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(20,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(21,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(22,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(23,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(24,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(25,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(26,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(27,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(28,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(29,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(30,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(31,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(32,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(33,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(34,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(35,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(36,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(37,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(38,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(39,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(40,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(41,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(42,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(43,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(44,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(45,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(46,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(47,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(48,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(49,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(50,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(51,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(52,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(53,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(54,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:05','vistas/img/productos/default/anonymous.png'),(55,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(56,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(57,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(58,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(59,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(60,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(61,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(62,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(63,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(64,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(65,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(66,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(67,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(68,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(69,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(70,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(71,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(72,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(73,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(74,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(75,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(76,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(77,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(78,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(79,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(80,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(81,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(82,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(83,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(84,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(85,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(86,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(87,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(88,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(89,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(90,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(91,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(92,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(93,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(94,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(95,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(96,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(97,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(98,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(99,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:38','vistas/img/productos/default/anonymous.png'),(100,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(101,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(102,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(103,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(104,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(105,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(106,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(107,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(108,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(109,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(110,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(111,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(112,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(113,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(114,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(115,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(116,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(117,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(118,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(119,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(120,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(121,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(122,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(123,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(124,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(125,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(126,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(127,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(128,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(129,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(130,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(131,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(132,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(133,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(134,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(135,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(136,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(137,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(138,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(139,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(140,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(141,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(142,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(143,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(144,1,2,2,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','2020-10-27 05:19:45','vistas/img/productos/default/anonymous.png'),(145,1,1,1,1,'NombreUno','ApellidoUno','ntidUno','correoelectronicoUno','CentroCostoUno','2020-11-02 21:24:48','vistas/img/empleados/default/anonymous.png'),(146,3,1,3,1,'nombreOct','apellidoOct','ntidOct','correoOctu','centroCostoOct','2020-11-02 21:28:26','vistas/img/empleados/default/anonymous.png'),(147,3,1,1,5,'nombreOctDos','ApellidosOctDos','ntidOctDos','correoOctDos','centroCostoOctDos','2020-11-02 21:37:16','vistas/img/empleados/default/anonymous.png'),(149,2,1,3,5,'nombreNovUno','ApellidosNovUno','ntidNovUno','correoNovUno','CentroNovUno','2020-11-03 20:55:08','vistas/img/empleados/ApellidosNovUno/836.png'),(150,2,1,3,5,'nombreNovDos','ApellidosNovDos','ntidNovDos','correoNovDos','CentroNovDos','2020-11-03 20:59:39','vistas/img/empleados/ApellidosNovDos/595.png');
/*!40000 ALTER TABLE `t_Empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Idf`
--

DROP TABLE IF EXISTS `t_Idf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Idf` (
  `id_idf` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_patch_panel` smallint(5) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_idf`),
  KEY `id_patch_panel` (`id_patch_panel`),
  CONSTRAINT `t_Idf_ibfk_1` FOREIGN KEY (`id_patch_panel`) REFERENCES `t_Patch_panel` (`id_patch_panel`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Idf`
--

LOCK TABLES `t_Idf` WRITE;
/*!40000 ALTER TABLE `t_Idf` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Idf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Marca`
--

DROP TABLE IF EXISTS `t_Marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Marca` (
  `id_marca` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Marca`
--

LOCK TABLES `t_Marca` WRITE;
/*!40000 ALTER TABLE `t_Marca` DISABLE KEYS */;
INSERT INTO `t_Marca` VALUES (1,'Dell'),(3,'Hewlett Packard'),(4,'Ciscos'),(5,'Tp Link');
/*!40000 ALTER TABLE `t_Marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Modelo`
--

DROP TABLE IF EXISTS `t_Modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Modelo` (
  `id_modelo` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_modelo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Modelo`
--

LOCK TABLES `t_Modelo` WRITE;
/*!40000 ALTER TABLE `t_Modelo` DISABLE KEYS */;
INSERT INTO `t_Modelo` VALUES (1,'cnc-3040878'),(2,'cnc-3040');
/*!40000 ALTER TABLE `t_Modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Patch_panel`
--

DROP TABLE IF EXISTS `t_Patch_panel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Patch_panel` (
  `id_patch_panel` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_puerto` smallint(5) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_patch_panel`),
  KEY `id_puerto` (`id_puerto`),
  CONSTRAINT `t_Patch_panel_ibfk_1` FOREIGN KEY (`id_puerto`) REFERENCES `t_Puerto` (`id_puerto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Patch_panel`
--

LOCK TABLES `t_Patch_panel` WRITE;
/*!40000 ALTER TABLE `t_Patch_panel` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Patch_panel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Periferico`
--

DROP TABLE IF EXISTS `t_Periferico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Periferico` (
  `id_periferico` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_periferico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Periferico`
--

LOCK TABLES `t_Periferico` WRITE;
/*!40000 ALTER TABLE `t_Periferico` DISABLE KEYS */;
INSERT INTO `t_Periferico` VALUES (1,'Teclado','2020-10-04 03:04:17'),(2,'Ratones','2020-10-04 03:07:54'),(5,'Disco Duro','2020-10-05 22:47:36');
/*!40000 ALTER TABLE `t_Periferico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Planta`
--

DROP TABLE IF EXISTS `t_Planta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Planta` (
  `id_planta` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_planta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Planta`
--

LOCK TABLES `t_Planta` WRITE;
/*!40000 ALTER TABLE `t_Planta` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Planta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Productos`
--

DROP TABLE IF EXISTS `t_Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Productos` (
  `id_producto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_almacen` smallint(5) unsigned NOT NULL,
  `id_edo_epo` smallint(5) unsigned NOT NULL,
  `id_marca` smallint(5) unsigned NOT NULL,
  `id_modelo` smallint(5) unsigned NOT NULL,
  `id_idf` smallint(5) unsigned NOT NULL,
  `id_patch_panel` smallint(5) unsigned NOT NULL,
  `id_puerto` smallint(5) unsigned NOT NULL,
  `id_periferico` smallint(5) unsigned NOT NULL,
  `nomenclatura` varchar(45) NOT NULL,
  `num_serie` varchar(45) NOT NULL,
  `imagen_producto` varchar(100) NOT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `cuantas_veces` tinyint(4) DEFAULT NULL,
  `fecha_arribo` datetime NOT NULL DEFAULT current_timestamp(),
  `comentarios` text DEFAULT NULL,
  `especificaciones` text DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_almacen` (`id_almacen`),
  KEY `id_edo_epo` (`id_edo_epo`),
  KEY `id_marca` (`id_marca`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_idf` (`id_idf`),
  KEY `id_patch_panel` (`id_patch_panel`),
  KEY `id_puerto` (`id_puerto`),
  KEY `id_periferico` (`id_periferico`),
  CONSTRAINT `t_Productos_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `t_Almacen` (`id_almacen`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_2` FOREIGN KEY (`id_edo_epo`) REFERENCES `t_Edo_epo` (`id_edo_epo`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `t_Marca` (`id_marca`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_4` FOREIGN KEY (`id_modelo`) REFERENCES `t_Modelo` (`id_modelo`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_5` FOREIGN KEY (`id_idf`) REFERENCES `t_Idf` (`id_idf`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_6` FOREIGN KEY (`id_patch_panel`) REFERENCES `t_Patch_panel` (`id_patch_panel`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_7` FOREIGN KEY (`id_puerto`) REFERENCES `t_Puerto` (`id_puerto`) ON UPDATE CASCADE,
  CONSTRAINT `t_Productos_ibfk_8` FOREIGN KEY (`id_periferico`) REFERENCES `t_Periferico` (`id_periferico`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Productos`
--

LOCK TABLES `t_Productos` WRITE;
/*!40000 ALTER TABLE `t_Productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Puerto`
--

DROP TABLE IF EXISTS `t_Puerto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Puerto` (
  `id_puerto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_puerto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Puerto`
--

LOCK TABLES `t_Puerto` WRITE;
/*!40000 ALTER TABLE `t_Puerto` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Puerto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Puesto`
--

DROP TABLE IF EXISTS `t_Puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Puesto` (
  `id_puesto` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Puesto`
--

LOCK TABLES `t_Puesto` WRITE;
/*!40000 ALTER TABLE `t_Puesto` DISABLE KEYS */;
INSERT INTO `t_Puesto` VALUES (1,'Casas'),(2,'puesto'),(11,'PuestoDos'),(12,'PuestoTres'),(13,'PuestoCuatro');
/*!40000 ALTER TABLE `t_Puesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Responsivas`
--

DROP TABLE IF EXISTS `t_Responsivas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Responsivas` (
  `id_responsiva` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_planta` smallint(5) unsigned NOT NULL,
  `id_empleado` smallint(5) unsigned NOT NULL,
  `id_producto` smallint(5) unsigned NOT NULL,
  `id_usuario` smallint(5) unsigned NOT NULL,
  `id_ubicacion` smallint(5) unsigned NOT NULL,
  `num_folio` varchar(45) NOT NULL,
  `prestamo` char(1) NOT NULL,
  `responsiva_firmada` varchar(100) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `devolucion` text DEFAULT NULL,
  `fecha_asignado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_responsiva`),
  KEY `id_planta` (`id_planta`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_producto` (`id_producto`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_ubicacion` (`id_ubicacion`),
  CONSTRAINT `t_Responsivas_ibfk_1` FOREIGN KEY (`id_planta`) REFERENCES `t_Planta` (`id_planta`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `t_Empleados` (`id_empleado`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `t_Productos` (`id_producto`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `t_Usuarios` (`id_usuario`) ON UPDATE CASCADE,
  CONSTRAINT `t_Responsivas_ibfk_5` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_Ubicacion` (`id_ubicacion`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Responsivas`
--

LOCK TABLES `t_Responsivas` WRITE;
/*!40000 ALTER TABLE `t_Responsivas` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_Responsivas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Supervisor`
--

DROP TABLE IF EXISTS `t_Supervisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Supervisor` (
  `id_supervisor` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supervisor`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Supervisor`
--

LOCK TABLES `t_Supervisor` WRITE;
/*!40000 ALTER TABLE `t_Supervisor` DISABLE KEYS */;
INSERT INTO `t_Supervisor` VALUES (1,'Supervisor 1111'),(2,'Supervisor 3'),(3,'supervisor 3'),(4,'supervisor'),(11,'SupervisorDos'),(12,'SupervisorTres'),(13,'SupervisorCuatro');
/*!40000 ALTER TABLE `t_Supervisor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Ubicacion`
--

DROP TABLE IF EXISTS `t_Ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Ubicacion` (
  `id_ubicacion` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Ubicacion`
--

LOCK TABLES `t_Ubicacion` WRITE;
/*!40000 ALTER TABLE `t_Ubicacion` DISABLE KEYS */;
INSERT INTO `t_Ubicacion` VALUES (1,'RH seccion 3'),(2,'rh seccion 3'),(3,'rh seccion 3'),(4,'rh'),(7,'UbicacionUno'),(8,'UbicacionDos'),(9,'UbicacionTres'),(10,'UbicacionCuatro');
/*!40000 ALTER TABLE `t_Ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Usuarios`
--

DROP TABLE IF EXISTS `t_Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Usuarios` (
  `id_usuario` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `vendedor` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` tinyint(3) unsigned DEFAULT 0,
  `ultimo_login` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Usuarios`
--

LOCK TABLES `t_Usuarios` WRITE;
/*!40000 ALTER TABLE `t_Usuarios` DISABLE KEYS */;
INSERT INTO `t_Usuarios` VALUES (1,'Usuario Administrador','admin','1234','Administrador','','vistas/img/usuarios/admin/697.png',1,'2020-11-09 19:54:36','2020-09-28 23:11:57'),(3,'Pedro Solis Sanchez','pedro','$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2','Vendedor',NULL,'vistas/img/usuarios/pedro/213.jpg',1,'2020-09-29 17:45:43','2020-09-29 22:34:08'),(4,'Francisco Romero','fco','$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS','Especial',NULL,'vistas/img/usuarios/fco/845.jpg',1,'2020-09-29 17:44:56','2020-09-29 22:36:26'),(5,'Ana Gonzalez','ana','$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2','Vendedor',NULL,'vistas/img/usuarios/ana/397.jpg',1,'2020-10-01 04:00:16','2020-10-01 04:00:16');
/*!40000 ALTER TABLE `t_Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-10  4:45:40
