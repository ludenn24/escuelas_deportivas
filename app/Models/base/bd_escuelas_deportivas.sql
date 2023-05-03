-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2023 a las 18:20:49
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_escuelas_deportivas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_convocatoria`
--

CREATE TABLE `tb_convocatoria` (
  `id_convocatoria` int(11) NOT NULL,
  `nombre` varchar(400) NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cursos`
--

CREATE TABLE `tb_cursos` (
  `id_curso` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `frecuencia` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_cursos`
--

INSERT INTO `tb_cursos` (`id_curso`, `id_sede`, `nombre`, `frecuencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fútbol', 'Lunes - Miércoles - Viernes', 1, '2023-04-24', '2023-04-24'),
(2, 1, 'Baloncesto', 'Lunes - Miércoles - Viernes', 1, '2023-04-24', '2023-04-24'),
(3, 1, 'Ajedrez', 'Lunes - Miércoles - Viernes', 1, '2023-04-24', '2023-04-24'),
(4, 1, 'Voleibol', 'Martes - Jueves - Sábado', 1, '2023-04-24', '2023-04-24'),
(5, 3, 'Taekwondo', 'Lunes - Miércoles - Viernes', 1, '2023-04-24', '2023-04-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_detalle_inscripcion`
--

CREATE TABLE `tb_detalle_inscripcion` (
  `id_detalle` int(11) NOT NULL,
  `id_inscripcion` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_horarios`
--

CREATE TABLE `tb_horarios` (
  `id_horario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `horario` varchar(200) NOT NULL,
  `edades` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_horarios`
--

INSERT INTO `tb_horarios` (`id_horario`, `id_curso`, `horario`, `edades`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '15:00 - 16:00 p.m.', '6 - 8 años', 1, '2023-04-25', '2023-04-25'),
(2, 1, '16:00 - 17:00 p.m.\r\n', '9 - 11 años', 1, '2023-04-25', '2023-04-25'),
(3, 1, '17:00 - 18:00 p.m.\r\n', '12 - 17 años ', 1, '2023-04-25', '2023-04-25'),
(4, 2, '15:00 - 16:00 p.m.', '9 - 11 años', 1, '2023-04-25', '2023-04-25'),
(5, 2, '16:00 - 17:00 p.m.', '12  - 17 años ', 1, '2023-04-25', '2023-04-25'),
(6, 2, '17:00 - 18:00 p.m.', '6 - 8 años', 1, '2023-04-25', '2023-04-25'),
(7, 3, '15:00 - 16:00 p.m.\r\n', 'INICIACIÓN', 1, '2023-04-25', '2023-04-25'),
(8, 3, '16:00 - 17:00 p.m.\r\n', 'INTERMEDIO', 1, '2023-04-25', '2023-04-25'),
(9, 3, '17:00 - 18:00 p.m.\r\n', 'AVANZADO', 1, '2023-04-25', '2023-04-25'),
(10, 4, '15:00 - 16:00 p.m.\r\n', '6 - 8 años', 1, '2023-04-25', '2023-04-25'),
(11, 4, '16:00 - 17:00 p.m.', '9 - 11 años', 1, '2023-04-25', '2023-04-25'),
(12, 4, '17:00 - 18:00 p.m.', '12  - 17 años', 1, '2023-04-25', '2023-04-25'),
(13, 5, '16:00 - 17:00 p.m.\r\n', '6 - 8 años\r\n', 1, '2023-04-25', '2023-04-25'),
(14, 5, '17:00 - 18:00 p.m.\r\n', '9 - 11 años', 1, '2023-04-25', '2023-04-25'),
(15, 5, '18:00 - 19:00 p.m.\r\n', '12 años a mas\r\n', 1, '2023-04-25', '2023-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_inscripciones`
--

CREATE TABLE `tb_inscripciones` (
  `id_inscripcion` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_convocatoria` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_participantes`
--

CREATE TABLE `tb_participantes` (
  `id_participante` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `ape_paterno` varchar(100) DEFAULT NULL,
  `ape_materno` varchar(100) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `tipo_documento` varchar(100) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `edad` varchar(100) DEFAULT NULL,
  `grado_estudios` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(100) DEFAULT NULL,
  `sexo` varchar(100) DEFAULT NULL,
  `condicion_medica` varchar(100) DEFAULT NULL,
  `seguro_medico` varchar(100) DEFAULT NULL,
  `domicilio` varchar(1000) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `nombres_apo` varchar(100) DEFAULT NULL,
  `ape_pater_apo` varchar(100) DEFAULT NULL,
  `ape_mater_apo` varchar(100) DEFAULT NULL,
  `tipo_doc_apo` varchar(100) DEFAULT NULL,
  `dni_apo` varchar(100) DEFAULT NULL,
  `parentesco` varchar(100) DEFAULT NULL,
  `celular_apo` varchar(100) DEFAULT NULL,
  `conadis` varchar(100) DEFAULT NULL,
  `carne_conadis` varchar(100) DEFAULT NULL,
  `silla` varchar(100) DEFAULT NULL,
  `tipo_discapacidad` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_participantes`
--

INSERT INTO `tb_participantes` (`id_participante`, `nombres`, `ape_paterno`, `ape_materno`, `fecha_nac`, `tipo_documento`, `dni`, `edad`, `grado_estudios`, `nacionalidad`, `sexo`, `condicion_medica`, `seguro_medico`, `domicilio`, `distrito`, `nombres_apo`, `ape_pater_apo`, `ape_mater_apo`, `tipo_doc_apo`, `dni_apo`, `parentesco`, `celular_apo`, `conadis`, `carne_conadis`, `silla`, `tipo_discapacidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, '312d', 'qwdqw', 'dqwq', '2023-05-10', 'PTP', '1244342', '4234234', '42342', '423432', 'Femenino', 'Tipo 1', 'Sí', '23423', '1253', '4234', '42342', NULL, 'DNI', '234', '1251', '234', 'Sí', '423423', 'Sí', 'intelectual', 1, '2023-05-02', '2023-05-02'),
(2, 'ROYER', 'VELASQUEZ', 'CARRANZA', '1992-06-16', 'DNI', '47598332', '31', 'TECNICOS', 'PERUANA', 'Masculino', 'Tipo 1', 'Sí', 'CARABAYLLO', '1252', 'EUGENIA', 'CARRANZA', 'CARRANZA', 'DNI', '16281718', '1252', '12345678', 'Sí', '123', 'No', 'física', 1, '2023-05-02', '2023-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_sedes`
--

CREATE TABLE `tb_sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `estado` int(11) NOT NULL,
  `createrd_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_sedes`
--

INSERT INTO `tb_sedes` (`id_sede`, `nombre`, `estado`, `createrd_at`, `updated_at`) VALUES
(1, 'Ancón', 1, '2023-04-24', '2023-04-24'),
(2, 'Amazonas', 1, '2023-04-24', '2023-04-24'),
(3, 'Puente Piedra', 1, '2023-04-24', '2023-04-24'),
(4, 'Pascana', 1, '2023-04-24', '2023-04-24'),
(5, 'Independencia', 1, '2023-04-24', '2023-04-24'),
(6, 'Tungasuca', 1, '2023-04-24', '2023-04-24'),
(7, 'Dansey', 1, '2023-04-24', '2023-04-24'),
(8, 'Virrey', 1, '2023-04-24', '2023-04-24'),
(9, 'Conchucos', 1, '2023-04-24', '2023-04-24'),
(10, 'Palomino', 1, '2023-04-24', '2023-04-24'),
(11, 'Nuevo Mundo', 1, '2023-04-24', '2023-04-24'),
(12, 'Rimac', 1, '2023-04-24', '2023-04-24'),
(13, 'Planeta', 1, '2023-04-24', '2023-04-24'),
(14, 'Manzanilla', 1, '2023-04-24', '2023-04-24'),
(15, 'Libertadores', 1, '2023-04-24', '2023-04-24'),
(16, 'Upis', 1, '2023-04-24', '2023-04-24'),
(17, 'Juan Pablo', 1, '2023-04-24', '2023-04-24'),
(18, 'Vista Alegre', 1, '2023-04-24', '2023-04-24'),
(19, 'Bello Horizonte', 1, '2023-04-24', '2023-04-24'),
(20, 'Villa el Salvador', 1, '2023-04-24', '2023-04-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_convocatoria`
--
ALTER TABLE `tb_convocatoria`
  ADD PRIMARY KEY (`id_convocatoria`);

--
-- Indices de la tabla `tb_cursos`
--
ALTER TABLE `tb_cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `tb_detalle_inscripcion`
--
ALTER TABLE `tb_detalle_inscripcion`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `tb_horarios`
--
ALTER TABLE `tb_horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `tb_inscripciones`
--
ALTER TABLE `tb_inscripciones`
  ADD PRIMARY KEY (`id_inscripcion`);

--
-- Indices de la tabla `tb_participantes`
--
ALTER TABLE `tb_participantes`
  ADD PRIMARY KEY (`id_participante`);

--
-- Indices de la tabla `tb_sedes`
--
ALTER TABLE `tb_sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_convocatoria`
--
ALTER TABLE `tb_convocatoria`
  MODIFY `id_convocatoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_cursos`
--
ALTER TABLE `tb_cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_detalle_inscripcion`
--
ALTER TABLE `tb_detalle_inscripcion`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_horarios`
--
ALTER TABLE `tb_horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tb_inscripciones`
--
ALTER TABLE `tb_inscripciones`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_participantes`
--
ALTER TABLE `tb_participantes`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_sedes`
--
ALTER TABLE `tb_sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
