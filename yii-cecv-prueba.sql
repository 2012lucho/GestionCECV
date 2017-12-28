-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2017 at 03:47 PM
-- Server version: 5.7.17-0ubuntu1
-- PHP Version: 7.0.15-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii-cecv`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
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
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`cod`, `valor`, `descripcion`, `control`, `unidad`, `categoria`) VALUES
('CantLibSel', '2', 'Cantidad de libros que se pueden seleccionar por préstamo ingresado', 'number', '', ''),
('TPrestaLibro', '9', 'Periodo de tiempo máximo de devolución de material ', 'number', 'Días', '');

-- --------------------------------------------------------

--
-- Table structure for table `DatosUser`
--

CREATE TABLE `DatosUser` (
  `IdUser` int(6) NOT NULL,
  `NombreyApellido` varchar(50) NOT NULL,
  `DNI` varchar(12) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Suspendido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DatosUser`
--

INSERT INTO `DatosUser` (`IdUser`, `NombreyApellido`, `DNI`, `Email`, `Telefono`, `Suspendido`) VALUES
(2, 'Ariel Soza', '23789654', '233@ddd', '23232332', 0),
(3, 'Jazmin Rosé', '34556456', 'jazmin@gmail.com', '234 4556 4567', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1440641520),
('m130524_201442_init', 1440641525);

-- --------------------------------------------------------

--
-- Table structure for table `Prestamos`
--

CREATE TABLE `Prestamos` (
  `idPresta` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `IdStock` int(10) NOT NULL,
  `FechaPresta` date DEFAULT NULL,
  `FechaDebT` date DEFAULT NULL,
  `FechaDeb` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Prestamos`
--

INSERT INTO `Prestamos` (`idPresta`, `idUser`, `IdStock`, `FechaPresta`, `FechaDebT`, `FechaDeb`) VALUES
(1, 2, 1, '2017-12-28', '2018-01-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rangos`
--

CREATE TABLE `rangos` (
  `rango` int(2) NOT NULL,
  `nombrerango` varchar(12) NOT NULL,
  `editar user` tinyint(1) NOT NULL,
  `agregar user` tinyint(1) NOT NULL,
  `agregar catalogo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rangos`
--

INSERT INTO `rangos` (`rango`, `nombrerango`, `editar user`, `agregar user`, `agregar catalogo`) VALUES
(0, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
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

--
-- Dumping data for table `Stock`
--

INSERT INTO `Stock` (`idStock`, `Codigo`, `Nombre`, `Descripcion`, `Autor`, `Cantidad`, `CantidadDisponible`) VALUES
(1, '5566876764', 'Noriega Super Stars', 'El más exitoso libro de Análisis matemático de todos los tiempos, aquí para que lo disfrutes! :D', 'Arnold Swatchzseneger', 202, 145),
(2, '7767676g', 'Matemática Corporativa I', 'Las oscuras garras del capitalismo nunca encontraron mejor aliado en las matemáticas aprende a robar la plusvalía como un campeón', '', 149, 8),
(3, 'hhjh344', 'La verdad de la milanesa', 'Oculta detrás de un halo de pan rallado se encuentra la verdad, aquello que nunca podrá ser negado', '', 45, 41),
(5, 'hgbj452', 'El agua y el aceite, más allá de la poesia', 'Poesia para cuando uno se aburre y no hay nada mejor para leer', '', 3, 0),
(6, '343455edd', 'Matemática Corporativa II', 'Economía mundial en tiempo de buitres, fino análisis matemático de las antimañas financieras de los paises del \"primer mundo\".', '', 200, 174),
(7, 'shgh765', 'Revolución Productiva ', 'Allá por la época del 1700 y pico parece que se empezó a generar cambios en las formas de producir, la máquina de vapor y la generadora de humo, grandes inventos de la ciencia cuasi contemporanea', 'Stiven Sigal', 260, 245),
(8, 'jjghgjhgjg', 'De limón y Sal Vodka y mucho más', 'Que sería de la barra sin bebidas fuertes, puedes preparar muchos cocteles con gran porcentaje etílico y hermoso sabor!', 'Cherenkov', 200, 23),
(9, '2353453', 'El gato, universo microscópico', 'El gato está vivo y muerto al mismo tiempo! Descubrelo a través de las 1200 páginas que te ofrece este libro!', 'Schoringer', 100, 90),
(10, '6634', 'Química inorgánica I', 'El primer curso de Química, retirelo yá se agota!!!', 'Jaime', 1000, 998),
(11, '768768', 'Química Inorgánica II', 'Segundo curso de Química ideal para aquellos que aprobaron Química I, Vamós para adelante que se puede!', 'jaime', 1200, 800),
(12, 'sswfsd45', 'Anatomía I', 'La constitución del cuerpo algo complejo un misterio que este libro pretende comenzar a develar', 'Klimovsky', 300, 200),
(13, 'sdfsfw45', 'Química Biológica', 'Metabolismo y la cuestión química, nunca antes mejor explicada', 'Athur Fracis', 200, 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rango`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'HvGxeeGtLOoFgeCwYVvJn_l7CPoRKyGS', '$2y$13$X8OGSVZcDSfht42dGscKFOk1v8jOiCX6UO1SJUxVcxqsvk15Yy5UO', NULL, 'admin@coodesoft.com.ar', 0, 10, 1514470876, 1514470876),
(2, 'operador', 'iRWkqsj7V0XIz2ybdcDYTj4kInZwjijR', '$2y$13$a/hCxT.b9bbaVZPBhEYrse.RE9IUgkxkDd/utiINZuBBmndUAKjn2', NULL, 'operador@coodesoft.com.ar', 1, 10, 1514477523, 1514477523);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `DatosUser`
--
ALTER TABLE `DatosUser`
  ADD PRIMARY KEY (`IdUser`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD PRIMARY KEY (`idPresta`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `IdStock` (`IdStock`);

--
-- Indexes for table `rangos`
--
ALTER TABLE `rangos`
  ADD PRIMARY KEY (`rango`);

--
-- Indexes for table `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`idStock`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DatosUser`
--
ALTER TABLE `DatosUser`
  MODIFY `IdUser` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Prestamos`
--
ALTER TABLE `Prestamos`
  MODIFY `idPresta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Stock`
--
ALTER TABLE `Stock`
  MODIFY `idStock` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD CONSTRAINT `Prestamos_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `DatosUser` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Prestamos_ibfk_4` FOREIGN KEY (`IdStock`) REFERENCES `Stock` (`idStock`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
