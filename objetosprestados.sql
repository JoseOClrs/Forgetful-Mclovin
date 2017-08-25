-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2017 a las 18:32:30
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `objetosprestados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucionpersona`
--

CREATE TABLE `devolucionpersona` (
  `id` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idObjeto` int(11) NOT NULL,
  `fechaDevolucion` date NOT NULL,
  `descripcion` text,
  `cantidad` int(11) DEFAULT NULL,
  `idPrestamoPersona` int(11) NOT NULL,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE `objeto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `segundoNombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `segundoNombre`, `apellido`, `segundoApellido`, `telefono`, `correo`, `estado`) VALUES
(1, 'admin', '', 'admin', '', '0000-0000', 'admin@admin.com', 'activo');


--
-- Estructura de tabla para la tabla `prestamopersona`
--

CREATE TABLE `prestamopersona` (
  `id` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idObjeto` int(11) NOT NULL,
  `fechaPrestamo` date NOT NULL,
  `descripcion` text,
  `cantidad` int(11) DEFAULT NULL,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `idPersona`, `estado`) VALUES
(1, 'admin', '1234', 1, 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `devolucionpersona`
--
ALTER TABLE `devolucionpersona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idObjeto` (`idObjeto`),
  ADD KEY `idPrestamoPersona` (`idPrestamoPersona`);

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamopersona`
--
ALTER TABLE `prestamopersona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idObjeto` (`idObjeto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPersona` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `devolucionpersona`
--
ALTER TABLE `devolucionpersona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `prestamopersona`
--
ALTER TABLE `prestamopersona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `devolucionpersona`
--
ALTER TABLE `devolucionpersona`
  ADD CONSTRAINT `devolucionpersona_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devolucionpersona_ibfk_2` FOREIGN KEY (`idObjeto`) REFERENCES `objeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devolucionpersona_ibfk_3` FOREIGN KEY (`idPrestamoPersona`) REFERENCES `prestamopersona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamopersona`
--
ALTER TABLE `prestamopersona`
  ADD CONSTRAINT `prestamopersona_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamopersona_ibfk_2` FOREIGN KEY (`idObjeto`) REFERENCES `objeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
