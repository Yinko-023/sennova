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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archives`
--

LOCK TABLES `archives` WRITE;
/*!40000 ALTER TABLE `archives` DISABLE KEYS */;
INSERT INTO `archives` VALUES (1,'conocenos','conocenos','excel','2025-06-27 21:17:07','public/archivos/1750264766_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(2,'yinko','yinko','word','2025-06-27 21:17:11','public/archivos/1750265026_acata produccion academica (1) (1).docx','acata produccion academica (1) (1).docx',1,0,1),(3,'xd','xd','word','2025-06-27 21:17:16','public/archivos/1750265099_acata produccion academica (1) (1).docx','acata produccion academica (1) (1).docx',1,0,1),(4,'ss','ss','pdf','2025-06-27 21:17:19','public/archivos/1750265560_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(5,'aa','aa','pdf','2025-06-27 21:17:23','public/archivos/1750265604_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx','GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx',1,0,1),(6,'as','as','ppt','2025-06-27 21:17:26','public/archivos/1750265658_SGPS-12485-2024 Evaluacion dietas.pdf','SGPS-12485-2024 Evaluacion dietas.pdf',1,0,1),(7,'Programacion','Como programador de software, puedes enfrentarte a varios tipos de riesgos en tu trabajo. Aquí hay una clasificación general de algunos riesgos comunes','word','2025-06-26 02:27:42','public/archivos/1750879662_GOR-F-084FormatodeActaV02.docx','GOR-F-084FormatodeActaV02.docx',4,0,1),(12,'sadasd','sadas','word','2025-07-24 21:49:49','public/archivos/1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls',34,0,1),(19,'dsd','sdsdsd','word','2025-09-30 04:38:52','public/archivos/1759181932_1759162280_e5f33191_Cronograma_Texto_Sin_Tabla.docx','1759162280_e5f33191_Cronograma_Texto_Sin_Tabla.docx',17,0,1),(20,'asdded','dasdsa','pdf','2025-09-30 04:39:26','public/archivos/1759181966_Solicitud_sad.pdf','Solicitud_sad.pdf',17,0,1),(21,'fd','fdfdf','pdf','2025-09-30 04:44:48','public/archivos/1759182288_2025-09-16-071820-RESULTADOSPRELIMINARESDELAPRUEBADEENTREVISTA.pdf','2025-09-16-071820-RESULTADOSPRELIMINARESDELAPRUEBADEENTREVISTA.pdf',17,0,1),(22,'dsf','sdfsdff','excel','2025-09-30 04:47:31','public/archivos/1759182451_1750264766_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1 (1).xlsx','1750264766_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1 (1).xlsx',17,0,1),(25,'weqe','qwewqewq','word','2025-10-02 02:28:52','public/archivos/1759346932_1759162280_e5f33191_Cronograma_Texto_Sin_Tabla.docx','1759162280_e5f33191_Cronograma_Texto_Sin_Tabla.docx',34,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivos`
--

LOCK TABLES `archivos` WRITE;
/*!40000 ALTER TABLE `archivos` DISABLE KEYS */;
INSERT INTO `archivos` VALUES (1,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/688923af7ab2c_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','default','2025-07-29 14:40:31',0),(2,'1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','public/archivos/688923b61c71a_1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','application/vnd.ms-excel','xls','default','2025-07-29 14:40:38',0),(3,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/688923bf9761e_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','default','2025-07-29 14:40:47',0),(4,'programacion.jpg','public/archivos/688923ca00a39_programacion.jpg','image/jpeg','jpg','default','2025-07-29 14:40:58',1),(5,'xd_Nero_AI_Image_Upscaler_Photo_Face.png','public/archivos/6889270d73504_xd_Nero_AI_Image_Upscaler_Photo_Face.png','image/png','png','default','2025-07-29 14:54:53',0),(6,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/688934e620797_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','ges','2025-07-29 15:53:58',0),(7,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/688935126dfa5_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','estra','2025-07-29 15:54:42',0),(8,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx','public/archivos/68893656ec17a_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx','application/vnd.openxmlformats-officedocument.word','docx','as','2025-07-29 16:00:06',0),(9,'Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','public/archivos/6889365a6dcdd_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls','application/vnd.ms-excel','xls','as','2025-07-29 16:00:10',0),(10,'Acuerdo 010.pdf','public/archivos/6889366210e97_Acuerdo 010.pdf','application/pdf','pdf','as','2025-07-29 16:00:18',0),(11,'xd_Nero_AI_Image_Upscaler_Photo_Face.png','public/archivos/688936697df46_xd_Nero_AI_Image_Upscaler_Photo_Face.png','image/png','png','as','2025-07-29 16:00:25',0),(12,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/688937a1e8277_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','dsfsdfsd','2025-07-29 16:05:37',0),(13,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/6889386e0f242_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','ges','2025-07-29 16:09:02',0),(14,'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','public/archivos/688947abf24f2_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','application/vnd.openxmlformats-officedocument.word','docx','xd','2025-07-29 17:14:03',1),(15,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/6889481c46697_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','xd','2025-07-29 17:15:57',1),(16,'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','public/archivos/68894b0313889_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','sa','2025-07-29 17:28:19',1),(17,'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','public/archivos/68894b1385e1d_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx','application/vnd.openxmlformats-officedocument.word','docx','sas','2025-07-29 17:28:35',1),(18,'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','public/archivos/68894d5e1ff9c_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf','application/pdf','pdf','dx','2025-07-29 17:38:22',0),(60,'INFORME MENSUAL 2025.pdf','public/archivos/1755787633_ce274fe8_INFORME MENSUAL 2025.pdf','application/pdf','pdf','re1','2025-08-21 09:47:13',0),(61,'Captura de pantalla 2025-07-31 084316.png','public/archivos/1755787642_036717f7_Captura de pantalla 2025-07-31 084316.png','image/png','png','re1','2025-08-21 09:47:22',0),(62,'1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','public/archivos/1755787648_31847220_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx','application/vnd.openxmlformats-officedocument.word','docx','re1','2025-08-21 09:47:28',0),(67,'Solicitud_Daniel_Felipe-1109008963 (1).pdf','public/archivos/1759436221_2a147f3c_Solicitud_Daniel_Felipe-1109008963 (1).pdf','application/pdf','pdf','gmrs1','2025-10-02 15:17:01',0),(68,'Bitacora No. 08 Brayan Perdomo.xlsx','public/archivos/1759436260_774a7d1d_Bitacora No. 08 Brayan Perdomo.xlsx','application/vnd.openxmlformats-officedocument.spre','xlsx','gmrs1','2025-10-02 15:17:40',0),(69,'Solicitud_Daniel_Felipe-1109008963.pdf','public/archivos/1759436304_66b8c087_Solicitud_Daniel_Felipe-1109008963.pdf','application/pdf','pdf','gmrs1','2025-10-02 15:18:24',0),(70,'Solicitud_sad.pdf','public/archivos/1759436308_52986039_Solicitud_sad.pdf','application/pdf','pdf','gmrs1','2025-10-02 15:18:28',0);
/*!40000 ALTER TABLE `archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditoria_cambios`
--

DROP TABLE IF EXISTS `auditoria_cambios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditoria_cambios` (
  `id_cam` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `usuario_nombre` varchar(100) DEFAULT NULL,
  `accion` enum('create','read','update','delete','upload','login','logout','download','other') NOT NULL,
  `entidad` varchar(64) NOT NULL,
  `entidad_id` varchar(64) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `datos_antes` longtext DEFAULT NULL,
  `datos_despues` longtext DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cam`),
  KEY `idx_fecha` (`fecha`),
  KEY `idx_usuario` (`usuario_id`),
  KEY `idx_accion` (`accion`),
  KEY `idx_entidad` (`entidad`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_cambios`
--

LOCK TABLES `auditoria_cambios` WRITE;
/*!40000 ALTER TABLE `auditoria_cambios` DISABLE KEYS */;
INSERT INTO `auditoria_cambios` VALUES (2,'2025-09-22 16:27:27',NULL,'17','delete','backup','backup_sennova2_2025-09-22_23-21-12.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-22_23-21-12.sql','{\"archivo\":\"backup_sennova2_2025-09-22_23-21-12.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-21-12.sql\",\"tamano_bytes\":125453,\"modificado\":\"2025-09-22T23:21:13+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(3,'2025-09-22 16:27:28',NULL,'17','delete','backup','backup_sennova2_2025-09-22_23-22-01.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-22_23-22-01.sql','{\"archivo\":\"backup_sennova2_2025-09-22_23-22-01.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-22-01.sql\",\"tamano_bytes\":125453,\"modificado\":\"2025-09-22T23:22:02+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(4,'2025-09-22 16:27:30',NULL,'17','delete','backup','backup_sennova2_2025-09-22_23-22-05.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-22_23-22-05.sql','{\"archivo\":\"backup_sennova2_2025-09-22_23-22-05.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-22-05.sql\",\"tamano_bytes\":125453,\"modificado\":\"2025-09-22T23:22:05+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(5,'2025-09-22 16:27:31',NULL,'17','create','backup','backup_sennova2_2025-09-22_23-27-31.sql','Creó una copia de seguridad: backup_sennova2_2025-09-22_23-27-31.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-09-22_23-27-31.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-27-31.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(6,'2025-09-22 16:52:18',NULL,'17','delete','backup','backup_sennova2_2025-09-22_23-27-31.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-22_23-27-31.sql','{\"archivo\":\"backup_sennova2_2025-09-22_23-27-31.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-27-31.sql\",\"tamano_bytes\":127711,\"modificado\":\"2025-09-22T23:27:31+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(7,'2025-09-22 16:52:35',NULL,'17','update','backup','backup_sennova2_2025-09-22_23-52-20.sql','Restauró la copia de seguridad: backup_sennova2_2025-09-22_23-52-20.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-09-22_23-52-20.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(8,'2025-09-29 10:42:47',NULL,'17','delete','backup','backup_sennova2_2025-09-22_23-52-20.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-22_23-52-20.sql','{\"archivo\":\"backup_sennova2_2025-09-22_23-52-20.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-22_23-52-20.sql\",\"tamano_bytes\":127993,\"modificado\":\"2025-09-22T23:52:20+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(10,'2025-09-29 16:54:38',NULL,'17','delete','backup','backup_sennova2_2025-09-29_17-42-49.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-29_17-42-49.sql','{\"archivo\":\"backup_sennova2_2025-09-29_17-42-49.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-29_17-42-49.sql\",\"tamano_bytes\":73405,\"modificado\":\"2025-09-29T17:42:49+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(11,'2025-09-29 16:54:40',NULL,'17','create','backup','backup_sennova2_2025-09-29_23-54-39.sql','Creó una copia de seguridad: backup_sennova2_2025-09-29_23-54-39.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-09-29_23-54-39.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-29_23-54-39.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(12,'2025-09-29 17:29:33',17,'17','delete','backup','backup_sennova2_2025-09-29_23-54-39.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-29_23-54-39.sql','{\"archivo\":\"backup_sennova2_2025-09-29_23-54-39.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-29_23-54-39.sql\",\"tamano_bytes\":80323,\"modificado\":\"2025-09-29T23:54:40+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(13,'2025-09-29 17:29:34',17,'17','create','backup','backup_sennova2_2025-09-30_00-29-33.sql','Creó una copia de seguridad: backup_sennova2_2025-09-30_00-29-33.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-09-30_00-29-33.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-30_00-29-33.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(14,'2025-09-29 17:39:06',17,'17','delete','backup','backup_sennova2_2025-09-30_00-29-33.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-30_00-29-33.sql','{\"archivo\":\"backup_sennova2_2025-09-30_00-29-33.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-30_00-29-33.sql\",\"tamano_bytes\":81137,\"modificado\":\"2025-09-30T00:29:34+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(15,'2025-09-29 17:39:07',17,'17','create','backup','backup_sennova2_2025-09-30_00-39-07.sql','Creó una copia de seguridad: backup_sennova2_2025-09-30_00-39-07.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-09-30_00-39-07.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-30_00-39-07.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(16,'2025-10-01 11:12:42',17,'17','delete','backup','backup_sennova2_2025-09-30_00-39-07.sql','Eliminó la copia de seguridad: backup_sennova2_2025-09-30_00-39-07.sql','{\"archivo\":\"backup_sennova2_2025-09-30_00-39-07.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-09-30_00-39-07.sql\",\"tamano_bytes\":82183,\"modificado\":\"2025-09-30T00:39:07+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(17,'2025-10-01 11:12:43',17,'17','create','backup','backup_sennova2_2025-10-01_18-12-43.sql','Creó una copia de seguridad: backup_sennova2_2025-10-01_18-12-43.sql',NULL,'{\"archivo\":\"backup_sennova2_2025-10-01_18-12-43.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-10-01_18-12-43.sql\",\"bd\":\"sennova2\"}','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),(18,'2025-10-07 13:21:35',17,'17','delete','backup','backup_sennova2_2025-10-01_18-12-43.sql','Eliminó la copia de seguridad: backup_sennova2_2025-10-01_18-12-43.sql','{\"archivo\":\"backup_sennova2_2025-10-01_18-12-43.sql\",\"ruta\":\"C:\\\\xampp\\\\htdocs\\\\sennova\\\\views\\\\admin\\/..\\/..\\/backups\\/backup_sennova2_2025-10-01_18-12-43.sql\",\"tamano_bytes\":85199,\"modificado\":\"2025-10-01T18:12:43+02:00\"}',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36');
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
  PRIMARY KEY (`id_car`),
  UNIQUE KEY `uq_carrusel_name_img_c` (`name_img_c`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrusel`
--

LOCK TABLES `carrusel` WRITE;
/*!40000 ALTER TABLE `carrusel` DISABLE KEYS */;
INSERT INTO `carrusel` VALUES (8,'Café y Cacao con Ciencia y Sabor','img/H.png','2025-07-31 20:42:21'),(9,'Transformando el Futuro','img/E.png','2025-07-31 20:42:40'),(16,'Educación con Tecnología','img/014WhatsApp Image 2025-06-13 at 11.53.28 AM.jpeg','2025-08-05 15:29:08'),(21,'Innovación Y Competitividad','img/021prueba5.jpg','2025-10-03 16:54:58'),(24,'tecnologias','img/022Z.jpg','2025-10-03 21:41:47');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eva_resp_eva`
--

LOCK TABLES `eva_resp_eva` WRITE;
/*!40000 ALTER TABLE `eva_resp_eva` DISABLE KEYS */;
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
  `filename_2` varchar(255) NOT NULL,
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
  `n_cliente` varchar(255) DEFAULT NULL,
  `finalizado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pdf`),
  UNIQUE KEY `uq_generated_pdfs_filename` (`filename_2`),
  KEY `idx_generated_pdfs_created_at` (`created_at`),
  KEY `idx_generated_pdfs_area` (`area`),
  KEY `idx_generated_pdfs_form_type` (`form_type`),
  KEY `idx_generated_pdfs_user` (`created_by_user`),
  KEY `idx_generated_pdfs_ncliente` (`n_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generated_pdfs`
--

LOCK TABLES `generated_pdfs` WRITE;
/*!40000 ALTER TABLE `generated_pdfs` DISABLE KEYS */;
INSERT INTO `generated_pdfs` VALUES (87,'Solicitud_Daniel_Felipe-1109008963.pdf','Solicitud_Daniel_Felipe.pdf','/sennova/public/Formul/2025/09/Solicitud_Daniel_Felipe-1109008963.pdf','application/pdf',282638,NULL,'form1_solicitud',NULL,'2025-09-29 10:53:07','73f5fc671bfac58231204109a4aa1c402416f2d69f9a4e3d50ecf0b8430e5ef2',0,'{\"numero_solicitud\":\"021\",\"fecha\":\"2025-09-29\",\"cliente\":{\"razon\":\"Daniel Felipe\",\"nit\":\"1109008963\",\"email\":\"danielfelipe@gmail.com\"}}','0000',0),(102,'Solicitud_dsd-423423.pdf','Solicitud_dsd.pdf','/sennova/public/Formul/2025/09/Solicitud_dsd-423423.pdf','application/pdf',1907015,NULL,'form1_solicitud',NULL,'2025-09-30 09:17:11','9080812ca43f059ef96a4d5daf8f91339b1a2d24a0bb17cfca2ecc633045f284',0,'{\"numero_solicitud\":\"027\",\"fecha\":\"2025-09-30\",\"cliente\":{\"razon\":\"dsd\",\"nit\":\"423423\",\"email\":\"wre@gd\"}}','2025',0),(103,'Solicitud_Brayan_Perdomo-1109008963.pdf','Solicitud_Brayan_Perdomo.pdf','/sennova/public/Formul/2025/09/Solicitud_Brayan_Perdomo-1109008963.pdf','application/pdf',1907128,NULL,'form1_solicitud',NULL,'2025-09-30 09:28:21','88bf72415d78895cff8f949f4a7d816ccfbc78b97fef44659a39473fd46feb26',0,'{\"numero_solicitud\":\"028\",\"fecha\":\"2025-09-30\",\"cliente\":{\"razon\":\"Brayan Perdomo\",\"nit\":\"1109008963\",\"email\":\"l@l\"}}','1004473715',0),(104,'Evaluacion-CT_009_Brayan_Perdomo.pdf','Evaluacion-CT_009_Brayan_Perdomo.pdf','/sennova/public/Formul/2025/09/Evaluacion-CT_009_Brayan_Perdomo.pdf','application/pdf',3222153,NULL,'form2_evaluacion',NULL,'2025-09-30 09:28:55','40ffd2ea30bd497950d565f274d1f80bc61b6384d321008b326acae35d413e01',0,'{\"nombre\":\"Brayan Perdomo\",\"fecha\":\"2025-09-30\",\"codigo\":\"009\"}','1004473715',0),(106,'Cotizacion_dsd.pdf','Cotizacion_dsd.pdf','/sennova/public/Formul/2025/10/Cotizacion_dsd.pdf','application/pdf',1010243,NULL,'form3_cotizacion',NULL,'2025-10-02 11:49:45','6154572c67c111a2b708965df6dc7892b35bcbd4f27f94d9f63ee2a8a46ab66a',0,'{\"cot_no\":\"006\",\"razon_social\":\"dsd\",\"fecha\":\"2025-10-02\"}','1004473715',0),(107,'OrdenTrabajo_sin_nombre.pdf','OrdenTrabajo_sin_nombre.pdf','/sennova/public/Formul/2025/10/OrdenTrabajo_sin_nombre.pdf','application/pdf',943833,NULL,'form4_orden_trabajo',NULL,'2025-10-02 14:14:48','93178e50ef13a627d5fb439db8dfc53ba58ef4f9529135940b4888f323d33d66',0,NULL,'1004473715',0),(108,'VerificacionPCB_sin_nombre.pdf','VerificacionPCB_sin_nombre.pdf','/sennova/public/Formul/2025/10/VerificacionPCB_sin_nombre.pdf','application/pdf',1856951,NULL,'form5_verificacion_pcb',NULL,'2025-10-02 14:15:42','92ba299b3e6ec12fb3096a6b899b3d1d998984e5c86895154b0d26dad1449561',0,NULL,'1004473715',0),(109,'Evaluacion-CT_011_Procesos_Apoyof.pdf','Evaluacion-CT_011_Procesos_Apoyof.pdf','/sennova/public/Formul/2025/10/Evaluacion-CT_011_Procesos_Apoyof.pdf','application/pdf',3222050,NULL,'form2_evaluacion',NULL,'2025-10-02 15:13:40','4e8b10bc4bc5451b5a4804da333a29317622e0210b03161a2a1e589811ace4ae',0,'{\"nombre\":\"Procesos Apoyof\",\"fecha\":\"2025-10-02\",\"codigo\":\"011\"}','0000',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_botones`
--

LOCK TABLES `gestion_botones` WRITE;
/*!40000 ALTER TABLE `gestion_botones` DISABLE KEYS */;
INSERT INTO `gestion_botones` VALUES (39,'Procesos Misionales','views/procesos/misionales.php','#888a91'),(73,'betto','views/procesos/almacengmr.php','#4e73df');
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_subprocesos`
--

LOCK TABLES `gestion_subprocesos` WRITE;
/*!40000 ALTER TABLE `gestion_subprocesos` DISABLE KEYS */;
INSERT INTO `gestion_subprocesos` VALUES (71,'Betto1','gmrs1',73,'almacengmr.php','2025-10-01 20:27:53'),(72,'erer','rere',73,'almacengmr.php','2025-10-02 20:19:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (98,'electronica','Prueba 001 - Mensaje de notificación',0,'2025-10-07 12:41:41',NULL),(99,'cafe','Prueba 002 - Mensaje de notificación',1,'2025-10-07 12:40:41',NULL),(100,'electronica','Prueba 003 - Mensaje de notificación',0,'2025-10-07 12:39:41',NULL),(101,'cafe','Prueba 004 - Mensaje de notificación',0,'2025-10-07 12:38:41',NULL),(102,'electronica','Prueba 005 - Mensaje de notificación',0,'2025-10-07 12:37:41',NULL),(103,'cafe','Prueba 006 - Mensaje de notificación',1,'2025-10-07 12:36:41',NULL),(104,'electronica','Prueba 007 - Mensaje de notificación',0,'2025-10-07 12:35:41',NULL),(105,'cafe','Prueba 008 - Mensaje de notificación',0,'2025-10-07 12:34:41',NULL),(106,'electronica','Prueba 009 - Mensaje de notificación',1,'2025-10-07 12:33:41',NULL),(107,'cafe','Prueba 010 - Mensaje de notificación',0,'2025-10-07 12:32:41',NULL),(108,'electronica','Prueba 011 - Mensaje de notificación',0,'2025-10-07 12:31:41',NULL),(109,'cafe','Prueba 012 - Mensaje de notificación',1,'2025-10-07 12:30:41',NULL),(110,'electronica','Prueba 013 - Mensaje de notificación',0,'2025-10-07 12:29:41',NULL),(111,'cafe','Prueba 014 - Mensaje de notificación',0,'2025-10-07 12:28:41',NULL),(112,'electronica','Prueba 015 - Mensaje de notificación',0,'2025-10-07 12:27:41',NULL),(113,'cafe','Prueba 016 - Mensaje de notificación',1,'2025-10-07 12:26:41',NULL),(114,'electronica','Prueba 017 - Mensaje de notificación',0,'2025-10-07 12:25:41',NULL),(115,'cafe','Prueba 018 - Mensaje de notificación',0,'2025-10-07 12:24:41',NULL),(116,'electronica','Prueba 019 - Mensaje de notificación',1,'2025-10-07 12:23:41',NULL),(117,'cafe','Prueba 020 - Mensaje de notificación',0,'2025-10-07 12:22:41',NULL),(118,'electronica','Prueba 021 - Mensaje de notificación',0,'2025-10-07 12:21:41',NULL),(119,'cafe','Prueba 022 - Mensaje de notificación',1,'2025-10-07 12:20:41',NULL),(120,'electronica','Prueba 023 - Mensaje de notificación',0,'2025-10-07 12:19:41',NULL),(121,'cafe','Prueba 024 - Mensaje de notificación',0,'2025-10-07 12:18:41',NULL),(122,'electronica','Prueba 025 - Mensaje de notificación',0,'2025-10-07 12:17:41',NULL),(123,'cafe','Prueba 026 - Mensaje de notificación',1,'2025-10-07 12:16:41',NULL),(124,'electronica','Prueba 027 - Mensaje de notificación',0,'2025-10-07 12:15:41',NULL),(125,'cafe','Prueba 028 - Mensaje de notificación',0,'2025-10-07 12:14:41',NULL),(126,'electronica','Prueba 029 - Mensaje de notificación',1,'2025-10-07 12:13:41',NULL),(127,'cafe','Prueba 030 - Mensaje de notificación',0,'2025-10-07 12:12:41',NULL),(128,'electronica','Prueba 031 - Mensaje de notificación',0,'2025-10-07 12:11:41',NULL),(129,'cafe','Prueba 032 - Mensaje de notificación',1,'2025-10-07 12:10:41',NULL),(130,'electronica','Prueba 033 - Mensaje de notificación',0,'2025-10-07 12:09:41',NULL),(131,'cafe','Prueba 034 - Mensaje de notificación',0,'2025-10-07 12:08:41',NULL),(132,'electronica','Prueba 035 - Mensaje de notificación',0,'2025-10-07 12:07:41',NULL),(133,'cafe','Prueba 036 - Mensaje de notificación',1,'2025-10-07 12:06:41',NULL),(134,'electronica','Prueba 037 - Mensaje de notificación',0,'2025-10-07 12:05:41',NULL),(135,'cafe','Prueba 038 - Mensaje de notificación',0,'2025-10-07 12:04:41',NULL),(136,'electronica','Prueba 039 - Mensaje de notificación',1,'2025-10-07 12:03:41',NULL),(137,'cafe','Prueba 040 - Mensaje de notificación',0,'2025-10-07 12:02:41',NULL),(138,'electronica','Prueba 041 - Mensaje de notificación',0,'2025-10-07 12:01:41',NULL),(139,'cafe','Prueba 042 - Mensaje de notificación',1,'2025-10-07 12:00:41',NULL),(140,'electronica','Prueba 043 - Mensaje de notificación',0,'2025-10-07 11:59:41',NULL),(141,'cafe','Prueba 044 - Mensaje de notificación',0,'2025-10-07 11:58:41',NULL),(142,'electronica','Prueba 045 - Mensaje de notificación',0,'2025-10-07 11:57:41',NULL),(143,'cafe','Prueba 046 - Mensaje de notificación',1,'2025-10-07 11:56:41',NULL),(144,'electronica','Prueba 047 - Mensaje de notificación',0,'2025-10-07 11:55:41',NULL),(145,'cafe','Prueba 048 - Mensaje de notificación',0,'2025-10-07 11:54:41',NULL),(146,'electronica','Prueba 049 - Mensaje de notificación',1,'2025-10-07 11:53:41',NULL),(147,'cafe','Prueba 050 - Mensaje de notificación',0,'2025-10-07 11:52:41',NULL),(148,'electronica','Prueba 051 - Mensaje de notificación',0,'2025-10-07 11:51:41',NULL),(149,'cafe','Prueba 052 - Mensaje de notificación',1,'2025-10-07 11:50:41',NULL),(150,'electronica','Prueba 053 - Mensaje de notificación',0,'2025-10-07 11:49:41',NULL),(151,'cafe','Prueba 054 - Mensaje de notificación',0,'2025-10-07 11:48:41',NULL),(152,'electronica','Prueba 055 - Mensaje de notificación',0,'2025-10-07 11:47:41',NULL),(153,'cafe','Prueba 056 - Mensaje de notificación',1,'2025-10-07 11:46:41',NULL),(154,'electronica','Prueba 057 - Mensaje de notificación',0,'2025-10-07 11:45:41',NULL),(155,'cafe','Prueba 058 - Mensaje de notificación',0,'2025-10-07 11:44:41',NULL),(156,'electronica','Prueba 059 - Mensaje de notificación',1,'2025-10-07 11:43:41',NULL),(157,'cafe','Prueba 060 - Mensaje de notificación',0,'2025-10-07 11:42:41',NULL);
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
INSERT INTO `portadas_lab` VALUES (2,'cafe','img/H.png','Excelencia en Análisis de Café','Servicios especializados en calidad, catación y análisis físico del café con el respaldo SENA','2025-10-03 21:42:54'),(3,'electronica','img/J.png','Soluciones Electrónicas Profesionales','Diseño y fabricación de tarjetas de circuito impreso, diseño e impresión de piezas 3D, fabricación o integración de soluciones tecnológicas para el sector agropecuario','2025-10-03 16:43:27');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `ux_pub_title_area_active` (`title`(191),`lab_area`,`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (8,'Cafe','cafe','1752265677_H.png',NULL,'noticia','cafe','2025-07-11 15:27:00',1,0,'2025-07-11 20:27:57','2025-09-29 16:39:31',NULL),(9,'Electronica','electronica','1752505324_Z.jpg',NULL,'noticia','electronica','2025-07-14 10:02:00',1,0,'2025-07-14 15:02:04','2025-09-23 19:31:17',NULL),(14,'RECONTRA XD','sdfsdfsf','1759164265_6abf387e.png',NULL,'noticia','electronica','2025-09-29 11:44:00',1,0,'2025-09-29 16:44:25','2025-10-02 13:15:07',NULL),(19,'FUNCIONA','CREO QUE SI','1759248877_ad61e357.jpg',NULL,'noticia','cafe','2025-09-30 11:14:00',1,1,'2025-09-30 16:14:37','2025-10-03 21:43:10',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (56,'Brayan Andrey','Sdeaa','100445214852','perdomogualibrayanandrey@gmail.com','3232274352','Diseño de piezas 3D','Necesito solicitudes de calidad por favor','electronica','2025-09-23 09:05:53','aceptada','xddddddd','correo',0),(57,'Brayan','Xd','10023156658','perdomogualibrayanandrey@gmail.com','Sin datos','Impresión de piezas 3D','Eso esta re raro pana','electronica','2025-09-23 10:37:51','rechazada','F en el chat no quedaste bro XD','correo',0),(61,'Alice Daillan Romero Gonzalez','La laura','1069737612','daillangonzalez2@gmail.com','3156955933','tueste','Quiero que por favor me colaboren con el tueste de un café que acabo de sacar para la fabricación de mi marca.','cafe','2025-09-29 10:33:46','rechazada','Su solicitud es rechazada porque el café no cuenta con los protocolos asequibles para la transformación del mismo.','correo',0),(62,'daniel cabrera','Surcarl','132132465165','Sin datos','3535245156','Fabricación de tarjetas PCB','necesidades compa','electronica','2025-10-01 11:14:20','rechazada','Su solicitud ha sido rechazada. Gracias por su interés.','ninguno',0),(63,'Carlos','maria','13216554646','Sin datos','44554646','maquila','sin cafe','cafe','2025-10-01 11:25:37','pendiente',NULL,'ninguno',0),(64,'andres','perf','6846846','Sin datos','6565654','sensorial','wrewwe','cafe','2025-10-01 11:26:07','pendiente',NULL,'ninguno',0),(65,'andres','asdsa','321321','Sin datos','3213213213','maquila','21321321','cafe','2025-10-01 11:27:31','pendiente',NULL,'ninguno',0),(66,'Maria','terra','16561','Sin datos','2423324432','transformacion','423423423','cafe','2025-10-01 11:28:52','pendiente',NULL,'ninguno',0),(67,'betto','dasdsad','42432434343','perdomogualibrayanandrey@gmail.com','Sin datos','Diseño de tarjetas de circuito impreso (PCB)','brajihsajhiwq','electronica','2025-10-01 16:15:34','aceptada','No quiero','correo',0),(68,'betto','43342432342','42432434343','cafe@gmail.com','3208900761','Diseño de tarjetas de circuito impreso (PCB)','sffsfsfds','electronica','2025-10-06 09:30:24','rechazada','ftggfhfhff','whatsapp',0),(69,'Nicole Peña','renacer','1081402347','lizethnicole0424@gmail.com','3209439634','maquila','g6g6gh4h43','cafe','2025-10-07 09:31:37','aceptada','Ta bien su cafe','correo',0);
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
INSERT INTO `roles` VALUES (1,'admin',1,'2025-06-18 21:06:58'),(2,'Admin Electronica',1,'2025-06-18 21:06:58'),(3,'Publicador',1,'2025-07-09 19:57:17'),(4,'Usuario limitado',1,'2025-07-09 19:57:17');
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
INSERT INTO `servi_cafe` VALUES (23,'dasdas','icono_689f9ad203bff7.91694742.jpg','dasdasd','asdasdasdasd',100000,'2025-08-15 20:38:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servi_elect`
--

LOCK TABLES `servi_elect` WRITE;
/*!40000 ALTER TABLE `servi_elect` DISABLE KEYS */;
INSERT INTO `servi_elect` VALUES (64,'ATARDECER','1759248922_ilustracion-de-la-ciudad-del-anime.jpg','SE PUSO A PRUEBA','Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).',120000,'2025-08-15 20:23:56');
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
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `area` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email_acc`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$tD1m7w8N3b4X5y6Z7a8b9c.d0e1f2g3h4i5j6k7l8m9n0o1p2q3r4s5t6u7v8w9x0','admin@sennova.com','SENNOVA',NULL,NULL,1,'2025-06-12 18:32:20','2025-10-01 16:39:08',NULL),(4,'Electronik','$2y$10$QZZbDvdyMnaZAI/tCdKFN.zUTEVaKgn5qie74a3zmsHu/i.ag1Rk6','ele@gmail.com','Her',NULL,NULL,2,'2025-06-18 21:59:32','2025-10-06 14:33:55','visualizador'),(14,'Hanna','$2y$10$6YIm2o17KSaFg4PeGG0Uo.NUKHwegqwmY8KAGvMe1l17tF/EUC.Eu','ha@gmail.com','Hanna',NULL,NULL,1,'2025-06-27 13:39:44','2025-07-23 21:09:58',NULL),(15,'prueba2','$2y$10$WFHYvTTJSctMiCGjr.R8QueiE4gmVrmtWx2u5i6j3AFQf8PyLJWLS','pru@gmail.com','prueba2',NULL,NULL,2,'2025-06-27 17:18:58','2025-07-23 21:09:58',NULL),(17,'Yinko','$2y$10$vhIVFWsAglDh3zqVjw2Gou4TitLqJhltX.l6G6CyNs0R4MHLi9WMq','yinko@gmail.com','Yinko','3107523593','carrera 6',1,'2025-06-27 21:21:36','2025-09-29 22:24:41',NULL),(21,'Angelica','$2y$10$DJ3hi5dyiaeBDHexMQaNGuBMRkXpJ0knC/vFsBpdykDW4mAtfAeq.','angelicamcastanedav@gmail.com','Angelica María Castañeda',NULL,NULL,1,'2025-07-08 13:49:41','2025-08-13 19:28:58',NULL),(26,'cafe','$2y$10$HFq0tIB5YV9Vy2J/vBaNYOOLNim78w5B8.8aUiARZ9EhSp/G/zzvq','cafe@gmail.com','cafe',NULL,NULL,3,'2025-07-14 16:12:00','2025-07-23 21:09:58','cafe'),(34,'Electronica','$2y$10$.TmBJJT1PaJsXe.4zOdVue.VwivgTG66N5y0IRbSkeKQOaTZbvhQO','electronica@gmail.com','electronica','3215321465','calle 7 # 7 -2020202',3,'2025-07-14 16:27:06','2025-10-06 14:35:03','electronica'),(39,'prueba 2','$2y$10$UrFg.S7Lp6GYlNg/s.M5peVTT4QQybYL05ppZ2Mcynv2mFkVTQJzi','prueba@123','ante todo la prueba ',NULL,NULL,4,'2025-08-06 20:04:24','2025-10-01 19:31:41','visualizador'),(44,'AnaR','$2y$10$mqKvoDdOO3ZbAOfKHj.UU.vbHaS6H87GFZCyKVVD4EiDbllGZe7lW','anaramirez@gmail.com','Ana ramirez',NULL,NULL,4,'2025-09-18 22:02:23','2025-09-29 15:45:06','visualizador');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_lab`
--

LOCK TABLES `videos_lab` WRITE;
/*!40000 ALTER TABLE `videos_lab` DISABLE KEYS */;
INSERT INTO `videos_lab` VALUES (3,'Ciencia con Sabor','videos/Lab-Elec.mp4','cafe','2025-07-31 22:20:30','Descubre cómo elevamos la calidad del café y cacao a través de prácticas científicas e innovación aplicada.','Nuestro laboratorio combina análisis sensorial, físico-químico y control de calidad para fortalecer la competitividad de los productores regionales.'),(4,'Innovación con tecnología','videos/vid_1759779785_ab31d1e7.mp4','electronica','2025-10-06 19:43:05','La electrónica se usa en muchos campos. En la medicina, permite el uso de equipos como marcapasos. En el hogar, está en electrodomésticos y sistemas de sonido. También es clave en autos y computadoras.','La electrónica es la ciencia que estudia y controla el movimiento de los electrones. Utiliza componentes como resistencias, transistores y circuitos para crear aparatos electrónicos. Está presente en dispositivos como celulares, computadoras y televisores.');
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
) ENGINE=InnoDB AUTO_INCREMENT=979 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (1,'::1','2025-07-18',NULL,'2025-07-18 20:36:28'),(2,'::1','2025-07-19',NULL,'2025-07-18 22:07:55'),(3,'::1','2025-07-21',NULL,'2025-07-21 13:23:49'),(4,'::1','2025-07-22',NULL,'2025-07-21 22:15:16'),(5,'::1','2025-07-23',NULL,'2025-07-23 14:26:43'),(28,'::1','2025-07-24',NULL,'2025-07-23 22:13:42'),(33,'::1','2025-07-25',NULL,'2025-07-25 19:34:18'),(34,'::1','2025-07-26',NULL,'2025-07-25 22:37:57'),(35,'::1','2025-07-28',NULL,'2025-07-28 13:23:38'),(36,'::1','2025-07-29',NULL,'2025-07-28 22:57:33'),(39,'::1','2025-07-30',NULL,'2025-07-29 22:29:26'),(40,'::1','2025-07-31',NULL,'2025-07-30 22:02:13'),(66,'::1','2025-08-01','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-07-31 22:06:28'),(122,'127.0.0.1','2025-08-01','node','2025-08-01 16:07:29'),(350,'::1','2025-08-02','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-01 22:21:37'),(355,'::1','2025-08-04','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-04 14:10:37'),(363,'::1','2025-08-05','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','2025-08-05 13:21:04'),(632,'::1','2025-08-06',NULL,'2025-08-05 22:21:14'),(645,'::1','2025-08-07',NULL,'2025-08-06 22:08:19'),(646,'::1','2025-08-08','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-08 13:36:19'),(649,'::1','2025-08-12','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-12 17:03:33'),(671,'::1','2025-08-13',NULL,'2025-08-12 22:18:16'),(674,'::1','2025-08-14','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-13 22:01:05'),(677,'::1','2025-08-15','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-15 13:20:13'),(679,'::1','2025-08-20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-20 13:37:46'),(680,'::1','2025-08-21',NULL,'2025-08-21 13:19:09'),(682,'::1','2025-08-22','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-22 13:21:43'),(685,'::1','2025-08-25','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','2025-08-25 13:10:59'),(686,'::1','2025-08-26',NULL,'2025-08-26 13:19:25'),(690,'::1','2025-08-27',NULL,'2025-08-26 22:17:43'),(691,'::1','2025-08-28',NULL,'2025-08-28 17:53:28'),(692,'::1','2025-08-29',NULL,'2025-08-29 13:24:00'),(693,'::1','2025-09-01',NULL,'2025-09-01 14:02:56'),(694,'::1','2025-09-02',NULL,'2025-09-02 13:36:32'),(695,'::1','2025-09-03',NULL,'2025-09-03 13:15:38'),(696,'::1','2025-09-04',NULL,'2025-09-04 13:27:38'),(697,'::1','2025-09-05',NULL,'2025-09-05 14:06:10'),(698,'::1','2025-09-08',NULL,'2025-09-08 13:27:30'),(699,'::1','2025-09-09',NULL,'2025-09-08 22:55:59'),(701,'::1','2025-09-10',NULL,'2025-09-10 13:26:09'),(702,'::1','2025-09-11',NULL,'2025-09-11 13:25:11'),(703,'::1','2025-09-12',NULL,'2025-09-12 13:27:23'),(704,'::1','2025-09-13',NULL,'2025-09-12 22:16:35'),(705,'::1','2025-09-16',NULL,'2025-09-16 13:31:58'),(709,'::1','2025-09-17',NULL,'2025-09-16 22:00:17'),(710,'::1','2025-09-18',NULL,'2025-09-18 13:33:13'),(712,'::1','2025-09-19',NULL,'2025-09-18 22:01:32'),(713,'::1','2025-09-22',NULL,'2025-09-22 14:09:43'),(789,'::1','2025-09-23',NULL,'2025-09-23 13:57:07'),(810,'::1','2025-09-24',NULL,'2025-09-23 22:37:36'),(811,'::1','2025-09-26',NULL,'2025-09-26 13:36:46'),(814,'::1','2025-09-29',NULL,'2025-09-29 13:32:14'),(826,'::1','2025-09-30',NULL,'2025-09-29 22:05:46'),(947,'::1','2025-10-01','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','2025-10-01 13:31:18'),(955,'::1','2025-10-02',NULL,'2025-10-01 22:07:44'),(960,'::1','2025-10-03',NULL,'2025-10-02 22:08:26'),(969,'::1','2025-10-06',NULL,'2025-10-06 13:25:25'),(975,'::1','2025-10-07','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','2025-10-07 14:23:41');
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

-- Dump completed on 2025-10-07 13:21:36
