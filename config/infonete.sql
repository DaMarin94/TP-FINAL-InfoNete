-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2022 a las 02:10:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infonete`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(7) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `subtitulo`, `contenido`, `imagen`) VALUES
(2, 'Titpulo pruienba', 'subtitulo prueba', 'contenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenidocontenido', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_multimedia`
--

CREATE TABLE `contenido_multimedia` (
  `id` int(7) NOT NULL,
  `multimedia` varchar(150) DEFAULT NULL,
  `multimedia2` varchar(150) DEFAULT NULL,
  `multimedia3` varchar(150) DEFAULT NULL,
  `multimedia4` varchar(150) DEFAULT NULL,
  `multimedia5` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenido_multimedia`
--

INSERT INTO `contenido_multimedia` (`id`, `multimedia`, `multimedia2`, `multimedia3`, `multimedia4`, `multimedia5`) VALUES
(1, '/imagen.png', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id` int(7) NOT NULL,
  `edicion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `producto` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `edicion` int(7) NOT NULL,
  `seccion` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(7) NOT NULL,
  `clave` char(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `verificado` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencimiento` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `clave`, `verificado`, `vencimiento`) VALUES
(1, '$2y$10$giMvM11r0cvk2Y/6htKzhOh96CYCpeVgNLoCx.dxfJ1kwwzEvG9BK', '', '0000-00-00'),
(2, '$2y$10$QYtG81xr.WMbBWJ9ftCTRuSs4vj69BIcEIC/SHwsFFmyqYMOIRdIS', '', '0000-00-00'),
(3, '$2y$10$4r1cklrUXXiup/6jPd8IN.O2GJ87WUGM7fjGRCIh4D.fEHqSoH6JW', '', '0000-00-00'),
(4, '$2y$10$DNtGt9pDp.B.hy8ep.XgV.ZPZCjs9Cn7QhSG.7SoJAE.usc8pDq/a', '', '0000-00-00'),
(5, '$2y$10$HsQUlTgHzte.qu1N4k5b1e4HqmUALonZs6eO0eLpn.Vm7Ooa9eNqu', '', '0000-00-00'),
(6, '$2y$10$5E1XXuTE0UMeZ0oS0EQzRODR6UxwiJICO8BaGklQ9WonL4Xo9UKpK', '', '0000-00-00'),
(7, '$2y$10$kIy0ifst7N159ZsDGKa8RucjPh1G776xYDIIYbwByEsW3.5G5uMMC', '', '0000-00-00'),
(8, '$2y$10$l0u2FmNjc4.T0ePUuAoOoeOy/fZde2ku64N0RZTWokFh7x2wY0zVi', '', '0000-00-00'),
(9, '$2y$10$SaurnfORP7w2hPqhNFtV1uTM.THabU6IWvKTVSGw8nlRtjlhp9Rgy', '', '0000-00-00'),
(10, '$2y$10$VtRw16YauAP9TdtQO8czLeMJ5IYkakHJVxdP542.9p4EizOuagEIu', '', '0000-00-00'),
(11, '$2y$10$kOAi1kyRLhM3lvMrmDxNle7N/lHtZTLazyOygjo5aXUg8gShIZEZy', '', '0000-00-00'),
(12, '$2y$10$DKR4w9AkbTnubthFjLjBdeL2GeVsPr9blP/rsWRmr.VLi9GFggtZS', '', '0000-00-00'),
(13, '$2y$10$GE8oac8mrIgvyzpFNLwvwuQsbOUt3CMv/xE9.oaO8kTscuE3mz31C', '', '0000-00-00'),
(14, '$2y$10$LxdRboEzEOn/yL1TJiv94ulTzAVE8EKuMaxCADmeF/uN6M0KYMEJW', '', '0000-00-00'),
(15, '$2y$10$aLdldzlgWKu0khAJYxWyBOiLNA9jrK1p.UWH0jx8tMGH8HvSpWGgG', '', '0000-00-00'),
(16, '$2y$10$gjUGSo2yJG.euCPdX4vaHOj0xxDDYTL9AARPzczUL3Tlg2Yrvy4QO', '', '0000-00-00'),
(17, '$2y$10$0Uy2QOhYXp5NR70Ie5gkMebOFJEa/9Yz0Rw6MJqvUD8h90KUkcTne', '', '0000-00-00'),
(18, '$2y$10$yfKJnzrpDznGV.u89wPieO91oJRxt8XPQKYS3slxZMGaR.VeEz/M2', '', '0000-00-00'),
(19, '$2y$10$rccXvdcHX7Y6Obptfa3YDOqWwpOLcdVvSbN14SL7BZw89gTDhH9Ka', '', '0000-00-00'),
(20, '$2y$10$xF5jFIoSwMrpu4Akj/DjueCwPneDq3JD8JxTL8jRVGXXD635XPrJS', '', '0000-00-00'),
(21, '$2y$10$2COXU85DdWl2Q8kKtEAHAuFsQJIiPZri8tixeTKP.L34gIVGgK60q', '', '0000-00-00'),
(22, '$2y$10$m6SaZOBajFskKS0EK.7PPeBvL1vXdk7kPFw0HaoLKT.0RzsIEqFyO', '', '0000-00-00'),
(23, '$2y$10$rpMrEtLwfJ2Eo3dUpCgY8uFMNDlFCB1qULI/1PgY4oxTTlPxIy1mK', '', '0000-00-00'),
(24, '$2y$10$GsBym81vA.ZizNhcaIAovuk.boWIjjkMBbffpsMwi55Y7as0BLXUq', '', '0000-00-00'),
(25, '$2y$10$iq/fEdKXmvdmbvVaKks.dOpDjGYaMkn0i.m/oaNH3d0As.H46f6nK', '', '0000-00-00'),
(26, '$2y$10$jAuiVH8dSceYvmxF.0.GLebFQZOUCo388lUgmptngzTfNJJoukVCO', '', '0000-00-00'),
(27, '$2y$10$CIoweA3XoONxDK5fBP2O1OGAG8InolQmpjE6q0K6ZzAfefgdaoz9y', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(7) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'revista'),
(2, 'diario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` int(7) NOT NULL,
  `ubicacion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `role` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `mail`, `password`, `ubicacion`, `role`, `estado`) VALUES
(26, 'jaquinoromero@alumno.unlam.edu.ar', 1, 'aaaaaaaa', 'lector', 0),
(33, 'jannett.aquino2106@gmail.com', 26, 'aaaaa', 'lector', 0),
(34, 'contenidista@contenidista.com', 27, '123asd', 'contenidista', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen` (`imagen`);

--
-- Indices de la tabla `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD KEY `edicion` (`edicion`),
  ADD KEY `seccion` (`seccion`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password` (`password`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`imagen`) REFERENCES `contenido_multimedia` (`id`);

--
-- Filtros para la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD CONSTRAINT `edicion_seccion_ibfk_1` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `edicion_seccion_ibfk_2` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`password`) REFERENCES `passwords` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
