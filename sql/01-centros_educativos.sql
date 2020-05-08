-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 05:33 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `centros_educativos`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `DNI` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `id_centro` int(11) UNSIGNED NOT NULL,
  `id_clase` int(11) UNSIGNED NOT NULL,
  `observaciones_medicas` varchar(200) DEFAULT NULL,
  `id_tutor_legal` int(10) UNSIGNED DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_calificaciones` int(11) UNSIGNED NOT NULL,
  `foto` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`DNI`, `nombre`, `apellido1`, `apellido2`, `id_centro`, `id_clase`, `observaciones_medicas`, `id_tutor_legal`, `fecha_nacimiento`, `id_calificaciones`, `foto`) VALUES
('00822109C', 'Rosmira', 'Frías', 'Carvajal', 41000405, 7, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2004-05-20', 11, 'img\\users\\alumnos\\rosmira.jpg'),
('01864521A', 'Alumine', 'Nieves', 'Salcedo', 50000151, 14, NULL, NULL, '2006-03-14', 15, 'img\\users\\alumnos\\alumine.jpg'),
('13586449G', 'Memmon', 'Crespo', 'Nieto', 8039598, 18, NULL, NULL, '2006-03-04', 13, 'img\\users\\alumnos\\memmon.jpg'),
('13902147G', 'Inmaculada', 'Campos', 'Alcalá', 8039598, 19, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2006-05-01', 17, 'img\\users\\alumnos\\inmaculada.jpg'),
('15700350K', 'Alanis', 'Ibarra', 'Padrón', 28047551, 17, NULL, 2, '2003-07-05', 12, 'img\\users\\alumnos\\alanis.jpg'),
('16352963D', 'Solano', 'Rocha', 'Cedillo', 50000151, 14, NULL, 3, '2006-11-22', 15, 'img\\users\\alumnos\\solano.jpg'),
('16512408H', 'Sebasten', 'Armendáriz', 'Maldonado', 41000405, 13, ' Anafilaxia', NULL, '2004-11-19', 18, 'img\\users\\alumnos\\sebasten.jpg'),
('16627162W', 'Rayen', 'Sánchez', 'Marín', 28047551, 17, 'Presenta reacciones alérgicas a los frutos secos.', 4, '2003-11-11', 12, 'img\\users\\alumnos\\rayen.jpg'),
('20171515D', 'Meinard', 'Mesa', 'Ulloa', 28047551, 17, NULL, NULL, '2003-06-12', 12, 'img\\users\\alumnos\\meinard.jpg'),
('21503333N', 'Zohar', 'Núñez', 'Ozuna', 8039598, 19, NULL, 5, '2005-12-13', 17, 'img\\users\\alumnos\\zohar.jpg'),
('25952332Y', 'Laodicea', 'Cabán', 'Roque', 50000151, 15, NULL, NULL, '2002-08-09', 20, 'img\\users\\alumnos\\laodicea.jpg'),
('25988953B', 'Munir', 'Árias', 'Regalado', 50000151, 16, NULL, 6, '2006-07-10', 19, 'img\\users\\alumnos\\munir.jpg'),
('27036756A', 'Abram', 'Archuleta', 'Vanegas', 41000405, 8, NULL, NULL, '2005-08-09', 16, 'img\\users\\alumnos\\abram.jpg'),
('31123104X', 'Aracely', 'Angulo', 'Rael', 8039598, 19, NULL, NULL, '2006-01-02', 17, 'img\\users\\alumnos\\aracely.jpg'),
('31631695W', 'Xaviera', 'Amaya', 'Hernández', 28070913, 12, '', 7, '2002-05-20', 14, 'img\\users\\alumnos\\xaviera.jpg'),
('37071162S', 'Neus', 'Benavides', 'Bustos', 41000405, 8, NULL, 10, '2005-05-17', 16, 'img\\users\\alumnos\\neus.jpg'),
('38067105N', 'Atanasio', 'Medrano', 'Villareal', 50000151, 16, NULL, NULL, '2006-10-20', 19, 'img\\users\\alumnos\\atanasio.jpg'),
('38946295G', 'Antígona', 'Rosas', 'Vázquez', 28070913, 12, NULL, NULL, '2002-11-19', 14, 'img\\users\\alumnos\\antigona.jpg'),
('42893072G', 'Nicholai', 'Rivero', 'Fernández', 28070913, 12, 'Presenta reacciones alérgicas a los anacardos y almendras', NULL, '2002-03-04', 14, 'img\\users\\alumnos\\nicholai.jpg'),
('43018009M', 'Horaz', 'Otero', 'Espinosa', 50000151, 16, NULL, 8, '2006-04-17', 19, 'img\\users\\alumnos\\horaz.jpg'),
('43874001Y', 'Otilio', 'Jimínez', 'Mejía', 8039598, 19, NULL, NULL, '2005-09-08', 17, 'img\\users\\alumnos\\otilio.jpg'),
('44138671S', 'Pío', 'Colunga', 'Bernal', 50000151, 16, NULL, NULL, '2006-06-10', 19, 'img\\users\\alumnos\\pio.jpg'),
('45730731S', 'Laviana', 'Leyva', 'Guerrero', 41000405, 8, NULL, 9, '2005-09-17', 16, 'img\\users\\alumnos\\laviana.jpg'),
('51195336G', 'Morfeo', 'Calvillo', 'Padilla', 41000405, 8, NULL, NULL, '2005-07-19', 16, 'img\\users\\alumnos\\morfeo.jpg'),
('52983179B', 'Orestes', 'Chapa', 'Badillo', 50000151, 16, NULL, NULL, '2007-04-20', 19, 'img\\users\\alumnos\\orestes.jpg'),
('53389278E', 'Dara', 'Tamayo', 'Aguirre', 41000405, 13, ' Síndrome de alargia oral.', NULL, '2004-03-04', 18, 'img\\users\\alumnos\\dara.jpg'),
('61063539B', 'Antonella', 'Cisneros', 'Mares', 41000405, 8, NULL, NULL, '2005-04-04', 16, 'img\\users\\alumnos\\antonella.jpg'),
('64609317V', 'Carmen', 'Mercado', 'Canales', 50000151, 15, NULL, NULL, '2003-01-31', 20, 'img\\users\\alumnos\\carmen.jpg'),
('65619270V', 'Lucas', 'Benavidez', 'Madrid', 50000151, 14, NULL, NULL, '2006-03-07', 15, 'img\\users\\alumnos\\lucas.jpg'),
('77595539W', 'Tara', 'Cristobal', 'Fernández', 50000151, 14, NULL, 1, '2006-11-19', 15, 'img\\users\\alumnos\\tara.jpg'),
('78678320N', 'Oscar', 'Cristobal', 'Fernández', 41000405, 7, 'Presenta reacciones alérgicas a los frutos secos.', 1, '2004-03-04', 11, 'img\\users\\alumnos\\oscar.jpg'),
('82413678D', 'Olalla', 'Porras', 'Rolón', 50000151, 15, NULL, 11, '2004-12-13', 20, 'img\\users\\alumnos\\olalla.jpg'),
('86512991D', 'Privato', 'Corral', 'Rojas', 41000405, 7, NULL, NULL, '2004-11-19', 11, 'img\\users\\alumnos\\privato.jpg'),
('88962348G', 'Candela', 'Quiñones', 'Aguilera', 50000151, 15, NULL, NULL, '2004-08-20', 20, 'img\\users\\alumnos\\candela.jpg'),
('92125571Z', 'Adamo', 'Zepeda', 'Altamirano', 8039598, 18, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2006-05-20', 13, 'img\\users\\alumnos\\adamo.jpg'),
('94374398Q', 'Romanela', 'Alarcón', 'Villaseñor', 50000151, 14, NULL, 12, '2006-08-26', 15, 'img\\users\\alumnos\\romanela.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_profesor` int(11) UNSIGNED NOT NULL,
  `nombre_asignatura` varchar(20) NOT NULL,
  `lunes_inicio` time DEFAULT NULL,
  `lunes_fin` time DEFAULT NULL,
  `martes_inicio` time DEFAULT NULL,
  `martes_fin` time DEFAULT NULL,
  `miercoles_inicio` time DEFAULT NULL,
  `miercoles_fin` time DEFAULT NULL,
  `jueves_inicio` time DEFAULT NULL,
  `jueves_fin` time DEFAULT NULL,
  `viernes_inicio` time DEFAULT NULL,
  `viernes_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `id_profesor`, `nombre_asignatura`, `lunes_inicio`, `lunes_fin`, `martes_inicio`, `martes_fin`, `miercoles_inicio`, `miercoles_fin`, `jueves_inicio`, `jueves_fin`, `viernes_inicio`, `viernes_fin`) VALUES
(1, 1, 'Matemáticas', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', '13:00:00', '14:00:00'),
(2, 1, 'Física', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00'),
(3, 8, 'Lengua', '11:00:00', '13:00:00', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL),
(4, 22, 'Historia', '14:00:00', '15:00:00', NULL, NULL, NULL, NULL, '09:00:00', '11:00:00', NULL, NULL),
(5, 22, 'Educación Física', NULL, NULL, '14:00:00', '15:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL),
(6, 23, 'Inglés', NULL, NULL, '11:00:00', '13:00:00', '09:00:00', '11:00:00', NULL, NULL, '11:00:00', '13:00:00'),
(7, 6, 'Inglés', '15:00:00', '16:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL, '13:00:00', '14:00:00'),
(8, 6, 'Educación Física', '09:00:00', '11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '15:00:00', '16:00:00'),
(9, 25, 'Física', '11:00:00', '13:00:00', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL),
(10, 25, 'Matemáticas', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00', '11:00:00', '13:00:00'),
(11, 24, 'Lengua', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00'),
(12, 24, 'Historia', NULL, NULL, '09:00:00', '11:00:00', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL),
(13, 2, 'Inglés', '11:00:00', '13:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '11:00:00', '13:00:00'),
(14, 20, 'Lengua', '09:00:00', '11:00:00', NULL, NULL, '13:00:00', '14:00:00', '09:00:00', '11:00:00', NULL, NULL),
(15, 9, 'Matemáticas', '13:00:00', '14:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, '13:00:00', '14:00:00'),
(16, 16, 'Física', '14:00:00', '15:00:00', '11:00:00', '13:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL),
(17, 17, 'Educación Física', NULL, NULL, '14:00:00', '15:00:00', '09:00:00', '11:00:00', NULL, NULL, NULL, NULL),
(18, 21, 'Historia', NULL, NULL, '09:00:00', '11:00:00', '14:00:00', '15:00:00', '11:00:00', '13:00:00', '09:00:00', '11:00:00'),
(19, 26, 'Matemáticas', '11:00:00', '12:00:00', '09:00:00', '10:00:00', '12:00:00', '13:00:00', '10:00:00', '11:00:00', '10:00:00', '11:00:00'),
(20, 26, 'Física', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, NULL, '13:00:00', '14:00:00', '11:00:00', '12:00:00'),
(21, 27, 'Lengua', '09:00:00', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, '12:00:00', '13:00:00', '09:00:00', '10:00:00'),
(22, 27, 'Historia', '13:00:00', '14:00:00', '13:00:00', '14:00:00', '10:00:00', '11:00:00', NULL, NULL, NULL, NULL),
(23, 3, 'Inglés', '12:00:00', '13:00:00', '10:00:00', '11:00:00', '11:00:00', '12:00:00', '11:00:00', '12:00:00', NULL, NULL),
(24, 3, 'Educación Física', NULL, NULL, NULL, NULL, '09:00:00', '10:00:00', '09:00:00', '10:00:00', '12:00:00', '13:00:00'),
(25, 28, 'Lengua', NULL, NULL, '12:00:00', '13:00:00', '11:00:00', '12:00:00', NULL, NULL, '11:00:00', '12:00:00'),
(26, 28, 'Historia', '09:00:00', '10:00:00', '09:00:00', '10:00:00', NULL, NULL, '12:00:00', '13:00:00', '10:00:00', '11:00:00'),
(27, 29, 'Educación Física', '13:00:00', '14:00:00', NULL, NULL, '12:00:00', '13:00:00', NULL, NULL, '09:00:00', '10:00:00'),
(28, 30, 'Inglés', '12:00:00', '13:00:00', '10:00:00', '11:00:00', NULL, NULL, '09:00:00', '10:00:00', '12:00:00', '13:00:00'),
(29, 4, 'Matemáticas', '10:00:00', '11:00:00', '11:00:00', '12:00:00', '10:00:00', '11:00:00', '11:00:00', '12:00:00', NULL, NULL),
(30, 4, 'Física', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '09:00:00', '10:00:00', '10:00:00', '11:00:00', NULL, NULL),
(31, 8, 'Lengua', NULL, NULL, '12:00:00', '13:00:00', '11:00:00', '12:00:00', NULL, NULL, '11:00:00', '12:00:00'),
(32, 22, 'Historia', '09:00:00', '10:00:00', '09:00:00', '10:00:00', NULL, NULL, '12:00:00', '13:00:00', '10:00:00', '11:00:00'),
(33, 22, 'Educación Física', '13:00:00', '14:00:00', NULL, NULL, '12:00:00', '13:00:00', NULL, NULL, '09:00:00', '10:00:00'),
(34, 23, 'Inglés', '12:00:00', '13:00:00', '10:00:00', '11:00:00', NULL, NULL, '09:00:00', '10:00:00', '12:00:00', '13:00:00'),
(35, 1, 'Matemáticas', '10:00:00', '11:00:00', '11:00:00', '12:00:00', '10:00:00', '11:00:00', '11:00:00', '12:00:00', NULL, NULL),
(36, 1, 'Física', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '09:00:00', '10:00:00', '10:00:00', '11:00:00', NULL, NULL),
(37, 9, 'Matemáticas', '11:00:00', '12:00:00', '09:00:00', '10:00:00', '12:00:00', '13:00:00', '10:00:00', '11:00:00', '10:00:00', '11:00:00'),
(38, 16, 'Física', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, NULL, '13:00:00', '14:00:00', '11:00:00', '12:00:00'),
(39, 20, 'Lengua', '09:00:00', '10:00:00', '11:00:00', '12:00:00', NULL, NULL, '12:00:00', '13:00:00', '09:00:00', '10:00:00'),
(40, 21, 'Historia', '13:00:00', '14:00:00', '13:00:00', '14:00:00', '10:00:00', '11:00:00', NULL, NULL, NULL, NULL),
(41, 2, 'Inglés', '12:00:00', '13:00:00', '10:00:00', '11:00:00', '11:00:00', '12:00:00', '11:00:00', '12:00:00', NULL, NULL),
(42, 17, 'Educación Física', NULL, NULL, NULL, NULL, '09:00:00', '10:00:00', '09:00:00', '10:00:00', '12:00:00', '13:00:00'),
(43, 23, 'Inglés', '15:00:00', '16:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL, '13:00:00', '14:00:00'),
(44, 22, 'Educación Física', '09:00:00', '11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '15:00:00', '16:00:00'),
(45, 1, 'Física', '11:00:00', '13:00:00', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL),
(46, 1, 'Matemáticas', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00', '11:00:00', '13:00:00'),
(47, 8, 'Lengua', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00'),
(48, 22, 'Historia', NULL, NULL, '09:00:00', '11:00:00', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL),
(49, 30, 'Inglés', '11:00:00', '13:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '11:00:00', '13:00:00'),
(50, 28, 'Lengua', '09:00:00', '11:00:00', NULL, NULL, '13:00:00', '14:00:00', '09:00:00', '11:00:00', NULL, NULL),
(51, 4, 'Matemáticas', '13:00:00', '14:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL, '13:00:00', '14:00:00'),
(52, 4, 'Física', '14:00:00', '15:00:00', '11:00:00', '13:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL),
(53, 29, 'Educación Física', NULL, NULL, '14:00:00', '15:00:00', '09:00:00', '11:00:00', NULL, NULL, NULL, NULL),
(54, 28, 'Historia', NULL, NULL, '09:00:00', '11:00:00', '14:00:00', '15:00:00', '11:00:00', '13:00:00', '09:00:00', '11:00:00'),
(55, 4, 'Matemáticas', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', '13:00:00', '14:00:00'),
(56, 4, 'Física', '13:00:00', '14:00:00', NULL, NULL, '11:00:00', '13:00:00', NULL, NULL, '09:00:00', '11:00:00'),
(57, 28, 'Lengua', '11:00:00', '13:00:00', '09:00:00', '11:00:00', '13:00:00', '14:00:00', NULL, NULL, NULL, NULL),
(58, 28, 'Historia', '14:00:00', '15:00:00', NULL, NULL, NULL, NULL, '09:00:00', '11:00:00', NULL, NULL),
(59, 29, 'Educación Física', NULL, NULL, '14:00:00', '15:00:00', NULL, NULL, '13:00:00', '14:00:00', NULL, NULL),
(60, 30, 'Inglés', NULL, NULL, '11:00:00', '13:00:00', '09:00:00', '11:00:00', NULL, NULL, '11:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_asignatura1` int(11) UNSIGNED NOT NULL,
  `nota1` double UNSIGNED DEFAULT NULL,
  `id_asignatura2` int(11) UNSIGNED NOT NULL,
  `nota2` double UNSIGNED DEFAULT NULL,
  `id_asignatura3` int(11) UNSIGNED NOT NULL,
  `nota3` double UNSIGNED DEFAULT NULL,
  `id_asignatura4` int(11) UNSIGNED NOT NULL,
  `nota4` double UNSIGNED DEFAULT NULL,
  `id_asignatura5` int(11) UNSIGNED NOT NULL,
  `nota5` double UNSIGNED DEFAULT NULL,
  `id_asignatura6` int(11) UNSIGNED NOT NULL,
  `nota6` double UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `id_asignatura1`, `nota1`, `id_asignatura2`, `nota2`, `id_asignatura3`, `nota3`, `id_asignatura4`, `nota4`, `id_asignatura5`, `nota5`, `id_asignatura6`, `nota6`) VALUES
(11, 1, NULL, 2, NULL, 3, NULL, 4, NULL, 5, NULL, 6, NULL),
(12, 7, NULL, 8, NULL, 9, NULL, 10, NULL, 11, NULL, 12, NULL),
(13, 13, NULL, 14, NULL, 15, NULL, 16, NULL, 17, NULL, 18, NULL),
(14, 19, NULL, 20, NULL, 21, NULL, 22, NULL, 23, NULL, 24, NULL),
(15, 25, NULL, 26, NULL, 27, NULL, 28, NULL, 29, NULL, 30, NULL),
(16, 31, NULL, 32, NULL, 33, NULL, 34, NULL, 35, NULL, 36, NULL),
(17, 37, NULL, 38, NULL, 39, NULL, 40, NULL, 41, NULL, 42, NULL),
(18, 43, NULL, 44, NULL, 45, NULL, 46, NULL, 47, NULL, 48, NULL),
(19, 49, NULL, 50, NULL, 51, NULL, 52, NULL, 53, NULL, 54, NULL),
(20, 55, NULL, 56, NULL, 57, NULL, 58, NULL, 59, NULL, 60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `centros`
--

CREATE TABLE `centros` (
  `id` int(8) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `provincia` varchar(40) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `centros`
--

INSERT INTO `centros` (`id`, `nombre`, `provincia`, `direccion`, `telefono`, `email`) VALUES
(8039598, 'Escola Sant Miquel del Cros', 'Barcelona', 'Av. del Mediterrani, 08310', '937993951', 'a8039598@xtec.cat'),
(28047551, 'CEIP Agua Dulce', 'Madrid', 'Calle De Leñeros 25, 28039', '914594049', 'eei.aguadulce.madrid@educa.madrid.org'),
(28070913, 'Colegio Amanecer', 'Madrid', 'Calle Del Titanio 7, 28032', '917765069', 'eei.amanecer.madrid@educa.madrid.org'),
(41000405, 'IES Miguel de Cervantes', 'Sevilla', 'Virgen del Consuelo 26, 41449', '955649736', '41000405.edu@juntadeandalucia.es'),
(50000151, 'Nuestra Señora del Castillo', 'Zaragoza', 'Avenida de la Portalada 39, 50630', '976610290', 'nscastillo@nscastillo.com');

-- --------------------------------------------------------

--
-- Table structure for table `clases`
--

CREATE TABLE `clases` (
  `id` int(4) UNSIGNED NOT NULL,
  `curso` int(1) UNSIGNED NOT NULL,
  `letra` varchar(1) NOT NULL,
  `titulación` varchar(20) NOT NULL,
  `id_tutor_clase` int(11) UNSIGNED NOT NULL,
  `numero_alumnos` int(2) UNSIGNED NOT NULL,
  `id_asignatura1` int(11) UNSIGNED NOT NULL,
  `id_asignatura2` int(11) UNSIGNED NOT NULL,
  `id_asignatura3` int(11) UNSIGNED NOT NULL,
  `id_asignatura4` int(11) UNSIGNED NOT NULL,
  `id_asignatura5` int(11) UNSIGNED NOT NULL,
  `id_asignatura6` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clases`
--

INSERT INTO `clases` (`id`, `curso`, `letra`, `titulación`, `id_tutor_clase`, `numero_alumnos`, `id_asignatura1`, `id_asignatura2`, `id_asignatura3`, `id_asignatura4`, `id_asignatura5`, `id_asignatura6`) VALUES
(7, 3, 'A', 'ESO', 8, 3, 1, 2, 3, 4, 5, 6),
(8, 3, 'B', 'ESO', 1, 5, 31, 32, 33, 34, 35, 36),
(12, 1, 'C', 'BACHILLERATO', 26, 3, 19, 20, 21, 22, 23, 24),
(13, 4, 'C', 'ESO', 22, 2, 43, 44, 45, 46, 47, 48),
(14, 2, 'A', 'ESO', 4, 5, 25, 26, 27, 28, 29, 30),
(15, 1, 'B', 'ESO', 28, 4, 49, 50, 51, 52, 53, 54),
(16, 1, 'C', 'ESO', 29, 5, 55, 56, 57, 58, 59, 60),
(17, 2, 'B', 'BACHILLERATO', 24, 3, 7, 8, 9, 10, 11, 12),
(18, 1, 'D', 'ESO', 9, 2, 13, 14, 15, 16, 17, 18),
(19, 1, 'D', 'BACHILLERATO', 21, 4, 37, 38, 39, 40, 41, 42);

-- --------------------------------------------------------

--
-- Table structure for table `codigos_de_acceso`
--

CREATE TABLE `codigos_de_acceso` (
  `codigo` varchar(20) NOT NULL,
  `id_centro` int(11) UNSIGNED NOT NULL,
  `id_alumnos` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codigos_de_acceso`
--

INSERT INTO `codigos_de_acceso` (`codigo`, `id_centro`, `id_alumnos`) VALUES
('6D9MSNV56UPL44J3CDPP', 41000405, '00822109C'),
('LFVZLZR2D8SURTUQU9FG', 50000151, '01864521A'),
('4FT3XAKQJ5FRFU7NGQ2D', 8039598, '13586449G'),
('3M43LCY2ZFHPXUZ6JT69', 8039598, '13902147G'),
('9U9R6L6MKA7HLWWJD86M', 28047551, '15700350K'),
('8NJAT4SKQGGP9S6VNKTJ', 50000151, '16352963D'),
('WMC9JPV2GYBDYK6Y28KX', 41000405, '16512408H'),
('ZSRP58FANGALRUNXCYNF', 28047551, '16627162W'),
('853GG8ATJ656RND8LNMJ', 28047551, '20171515D'),
('WCKZ3DHWPFTZ8TB946RC', 8039598, '21503333N'),
('A8QPJ2WGFWG3KUMAULQ9', 50000151, '25952332Y'),
('C7BGQV77FMRZG75SMCCF', 50000151, '25988953B'),
('4EWWTCYLPF8337Q5S37G', 41000405, '27036756A'),
('NHF28KQTE8ZHWUEHTNZ9', 8039598, '31123104X'),
('4DVUE8AWWBZTCPRYDD7D', 28070913, '31631695W'),
('84SJQQKX95WTA7NZKG9X', 41000405, '37071162S'),
('8K8CJFN8LFS7H22JD75M', 50000151, '38067105N'),
('GMGTMNAM4R2GXX5HP5NT', 28070913, '38946295G'),
('366ZMTZJT99QCSC9P3A5', 28070913, '42893072G'),
('PZEARP8PV54RL3977QMK', 50000151, '43018009M'),
('JSP7DVH7NG89WN2GAR4C', 8039598, '43874001Y'),
('VAZDRZHQ8QSZLKZG3CUF', 50000151, '44138671S'),
('NQVDK7RW7AK3N8RV6FME', 41000405, '45730731S'),
('DGTWUYS8WRYAGKL3M6GQ', 41000405, '51195336G'),
('FATX7ZJZ7GTJQNKPE9TR', 50000151, '52983179B'),
('PWBSKTC5U55JKP5CSSM8', 41000405, '53389278E'),
('VXVRFNLXQTVB5SKS7M24', 41000405, '61063539B'),
('9V7DG4P3C37JL4F4NYM2', 50000151, '64609317V'),
('8EWZMV9HGR5EYP9Q3GG7', 50000151, '65619270V'),
('4ZQ68MSUTDUZF5ZVVCWB', 50000151, '77595539W'),
('V8MX4KWK4B4DYWSE57NH', 41000405, '78678320N'),
('ZMA2QFF7FLQX9K5L7XVU', 50000151, '82413678D'),
('Y4HPRK7EHCCN3VSP2VAE', 41000405, '86512991D'),
('8LPSHRJXAGC4GE7839UC', 50000151, '88962348G'),
('VU6GZ4YXC2DB26MQUSB6', 8039598, '92125571Z'),
('XRF44PPJMFJ954GFM4FK', 50000151, '94374398Q');

-- --------------------------------------------------------

--
-- Table structure for table `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_asignatura` int(11) UNSIGNED NOT NULL,
  `id_alumno` varchar(9) NOT NULL,
  `msg_incidencia` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mensajería`
--

CREATE TABLE `mensajería` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_origen` int(11) UNSIGNED NOT NULL,
  `rol_origen` varchar(20) NOT NULL,
  `id_destinatario` int(11) UNSIGNED NOT NULL,
  `rol_destinatario` varchar(20) NOT NULL,
  `contenido_msg` varchar(300) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `etiqueta` varchar(20) NOT NULL,
  `archivo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_centro` int(8) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `despacho` int(4) UNSIGNED DEFAULT NULL,
  `correo` varchar(40) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `contraseña` varchar(80) NOT NULL,
  `foto` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesores`
--

INSERT INTO `profesores` (`id`, `id_centro`, `nombre`, `apellido1`, `apellido2`, `despacho`, `correo`, `usuario`, `contraseña`, `foto`) VALUES
(1, 41000405, 'Javier', 'Sanz', 'Garrido', 23, 'jsanzgarrido@iesmiguelcerv.es', 'javisgarr', '$2y$10$b1qEUUyb1E5fZuuac0g.8O9KvlTlCd8FU/JtOJS7OhvMStlri2GN.', 'img\\users\\profesores\\javier.jpg'),
(2, 8039598, 'Katherine', 'Thompson', NULL, 14, 'KatherineRThompson@gustr.com', 'kathethom', '$2y$10$OKcpMEgTw3lBVvRYBnXbFedeVmHF95bx3pQSQjOOLmwd9/SDaI3T6', 'img\\users\\profesores\\katherine.jpg'),
(3, 28070913, 'Georgia', 'Potter', NULL, NULL, 'GeorgiaPotter@gmail.com', 'GPotter', '$2y$10$ZCFB8WyTNgQsvJAvqrPrEezL4xY3WAFkgy5nzZrTTMHg4P3wyubJq', 'img\\users\\profesores\\georgia.jpg'),
(4, 50000151, 'Beltran', 'Serrano', 'Tafoya', 7, 'BeltranSerranoTafoya@gustr.com', 'Belserra', '$2y$10$WTHIUBFy34dVsJKnj7SrXuPCVuHcuA5EGmMlT0OHvbAcw2/URpPxm', 'img\\users\\profesores\\beltran.jpg'),
(6, 28047551, 'Naiara', 'Cervántez', 'Muñoz', 20, 'NaiaraCervantezMunoz@gustr.com', 'naiara44', '$2y$10$F1kpRw5h6mM7aUheCq87KOqrc4C4q0uDrVxOrVRAVJrXh4PZeayNi', 'img\\users\\profesores\\naiara.jpg'),
(8, 41000405, 'Garcilaso', 'Oquendo', 'García', 3, 'GarcilasoOquendoGarcia@gustr.com', 'GarcilasoOG', '$2y$10$TZwHKzlN3FitjeX8xXvTYOTE3dzGrVW.sFIDz2qXneK11sVfPJjTO', 'img\\users\\profesores\\garcilaso.jpg'),
(9, 8039598, 'Juan Carlos', 'Barreto', 'Hernández', 65, 'JuanCarlosBarretoHernandez@gmail.com', 'JCarlosBH', '$2y$10$bnzQ0ZZB5rMrEuiMqVkdQuigARVO6aowjytyn/n9a9yt6/sYdWQzG', 'img\\users\\profesores\\juancarlos.jpg'),
(16, 8039598, 'Margarita', 'Vega', 'Téllez', 2, 'MargaritaVegaTellez@gmail.com', 'margaVT', '$2y$10$v2Wfk2Igi5JCEltGEsmYGOmKKBvgVyzZNQTBP6teSy5aMDjLHizqq', 'img\\users\\profesores\\margarita.jpg'),
(17, 8039598, 'Marta', 'Pedroza', 'Rosario', 5, 'MartaPedrozaRosario@gustr.com', 'martaProsa', '$2y$10$hxvL.pzyVij3eClRokdEDuX./gDDkubzEp0aW4U0gqzFReknVeixK', 'img\\users\\profesores\\marta.jpg'),
(20, 8039598, 'Adena', 'Pineda', 'Montero', 54, 'AdenaPinedaMontero@gmail.com', 'adenapine', '$2y$10$BPrs3rrhXVlLlgzzgpwWoucQOEcCyWAwxmJDeMWN3R0/Ts87lH8GC', 'img\\users\\profesores\\adena.jpg'),
(21, 8039598, 'Casiano', 'Trejo', 'Lozano', 34, 'CasianoTrejoLozano@gustr.com', 'casianotrejo', '$2y$10$/bpbB9Rqf3IpA.mJFsJdPelHIYplrMMSNOon/Pj4/sp3uyvJF9.8a', 'img\\users\\profesores\\casiano.jpg'),
(22, 41000405, 'Bruna', 'Guillén', 'Merino', 17, 'BrunaGuillenMerino@gustr.com', 'brunaguime', '$2y$10$a0WGfbomM5a8TYeseC1oluRIidfI5byx0ixhuKvaYpxYi.prpjrb.', 'img\\users\\profesores\\bruna.jpg'),
(23, 41000405, 'Hannah', 'Thompson', NULL, NULL, 'HannahThomp@gustr.com', 'hannahThomp', '$2y$10$ZM7R5vICNW40X82tUpCC0eR.Q0QkD69XYaWe9.27OhJG2.uHIHOJS', 'img\\users\\profesores\\hannah.jpg'),
(24, 28047551, 'Jose', 'Crespo', 'Aponte', 27, 'CrespoAponte@gmail.com', 'Jcrespo', '$2y$10$Rz7wHt4liyyGYxjz9iKc7u/.nNZDnVv5PIhBr7Wx4Jw56AB5unuo6', 'img\\users\\profesores\\josecrespo.jpg'),
(25, 28047551, 'Jose', 'Verdugo', 'Correa', 31, 'IberoVerdugoCorrea@gustr.com', 'Jvercorrea', '$2y$10$RxEzFnTtglCCApqaVnuxaOty9ztP1klpHOMv41XK.Fo7IhsZeZvMm', 'img\\users\\profesores\\joseverdugo.jpg'),
(26, 28070913, 'Balbino', 'Verdugo', 'Castro', 24, 'BalbinoVerdugoCastro@gmail.com', 'Balvercast', '$2y$10$1xHL2gm9BqoCPqSkhHAZLeJpK3K2.5MlUfZCHiD4Guc9WyGkCjItO', 'img\\users\\profesores\\balbino.jpg'),
(27, 28070913, 'Cleodora', 'Carvajal', 'Curiel', 42, 'CleodoraCarvajalCuriel@gmail.com', 'cleocarcu', '$2y$10$Va3ZUyMa06GQHUHIDL00SOC9qUbdDk.rRrUAXydHld2xyNfL9ynDa', 'img\\users\\profesores\\cleodora.jpg'),
(28, 50000151, 'Juliano', 'Vargas', 'Rosas', 37, 'JulianoVargasRosas@gmail.com', 'julivargas', '$2y$10$T9PFojNJ0UmwwQmKjLfLYeU8zurHpP.gY8cf1dn4L4NVVp1ALm57y', 'img\\users\\profesores\\juliano.jpg'),
(29, 50000151, 'Lioba', 'Solórzano', 'Muñoz', 45, 'LiobaSolorzanoCintron@gustr.com', 'liobamuñoz', '$2y$10$gTDVUN08ajprdYLxUx3zkOIZnA/COwp7kg34mOQSoUTf3oe48tyt2', 'img\\users\\profesores\\lioba.jpg'),
(30, 50000151, 'Ethel', 'Llarnas', 'Sanabria', NULL, 'EthelLlarnasSanabria@gmail.com', 'Ethelsana', '$2y$10$adaX9vKkvvBXKoTn6OYu4.DKdAT0uXwIz2krK04eQPit4B3s6M9FG', 'img\\users\\profesores\\ethel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_legal`
--

CREATE TABLE `tutor_legal` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `telefono_movil` varchar(15) NOT NULL,
  `telefono_fijo` varchar(15) DEFAULT NULL,
  `correo` varchar(40) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `contraseña` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutor_legal`
--

INSERT INTO `tutor_legal` (`id`, `nombre`, `apellido1`, `apellido2`, `telefono_movil`, `telefono_fijo`, `correo`, `usuario`, `contraseña`) VALUES
(1, 'Francisco', 'Cristobal', 'Casárez', '643 492 101', NULL, 'FCristoCasarez@gustr.com', 'Fcriscas', '$2y$10$oJCfNmuc3Dp1SVDA64LJ3.J/WeWaMGRgwwiXyJ.Jgz0Oq3wkZCos.'),
(2, 'Bautista', 'Ibarra', 'Chacón', '686 127 193', NULL, 'BautistaChacon@gustr.com', 'bautistaIC', '$2y$10$PC6bzA6YZQxTBtPk/riqaeMmySKjAzz/hYDesHQXdwrtcc8D1PD7S'),
(3, 'Elenio ', 'Rocha', 'Valverde', '684 704 947', NULL, 'ElenioValverde@gustr.com', 'elerochaval', '$2y$10$veZ/BycDsUxpwXAjhUd4EutdoUAno.58yxWB92xAToVzRPlgHc0A.'),
(4, 'María', 'Marín', 'Naranjo', '610 449 678', '910606191', 'MariaNaranjo@gustr.com', 'mmnaranj', '$2y$10$VR.OqT2C0eGHMukz8QCf7.CaoyC2mWD64Oqemqtqf0xFYjBze.xtG'),
(5, 'Helen', 'Ozuna', 'Almonte', '733 029 369', '910600444', 'AlmonteConcepcion@gustr.com', 'helezuna', '$2y$10$wMKXlmPrZJkJVcOOHYtpzOHY0Q9Cphw8P2QR9zZ6C6QsiDwa4jQBK'),
(6, 'Gara', 'Regalado', 'Montoya', '603 093 237', NULL, 'GaraRMontoya@gustr.com', 'gararemon', '$2y$10$csaZgClSofO56fuIO/QaCenL95FtDvgv4fCa3LYO.dzbg9wveORoS'),
(7, 'Luján', 'Amaya', 'Delgado', '726 535 611', '910601009', 'LujanDelgado@gmail.com', 'lujamaya', '$2y$10$/BQyWmU7d2ddXLnnO3KeGOuDpVKZfKdb6b6j7dpv8wRdbjPxdZtHO'),
(8, 'Pedro', 'Otero', 'Franco', '655 224 142', '910608071', 'FedroOteroFranco@gmail.com', 'pedrotero', '$2y$10$H0Zp.ZomzeXLKnYrILW/2uAkd7.4CLHed6kLSaKXSiyXEd.Q/sufa'),
(9, 'Carlos', 'Leyva', 'Gaitán', '748 727 731', '910601031', 'CarlLeyvaGaitan@gustr.com', 'cleyva', '$2y$10$kXFflHmqrdkZ4oy/Ga2qwOpBdJTZm7o.zG6sWPc23poj5HBMIVd4S'),
(10, 'Emily', 'Bustos', 'Galindo', '750 041 613', '910600448', 'EmilyGalindo@gustr.com', 'emibugalin', '$2y$10$UoWkOXMQGXEvdhJ7MlvauOu4xvo7j3rGLuc29aHGOsINboV80PSW.'),
(11, 'Ernesto', 'Porras', 'Ortiz', '687 452 124', '910600518', 'ErnestoPorrasOrtiz@gmail.com', 'ernesporras', '$2y$10$m5Y2HCRwMKnNI9ZZOycj3OZyxFvg92hY4z0kZLKOGz1fdUU3E71oW'),
(12, 'Ana', 'Villaseñor', 'Pérez', '643 812 467', '910606338', 'AnaVillaPerez@gmail.com', 'anavillaper', '$2y$10$kSHEe1iTxEZ8Ay64C3C.numLUWQD8QkPvOoUsP.UNH3WLuhwmELNO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `fk_alumno_calificaciones` (`id_calificaciones`),
  ADD KEY `fk_alumno_centro` (`id_centro`),
  ADD KEY `fk_alumno_clase` (`id_clase`),
  ADD KEY `fk_alumno_tutor` (`id_tutor_legal`);

--
-- Indexes for table `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asignatura_profesor` (`id_profesor`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calificaciones_asignatura1` (`id_asignatura1`),
  ADD KEY `fk_calificaciones_asignatura2` (`id_asignatura2`),
  ADD KEY `fk_calificaciones_asignatura3` (`id_asignatura3`),
  ADD KEY `fk_calificaciones_asignatura4` (`id_asignatura4`),
  ADD KEY `fk_calificaciones_asignatura5` (`id_asignatura5`),
  ADD KEY `fk_calificaciones_asignatura6` (`id_asignatura6`);

--
-- Indexes for table `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tutor` (`id_tutor_clase`),
  ADD KEY `fk_clase_asignatura1` (`id_asignatura1`),
  ADD KEY `fk_clase_asignatura2` (`id_asignatura2`),
  ADD KEY `fk_clase_asignatura3` (`id_asignatura3`),
  ADD KEY `fk_clase_asignatura4` (`id_asignatura4`),
  ADD KEY `fk_clase_asignatura5` (`id_asignatura5`),
  ADD KEY `fk_clase_asignatura6` (`id_asignatura6`);

--
-- Indexes for table `codigos_de_acceso`
--
ALTER TABLE `codigos_de_acceso`
  ADD KEY `id_centro` (`id_centro`),
  ADD KEY `id_alumnos` (`id_alumnos`);

--
-- Indexes for table `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incidencias_alumno` (`id_alumno`),
  ADD KEY `fk_asignatura_alumno` (`id_asignatura`);

--
-- Indexes for table `mensajería`
--
ALTER TABLE `mensajería`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `despacho` (`despacho`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indexes for table `tutor_legal`
--
ALTER TABLE `tutor_legal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mensajería`
--
ALTER TABLE `mensajería`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tutor_legal`
--
ALTER TABLE `tutor_legal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumno_calificaciones` FOREIGN KEY (`id_calificaciones`) REFERENCES `calificaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_tutor` FOREIGN KEY (`id_tutor_legal`) REFERENCES `tutor_legal` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `fk_asignatura_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_asignatura1` FOREIGN KEY (`id_asignatura1`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificaciones_asignatura2` FOREIGN KEY (`id_asignatura2`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificaciones_asignatura3` FOREIGN KEY (`id_asignatura3`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificaciones_asignatura4` FOREIGN KEY (`id_asignatura4`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificaciones_asignatura5` FOREIGN KEY (`id_asignatura5`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calificaciones_asignatura6` FOREIGN KEY (`id_asignatura6`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `fk_clase_asignatura1` FOREIGN KEY (`id_asignatura1`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_asignatura2` FOREIGN KEY (`id_asignatura2`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_asignatura3` FOREIGN KEY (`id_asignatura3`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_asignatura4` FOREIGN KEY (`id_asignatura4`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_asignatura5` FOREIGN KEY (`id_asignatura5`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_asignatura6` FOREIGN KEY (`id_asignatura6`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clase_tutor` FOREIGN KEY (`id_tutor_clase`) REFERENCES `profesores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `codigos_de_acceso`
--
ALTER TABLE `codigos_de_acceso`
  ADD CONSTRAINT `fk_codigo_alumno` FOREIGN KEY (`id_alumnos`) REFERENCES `alumnos` (`DNI`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_asignatura_alumno` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incidencias_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`DNI`) ON UPDATE CASCADE;

--
-- Constraints for table `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `fk_profesor_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
