-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-11-2015 a las 02:05:02
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.9-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `yii-cecv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `cod` varchar(25) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `control` varchar(10) NOT NULL,
  `unidad` varchar(25) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`cod`, `valor`, `descripcion`, `control`, `unidad`, `categoria`) VALUES
('CantLibSel', '2', 'Cantidad de libros que se pueden seleccionar por préstamo ingresado', 'number', '', ''),
('DirWeb', '/GestionCECV', 'Directorio base del sistema (modificar solo admin)', 'textbox', '', ''),
('PrestaMulti', 'no', 'Define si se puede cargar un prestamo nuevo, cuando todavía no existe devolución', 'checkbox', '', ''),
('TPrestaLibro', '9', 'Periodo de tiempo máximo de devolución de material ', 'number', 'Días', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosUser`
--

CREATE TABLE IF NOT EXISTS `DatosUser` (
  `IdUser` int(6) NOT NULL,
  `NombreyApellido` varchar(50) NOT NULL,
  `DNI` varchar(12) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Suspendido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DatosUser`
--

INSERT INTO `DatosUser` (`IdUser`, `NombreyApellido`, `DNI`, `Email`, `Telefono`, `Suspendido`) VALUES
(1, 'Juan Manuel Vasques', '38.270.23', 'JMVaz@hotmail.com', '3456 4545343', 1),
(2, 'Ariel Soza', '23789654', '233@ddd', '23232332', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1440641520),
('m130524_201442_init', 1440641525);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prestamos`
--

CREATE TABLE IF NOT EXISTS `Prestamos` (
  `idPresta` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `IdStock` int(10) NOT NULL,
  `FechaPresta` date NOT NULL,
  `FechaDebT` date NOT NULL,
  `FechaDeb` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Prestamos`
--

INSERT INTO `Prestamos` (`idPresta`, `idUser`, `IdStock`, `FechaPresta`, `FechaDebT`, `FechaDeb`) VALUES
(1, 1, 10, '2015-10-13', '2015-10-20', '2015-11-16'),
(14, 2, 2, '2015-11-16', '2015-11-23', '2015-11-16'),
(15, 2, 2, '2015-11-16', '2015-11-23', '2015-11-17'),
(16, 2, 2, '2015-11-16', '2015-11-23', '2015-11-16'),
(17, 2, 2, '2015-11-16', '2015-11-23', '2015-11-16'),
(18, 2, 5, '2015-11-16', '2015-11-23', '2015-11-17'),
(19, 1, 3, '2015-11-16', '2015-11-23', '2015-11-17'),
(20, 2, 6, '2015-11-16', '2015-11-23', '2015-11-17'),
(21, 1, 3, '2015-11-16', '2015-11-23', '2015-11-17'),
(22, 1, 2, '2015-11-16', '2015-11-23', '2015-11-17'),
(23, 1, 1, '2015-11-16', '2015-11-23', '2015-11-17'),
(24, 1, 2, '2015-11-16', '2015-11-23', '2015-11-17'),
(25, 1, 2, '2015-11-16', '2015-11-23', '2015-11-17'),
(26, 1, 1, '2015-11-16', '2015-11-23', '2015-11-17'),
(27, 1, 1, '2015-11-17', '2015-11-24', '2015-11-17'),
(28, 1, 2, '2015-11-17', '2015-11-24', '2015-11-17'),
(29, 1, 1, '2015-11-17', '2015-11-24', '2015-11-17'),
(30, 1, 2, '2015-11-17', '2015-11-24', '2015-11-17'),
(31, 2, 1, '2015-11-17', '2015-10-24', '2015-11-26'),
(32, 2, 2, '2015-11-17', '2015-11-24', '2015-11-17'),
(33, 1, 1, '2015-11-17', '2015-11-24', '2015-11-17'),
(34, 1, 2, '2015-11-17', '2015-11-24', '2015-11-17'),
(35, 1, 1, '2015-11-17', '2015-11-24', '0000-00-00'),
(36, 1, 2, '2015-11-17', '2015-11-24', '0000-00-00'),
(37, 1, 1, '2015-11-18', '2015-11-27', '0000-00-00'),
(38, 1, 2, '2015-11-18', '2015-11-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangos`
--

CREATE TABLE IF NOT EXISTS `rangos` (
  `rango` int(2) NOT NULL,
  `nombrerango` varchar(12) NOT NULL,
  `editar user` tinyint(1) NOT NULL,
  `agregar user` tinyint(1) NOT NULL,
  `agregar catalogo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rangos`
--

INSERT INTO `rangos` (`rango`, `nombrerango`, `editar user`, `agregar user`, `agregar catalogo`) VALUES
(0, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock`
--

CREATE TABLE IF NOT EXISTS `Stock` (
  `idStock` int(10) NOT NULL,
  `Codigo` varchar(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `Autor` varchar(50) NOT NULL,
  `Cantidad` int(10) NOT NULL,
  `CantidadDisponible` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Stock`
--

INSERT INTO `Stock` (`idStock`, `Codigo`, `Nombre`, `Descripcion`, `Autor`, `Cantidad`, `CantidadDisponible`) VALUES
(1, '5566876764', 'Noriega Super Stars', 'El más exitoso libro de Análisis matemático de todos los tiempos, aquí para que lo disfrutes! :D', 'Arnold Swatchzseneger', 200, 148),
(2, '7767676g', 'Matemática Corporativa I', 'Las oscuras garras del capitalismo nunca encontraron mejor aliado en las matemáticas aprende a robar la plusvalía como un campeón', '', 149, 8),
(3, 'hhjh344', 'La verdad de la milanesa', 'Oculta detrás de un halo de pan rallado se encuentra la verdad, aquello que nunca podrá ser negado', '', 45, 41),
(5, 'hgbj452', 'El agua y el aceite, más allá de la poesia', 'Poesia para cuando uno se aburre y no hay nada mejor para leer', '', 3, 0),
(6, '343455edd', 'Matemática Corporativa II', 'Economía mundial en tiempo de buitres, fino análisis matemático de las antimañas financieras de los paises del "primer mundo".', '', 200, 174),
(7, 'shgh765', 'Revolución Productiva ', 'Allá por la época del 1700 y pico parece que se empezó a generar cambios en las formas de producir, la máquina de vapor y la generadora de humo, grandes inventos de la ciencia cuasi contemporanea', 'Stiven Sigal', 260, 245),
(8, 'jjghgjhgjg', 'De limón y Sal Vodka y mucho más', 'Que sería de la barra sin bebidas fuertes, puedes preparar muchos cocteles con gran porcentaje etílico y hermoso sabor!', 'Cherenkov', 200, 23),
(9, '2353453', 'El gato, universo microscópico', 'El gato está vivo y muerto al mismo tiempo! Descubrelo a través de las 1200 páginas que te ofrece este libro!', 'Schoringer', 100, 90),
(10, '6634', 'Química inorgánica I', 'El primer curso de Química, retirelo yá se agota!!!', 'Jaime', 1000, 998),
(11, '768768', 'Química Inorgánica II', 'Segundo curso de Química ideal para aquellos que aprobaron Química I, Vamós para adelante que se puede!', 'jaime', 1200, 800),
(12, 'sswfsd45', 'Anatomía I', 'La constitución del cuerpo algo complejo un misterio que este libro pretende comenzar a develar', 'Klimovsky', 300, 200),
(13, 'sdfsfw45', 'Química Biológica', 'Metabolismo y la cuestión química, nunca antes mejor explicada', 'Athur Fracis', 200, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` int(2) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rango`, `status`, `created_at`, `updated_at`) VALUES
(2, 'lucho', 'o7m2YowYjj-1MYv_Kl0YdNE5J_UsGu0p', '$2y$13$6Wz7jDuP3Y.Deuo1YV1ELOrNY6/zpUikNcfwAztWHC28iMmyOMTum', NULL, 'lucho@gmaill.com', 0, 10, 1441812643, 1441812643),
(18, 'operador', 'fFhgzh7m5Il0mlzvKSZ3RES6vGiIrwOK', '$2y$13$hASy1x5Nngv36f1Z7h0G0uYGXNYlW.Hu73Q2l1TJRp5RkId76qmUO', NULL, 'aasasas@cbcb.m', 1, 10, 1448859825, 1448859825);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `DatosUser`
--
ALTER TABLE `DatosUser`
  ADD PRIMARY KEY (`IdUser`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD PRIMARY KEY (`idPresta`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `IdStock` (`IdStock`);

--
-- Indices de la tabla `rangos`
--
ALTER TABLE `rangos`
  ADD PRIMARY KEY (`rango`);

--
-- Indices de la tabla `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`idStock`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DatosUser`
--
ALTER TABLE `DatosUser`
  MODIFY `IdUser` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  MODIFY `idPresta` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `Stock`
--
ALTER TABLE `Stock`
  MODIFY `idStock` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD CONSTRAINT `Prestamos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `DatosUser` (`IdUser`),
  ADD CONSTRAINT `Prestamos_ibfk_2` FOREIGN KEY (`IdStock`) REFERENCES `Stock` (`idStock`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
