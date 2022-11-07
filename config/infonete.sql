-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2022 a las 02:50:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

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
  `imagen` int(7) NOT NULL,
  `estado` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `subtitulo`, `contenido`, `imagen`, `estado`) VALUES
(1, 'TEST 1', 'TEST 1', 'TEST 1', 1, 1),
(2, 'TEST 2', 'TEST 2', 'TEST 2', 1, 2);

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
(1, 'imagen.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id` int(7) NOT NULL,
  `edicion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `producto` int(7) NOT NULL,
  `portada` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`id`, `edicion`, `precio`, `producto`, `portada`) VALUES
(1, 'Edicion 43', 700, 1, 'edicion123232.jpg'),
(2, 'Edicion 26', 900, 1, 'edicion45434.jpg'),
(3, 'Edicion 45', 400, 1, 'edicion12232443.jpg'),
(4, 'Edicion 2', 450, 2, 'nacion.750.jpg'),
(5, 'Edicion 3', 250, 2, 'CANqr6uU8AAjcsk.jpg'),
(6, 'Edicion 4', 580, 2, 'nacion.7450 (1).jpg'),
(7, 'Edicion 2', 500, 3, '62aa1caa563bc.png'),
(8, 'Edicion 6', 660, 3, '62aa8c7361a7d.jpeg'),
(9, 'Edicion 1', 990, 3, '62e395a6a9ecb.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `edicion` int(7) NOT NULL,
  `seccion` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion_seccion`
--

INSERT INTO `edicion_seccion` (`edicion`, `seccion`) VALUES
(1, 5),
(1, 1),
(1, 2),
(1, 4),
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion_noticia`
--

CREATE TABLE `edicion_seccion_noticia` (
  `edicion` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(7) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Nuevo'),
(2, 'Verificado'),
(3, 'Revision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(7) NOT NULL,
  `clave` char(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `verificado` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `clave`, `verificado`, `vencimiento`) VALUES
(2, '$2y$10$LQWyrRzlLRVhjns.uks84.tmBn/ZL5.S6zxNx7w6d0G1u5yFYADlG', '', '0000-00-00 00:00:00'),
(3, '$2y$10$9ijihR7KDJRXDrAVUfnrHOx7zOXAhF.SQZ2qMiUXLZgN2TAVpZbqS', '', '0000-00-00 00:00:00'),
(4, '$2y$10$Y4lCjNjDoFVOPsrEXuUxPOlAH1bL5oFQpaagFdq9ED.GzxLQZj7BS', '', '0000-00-00 00:00:00'),
(5, '$2y$10$TXIFTVBwjdLZe5tH4ooOSuWLGzxJKSwPz5EIwM5/dl4RjeByPpLbe', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo` int(7) NOT NULL,
  `portada` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `portada`) VALUES
(1, 'Clarin', 1, 'clarin.jpg'),
(2, 'La nacion', 1, 'lanacion.jpg'),
(3, 'Pronto', 2, 'pronto.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(7) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `descripcion`) VALUES
(1, 'lector'),
(2, 'contenidista'),
(3, 'editor'),
(4, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(7) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `descripcion`) VALUES
(1, 'deporte'),
(2, 'politica'),
(3, 'sociedad'),
(4, 'economia'),
(5, 'cultura');

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
(1, 'diario'),
(2, 'revista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` int(7) NOT NULL,
  `ubicacion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 0,
  `role` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `mail`, `password`, `ubicacion`, `estado`, `role`) VALUES
(1, 'admin', 'admin@admin', 2, '123', 0, 4),
(2, 'usuario', 'usuario@usuario.com', 3, '123', 0, 1),
(3, 'contenidista', 'contenidista@contenidista.com', 4, '123', 0, 2),
(4, 'editor', 'editor@editor', 5, '123', 0, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen` (`imagen`),
  ADD KEY `estado` (`estado`);

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
-- Indices de la tabla `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD KEY `fk_edicion` (`edicion`),
  ADD KEY `fk_seccion` (`seccion`),
  ADD KEY `fk_noticia` (`noticia`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `password` (`password`),
  ADD KEY `role` (`role`);

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
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`imagen`) REFERENCES `contenido_multimedia` (`id`),
  ADD CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

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
-- Filtros para la tabla `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD CONSTRAINT `fk_edicion` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `fk_noticia` FOREIGN KEY (`noticia`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `fk_seccion` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`password`) REFERENCES `passwords` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
