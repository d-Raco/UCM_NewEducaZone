-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2020 a las 20:37:34
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `centros_educativos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
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
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`DNI`, `nombre`, `apellido1`, `apellido2`, `id_centro`, `id_clase`, `observaciones_medicas`, `id_tutor_legal`, `fecha_nacimiento`, `id_calificaciones`, `foto`) VALUES
('00822109C', 'Rosmira', 'Frías', 'Carvajal', 41000405, 7, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2004-05-20', 7, NULL),
('01864521A', 'Alumine', 'Nieves', 'Salcedo', 50000151, 14, NULL, NULL, '2006-03-14', 7, NULL),
('13586449G', 'Memmon', 'Crespo', 'Nieto', 8039598, 18, NULL, NULL, '2006-03-04', 7, NULL),
('13902147G', 'Inmaculada', 'Campos', 'Alcalá', 8039598, 19, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2006-05-01', 7, NULL),
('15700350K', 'Alanis', 'Ibarra', 'Padrón', 28047551, 17, NULL, 2, '2003-07-05', 7, NULL),
('16352963D', 'Solano', 'Rocha', 'Cedillo', 50000151, 14, NULL, 3, '2006-11-22', 7, NULL),
('16512408H', 'Sebasten', 'Armendáriz', 'Maldonado', 41000405, 13, ' Anafilaxia', NULL, '2004-11-19', 7, NULL),
('16627162W', 'Rayen', 'Sánchez', 'Marín', 28047551, 17, 'Presenta reacciones alérgicas a los frutos secos.', 4, '2003-11-11', 7, NULL),
('20171515D', 'Meinard', 'Mesa', 'Ulloa', 28047551, 17, NULL, NULL, '2003-06-12', 7, NULL),
('21503333N', 'Zohar', 'Núñez', 'Ozuna', 8039598, 19, NULL, 5, '2005-12-13', 7, NULL),
('25952332Y', 'Laodicea', 'Cabán', 'Roque', 50000151, 15, NULL, NULL, '2002-08-09', 7, NULL),
('25988953B', 'Munir', 'Árias', 'Regalado', 50000151, 16, NULL, 6, '2006-07-10', 7, NULL),
('27036756A', 'Abram', 'Archuleta', 'Vanegas', 41000405, 8, NULL, NULL, '2005-08-09', 7, NULL),
('31123104X', 'Aracely', 'Angulo', 'Rael', 8039598, 19, NULL, NULL, '2006-01-02', 7, NULL),
('31631695W', 'Xaviera', 'Amaya', 'Hernández', 28070913, 12, '', 7, '2002-05-20', 7, NULL),
('37071162S', 'Neus', 'Benavides', 'Bustos', 41000405, 8, NULL, 10, '2005-05-17', 7, NULL),
('38067105N', 'Atanasio', 'Medrano', 'Villareal', 50000151, 16, NULL, NULL, '2006-10-20', 7, NULL),
('38946295G', 'Antígona', 'Rosas', 'Vázquez', 28070913, 12, NULL, NULL, '2002-11-19', 7, NULL),
('42893072G', 'Nicholai', 'Rivero', 'Fernández', 28070913, 12, 'Presenta reacciones alérgicas a los anacardos y almendras', NULL, '2002-03-04', 7, NULL),
('43018009M', 'Horaz', 'Otero', 'Espinosa', 50000151, 16, NULL, 8, '2006-04-17', 7, NULL),
('43874001Y', 'Otilio', 'Jimínez', 'Mejía', 8039598, 19, NULL, NULL, '2005-09-08', 7, NULL),
('44138671S', 'Pío', 'Colunga', 'Bernal', 50000151, 16, NULL, NULL, '2006-06-10', 7, NULL),
('45730731S', 'Laviana', 'Leyva', 'Guerrero', 41000405, 8, NULL, 9, '2005-09-17', 7, NULL),
('51195336G', 'Morfeo', 'Calvillo', 'Padilla', 41000405, 8, NULL, NULL, '2005-07-19', 7, NULL),
('52983179B', 'Orestes', 'Chapa', 'Badillo', 50000151, 16, NULL, NULL, '2007-04-20', 7, NULL),
('53389278E', 'Dara', 'Tamayo', 'Aguirre', 41000405, 13, ' Síndrome de alargia oral.', NULL, '2004-03-04', 7, NULL),
('61063539B', 'Antonella', 'Cisneros', 'Mares', 41000405, 8, NULL, NULL, '2005-04-04', 7, NULL),
('64609317V', 'Carmen', 'Mercado', 'Canales', 50000151, 15, NULL, NULL, '2003-01-31', 7, NULL),
('65619270V', 'Lucas', 'Benavidez', 'Madrid', 50000151, 14, NULL, NULL, '2006-03-07', 7, NULL),
('77595539W', 'Tara', 'Melgar', 'Palomino', 50000151, 14, NULL, NULL, '2006-11-19', 7, NULL),
('78678320N', 'Oscar', 'Cristobal', 'Fernández', 41000405, 7, 'Presenta reacciones alérgicas a los frutos secos.', 1, '2004-03-04', 7, 'img\\users\\alumnos\\oscar.jpg'),
('82413678D', 'Olalla', 'Porras', 'Rolón', 50000151, 15, NULL, 11, '2004-12-13', 7, NULL),
('86512991D', 'Privato', 'Corral', 'Rojas', 41000405, 7, NULL, NULL, '2004-11-19', 7, NULL),
('88962348G', 'Candela', 'Quiñones', 'Aguilera', 50000151, 15, NULL, NULL, '2004-08-20', 7, NULL),
('92125571Z', 'Adamo', 'Zepeda', 'Altamirano', 8039598, 18, 'Trastorno obsesivo-compulsivo (TOC)', NULL, '2006-05-20', 7, NULL),
('94374398Q', 'Romanela', 'Alarcón', 'Villaseñor', 50000151, 14, NULL, 12, '2006-08-26', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
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
-- Volcado de datos para la tabla `asignaturas`
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
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `asignatura1` varchar(20) NOT NULL DEFAULT 'LENGUA',
  `nota1` double UNSIGNED DEFAULT NULL,
  `asignatura2` varchar(20) NOT NULL DEFAULT 'MATEMATICAS',
  `nota2` double UNSIGNED DEFAULT NULL,
  `asignatura3` varchar(20) NOT NULL DEFAULT 'FISICA',
  `nota3` double UNSIGNED DEFAULT NULL,
  `asignatura4` varchar(20) NOT NULL DEFAULT 'INGLES',
  `nota4` double UNSIGNED DEFAULT NULL,
  `asignatura5` varchar(20) NOT NULL DEFAULT 'HISTORIA',
  `nota5` double UNSIGNED DEFAULT NULL,
  `asignatura6` varchar(20) NOT NULL DEFAULT 'EDUCACION FISICA',
  `nota6` double UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `asignatura1`, `nota1`, `asignatura2`, `nota2`, `asignatura3`, `nota3`, `asignatura4`, `nota4`, `asignatura5`, `nota5`, `asignatura6`, `nota6`) VALUES
(7, 'LENGUA', NULL, 'MATEMATICAS', NULL, 'FISICA', NULL, 'INGLES', NULL, 'HISTORIA', NULL, 'EDUCACION FISICA', NULL),
(8, 'LENGUA', NULL, 'MATEMATICAS', NULL, 'MUSICA', NULL, 'INGLES', NULL, 'HISTORIA', NULL, 'EDUCACION FISICA', NULL),
(9, 'LENGUA', NULL, 'MATEMATICAS', NULL, 'FISICA', NULL, 'INGLES', NULL, 'HISTORIA', NULL, 'QUIMICA', NULL),
(10, 'LENGUA', NULL, 'MATEMATICAS', NULL, 'FISICA', NULL, 'INGLES', NULL, 'HISTORIA', NULL, 'ECONOMIA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
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
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`id`, `nombre`, `provincia`, `direccion`, `telefono`, `email`) VALUES
(8039598, 'Escola Sant Miquel del Cros', 'Barcelona', 'Av. del Mediterrani, 08310', '937993951', 'a8039598@xtec.cat'),
(28047551, 'CEIP Agua Dulce', 'Madrid', 'Calle De Leñeros 25, 28039', '914594049', 'eei.aguadulce.madrid@educa.madrid.org'),
(28070913, 'Colegio Amanecer', 'Madrid', 'Calle Del Titanio 7, 28032', '917765069', 'eei.amanecer.madrid@educa.madrid.org'),
(41000405, 'IES Miguel de Cervantes', 'Sevilla', 'Virgen del Consuelo 26, 41449', '955649736', '41000405.edu@juntadeandalucia.es'),
(50000151, 'Nuestra Señora del Castillo', 'Zaragoza', 'Avenida de la Portalada 39, 50630', '976610290', 'nscastillo@nscastillo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
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
-- Volcado de datos para la tabla `clases`
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
-- Estructura de tabla para la tabla `codigos_de_acceso`
--

CREATE TABLE `codigos_de_acceso` (
  `codigo` varchar(20) NOT NULL,
  `id_centro` int(11) UNSIGNED NOT NULL,
  `id_alumnos` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `codigos_de_acceso`
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
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_asignatura` int(11) UNSIGNED NOT NULL,
  `id_alumno` varchar(9) NOT NULL,
  `msg_incidencia` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajería`
--

CREATE TABLE `mensajería` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_origen` int(11) UNSIGNED NOT NULL,
  `rol_origen` varchar(20) NOT NULL,
  `id_destinatario` int(11) UNSIGNED NOT NULL,
  `rol_destinatario` varchar(20) NOT NULL,
  `contenido_msg` varchar(300) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
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
  `contraseña` varchar(30) NOT NULL,
  `foto` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `id_centro`, `nombre`, `apellido1`, `apellido2`, `despacho`, `correo`, `usuario`, `contraseña`, `foto`) VALUES
(1, 41000405, 'Javier', 'Sanz', 'Garrido', 23, 'jsanzgarrido@iesmiguelcerv.es', 'javisgarr', 'realmadrid2020', 'img\\users\\profesores\\javier.jpg'),
(2, 8039598, 'Katherine', 'Thompson', NULL, 14, 'KatherineRThompson@gustr.com', 'Heauld', 'eixoov0AGh', 'img\\users\\profesores\\katherine.jpg'),
(3, 28070913, 'Georgia', 'Potter', NULL, NULL, 'GeorgiaPotter@gmail.com', 'Prisfirel', 'ohTohPiech6ei', 'img\\users\\profesores\\georgia.jpg'),
(4, 50000151, 'Beltran', 'Serrano', 'Tafoya', 7, 'BeltranSerranoTafoya@gustr.com', 'Hustme', 'Eejieh7ooBee', 'img\\users\\profesores\\beltran.jpg'),
(6, 28047551, 'Naiara', 'Cervántez', 'Muñoz', 20, 'NaiaraCervantezMunoz@gustr.com', 'Sekhas44', 'Ohg5ohngao', 'img\\users\\profesores\\naiara.jpg'),
(8, 41000405, 'Garcilaso', 'Oquendo', 'García', 3, 'GarcilasoOquendoGarcia@gustr.com', 'Heme1969', 'wiZohg5j', 'img\\users\\profesores\\garcilaso.jpg'),
(9, 8039598, 'Juan Carlos', 'Barreto', 'Hernández', 65, 'JuanCarlosBarretoHernandez@gmail.com', 'Joincte', 'umeephieH1ie', NULL),
(16, 8039598, 'Margarita', 'Vega', 'Téllez', 2, 'MargaritaVegaTellez@gmail.com', 'Upinedegs', 'Eecoh7ahnae', NULL),
(17, 8039598, 'Marta', 'Pedroza', 'Rosario', 5, 'MartaPedrozaRosario@gustr.com', ' Emaked', ' OoChi4chue', NULL),
(20, 8039598, 'Adena', 'Pineda', 'Montero', 54, 'AdenaPinedaMontero@gmail.com', 'Aggland82', ' aViehoh5ees', NULL),
(21, 8039598, 'Casiano', 'Trejo', 'Lozano', 34, 'CasianoTrejoLozano@gustr.com', ' Cail1971', ' Qua2tieng8', NULL),
(22, 41000405, 'Bruna', 'Guillén', 'Merino', 17, 'BrunaGuillenMerino@gustr.com', 'Lifee1955', 'Dopha8hei', NULL),
(23, 41000405, 'Hannah', 'Thompson', NULL, NULL, 'HannahThomp@gustr.com', 'Thimed', 'Ohfee3jei8Oo', NULL),
(24, 28047551, 'Jose', 'Crespo', 'Aponte', 27, 'CrespoAponte@superrito.com', ' Thappery', ' Ed7Aipu8fei', NULL),
(25, 28047551, 'Jose', 'Verdugo', 'Correa', 31, 'IberoVerdugoCorrea@gustr.com', ' Liaxoreated', 'gaiV8yahNg', NULL),
(26, 28070913, 'Balbino', 'Verdugo', 'Castro', 24, 'BalbinoVerdugoCastro@superrito.com', 'Subbillson', 'ieThie0oomee', NULL),
(27, 28070913, 'Cleodora', 'Carvajal', 'Curiel', 42, 'CleodoraCarvajalCuriel@gmail.com', 'Otill1951', ' Gohc5yo5', NULL),
(28, 50000151, 'Juliano', 'Vargas', 'Rosas', 37, 'JulianoVargasRosas@gmail.com', 'Grops1982', 'Be4aiGhael5', NULL),
(29, 50000151, 'Lioba', 'Solórzano', 'Muñoz', 45, 'LiobaSolorzanoCintron@gustr.com', 'Thermed', 'Au3daeNga', NULL),
(30, 50000151, 'Ethel', 'Llarnas', 'Sanabria', NULL, 'EthelLlarnasSanabria@gmail.com', 'Pricher', 'vah6maiGh5', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_legal`
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
  `contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutor_legal`
--

INSERT INTO `tutor_legal` (`id`, `nombre`, `apellido1`, `apellido2`, `telefono_movil`, `telefono_fijo`, `correo`, `usuario`, `contraseña`) VALUES
(1, 'Francisco', 'Cristobal', 'Casárez', '643 492 101', NULL, 'FCristoCasarez@gustr.com', 'Alied1957', 'haeh2xohnooB'),
(2, 'Bautista', 'Ibarra', 'Chacón', '686 127 193', NULL, 'BautistaChacon@gustr.com', 'Unis1966', 'au2Uevaicei'),
(3, 'Elenio ', 'Rocha', 'Valverde', '684 704 947', NULL, 'ElenioValverde@gustr.com', 'Leorelp', 'Fee0tohv'),
(4, 'María', 'Marín', 'Naranjo', '610 449 678', '910606191', 'MariaNaranjo@gustr.com', 'Hoppled1964', 'eeWah7sie'),
(5, 'Helen', 'Ozuna', 'Almonte', '733 029 369', '910600444', 'AlmonteConcepcion@gustr.com', 'Thoonions', 'sho6Eep9wei'),
(6, 'Gara', 'Regalado', 'Montoya', '603 093 237', NULL, 'GaraRMontoya@gustr.com', 'Const1982', 'aiKoh0ipuw'),
(7, 'Luján', 'Amaya', 'Delgado', '726 535 611', '910601009', 'LujanDelgado@gmail.com', ' Ophymplar', ' uiqu9uF0ie'),
(8, 'Pedro', 'Otero', 'Franco', '655 224 142', '910608071', 'FedroOteroFranco@gmail.com', 'FOFtusa99', 'ji6Cui6oo'),
(9, 'Carlos', 'Leyva', 'Gaitán', '748 727 731', '910601031', 'CarlLeyvaGaitan@gustr.com', 'Ambegurea', 'AhhuaMai3ie'),
(10, 'Emily', 'Bustos', 'Galindo', '750 041 613', '910600448', 'EmilyGalindo@gustr.com', 'Knet1970', 'OoTha3ae'),
(11, 'Ernesto', 'Porras', 'Ortiz', '687 452 124', '910600518', 'ErnestoPorrasOrtiz@gmail.com', ' Carchab67', 'Aung7iM0ah'),
(12, 'Ana', 'Villaseñor', 'Pérez', '643 812 467', '910606338', 'AnaVillaPerez@gmail.com', 'Therat85', 'xahv4Nani6Oo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `fk_alumno_calificaciones` (`id_calificaciones`),
  ADD KEY `fk_alumno_centro` (`id_centro`),
  ADD KEY `fk_alumno_clase` (`id_clase`),
  ADD KEY `fk_alumno_tutor` (`id_tutor_legal`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asignatura_profesor` (`id_profesor`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clases`
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
-- Indices de la tabla `codigos_de_acceso`
--
ALTER TABLE `codigos_de_acceso`
  ADD UNIQUE KEY `id_alumnos_2` (`id_alumnos`),
  ADD KEY `id_centro` (`id_centro`),
  ADD KEY `id_alumnos` (`id_alumnos`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incidencias_alumno` (`id_alumno`),
  ADD KEY `fk_asignatura_alumno` (`id_asignatura`);

--
-- Indices de la tabla `mensajería`
--
ALTER TABLE `mensajería`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `despacho` (`despacho`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indices de la tabla `tutor_legal`
--
ALTER TABLE `tutor_legal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajería`
--
ALTER TABLE `mensajería`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tutor_legal`
--
ALTER TABLE `tutor_legal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumno_calificaciones` FOREIGN KEY (`id_calificaciones`) REFERENCES `calificaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_tutor` FOREIGN KEY (`id_tutor_legal`) REFERENCES `tutor_legal` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `fk_asignatura_profesor` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
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
-- Filtros para la tabla `codigos_de_acceso`
--
ALTER TABLE `codigos_de_acceso`
  ADD CONSTRAINT `fk_codigo_alumno` FOREIGN KEY (`id_alumnos`) REFERENCES `alumnos` (`DNI`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_asignatura_alumno` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incidencias_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`DNI`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `fk_profesor_centro` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
