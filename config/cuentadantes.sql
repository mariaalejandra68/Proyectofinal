-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2024 a las 20:53:15
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
-- Base de datos: `cuentadantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administrador`
--

CREATE TABLE `tbl_administrador` (
  `usuarioId` int(11) NOT NULL,
  `useUser` varchar(20) NOT NULL,
  `usePass` varchar(100) NOT NULL,
  `tbl_usua_id` varchar(50) NOT NULL,
  `id_tipo_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_administrador`
--

INSERT INTO `tbl_administrador` (`usuarioId`, `useUser`, `usePass`, `tbl_usua_id`, `id_tipo_usu`) VALUES
(17, 'der', '123', '123', 1),
(18, 'maria', '321', '123456789', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_devoluciones`
--

CREATE TABLE `tbl_devoluciones` (
  `id_devolucion` int(11) NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `id_equipo` varchar(20) NOT NULL,
  `id_soporte` varchar(20) NOT NULL,
  `observaciones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Disparadores `tbl_devoluciones`
--
DELIMITER $$
CREATE TRIGGER `disponible` AFTER INSERT ON `tbl_devoluciones` FOR EACH ROW BEGIN
SET foreign_key_checks = 0;
UPDATE tbl_equipos
SET id_disponibilidad = '1', id_usuario='NULL'
WHERE tbl_equipos.n_placa = NEW.id_equipo;
SET foreign_key_checks = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_disponibilidad`
--

CREATE TABLE `tbl_disponibilidad` (
  `id_disponibilidad` int(11) NOT NULL,
  `disponibilidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_disponibilidad`
--

INSERT INTO `tbl_disponibilidad` (`id_disponibilidad`, `disponibilidad`) VALUES
(1, 'Disponible'),
(2, 'No disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entrega`
--

CREATE TABLE `tbl_entrega` (
  `id_entrega` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `ciudad_entrega` varchar(20) NOT NULL,
  `codigo_tic_sena` int(11) NOT NULL,
  `codigo_sitio` int(11) NOT NULL,
  `nombre_representante` varchar(30) NOT NULL,
  `documento_representante` int(15) NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `id_equipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_entrega`
--

INSERT INTO `tbl_entrega` (`id_entrega`, `fecha_entrega`, `ciudad_entrega`, `codigo_tic_sena`, `codigo_sitio`, `nombre_representante`, `documento_representante`, `id_usuario`, `id_equipo`) VALUES
(12312312, '2024-09-09', 'Apartadó', 1321312, 1231231, 'Maria', 1002088899, '123', '1231231');

--
-- Disparadores `tbl_entrega`
--
DELIMITER $$
CREATE TRIGGER `no_disponible` AFTER INSERT ON `tbl_entrega` FOR EACH ROW BEGIN
UPDATE tbl_equipos
SET id_disponibilidad = '2', id_usuario = NEW.id_usuario
WHERE tbl_equipos.n_placa = NEW.id_equipo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_equipos`
--

CREATE TABLE `tbl_equipos` (
  `n_placa` varchar(20) NOT NULL,
  `n_serial` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_disponibilidad` int(11) NOT NULL,
  `id_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_equipos`
--

INSERT INTO `tbl_equipos` (`n_placa`, `n_serial`, `descripcion`, `id_disponibilidad`, `id_usuario`) VALUES
('1231231', 'djdjdjdjdj', 'Mouse', 2, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_soporte_tecnico`
--

CREATE TABLE `tbl_soporte_tecnico` (
  `identificacion` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_soporte_tecnico`
--

INSERT INTO `tbl_soporte_tecnico` (`identificacion`, `nombre`) VALUES
('12312312', 'peces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo`
--

CREATE TABLE `tbl_tipo` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo`
--

INSERT INTO `tbl_tipo` (`id_tipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_traspaso`
--

CREATE TABLE `tbl_traspaso` (
  `id_traspaso` int(11) NOT NULL,
  `fecha_traspaso` date NOT NULL,
  `id_usuario_entrega` varchar(20) NOT NULL,
  `id_usuario_recibe` varchar(20) NOT NULL,
  `id_equipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `identificacion` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `dependencia` varchar(30) NOT NULL,
  `telefono` int(15) NOT NULL,
  `sede` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`identificacion`, `nombre`, `dependencia`, `telefono`, `sede`) VALUES
('123', 'der', 'Instructor', 12212112, 'Apartadó'),
('123456789', 'maria', 'gerente', 2147483647, 'bbn'),
('87766879', 'mari', 'serdtyguhjk', 9876546, 'dfghjkl');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD PRIMARY KEY (`usuarioId`),
  ADD KEY `tbl_usua_id` (`tbl_usua_id`),
  ADD KEY `tbl_usua_id_2` (`tbl_usua_id`),
  ADD KEY `tbl_usua_id_3` (`tbl_usua_id`),
  ADD KEY `id_tipo_usu` (`id_tipo_usu`);

--
-- Indices de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `id_soporte` (`id_soporte`);

--
-- Indices de la tabla `tbl_disponibilidad`
--
ALTER TABLE `tbl_disponibilidad`
  ADD PRIMARY KEY (`id_disponibilidad`);

--
-- Indices de la tabla `tbl_entrega`
--
ALTER TABLE `tbl_entrega`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `tbl_equipos`
--
ALTER TABLE `tbl_equipos`
  ADD PRIMARY KEY (`n_placa`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_disponibilidad` (`id_disponibilidad`);

--
-- Indices de la tabla `tbl_soporte_tecnico`
--
ALTER TABLE `tbl_soporte_tecnico`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indices de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tbl_traspaso`
--
ALTER TABLE `tbl_traspaso`
  ADD PRIMARY KEY (`id_traspaso`),
  ADD KEY `id_usuario_entrega` (`id_usuario_entrega`),
  ADD KEY `id_usuario_recibe` (`id_usuario_recibe`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_disponibilidad`
--
ALTER TABLE `tbl_disponibilidad`
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_entrega`
--
ALTER TABLE `tbl_entrega`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12312313;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_traspaso`
--
ALTER TABLE `tbl_traspaso`
  MODIFY `id_traspaso` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD CONSTRAINT `tbl_administrador_ibfk_1` FOREIGN KEY (`tbl_usua_id`) REFERENCES `tbl_usuarios` (`identificacion`),
  ADD CONSTRAINT `tbl_administrador_ibfk_2` FOREIGN KEY (`id_tipo_usu`) REFERENCES `tbl_tipo` (`id_tipo`);

--
-- Filtros para la tabla `tbl_devoluciones`
--
ALTER TABLE `tbl_devoluciones`
  ADD CONSTRAINT `tbl_devoluciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_devoluciones_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `tbl_equipos` (`n_placa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_devoluciones_ibfk_3` FOREIGN KEY (`id_soporte`) REFERENCES `tbl_soporte_tecnico` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_entrega`
--
ALTER TABLE `tbl_entrega`
  ADD CONSTRAINT `tbl_entrega_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_entrega_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `tbl_equipos` (`n_placa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_equipos`
--
ALTER TABLE `tbl_equipos`
  ADD CONSTRAINT `tbl_equipos_ibfk_2` FOREIGN KEY (`id_disponibilidad`) REFERENCES `tbl_disponibilidad` (`id_disponibilidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_equipos_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`identificacion`);

--
-- Filtros para la tabla `tbl_traspaso`
--
ALTER TABLE `tbl_traspaso`
  ADD CONSTRAINT `tbl_traspaso_ibfk_1` FOREIGN KEY (`id_usuario_entrega`) REFERENCES `tbl_usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_traspaso_ibfk_2` FOREIGN KEY (`id_usuario_recibe`) REFERENCES `tbl_usuarios` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_traspaso_ibfk_3` FOREIGN KEY (`id_equipo`) REFERENCES `tbl_equipos` (`n_placa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
