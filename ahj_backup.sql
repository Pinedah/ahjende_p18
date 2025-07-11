-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ahj_ende_pinedah
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `id_cit` int(11) NOT NULL AUTO_INCREMENT,
  `cit_cit` date NOT NULL DEFAULT curdate(),
  `hor_cit` time NOT NULL DEFAULT '08:00:00',
  `nom_cit` varchar(255) DEFAULT NULL,
  `tel_cit` varchar(255) DEFAULT NULL,
  `id_eje2` int(11) DEFAULT NULL,
  `eli_cit` int(11) NOT NULL DEFAULT 1 COMMENT '1=visible, 0=oculta',
  PRIMARY KEY (`id_cit`),
  KEY `id_eje2` (`id_eje2`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (1,'2025-07-03','09:00:00','EDITAR DESDE P2','555-1001',1,1),(3,'2025-07-03','14:15:00','Laura Martínez','555-1003',1,1),(4,'2025-07-03','16:45:00','Pedro Sánchez','555-1004',3,1),(7,'2025-07-03','13:15:00','Carlos Ruiz Mendoza','555-9012',3,1),(9,'2025-07-03','17:00:00','Roberto Díaz Torres','555-7890',2,1),(10,'2025-07-04','08:15:00','Elena Morales Castro','555-2468',3,1),(11,'2025-07-04','10:00:00','Fernando Vargas León','555-1357',4,1),(12,'2025-07-04','12:30:00','Patricia Herrera Vega','555-9753',1,1),(23,'2025-07-07','10:00:00','NUEVO NOMBRE PANKE','000000-111',4,0),(24,'2025-07-03','08:30:00','TEST CON HORARIO','00000-000',1,0),(25,'2025-07-03','20:30:00','TEST VIDEO AGREGAR HORARIO','555-5555',3,1),(26,'2025-07-16','19:00:00','NOMBRE','111',4,1),(37,'2025-07-05','11:11:00','panke','111',2,1),(58,'2025-07-04','11:11:00','pankenuevo','1111-111',4,0),(59,'2025-07-07','11:11:00','francisco TEST','1111-111',1,0),(60,'2025-07-07','09:00:00','test','0000',2,1),(61,'2025-07-07','08:00:00','NUEVO TEST',NULL,NULL,0),(63,'2025-07-08','08:00:00','PANKE',NULL,NULL,0),(64,'2025-07-08','11:11:00','NUEVA CITA FAXINAAR','111-111',1,0),(65,'2025-07-08','08:10:00','NUEVA CITA VIDEO CABIOOO','1111-111',4,0),(66,'2025-07-08','08:00:00','nueva cita pinedah',NULL,NULL,0),(67,'2025-07-10','10:00:00','Cita Ejecutivo 1','555-0001',1,1),(68,'2025-07-10','11:00:00','Cita Ejecutivo 2','555-0002',2,1),(69,'2025-07-10','12:00:00','Cita Ejecutivo 4','555-0004',4,1),(70,'2025-07-10','11:11:00','Citlaltzinnnnnnn','111',12,1),(71,'2025-07-10','11:11:00','citlaaaaa','000',6,1),(72,'2025-07-10','09:00:00',NULL,NULL,6,1);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejecutivo`
--

DROP TABLE IF EXISTS `ejecutivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ejecutivo` (
  `id_eje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_eje` varchar(100) NOT NULL,
  `tel_eje` varchar(15) NOT NULL,
  `eli_eje` int(11) NOT NULL DEFAULT 1 COMMENT '1=visible, 0=oculto',
  `id_padre` int(11) DEFAULT NULL COMMENT 'FK para relación jerárquica',
  `id_pla` int(11) DEFAULT NULL,
  `ult_eje` datetime DEFAULT NULL COMMENT '┌ltima fecha y hora de sesi¾n del ejecutivo',
  PRIMARY KEY (`id_eje`),
  KEY `idx_eli_eje` (`eli_eje`),
  KEY `idx_id_padre` (`id_padre`),
  KEY `idx_id_pla` (`id_pla`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejecutivo`
--

LOCK TABLES `ejecutivo` WRITE;
/*!40000 ALTER TABLE `ejecutivo` DISABLE KEYS */;
INSERT INTO `ejecutivo` VALUES (1,'Juan Carlos Pérez','555-0123',0,NULL,3,NULL),(2,'María Fernanda López','555-0456',1,7,2,'2025-07-10 13:11:53'),(4,'Francisco Pineda','11',1,11,3,'2025-07-06 17:11:53'),(5,'Ejecutivo Prueba','555-1234',1,7,2,'2025-07-08 10:11:53'),(6,'Fatima Nava','555-111',1,NULL,2,'2025-07-10 16:13:34'),(9,'Ana Garcia Silva','555-2001',1,NULL,6,'2025-07-10 15:54:13'),(10,'Luis Rodriguez','555-2002',1,1,3,'2025-07-04 14:11:53'),(11,'Carmen Morales Vega','555-2003',1,2,3,'2025-07-08 01:11:53'),(12,'Diego Herrera Luna','555-3001',1,NULL,3,'2025-07-04 04:11:53'),(13,'Sofia Mendoza','555-3002',1,14,6,'2025-07-08 05:11:53'),(14,'Pablo Jimenez','555-3003',1,15,6,'2025-07-10 16:14:07'),(15,'Elena Vargas','555-6001',1,5,6,'2025-07-04 05:11:53'),(16,'Andres Castro','555-6002',1,14,6,'2025-07-06 15:11:53'),(17,'Test Ejecutivo P14 MODIFICADO','555-8888',0,NULL,3,NULL),(18,'FRANCISCO PINEDA HERNANDEZ','111-111',1,NULL,2,NULL),(19,'EJECUTIVO FRANCISCO PINEDA HERNANDEZ','0000-000',1,12,3,'2025-07-10 16:12:47');
/*!40000 ALTER TABLE `ejecutivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_cita`
--

DROP TABLE IF EXISTS `historial_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_cita` (
  `id_his_cit` int(11) NOT NULL AUTO_INCREMENT,
  `fec_his_cit` datetime NOT NULL DEFAULT current_timestamp(),
  `res_his_cit` varchar(100) NOT NULL,
  `mov_his_cit` enum('alta','cambio','baja') NOT NULL,
  `des_his_cit` text NOT NULL,
  `id_cit11` int(11) NOT NULL,
  PRIMARY KEY (`id_his_cit`),
  KEY `idx_id_cit11` (`id_cit11`),
  KEY `idx_fec_his_cit` (`fec_his_cit`),
  CONSTRAINT `historial_cita_ibfk_1` FOREIGN KEY (`id_cit11`) REFERENCES `cita` (`id_cit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_cita`
--

LOCK TABLES `historial_cita` WRITE;
/*!40000 ALTER TABLE `historial_cita` DISABLE KEYS */;
INSERT INTO `historial_cita` VALUES (1,'2025-07-08 11:36:25','María Fernanda López','cambio','Se modificó NOM CIT de \'TEST VIDEO\' a \'NUEVO NOMBRE PANKE\' en la cita \'TEST VIDEO\'',23),(2,'2025-07-08 11:36:38','María Fernanda López','cambio','Se modificó TEL CIT de \'111-111\' a \'000000-111\' en la cita \'NUEVO NOMBRE PANKE\'',23),(3,'2025-07-08 11:38:21','Roberto González','alta','Se creó nueva cita: \'NUEVA CITA FAXINAAR\'',64),(4,'2025-07-08 11:40:36','Roberto González','cambio','Se modificó HOR CIT de \'08:00:00\' a \'11:11\' en la cita \'NUEVA CITA FAXINAAR\'',64),(5,'2025-07-08 11:40:41','Roberto González','cambio','Se modificó TEL CIT de \'(vacío)\' a \'111-111\' en la cita \'NUEVA CITA FAXINAAR\'',64),(6,'2025-07-08 11:40:41','Juan Carlos Pérez','cambio','Se modificó ID EJE2 de \'(vacío)\' a \'1\' en la cita \'NUEVA CITA FAXINAAR\'',64),(7,'2025-07-08 12:14:55','Roberto González','baja','Se eliminó (ocultó) la cita \'NUEVA CITA FAXINAAR\'',64),(8,'2025-07-08 12:52:59','María Fernanda López','baja','Se eliminó (ocultó) la cita \'NUEVO NOMBRE PANKE\'',23),(9,'2025-07-08 15:53:10','Ejecutivo Prueba','alta','Se creó nueva cita: \'NUEVA CITA VIDEO\'',65),(10,'2025-07-08 15:53:10','Francisco Pineda','cambio','Se modificó ID EJE2 de \'(vacío)\' a \'4\' en la cita \'NUEVA CITA VIDEO\'',65),(11,'2025-07-08 15:53:15','María Fernanda López','cambio','Se modificó HOR CIT de \'08:00:00\' a \'8:10\' en la cita \'NUEVA CITA VIDEO\'',65),(12,'2025-07-08 15:53:43','Francisco Pineda','cambio','Se modificó NOM CIT de \'NUEVA CITA VIDEO\' a \'NUEVA CITA VIDEO CABIOOO\' en la cita \'NUEVA CITA VIDEO\'',65),(13,'2025-07-08 15:54:09','Juan Carlos Pérez','alta','Se creó nueva cita: \'nueva cita pinedah\'',66),(14,'2025-07-08 15:54:25','María Fernanda López','baja','Se eliminó (ocultó) la cita \'NUEVA CITA VIDEO CABIOOO\'',65),(15,'2025-07-08 15:55:07','Fatima Nava','baja','Se eliminó (ocultó) la cita \'nueva cita pinedah\'',66),(16,'2025-07-08 15:55:39','Roberto Gonzálezzzzzz','baja','Se eliminó (ocultó) la cita \'TEST CON HORARIO\'',24),(17,'2025-07-10 14:12:46','Juan Carlos Pérez','alta','Se creó nueva cita: \'Citlaltzinnnnnnn\'',70),(18,'2025-07-10 14:12:47','Luis Rodriguez','cambio','Se modificó ID EJE2 de \'(vacío)\' a \'12\' en la cita \'Citlaltzinnnnnnn\'',70),(19,'2025-07-10 14:12:52','Carmen Morales Vega','cambio','Se modificó HOR CIT de \'08:00:00\' a \'11:11\' en la cita \'Citlaltzinnnnnnn\'',70),(20,'2025-07-10 14:13:14','Ejecutivo Prueba','alta','Se creó nueva cita: \'citlaaaaa\'',71),(21,'2025-07-10 14:13:37','Francisco Pineda','alta','Se creó nueva cita: \'Sin nombre\'',72),(22,'2025-07-10 14:13:48','Elena Vargas','cambio','Se modificó ID EJE2 de \'(vacío)\' a \'6\' en la cita \'citlaaaaa\'',71);
/*!40000 ALTER TABLE `historial_cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_ejecutivo`
--

DROP TABLE IF EXISTS `historial_ejecutivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_ejecutivo` (
  `id_his_eje` int(11) NOT NULL AUTO_INCREMENT,
  `fec_his_eje` datetime NOT NULL DEFAULT current_timestamp(),
  `res_his_eje` varchar(100) NOT NULL,
  `mov_his_eje` enum('alta','cambio','baja') NOT NULL,
  `des_his_eje` text NOT NULL,
  `id_eje11` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_his_eje`),
  KEY `idx_id_eje11` (`id_eje11`),
  KEY `idx_fec_his_eje` (`fec_his_eje`),
  CONSTRAINT `historial_ejecutivo_ibfk_1` FOREIGN KEY (`id_eje11`) REFERENCES `ejecutivo` (`id_eje`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_ejecutivo`
--

LOCK TABLES `historial_ejecutivo` WRITE;
/*!40000 ALTER TABLE `historial_ejecutivo` DISABLE KEYS */;
INSERT INTO `historial_ejecutivo` VALUES (1,'2025-07-10 14:32:38','Test Ejecutivo P14','alta','Se creó nuevo ejecutivo: \'Test Ejecutivo P14\'',17),(2,'2025-07-10 14:33:22','Test Ejecutivo P14 MODIFICADO','cambio','Se modificó NOM_EJE de \'Test Ejecutivo P14\' a \'Test Ejecutivo P14 MODIFICADO\', TEL_EJE de \'555-9999\' a \'555-8888\', ID_PLA de \'3\' a \'2\' en el ejecutivo \'Test Ejecutivo P14 MODIFICADO\'',17),(3,'2025-07-10 14:34:28','Test Ejecutivo P14 MODIFICADO','baja','Se ocultó el ejecutivo \'Test Ejecutivo P14 MODIFICADO\'',17),(4,'2025-07-08 10:00:00','Sistema','alta','Se cre¾ nuevo ejecutivo: Juan Carlos PÚrez',1),(5,'2025-07-08 11:30:00','MarÝa Fernanda L¾pez','cambio','Se modific¾ TEL_EJE de 555-0123 a 555-0124 en el ejecutivo Juan Carlos PÚrez',1),(6,'2025-07-08 12:00:00','Roberto Gonzßlez','baja','Se ocult¾ el ejecutivo Juan Carlos PÚrez',1),(7,'2025-07-09 08:00:00','Sistema','alta','Se cre¾ nuevo ejecutivo: MarÝa Fernanda L¾pez',2),(8,'2025-07-09 14:20:00','Francisco Pineda','cambio','Se modific¾ NOM_EJE de MarÝa L¾pez a MarÝa Fernanda L¾pez en el ejecutivo MarÝa Fernanda L¾pez',2),(9,'2025-07-10 14:50:24','Francisco Pineda','cambio','Se modificó TEL_EJE de \'555-0789\' a \'11\', ELI_EJE de \'inactivo\' a \'activo\' en el ejecutivo \'Francisco Pineda\'',4),(10,'2025-07-10 16:05:04','Nuevo ejecutivo','alta','Se creó nuevo ejecutivo: \'Nuevo ejecutivo\'',18),(11,'2025-07-10 16:06:37','FRANCISCO PINEDA HERNANDEZ','cambio','Se modificó NOM_EJE de \'Nuevo ejecutivo\' a \'FRANCISCO PINEDA HERNANDEZ\', TEL_EJE de \'000000\' a \'111-111\', ID_PLA de \'6\' a \'3\' en el ejecutivo \'FRANCISCO PINEDA HERNANDEZ\'',18),(12,'2025-07-10 16:08:02','EJECUTIVO PINEDA','alta','Se creó nuevo ejecutivo: \'EJECUTIVO PINEDA\'',19),(13,'2025-07-10 16:08:40','EJECUTIVO FRANCISCO PINEDA HERNANDEZ','cambio','Se modificó NOM_EJE de \'EJECUTIVO PINEDA\' a \'EJECUTIVO FRANCISCO PINEDA HERNANDEZ\', TEL_EJE de \'0000\' a \'111-111\' en el ejecutivo \'EJECUTIVO FRANCISCO PINEDA HERNANDEZ\'',19),(14,'2025-07-10 16:09:09','EJECUTIVO FRANCISCO PINEDA HERNANDEZ','cambio','Se modificó TEL_EJE de \'111-111\' a \'0000-000\' en el ejecutivo \'EJECUTIVO FRANCISCO PINEDA HERNANDEZ\'',19);
/*!40000 ALTER TABLE `historial_ejecutivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantel`
--

DROP TABLE IF EXISTS `plantel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plantel` (
  `id_pla` int(11) NOT NULL,
  `nom_pla` varchar(100) NOT NULL,
  `fec_pla` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantel`
--

LOCK TABLES `plantel` WRITE;
/*!40000 ALTER TABLE `plantel` DISABLE KEYS */;
INSERT INTO `plantel` VALUES (2,'Plantel Naucalpan','2025-07-09 10:52:31'),(3,'Plantel Ecatepec','2025-07-09 10:52:31'),(6,'Plantel Cuautitlán','2025-07-09 10:52:31');
/*!40000 ALTER TABLE `plantel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planteles_ejecutivo`
--

DROP TABLE IF EXISTS `planteles_ejecutivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planteles_ejecutivo` (
  `id_pla_eje` int(11) NOT NULL AUTO_INCREMENT,
  `fec_pla_eje` datetime DEFAULT current_timestamp(),
  `id_pla` int(11) NOT NULL,
  `id_eje` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_pla_eje`),
  UNIQUE KEY `unique_plantel_ejecutivo` (`id_pla`,`id_eje`),
  KEY `fk_planteles_ejecutivo_ejecutivo` (`id_eje`),
  CONSTRAINT `fk_planteles_ejecutivo_ejecutivo` FOREIGN KEY (`id_eje`) REFERENCES `ejecutivo` (`id_eje`) ON DELETE CASCADE,
  CONSTRAINT `fk_planteles_ejecutivo_plantel` FOREIGN KEY (`id_pla`) REFERENCES `plantel` (`id_pla`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planteles_ejecutivo`
--

LOCK TABLES `planteles_ejecutivo` WRITE;
/*!40000 ALTER TABLE `planteles_ejecutivo` DISABLE KEYS */;
INSERT INTO `planteles_ejecutivo` VALUES (1,'2025-07-10 13:17:59',2,1),(2,'2025-07-10 13:17:59',6,1),(3,'2025-07-10 13:17:59',3,2),(4,'2025-07-10 13:17:59',6,2),(5,'2025-07-10 13:17:59',2,4),(6,'2025-07-10 13:17:59',3,4),(7,'2025-07-10 13:17:59',6,4),(8,'2025-07-10 15:53:05',6,9),(9,'2025-07-10 15:53:18',3,9),(10,'2025-07-10 16:15:11',3,6),(11,'2025-07-10 16:15:24',6,6),(12,'2025-07-10 16:15:35',2,6);
/*!40000 ALTER TABLE `planteles_ejecutivo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-10 16:21:22
