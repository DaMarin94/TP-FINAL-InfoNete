-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 03:33 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infonete`
--

-- --------------------------------------------------------

--
-- Table structure for table `contenido`
--

CREATE TABLE `contenido` (
  `id` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` int NOT NULL,
  `estado` int NOT NULL,
  `contenidista` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `subtitulo`, `contenido`, `imagen`, `estado`, `contenidista`) VALUES
(1, 'TEST', 'TEST 1', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 1, 2, 3),
(2, 'TEST 2', 'TEST 2', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 1, 3, 3),
(3, 'Nuevo contenido', 'Nuevo contenido', 'Nuevo contenido test multimedia.', 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `contenido_multimedia`
--

CREATE TABLE `contenido_multimedia` (
  `id` int NOT NULL,
  `imagen1` varchar(150) DEFAULT NULL,
  `imagen2` varchar(150) DEFAULT NULL,
  `imagen3` varchar(150) DEFAULT NULL,
  `audio` varchar(150) DEFAULT NULL,
  `video` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contenido_multimedia`
--

INSERT INTO `contenido_multimedia` (`id`, `imagen1`, `imagen2`, `imagen3`, `audio`, `video`) VALUES
(1, '2cwwEDkT3_1256x620__1.jpg', NULL, NULL, NULL, NULL),
(2, 'clarin.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edicion`
--

CREATE TABLE `edicion` (
  `id` int NOT NULL,
  `edicion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `producto` int NOT NULL,
  `portada` varchar(60) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `edicion`
--

INSERT INTO `edicion` (`id`, `edicion`, `precio`, `producto`, `portada`, `fecha`) VALUES
(1, 'Edicion 43', 700, 1, 'edicion123232.jpg', '2022-11-13 11:22:20'),
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
-- Table structure for table `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `edicion` int NOT NULL,
  `seccion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `edicion_seccion`
--

INSERT INTO `edicion_seccion` (`edicion`, `seccion`) VALUES
(1, 5),
(1, 1),
(1, 2),
(1, 4),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `edicion_seccion_noticia`
--

CREATE TABLE `edicion_seccion_noticia` (
  `edicion` int NOT NULL,
  `seccion` int NOT NULL,
  `noticia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `edicion_seccion_noticia`
--

INSERT INTO `edicion_seccion_noticia` (`edicion`, `seccion`, `noticia`) VALUES
(9, 3, 3),
(9, 3, 3),
(1, 1, 3),
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` int NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Sin publicar'),
(2, 'Publicado'),
(3, 'Revision');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int NOT NULL,
  `clave` char(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `verificado` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `clave`, `verificado`, `vencimiento`) VALUES
(2, '$2y$10$LQWyrRzlLRVhjns.uks84.tmBn/ZL5.S6zxNx7w6d0G1u5yFYADlG', '', '0000-00-00 00:00:00'),
(3, '$2y$10$9ijihR7KDJRXDrAVUfnrHOx7zOXAhF.SQZ2qMiUXLZgN2TAVpZbqS', '', '0000-00-00 00:00:00'),
(4, '$2y$10$Y4lCjNjDoFVOPsrEXuUxPOlAH1bL5oFQpaagFdq9ED.GzxLQZj7BS', '', '0000-00-00 00:00:00'),
(5, '$2y$10$TXIFTVBwjdLZe5tH4ooOSuWLGzxJKSwPz5EIwM5/dl4RjeByPpLbe', '', '0000-00-00 00:00:00'),
(6, '$2y$10$1AowJacGb8KioQ15IMHU0OK1gHDMEAFRarDfn4e.0GMv9oHc70/zO', '', '0000-00-00 00:00:00'),

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo` int NOT NULL,
  `portada` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `portada`) VALUES
(1, 'Clarin', 1, 'clarin.jpg'),
(2, 'La nacion', 1, 'lanacion.jpg'),
(3, 'Pronto', 2, 'pronto.png');

-- --------------------------------------------------------

--
-- Table structure for table `reportes_editor`
--

CREATE TABLE `reportes_editor` (
  `id` int NOT NULL,
  `contenido` int NOT NULL,
  `id_contenidista` int NOT NULL,
  `id_editor` int NOT NULL,
  `comentarios` text,
  `estado` int NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reportes_editor`
--

INSERT INTO `reportes_editor` (`id`, `contenido`, `id_contenidista`, `id_editor`, `comentarios`, `estado`, `fecha`) VALUES
(15, 2, 3, 4, 'revisar puntuaciones                                                                       \r\n                                        \r\n                                        \r\n                                        \r\n                                        ', 3, '2022-11-09 20:18:14'),
(16, 1, 3, 4, 'Finish                  \r\n                                        \r\n                                        \r\n                                        \r\n                                        \r\n                                        \r\n                                        \r\n                                        ', 2, '2022-11-09 20:18:52'),
(17, 3, 3, 4, 'Revisar contenido                              ', 3, '2022-11-09 20:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `descripcion`) VALUES
(1, 'lector'),
(2, 'contenidista'),
(3, 'editor'),
(4, 'administrador');

-- --------------------------------------------------------

--
-- Table structure for table `seccion`
--

CREATE TABLE `seccion` (
  `id` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seccion`
--

INSERT INTO `seccion` (`id`, `descripcion`) VALUES
(1, 'deporte'),
(2, 'politica'),
(3, 'sociedad'),
(4, 'economia'),
(5, 'cultura');

-- --------------------------------------------------------

--
-- Table structure for table `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `fechaAdquirido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaVencimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suscripcion`
--

INSERT INTO `suscripcion` (`id`, `usuario_id`, `producto_id`, `fechaAdquirido`, `fechaVencimiento`) VALUES
(2, 2, 1, '2022-11-01 11:56:42', '2022-11-30 11:56:29'),
(3, 2, 2, '2022-11-08 12:30:30', '2022-11-30 12:30:30'),
(5, 37, 1, '2022-11-01 13:33:38', '2022-11-23 13:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id` int NOT NULL,
  `descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'diario'),
(2, 'revista');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` int NOT NULL,
  `estado` int NOT NULL DEFAULT '0',
  `role` int NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `mail`, `password`, `estado`, `role`, `latitud`, `longitud`) VALUES
(1, 'admin', 'admin@admin', 2, 1, 4, 0, 0),
(2, 'usuario', 'usuario@usuario.com', 3, 1, 1, 0, 0),
(3, 'contenidista', 'contenidista@contenidista.com', 4, 1, 2, 0, 0),
(4, 'editor', 'editor@editor', 5, 1, 3, 0, 0)

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen` (`imagen`),
  ADD KEY `estado` (`estado`),
  ADD KEY `contenidista` (`contenidista`);

--
-- Indexes for table `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto` (`producto`);

--
-- Indexes for table `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD KEY `edicion` (`edicion`),
  ADD KEY `seccion` (`seccion`);

--
-- Indexes for table `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD KEY `fk_edicion` (`edicion`),
  ADD KEY `fk_seccion` (`seccion`),
  ADD KEY `fk_noticia` (`noticia`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- Indexes for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contenidista` (`id_contenidista`),
  ADD KEY `id_editor` (`id_editor`),
  ADD KEY `contenido` (`contenido`),
  ADD KEY `estado` (`estado`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password` (`password`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`imagen`) REFERENCES `contenido_multimedia` (`id`),
  ADD CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `contenido_ibfk_3` FOREIGN KEY (`contenidista`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`);

--
-- Constraints for table `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD CONSTRAINT `edicion_seccion_ibfk_1` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `edicion_seccion_ibfk_2` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Constraints for table `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD CONSTRAINT `fk_edicion` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `fk_noticia` FOREIGN KEY (`noticia`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `fk_seccion` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Constraints for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD CONSTRAINT `reportes_editor_ibfk_1` FOREIGN KEY (`id_contenidista`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_2` FOREIGN KEY (`id_editor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_3` FOREIGN KEY (`contenido`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_4` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Constraints for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`password`) REFERENCES `passwords` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
