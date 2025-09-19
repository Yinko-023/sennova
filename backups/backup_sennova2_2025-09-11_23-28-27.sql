-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sennova2
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
-- Table structure for table `archives`
--

DROP TABLE IF EXISTS `archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archives` (
  `id_archives` int(11) NOT NULL AUTO_INCREMENT,
  `Tittle_ar` varchar(100) NOT NULL,
  `description_ar` varchar(200) NOT NULL,
  `type_ar` varchar(50) NOT NULL,
  `date_publi_ar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ruta_ar` varchar(200) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `descargable` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id_archives`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archives`
--

LOCK TABLES `archives` WRITE;
/*!40000 ALTER TABLE `archives` DISABLE KEYS */;
INSERT INTO `archives` VALUES (1,'conocenos','conocenos','excel','2025-06-27 21:17:07','public/archivos/1750264766_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(2,'yinko','yinko','word','2025-06-27 21:17:11','public/archivos/1750265026_acata produccion academica (1) (1).docx','acata produccion academica (1) (1).docx',1,0,1),(3,'xd','xd','word','2025-06-27 21:17:16','public/archivos/1750265099_acata produccion academica (1) (1).docx','acata produccion academica (1) (1).docx',1,0,1),(4,'ss','ss','pdf','2025-06-27 21:17:19','public/archivos/1750265560_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(5,'aa','aa','pdf','2025-06-27 21:17:23','public/archivos/1750265604_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(6,'as','as','ppt','2025-06-27 21:17:26','public/archivos/1750265658_SGPS-12485-2024 Evaluacion dietas.pdf','SGPS-12485-2024 Evaluacion dietas.pdf',1,0,1),(7,'Programacion','Como programador de software, puedes enfrentarte a varios tipos de riesgos en tu trabajo. Aquí hay una clasificación general de algunos riesgos comunes','word','2025-06-26 02:27:42','public/archivos/1750879662_GOR-F-084FormatodeActaV02.docx','GOR-F-084FormatodeActaV02.docx',4,0,1),(12,'sadasd','sadas','word','2025-07-24 21:49:49','public/archivos/1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls',34,0,1),(13,'celular','celulares pro malos y buenos','word','2025-08-06 22:32:07','public/archivos/1754494327_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx',17,0,1);
/*!40000 ALTER TABLE `archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivos`
--

DROP TABLE IF EXISTS `archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivos` (
  `id_ar` int(11) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `ruta_ar` varchar(255) NOT NULL,
  `type_ar` varchar(50) DEFAULT NULL,
  `extension_ar` varchar(10) DEFAULT NULL,
  `origen_ar` varchar(100) NOT NULL,
  `Date_Subi_ar` datetime DEFAULT current_timestamp(),
  `deleted_ar` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_ar`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivos`
--

LOCK TABLES `archivos` WRITE;
/*!40000 ALTER TABLE `archivos` DISABLE KEYS */;
INSERT INTO `archivos` VALUES (1,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/688923af7ab2c_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','default','2025-07-29 14:40:31',0),(2,'1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','public/archivos/688923b61c71a_1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','application/vnd.ms-excel','xls','default','2025-07-29 14:40:38',0),(3,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/688923bf9761e_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','default','2025-07-29 14:40:47',0),(4,'programacion.jpg','public/archivos/688923ca00a39_programacion.jpg','image/jpeg','jpg','default','2025-07-29 14:40:58',1),(5,'xd_Nero_AI_Image_Upscaler_Photo_Face.png','public/archivos/6889270d73504_xd_Nero_AI_Image_Upscaler_Photo_Face.png','image/png','png','default','2025-07-29 14:54:53',0),(6,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/688934e620797_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','ges','2025-07-29 15:53:58',0),(7,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/688935126dfa5_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','estra','2025-07-29 15:54:42',0),(8,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx','public/archivos/68893656ec17a_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx','application/vnd.openxmlformats-officedocument.word','docx','as','2025-07-29 16:00:06',0),(9,'Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','public/archivos/6889365a6dcdd_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','application/vnd.ms-excel','xls','as','2025-07-29 16:00:10',0),(10,'Acuerdo 010.pdf','public/archivos/6889366210e97_Acuerdo 010.pdf','application/pdf','pdf','as','2025-07-29 16:00:18',0),(11,'xd_Nero_AI_Image_Upscaler_Photo_Face.png','public/archivos/688936697df46_xd_Nero_AI_Image_Upscaler_Photo_Face.png','image/png','png','as','2025-07-29 16:00:25',0),(12,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/688937a1e8277_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','dsfsdfsd','2025-07-29 16:05:37',0),(13,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/6889386e0f242_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','ges','2025-07-29 16:09:02',0),(14,'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','public/archivos/688947abf24f2_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','application/vnd.openxmlformats-officedocument.word','docx','xd','2025-07-29 17:14:03',1),(15,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/6889481c46697_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','xd','2025-07-29 17:15:57',1),(16,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/68894b0313889_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','sa','2025-07-29 17:28:19',1),(17,'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','public/archivos/68894b1385e1d_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','application/vnd.openxmlformats-officedocument.word','docx','sas','2025-07-29 17:28:35',1),(18,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/68894d5e1ff9c_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','dx','2025-07-29 17:38:22',0),(60,'INFORME MENSUAL 2025.pdf','public/archivos/1755787633_ce274fe8_INFORME MENSUAL 2025.pdf','application/pdf','pdf','re1','2025-08-21 09:47:13',0),(61,'Captura de pantalla 2025-07-31 084316.png','public/archivos/1755787642_036717f7_Captura de pantalla 2025-07-31 084316.png','image/png','png','re1','2025-08-21 09:47:22',0),(62,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/1755787648_31847220_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','re1','2025-08-21 09:47:28',0);
/*!40000 ALTER TABLE `archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditoria_cambios`
--

DROP TABLE IF EXISTS `auditoria_cambios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditoria_cambios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_cambios`
--

LOCK TABLES `auditoria_cambios` WRITE;
/*!40000 ALTER TABLE `auditoria_cambios` DISABLE KEYS */;
INSERT INTO `auditoria_cambios` VALUES (101,'17','Subió un archivo: image.png','2025-07-30 16:05:57'),(102,'17','Creó una copia de seguridad: backup_2025-08-06_15-16-24.sql','2025-08-06 08:16:24'),(103,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql','2025-08-06 08:42:25'),(104,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql','2025-08-06 08:42:55'),(105,'17','Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf','2025-08-06 08:43:15'),(106,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql','2025-08-06 08:43:26'),(107,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql','2025-08-06 08:43:57'),(108,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql','2025-08-06 08:44:05'),(109,'17','Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf','2025-08-06 08:44:43'),(110,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql','2025-08-06 08:44:59'),(111,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql','2025-08-06 08:45:34'),(112,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql','2025-08-06 08:51:10'),(113,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql','2025-08-06 08:51:12'),(114,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql','2025-08-06 08:51:28'),(115,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql','2025-08-06 08:52:22'),(116,'17','Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf','2025-08-06 08:52:38'),(117,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql','2025-08-06 08:52:45'),(118,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql','2025-08-06 08:53:18'),(119,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql','2025-08-06 08:57:36'),(120,'17','Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf','2025-08-06 08:58:04'),(121,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql','2025-08-06 08:58:10'),(122,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql','2025-08-06 09:09:44'),(123,'17','Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf','2025-08-06 09:10:12'),(124,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_16-10-27.sql','2025-08-06 09:11:02'),(125,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-06_16-11-03.sql','2025-08-06 09:17:04'),(126,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-06_16-17-05.sql','2025-08-06 09:19:27'),(127,'17','Creó una copia de seguridad: backup_sennova2_2025-08-06_18-18-18.sql','2025-08-06 11:18:18'),(128,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-05-32.sql','2025-08-06 17:05:32'),(129,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-00-17.sql','2025-08-06 17:05:40'),(130,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-05-32.sql','2025-08-06 17:05:43'),(131,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-07_00-08-22.sql','2025-08-06 17:08:41'),(132,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-08-22.sql','2025-08-06 17:14:10'),(133,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-14-11.sql','2025-08-06 17:14:11'),(134,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-26.sql','2025-08-06 17:33:27'),(135,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-29.sql','2025-08-06 17:33:29'),(136,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-30.sql','2025-08-06 17:33:30'),(137,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-14-11.sql','2025-08-06 17:33:32'),(138,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-26.sql','2025-08-06 17:33:36'),(139,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-29.sql','2025-08-06 17:33:42'),(140,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-30.sql','2025-08-06 17:33:43'),(141,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-36-48.sql','2025-08-06 17:36:48'),(142,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-36-48.sql','2025-08-06 17:41:19'),(143,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-41-20.sql','2025-08-06 17:41:20'),(144,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-41-20.sql','2025-08-06 17:43:25'),(145,'17','Restauró la copia de seguridad: backup_sennova2_2025-08-07_00-43-25.sql','2025-08-06 17:43:45'),(146,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-43-25.sql','2025-08-06 17:43:57'),(147,'17','Creó una copia de seguridad: backup_sennova2_2025-08-07_00-44-30.sql','2025-08-06 17:44:30'),(148,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-44-30.sql','2025-08-08 08:53:22'),(149,'17','Creó una copia de seguridad: backup_sennova2_2025-08-08_15-53-23.sql','2025-08-08 08:53:23'),(150,'17','Creó una copia de seguridad: backup_sennova2_2025-08-12_22-05-05.sql','2025-08-12 15:05:05'),(151,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-12_22-05-05.sql','2025-08-14 11:16:03'),(152,'17','Creó una copia de seguridad: backup_sennova2_2025-08-14_18-16-05.sql','2025-08-14 11:16:05'),(153,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-14_18-16-05.sql','2025-08-26 12:12:03'),(154,'17','Creó una copia de seguridad: backup_sennova2_2025-08-26_19-12-05.sql','2025-08-26 12:12:05'),(155,'17','Eliminó la copia de seguridad: backup_sennova2_2025-08-26_19-12-05.sql','2025-09-02 14:05:57'),(156,'17','Creó una copia de seguridad: backup_sennova2_2025-09-02_21-05-58.sql','2025-09-02 14:05:58'),(157,'17','Eliminó la copia de seguridad: backup_sennova2_2025-09-02_21-05-58.sql','2025-09-11 16:28:26');
/*!40000 ALTER TABLE `auditoria_cambios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrusel`
--

DROP TABLE IF EXISTS `carrusel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrusel` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `name_img_c` varchar(255) NOT NULL,
  `title_carr` varchar(255) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_car`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrusel`
--

LOCK TABLES `carrusel` WRITE;
/*!40000 ALTER TABLE `carrusel` DISABLE KEYS */;
INSERT INTO `carrusel` VALUES (8,'Café y Cacao con Ciencia y Sabor','img/H.png','2025-07-31 20:42:21'),(9,'Transformando el Futuro','img/E.png','2025-07-31 20:42:40'),(13,'Tecnologías que enciendes ideas','img/011Z.jpg','2025-07-31 22:34:44'),(16,'Educación con Tecnología','img/014WhatsApp Image 2025-06-13 at 11.53.28 AM.jpeg','2025-08-05 15:29:08'),(17,'Innovación Y Competitividad','img/017prueba5.jpg','2025-08-05 16:03:30');
/*!40000 ALTER TABLE `carrusel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eva_resp_eva`
--

DROP TABLE IF EXISTS `eva_resp_eva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eva_resp_eva` (
  `id_er_eva` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `evaluacion_id_eva` int(10) unsigned NOT NULL,
  `codigo_er_eva` varchar(10) NOT NULL,
  `valor_er_eva` enum('SI','NO','NA') NOT NULL,
  PRIMARY KEY (`id_er_eva`),
  KEY `evaluacion_id_eva` (`evaluacion_id_eva`),
  CONSTRAINT `fk_eva_resp_evaluacion_eva` FOREIGN KEY (`evaluacion_id_eva`) REFERENCES `evaluaciones_eva` (`id_eva`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eva_resp_eva`
--

LOCK TABLES `eva_resp_eva` WRITE;
/*!40000 ALTER TABLE `eva_resp_eva` DISABLE KEYS */;
INSERT INTO `eva_resp_eva` VALUES (1,1,'1.1','SI'),(2,1,'1.2','SI'),(3,1,'1.3','SI'),(4,1,'1.4','SI'),(5,1,'2.1','NO'),(6,1,'2.2','NO'),(7,1,'2.3','SI'),(8,1,'2.4','SI'),(9,1,'2.5','NA'),(10,1,'2.6','NA'),(11,1,'2.7','NO'),(12,1,'2.8','SI'),(13,1,'2.9','NO'),(14,1,'3.1','SI'),(15,1,'3.2','NA'),(16,1,'4.1','NO'),(17,1,'4.2','SI'),(18,1,'5.1','NA'),(19,1,'5.2','SI'),(20,1,'6.1','NA'),(21,1,'6.2','NO'),(22,1,'6.3','SI'),(23,1,'6.4','NO'),(24,1,'6.5','NA'),(25,1,'7.1','SI'),(26,1,'7.2','NO'),(27,1,'7.3','NO'),(28,2,'1.1','SI'),(29,2,'1.2','SI'),(30,2,'1.3','SI'),(31,2,'1.4','SI'),(32,2,'2.1','NO'),(33,2,'2.2','NO'),(34,2,'2.3','SI'),(35,2,'2.4','SI'),(36,2,'2.5','NA'),(37,2,'2.6','NA'),(38,2,'2.7','NO'),(39,2,'2.8','SI'),(40,2,'2.9','NO'),(41,2,'3.1','SI'),(42,2,'3.2','NA'),(43,2,'4.1','NO'),(44,2,'4.2','SI'),(45,2,'5.1','NA'),(46,2,'5.2','SI'),(47,2,'6.1','NA'),(48,2,'6.2','NO'),(49,2,'6.3','SI'),(50,2,'6.4','NO'),(51,2,'6.5','NA'),(52,2,'7.1','SI'),(53,2,'7.2','NO'),(54,2,'7.3','NO'),(55,3,'1.1','SI'),(56,3,'1.2','SI'),(57,3,'1.3','SI'),(58,3,'1.4','SI'),(59,3,'2.1','NO'),(60,3,'2.2','NO'),(61,3,'2.3','SI'),(62,3,'2.4','SI'),(63,3,'2.5','NA'),(64,3,'2.6','NA'),(65,3,'2.7','NO'),(66,3,'2.8','SI'),(67,3,'2.9','NO'),(68,3,'3.1','SI'),(69,3,'3.2','NA'),(70,3,'4.1','NO'),(71,3,'4.2','SI'),(72,3,'5.1','NA'),(73,3,'5.2','SI'),(74,3,'6.1','NA'),(75,3,'6.2','NO'),(76,3,'6.3','SI'),(77,3,'6.4','NO'),(78,3,'6.5','NA'),(79,3,'7.1','SI'),(80,3,'7.2','NO'),(81,3,'7.3','NO'),(82,4,'1.1','SI'),(83,4,'1.2','SI'),(84,4,'1.3','SI'),(85,4,'1.4','SI'),(86,4,'2.1','NO'),(87,4,'2.2','NO'),(88,4,'2.3','SI'),(89,4,'2.4','SI'),(90,4,'2.5','NA'),(91,4,'2.6','NA'),(92,4,'2.7','NO'),(93,4,'2.8','SI'),(94,4,'2.9','NO'),(95,4,'3.1','SI'),(96,4,'3.2','NA'),(97,4,'4.1','NO'),(98,4,'4.2','SI'),(99,4,'5.1','NA'),(100,4,'5.2','SI'),(101,4,'6.1','NA'),(102,4,'6.2','NO'),(103,4,'6.3','SI'),(104,4,'6.4','NO'),(105,4,'6.5','NA'),(106,4,'7.1','SI'),(107,4,'7.2','NO'),(108,4,'7.3','NO'),(109,5,'1.1','SI'),(110,5,'1.2','SI'),(111,5,'1.3','SI'),(112,5,'1.4','SI'),(113,5,'2.1','NO'),(114,5,'2.2','NO'),(115,5,'2.3','SI'),(116,5,'2.4','SI'),(117,5,'2.5','NA'),(118,5,'2.6','NA'),(119,5,'2.7','NO'),(120,5,'2.8','SI'),(121,5,'2.9','NO'),(122,5,'3.1','SI'),(123,5,'3.2','NA'),(124,5,'4.1','NO'),(125,5,'4.2','SI'),(126,5,'5.1','NA'),(127,5,'5.2','SI'),(128,5,'6.1','NA'),(129,5,'6.2','NO'),(130,5,'6.3','SI'),(131,5,'6.4','NO'),(132,5,'6.5','NA'),(133,5,'7.1','SI'),(134,5,'7.2','NO'),(135,5,'7.3','NO'),(136,6,'1.1','SI'),(137,6,'1.2','SI'),(138,6,'1.3','SI'),(139,6,'1.4','SI'),(140,6,'2.1','NO'),(141,6,'2.2','NO'),(142,6,'2.3','SI'),(143,6,'2.4','SI'),(144,6,'2.5','NA'),(145,6,'2.6','NA'),(146,6,'2.7','NO'),(147,6,'2.8','SI'),(148,6,'2.9','NO'),(149,6,'3.1','SI'),(150,6,'3.2','NA'),(151,6,'4.1','NO'),(152,6,'4.2','SI'),(153,6,'5.1','NA'),(154,6,'5.2','SI'),(155,6,'6.1','NA'),(156,6,'6.2','NO'),(157,6,'6.3','SI'),(158,6,'6.4','NO'),(159,6,'6.5','NA'),(160,6,'7.1','SI'),(161,6,'7.2','NO'),(162,6,'7.3','NO'),(163,7,'1.1','SI'),(164,7,'1.2','SI'),(165,7,'1.3','SI'),(166,7,'1.4','SI'),(167,7,'2.1','NO'),(168,7,'2.2','NO'),(169,7,'2.3','SI'),(170,7,'2.4','SI'),(171,7,'2.5','NA'),(172,7,'2.6','NA'),(173,7,'2.7','NO'),(174,7,'2.8','SI'),(175,7,'2.9','NO'),(176,7,'3.1','SI'),(177,7,'3.2','NA'),(178,7,'4.1','NO'),(179,7,'4.2','SI'),(180,7,'5.1','NA'),(181,7,'5.2','SI'),(182,7,'6.1','NA'),(183,7,'6.2','NO'),(184,7,'6.3','SI'),(185,7,'6.4','NO'),(186,7,'6.5','NA'),(187,7,'7.1','SI'),(188,7,'7.2','NO'),(189,7,'7.3','NO'),(190,8,'1.1','SI'),(191,8,'1.2','SI'),(192,8,'1.3','SI'),(193,8,'1.4','SI'),(194,8,'2.1','NO'),(195,8,'2.2','NO'),(196,8,'2.3','SI'),(197,8,'2.4','SI'),(198,8,'2.5','NA'),(199,8,'2.6','NA'),(200,8,'2.7','NO'),(201,8,'2.8','SI'),(202,8,'2.9','NO'),(203,8,'3.1','SI'),(204,8,'3.2','NA'),(205,8,'4.1','NO'),(206,8,'4.2','SI'),(207,8,'5.1','NA'),(208,8,'5.2','SI'),(209,8,'6.1','NA'),(210,8,'6.2','NO'),(211,8,'6.3','SI'),(212,8,'6.4','NO'),(213,8,'6.5','NA'),(214,8,'7.1','SI'),(215,8,'7.2','NO'),(216,8,'7.3','NO'),(217,9,'1.1','SI'),(218,9,'1.2','SI'),(219,9,'1.3','SI'),(220,9,'1.4','SI'),(221,9,'2.1','NO'),(222,9,'2.2','NO'),(223,9,'2.3','SI'),(224,9,'2.4','SI'),(225,9,'2.5','NA'),(226,9,'2.6','NA'),(227,9,'2.7','NO'),(228,9,'2.8','SI'),(229,9,'2.9','NO'),(230,9,'3.1','SI'),(231,9,'3.2','NA'),(232,9,'4.1','NO'),(233,9,'4.2','SI'),(234,9,'5.1','NA'),(235,9,'5.2','SI'),(236,9,'6.1','NA'),(237,9,'6.2','NO'),(238,9,'6.3','SI'),(239,9,'6.4','NO'),(240,9,'6.5','NA'),(241,9,'7.1','SI'),(242,9,'7.2','NO'),(243,9,'7.3','NO'),(244,10,'1.1','SI'),(245,10,'1.2','SI'),(246,10,'1.3','SI'),(247,10,'1.4','SI'),(248,10,'2.1','NO'),(249,10,'2.2','NO'),(250,10,'2.3','SI'),(251,10,'2.4','SI'),(252,10,'2.5','NA'),(253,10,'2.6','NA'),(254,10,'2.7','NO'),(255,10,'2.8','SI'),(256,10,'2.9','NO'),(257,10,'3.1','SI'),(258,10,'3.2','NA'),(259,10,'4.1','NO'),(260,10,'4.2','SI'),(261,10,'5.1','NA'),(262,10,'5.2','SI'),(263,10,'6.1','NA'),(264,10,'6.2','NO'),(265,10,'6.3','SI'),(266,10,'6.4','NO'),(267,10,'6.5','NA'),(268,10,'7.1','SI'),(269,10,'7.2','NO'),(270,10,'7.3','NO'),(271,11,'1.1','SI'),(272,11,'1.2','SI'),(273,11,'1.3','SI'),(274,11,'1.4','SI'),(275,11,'2.1','NO'),(276,11,'2.2','NO'),(277,11,'2.3','SI'),(278,11,'2.4','SI'),(279,11,'2.5','NA'),(280,11,'2.6','NA'),(281,11,'2.7','NO'),(282,11,'2.8','SI'),(283,11,'2.9','NO'),(284,11,'3.1','SI'),(285,11,'3.2','NA'),(286,11,'4.1','NO'),(287,11,'4.2','SI'),(288,11,'5.1','NA'),(289,11,'5.2','SI'),(290,11,'6.1','NA'),(291,11,'6.2','NO'),(292,11,'6.3','SI'),(293,11,'6.4','NO'),(294,11,'6.5','NA'),(295,11,'7.1','SI'),(296,11,'7.2','NO'),(297,11,'7.3','NO'),(298,12,'1.1','SI'),(299,12,'1.2','SI'),(300,12,'1.3','SI'),(301,12,'1.4','SI'),(302,12,'2.1','NO'),(303,12,'2.2','NO'),(304,12,'2.3','SI'),(305,12,'2.4','SI'),(306,12,'2.5','NA'),(307,12,'2.6','NA'),(308,12,'2.7','NO'),(309,12,'2.8','SI'),(310,12,'2.9','NO'),(311,12,'3.1','SI'),(312,12,'3.2','NA'),(313,12,'4.1','NO'),(314,12,'4.2','SI'),(315,12,'5.1','NA'),(316,12,'5.2','SI'),(317,12,'6.1','NA'),(318,12,'6.2','NO'),(319,12,'6.3','SI'),(320,12,'6.4','NO'),(321,12,'6.5','NA'),(322,12,'7.1','SI'),(323,12,'7.2','NO'),(324,12,'7.3','NO'),(325,13,'1.1','SI'),(326,13,'1.2','SI'),(327,13,'1.3','SI'),(328,13,'1.4','SI'),(329,13,'2.1','NO'),(330,13,'2.2','NO'),(331,13,'2.3','SI'),(332,13,'2.4','SI'),(333,13,'2.5','NA'),(334,13,'2.6','NA'),(335,13,'2.7','NO'),(336,13,'2.8','SI'),(337,13,'2.9','NO'),(338,13,'3.1','SI'),(339,13,'3.2','NA'),(340,13,'4.1','NO'),(341,13,'4.2','SI'),(342,13,'5.1','NA'),(343,13,'5.2','SI'),(344,13,'6.1','NA'),(345,13,'6.2','NO'),(346,13,'6.3','SI'),(347,13,'6.4','NO'),(348,13,'6.5','NA'),(349,13,'7.1','SI'),(350,13,'7.2','NO'),(351,13,'7.3','NO'),(352,14,'1.1','SI'),(353,14,'1.2','SI'),(354,14,'2.1','SI'),(355,14,'2.2','SI'),(356,14,'2.3','SI'),(357,14,'2.4','SI'),(358,14,'2.5','SI'),(359,14,'2.6','SI'),(360,14,'2.7','SI'),(361,14,'2.8','SI'),(362,14,'2.9','SI'),(363,14,'3.1','NO'),(364,14,'3.2','SI'),(365,14,'4.1','NO'),(366,14,'4.2','SI'),(367,14,'5.1','NO'),(368,14,'5.2','SI'),(369,14,'6.1','NO'),(370,14,'6.2','SI'),(371,14,'6.4','SI'),(372,14,'6.5','NO'),(373,14,'7.1','SI'),(374,15,'1.1','SI'),(375,15,'1.2','SI'),(376,15,'1.3','SI'),(377,15,'1.4','SI'),(378,15,'2.1','SI'),(379,15,'2.2','NO'),(380,15,'2.3','SI'),(381,15,'2.4','NO'),(382,15,'2.5','SI'),(383,15,'2.6','NO'),(384,15,'2.7','NO'),(385,15,'2.8','NA'),(386,15,'2.9','NA'),(387,15,'3.1','NO'),(388,15,'3.2','NA'),(389,15,'4.1','NA'),(390,15,'4.2','NO'),(391,15,'5.1','NA'),(392,15,'5.2','NO'),(393,15,'6.1','NA'),(394,15,'6.2','NA'),(395,15,'6.3','NO'),(396,15,'6.4','SI'),(397,15,'6.5','NA'),(398,15,'7.1','NO'),(399,15,'7.2','SI'),(400,15,'7.3','NA'),(401,16,'1.1','SI'),(402,16,'1.2','SI'),(403,16,'1.3','SI'),(404,16,'1.4','SI'),(405,16,'2.1','SI'),(406,16,'2.2','NO'),(407,16,'2.3','SI'),(408,16,'2.4','NO'),(409,16,'2.5','SI'),(410,16,'2.6','NO'),(411,16,'2.7','NO'),(412,16,'2.8','NA'),(413,16,'2.9','NA'),(414,16,'3.1','NO'),(415,16,'3.2','NA'),(416,16,'4.1','NA'),(417,16,'4.2','NO'),(418,16,'5.1','NA'),(419,16,'5.2','NO'),(420,16,'6.1','NA'),(421,16,'6.2','NA'),(422,16,'6.3','NO'),(423,16,'6.4','SI'),(424,16,'6.5','NA'),(425,16,'7.1','NO'),(426,16,'7.2','SI'),(427,16,'7.3','NA'),(428,17,'1.1','SI'),(429,17,'1.2','SI'),(430,17,'1.3','SI'),(431,17,'1.4','SI'),(432,17,'2.1','SI'),(433,17,'2.2','NO'),(434,17,'2.3','SI'),(435,17,'2.4','NO'),(436,17,'2.5','SI'),(437,17,'2.6','NO'),(438,17,'2.7','NO'),(439,17,'2.8','NA'),(440,17,'2.9','NA'),(441,17,'3.1','NO'),(442,17,'3.2','NA'),(443,17,'4.1','NA'),(444,17,'4.2','NO'),(445,17,'5.1','NA'),(446,17,'5.2','NO'),(447,17,'6.1','NA'),(448,17,'6.2','NA'),(449,17,'6.3','NO'),(450,17,'6.4','SI'),(451,17,'6.5','NA'),(452,17,'7.1','NO'),(453,17,'7.2','SI'),(454,17,'7.3','NA'),(455,18,'1.1','SI'),(456,18,'1.2','SI'),(457,18,'1.3','SI'),(458,18,'1.4','SI'),(459,18,'2.1','SI'),(460,18,'2.2','NO'),(461,18,'2.3','SI'),(462,18,'2.4','NO'),(463,18,'2.5','SI'),(464,18,'2.6','NO'),(465,18,'2.7','NO'),(466,18,'2.8','NA'),(467,18,'2.9','NA'),(468,18,'3.1','NO'),(469,18,'3.2','NA'),(470,18,'4.1','NA'),(471,18,'4.2','NO'),(472,18,'5.1','NA'),(473,18,'5.2','NO'),(474,18,'6.1','NA'),(475,18,'6.2','NA'),(476,18,'6.3','NO'),(477,18,'6.4','SI'),(478,18,'6.5','NA'),(479,18,'7.1','NO'),(480,18,'7.2','SI'),(481,18,'7.3','NA'),(482,19,'1.1','SI'),(483,19,'1.2','SI'),(484,19,'1.3','SI'),(485,19,'1.4','SI'),(486,19,'2.1','SI'),(487,19,'2.2','NO'),(488,19,'2.3','SI'),(489,19,'2.4','NO'),(490,19,'2.5','SI'),(491,19,'2.6','NO'),(492,19,'2.7','NO'),(493,19,'2.8','NA'),(494,19,'2.9','NA'),(495,19,'3.1','NO'),(496,19,'3.2','NA'),(497,19,'4.1','NA'),(498,19,'4.2','NO'),(499,19,'5.1','NA'),(500,19,'5.2','NO'),(501,19,'6.1','NA'),(502,19,'6.2','NA'),(503,19,'6.3','NO'),(504,19,'6.4','SI'),(505,19,'6.5','NA'),(506,19,'7.1','NO'),(507,19,'7.2','SI'),(508,19,'7.3','NA'),(509,20,'1.1','SI'),(510,20,'1.2','SI'),(511,20,'1.3','SI'),(512,20,'1.4','SI'),(513,20,'2.1','SI'),(514,20,'2.2','NO'),(515,20,'2.3','SI'),(516,20,'2.4','NO'),(517,20,'2.5','SI'),(518,20,'2.6','NO'),(519,20,'2.7','NO'),(520,20,'2.8','NA'),(521,20,'2.9','NA'),(522,20,'3.1','NO'),(523,20,'3.2','NA'),(524,20,'4.1','NA'),(525,20,'4.2','NO'),(526,20,'5.1','NA'),(527,20,'5.2','NO'),(528,20,'6.1','NA'),(529,20,'6.2','NA'),(530,20,'6.3','NO'),(531,20,'6.4','SI'),(532,20,'6.5','NA'),(533,20,'7.1','NO'),(534,20,'7.2','SI'),(535,20,'7.3','NA'),(536,21,'1.1','SI'),(537,21,'1.2','SI'),(538,21,'1.3','SI'),(539,21,'1.4','SI'),(540,21,'2.1','SI'),(541,21,'2.2','NO'),(542,21,'2.3','SI'),(543,21,'2.4','NO'),(544,21,'2.5','SI'),(545,21,'2.6','NO'),(546,21,'2.7','NO'),(547,21,'2.8','NA'),(548,21,'2.9','NA'),(549,21,'3.1','NO'),(550,21,'3.2','NA'),(551,21,'4.1','NA'),(552,21,'4.2','NO'),(553,21,'5.1','NA'),(554,21,'5.2','NO'),(555,21,'6.1','NA'),(556,21,'6.2','NA'),(557,21,'6.3','NO'),(558,21,'6.4','SI'),(559,21,'6.5','NA'),(560,21,'7.1','NO'),(561,21,'7.2','SI'),(562,21,'7.3','NA'),(563,22,'1.1','SI'),(564,22,'1.2','SI'),(565,22,'1.3','SI'),(566,22,'1.4','SI'),(567,22,'2.1','SI'),(568,22,'2.2','NO'),(569,22,'2.3','SI'),(570,22,'2.4','NO'),(571,22,'2.5','SI'),(572,22,'2.6','NO'),(573,22,'2.7','NO'),(574,22,'2.8','NA'),(575,22,'2.9','NA'),(576,22,'3.1','NO'),(577,22,'3.2','NA'),(578,22,'4.1','NA'),(579,22,'4.2','NO'),(580,22,'5.1','NA'),(581,22,'5.2','NO'),(582,22,'6.1','NA'),(583,22,'6.2','NA'),(584,22,'6.3','NO'),(585,22,'6.4','SI'),(586,22,'6.5','NA'),(587,22,'7.1','NO'),(588,22,'7.2','SI'),(589,22,'7.3','NA'),(590,23,'1.1','SI'),(591,23,'1.2','SI'),(592,23,'1.3','SI'),(593,23,'1.4','SI'),(594,23,'2.1','SI'),(595,23,'2.2','NO'),(596,23,'2.3','SI'),(597,23,'2.4','NO'),(598,23,'2.5','SI'),(599,23,'2.6','NO'),(600,23,'2.7','NO'),(601,23,'2.8','NA'),(602,23,'2.9','NA'),(603,23,'3.1','NO'),(604,23,'3.2','NA'),(605,23,'4.1','NA'),(606,23,'4.2','NO'),(607,23,'5.1','NA'),(608,23,'5.2','NO'),(609,23,'6.1','NA'),(610,23,'6.2','NA'),(611,23,'6.3','NO'),(612,23,'6.4','SI'),(613,23,'6.5','NA'),(614,23,'7.1','NO'),(615,23,'7.2','SI'),(616,23,'7.3','NA'),(617,24,'1.1','SI'),(618,24,'1.2','SI'),(619,24,'1.3','SI'),(620,24,'1.4','SI'),(621,24,'2.1','SI'),(622,24,'2.2','NO'),(623,24,'2.3','SI'),(624,24,'2.4','NO'),(625,24,'2.5','SI'),(626,24,'2.6','NO'),(627,24,'2.7','NO'),(628,24,'2.8','NA'),(629,24,'2.9','NA'),(630,24,'3.1','NO'),(631,24,'3.2','NA'),(632,24,'4.1','NA'),(633,24,'4.2','NO'),(634,24,'5.1','NA'),(635,24,'5.2','NO'),(636,24,'6.1','NA'),(637,24,'6.2','NA'),(638,24,'6.3','NO'),(639,24,'6.4','SI'),(640,24,'6.5','NA'),(641,24,'7.1','NO'),(642,24,'7.2','SI'),(643,24,'7.3','NA'),(644,25,'1.1','SI'),(645,25,'1.2','SI'),(646,25,'1.3','SI'),(647,25,'1.4','SI'),(648,25,'2.1','SI'),(649,25,'2.2','NO'),(650,25,'2.3','SI'),(651,25,'2.4','NO'),(652,25,'2.5','SI'),(653,25,'2.6','NO'),(654,25,'2.7','NO'),(655,25,'2.8','NA'),(656,25,'2.9','NA'),(657,25,'3.1','NO'),(658,25,'3.2','NA'),(659,25,'4.1','NA'),(660,25,'4.2','NO'),(661,25,'5.1','NA'),(662,25,'5.2','NO'),(663,25,'6.1','NA'),(664,25,'6.2','NA'),(665,25,'6.3','NO'),(666,25,'6.4','SI'),(667,25,'6.5','NA'),(668,25,'7.1','NO'),(669,25,'7.2','SI'),(670,25,'7.3','NA'),(671,26,'1.1','NO'),(672,26,'1.2','NO'),(673,26,'1.3','NA'),(674,26,'1.4','SI'),(675,26,'2.1','SI'),(676,26,'2.2','NO'),(677,26,'2.3','SI'),(678,26,'2.4','NO'),(679,26,'2.5','SI'),(680,26,'2.6','NA'),(681,26,'2.7','NA'),(682,26,'2.8','SI'),(683,26,'2.9','NA'),(684,26,'3.1','NA'),(685,26,'3.2','NO'),(686,26,'4.1','SI'),(687,26,'4.2','SI'),(688,26,'5.1','NO'),(689,26,'5.2','SI'),(690,26,'6.1','NO'),(691,26,'6.2','NA'),(692,26,'6.3','NO'),(693,26,'6.4','SI'),(694,26,'7.1','SI'),(695,26,'7.2','NO'),(696,26,'7.3','SI'),(697,27,'7.3','SI'),(698,28,'1.1','NA'),(699,28,'1.2','SI'),(700,28,'1.3','NO'),(701,28,'1.4','NA'),(702,28,'2.1','NA'),(703,28,'2.2','NA'),(704,28,'2.3','SI'),(705,28,'2.4','SI'),(706,28,'2.5','NO'),(707,28,'2.6','NA'),(708,28,'2.7','NO'),(709,28,'2.8','SI'),(710,28,'2.9','SI'),(711,28,'3.1','NO'),(712,28,'3.2','SI'),(713,28,'4.1','SI'),(714,28,'4.2','NO'),(715,28,'5.1','NO'),(716,28,'5.2','SI'),(717,28,'6.1','SI'),(718,28,'6.2','NA'),(719,28,'6.3','NO'),(720,28,'6.4','SI'),(721,28,'6.5','SI'),(722,28,'7.1','SI'),(723,28,'7.2','SI'),(724,28,'7.3','SI'),(725,29,'1.1','SI'),(726,29,'1.2','SI'),(727,29,'1.3','NA'),(728,29,'1.4','NO'),(729,29,'2.1','NA'),(730,29,'2.2','NO'),(731,29,'2.3','NO'),(732,29,'2.4','SI'),(733,29,'2.5','NO'),(734,29,'2.6','NO'),(735,29,'2.7','NA'),(736,29,'2.8','NO'),(737,29,'2.9','SI'),(738,29,'3.1','NA'),(739,29,'3.2','SI'),(740,29,'4.1','NA'),(741,29,'4.2','NA'),(742,29,'5.1','NO'),(743,29,'5.2','NA'),(744,29,'6.1','NO'),(745,29,'6.2','NA'),(746,29,'6.3','NO'),(747,29,'6.4','SI'),(748,29,'6.5','SI'),(749,29,'7.1','SI'),(750,29,'7.2','SI'),(751,29,'7.3','SI'),(752,30,'1.1','SI'),(753,30,'1.2','SI'),(754,30,'1.3','NA'),(755,30,'1.4','NO'),(756,30,'2.1','NA'),(757,30,'2.2','NO'),(758,30,'2.3','NO'),(759,30,'2.4','SI'),(760,30,'2.5','NO'),(761,30,'2.6','NO'),(762,30,'2.7','NA'),(763,30,'2.8','NO'),(764,30,'2.9','SI'),(765,30,'3.1','NA'),(766,30,'3.2','SI'),(767,30,'4.1','NA'),(768,30,'4.2','NA'),(769,30,'5.1','NO'),(770,30,'5.2','NA'),(771,30,'6.1','NO'),(772,30,'6.2','NA'),(773,30,'6.3','NO'),(774,30,'6.4','SI'),(775,30,'6.5','SI'),(776,30,'7.1','SI'),(777,30,'7.2','SI'),(778,30,'7.3','SI'),(779,31,'1.1','SI'),(780,31,'1.2','NO'),(781,31,'1.3','NO'),(782,31,'1.4','SI'),(783,31,'2.1','SI'),(784,31,'2.2','NO'),(785,31,'2.3','NO'),(786,31,'2.4','SI'),(787,31,'2.5','NO'),(788,31,'2.6','NA'),(789,31,'2.7','NO'),(790,31,'2.8','SI'),(791,31,'2.9','NO'),(792,31,'3.1','NA'),(793,31,'3.2','NO'),(794,31,'4.1','NO'),(795,31,'4.2','SI'),(796,31,'5.1','SI'),(797,31,'5.2','NO'),(798,31,'6.1','NO'),(799,31,'6.2','SI'),(800,31,'6.3','NO'),(801,31,'6.4','NA'),(802,31,'6.5','SI'),(803,31,'7.1','NO'),(804,31,'7.2','SI'),(805,31,'7.3','NO'),(806,32,'1.1','SI'),(807,32,'1.2','NO'),(808,32,'1.3','NO'),(809,32,'1.4','SI'),(810,32,'2.1','NO'),(811,32,'2.2','SI'),(812,32,'2.3','NO'),(813,32,'2.4','NO'),(814,32,'2.5','NO'),(815,32,'2.6','NO'),(816,32,'2.7','SI'),(817,32,'2.8','NA'),(818,32,'2.9','NA'),(819,32,'3.1','SI'),(820,32,'3.2','NA'),(821,32,'4.1','NA'),(822,32,'4.2','SI'),(823,32,'5.1','SI'),(824,32,'5.2','NA'),(825,32,'6.1','NA'),(826,32,'6.2','SI'),(827,32,'6.3','NA'),(828,32,'6.4','NO'),(829,32,'6.5','NO'),(830,32,'7.1','NA'),(831,32,'7.2','NO'),(832,32,'7.3','NA'),(833,33,'1.1','SI'),(834,33,'1.2','SI'),(835,33,'1.3','SI'),(836,33,'1.4','SI'),(837,33,'2.1','SI'),(838,33,'2.2','SI'),(839,33,'2.3','SI'),(840,33,'2.4','SI'),(841,33,'2.5','SI'),(842,33,'2.6','SI'),(843,33,'2.7','SI'),(844,33,'2.8','SI'),(845,33,'2.9','SI'),(846,33,'3.1','NO'),(847,33,'3.2','NO'),(848,33,'4.1','NO'),(849,33,'4.2','NO'),(850,33,'5.1','SI'),(851,33,'5.2','SI'),(852,33,'6.1','SI'),(853,33,'6.2','SI'),(854,33,'6.3','SI'),(855,33,'6.4','SI'),(856,33,'6.5','SI'),(857,33,'7.1','SI'),(858,33,'7.2','SI'),(859,33,'7.3','SI'),(860,34,'1.1','SI'),(861,34,'1.2','SI'),(862,34,'1.3','NA'),(863,34,'1.4','NA'),(864,34,'2.1','SI'),(865,34,'2.2','NO'),(866,34,'2.3','NA'),(867,34,'2.4','NA'),(868,34,'2.5','NO'),(869,34,'2.6','SI'),(870,34,'2.7','SI'),(871,34,'2.8','NO'),(872,34,'2.9','NA'),(873,34,'3.1','NO'),(874,34,'3.2','SI'),(875,34,'4.1','SI'),(876,34,'4.2','NA'),(877,34,'5.1','NA'),(878,34,'5.2','SI'),(879,34,'6.1','NA'),(880,34,'6.2','NA'),(881,34,'6.3','SI'),(882,34,'6.4','NO'),(883,34,'6.5','NO'),(884,34,'7.1','SI'),(885,34,'7.2','NO'),(886,34,'7.3','NO'),(887,35,'1.1','SI'),(888,35,'1.2','SI'),(889,35,'1.3','NO'),(890,35,'1.4','NA'),(891,35,'2.1','NA'),(892,35,'2.2','NO'),(893,35,'2.3','SI'),(894,35,'2.4','SI'),(895,35,'2.5','NO'),(896,35,'2.6','NA'),(897,35,'2.7','NA'),(898,35,'2.8','NO'),(899,35,'2.9','SI'),(900,35,'3.1','NA'),(901,35,'3.2','NO'),(902,35,'4.1','NO'),(903,35,'4.2','SI'),(904,35,'5.1','SI'),(905,35,'5.2','NA'),(906,35,'6.1','NA'),(907,35,'6.2','NO'),(908,35,'6.3','NO'),(909,35,'6.4','SI'),(910,35,'6.5','SI'),(911,35,'7.1','SI'),(912,35,'7.2','NA'),(913,35,'7.3','NO'),(914,36,'1.1','SI'),(915,36,'1.2','SI'),(916,36,'1.3','NO'),(917,36,'1.4','NA'),(918,36,'2.1','NA'),(919,36,'2.2','NO'),(920,36,'2.3','SI'),(921,36,'2.4','SI'),(922,36,'2.5','NO'),(923,36,'2.6','NA'),(924,36,'2.7','NA'),(925,36,'2.8','NO'),(926,36,'2.9','SI'),(927,36,'3.1','NA'),(928,36,'3.2','NO'),(929,36,'4.1','NO'),(930,36,'4.2','SI'),(931,36,'5.1','SI'),(932,36,'5.2','NA'),(933,36,'6.1','NA'),(934,36,'6.2','NO'),(935,36,'6.3','NO'),(936,36,'6.4','SI'),(937,36,'6.5','SI'),(938,36,'7.1','SI'),(939,36,'7.2','NA'),(940,36,'7.3','NO'),(941,37,'6.3','NO'),(942,37,'6.5','SI'),(943,37,'7.2','NA'),(944,37,'7.3','NO'),(945,38,'6.4','NO'),(946,38,'6.5','NO'),(947,38,'7.1','NO'),(948,38,'7.2','SI'),(949,38,'7.3','NO'),(950,58,'6.1','SI'),(951,58,'6.2','SI'),(952,58,'6.3','NO'),(953,58,'6.4','SI'),(954,58,'6.5','SI'),(955,58,'7.1','SI'),(956,58,'7.2','SI'),(957,58,'7.3','SI'),(958,60,'5.1','SI'),(959,60,'5.2','SI'),(960,60,'6.1','SI'),(961,60,'6.2','SI'),(962,60,'6.3','SI'),(963,60,'6.4','SI'),(964,60,'6.5','SI'),(965,60,'7.1','SI'),(966,60,'7.2','NO'),(967,60,'7.3','SI'),(968,61,'5.1','SI'),(969,61,'5.2','SI'),(970,61,'6.1','NO'),(971,61,'6.2','NO'),(972,61,'6.3','NO'),(973,61,'6.4','NO'),(974,61,'6.5','NO'),(975,61,'7.2','NO'),(976,61,'7.3','SI'),(977,62,'6.1','SI'),(978,62,'6.2','SI'),(979,62,'6.3','SI'),(980,62,'6.4','SI'),(981,62,'6.5','SI'),(982,62,'7.1','SI'),(983,62,'7.2','SI'),(984,62,'7.3','SI'),(985,63,'6.3','SI'),(986,63,'6.4','SI'),(987,63,'6.5','SI'),(988,63,'7.1','SI'),(989,63,'7.2','SI'),(990,63,'7.3','SI'),(991,64,'6.1','SI'),(992,64,'6.2','NO'),(993,64,'6.3','NO'),(994,64,'6.4','SI'),(995,64,'6.5','NO'),(996,64,'7.1','SI'),(997,64,'7.2','SI'),(998,64,'7.3','SI'),(999,65,'5.1','NA'),(1000,65,'5.2','NA'),(1001,65,'6.1','SI'),(1002,65,'6.2','SI'),(1003,65,'6.3','SI'),(1004,65,'6.4','SI'),(1005,65,'6.5','SI'),(1006,65,'7.1','NO'),(1007,65,'7.2','SI'),(1008,65,'7.3','SI'),(1009,66,'5.1','NA'),(1010,66,'5.2','NA'),(1011,66,'6.1','SI'),(1012,66,'6.2','SI'),(1013,66,'6.3','SI'),(1014,66,'6.4','SI'),(1015,66,'6.5','SI'),(1016,66,'7.1','NO'),(1017,66,'7.2','SI'),(1018,66,'7.3','SI'),(1019,67,'5.1','NO'),(1020,67,'5.2','NO'),(1021,67,'6.1','NA'),(1022,67,'6.2','NA'),(1023,67,'6.3','NA'),(1024,67,'6.4','NA'),(1025,67,'7.1','SI'),(1026,67,'7.2','SI'),(1027,67,'7.3','SI'),(1028,68,'2.7','SI'),(1029,68,'2.8','SI'),(1030,68,'2.9','SI'),(1031,68,'3.1','NA'),(1032,68,'3.2','SI'),(1033,68,'4.1','NO'),(1034,68,'4.2','SI'),(1035,68,'5.1','NO'),(1036,68,'5.2','NO'),(1037,68,'6.1','NO'),(1038,68,'6.2','NO'),(1039,68,'6.3','NO'),(1040,68,'6.4','NO'),(1041,68,'6.5','NO'),(1042,68,'7.1','NO'),(1043,68,'7.2','SI'),(1044,68,'7.3','SI'),(1045,69,'1.1','NA'),(1046,69,'1.2','NA'),(1047,69,'1.3','NA'),(1048,69,'1.4','NA'),(1049,69,'2.1','SI'),(1050,69,'2.2','SI'),(1051,69,'2.3','SI'),(1052,69,'2.4','SI'),(1053,69,'2.5','SI'),(1054,69,'2.6','SI'),(1055,69,'2.7','SI'),(1056,69,'2.8','SI'),(1057,69,'2.9','SI'),(1058,69,'3.1','NO'),(1059,69,'3.2','NO'),(1060,69,'5.1','NO'),(1061,69,'5.2','NO'),(1062,69,'6.1','SI'),(1063,69,'6.2','SI'),(1064,69,'6.3','SI'),(1065,69,'6.4','SI'),(1066,69,'6.5','SI'),(1067,69,'7.1','NO'),(1068,69,'7.2','NO'),(1069,69,'7.3','NA'),(1070,70,'1.1','NA'),(1071,70,'1.2','NA'),(1072,70,'1.3','NA'),(1073,70,'1.4','NA'),(1074,70,'2.1','SI'),(1075,70,'2.2','SI'),(1076,70,'2.3','SI'),(1077,70,'2.4','SI'),(1078,70,'2.5','SI'),(1079,70,'2.6','SI'),(1080,70,'2.7','SI'),(1081,70,'2.8','SI'),(1082,70,'2.9','SI'),(1083,70,'3.1','NO'),(1084,70,'3.2','NO'),(1085,70,'5.1','NO'),(1086,70,'5.2','NO'),(1087,70,'6.1','SI'),(1088,70,'6.2','SI'),(1089,70,'6.3','SI'),(1090,70,'6.4','SI'),(1091,70,'6.5','SI'),(1092,70,'7.1','NO'),(1093,70,'7.2','NO'),(1094,70,'7.3','NA'),(1095,71,'1.1','NA'),(1096,71,'1.2','NA'),(1097,71,'1.3','NA'),(1098,71,'1.4','NA'),(1099,71,'2.1','SI'),(1100,71,'2.2','SI'),(1101,71,'2.3','SI'),(1102,71,'2.4','SI'),(1103,71,'2.5','SI'),(1104,71,'2.6','SI'),(1105,71,'2.7','SI'),(1106,71,'2.8','SI'),(1107,71,'2.9','SI'),(1108,71,'3.1','NO'),(1109,71,'3.2','NO'),(1110,71,'5.1','NO'),(1111,71,'5.2','NO'),(1112,71,'6.1','SI'),(1113,71,'6.2','SI'),(1114,71,'6.3','SI'),(1115,71,'6.4','SI'),(1116,71,'6.5','SI'),(1117,71,'7.1','NO'),(1118,71,'7.2','NO'),(1119,71,'7.3','NA'),(1120,72,'1.1','SI'),(1121,72,'1.2','SI'),(1122,72,'1.3','SI'),(1123,72,'1.4','SI'),(1124,72,'2.1','NA'),(1125,72,'2.2','SI'),(1126,72,'2.3','NO'),(1127,72,'2.4','NO'),(1128,72,'2.5','NO'),(1129,72,'2.6','NO'),(1130,72,'5.2','SI'),(1131,72,'7.1','SI'),(1132,72,'7.2','SI'),(1133,72,'7.3','SI'),(1134,138,'1.1','SI'),(1135,138,'1.2','NO'),(1136,138,'1.3','NA'),(1137,138,'1.4','NO'),(1138,139,'1.1','SI'),(1139,139,'1.2','NO'),(1140,139,'1.3','NA'),(1141,139,'1.4','NO'),(1142,140,'1.1','SI'),(1143,141,'1.1','SI'),(1144,142,'1.1','SI'),(1145,143,'1.1','SI'),(1146,144,'1.1','SI'),(1147,145,'1.1','NO'),(1148,146,'1.1','NO'),(1149,147,'1.1','NO'),(1150,148,'1.1','NO'),(1151,149,'1.1','NO'),(1152,150,'1.1','NA'),(1153,151,'1.1','NA'),(1154,152,'1.1','NA'),(1155,153,'1.1','NA'),(1156,154,'1.1','NA'),(1157,155,'1.1','NA'),(1158,156,'1.1','NA'),(1159,157,'1.1','NA'),(1160,158,'1.2','NO'),(1161,159,'1.2','SI'),(1162,160,'1.2','NA'),(1163,161,'1.2','NO'),(1164,162,'1.2','SI'),(1165,163,'1.2','NO'),(1166,164,'1.2','NA'),(1167,165,'1.3','SI'),(1168,166,'1.3','NO'),(1169,167,'1.3','NA'),(1170,168,'1.4','SI'),(1171,169,'1.4','NO'),(1172,170,'1.4','NA'),(1173,171,'1.4','NO'),(1174,172,'1.4','SI'),(1175,173,'2.1','SI'),(1176,173,'2.2','SI'),(1177,173,'2.3','SI'),(1178,173,'2.4','SI'),(1179,173,'2.5','SI'),(1180,173,'2.6','SI'),(1181,173,'2.7','SI'),(1182,173,'2.8','SI'),(1183,173,'2.9','SI'),(1184,174,'2.1','NO'),(1185,174,'2.2','NO'),(1186,174,'2.3','NO'),(1187,174,'2.4','NO'),(1188,175,'2.1','NA'),(1189,175,'2.2','NA'),(1190,175,'2.3','NA'),(1191,175,'2.4','NA'),(1192,176,'2.1','NO'),(1193,176,'2.2','NO'),(1194,176,'2.3','NO'),(1195,176,'2.4','NO'),(1196,177,'2.1','SI'),(1197,177,'2.2','SI'),(1198,177,'2.3','SI'),(1199,177,'2.4','SI'),(1200,178,'2.5','SI'),(1201,178,'2.6','SI'),(1202,178,'2.7','SI'),(1203,178,'2.8','SI'),(1204,178,'2.9','SI'),(1205,179,'2.5','SI'),(1206,179,'2.6','SI'),(1207,179,'2.7','SI'),(1208,179,'2.8','SI'),(1209,179,'2.9','SI'),(1210,180,'2.5','NA'),(1211,180,'2.6','NA'),(1212,180,'2.7','NA'),(1213,180,'2.8','NA'),(1214,180,'2.9','NA'),(1215,181,'2.5','SI'),(1216,181,'2.6','SI'),(1217,181,'2.7','SI'),(1218,181,'2.8','SI'),(1219,181,'2.9','SI'),(1220,182,'2.5','NO'),(1221,182,'2.6','NO'),(1222,182,'2.7','NO'),(1223,182,'2.8','NO'),(1224,182,'2.9','NO'),(1225,183,'3.1','NO'),(1226,183,'3.2','NO'),(1227,184,'3.1','NA'),(1228,184,'3.2','NA'),(1229,185,'3.1','SI'),(1230,185,'3.2','SI'),(1231,186,'3.1','NO'),(1232,186,'3.2','NO'),(1233,187,'3.1','NA'),(1234,187,'3.2','NA'),(1235,188,'3.1','SI'),(1236,188,'3.2','SI'),(1237,189,'3.1','SI'),(1238,189,'3.2','SI'),(1239,190,'3.1','NO'),(1240,190,'3.2','NO'),(1241,191,'4.1','SI'),(1242,191,'4.2','SI'),(1243,192,'4.1','NA'),(1244,192,'4.2','NA'),(1245,193,'4.1','SI'),(1246,193,'4.2','SI'),(1247,194,'4.1','NO'),(1248,194,'4.2','NO'),(1249,195,'4.1','NA'),(1250,195,'4.2','NA'),(1251,196,'5.1','SI'),(1252,196,'5.2','SI'),(1253,196,'6.1','SI'),(1254,196,'6.2','SI'),(1255,196,'6.3','SI'),(1256,196,'6.4','SI'),(1257,196,'6.5','SI'),(1258,196,'7.1','SI'),(1259,196,'7.2','SI'),(1260,196,'7.3','SI'),(1261,197,'5.1','NO'),(1262,197,'5.2','NO'),(1263,198,'5.1','NA'),(1264,198,'5.2','NA'),(1265,199,'5.1','SI'),(1266,199,'5.2','SI'),(1267,200,'5.1','NO'),(1268,200,'5.2','NO'),(1269,201,'5.1','NA'),(1270,201,'5.2','NA'),(1271,202,'6.1','SI'),(1272,202,'6.2','SI'),(1273,202,'6.3','SI'),(1274,202,'6.4','SI'),(1275,202,'6.5','SI'),(1276,203,'6.1','NO'),(1277,203,'6.2','NO'),(1278,203,'6.3','NO'),(1279,203,'6.4','NO'),(1280,203,'6.5','NO'),(1281,204,'6.1','NA'),(1282,204,'6.2','NA'),(1283,204,'6.3','NA'),(1284,204,'6.4','NA'),(1285,204,'6.5','NA'),(1286,205,'6.1','SI'),(1287,205,'6.2','SI'),(1288,205,'6.3','SI'),(1289,205,'6.4','SI'),(1290,205,'6.5','SI'),(1291,206,'6.1','SI'),(1292,206,'6.2','SI'),(1293,206,'6.3','SI'),(1294,206,'6.4','SI'),(1295,206,'6.5','SI'),(1296,207,'6.1','NO'),(1297,207,'6.2','NO'),(1298,207,'6.3','NO'),(1299,207,'6.4','NO'),(1300,207,'6.5','NO'),(1301,208,'6.1','NA'),(1302,208,'6.2','NA'),(1303,208,'6.3','NA'),(1304,208,'6.4','NA'),(1305,208,'6.5','NA'),(1306,209,'7.1','SI'),(1307,209,'7.2','SI'),(1308,209,'7.3','SI'),(1309,210,'7.1','NO'),(1310,210,'7.2','NO'),(1311,210,'7.3','NO'),(1312,211,'7.1','NA'),(1313,211,'7.2','NA'),(1314,211,'7.3','NA'),(1315,212,'7.1','SI'),(1316,212,'7.2','SI'),(1317,212,'7.3','SI'),(1318,213,'7.1','NO'),(1319,213,'7.2','NO'),(1320,213,'7.3','NO'),(1321,214,'7.1','NA'),(1322,214,'7.2','NA'),(1323,214,'7.3','NA'),(1324,228,'1.1','SI'),(1325,228,'1.2','NO'),(1326,228,'1.3','NA'),(1327,228,'1.4','NO'),(1328,228,'2.1','NA'),(1329,228,'2.2','NO'),(1330,228,'2.3','SI'),(1331,228,'2.4','NO'),(1332,228,'2.5','NO'),(1333,228,'2.6','SI'),(1334,228,'2.7','SI'),(1335,228,'2.8','NA'),(1336,228,'2.9','NA'),(1337,228,'3.1','NA'),(1338,228,'3.2','SI'),(1339,228,'4.1','NO'),(1340,228,'4.2','NA'),(1341,228,'5.1','NA'),(1342,228,'5.2','SI'),(1343,228,'6.1','NA'),(1344,228,'6.2','NO'),(1345,228,'6.3','SI'),(1346,228,'6.4','NO'),(1347,228,'6.5','NO'),(1348,228,'7.1','NA'),(1349,228,'7.2','NO'),(1350,228,'7.3','NA'),(1351,231,'1.1','NO'),(1352,231,'1.2','SI'),(1353,231,'1.3','NO'),(1354,231,'1.4','NA'),(1355,231,'2.1','SI'),(1356,231,'2.2','SI'),(1357,231,'2.3','NO'),(1358,231,'2.4','NO'),(1359,231,'2.5','NA'),(1360,231,'2.6','NA'),(1361,231,'2.7','NO'),(1362,231,'2.8','SI'),(1363,231,'2.9','SI'),(1364,231,'3.1','NA'),(1365,231,'3.2','SI'),(1366,231,'4.1','NO'),(1367,231,'4.2','SI'),(1368,231,'5.1','SI'),(1369,231,'5.2','NO'),(1370,231,'6.1','NO'),(1371,231,'6.2','SI'),(1372,231,'6.3','NO'),(1373,231,'6.4','NA'),(1374,231,'6.5','NO'),(1375,231,'7.2','SI'),(1376,231,'7.3','NO'),(1377,232,'1.1','SI'),(1378,232,'1.2','SI'),(1379,232,'1.3','SI'),(1380,232,'1.4','SI'),(1381,232,'2.1','SI'),(1382,232,'2.2','SI'),(1383,233,'1.1','SI'),(1384,233,'1.2','SI'),(1385,233,'1.3','NO'),(1386,233,'1.4','NO'),(1387,233,'2.1','NO'),(1388,233,'2.2','NO'),(1389,233,'2.3','NO'),(1390,233,'2.4','NO'),(1391,233,'2.5','NA'),(1392,233,'2.6','NA'),(1393,233,'2.7','NO'),(1394,233,'2.8','NA'),(1395,233,'2.9','SI'),(1396,233,'3.1','NA'),(1397,233,'3.2','SI'),(1398,233,'4.1','SI'),(1399,233,'4.2','NO'),(1400,233,'5.1','NO'),(1401,233,'5.2','NA'),(1402,233,'6.1','NA'),(1403,233,'6.2','SI'),(1404,233,'6.3','NA'),(1405,233,'6.4','NO'),(1406,233,'6.5','SI'),(1407,233,'7.1','SI'),(1408,233,'7.2','NA'),(1409,233,'7.3','NO'),(1410,234,'1.1','SI'),(1411,234,'1.2','NO'),(1412,234,'1.3','NO'),(1413,234,'1.4','NA'),(1414,234,'2.1','SI'),(1415,234,'2.2','NO'),(1416,234,'2.3','SI'),(1417,234,'2.4','NO'),(1418,234,'2.5','NA'),(1419,234,'2.6','NO'),(1420,234,'2.7','SI'),(1421,234,'2.8','NO'),(1422,234,'2.9','NO'),(1423,234,'3.1','SI'),(1424,234,'3.2','NA'),(1425,234,'4.1','NO'),(1426,234,'4.2','SI'),(1427,234,'5.1','SI'),(1428,234,'5.2','NO'),(1429,234,'6.1','NA'),(1430,234,'6.2','NA'),(1431,234,'6.3','NO'),(1432,234,'6.4','SI'),(1433,234,'6.5','SI'),(1434,234,'7.1','NA'),(1435,234,'7.2','SI'),(1436,234,'7.3','NO'),(1437,235,'1.1','SI'),(1438,235,'1.2','SI'),(1439,236,'6.3','NO'),(1440,236,'6.4','NO'),(1441,236,'6.5','NO'),(1442,236,'7.1','NO'),(1443,236,'7.2','NO'),(1444,236,'7.3','NO');
/*!40000 ALTER TABLE `eva_resp_eva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluaciones_eva`
--

DROP TABLE IF EXISTS `evaluaciones_eva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluaciones_eva` (
  `id_eva` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_eva` varchar(120) NOT NULL,
  `date_eva` date NOT NULL,
  `celular_eva` varchar(30) DEFAULT NULL,
  `servicios_eva` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`servicios_eva`)),
  `observaciones_eva` text DEFAULT NULL,
  `aprobado_eva` enum('SI','NO') DEFAULT NULL,
  `created_at_eva` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_eva`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones_eva`
--

LOCK TABLES `evaluaciones_eva` WRITE;
/*!40000 ALTER TABLE `evaluaciones_eva` DISABLE KEYS */;
INSERT INTO `evaluaciones_eva` VALUES (1,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:32:44'),(2,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:33:27'),(3,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:33:44'),(4,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:34:15'),(5,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:35:45'),(6,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:38:34'),(7,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:40:11'),(8,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:44:58'),(9,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:46:54'),(10,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:47:54'),(11,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 15:49:47'),(12,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 16:05:16'),(13,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Esta bien',NULL,'2025-08-29 16:17:01'),(14,'eqwewq','2025-08-29','2323213123123','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_integracion\"]','123213123123',NULL,'2025-08-29 16:18:38'),(15,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:23:55'),(16,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:28:15'),(17,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:15'),(18,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:17'),(19,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:22'),(20,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:34'),(21,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:42'),(22,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:33:45'),(23,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:35:05'),(24,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:44:58'),(25,'Brayan','2025-08-29','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','bien','SI','2025-08-29 16:45:19'),(26,'Brayan','2025-08-29','3232274352','[\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','Excelente','SI','2025-08-29 16:50:39'),(27,'','0000-00-00','',NULL,'',NULL,'2025-09-01 14:46:10'),(28,'brayan','2025-09-01','2321323213','[\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','sddssadasdas','SI','2025-09-01 15:01:05'),(29,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\"]','gvhb vv b','NO','2025-09-01 16:10:41'),(30,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\"]','gvhb vv b','SI','2025-09-01 16:10:49'),(31,'Brayan','2025-09-01','323232323232','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','Bien','SI','2025-09-01 16:18:27'),(32,'Brayan','2025-09-01','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]','Bien perfecto XD','SI','2025-09-01 17:09:24'),(33,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','NO','2025-09-01 17:15:49'),(34,'Brayan','2025-09-02','32323332221','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_integracion\"]','Excelente mal','SI','2025-09-02 09:42:43'),(35,'Brayan','2025-09-02','3232274352','[\"servicio_fabricacion_pcb\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 09:44:27'),(36,'Brayan','2025-09-02','3232274352','[\"servicio_fabricacion_pcb\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','La búsqueda de la perfección como estancamiento: Un texto largo podría explorar el concepto de que la \"perfección\" es un espejismo que lleva al estancamiento, mientras que la constancia es una cualidad dinámica que permite el progreso constante y significativo','SI','2025-09-02 09:45:07'),(37,'','0000-00-00','',NULL,'','NO','2025-09-02 09:51:24'),(38,'','0000-00-00','',NULL,'','SI','2025-09-02 09:52:13'),(39,'','0000-00-00','',NULL,'','SI','2025-09-02 10:02:36'),(40,'','0000-00-00','',NULL,'','SI','2025-09-02 10:21:42'),(41,'','0000-00-00','',NULL,'','SI','2025-09-02 10:22:06'),(42,'','0000-00-00','',NULL,'','SI','2025-09-02 10:44:27'),(43,'','0000-00-00','',NULL,'','SI','2025-09-02 10:48:24'),(44,'','0000-00-00','',NULL,'','SI','2025-09-02 10:49:01'),(45,'','0000-00-00','',NULL,'','SI','2025-09-02 10:49:44'),(46,'','0000-00-00','',NULL,'','SI','2025-09-02 10:50:00'),(47,'','0000-00-00','',NULL,'','SI','2025-09-02 10:54:53'),(48,'','0000-00-00','',NULL,'','SI','2025-09-02 11:01:09'),(49,'','0000-00-00','',NULL,'','SI','2025-09-02 11:03:03'),(50,'','0000-00-00','',NULL,'','SI','2025-09-02 11:08:41'),(51,'','0000-00-00','',NULL,'','SI','2025-09-02 11:43:00'),(52,'','0000-00-00','',NULL,'','SI','2025-09-02 14:06:45'),(53,'','0000-00-00','',NULL,'','SI','2025-09-02 14:12:46'),(54,'','0000-00-00','',NULL,'','SI','2025-09-02 14:13:18'),(55,'','0000-00-00','',NULL,'','SI','2025-09-02 14:20:42'),(56,'','0000-00-00','',NULL,'','SI','2025-09-02 14:35:43'),(57,'','0000-00-00','',NULL,'','SI','2025-09-02 15:04:17'),(58,'','0000-00-00','',NULL,'','NO','2025-09-02 15:04:35'),(59,'','0000-00-00','',NULL,'','SI','2025-09-02 15:11:10'),(60,'','0000-00-00','',NULL,'','NO','2025-09-02 15:13:20'),(61,'','0000-00-00','',NULL,'','NO','2025-09-02 15:18:45'),(62,'','0000-00-00','',NULL,'','NO','2025-09-02 15:24:24'),(63,'','0000-00-00','',NULL,'','NO','2025-09-02 15:44:10'),(64,'vdgsgdsgdfgdf','0000-00-00','43242342423','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_integracion\"]','dffbfsbkjsdbbjhs bhjsb sbfjhhjdsbfhj bjh','SI','2025-09-02 15:49:21'),(65,'','0000-00-00','',NULL,'','NO','2025-09-02 16:02:17'),(66,'','0000-00-00','',NULL,'','NO','2025-09-02 16:03:13'),(67,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_integracion\"]','Xddddddddddddddddddd','NO','2025-09-02 16:12:14'),(68,'','0000-00-00','',NULL,'','SI','2025-09-02 16:19:23'),(69,'Brayan','2025-09-02','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','Excelente','SI','2025-09-02 16:24:15'),(70,'Brayan','2025-09-02','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','Excelente','SI','2025-09-02 16:26:10'),(71,'Brayan','2025-09-02','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]','Excelente','SI','2025-09-02 16:34:54'),(72,'Brayan','2025-09-02','3232274352','[\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_integracion\"]','','SI','2025-09-02 16:45:33'),(73,'xdddddddddd','0000-00-00','',NULL,'','SI','2025-09-02 16:57:46'),(74,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:00:17'),(75,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:04:40'),(76,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:05:22'),(77,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:06:40'),(78,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:07:24'),(79,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:08:12'),(80,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:08:57'),(81,'Brayan Andrey Perdomo Guali','0000-00-00','',NULL,'','SI','2025-09-02 17:10:07'),(82,'','2025-09-02','',NULL,'','SI','2025-09-02 17:11:18'),(83,'','2025-09-02','',NULL,'','SI','2025-09-02 17:12:44'),(84,'','2025-09-02','',NULL,'','SI','2025-09-02 17:13:41'),(85,'','2025-09-02','',NULL,'','SI','2025-09-02 17:14:28'),(86,'Brayan Andrey Perdomo Guali','2025-09-02','',NULL,'','SI','2025-09-02 17:15:32'),(87,'Brayan Andrey Perdomo Guali','2025-09-02','3232274352',NULL,'','SI','2025-09-02 17:16:10'),(88,'','0000-00-00','3232274352',NULL,'','SI','2025-09-02 17:17:20'),(89,'','0000-00-00','3232274352',NULL,'','SI','2025-09-02 17:18:23'),(90,'','0000-00-00','3232274352',NULL,'','SI','2025-09-02 17:18:26'),(91,'Brayan Andrey Perdomo Guali','2025-09-02','3232274352',NULL,'','SI','2025-09-02 17:19:04'),(92,'Brayan Andrey Perdomo Guali','2025-09-02','3232274352','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:20:40'),(93,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:22:27'),(94,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:23:23'),(95,'','0000-00-00','','[\"servicio_montaje\"]','','SI','2025-09-02 17:24:37'),(96,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:25:17'),(97,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:25:57'),(98,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-02 17:26:48'),(99,'','0000-00-00','','[\"servicio_integracion\"]','','SI','2025-09-02 17:27:36'),(100,'','0000-00-00','','[\"servicio_integracion\"]','','SI','2025-09-02 17:28:18'),(101,'','0000-00-00','','[\"servicio_integracion\"]','','SI','2025-09-02 17:29:06'),(102,'','0000-00-00','','[\"servicio_integracion\"]','','SI','2025-09-02 17:29:49'),(103,'','0000-00-00','','[\"servicio_integracion\"]','','SI','2025-09-02 17:31:08'),(104,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:18:02'),(105,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:19:13'),(106,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:20:12'),(107,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:21:21'),(108,'','0000-00-00','','[\"servicio_montaje\"]','','SI','2025-09-03 08:22:08'),(109,'','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:23:19'),(110,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:26:45'),(111,'','0000-00-00','','[\"servicio_transferencia\"]','','SI','2025-09-03 08:27:55'),(112,'','0000-00-00','','[\"servicio_transferencia\"]','','SI','2025-09-03 08:28:31'),(113,'','0000-00-00','','[\"servicio_transferencia\"]','','SI','2025-09-03 08:29:31'),(114,'','0000-00-00','','[\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:30:06'),(115,'','0000-00-00','','[\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:31:04'),(116,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:31:53'),(117,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:32:45'),(118,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:33:22'),(119,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:33:58'),(120,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:34:46'),(121,'','0000-00-00','','[\"servicio_diseno_3d\"]','','SI','2025-09-03 08:35:40'),(122,'','0000-00-00','','[\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:36:22'),(123,'','0000-00-00','','[\"servicio_impresion_3d\"]','','SI','2025-09-03 08:37:22'),(124,'','0000-00-00','','[\"servicio_impresion_3d\"]','','SI','2025-09-03 08:38:11'),(125,'','0000-00-00','','[\"servicio_impresion_3d\"]','','SI','2025-09-03 08:38:47'),(126,'','0000-00-00','','[\"servicio_impresion_3d\"]','','SI','2025-09-03 08:39:38'),(127,'','0000-00-00','','[\"servicio_impresion_3d\"]','','SI','2025-09-03 08:40:22'),(128,'','0000-00-00','','[\"servicio_fabricacion_pcb\"]','','SI','2025-09-03 08:41:18'),(129,'','0000-00-00','','[\"servicio_fabricacion_pcb\"]','','SI','2025-09-03 08:42:49'),(130,'','0000-00-00','','[\"servicio_fabricacion_pcb\"]','','SI','2025-09-03 08:43:28'),(131,'','0000-00-00','','[\"servicio_fabricacion_pcb\"]','','SI','2025-09-03 08:43:28'),(132,'','0000-00-00','','[\"servicio_fabricacion_pcb\"]','','SI','2025-09-03 08:44:09'),(133,'','0000-00-00','','[\"servicio_diseno_pcb\"]','','SI','2025-09-03 08:45:02'),(134,'','0000-00-00','','[\"servicio_diseno_pcb\"]','','SI','2025-09-03 08:45:47'),(135,'','0000-00-00','','[\"servicio_diseno_pcb\"]','','SI','2025-09-03 08:46:22'),(136,'','0000-00-00','','[\"servicio_diseno_pcb\"]','','SI','2025-09-03 08:47:14'),(137,'Brayan Andrey Perdomo Guali','2025-09-03','3232274352','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','','SI','2025-09-03 08:48:08'),(138,'','0000-00-00','',NULL,'','SI','2025-09-03 08:49:36'),(139,'','0000-00-00','',NULL,'','SI','2025-09-03 08:53:06'),(140,'','0000-00-00','',NULL,'','SI','2025-09-03 08:54:14'),(141,'','0000-00-00','',NULL,'','SI','2025-09-03 08:55:01'),(142,'','0000-00-00','',NULL,'','SI','2025-09-03 08:56:11'),(143,'','0000-00-00','',NULL,'','SI','2025-09-03 08:56:57'),(144,'','0000-00-00','',NULL,'','SI','2025-09-03 08:57:48'),(145,'','0000-00-00','',NULL,'','SI','2025-09-03 08:58:36'),(146,'','0000-00-00','',NULL,'','SI','2025-09-03 08:59:53'),(147,'','0000-00-00','',NULL,'','SI','2025-09-03 09:00:40'),(148,'','0000-00-00','',NULL,'','SI','2025-09-03 09:01:15'),(149,'','0000-00-00','',NULL,'','SI','2025-09-03 09:01:57'),(150,'','0000-00-00','',NULL,'','SI','2025-09-03 09:03:00'),(151,'','0000-00-00','',NULL,'','SI','2025-09-03 09:03:45'),(152,'','0000-00-00','',NULL,'','SI','2025-09-03 09:04:21'),(153,'','0000-00-00','',NULL,'','SI','2025-09-03 09:04:22'),(154,'','0000-00-00','',NULL,'','SI','2025-09-03 09:05:09'),(155,'','0000-00-00','',NULL,'','SI','2025-09-03 09:05:49'),(156,'','0000-00-00','',NULL,'','SI','2025-09-03 09:06:47'),(157,'','0000-00-00','',NULL,'','SI','2025-09-03 09:07:44'),(158,'','0000-00-00','',NULL,'','SI','2025-09-03 09:08:36'),(159,'','0000-00-00','',NULL,'','SI','2025-09-03 09:09:37'),(160,'','0000-00-00','',NULL,'','SI','2025-09-03 09:10:15'),(161,'','0000-00-00','',NULL,'','SI','2025-09-03 09:10:57'),(162,'','0000-00-00','',NULL,'','SI','2025-09-03 09:11:33'),(163,'','0000-00-00','',NULL,'','SI','2025-09-03 09:11:58'),(164,'','0000-00-00','',NULL,'','SI','2025-09-03 09:12:16'),(165,'','0000-00-00','',NULL,'','SI','2025-09-03 09:13:21'),(166,'','0000-00-00','',NULL,'','SI','2025-09-03 09:13:50'),(167,'','0000-00-00','',NULL,'','SI','2025-09-03 09:14:04'),(168,'','0000-00-00','',NULL,'','SI','2025-09-03 09:15:00'),(169,'','0000-00-00','',NULL,'','SI','2025-09-03 09:15:47'),(170,'','0000-00-00','',NULL,'','SI','2025-09-03 09:16:29'),(171,'','0000-00-00','',NULL,'','SI','2025-09-03 09:16:57'),(172,'','0000-00-00','',NULL,'','SI','2025-09-03 09:17:11'),(173,'','0000-00-00','',NULL,'','SI','2025-09-03 09:18:45'),(174,'','0000-00-00','',NULL,'','SI','2025-09-03 09:20:25'),(175,'','0000-00-00','',NULL,'','SI','2025-09-03 09:21:57'),(176,'','0000-00-00','',NULL,'','SI','2025-09-03 09:22:44'),(177,'','0000-00-00','',NULL,'','SI','2025-09-03 09:23:01'),(178,'','0000-00-00','',NULL,'','SI','2025-09-03 09:24:39'),(179,'','0000-00-00','',NULL,'','SI','2025-09-03 09:25:47'),(180,'','0000-00-00','',NULL,'','SI','2025-09-03 09:27:36'),(181,'','0000-00-00','',NULL,'','SI','2025-09-03 09:29:19'),(182,'','0000-00-00','',NULL,'','SI','2025-09-03 09:30:26'),(183,'','0000-00-00','',NULL,'','SI','2025-09-03 09:32:14'),(184,'','0000-00-00','',NULL,'','SI','2025-09-03 09:33:13'),(185,'','0000-00-00','',NULL,'','SI','2025-09-03 09:34:04'),(186,'','0000-00-00','',NULL,'','SI','2025-09-03 09:34:49'),(187,'','0000-00-00','',NULL,'','SI','2025-09-03 09:35:32'),(188,'','0000-00-00','',NULL,'','SI','2025-09-03 09:36:10'),(189,'','0000-00-00','',NULL,'','SI','2025-09-03 09:36:24'),(190,'','0000-00-00','',NULL,'','SI','2025-09-03 09:37:03'),(191,'','0000-00-00','',NULL,'','SI','2025-09-03 09:38:17'),(192,'','0000-00-00','',NULL,'','SI','2025-09-03 09:39:08'),(193,'','0000-00-00','',NULL,'','SI','2025-09-03 09:40:15'),(194,'','0000-00-00','',NULL,'','SI','2025-09-03 09:40:57'),(195,'','0000-00-00','',NULL,'','SI','2025-09-03 09:41:30'),(196,'','0000-00-00','',NULL,'','SI','2025-09-03 09:42:57'),(197,'','0000-00-00','',NULL,'','SI','2025-09-03 09:44:41'),(198,'','0000-00-00','',NULL,'','SI','2025-09-03 09:45:37'),(199,'','0000-00-00','',NULL,'','SI','2025-09-03 09:46:30'),(200,'','0000-00-00','',NULL,'','SI','2025-09-03 09:47:25'),(201,'','0000-00-00','',NULL,'','SI','2025-09-03 09:48:05'),(202,'','0000-00-00','',NULL,'','SI','2025-09-03 09:48:38'),(203,'','0000-00-00','',NULL,'','SI','2025-09-03 09:50:57'),(204,'','0000-00-00','',NULL,'','SI','2025-09-03 09:52:10'),(205,'','0000-00-00','',NULL,'','SI','2025-09-03 09:53:51'),(206,'','0000-00-00','',NULL,'','SI','2025-09-03 09:53:52'),(207,'','0000-00-00','',NULL,'','SI','2025-09-03 09:55:24'),(208,'','0000-00-00','',NULL,'','SI','2025-09-03 09:56:00'),(209,'','0000-00-00','',NULL,'','SI','2025-09-03 09:56:52'),(210,'','0000-00-00','',NULL,'','SI','2025-09-03 09:58:15'),(211,'','0000-00-00','',NULL,'','SI','2025-09-03 09:59:40'),(212,'','0000-00-00','',NULL,'','SI','2025-09-03 10:00:33'),(213,'','0000-00-00','',NULL,'','SI','2025-09-03 10:01:39'),(214,'','0000-00-00','',NULL,'','SI','2025-09-03 10:02:20'),(215,'','0000-00-00','',NULL,'','SI','2025-09-03 10:03:12'),(216,'','0000-00-00','',NULL,'','SI','2025-09-03 10:03:59'),(217,'','0000-00-00','',NULL,'','SI','2025-09-03 10:04:47'),(218,'','0000-00-00','',NULL,'','SI','2025-09-03 10:05:36'),(219,'','0000-00-00','',NULL,'','SI','2025-09-03 10:06:18'),(220,'','0000-00-00','',NULL,'','SI','2025-09-03 10:07:35'),(221,'','0000-00-00','',NULL,'','NO','2025-09-03 10:08:19'),(222,'','0000-00-00','',NULL,'','NO','2025-09-03 10:09:15'),(223,'','0000-00-00','',NULL,'','NO','2025-09-03 10:10:07'),(224,'','0000-00-00','',NULL,'','NO','2025-09-03 10:11:07'),(225,'','0000-00-00','',NULL,'El laboratorio de electrónica es una sala equipada con instrumentos y herramientas especializadas donde estudiantes e ingenieros realizan experimentos, analizan y diseñan dispositivos electrónicos. Su objetivo es fomentar la innovación y el desarrollo en el campo de la electrónica, que es fundamental para la tecnología moderna.','SI','2025-09-03 10:12:26'),(226,'','0000-00-00','',NULL,'El laboratorio de electrónica es una sala equipada con instrumentos y herramientas especializadas donde estudiantes e ingenieros realizan experimentos, analizan y diseñan dispositivos electrónicos. Su objetivo es fomentar la innovación y el desarrollo en el campo de la electrónica, que es fundamental para la tecnología moderna.','SI','2025-09-03 10:13:37'),(227,'','0000-00-00','',NULL,'El laboratorio de electrónica es una sala equipada con instrumentos y herramientas especializadas donde estudiantes e ingenieros realizan experimentos, analizan y diseñan dispositivos electrónicos. Su objetivo es fomentar la innovación y el desarrollo en el campo de la electrónica, que es fundamental para la tecnología moderna.','SI','2025-09-03 10:14:18'),(228,'Brayan Andrey Perdomo Guali','2025-09-03','3232274352','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_integracion\"]','Un laboratorio es un lugar donde se llevan a cabo experimentos, investigaciones, prácticas y trabajos de carácter científico y tecnológico. Está equipado con instrumentos de medida y medios necesarios para realizar investigaciones en diferentes áreas, como la química, física, biología, metrología, entre otros. Existen diversos tipos de laboratorios, cada uno especializado en estudiar compuestos y mezclas de elementos para comprobar las teorías de cada ciencia. Es muy importante prestar atención a la seguridad en el laboratorio, y cumplir con las normas establecidas para evitar cualquier tipo de riesgo en el lugar','SI','2025-09-03 10:16:59'),(229,'','0000-00-00','',NULL,'bfsdhbfhdsbsdfhdsbjhfbshjdsbfdsbh fsdhbfhbfhdjdbf h h hj  jkjkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk lllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn lññññññññññññññññññññññññññññññññññññññññññññññññññññññ qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq','SI','2025-09-03 10:22:16'),(230,'','0000-00-00','',NULL,'Un laboratorio es un espacio diseñado para realizar investigaciones, experimentos y prácticas que permiten comprobar teorías y obtener resultados en diversas áreas científicas y tecnológicas. Está equipado con instrumentos, equipos de medida y recursos necesarios para garantizar la precisión de los ensayos y la validez de los datos. En estos lugares se desarrollan actividades relacionadas con química, física, biología y otras ciencias aplicadas. Cada laboratorio cuenta con normas de seguridad que deben cumplirse rigurosamente, pues la protección del personal es esencial. El respeto a estas reglas asegura un entorno controlado y confiable.','SI','2025-09-03 10:23:45'),(231,'Brayan Andrey Perdomo Guali','2025-09-03','3232274352','[\"servicio_diseno_pcb\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','Un laboratorio es un espacio diseñado para realizar investigaciones, experimentos y prácticas que permiten comprobar teorías y obtener resultados en diversas áreas científicas y tecnológicas. Está equipado con instrumentos, equipos de medida y recursos necesarios para garantizar la precisión de los ensayos y la validez de los datos. En estos lugares se desarrollan actividades relacionadas con química, física, biología y otras ciencias aplicadas. Cada laboratorio cuenta con normas de seguridad que deben cumplirse rigurosamente, pues la protección del personal es esencial. El respeto a estas reglas asegura un entorno controlado y confiable.','SI','2025-09-03 10:27:59'),(232,'','0000-00-00','',NULL,'','SI','2025-09-03 10:31:09'),(233,'sadsadas','2025-09-03','323233323','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_integracion\"]','dasdsadsadasdasd','NO','2025-09-03 11:40:07'),(234,'Brayan Andrey Perdomo Guali','2025-09-03','3232274352','[\"servicio_diseno_pcb\",\"servicio_fabricacion_pcb\",\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\",\"servicio_integracion\"]','teoría antideslumbrante xd','NO','2025-09-03 14:35:42'),(235,'SDSDASDASD','0000-00-00','','[\"servicio_diseno_pcb\",\"servicio_impresion_3d\"]','DASDSADA','NO','2025-09-03 14:44:23'),(236,'SDASDASDASDASDASDAS','2025-09-03','32132123132',NULL,'asAASDSDASDA','NO','2025-09-03 14:46:32');
/*!40000 ALTER TABLE `evaluaciones_eva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generated_pdfs`
--

DROP TABLE IF EXISTS `generated_pdfs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generated_pdfs` (
  `id_pdf` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `relative_path` varchar(500) NOT NULL,
  `mime_type` varchar(100) NOT NULL DEFAULT 'application/pdf',
  `size_bytes` bigint(20) unsigned NOT NULL,
  `area` enum('electronica','cafe') DEFAULT NULL,
  `form_type` varchar(100) DEFAULT NULL,
  `created_by_user` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sha256_hash` char(64) DEFAULT NULL,
  `download_count` int(10) unsigned NOT NULL DEFAULT 0,
  `metadata_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata_json`)),
  PRIMARY KEY (`id_pdf`),
  UNIQUE KEY `uq_generated_pdfs_filename` (`filename`),
  KEY `idx_generated_pdfs_created_at` (`created_at`),
  KEY `idx_generated_pdfs_area` (`area`),
  KEY `idx_generated_pdfs_form_type` (`form_type`),
  KEY `idx_generated_pdfs_user` (`created_by_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generated_pdfs`
--

LOCK TABLES `generated_pdfs` WRITE;
/*!40000 ALTER TABLE `generated_pdfs` DISABLE KEYS */;
INSERT INTO `generated_pdfs` VALUES (10,'solicitud_servicio-1234567890.pdf','solicitud_servicio.pdf','/sennova/public/pdfs/2025/09/solicitud_servicio-1234567890.pdf','application/pdf',1906935,NULL,'form1_solicitud',NULL,'2025-09-11 11:01:12','469380308381312ee4ee2e809dc70401356ee7ee53bd394aa1ea49ca2f10e1af',0,'{\"numero_solicitud\":\"\",\"fecha\":\"2025-09-12\",\"cliente\":{\"razon\":\"Mamama\",\"nit\":\"1234567890\",\"email\":\"yinko@gmail.com\"}}'),(11,'evaluacion_capacidad_tecnica.pdf','evaluacion_capacidad_tecnica.pdf','/sennova/public/pdfs/2025/09/evaluacion_capacidad_tecnica.pdf','application/pdf',3221980,NULL,'form2_evaluacion',NULL,'2025-09-11 11:01:40','93aac7500dbc4f65dc15db892b128006da244f2f7418f691798d12b2051c9f85',0,'{\"nombre\":\"Mamama\",\"fecha\":\"2025-09-12\"}'),(12,'solicitud_servicio-9876543210.pdf','solicitud_servicio.pdf','/sennova/public/pdfs/2025/09/solicitud_servicio-9876543210.pdf','application/pdf',1906936,NULL,'form1_solicitud',NULL,'2025-09-11 11:11:06','acd4671f391361c712e413ed911e368e70ebdbcf2f6a65498e4e7e9ef86c06db',0,'{\"numero_solicitud\":\"\",\"fecha\":\"2025-09-11\",\"cliente\":{\"razon\":\"mamama\",\"nit\":\"9876543210\",\"email\":\"yinko@gmail.com\"}}'),(13,'Cotizacion-9876543210.pdf','Cotizacion.pdf','/sennova/public/pdfs/2025/09/Cotizacion-9876543210.pdf','application/pdf',1010274,NULL,'form3_cotizacion',NULL,'2025-09-11 11:11:41','81cbb3ac889d599ca55630145defd8448c0c53730d5e65758c075e592b9525f9',0,NULL),(14,'solicitud_servicio-654654564.pdf','solicitud_servicio.pdf','/sennova/public/pdfs/2025/09/solicitud_servicio-654654564.pdf','application/pdf',1906978,NULL,'form1_solicitud',NULL,'2025-09-11 11:20:02','e18a04dfcb137a4afb595b20e4316026d61ee4ac1a91d1ca729f6404d8ab6656',0,'{\"numero_solicitud\":\"\",\"fecha\":\"2025-09-12\",\"cliente\":{\"razon\":\"Mamama\",\"nit\":\"654654564\",\"email\":\"yinko@gmail.com\"}}');
/*!40000 ALTER TABLE `generated_pdfs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestion_botones`
--

DROP TABLE IF EXISTS `gestion_botones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gestion_botones` (
  `id_ges` int(11) NOT NULL AUTO_INCREMENT,
  `name_but` varchar(255) DEFAULT NULL,
  `ruta_but` varchar(255) DEFAULT NULL,
  `color_but` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_ges`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_botones`
--

LOCK TABLES `gestion_botones` WRITE;
/*!40000 ALTER TABLE `gestion_botones` DISABLE KEYS */;
INSERT INTO `gestion_botones` VALUES (35,'Procesos Estratégicos','views/procesos/estrategico.php','#bd9201'),(39,'Procesos Misionales','views/procesos/misionales.php','#888a91'),(42,'Procesos Apoyo','views/procesos/apoyo.php','#337a56');
/*!40000 ALTER TABLE `gestion_botones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestion_subprocesos`
--

DROP TABLE IF EXISTS `gestion_subprocesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gestion_subprocesos` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sub` varchar(100) NOT NULL,
  `ruta_sub` varchar(100) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `Pro_padre` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_sub`),
  KEY `id_proceso` (`id_proceso`),
  CONSTRAINT `gestion_subprocesos_ibfk_1` FOREIGN KEY (`id_proceso`) REFERENCES `gestion_botones` (`id_ges`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_subprocesos`
--

LOCK TABLES `gestion_subprocesos` WRITE;
/*!40000 ALTER TABLE `gestion_subprocesos` DISABLE KEYS */;
INSERT INTO `gestion_subprocesos` VALUES (38,'Gestion tenica','te',39,'misionales.php','2025-08-20 20:38:46'),(39,'sera','sera',39,'misionales.php','2025-08-20 21:21:22'),(41,'recursos','re1',42,'apoyo.php','2025-08-21 14:47:05');
/*!40000 ALTER TABLE `gestion_subprocesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `leida` tinyint(1) DEFAULT 0,
  `fecha` datetime DEFAULT current_timestamp(),
  `request_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_request_id` (`request_id`),
  CONSTRAINT `fk_request_id` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id_re`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (12,'electronica','Solicitud de Andres para fisicoquimico',1,'2025-07-21 15:12:21',NULL),(13,'electronica','Solicitud de Milan para calidad',1,'2025-07-21 15:14:48',NULL),(14,'cafe','Solicitud de xd para calidad',1,'2025-07-21 15:19:23',NULL),(15,'electronica','Solicitud de Juan para Diseño de tarjetas de circuito impreso (PCB)',1,'2025-07-21 15:22:05',NULL),(16,'electronica','Solicitud de Manuel para Diseño de piezas 3D',1,'2025-07-21 16:09:24',NULL),(17,'electronica','Solicitud de Sofia para Fabricación de tarjetas PCB',1,'2025-08-01 08:33:52',NULL),(18,'electronica','Solicitud de Andrea para Fabricación de tarjetas PCB',1,'2025-08-01 08:38:01',NULL),(19,'electronica','Solicitud de dsds para Impresión de piezas 3D',1,'2025-08-01 08:53:02',NULL),(20,'electronica','Solicitud de sfdsfd para Fabricación de tarjetas PCB',1,'2025-08-01 08:56:10',NULL),(21,'electronica','Solicitud de dsada para Fabricación de tarjetas PCB',1,'2025-08-01 08:59:26',NULL),(22,'electronica','Solicitud de dsdsd para Impresión de piezas 3D',1,'2025-08-01 09:16:20',NULL),(23,'electronica','Solicitud de dsad para Diseño de piezas 3D',1,'2025-08-01 09:18:49',NULL),(24,'cafe','Solicitud de dsdas para calidad',1,'2025-08-01 09:28:37',NULL),(25,'cafe','Solicitud de rwerwe para fisicoquimico',1,'2025-08-01 09:31:11',NULL),(26,'cafe','Solicitud de dsad para calidad',1,'2025-08-01 09:32:37',NULL),(27,'electronica','Solicitud de dsdsd para Diseño de piezas 3D',1,'2025-08-01 09:41:41',NULL),(28,'cafe','Solicitud de asdasd para sensorial',1,'2025-08-01 09:41:55',NULL),(29,'cafe','Solicitud de fdsfsd para fisicoquimico',1,'2025-08-01 09:44:30',NULL),(30,'electronica','Solicitud de fsdf para Fabricación de tarjetas PCB',1,'2025-08-01 09:45:25',NULL),(31,'cafe','Solicitud de fsdf para calidad',1,'2025-08-01 09:48:22',NULL),(32,'cafe','Solicitud de MaickWare para asesoria',0,'2025-08-22 10:30:34',NULL),(33,'cafe','La solicitud con ID 35 ha sido Aceptada.',0,'2025-08-22 10:31:06',NULL),(34,'cafe','Solicitud de Procesos Apoyo para tueste',0,'2025-08-22 14:19:47',NULL),(35,'cafe','La solicitud con ID 36 ha sido Aceptada.',0,'2025-08-22 14:20:19',NULL),(36,'cafe','Solicitud de dsada para calidad',0,'2025-08-22 14:20:52',NULL),(37,'cafe','La solicitud con ID 37 ha sido Aceptada.',0,'2025-08-22 14:21:04',NULL),(38,'cafe','Solicitud de Brayan para fisicoquimico',0,'2025-08-22 14:21:37',NULL),(39,'cafe','La solicitud con ID 38 ha sido Aceptada.',0,'2025-08-22 14:21:50',NULL),(40,'cafe','Solicitud de Brayan para sensorial',0,'2025-08-22 14:35:40',NULL),(41,'cafe','La solicitud con ID 39 ha sido Aceptada.',0,'2025-08-22 14:35:55',NULL),(42,'cafe','Solicitud de Brayan Perdomo para fisicoquimico',0,'2025-08-22 15:32:12',NULL),(43,'cafe','La solicitud con ID 40 ha sido Aceptada.',0,'2025-08-22 15:32:51',NULL),(44,'cafe','Solicitud de Procesos Apoyo para calidad',0,'2025-08-22 15:44:19',NULL),(45,'cafe','La solicitud con ID 41 ha sido Aceptada.',0,'2025-08-22 15:44:35',NULL),(46,'cafe','Solicitud de Brayan Perdomo para calidad',0,'2025-08-22 15:47:25',NULL),(47,'cafe','Solicitud de Procesos Apoyo para sensorial',0,'2025-08-22 15:47:36',NULL),(48,'cafe','Solicitud de dsada para fisicoquimico',0,'2025-08-22 15:47:48',NULL),(49,'cafe','La solicitud con ID 42 ha sido Rechazada.',0,'2025-08-22 15:48:02',NULL),(50,'cafe','La solicitud con ID 43 ha sido Aceptada.',0,'2025-08-22 15:51:14',NULL),(51,'cafe','La solicitud con ID 44 ha sido Aceptada.',0,'2025-08-22 15:51:48',NULL),(52,'electronica','Solicitud de brayan  para Fabricación de tarjetas PCB',1,'2025-08-22 15:53:41',NULL),(53,'electronica','La solicitud con ID 45 ha sido Aceptada.',1,'2025-08-22 15:53:57',NULL),(54,'electronica','Solicitud de Brayan para Impresión de piezas 3D',1,'2025-08-22 15:55:23',NULL),(55,'electronica','La solicitud con ID 46 ha sido Rechazada.',1,'2025-08-22 15:56:00',NULL),(56,'electronica','Solicitud de dsadsadsa para Impresión de piezas 3D',1,'2025-08-22 15:59:23',NULL),(57,'electronica','La solicitud con ID 47 ha sido Aceptada.',1,'2025-08-22 15:59:37',NULL),(58,'cafe','Solicitud de 123 para sensorial',0,'2025-08-22 16:04:56',NULL),(59,'cafe','La solicitud con ID 48 ha sido Aceptada.',0,'2025-08-22 16:05:07',NULL),(60,'cafe','La solicitud con ID 48 ha sido Aceptada.',0,'2025-08-22 16:05:08',NULL),(61,'cafe','Solicitud de 432432432432 para calidad',0,'2025-08-22 16:06:44',NULL),(62,'cafe','La solicitud con ID 49 ha sido Aceptada.',0,'2025-08-22 16:06:51',NULL),(63,'cafe','Solicitud de Ultima prueba para fisicoquimico',0,'2025-08-22 16:09:26',NULL),(64,'cafe','La solicitud con ID 50 ha sido Rechazada.',0,'2025-08-22 16:09:47',NULL),(65,'electronica','Solicitud de Brayan para Diseño de piezas 3D',1,'2025-08-22 16:15:07',NULL),(66,'electronica','La solicitud con ID 51 ha sido Aceptada.',1,'2025-08-22 16:15:32',NULL),(67,'electronica','Solicitud de electronica para Diseño de piezas 3D',1,'2025-08-22 16:28:26',NULL),(68,'cafe','Solicitud de Cafe para calidad',0,'2025-08-22 16:28:42',NULL),(69,'cafe','La solicitud con ID 53 ha sido Aceptada.',0,'2025-08-22 16:28:56',NULL),(70,'electronica','La solicitud con ID 52 ha sido Aceptada.',1,'2025-08-22 16:29:56',NULL),(71,'cafe','Solicitud de Brayan para calidad',0,'2025-08-26 10:53:57',54),(72,'electronica','Solicitud de Perdomo para Diseño de piezas 3D',1,'2025-08-26 10:54:39',55),(73,'electronica','La solicitud con ID 55 ha sido Aceptada.',1,'2025-08-26 11:27:07',55),(74,'cafe','La solicitud con ID 54 ha sido Rechazada.',0,'2025-08-26 11:27:17',54);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portadas_lab`
--

DROP TABLE IF EXISTS `portadas_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portadas_lab` (
  `id_port` int(11) NOT NULL AUTO_INCREMENT,
  `area_port` varchar(50) NOT NULL,
  `ruta_img_port` varchar(255) NOT NULL,
  `title_port` text NOT NULL,
  `desc_port` text NOT NULL,
  `date_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_port`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portadas_lab`
--

LOCK TABLES `portadas_lab` WRITE;
/*!40000 ALTER TABLE `portadas_lab` DISABLE KEYS */;
INSERT INTO `portadas_lab` VALUES (2,'cafe','img/H.png','Excelencia en Análisis de Café','Servicios especializados en calidad, catación y análisis físico del café con el respaldo SENA','2025-07-31 23:00:21'),(3,'electronica','img/J.png','Soluciones Electrónicas Profesionales','Diseño y fabricación de tarjetas de circuito impreso, diseño e impresión de piezas 3D, fabricación o integración de soluciones tecnológicas para el sector agropecuario','2025-08-04 14:21:55');
/*!40000 ALTER TABLE `portadas_lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesos`
--

DROP TABLE IF EXISTS `procesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `contenido_tabla` longtext DEFAULT NULL,
  `archivo_nombre` varchar(200) DEFAULT NULL,
  `archivo_ruta` varchar(255) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesos`
--

LOCK TABLES `procesos` WRITE;
/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
INSERT INTO `procesos` VALUES (2,'Gestión Organizacional y de Riesgo',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(3,'Gestión Contractual',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(4,'Gestión Documental',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(5,'Gestión de Logística e Infraestructura',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(6,'Gestión de Recursos Financieros',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(7,'Impresión de Piezas 3D',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(9,'Diseño de Tarjetas de Circuito Impreso',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(10,'Diseño de Piezas 3D',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(11,'Transferencia de Conocimientos y Tecnologías',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24'),(12,'Montaje de Componentes Eléctricos',NULL,NULL,NULL,NULL,'2025-07-10 15:50:24');
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `type_pu` varchar(50) NOT NULL,
  `lab_area` varchar(50) DEFAULT NULL,
  `published_at` datetime DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `destacada` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `categoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,'Cafe','cafe','1752265411_D.png',NULL,'noticia','cafe','2025-07-11 15:23:00',1,0,'2025-07-11 20:23:31','2025-08-06 15:40:17',NULL),(2,'Evento de Innovación 2025','El próximo 20 de junio se llevará a cabo el evento anual de innovación agroempresarial.','img_68922a2f2a4e2.jpg',NULL,'eventos',NULL,'2025-06-12 08:48:38',1,0,'2025-06-12 18:48:38','2025-08-15 19:14:36',NULL),(4,'Avances en tecnología de sensores','Exploramos cómo los sensores están transformando la industria agrícola.','img_68921b61c15f2.jpeg','img/thumb_sensores.jpg','noticias','electronica','2025-06-16 11:52:35',1,0,'2025-06-16 21:52:35','2025-08-05 15:38:20',NULL),(5,'Jornada de capacitación en electrónica','Se llevó a cabo una jornada con expertos nacionales en el tema.',NULL,'img/thumb_jornada.jpg','eventos','electronica','2025-06-16 11:52:35',1,0,'2025-06-16 21:52:35','2025-08-05 15:00:48',NULL),(6,'Nueva Maquinaria para cacao','Se ha adquirido maquinaria moderna para mejorar la producción.','img/maquinaria.jpg','img/thumb_maquinaria.jpg','articulos','cafe','2025-06-16 11:52:35',1,0,'2025-06-16 21:52:35','2025-08-05 14:59:31',NULL),(7,'Análisis y Desarrollo de Software','La programación es el lenguaje que le da vida a la tecnología. A través de código, creamos soluciones, automatizamos procesos y construimos el futuro digital.','1750110736_programacion.jpg',NULL,'noticia','electronica','2025-06-16 16:52:00',1,0,'2025-06-17 02:52:16','2025-07-31 16:45:10',NULL),(8,'Cafe','cafe','1752265677_H.png',NULL,'noticia','cafe','2025-07-11 15:27:00',1,0,'2025-07-11 20:27:57','2025-08-12 19:22:20',NULL),(9,'Electronica','electronica','1752505324_Z.jpg',NULL,'noticia','electronica','2025-07-14 10:02:00',1,0,'2025-07-14 15:02:04','2025-08-15 19:14:12',NULL),(10,'Sena','asdasdsadasd','1754508910_logo-sena-verde-png-sin-fondo.png',NULL,'noticia','general','2025-08-06 14:35:00',1,0,'2025-08-06 19:35:10','2025-08-12 19:22:10',NULL),(11,'sdasdas','dasdasdsa','1755189358_ilustracion-de-la-ciudad-del-anime.jpg',NULL,'evento','general','2025-08-14 11:35:00',1,1,'2025-08-14 16:35:58','2025-08-15 19:14:36',NULL);
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id_re` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cc_cliente` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `servicio` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `fecha_solicitud` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','aceptada','rechazada') DEFAULT 'pendiente',
  `comentario` text DEFAULT NULL,
  `medio_notificacion` enum('correo','whatsapp','ninguno') DEFAULT 'ninguno',
  `destacado_re` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_re`),
  KEY `idx_requests_cc_cliente` (`cc_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (54,'Brayan','coperid','1084652357','Sin datos','3216548795','calidad','solicitud','cafe','2025-08-26 10:53:57','rechazada','Su solicitud ha sido rechazada. Gracias por su interés.','ninguno',0),(55,'Perdomo','cooord','1084987159','perdomogualibrayanandrey@gmail.com','Sin datos','Diseño de piezas 3D','servi','electronica','2025-08-26 10:54:39','aceptada','Aceptada','correo',0);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_rol` varchar(50) NOT NULL,
  `state_rol` tinyint(1) NOT NULL DEFAULT 1,
  `date_register_rol` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',1,'2025-06-18 21:06:58'),(2,'editor',1,'2025-06-18 21:06:58'),(3,'Publicador',1,'2025-07-09 19:57:17'),(4,'Usuario limitado',1,'2025-07-09 19:57:17');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servi_cafe`
--

DROP TABLE IF EXISTS `servi_cafe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servi_cafe` (
  `id_ca` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_ca` varchar(255) NOT NULL,
  `icono_ca` varchar(255) DEFAULT NULL,
  `des_corta` text NOT NULL,
  `des_larga` text NOT NULL,
  `precio_ca` decimal(10,0) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_ca`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servi_cafe`
--

LOCK TABLES `servi_cafe` WRITE;
/*!40000 ALTER TABLE `servi_cafe` DISABLE KEYS */;
INSERT INTO `servi_cafe` VALUES (22,'xd','icono_689f9a477cdcb4.97701757.jpg','xd','xd',10000000,'2025-08-15 20:36:23'),(23,'dasdas','icono_689f9ad203bff7.91694742.jpg','dasdasd','asdasdasdasd',100000,'2025-08-15 20:38:42');
/*!40000 ALTER TABLE `servi_cafe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servi_elect`
--

DROP TABLE IF EXISTS `servi_elect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servi_elect` (
  `id_ele` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `icono_ele` varchar(255) DEFAULT NULL,
  `descripcion_corta` text NOT NULL,
  `descripcion_larga` text NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_ele`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servi_elect`
--

LOCK TABLES `servi_elect` WRITE;
/*!40000 ALTER TABLE `servi_elect` DISABLE KEYS */;
INSERT INTO `servi_elect` VALUES (64,'xd','1755289702_ilustracion-de-la-ciudad-del-anime.jpg','x','we',12000,'2025-08-15 20:23:56');
/*!40000 ALTER TABLE `servi_elect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_vers`
--

DROP TABLE IF EXISTS `table_vers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_vers` (
  `id_ta` int(11) NOT NULL AUTO_INCREMENT,
  `name_ta` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ta`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_vers`
--

LOCK TABLES `table_vers` WRITE;
/*!40000 ALTER TABLE `table_vers` DISABLE KEYS */;
INSERT INTO `table_vers` VALUES (19,'Recprd'),(21,'Proceso apoyo ');
/*!40000 ALTER TABLE `table_vers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_acc` varchar(255) NOT NULL,
  `email_acc` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `area` varchar(50) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `email_verification_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email_acc`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$tD1m7w8N3b4X5y6Z7a8b9c.d0e1f2g3h4i5j6k7l8m9n0o1p2q3r4s5t6u7v8w9x0','admin@sennova.com','SENNOVA',1,'2025-06-12 18:32:20','2025-07-23 21:09:58',NULL,1,NULL),(4,'Electronica','$2y$10$QZZbDvdyMnaZAI/tCdKFN.zUTEVaKgn5qie74a3zmsHu/i.ag1Rk6','ele@gmail.com','Her',2,'2025-06-18 21:59:32','2025-08-13 21:08:19','visualizador',1,NULL),(14,'Hanna','$2y$10$6YIm2o17KSaFg4PeGG0Uo.NUKHwegqwmY8KAGvMe1l17tF/EUC.Eu','ha@gmail.com','Hanna',1,'2025-06-27 13:39:44','2025-07-23 21:09:58',NULL,1,NULL),(15,'prueba2','$2y$10$WFHYvTTJSctMiCGjr.R8QueiE4gmVrmtWx2u5i6j3AFQf8PyLJWLS','pru@gmail.com','prueba2',2,'2025-06-27 17:18:58','2025-07-23 21:09:58',NULL,1,NULL),(17,'Dios Todo Poderoso ','$2y$10$vhIVFWsAglDh3zqVjw2Gou4TitLqJhltX.l6G6CyNs0R4MHLi9WMq','yinko@gmail.com','Yinko',1,'2025-06-27 21:21:36','2025-07-23 21:09:58',NULL,1,NULL),(21,'Angelica','$2y$10$DJ3hi5dyiaeBDHexMQaNGuBMRkXpJ0knC/vFsBpdykDW4mAtfAeq.','angelicamcastanedav@gmail.com','Angelica María Castañeda',1,'2025-07-08 13:49:41','2025-08-13 19:28:58',NULL,1,NULL),(26,'cafe','$2y$10$HFq0tIB5YV9Vy2J/vBaNYOOLNim78w5B8.8aUiARZ9EhSp/G/zzvq','cafe@gmail.com','cafe',3,'2025-07-14 16:12:00','2025-07-23 21:09:58','cafe',1,NULL),(34,'electronica','$2y$10$o63SwNezCc/eUSeXAOhbKuJXMeGQXdN1rb2vkzuJwnMlTEcAg.3.W','electronica@gmail.com','electronica',3,'2025-07-14 16:27:06','2025-07-23 21:09:58','electronica',1,NULL),(39,'prueba 2','$2y$10$RaBWutdogvryMOvg55gDuO1hjMZZnL41kPpgunjNnmSSFyuMl1Zoy','prueba@123','ante todo la prueba ',4,'2025-08-06 20:04:24','2025-08-06 20:04:24','visualizador',0,'6e12d92378eb0bb6b63225f9b1c629cf719c187e90056bdd222b8028000b8353');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versiones`
--

DROP TABLE IF EXISTS `versiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versiones` (
  `id_vers` int(11) NOT NULL AUTO_INCREMENT,
  `id_table_vr` int(11) DEFAULT NULL,
  `codigo_vr` varchar(50) DEFAULT NULL,
  `name_archive` varchar(255) DEFAULT NULL,
  `version_vr` varchar(30) DEFAULT NULL,
  `year_vr` year(4) DEFAULT NULL,
  `ruta_archivo_vr` text DEFAULT NULL,
  `estado_vr` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_vers`),
  KEY `id_table_vr` (`id_table_vr`),
  CONSTRAINT `versiones_ibfk_1` FOREIGN KEY (`id_table_vr`) REFERENCES `table_vers` (`id_ta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versiones`
--

LOCK TABLES `versiones` WRITE;
/*!40000 ALTER TABLE `versiones` DISABLE KEYS */;
INSERT INTO `versiones` VALUES (8,19,'dsd','INFORME MENSUAL 2025.pdf','ssds',2009,'public/archivos/INFORME MENSUAL 2025.pdf',0),(9,19,'dsds','INFORME MENSUAL 2025.pdf','dsdsdsd',2025,'public/archivos/INFORME MENSUAL 2025.pdf',1),(11,21,'ddasd','INFORME MENSUAL 2025.pdf','dasdas',2010,'public/archivos/INFORME MENSUAL 2025.pdf',1),(12,19,'DASDAS','INFORME MENSUAL 2025.pdf','DASDASD',2008,'public/archivos/INFORME MENSUAL 2025.pdf',1);
/*!40000 ALTER TABLE `versiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_lab`
--

DROP TABLE IF EXISTS `videos_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_lab` (
  `id_vid` int(11) NOT NULL AUTO_INCREMENT,
  `title_vid` varchar(255) NOT NULL,
  `ruta_video` varchar(255) NOT NULL,
  `area_vid` enum('electronica','cafe') NOT NULL,
  `date_video` timestamp NOT NULL DEFAULT current_timestamp(),
  `text_pri` text DEFAULT NULL,
  `text_sec` text DEFAULT NULL,
  PRIMARY KEY (`id_vid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_lab`
--

LOCK TABLES `videos_lab` WRITE;
/*!40000 ALTER TABLE `videos_lab` DISABLE KEYS */;
INSERT INTO `videos_lab` VALUES (3,'Ciencia con Sabor','videos/Lab-Elec.mp4','cafe','2025-07-31 22:20:30','Descubre cómo elevamos la calidad del café y cacao a través de prácticas científicas e innovación aplicada.\r\n','Nuestro laboratorio combina análisis sensorial, físico-químico y control de calidad para fortalecer la competitividad de los productores regionales.');
/*!40000 ALTER TABLE `videos_lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_fecha` (`ip`,`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (1,'::1','2025-07-18',NULL,'2025-07-18 20:36:28'),(2,'::1','2025-07-19',NULL,'2025-07-18 22:07:55'),(3,'::1','2025-07-21',NULL,'2025-07-21 13:23:49'),(4,'::1','2025-07-22',NULL,'2025-07-21 22:15:16'),(5,'::1','2025-07-23',NULL,'2025-07-23 14:26:43'),(28,'::1','2025-07-24',NULL,'2025-07-23 22:13:42'),(33,'::1','2025-07-25',NULL,'2025-07-25 19:34:18'),(34,'::1','2025-07-26',NULL,'2025-07-25 22:37:57'),(35,'::1','2025-07-28',NULL,'2025-07-28 13:23:38'),(36,'::1','2025-07-29',NULL,'2025-07-28 22:57:33'),(39,'::1','2025-07-30',NULL,'2025-07-29 22:29:26'),(40,'::1','2025-07-31',NULL,'2025-07-30 22:02:13'),(66,'::1','2025-08-01','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-07-31 22:06:28'),(122,'127.0.0.1','2025-08-01','node','2025-08-01 16:07:29'),(350,'::1','2025-08-02','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-01 22:21:37'),(355,'::1','2025-08-04','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-04 14:10:37'),(363,'::1','2025-08-05','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-05 13:21:04'),(632,'::1','2025-08-06',NULL,'2025-08-05 22:21:14'),(645,'::1','2025-08-07',NULL,'2025-08-06 22:08:19'),(646,'::1','2025-08-08','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-08 13:36:19'),(649,'::1','2025-08-12','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-12 17:03:33'),(671,'::1','2025-08-13',NULL,'2025-08-12 22:18:16'),(674,'::1','2025-08-14','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-13 22:01:05'),(677,'::1','2025-08-15','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-15 13:20:13'),(679,'::1','2025-08-20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-20 13:37:46'),(680,'::1','2025-08-21',NULL,'2025-08-21 13:19:09'),(682,'::1','2025-08-22','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-22 13:21:43'),(685,'::1','2025-08-25','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-25 13:10:59'),(686,'::1','2025-08-26',NULL,'2025-08-26 13:19:25'),(690,'::1','2025-08-27',NULL,'2025-08-26 22:17:43'),(691,'::1','2025-08-28',NULL,'2025-08-28 17:53:28'),(692,'::1','2025-08-29',NULL,'2025-08-29 13:24:00'),(693,'::1','2025-09-01',NULL,'2025-09-01 14:02:56'),(694,'::1','2025-09-02',NULL,'2025-09-02 13:36:32'),(695,'::1','2025-09-03',NULL,'2025-09-03 13:15:38'),(696,'::1','2025-09-04',NULL,'2025-09-04 13:27:38'),(697,'::1','2025-09-05',NULL,'2025-09-05 14:06:10'),(698,'::1','2025-09-08',NULL,'2025-09-08 13:27:30'),(699,'::1','2025-09-09',NULL,'2025-09-08 22:55:59'),(701,'::1','2025-09-10',NULL,'2025-09-10 13:26:09'),(702,'::1','2025-09-11',NULL,'2025-09-11 13:25:11');
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-11 16:28:27
