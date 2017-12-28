-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-12-2015 a las 16:46:23
-- Versión del servidor: 5.5.46-0+deb8u1
-- Versión de PHP: 5.6.14-0+deb8u1

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

CREATE TABLE `configuracion` (
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
('TPrestaLibro', '9', 'Periodo de tiempo máximo de devolución de material ', 'number', 'Días', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DatosUser`
--

CREATE TABLE `DatosUser` (
  `IdUser` int(6) NOT NULL,
  `NombreyApellido` varchar(50) NOT NULL,
  `DNI` varchar(12) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Suspendido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
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

CREATE TABLE `Prestamos` (
  `idPresta` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `IdStock` int(10) NOT NULL,
  `FechaPresta` date NOT NULL,
  `FechaDebT` date NOT NULL,
  `FechaDeb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangos`
--

CREATE TABLE `rangos` (
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

CREATE TABLE `Stock` (
  `idStock` int(10) NOT NULL,
  `Codigo` varchar(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `Autor` varchar(50) NOT NULL,
  `Cantidad` int(10) NOT NULL,
  `CantidadDisponible` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rango`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'o7m2YowYjj-1MYv_Kl0YdNE5J_UsGu0p', '$2y$13$3joVDgO4hzXG8GlmKwdUsOJNmVg5A4npRYum4NpZjKrQc1x9BYFf2', NULL, 'email@none.com', 0, 10, 1441812643, 1449690318),
(18, 'operador', 'fFhgzh7m5Il0mlzvKSZ3RES6vGiIrwOK', '$2y$13$W6h85lHP5FCNU52WX/U5ruWIN9sYG.lhKtRcuTRgLaU63RXvGiQKK', NULL, 'email@nodefinido.com', 1, 10, 1448859825, 1449689507);

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
  MODIFY `IdUser` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  MODIFY `idPresta` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Stock`
--
ALTER TABLE `Stock`
  MODIFY `idStock` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD CONSTRAINT `Prestamos_ibfk_4` FOREIGN KEY (`IdStock`) REFERENCES `Stock` (`idStock`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Prestamos_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `DatosUser` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
