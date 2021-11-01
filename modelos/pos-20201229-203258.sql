-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pos
-- ------------------------------------------------------
-- Server version	10.3.17-MariaDB

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
-- Table structure for table `t_Categoria`
--

DROP TABLE IF EXISTS `t_Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Categoria`
--

LOCK TABLES `t_Categoria` WRITE;
/*!40000 ALTER TABLE `t_Categoria` DISABLE KEYS */;
INSERT INTO `t_Categoria` VALUES (1,'Categoria 1','2020-12-04 17:52:34');
/*!40000 ALTER TABLE `t_Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Clientes`
--

DROP TABLE IF EXISTS `t_Clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `documento` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `compras` int(10) unsigned DEFAULT NULL,
  `ultima_compra` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Clientes`
--

LOCK TABLES `t_Clientes` WRITE;
/*!40000 ALTER TABLE `t_Clientes` DISABLE KEYS */;
INSERT INTO `t_Clientes` VALUES (1,'Cliente Uno',202020,'correo@email.com','(663) 399-99-99)','direccion uno','1970-10-10',1,'2020-12-04 18:08:56','2020-12-04 18:07:52');
/*!40000 ALTER TABLE `t_Clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Productos`
--

DROP TABLE IF EXISTS `t_Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(10) unsigned NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 1,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `ventas` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `t_Productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `t_Categoria` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Productos`
--

LOCK TABLES `t_Productos` WRITE;
/*!40000 ALTER TABLE `t_Productos` DISABLE KEYS */;
INSERT INTO `t_Productos` VALUES (1,1,'101','Producto 1','vistas/img/productos/101/271.png',5,10.00,13.00,NULL,'2020-12-04 18:04:07'),(2,1,'102','Producto 2','vistas/img/productos/102/995.png',9,120.00,168.00,'1','2020-12-04 18:05:31');
/*!40000 ALTER TABLE `t_Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Usuario`
--

DROP TABLE IF EXISTS `t_Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `vendedor` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` int(10) unsigned DEFAULT 0,
  `ultimo_login` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Usuario`
--

LOCK TABLES `t_Usuario` WRITE;
/*!40000 ALTER TABLE `t_Usuario` DISABLE KEYS */;
INSERT INTO `t_Usuario` VALUES (1,'Usuario Administrador','admin','7004-20','Administrador','','',1,'2020-12-06 20:19:45','2020-12-04 16:46:15'),(5,'Karina Lors','karina','$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS','Especial',NULL,'vistas/img/usuarios/karina/669.png',1,'2020-12-04 17:50:19','2020-12-04 17:50:19');
/*!40000 ALTER TABLE `t_Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_Ventas`
--

DROP TABLE IF EXISTS `t_Ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_Ventas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `id_vendedor` int(10) unsigned NOT NULL,
  `productos` text DEFAULT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `neto` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(80) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_vendedor` (`id_vendedor`),
  CONSTRAINT `t_Ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `t_Clientes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `t_Ventas_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `t_Usuario` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_Ventas`
--

LOCK TABLES `t_Ventas` WRITE;
/*!40000 ALTER TABLE `t_Ventas` DISABLE KEYS */;
INSERT INTO `t_Ventas` VALUES (1,10000,1,1,'[{\"id\":\"2\",\"descripcion\":\"Producto 2\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"168.00\",\"total\":\"168.00\"}]',16.80,168.00,184.80,'Efectivo','2020-12-04 18:08:56');
/*!40000 ALTER TABLE `t_Ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-29 20:32:58
