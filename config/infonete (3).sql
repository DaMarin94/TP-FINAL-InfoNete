-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 22:02:20
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `edicion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `usuario_id`, `edicion_id`) VALUES
(21, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `subtitulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `multimedia` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `contenidista` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `subtitulo`, `contenido`, `multimedia`, `estado`, `contenidista`, `latitud`, `longitud`) VALUES
(11, 'El entrenamiento de la Selección Argentina: ovación a Messi y el probable equipo para el último amistoso previo al Mundial de Qatar 2022', 'El capitán fue el más solicitado por los miles de fanáticos que estuvieron en la práctica abierta en Abu Dhabi. El miércoles, los dirigidos por Lionel Scaloni juegan ante Emiratos Árabes Unidos. Mirá ', 'La Selección Argentina empezó el Mundial. Lionel Scaloni reunió a los 14 jugadores con los que contaba para el entrenamiento a puertas abiertas en la asfixiante atmósfera de Abu Dhabi y ahí, en el círculo central del estadio Al-Nahyan, dio inicio a los ensayos mundialistas. En primera fila, escuchando atentamente, estaba el capitán Lionel Messi, que arribó en la mañana de este lunes (la madrugada de la Argentina) luego de jugar el domingo con el París Saint-Germain y que trataba de concentrarse en medio de las ovaciones que el fascinado público emiratí le regalaba sin parar.\r\n\r\nLa Scaloneta, o gran parte de ella, ya se mueve al compás de la Copa del Mundo. Después de tanto esperar. Después de tanto clavo cortado por los lesionados. Después del lamento por la baja de Giovani Lo Celso. Al fin el conjunto nacional se reencuentra en suelo árabe para comenzar a transitar el camino más soñado.', 50, 1, 3, -34.67215942368461, -58.56189638603293),
(12, 'Atentado contra Cristina Kirchner: con un duro escrito, la vicepresidenta recusó a la jueza Capuchetti', 'El mismo día en que el fiscal Luciani cerró la acusación en su contra, la ex presidenta lo compartió en redes sociales, donde volvió a atacar a la magistrada: \"Ni sabe ni quiere investigar\".', 'A través de un duro escrito difundido en sus redes sociales minutos despúes de que el fiscal Diego Luciani terminara su última intervención en el juicio en el que ella está acusada por corrupción, Cristina Kirchner recusó este lunes a la jueza María Eugenia Capuchetti por la supuesta \"inacción\" en la investigación de la causa abierta tras la tentativa de homicidio del pasado 1° de septiembre en la puerta de su departamento en Recoleta.\r\n\r\nDesde su cuenta de la red social Twitter, la vicepresidenta confirmó la presentación realizada este lunes por sus abogados y compartió el escrito en el que detallaron las presuntas anomalías que consideraron que fueron cometidas en el marco de la investigación.  ', 51, 1, 3, -34.672194718138634, -58.56713205803),
(13, 'Más presión sobre las reservas: el Central vendió US$ 100 millones y perdió más de US$ 860 millones en el mes', 'Se trata del segundo registro de ventas más alto del año. La demanda de dólares no cede, a pesar de los mayores controles', 'El Banco Central continúa con su posición vendedora en el mercado de cambios, como una manera de evitar un salto del dólar oficial, ante una demanda que no logra ceder. Luego de haber vendido más de US$ 500 millones la semana pasada, el organismo se desprendió este lunes de US$ 100 millones, con lo que acumula ventas por US$ 863 millones en lo que va del mes.\r\n\r\nEs una marca alta, si se toma en cuenta que en todo noviembre del año pasado, el organismo vendió US$ 900 millones, en un mes que suele ser deficitario para el Central. Pero incluso, en aquel momento, el cepo era mucho mas laxo que el que rige en la actualidad.', 52, 1, 3, -34.67491234593611, -58.56009394157492);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_multimedia`
--

CREATE TABLE `contenido_multimedia` (
  `id` int(11) NOT NULL,
  `imagen1` varchar(150) DEFAULT NULL,
  `imagen2` varchar(150) DEFAULT NULL,
  `imagen3` varchar(150) DEFAULT NULL,
  `audio` varchar(150) DEFAULT NULL,
  `video` varchar(150) DEFAULT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenido_multimedia`
--

INSERT INTO `contenido_multimedia` (`id`, `imagen1`, `imagen2`, `imagen3`, `audio`, `video`, `url`) VALUES
(50, 'rWTrXTFaz_1256x620__2.jpg', '', '', '', '', ''),
(51, '-0t4QxOpB_1256x620__1.jpg', '', '', '', '', ''),
(52, 'wEQ-_71H7_1256x620__1.jpg', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id` int(11) NOT NULL,
  `edicion` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `producto` int(11) NOT NULL,
  `portada` varchar(60) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`id`, `edicion`, `precio`, `producto`, `portada`, `fecha`) VALUES
(1, 'Edicion 43', 700, 1, 'edicion123232.jpg', '2022-11-01 11:22:20'),
(2, 'Edicion 26', 900, 1, 'edicion45434.jpg', '2022-11-13 11:22:20'),
(3, 'Edicion 45', 400, 1, 'edicion12232443.jpg', '2022-11-13 11:22:20'),
(4, 'Edicion 2', 450, 2, 'nacion.750.jpg', '2022-11-13 11:22:20'),
(5, 'Edicion 3', 250, 2, 'CANqr6uU8AAjcsk.jpg', '2022-11-13 11:22:20'),
(6, 'Edicion 4', 580, 2, 'nacion.7450 (1).jpg', '2022-11-13 11:22:20'),
(7, 'Edicion 2', 500, 3, '62aa1caa563bc.png', '2022-11-13 11:22:20'),
(8, 'Edicion 6', 660, 3, '62aa8c7361a7d.jpeg', '2022-11-13 11:22:20'),
(9, 'Edicion 1', 990, 3, '62e395a6a9ecb.png', '2022-11-13 11:22:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `edicion` int(11) NOT NULL,
  `seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion_seccion`
--

INSERT INTO `edicion_seccion` (`edicion`, `seccion`) VALUES
(2, 1),
(2, 4),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion_noticia`
--

CREATE TABLE `edicion_seccion_noticia` (
  `edicion` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion_seccion_noticia`
--

INSERT INTO `edicion_seccion_noticia` (`edicion`, `seccion`, `noticia`) VALUES
(2, 1, 11),
(2, 2, 12),
(2, 4, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Sin publicar'),
(2, 'Publicado'),
(3, 'Revision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `clave` char(60) NOT NULL,
  `verificado` varchar(50) DEFAULT NULL,
  `vencimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `clave`, `verificado`, `vencimiento`) VALUES
(2, '$2y$10$LQWyrRzlLRVhjns.uks84.tmBn/ZL5.S6zxNx7w6d0G1u5yFYADlG', '', '0000-00-00 00:00:00'),
(3, '$2y$10$9ijihR7KDJRXDrAVUfnrHOx7zOXAhF.SQZ2qMiUXLZgN2TAVpZbqS', '', '0000-00-00 00:00:00'),
(4, '$2y$10$Y4lCjNjDoFVOPsrEXuUxPOlAH1bL5oFQpaagFdq9ED.GzxLQZj7BS', '', '0000-00-00 00:00:00'),
(5, '$2y$10$TXIFTVBwjdLZe5tH4ooOSuWLGzxJKSwPz5EIwM5/dl4RjeByPpLbe', '', '0000-00-00 00:00:00'),
(6, '$2y$10$1AowJacGb8KioQ15IMHU0OK1gHDMEAFRarDfn4e.0GMv9oHc70/zO', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `reportes_editor`
--

CREATE TABLE `reportes_editor` (
  `id` int(11) NOT NULL,
  `contenido` int(11) NOT NULL,
  `id_contenidista` int(11) NOT NULL,
  `id_editor` int(11) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
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
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `fechaAdquirido` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaVencimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
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
  `mail` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `mail`, `password`, `estado`, `role`, `latitud`, `longitud`) VALUES
(1, 'admin', 'admin@admin', 2, 1, 4, 0, 0),
(2, 'usuario', 'usuario@usuario.com', 3, 1, 1, 0, 0),
(3, 'contenidista', 'contenidista@contenidista.com', 4, 1, 2, 0, 0),
(4, 'editor', 'editor@editor', 5, 1, 3, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `usuario` (`usuario_id`),
  ADD KEY `edicion` (`edicion_id`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen` (`multimedia`),
  ADD KEY `estado` (`estado`),
  ADD KEY `contenidista` (`contenidista`);

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
-- Indices de la tabla `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contenidista` (`id_contenidista`),
  ADD KEY `id_editor` (`id_editor`),
  ADD KEY `contenido` (`contenido`),
  ADD KEY `estado` (`estado`);

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
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

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
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reportes_editor`
--
ALTER TABLE `reportes_editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `edicion` FOREIGN KEY (`edicion_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`multimedia`) REFERENCES `contenido_multimedia` (`id`),
  ADD CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `contenido_ibfk_3` FOREIGN KEY (`contenidista`) REFERENCES `usuarios` (`id`);

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
-- Filtros para la tabla `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD CONSTRAINT `reportes_editor_ibfk_1` FOREIGN KEY (`id_contenidista`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_2` FOREIGN KEY (`id_editor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_3` FOREIGN KEY (`contenido`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_4` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
