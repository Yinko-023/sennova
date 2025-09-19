-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2025 a las 00:25:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sennova2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archives`
--

CREATE TABLE `archives` (
  `id_archives` int(11) NOT NULL,
  `Tittle_ar` varchar(100) NOT NULL,
  `description_ar` varchar(200) NOT NULL,
  `type_ar` varchar(50) NOT NULL,
  `date_publi_ar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ruta_ar` varchar(200) NOT NULL,
  `name_ar` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `descargable` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archives`
--

INSERT INTO `archives` (`id_archives`, `Tittle_ar`, `description_ar`, `type_ar`, `date_publi_ar`, `ruta_ar`, `name_ar`, `id_user`, `id_proceso`, `descargable`) VALUES
(1, 'conocenos', 'conocenos', 'excel', '2025-06-27 21:17:07', 'public/archivos/1750264766_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 'GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 1, 0, 1),
(2, 'yinko', 'yinko', 'word', '2025-06-27 21:17:11', 'public/archivos/1750265026_acata produccion academica (1) (1).docx', 'acata produccion academica (1) (1).docx', 1, 0, 1),
(3, 'xd', 'xd', 'word', '2025-06-27 21:17:16', 'public/archivos/1750265099_acata produccion academica (1) (1).docx', 'acata produccion academica (1) (1).docx', 1, 0, 1),
(4, 'ss', 'ss', 'pdf', '2025-06-27 21:17:19', 'public/archivos/1750265560_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 'GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 1, 0, 1),
(5, 'aa', 'aa', 'pdf', '2025-06-27 21:17:23', 'public/archivos/1750265604_GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 'GFPI-F-147V4FormatoBitacoraSeguimientoEtapaProductiva1 1.xlsx', 1, 0, 1),
(6, 'as', 'as', 'ppt', '2025-06-27 21:17:26', 'public/archivos/1750265658_SGPS-12485-2024 Evaluacion dietas.pdf', 'SGPS-12485-2024 Evaluacion dietas.pdf', 1, 0, 1),
(7, 'Programacion', 'Como programador de software, puedes enfrentarte a varios tipos de riesgos en tu trabajo. Aquí hay una clasificación general de algunos riesgos comunes', 'word', '2025-06-26 02:27:42', 'public/archivos/1750879662_GOR-F-084FormatodeActaV02.docx', 'GOR-F-084FormatodeActaV02.docx', 4, 0, 1),
(12, 'sadasd', 'sadas', 'word', '2025-07-24 21:49:49', 'public/archivos/1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 'Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 34, 0, 1),
(13, 'celular', 'celulares pro malos y buenos', 'word', '2025-08-06 22:32:07', 'public/archivos/1754494327_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 17, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_ar` int(11) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `ruta_ar` varchar(255) NOT NULL,
  `type_ar` varchar(50) DEFAULT NULL,
  `extension_ar` varchar(10) DEFAULT NULL,
  `origen_ar` varchar(100) NOT NULL,
  `Date_Subi_ar` datetime DEFAULT current_timestamp(),
  `deleted_ar` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id_ar`, `name_ar`, `ruta_ar`, `type_ar`, `extension_ar`, `origen_ar`, `Date_Subi_ar`, `deleted_ar`) VALUES
(1, '1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'public/archivos/688923af7ab2c_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 'default', '2025-07-29 14:40:31', 0),
(2, '1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 'public/archivos/688923b61c71a_1753368589_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 'application/vnd.ms-excel', 'xls', 'default', '2025-07-29 14:40:38', 0),
(3, 'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'public/archivos/688923bf9761e_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'application/pdf', 'pdf', 'default', '2025-07-29 14:40:47', 0),
(4, 'programacion.jpg', 'public/archivos/688923ca00a39_programacion.jpg', 'image/jpeg', 'jpg', 'default', '2025-07-29 14:40:58', 1),
(5, 'xd_Nero_AI_Image_Upscaler_Photo_Face.png', 'public/archivos/6889270d73504_xd_Nero_AI_Image_Upscaler_Photo_Face.png', 'image/png', 'png', 'default', '2025-07-29 14:54:53', 0),
(6, '1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'public/archivos/688934e620797_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 'ges', '2025-07-29 15:53:58', 0),
(7, 'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'public/archivos/688935126dfa5_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'application/pdf', 'pdf', 'estra', '2025-07-29 15:54:42', 0),
(8, 'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx', 'public/archivos/68893656ec17a_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 'as', '2025-07-29 16:00:06', 0),
(9, 'Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 'public/archivos/6889365a6dcdd_Brayan Andrey Perdomo Guali - Analisis y Desarrollo de sistemas de informacion.xls', 'application/vnd.ms-excel', 'xls', 'as', '2025-07-29 16:00:10', 0),
(10, 'Acuerdo 010.pdf', 'public/archivos/6889366210e97_Acuerdo 010.pdf', 'application/pdf', 'pdf', 'as', '2025-07-29 16:00:18', 0),
(11, 'xd_Nero_AI_Image_Upscaler_Photo_Face.png', 'public/archivos/688936697df46_xd_Nero_AI_Image_Upscaler_Photo_Face.png', 'image/png', 'png', 'as', '2025-07-29 16:00:25', 0),
(12, 'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'public/archivos/688937a1e8277_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'application/vnd.openxmlformats-officedocument.spre', 'xlsx', 'dsfsdfsd', '2025-07-29 16:05:37', 0),
(13, 'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'public/archivos/6889386e0f242_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'application/pdf', 'pdf', 'ges', '2025-07-29 16:09:02', 0),
(14, 'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 'public/archivos/688947abf24f2_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 'xd', '2025-07-29 17:14:03', 1),
(15, 'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'public/archivos/6889481c46697_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'application/vnd.openxmlformats-officedocument.spre', 'xlsx', 'xd', '2025-07-29 17:15:57', 1),
(16, 'ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'public/archivos/68894b0313889_ES-PLA-FO-01 EJECUCION Y EVALUACION DEL PLAN DE ACCION.xlsx', 'application/vnd.openxmlformats-officedocument.spre', 'xlsx', 'sa', '2025-07-29 17:28:19', 1),
(17, 'ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 'public/archivos/68894b1385e1d_ES-PLA-FO-05 ESTUDIOS TECNICO PARA CONSULTORIA.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 'sas', '2025-07-29 17:28:35', 1),
(18, 'CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'public/archivos/68894d5e1ff9c_CARACTERIZACIÓN PROCESO DE DISEÑO DE PIEZAS 3 D DEFINITIVO.pdf', 'application/pdf', 'pdf', 'dx', '2025-07-29 17:38:22', 0),
(60, 'INFORME MENSUAL 2025.pdf', 'public/archivos/1755787633_ce274fe8_INFORME MENSUAL 2025.pdf', 'application/pdf', 'pdf', 're1', '2025-08-21 09:47:13', 0),
(61, 'Captura de pantalla 2025-07-31 084316.png', 'public/archivos/1755787642_036717f7_Captura de pantalla 2025-07-31 084316.png', 'image/png', 'png', 're1', '2025-08-21 09:47:22', 0),
(62, '1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'public/archivos/1755787648_31847220_1 FORMATO EVALUACIÓN DE LA CAPACIDAD TÉCNICA DEL LABORATORIO.docx', 'application/vnd.openxmlformats-officedocument.word', 'docx', 're1', '2025-08-21 09:47:28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_cambios`
--

CREATE TABLE `auditoria_cambios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `auditoria_cambios`
--

INSERT INTO `auditoria_cambios` (`id`, `usuario`, `descripcion`, `fecha`) VALUES
(101, '17', 'Subió un archivo: image.png', '2025-07-30 16:05:57'),
(102, '17', 'Creó una copia de seguridad: backup_2025-08-06_15-16-24.sql', '2025-08-06 08:16:24'),
(103, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql', '2025-08-06 08:42:25'),
(104, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql', '2025-08-06 08:42:55'),
(105, '17', 'Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf', '2025-08-06 08:43:15'),
(106, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql', '2025-08-06 08:43:26'),
(107, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-42-25.sql', '2025-08-06 08:43:57'),
(108, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql', '2025-08-06 08:44:05'),
(109, '17', 'Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf', '2025-08-06 08:44:43'),
(110, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql', '2025-08-06 08:44:59'),
(111, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-44-05.sql', '2025-08-06 08:45:34'),
(112, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql', '2025-08-06 08:51:10'),
(113, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql', '2025-08-06 08:51:12'),
(114, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-51-09.sql', '2025-08-06 08:51:28'),
(115, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql', '2025-08-06 08:52:22'),
(116, '17', 'Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf', '2025-08-06 08:52:38'),
(117, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql', '2025-08-06 08:52:45'),
(118, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-52-22.sql', '2025-08-06 08:53:18'),
(119, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql', '2025-08-06 08:57:36'),
(120, '17', 'Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf', '2025-08-06 08:58:04'),
(121, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql', '2025-08-06 08:58:10'),
(122, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_15-57-36.sql', '2025-08-06 09:09:44'),
(123, '17', 'Subió un archivo: A.A. 05.08.2025 Repaso Frontend HTML CSS nativo.pdf', '2025-08-06 09:10:12'),
(124, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_16-10-27.sql', '2025-08-06 09:11:02'),
(125, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-06_16-11-03.sql', '2025-08-06 09:17:04'),
(126, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-06_16-17-05.sql', '2025-08-06 09:19:27'),
(127, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-06_18-18-18.sql', '2025-08-06 11:18:18'),
(128, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-05-32.sql', '2025-08-06 17:05:32'),
(129, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-00-17.sql', '2025-08-06 17:05:40'),
(130, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-05-32.sql', '2025-08-06 17:05:43'),
(131, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-07_00-08-22.sql', '2025-08-06 17:08:41'),
(132, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-08-22.sql', '2025-08-06 17:14:10'),
(133, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-14-11.sql', '2025-08-06 17:14:11'),
(134, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-26.sql', '2025-08-06 17:33:27'),
(135, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-29.sql', '2025-08-06 17:33:29'),
(136, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-33-30.sql', '2025-08-06 17:33:30'),
(137, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-14-11.sql', '2025-08-06 17:33:32'),
(138, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-26.sql', '2025-08-06 17:33:36'),
(139, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-29.sql', '2025-08-06 17:33:42'),
(140, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-33-30.sql', '2025-08-06 17:33:43'),
(141, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-36-48.sql', '2025-08-06 17:36:48'),
(142, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-36-48.sql', '2025-08-06 17:41:19'),
(143, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-41-20.sql', '2025-08-06 17:41:20'),
(144, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-41-20.sql', '2025-08-06 17:43:25'),
(145, '17', 'Restauró la copia de seguridad: backup_sennova2_2025-08-07_00-43-25.sql', '2025-08-06 17:43:45'),
(146, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-43-25.sql', '2025-08-06 17:43:57'),
(147, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-07_00-44-30.sql', '2025-08-06 17:44:30'),
(148, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-07_00-44-30.sql', '2025-08-08 08:53:22'),
(149, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-08_15-53-23.sql', '2025-08-08 08:53:23'),
(150, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-12_22-05-05.sql', '2025-08-12 15:05:05'),
(151, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-12_22-05-05.sql', '2025-08-14 11:16:03'),
(152, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-14_18-16-05.sql', '2025-08-14 11:16:05'),
(153, '17', 'Eliminó la copia de seguridad: backup_sennova2_2025-08-14_18-16-05.sql', '2025-08-26 12:12:03'),
(154, '17', 'Creó una copia de seguridad: backup_sennova2_2025-08-26_19-12-05.sql', '2025-08-26 12:12:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel`
--

CREATE TABLE `carrusel` (
  `id_car` int(11) NOT NULL,
  `name_img_c` varchar(255) NOT NULL,
  `title_carr` varchar(255) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrusel`
--

INSERT INTO `carrusel` (`id_car`, `name_img_c`, `title_carr`, `date_create`) VALUES
(8, 'Café y Cacao con Ciencia y Sabor', 'img/H.png', '2025-07-31 20:42:21'),
(9, 'Transformando el Futuro', 'img/E.png', '2025-07-31 20:42:40'),
(13, 'Tecnologías que enciendes ideas', 'img/011Z.jpg', '2025-07-31 22:34:44'),
(16, 'Educación con Tecnología', 'img/014WhatsApp Image 2025-06-13 at 11.53.28 AM.jpeg', '2025-08-05 15:29:08'),
(17, 'Innovación Y Competitividad', 'img/017prueba5.jpg', '2025-08-05 16:03:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones_eva`
--

CREATE TABLE `evaluaciones_eva` (
  `id_eva` int(10) UNSIGNED NOT NULL,
  `name_eva` varchar(120) NOT NULL,
  `date_eva` date NOT NULL,
  `celular_eva` varchar(30) DEFAULT NULL,
  `servicios_eva` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`servicios_eva`)),
  `observaciones_eva` text DEFAULT NULL,
  `aprobado_eva` enum('SI','NO') DEFAULT NULL,
  `created_at_eva` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluaciones_eva`
--

INSERT INTO `evaluaciones_eva` (`id_eva`, `name_eva`, `date_eva`, `celular_eva`, `servicios_eva`, `observaciones_eva`, `aprobado_eva`, `created_at_eva`) VALUES
(1, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:32:44'),
(2, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:33:27'),
(3, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:33:44'),
(4, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:34:15'),
(5, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:35:45'),
(6, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:38:34'),
(7, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:40:11'),
(8, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:44:58'),
(9, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:46:54'),
(10, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:47:54'),
(11, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 15:49:47'),
(12, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 16:05:16'),
(13, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\"]', 'Esta bien', NULL, '2025-08-29 16:17:01'),
(14, 'eqwewq', '2025-08-29', '2323213123123', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_integracion\"]', '123213123123', NULL, '2025-08-29 16:18:38'),
(15, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:23:55'),
(16, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:28:15'),
(17, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:15'),
(18, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:17'),
(19, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:22'),
(20, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:34'),
(21, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:42'),
(22, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:33:45'),
(23, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:35:05'),
(24, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:44:58'),
(25, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_diseno_pcb\",\"servicio_impresion_3d\",\"servicio_transferencia\",\"servicio_montaje\"]', 'bien', 'SI', '2025-08-29 16:45:19'),
(26, 'Brayan', '2025-08-29', '3232274352', '[\"servicio_impresion_3d\",\"servicio_diseno_3d\",\"servicio_transferencia\",\"servicio_montaje\"]', 'Excelente', 'SI', '2025-08-29 16:50:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eva_resp_eva`
--

CREATE TABLE `eva_resp_eva` (
  `id_er_eva` int(10) UNSIGNED NOT NULL,
  `evaluacion_id_eva` int(10) UNSIGNED NOT NULL,
  `codigo_er_eva` varchar(10) NOT NULL,
  `valor_er_eva` enum('SI','NO','NA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eva_resp_eva`
--

INSERT INTO `eva_resp_eva` (`id_er_eva`, `evaluacion_id_eva`, `codigo_er_eva`, `valor_er_eva`) VALUES
(1, 1, '1.1', 'SI'),
(2, 1, '1.2', 'SI'),
(3, 1, '1.3', 'SI'),
(4, 1, '1.4', 'SI'),
(5, 1, '2.1', 'NO'),
(6, 1, '2.2', 'NO'),
(7, 1, '2.3', 'SI'),
(8, 1, '2.4', 'SI'),
(9, 1, '2.5', 'NA'),
(10, 1, '2.6', 'NA'),
(11, 1, '2.7', 'NO'),
(12, 1, '2.8', 'SI'),
(13, 1, '2.9', 'NO'),
(14, 1, '3.1', 'SI'),
(15, 1, '3.2', 'NA'),
(16, 1, '4.1', 'NO'),
(17, 1, '4.2', 'SI'),
(18, 1, '5.1', 'NA'),
(19, 1, '5.2', 'SI'),
(20, 1, '6.1', 'NA'),
(21, 1, '6.2', 'NO'),
(22, 1, '6.3', 'SI'),
(23, 1, '6.4', 'NO'),
(24, 1, '6.5', 'NA'),
(25, 1, '7.1', 'SI'),
(26, 1, '7.2', 'NO'),
(27, 1, '7.3', 'NO'),
(28, 2, '1.1', 'SI'),
(29, 2, '1.2', 'SI'),
(30, 2, '1.3', 'SI'),
(31, 2, '1.4', 'SI'),
(32, 2, '2.1', 'NO'),
(33, 2, '2.2', 'NO'),
(34, 2, '2.3', 'SI'),
(35, 2, '2.4', 'SI'),
(36, 2, '2.5', 'NA'),
(37, 2, '2.6', 'NA'),
(38, 2, '2.7', 'NO'),
(39, 2, '2.8', 'SI'),
(40, 2, '2.9', 'NO'),
(41, 2, '3.1', 'SI'),
(42, 2, '3.2', 'NA'),
(43, 2, '4.1', 'NO'),
(44, 2, '4.2', 'SI'),
(45, 2, '5.1', 'NA'),
(46, 2, '5.2', 'SI'),
(47, 2, '6.1', 'NA'),
(48, 2, '6.2', 'NO'),
(49, 2, '6.3', 'SI'),
(50, 2, '6.4', 'NO'),
(51, 2, '6.5', 'NA'),
(52, 2, '7.1', 'SI'),
(53, 2, '7.2', 'NO'),
(54, 2, '7.3', 'NO'),
(55, 3, '1.1', 'SI'),
(56, 3, '1.2', 'SI'),
(57, 3, '1.3', 'SI'),
(58, 3, '1.4', 'SI'),
(59, 3, '2.1', 'NO'),
(60, 3, '2.2', 'NO'),
(61, 3, '2.3', 'SI'),
(62, 3, '2.4', 'SI'),
(63, 3, '2.5', 'NA'),
(64, 3, '2.6', 'NA'),
(65, 3, '2.7', 'NO'),
(66, 3, '2.8', 'SI'),
(67, 3, '2.9', 'NO'),
(68, 3, '3.1', 'SI'),
(69, 3, '3.2', 'NA'),
(70, 3, '4.1', 'NO'),
(71, 3, '4.2', 'SI'),
(72, 3, '5.1', 'NA'),
(73, 3, '5.2', 'SI'),
(74, 3, '6.1', 'NA'),
(75, 3, '6.2', 'NO'),
(76, 3, '6.3', 'SI'),
(77, 3, '6.4', 'NO'),
(78, 3, '6.5', 'NA'),
(79, 3, '7.1', 'SI'),
(80, 3, '7.2', 'NO'),
(81, 3, '7.3', 'NO'),
(82, 4, '1.1', 'SI'),
(83, 4, '1.2', 'SI'),
(84, 4, '1.3', 'SI'),
(85, 4, '1.4', 'SI'),
(86, 4, '2.1', 'NO'),
(87, 4, '2.2', 'NO'),
(88, 4, '2.3', 'SI'),
(89, 4, '2.4', 'SI'),
(90, 4, '2.5', 'NA'),
(91, 4, '2.6', 'NA'),
(92, 4, '2.7', 'NO'),
(93, 4, '2.8', 'SI'),
(94, 4, '2.9', 'NO'),
(95, 4, '3.1', 'SI'),
(96, 4, '3.2', 'NA'),
(97, 4, '4.1', 'NO'),
(98, 4, '4.2', 'SI'),
(99, 4, '5.1', 'NA'),
(100, 4, '5.2', 'SI'),
(101, 4, '6.1', 'NA'),
(102, 4, '6.2', 'NO'),
(103, 4, '6.3', 'SI'),
(104, 4, '6.4', 'NO'),
(105, 4, '6.5', 'NA'),
(106, 4, '7.1', 'SI'),
(107, 4, '7.2', 'NO'),
(108, 4, '7.3', 'NO'),
(109, 5, '1.1', 'SI'),
(110, 5, '1.2', 'SI'),
(111, 5, '1.3', 'SI'),
(112, 5, '1.4', 'SI'),
(113, 5, '2.1', 'NO'),
(114, 5, '2.2', 'NO'),
(115, 5, '2.3', 'SI'),
(116, 5, '2.4', 'SI'),
(117, 5, '2.5', 'NA'),
(118, 5, '2.6', 'NA'),
(119, 5, '2.7', 'NO'),
(120, 5, '2.8', 'SI'),
(121, 5, '2.9', 'NO'),
(122, 5, '3.1', 'SI'),
(123, 5, '3.2', 'NA'),
(124, 5, '4.1', 'NO'),
(125, 5, '4.2', 'SI'),
(126, 5, '5.1', 'NA'),
(127, 5, '5.2', 'SI'),
(128, 5, '6.1', 'NA'),
(129, 5, '6.2', 'NO'),
(130, 5, '6.3', 'SI'),
(131, 5, '6.4', 'NO'),
(132, 5, '6.5', 'NA'),
(133, 5, '7.1', 'SI'),
(134, 5, '7.2', 'NO'),
(135, 5, '7.3', 'NO'),
(136, 6, '1.1', 'SI'),
(137, 6, '1.2', 'SI'),
(138, 6, '1.3', 'SI'),
(139, 6, '1.4', 'SI'),
(140, 6, '2.1', 'NO'),
(141, 6, '2.2', 'NO'),
(142, 6, '2.3', 'SI'),
(143, 6, '2.4', 'SI'),
(144, 6, '2.5', 'NA'),
(145, 6, '2.6', 'NA'),
(146, 6, '2.7', 'NO'),
(147, 6, '2.8', 'SI'),
(148, 6, '2.9', 'NO'),
(149, 6, '3.1', 'SI'),
(150, 6, '3.2', 'NA'),
(151, 6, '4.1', 'NO'),
(152, 6, '4.2', 'SI'),
(153, 6, '5.1', 'NA'),
(154, 6, '5.2', 'SI'),
(155, 6, '6.1', 'NA'),
(156, 6, '6.2', 'NO'),
(157, 6, '6.3', 'SI'),
(158, 6, '6.4', 'NO'),
(159, 6, '6.5', 'NA'),
(160, 6, '7.1', 'SI'),
(161, 6, '7.2', 'NO'),
(162, 6, '7.3', 'NO'),
(163, 7, '1.1', 'SI'),
(164, 7, '1.2', 'SI'),
(165, 7, '1.3', 'SI'),
(166, 7, '1.4', 'SI'),
(167, 7, '2.1', 'NO'),
(168, 7, '2.2', 'NO'),
(169, 7, '2.3', 'SI'),
(170, 7, '2.4', 'SI'),
(171, 7, '2.5', 'NA'),
(172, 7, '2.6', 'NA'),
(173, 7, '2.7', 'NO'),
(174, 7, '2.8', 'SI'),
(175, 7, '2.9', 'NO'),
(176, 7, '3.1', 'SI'),
(177, 7, '3.2', 'NA'),
(178, 7, '4.1', 'NO'),
(179, 7, '4.2', 'SI'),
(180, 7, '5.1', 'NA'),
(181, 7, '5.2', 'SI'),
(182, 7, '6.1', 'NA'),
(183, 7, '6.2', 'NO'),
(184, 7, '6.3', 'SI'),
(185, 7, '6.4', 'NO'),
(186, 7, '6.5', 'NA'),
(187, 7, '7.1', 'SI'),
(188, 7, '7.2', 'NO'),
(189, 7, '7.3', 'NO'),
(190, 8, '1.1', 'SI'),
(191, 8, '1.2', 'SI'),
(192, 8, '1.3', 'SI'),
(193, 8, '1.4', 'SI'),
(194, 8, '2.1', 'NO'),
(195, 8, '2.2', 'NO'),
(196, 8, '2.3', 'SI'),
(197, 8, '2.4', 'SI'),
(198, 8, '2.5', 'NA'),
(199, 8, '2.6', 'NA'),
(200, 8, '2.7', 'NO'),
(201, 8, '2.8', 'SI'),
(202, 8, '2.9', 'NO'),
(203, 8, '3.1', 'SI'),
(204, 8, '3.2', 'NA'),
(205, 8, '4.1', 'NO'),
(206, 8, '4.2', 'SI'),
(207, 8, '5.1', 'NA'),
(208, 8, '5.2', 'SI'),
(209, 8, '6.1', 'NA'),
(210, 8, '6.2', 'NO'),
(211, 8, '6.3', 'SI'),
(212, 8, '6.4', 'NO'),
(213, 8, '6.5', 'NA'),
(214, 8, '7.1', 'SI'),
(215, 8, '7.2', 'NO'),
(216, 8, '7.3', 'NO'),
(217, 9, '1.1', 'SI'),
(218, 9, '1.2', 'SI'),
(219, 9, '1.3', 'SI'),
(220, 9, '1.4', 'SI'),
(221, 9, '2.1', 'NO'),
(222, 9, '2.2', 'NO'),
(223, 9, '2.3', 'SI'),
(224, 9, '2.4', 'SI'),
(225, 9, '2.5', 'NA'),
(226, 9, '2.6', 'NA'),
(227, 9, '2.7', 'NO'),
(228, 9, '2.8', 'SI'),
(229, 9, '2.9', 'NO'),
(230, 9, '3.1', 'SI'),
(231, 9, '3.2', 'NA'),
(232, 9, '4.1', 'NO'),
(233, 9, '4.2', 'SI'),
(234, 9, '5.1', 'NA'),
(235, 9, '5.2', 'SI'),
(236, 9, '6.1', 'NA'),
(237, 9, '6.2', 'NO'),
(238, 9, '6.3', 'SI'),
(239, 9, '6.4', 'NO'),
(240, 9, '6.5', 'NA'),
(241, 9, '7.1', 'SI'),
(242, 9, '7.2', 'NO'),
(243, 9, '7.3', 'NO'),
(244, 10, '1.1', 'SI'),
(245, 10, '1.2', 'SI'),
(246, 10, '1.3', 'SI'),
(247, 10, '1.4', 'SI'),
(248, 10, '2.1', 'NO'),
(249, 10, '2.2', 'NO'),
(250, 10, '2.3', 'SI'),
(251, 10, '2.4', 'SI'),
(252, 10, '2.5', 'NA'),
(253, 10, '2.6', 'NA'),
(254, 10, '2.7', 'NO'),
(255, 10, '2.8', 'SI'),
(256, 10, '2.9', 'NO'),
(257, 10, '3.1', 'SI'),
(258, 10, '3.2', 'NA'),
(259, 10, '4.1', 'NO'),
(260, 10, '4.2', 'SI'),
(261, 10, '5.1', 'NA'),
(262, 10, '5.2', 'SI'),
(263, 10, '6.1', 'NA'),
(264, 10, '6.2', 'NO'),
(265, 10, '6.3', 'SI'),
(266, 10, '6.4', 'NO'),
(267, 10, '6.5', 'NA'),
(268, 10, '7.1', 'SI'),
(269, 10, '7.2', 'NO'),
(270, 10, '7.3', 'NO'),
(271, 11, '1.1', 'SI'),
(272, 11, '1.2', 'SI'),
(273, 11, '1.3', 'SI'),
(274, 11, '1.4', 'SI'),
(275, 11, '2.1', 'NO'),
(276, 11, '2.2', 'NO'),
(277, 11, '2.3', 'SI'),
(278, 11, '2.4', 'SI'),
(279, 11, '2.5', 'NA'),
(280, 11, '2.6', 'NA'),
(281, 11, '2.7', 'NO'),
(282, 11, '2.8', 'SI'),
(283, 11, '2.9', 'NO'),
(284, 11, '3.1', 'SI'),
(285, 11, '3.2', 'NA'),
(286, 11, '4.1', 'NO'),
(287, 11, '4.2', 'SI'),
(288, 11, '5.1', 'NA'),
(289, 11, '5.2', 'SI'),
(290, 11, '6.1', 'NA'),
(291, 11, '6.2', 'NO'),
(292, 11, '6.3', 'SI'),
(293, 11, '6.4', 'NO'),
(294, 11, '6.5', 'NA'),
(295, 11, '7.1', 'SI'),
(296, 11, '7.2', 'NO'),
(297, 11, '7.3', 'NO'),
(298, 12, '1.1', 'SI'),
(299, 12, '1.2', 'SI'),
(300, 12, '1.3', 'SI'),
(301, 12, '1.4', 'SI'),
(302, 12, '2.1', 'NO'),
(303, 12, '2.2', 'NO'),
(304, 12, '2.3', 'SI'),
(305, 12, '2.4', 'SI'),
(306, 12, '2.5', 'NA'),
(307, 12, '2.6', 'NA'),
(308, 12, '2.7', 'NO'),
(309, 12, '2.8', 'SI'),
(310, 12, '2.9', 'NO'),
(311, 12, '3.1', 'SI'),
(312, 12, '3.2', 'NA'),
(313, 12, '4.1', 'NO'),
(314, 12, '4.2', 'SI'),
(315, 12, '5.1', 'NA'),
(316, 12, '5.2', 'SI'),
(317, 12, '6.1', 'NA'),
(318, 12, '6.2', 'NO'),
(319, 12, '6.3', 'SI'),
(320, 12, '6.4', 'NO'),
(321, 12, '6.5', 'NA'),
(322, 12, '7.1', 'SI'),
(323, 12, '7.2', 'NO'),
(324, 12, '7.3', 'NO'),
(325, 13, '1.1', 'SI'),
(326, 13, '1.2', 'SI'),
(327, 13, '1.3', 'SI'),
(328, 13, '1.4', 'SI'),
(329, 13, '2.1', 'NO'),
(330, 13, '2.2', 'NO'),
(331, 13, '2.3', 'SI'),
(332, 13, '2.4', 'SI'),
(333, 13, '2.5', 'NA'),
(334, 13, '2.6', 'NA'),
(335, 13, '2.7', 'NO'),
(336, 13, '2.8', 'SI'),
(337, 13, '2.9', 'NO'),
(338, 13, '3.1', 'SI'),
(339, 13, '3.2', 'NA'),
(340, 13, '4.1', 'NO'),
(341, 13, '4.2', 'SI'),
(342, 13, '5.1', 'NA'),
(343, 13, '5.2', 'SI'),
(344, 13, '6.1', 'NA'),
(345, 13, '6.2', 'NO'),
(346, 13, '6.3', 'SI'),
(347, 13, '6.4', 'NO'),
(348, 13, '6.5', 'NA'),
(349, 13, '7.1', 'SI'),
(350, 13, '7.2', 'NO'),
(351, 13, '7.3', 'NO'),
(352, 14, '1.1', 'SI'),
(353, 14, '1.2', 'SI'),
(354, 14, '2.1', 'SI'),
(355, 14, '2.2', 'SI'),
(356, 14, '2.3', 'SI'),
(357, 14, '2.4', 'SI'),
(358, 14, '2.5', 'SI'),
(359, 14, '2.6', 'SI'),
(360, 14, '2.7', 'SI'),
(361, 14, '2.8', 'SI'),
(362, 14, '2.9', 'SI'),
(363, 14, '3.1', 'NO'),
(364, 14, '3.2', 'SI'),
(365, 14, '4.1', 'NO'),
(366, 14, '4.2', 'SI'),
(367, 14, '5.1', 'NO'),
(368, 14, '5.2', 'SI'),
(369, 14, '6.1', 'NO'),
(370, 14, '6.2', 'SI'),
(371, 14, '6.4', 'SI'),
(372, 14, '6.5', 'NO'),
(373, 14, '7.1', 'SI'),
(374, 15, '1.1', 'SI'),
(375, 15, '1.2', 'SI'),
(376, 15, '1.3', 'SI'),
(377, 15, '1.4', 'SI'),
(378, 15, '2.1', 'SI'),
(379, 15, '2.2', 'NO'),
(380, 15, '2.3', 'SI'),
(381, 15, '2.4', 'NO'),
(382, 15, '2.5', 'SI'),
(383, 15, '2.6', 'NO'),
(384, 15, '2.7', 'NO'),
(385, 15, '2.8', 'NA'),
(386, 15, '2.9', 'NA'),
(387, 15, '3.1', 'NO'),
(388, 15, '3.2', 'NA'),
(389, 15, '4.1', 'NA'),
(390, 15, '4.2', 'NO'),
(391, 15, '5.1', 'NA'),
(392, 15, '5.2', 'NO'),
(393, 15, '6.1', 'NA'),
(394, 15, '6.2', 'NA'),
(395, 15, '6.3', 'NO'),
(396, 15, '6.4', 'SI'),
(397, 15, '6.5', 'NA'),
(398, 15, '7.1', 'NO'),
(399, 15, '7.2', 'SI'),
(400, 15, '7.3', 'NA'),
(401, 16, '1.1', 'SI'),
(402, 16, '1.2', 'SI'),
(403, 16, '1.3', 'SI'),
(404, 16, '1.4', 'SI'),
(405, 16, '2.1', 'SI'),
(406, 16, '2.2', 'NO'),
(407, 16, '2.3', 'SI'),
(408, 16, '2.4', 'NO'),
(409, 16, '2.5', 'SI'),
(410, 16, '2.6', 'NO'),
(411, 16, '2.7', 'NO'),
(412, 16, '2.8', 'NA'),
(413, 16, '2.9', 'NA'),
(414, 16, '3.1', 'NO'),
(415, 16, '3.2', 'NA'),
(416, 16, '4.1', 'NA'),
(417, 16, '4.2', 'NO'),
(418, 16, '5.1', 'NA'),
(419, 16, '5.2', 'NO'),
(420, 16, '6.1', 'NA'),
(421, 16, '6.2', 'NA'),
(422, 16, '6.3', 'NO'),
(423, 16, '6.4', 'SI'),
(424, 16, '6.5', 'NA'),
(425, 16, '7.1', 'NO'),
(426, 16, '7.2', 'SI'),
(427, 16, '7.3', 'NA'),
(428, 17, '1.1', 'SI'),
(429, 17, '1.2', 'SI'),
(430, 17, '1.3', 'SI'),
(431, 17, '1.4', 'SI'),
(432, 17, '2.1', 'SI'),
(433, 17, '2.2', 'NO'),
(434, 17, '2.3', 'SI'),
(435, 17, '2.4', 'NO'),
(436, 17, '2.5', 'SI'),
(437, 17, '2.6', 'NO'),
(438, 17, '2.7', 'NO'),
(439, 17, '2.8', 'NA'),
(440, 17, '2.9', 'NA'),
(441, 17, '3.1', 'NO'),
(442, 17, '3.2', 'NA'),
(443, 17, '4.1', 'NA'),
(444, 17, '4.2', 'NO'),
(445, 17, '5.1', 'NA'),
(446, 17, '5.2', 'NO'),
(447, 17, '6.1', 'NA'),
(448, 17, '6.2', 'NA'),
(449, 17, '6.3', 'NO'),
(450, 17, '6.4', 'SI'),
(451, 17, '6.5', 'NA'),
(452, 17, '7.1', 'NO'),
(453, 17, '7.2', 'SI'),
(454, 17, '7.3', 'NA'),
(455, 18, '1.1', 'SI'),
(456, 18, '1.2', 'SI'),
(457, 18, '1.3', 'SI'),
(458, 18, '1.4', 'SI'),
(459, 18, '2.1', 'SI'),
(460, 18, '2.2', 'NO'),
(461, 18, '2.3', 'SI'),
(462, 18, '2.4', 'NO'),
(463, 18, '2.5', 'SI'),
(464, 18, '2.6', 'NO'),
(465, 18, '2.7', 'NO'),
(466, 18, '2.8', 'NA'),
(467, 18, '2.9', 'NA'),
(468, 18, '3.1', 'NO'),
(469, 18, '3.2', 'NA'),
(470, 18, '4.1', 'NA'),
(471, 18, '4.2', 'NO'),
(472, 18, '5.1', 'NA'),
(473, 18, '5.2', 'NO'),
(474, 18, '6.1', 'NA'),
(475, 18, '6.2', 'NA'),
(476, 18, '6.3', 'NO'),
(477, 18, '6.4', 'SI'),
(478, 18, '6.5', 'NA'),
(479, 18, '7.1', 'NO'),
(480, 18, '7.2', 'SI'),
(481, 18, '7.3', 'NA'),
(482, 19, '1.1', 'SI'),
(483, 19, '1.2', 'SI'),
(484, 19, '1.3', 'SI'),
(485, 19, '1.4', 'SI'),
(486, 19, '2.1', 'SI'),
(487, 19, '2.2', 'NO'),
(488, 19, '2.3', 'SI'),
(489, 19, '2.4', 'NO'),
(490, 19, '2.5', 'SI'),
(491, 19, '2.6', 'NO'),
(492, 19, '2.7', 'NO'),
(493, 19, '2.8', 'NA'),
(494, 19, '2.9', 'NA'),
(495, 19, '3.1', 'NO'),
(496, 19, '3.2', 'NA'),
(497, 19, '4.1', 'NA'),
(498, 19, '4.2', 'NO'),
(499, 19, '5.1', 'NA'),
(500, 19, '5.2', 'NO'),
(501, 19, '6.1', 'NA'),
(502, 19, '6.2', 'NA'),
(503, 19, '6.3', 'NO'),
(504, 19, '6.4', 'SI'),
(505, 19, '6.5', 'NA'),
(506, 19, '7.1', 'NO'),
(507, 19, '7.2', 'SI'),
(508, 19, '7.3', 'NA'),
(509, 20, '1.1', 'SI'),
(510, 20, '1.2', 'SI'),
(511, 20, '1.3', 'SI'),
(512, 20, '1.4', 'SI'),
(513, 20, '2.1', 'SI'),
(514, 20, '2.2', 'NO'),
(515, 20, '2.3', 'SI'),
(516, 20, '2.4', 'NO'),
(517, 20, '2.5', 'SI'),
(518, 20, '2.6', 'NO'),
(519, 20, '2.7', 'NO'),
(520, 20, '2.8', 'NA'),
(521, 20, '2.9', 'NA'),
(522, 20, '3.1', 'NO'),
(523, 20, '3.2', 'NA'),
(524, 20, '4.1', 'NA'),
(525, 20, '4.2', 'NO'),
(526, 20, '5.1', 'NA'),
(527, 20, '5.2', 'NO'),
(528, 20, '6.1', 'NA'),
(529, 20, '6.2', 'NA'),
(530, 20, '6.3', 'NO'),
(531, 20, '6.4', 'SI'),
(532, 20, '6.5', 'NA'),
(533, 20, '7.1', 'NO'),
(534, 20, '7.2', 'SI'),
(535, 20, '7.3', 'NA'),
(536, 21, '1.1', 'SI'),
(537, 21, '1.2', 'SI'),
(538, 21, '1.3', 'SI'),
(539, 21, '1.4', 'SI'),
(540, 21, '2.1', 'SI'),
(541, 21, '2.2', 'NO'),
(542, 21, '2.3', 'SI'),
(543, 21, '2.4', 'NO'),
(544, 21, '2.5', 'SI'),
(545, 21, '2.6', 'NO'),
(546, 21, '2.7', 'NO'),
(547, 21, '2.8', 'NA'),
(548, 21, '2.9', 'NA'),
(549, 21, '3.1', 'NO'),
(550, 21, '3.2', 'NA'),
(551, 21, '4.1', 'NA'),
(552, 21, '4.2', 'NO'),
(553, 21, '5.1', 'NA'),
(554, 21, '5.2', 'NO'),
(555, 21, '6.1', 'NA'),
(556, 21, '6.2', 'NA'),
(557, 21, '6.3', 'NO'),
(558, 21, '6.4', 'SI'),
(559, 21, '6.5', 'NA'),
(560, 21, '7.1', 'NO'),
(561, 21, '7.2', 'SI'),
(562, 21, '7.3', 'NA'),
(563, 22, '1.1', 'SI'),
(564, 22, '1.2', 'SI'),
(565, 22, '1.3', 'SI'),
(566, 22, '1.4', 'SI'),
(567, 22, '2.1', 'SI'),
(568, 22, '2.2', 'NO'),
(569, 22, '2.3', 'SI'),
(570, 22, '2.4', 'NO'),
(571, 22, '2.5', 'SI'),
(572, 22, '2.6', 'NO'),
(573, 22, '2.7', 'NO'),
(574, 22, '2.8', 'NA'),
(575, 22, '2.9', 'NA'),
(576, 22, '3.1', 'NO'),
(577, 22, '3.2', 'NA'),
(578, 22, '4.1', 'NA'),
(579, 22, '4.2', 'NO'),
(580, 22, '5.1', 'NA'),
(581, 22, '5.2', 'NO'),
(582, 22, '6.1', 'NA'),
(583, 22, '6.2', 'NA'),
(584, 22, '6.3', 'NO'),
(585, 22, '6.4', 'SI'),
(586, 22, '6.5', 'NA'),
(587, 22, '7.1', 'NO'),
(588, 22, '7.2', 'SI'),
(589, 22, '7.3', 'NA'),
(590, 23, '1.1', 'SI'),
(591, 23, '1.2', 'SI'),
(592, 23, '1.3', 'SI'),
(593, 23, '1.4', 'SI'),
(594, 23, '2.1', 'SI'),
(595, 23, '2.2', 'NO'),
(596, 23, '2.3', 'SI'),
(597, 23, '2.4', 'NO'),
(598, 23, '2.5', 'SI'),
(599, 23, '2.6', 'NO'),
(600, 23, '2.7', 'NO'),
(601, 23, '2.8', 'NA'),
(602, 23, '2.9', 'NA'),
(603, 23, '3.1', 'NO'),
(604, 23, '3.2', 'NA'),
(605, 23, '4.1', 'NA'),
(606, 23, '4.2', 'NO'),
(607, 23, '5.1', 'NA'),
(608, 23, '5.2', 'NO'),
(609, 23, '6.1', 'NA'),
(610, 23, '6.2', 'NA'),
(611, 23, '6.3', 'NO'),
(612, 23, '6.4', 'SI'),
(613, 23, '6.5', 'NA'),
(614, 23, '7.1', 'NO'),
(615, 23, '7.2', 'SI'),
(616, 23, '7.3', 'NA'),
(617, 24, '1.1', 'SI'),
(618, 24, '1.2', 'SI'),
(619, 24, '1.3', 'SI'),
(620, 24, '1.4', 'SI'),
(621, 24, '2.1', 'SI'),
(622, 24, '2.2', 'NO'),
(623, 24, '2.3', 'SI'),
(624, 24, '2.4', 'NO'),
(625, 24, '2.5', 'SI'),
(626, 24, '2.6', 'NO'),
(627, 24, '2.7', 'NO'),
(628, 24, '2.8', 'NA'),
(629, 24, '2.9', 'NA'),
(630, 24, '3.1', 'NO'),
(631, 24, '3.2', 'NA'),
(632, 24, '4.1', 'NA'),
(633, 24, '4.2', 'NO'),
(634, 24, '5.1', 'NA'),
(635, 24, '5.2', 'NO'),
(636, 24, '6.1', 'NA'),
(637, 24, '6.2', 'NA'),
(638, 24, '6.3', 'NO'),
(639, 24, '6.4', 'SI'),
(640, 24, '6.5', 'NA'),
(641, 24, '7.1', 'NO'),
(642, 24, '7.2', 'SI'),
(643, 24, '7.3', 'NA'),
(644, 25, '1.1', 'SI'),
(645, 25, '1.2', 'SI'),
(646, 25, '1.3', 'SI'),
(647, 25, '1.4', 'SI'),
(648, 25, '2.1', 'SI'),
(649, 25, '2.2', 'NO'),
(650, 25, '2.3', 'SI'),
(651, 25, '2.4', 'NO'),
(652, 25, '2.5', 'SI'),
(653, 25, '2.6', 'NO'),
(654, 25, '2.7', 'NO'),
(655, 25, '2.8', 'NA'),
(656, 25, '2.9', 'NA'),
(657, 25, '3.1', 'NO'),
(658, 25, '3.2', 'NA'),
(659, 25, '4.1', 'NA'),
(660, 25, '4.2', 'NO'),
(661, 25, '5.1', 'NA'),
(662, 25, '5.2', 'NO'),
(663, 25, '6.1', 'NA'),
(664, 25, '6.2', 'NA'),
(665, 25, '6.3', 'NO'),
(666, 25, '6.4', 'SI'),
(667, 25, '6.5', 'NA'),
(668, 25, '7.1', 'NO'),
(669, 25, '7.2', 'SI'),
(670, 25, '7.3', 'NA'),
(671, 26, '1.1', 'NO'),
(672, 26, '1.2', 'NO'),
(673, 26, '1.3', 'NA'),
(674, 26, '1.4', 'SI'),
(675, 26, '2.1', 'SI'),
(676, 26, '2.2', 'NO'),
(677, 26, '2.3', 'SI'),
(678, 26, '2.4', 'NO'),
(679, 26, '2.5', 'SI'),
(680, 26, '2.6', 'NA'),
(681, 26, '2.7', 'NA'),
(682, 26, '2.8', 'SI'),
(683, 26, '2.9', 'NA'),
(684, 26, '3.1', 'NA'),
(685, 26, '3.2', 'NO'),
(686, 26, '4.1', 'SI'),
(687, 26, '4.2', 'SI'),
(688, 26, '5.1', 'NO'),
(689, 26, '5.2', 'SI'),
(690, 26, '6.1', 'NO'),
(691, 26, '6.2', 'NA'),
(692, 26, '6.3', 'NO'),
(693, 26, '6.4', 'SI'),
(694, 26, '7.1', 'SI'),
(695, 26, '7.2', 'NO'),
(696, 26, '7.3', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_botones`
--

CREATE TABLE `gestion_botones` (
  `id_ges` int(11) NOT NULL,
  `name_but` varchar(255) DEFAULT NULL,
  `ruta_but` varchar(255) DEFAULT NULL,
  `color_but` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gestion_botones`
--

INSERT INTO `gestion_botones` (`id_ges`, `name_but`, `ruta_but`, `color_but`) VALUES
(35, 'Procesos Estratégicos', 'views/procesos/estrategico.php', '#bd9201'),
(39, 'Procesos Misionales', 'views/procesos/misionales.php', '#888a91'),
(42, 'Procesos Apoyo', 'views/procesos/apoyo.php', '#337a56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_subprocesos`
--

CREATE TABLE `gestion_subprocesos` (
  `id_sub` int(11) NOT NULL,
  `nombre_sub` varchar(100) NOT NULL,
  `ruta_sub` varchar(100) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `Pro_padre` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gestion_subprocesos`
--

INSERT INTO `gestion_subprocesos` (`id_sub`, `nombre_sub`, `ruta_sub`, `id_proceso`, `Pro_padre`, `created_at`) VALUES
(38, 'Gestion tenica', 'te', 39, 'misionales.php', '2025-08-20 20:38:46'),
(39, 'sera', 'sera', 39, 'misionales.php', '2025-08-20 21:21:22'),
(41, 'recursos', 're1', 42, 'apoyo.php', '2025-08-21 14:47:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `leida` tinyint(1) DEFAULT 0,
  `fecha` datetime DEFAULT current_timestamp(),
  `request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `area`, `mensaje`, `leida`, `fecha`, `request_id`) VALUES
(12, 'electronica', 'Solicitud de Andres para fisicoquimico', 1, '2025-07-21 15:12:21', NULL),
(13, 'electronica', 'Solicitud de Milan para calidad', 1, '2025-07-21 15:14:48', NULL),
(14, 'cafe', 'Solicitud de xd para calidad', 1, '2025-07-21 15:19:23', NULL),
(15, 'electronica', 'Solicitud de Juan para Diseño de tarjetas de circuito impreso (PCB)', 1, '2025-07-21 15:22:05', NULL),
(16, 'electronica', 'Solicitud de Manuel para Diseño de piezas 3D', 1, '2025-07-21 16:09:24', NULL),
(17, 'electronica', 'Solicitud de Sofia para Fabricación de tarjetas PCB', 1, '2025-08-01 08:33:52', NULL),
(18, 'electronica', 'Solicitud de Andrea para Fabricación de tarjetas PCB', 1, '2025-08-01 08:38:01', NULL),
(19, 'electronica', 'Solicitud de dsds para Impresión de piezas 3D', 1, '2025-08-01 08:53:02', NULL),
(20, 'electronica', 'Solicitud de sfdsfd para Fabricación de tarjetas PCB', 1, '2025-08-01 08:56:10', NULL),
(21, 'electronica', 'Solicitud de dsada para Fabricación de tarjetas PCB', 1, '2025-08-01 08:59:26', NULL),
(22, 'electronica', 'Solicitud de dsdsd para Impresión de piezas 3D', 1, '2025-08-01 09:16:20', NULL),
(23, 'electronica', 'Solicitud de dsad para Diseño de piezas 3D', 1, '2025-08-01 09:18:49', NULL),
(24, 'cafe', 'Solicitud de dsdas para calidad', 1, '2025-08-01 09:28:37', NULL),
(25, 'cafe', 'Solicitud de rwerwe para fisicoquimico', 1, '2025-08-01 09:31:11', NULL),
(26, 'cafe', 'Solicitud de dsad para calidad', 1, '2025-08-01 09:32:37', NULL),
(27, 'electronica', 'Solicitud de dsdsd para Diseño de piezas 3D', 1, '2025-08-01 09:41:41', NULL),
(28, 'cafe', 'Solicitud de asdasd para sensorial', 1, '2025-08-01 09:41:55', NULL),
(29, 'cafe', 'Solicitud de fdsfsd para fisicoquimico', 1, '2025-08-01 09:44:30', NULL),
(30, 'electronica', 'Solicitud de fsdf para Fabricación de tarjetas PCB', 1, '2025-08-01 09:45:25', NULL),
(31, 'cafe', 'Solicitud de fsdf para calidad', 1, '2025-08-01 09:48:22', NULL),
(32, 'cafe', 'Solicitud de MaickWare para asesoria', 0, '2025-08-22 10:30:34', NULL),
(33, 'cafe', 'La solicitud con ID 35 ha sido Aceptada.', 0, '2025-08-22 10:31:06', NULL),
(34, 'cafe', 'Solicitud de Procesos Apoyo para tueste', 0, '2025-08-22 14:19:47', NULL),
(35, 'cafe', 'La solicitud con ID 36 ha sido Aceptada.', 0, '2025-08-22 14:20:19', NULL),
(36, 'cafe', 'Solicitud de dsada para calidad', 0, '2025-08-22 14:20:52', NULL),
(37, 'cafe', 'La solicitud con ID 37 ha sido Aceptada.', 0, '2025-08-22 14:21:04', NULL),
(38, 'cafe', 'Solicitud de Brayan para fisicoquimico', 0, '2025-08-22 14:21:37', NULL),
(39, 'cafe', 'La solicitud con ID 38 ha sido Aceptada.', 0, '2025-08-22 14:21:50', NULL),
(40, 'cafe', 'Solicitud de Brayan para sensorial', 0, '2025-08-22 14:35:40', NULL),
(41, 'cafe', 'La solicitud con ID 39 ha sido Aceptada.', 0, '2025-08-22 14:35:55', NULL),
(42, 'cafe', 'Solicitud de Brayan Perdomo para fisicoquimico', 0, '2025-08-22 15:32:12', NULL),
(43, 'cafe', 'La solicitud con ID 40 ha sido Aceptada.', 0, '2025-08-22 15:32:51', NULL),
(44, 'cafe', 'Solicitud de Procesos Apoyo para calidad', 0, '2025-08-22 15:44:19', NULL),
(45, 'cafe', 'La solicitud con ID 41 ha sido Aceptada.', 0, '2025-08-22 15:44:35', NULL),
(46, 'cafe', 'Solicitud de Brayan Perdomo para calidad', 0, '2025-08-22 15:47:25', NULL),
(47, 'cafe', 'Solicitud de Procesos Apoyo para sensorial', 0, '2025-08-22 15:47:36', NULL),
(48, 'cafe', 'Solicitud de dsada para fisicoquimico', 0, '2025-08-22 15:47:48', NULL),
(49, 'cafe', 'La solicitud con ID 42 ha sido Rechazada.', 0, '2025-08-22 15:48:02', NULL),
(50, 'cafe', 'La solicitud con ID 43 ha sido Aceptada.', 0, '2025-08-22 15:51:14', NULL),
(51, 'cafe', 'La solicitud con ID 44 ha sido Aceptada.', 0, '2025-08-22 15:51:48', NULL),
(52, 'electronica', 'Solicitud de brayan  para Fabricación de tarjetas PCB', 1, '2025-08-22 15:53:41', NULL),
(53, 'electronica', 'La solicitud con ID 45 ha sido Aceptada.', 1, '2025-08-22 15:53:57', NULL),
(54, 'electronica', 'Solicitud de Brayan para Impresión de piezas 3D', 1, '2025-08-22 15:55:23', NULL),
(55, 'electronica', 'La solicitud con ID 46 ha sido Rechazada.', 1, '2025-08-22 15:56:00', NULL),
(56, 'electronica', 'Solicitud de dsadsadsa para Impresión de piezas 3D', 1, '2025-08-22 15:59:23', NULL),
(57, 'electronica', 'La solicitud con ID 47 ha sido Aceptada.', 1, '2025-08-22 15:59:37', NULL),
(58, 'cafe', 'Solicitud de 123 para sensorial', 0, '2025-08-22 16:04:56', NULL),
(59, 'cafe', 'La solicitud con ID 48 ha sido Aceptada.', 0, '2025-08-22 16:05:07', NULL),
(60, 'cafe', 'La solicitud con ID 48 ha sido Aceptada.', 0, '2025-08-22 16:05:08', NULL),
(61, 'cafe', 'Solicitud de 432432432432 para calidad', 0, '2025-08-22 16:06:44', NULL),
(62, 'cafe', 'La solicitud con ID 49 ha sido Aceptada.', 0, '2025-08-22 16:06:51', NULL),
(63, 'cafe', 'Solicitud de Ultima prueba para fisicoquimico', 0, '2025-08-22 16:09:26', NULL),
(64, 'cafe', 'La solicitud con ID 50 ha sido Rechazada.', 0, '2025-08-22 16:09:47', NULL),
(65, 'electronica', 'Solicitud de Brayan para Diseño de piezas 3D', 1, '2025-08-22 16:15:07', NULL),
(66, 'electronica', 'La solicitud con ID 51 ha sido Aceptada.', 1, '2025-08-22 16:15:32', NULL),
(67, 'electronica', 'Solicitud de electronica para Diseño de piezas 3D', 1, '2025-08-22 16:28:26', NULL),
(68, 'cafe', 'Solicitud de Cafe para calidad', 0, '2025-08-22 16:28:42', NULL),
(69, 'cafe', 'La solicitud con ID 53 ha sido Aceptada.', 0, '2025-08-22 16:28:56', NULL),
(70, 'electronica', 'La solicitud con ID 52 ha sido Aceptada.', 1, '2025-08-22 16:29:56', NULL),
(71, 'cafe', 'Solicitud de Brayan para calidad', 0, '2025-08-26 10:53:57', 54),
(72, 'electronica', 'Solicitud de Perdomo para Diseño de piezas 3D', 1, '2025-08-26 10:54:39', 55),
(73, 'electronica', 'La solicitud con ID 55 ha sido Aceptada.', 1, '2025-08-26 11:27:07', 55),
(74, 'cafe', 'La solicitud con ID 54 ha sido Rechazada.', 0, '2025-08-26 11:27:17', 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portadas_lab`
--

CREATE TABLE `portadas_lab` (
  `id_port` int(11) NOT NULL,
  `area_port` varchar(50) NOT NULL,
  `ruta_img_port` varchar(255) NOT NULL,
  `title_port` text NOT NULL,
  `desc_port` text NOT NULL,
  `date_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `portadas_lab`
--

INSERT INTO `portadas_lab` (`id_port`, `area_port`, `ruta_img_port`, `title_port`, `desc_port`, `date_actualizacion`) VALUES
(2, 'cafe', 'img/H.png', 'Excelencia en Análisis de Café', 'Servicios especializados en calidad, catación y análisis físico del café con el respaldo SENA', '2025-07-31 23:00:21'),
(3, 'electronica', 'img/J.png', 'Soluciones Electrónicas Profesionales', 'Diseño y fabricación de tarjetas de circuito impreso, diseño e impresión de piezas 3D, fabricación o integración de soluciones tecnológicas para el sector agropecuario', '2025-08-04 14:21:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `contenido_tabla` longtext DEFAULT NULL,
  `archivo_nombre` varchar(200) DEFAULT NULL,
  `archivo_ruta` varchar(255) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`id`, `nombre`, `contenido_tabla`, `archivo_nombre`, `archivo_ruta`, `actualizado_por`, `actualizado_en`) VALUES
(2, 'Gestión Organizacional y de Riesgo', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(3, 'Gestión Contractual', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(4, 'Gestión Documental', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(5, 'Gestión de Logística e Infraestructura', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(6, 'Gestión de Recursos Financieros', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(7, 'Impresión de Piezas 3D', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(9, 'Diseño de Tarjetas de Circuito Impreso', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(10, 'Diseño de Piezas 3D', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(11, 'Transferencia de Conocimientos y Tecnologías', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24'),
(12, 'Montaje de Componentes Eléctricos', NULL, NULL, NULL, NULL, '2025-07-10 15:50:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
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
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `title`, `content`, `image_path`, `thumbnail_path`, `type_pu`, `lab_area`, `published_at`, `is_active`, `destacada`, `created_at`, `updated_at`, `categoria`) VALUES
(1, 'Cafe', 'cafe', '1752265411_D.png', NULL, 'noticia', 'cafe', '2025-07-11 15:23:00', 1, 0, '2025-07-11 20:23:31', '2025-08-06 15:40:17', NULL),
(2, 'Evento de Innovación 2025', 'El próximo 20 de junio se llevará a cabo el evento anual de innovación agroempresarial.', 'img_68922a2f2a4e2.jpg', NULL, 'eventos', NULL, '2025-06-12 08:48:38', 1, 0, '2025-06-12 18:48:38', '2025-08-15 19:14:36', NULL),
(4, 'Avances en tecnología de sensores', 'Exploramos cómo los sensores están transformando la industria agrícola.', 'img_68921b61c15f2.jpeg', 'img/thumb_sensores.jpg', 'noticias', 'electronica', '2025-06-16 11:52:35', 1, 0, '2025-06-16 21:52:35', '2025-08-05 15:38:20', NULL),
(5, 'Jornada de capacitación en electrónica', 'Se llevó a cabo una jornada con expertos nacionales en el tema.', NULL, 'img/thumb_jornada.jpg', 'eventos', 'electronica', '2025-06-16 11:52:35', 1, 0, '2025-06-16 21:52:35', '2025-08-05 15:00:48', NULL),
(6, 'Nueva Maquinaria para cacao', 'Se ha adquirido maquinaria moderna para mejorar la producción.', 'img/maquinaria.jpg', 'img/thumb_maquinaria.jpg', 'articulos', 'cafe', '2025-06-16 11:52:35', 1, 0, '2025-06-16 21:52:35', '2025-08-05 14:59:31', NULL),
(7, 'Análisis y Desarrollo de Software', 'La programación es el lenguaje que le da vida a la tecnología. A través de código, creamos soluciones, automatizamos procesos y construimos el futuro digital.', '1750110736_programacion.jpg', NULL, 'noticia', 'electronica', '2025-06-16 16:52:00', 1, 0, '2025-06-17 02:52:16', '2025-07-31 16:45:10', NULL),
(8, 'Cafe', 'cafe', '1752265677_H.png', NULL, 'noticia', 'cafe', '2025-07-11 15:27:00', 1, 0, '2025-07-11 20:27:57', '2025-08-12 19:22:20', NULL),
(9, 'Electronica', 'electronica', '1752505324_Z.jpg', NULL, 'noticia', 'electronica', '2025-07-14 10:02:00', 1, 0, '2025-07-14 15:02:04', '2025-08-15 19:14:12', NULL),
(10, 'Sena', 'asdasdsadasd', '1754508910_logo-sena-verde-png-sin-fondo.png', NULL, 'noticia', 'general', '2025-08-06 14:35:00', 1, 0, '2025-08-06 19:35:10', '2025-08-12 19:22:10', NULL),
(11, 'sdasdas', 'dasdasdsa', '1755189358_ilustracion-de-la-ciudad-del-anime.jpg', NULL, 'evento', 'general', '2025-08-14 11:35:00', 1, 1, '2025-08-14 16:35:58', '2025-08-15 19:14:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requests`
--

CREATE TABLE `requests` (
  `id_re` int(11) NOT NULL,
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
  `destacado_re` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `requests`
--

INSERT INTO `requests` (`id_re`, `nombre`, `empresa`, `cc_cliente`, `email`, `telefono`, `servicio`, `descripcion`, `area`, `fecha_solicitud`, `estado`, `comentario`, `medio_notificacion`, `destacado_re`) VALUES
(54, 'Brayan', 'coperid', '1084652357', 'Sin datos', '3216548795', 'calidad', 'solicitud', 'cafe', '2025-08-26 10:53:57', 'rechazada', 'Su solicitud ha sido rechazada. Gracias por su interés.', 'ninguno', 0),
(55, 'Perdomo', 'cooord', '1084987159', 'perdomogualibrayanandrey@gmail.com', 'Sin datos', 'Diseño de piezas 3D', 'servi', 'electronica', '2025-08-26 10:54:39', 'aceptada', 'Aceptada', 'correo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name_rol` varchar(50) NOT NULL,
  `state_rol` tinyint(1) NOT NULL DEFAULT 1,
  `date_register_rol` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name_rol`, `state_rol`, `date_register_rol`) VALUES
(1, 'admin', 1, '2025-06-18 21:06:58'),
(2, 'editor', 1, '2025-06-18 21:06:58'),
(3, 'Publicador', 1, '2025-07-09 19:57:17'),
(4, 'Usuario limitado', 1, '2025-07-09 19:57:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servi_cafe`
--

CREATE TABLE `servi_cafe` (
  `id_ca` int(11) NOT NULL,
  `titulo_ca` varchar(255) NOT NULL,
  `icono_ca` varchar(255) DEFAULT NULL,
  `des_corta` text NOT NULL,
  `des_larga` text NOT NULL,
  `precio_ca` decimal(10,0) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servi_cafe`
--

INSERT INTO `servi_cafe` (`id_ca`, `titulo_ca`, `icono_ca`, `des_corta`, `des_larga`, `precio_ca`, `date_creation`) VALUES
(22, 'xd', 'icono_689f9a477cdcb4.97701757.jpg', 'xd', 'xd', 10000000, '2025-08-15 20:36:23'),
(23, 'dasdas', 'icono_689f9ad203bff7.91694742.jpg', 'dasdasd', 'asdasdasdasd', 100000, '2025-08-15 20:38:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servi_elect`
--

CREATE TABLE `servi_elect` (
  `id_ele` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `icono_ele` varchar(255) DEFAULT NULL,
  `descripcion_corta` text NOT NULL,
  `descripcion_larga` text NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servi_elect`
--

INSERT INTO `servi_elect` (`id_ele`, `titulo`, `icono_ele`, `descripcion_corta`, `descripcion_larga`, `precio`, `fecha_creacion`) VALUES
(64, 'xd', '1755289702_ilustracion-de-la-ciudad-del-anime.jpg', 'x', 'we', 12000, '2025-08-15 20:23:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table_vers`
--

CREATE TABLE `table_vers` (
  `id_ta` int(11) NOT NULL,
  `name_ta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `table_vers`
--

INSERT INTO `table_vers` (`id_ta`, `name_ta`) VALUES
(19, 'Recprd'),
(21, 'Proceso apoyo ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_acc` varchar(255) NOT NULL,
  `email_acc` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `area` varchar(50) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `email_verification_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password_acc`, `email_acc`, `full_name`, `role_id`, `created_at`, `updated_at`, `area`, `email_verified`, `email_verification_token`) VALUES
(1, 'admin', '$2y$10$tD1m7w8N3b4X5y6Z7a8b9c.d0e1f2g3h4i5j6k7l8m9n0o1p2q3r4s5t6u7v8w9x0', 'admin@sennova.com', 'SENNOVA', 1, '2025-06-12 18:32:20', '2025-07-23 21:09:58', NULL, 1, NULL),
(4, 'Electronica', '$2y$10$QZZbDvdyMnaZAI/tCdKFN.zUTEVaKgn5qie74a3zmsHu/i.ag1Rk6', 'ele@gmail.com', 'Her', 2, '2025-06-18 21:59:32', '2025-08-13 21:08:19', 'visualizador', 1, NULL),
(14, 'Hanna', '$2y$10$6YIm2o17KSaFg4PeGG0Uo.NUKHwegqwmY8KAGvMe1l17tF/EUC.Eu', 'ha@gmail.com', 'Hanna', 1, '2025-06-27 13:39:44', '2025-07-23 21:09:58', NULL, 1, NULL),
(15, 'prueba2', '$2y$10$WFHYvTTJSctMiCGjr.R8QueiE4gmVrmtWx2u5i6j3AFQf8PyLJWLS', 'pru@gmail.com', 'prueba2', 2, '2025-06-27 17:18:58', '2025-07-23 21:09:58', NULL, 1, NULL),
(17, 'Dios Todo Poderoso ', '$2y$10$vhIVFWsAglDh3zqVjw2Gou4TitLqJhltX.l6G6CyNs0R4MHLi9WMq', 'yinko@gmail.com', 'Yinko', 1, '2025-06-27 21:21:36', '2025-07-23 21:09:58', NULL, 1, NULL),
(21, 'Angelica', '$2y$10$DJ3hi5dyiaeBDHexMQaNGuBMRkXpJ0knC/vFsBpdykDW4mAtfAeq.', 'angelicamcastanedav@gmail.com', 'Angelica María Castañeda', 1, '2025-07-08 13:49:41', '2025-08-13 19:28:58', NULL, 1, NULL),
(26, 'cafe', '$2y$10$HFq0tIB5YV9Vy2J/vBaNYOOLNim78w5B8.8aUiARZ9EhSp/G/zzvq', 'cafe@gmail.com', 'cafe', 3, '2025-07-14 16:12:00', '2025-07-23 21:09:58', 'cafe', 1, NULL),
(34, 'electronica', '$2y$10$o63SwNezCc/eUSeXAOhbKuJXMeGQXdN1rb2vkzuJwnMlTEcAg.3.W', 'electronica@gmail.com', 'electronica', 3, '2025-07-14 16:27:06', '2025-07-23 21:09:58', 'electronica', 1, NULL),
(39, 'prueba 2', '$2y$10$RaBWutdogvryMOvg55gDuO1hjMZZnL41kPpgunjNnmSSFyuMl1Zoy', 'prueba@123', 'ante todo la prueba ', 4, '2025-08-06 20:04:24', '2025-08-06 20:04:24', 'visualizador', 0, '6e12d92378eb0bb6b63225f9b1c629cf719c187e90056bdd222b8028000b8353');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `versiones`
--

CREATE TABLE `versiones` (
  `id_vers` int(11) NOT NULL,
  `id_table_vr` int(11) DEFAULT NULL,
  `codigo_vr` varchar(50) DEFAULT NULL,
  `name_archive` varchar(255) DEFAULT NULL,
  `version_vr` varchar(30) DEFAULT NULL,
  `year_vr` year(4) DEFAULT NULL,
  `ruta_archivo_vr` text DEFAULT NULL,
  `estado_vr` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `versiones`
--

INSERT INTO `versiones` (`id_vers`, `id_table_vr`, `codigo_vr`, `name_archive`, `version_vr`, `year_vr`, `ruta_archivo_vr`, `estado_vr`) VALUES
(8, 19, 'dsd', 'INFORME MENSUAL 2025.pdf', 'ssds', '2009', 'public/archivos/INFORME MENSUAL 2025.pdf', 0),
(9, 19, 'dsds', 'INFORME MENSUAL 2025.pdf', 'dsdsdsd', '2025', 'public/archivos/INFORME MENSUAL 2025.pdf', 1),
(11, 21, 'ddasd', 'INFORME MENSUAL 2025.pdf', 'dasdas', '2010', 'public/archivos/INFORME MENSUAL 2025.pdf', 1),
(12, 19, 'DASDAS', 'INFORME MENSUAL 2025.pdf', 'DASDASD', '2008', 'public/archivos/INFORME MENSUAL 2025.pdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_lab`
--

CREATE TABLE `videos_lab` (
  `id_vid` int(11) NOT NULL,
  `title_vid` varchar(255) NOT NULL,
  `ruta_video` varchar(255) NOT NULL,
  `area_vid` enum('electronica','cafe') NOT NULL,
  `date_video` timestamp NOT NULL DEFAULT current_timestamp(),
  `text_pri` text DEFAULT NULL,
  `text_sec` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videos_lab`
--

INSERT INTO `videos_lab` (`id_vid`, `title_vid`, `ruta_video`, `area_vid`, `date_video`, `text_pri`, `text_sec`) VALUES
(3, 'Ciencia con Sabor', 'videos/Lab-Elec.mp4', 'cafe', '2025-07-31 22:20:30', 'Descubre cómo elevamos la calidad del café y cacao a través de prácticas científicas e innovación aplicada.\r\n', 'Nuestro laboratorio combina análisis sensorial, físico-químico y control de calidad para fortalecer la competitividad de los productores regionales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `ip`, `fecha`, `user_agent`, `created_at`) VALUES
(1, '::1', '2025-07-18', NULL, '2025-07-18 20:36:28'),
(2, '::1', '2025-07-19', NULL, '2025-07-18 22:07:55'),
(3, '::1', '2025-07-21', NULL, '2025-07-21 13:23:49'),
(4, '::1', '2025-07-22', NULL, '2025-07-21 22:15:16'),
(5, '::1', '2025-07-23', NULL, '2025-07-23 14:26:43'),
(28, '::1', '2025-07-24', NULL, '2025-07-23 22:13:42'),
(33, '::1', '2025-07-25', NULL, '2025-07-25 19:34:18'),
(34, '::1', '2025-07-26', NULL, '2025-07-25 22:37:57'),
(35, '::1', '2025-07-28', NULL, '2025-07-28 13:23:38'),
(36, '::1', '2025-07-29', NULL, '2025-07-28 22:57:33'),
(39, '::1', '2025-07-30', NULL, '2025-07-29 22:29:26'),
(40, '::1', '2025-07-31', NULL, '2025-07-30 22:02:13'),
(66, '::1', '2025-08-01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-31 22:06:28'),
(122, '127.0.0.1', '2025-08-01', 'node', '2025-08-01 16:07:29'),
(350, '::1', '2025-08-02', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-01 22:21:37'),
(355, '::1', '2025-08-04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-04 14:10:37'),
(363, '::1', '2025-08-05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-05 13:21:04'),
(632, '::1', '2025-08-06', NULL, '2025-08-05 22:21:14'),
(645, '::1', '2025-08-07', NULL, '2025-08-06 22:08:19'),
(646, '::1', '2025-08-08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-08 13:36:19'),
(649, '::1', '2025-08-12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-12 17:03:33'),
(671, '::1', '2025-08-13', NULL, '2025-08-12 22:18:16'),
(674, '::1', '2025-08-14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-13 22:01:05'),
(677, '::1', '2025-08-15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-15 13:20:13'),
(679, '::1', '2025-08-20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 13:37:46'),
(680, '::1', '2025-08-21', NULL, '2025-08-21 13:19:09'),
(682, '::1', '2025-08-22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 13:21:43'),
(685, '::1', '2025-08-25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 13:10:59'),
(686, '::1', '2025-08-26', NULL, '2025-08-26 13:19:25'),
(690, '::1', '2025-08-27', NULL, '2025-08-26 22:17:43'),
(691, '::1', '2025-08-28', NULL, '2025-08-28 17:53:28'),
(692, '::1', '2025-08-29', NULL, '2025-08-29 13:24:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id_archives`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_ar`);

--
-- Indices de la tabla `auditoria_cambios`
--
ALTER TABLE `auditoria_cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD PRIMARY KEY (`id_car`);

--
-- Indices de la tabla `evaluaciones_eva`
--
ALTER TABLE `evaluaciones_eva`
  ADD PRIMARY KEY (`id_eva`);

--
-- Indices de la tabla `eva_resp_eva`
--
ALTER TABLE `eva_resp_eva`
  ADD PRIMARY KEY (`id_er_eva`),
  ADD KEY `evaluacion_id_eva` (`evaluacion_id_eva`);

--
-- Indices de la tabla `gestion_botones`
--
ALTER TABLE `gestion_botones`
  ADD PRIMARY KEY (`id_ges`);

--
-- Indices de la tabla `gestion_subprocesos`
--
ALTER TABLE `gestion_subprocesos`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `id_proceso` (`id_proceso`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_request_id` (`request_id`);

--
-- Indices de la tabla `portadas_lab`
--
ALTER TABLE `portadas_lab`
  ADD PRIMARY KEY (`id_port`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id_re`),
  ADD KEY `idx_requests_cc_cliente` (`cc_cliente`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name_rol`);

--
-- Indices de la tabla `servi_cafe`
--
ALTER TABLE `servi_cafe`
  ADD PRIMARY KEY (`id_ca`);

--
-- Indices de la tabla `servi_elect`
--
ALTER TABLE `servi_elect`
  ADD PRIMARY KEY (`id_ele`);

--
-- Indices de la tabla `table_vers`
--
ALTER TABLE `table_vers`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email_acc`);

--
-- Indices de la tabla `versiones`
--
ALTER TABLE `versiones`
  ADD PRIMARY KEY (`id_vers`),
  ADD KEY `id_table_vr` (`id_table_vr`);

--
-- Indices de la tabla `videos_lab`
--
ALTER TABLE `videos_lab`
  ADD PRIMARY KEY (`id_vid`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_fecha` (`ip`,`fecha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archives`
--
ALTER TABLE `archives`
  MODIFY `id_archives` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_ar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `auditoria_cambios`
--
ALTER TABLE `auditoria_cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `evaluaciones_eva`
--
ALTER TABLE `evaluaciones_eva`
  MODIFY `id_eva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `eva_resp_eva`
--
ALTER TABLE `eva_resp_eva`
  MODIFY `id_er_eva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=697;

--
-- AUTO_INCREMENT de la tabla `gestion_botones`
--
ALTER TABLE `gestion_botones`
  MODIFY `id_ges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `gestion_subprocesos`
--
ALTER TABLE `gestion_subprocesos`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `portadas_lab`
--
ALTER TABLE `portadas_lab`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `requests`
--
ALTER TABLE `requests`
  MODIFY `id_re` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servi_cafe`
--
ALTER TABLE `servi_cafe`
  MODIFY `id_ca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `servi_elect`
--
ALTER TABLE `servi_elect`
  MODIFY `id_ele` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `table_vers`
--
ALTER TABLE `table_vers`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `versiones`
--
ALTER TABLE `versiones`
  MODIFY `id_vers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `videos_lab`
--
ALTER TABLE `videos_lab`
  MODIFY `id_vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `eva_resp_eva`
--
ALTER TABLE `eva_resp_eva`
  ADD CONSTRAINT `fk_eva_resp_evaluacion_eva` FOREIGN KEY (`evaluacion_id_eva`) REFERENCES `evaluaciones_eva` (`id_eva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gestion_subprocesos`
--
ALTER TABLE `gestion_subprocesos`
  ADD CONSTRAINT `gestion_subprocesos_ibfk_1` FOREIGN KEY (`id_proceso`) REFERENCES `gestion_botones` (`id_ges`);

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_request_id` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id_re`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `versiones`
--
ALTER TABLE `versiones`
  ADD CONSTRAINT `versiones_ibfk_1` FOREIGN KEY (`id_table_vr`) REFERENCES `table_vers` (`id_ta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
