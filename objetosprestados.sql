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
-- Volcado de datos para la tabla `devolucionpersona`
--

INSERT INTO `devolucionpersona` (`id`, `idPersona`, `idObjeto`, `fechaDevolucion`, `descripcion`, `cantidad`, `idPrestamoPersona`, `estado`) VALUES
(1, 1, 1, '2017-08-22', ' devuelto', 1, 11, 'activo'),
(2, 5, 7, '2017-08-22', ' Devolvio sin Cargador', 1, 5, 'activo'),
(5, 1, 7, '2017-08-22', 'Devolvio Celular', 1, 13, 'activo'),
(6, 1, 4, '2017-08-23', ' Devolucion completa', 1, 14, 'activo');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Game Cube', 'Consola de video Juegos', 'activo'),
(2, 'salida de video game cube', 'mechas de salida de audio y video de nintendo game cube', 'activo'),
(3, 'Nintendo Wii', 'Consola de video juegos', 'activo'),
(4, 'Disco duro externo', 'Disco duro externo, Case', 'activo'),
(5, 'Guitarra Acustica', 'Guitarra acustica, Valencia', 'activo'),
(6, 'Dinero', 'Lempiras ', 'activo'),
(7, 'Celular', 'Hometown ', 'activo'),
(8, 'Blackberry 8520', 'celular Blackberry 8520', 'activo'),
(9, 'Watch Dog 2 ps4', 'video juego de PS4', 'activo'),
(10, 'Cargador Celular', 'Cargador de celular Chino Hometown', 'activo');

-- --------------------------------------------------------

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
(1, 'Jose', 'Orlando', 'Claros', 'Hernandez', '9662-8959', 'joch1710@yahoo.es', 'activo'),
(2, 'Fredin', '', 'Funes', 'Carcamo', '8794-7380', 'fredinfu@gmail.com', 'activo'),
(3, 'Gustavo', 'Adolfo', 'Flores', 'Cano', '9686-4577', 'gafc_86@hotmail.com', 'activo'),
(4, 'Johan', 'Michell', 'Carcamo', 'Pineda', '3267-7311', 'johanm.carcamo@gmail.com ', 'activo'),
(5, 'Enrique', 'Jafeth', 'Bustillo', '', '8734-2535', '', 'activo'),
(6, 'Eduardo', '', 'Leon', '', '3145-0879', '', 'activo'),
(7, 'Omar', 'Alejandro', 'Ramos', '', '9454-6277', '', 'activo'),
(8, 'Gabriel', '', 'Gonzales', '', '', '', 'activo'),
(9, 'Hector', 'Alejandro', 'Bonilla', '', '9898-2155', '', 'activo'),
(10, 'Sandra', 'Lourdes', 'Hernandez', '', '9532-7080', '', 'activo');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `prestamopersona`
--

INSERT INTO `prestamopersona` (`id`, `idPersona`, `idObjeto`, `fechaPrestamo`, `descripcion`, `cantidad`, `estado`) VALUES
(1, 2, 2, '2016-04-03', NULL, 1, 'activo'),
(2, 3, 1, '2017-08-17', ' Nintengo Game cube, con Smash bross meele, sin salida de video ', 1, 'activo'),
(3, 4, 5, '2017-08-17', ' Guitarra con su estuche', 1, 'activo'),
(4, 4, 6, '2017-08-17', ' LPS 1,000', 1000, 'activo'),
(5, 5, 7, '2017-08-17', 'Celular Chino Hometown', 1, 'inactivo'),
(6, 6, 3, '2017-08-17', ' Nintendo wii completo', 1, 'activo'),
(7, 7, 4, '2017-08-17', ' Disco duro case conexion electrica, con Juegos de wii', 1, 'activo'),
(8, 8, 8, '2017-08-17', ' Celular Blackberry 8520,con cargador, lo doy por perdido', 1, 'activo'),
(9, 9, 9, '2017-08-17', ' intercambio de video juegos, whatch dog2 PS4 por Metal Gear Solid V The Phantom Pain ps4', 1, 'activo'),
(10, 10, 6, '2017-08-17', ' Lps 13,800- concepto de compra de ganado porcino, primero Lps 7,800 luego Lps 6,000', 13800, 'activo'),
(11, 1, 1, '2017-08-19', ' bnm,.', 1, 'inactivo'),
(12, 5, 10, '2017-08-22', ' Cargador completo, Cubo, Extencion y adaptador', 1, 'activo'),
(13, 1, 7, '2017-08-22', ' celular Chino HomeTown', 1, 'inactivo'),
(14, 1, 4, '2017-08-23', ' disco duro externo sata', 1, 'inactivo');

-- --------------------------------------------------------

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
(1, 'joshe', '1234', 1, 'activo');

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
