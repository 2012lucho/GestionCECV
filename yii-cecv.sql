-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2015 at 02:03 PM
-- Server version: 5.5.43
-- PHP Version: 5.6.7-1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii-cecv`
--

-- --------------------------------------------------------

--
-- Table structure for table `DatosUser`
--

CREATE TABLE IF NOT EXISTS `DatosUser` (
  `IdUser` int(6) NOT NULL AUTO_INCREMENT,
  `NombreyApellido` varchar(50) NOT NULL,
  `DNI` varchar(12) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `DatosUser`
--

INSERT INTO `DatosUser` (`IdUser`, `NombreyApellido`, `DNI`, `Email`, `Telefono`) VALUES
(1, 'Juan Manuel Vasquez', '38.270.23', 'JMVaz@hotmail.com', '3456 4545343');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
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

CREATE TABLE IF NOT EXISTS `Prestamos` (
  `idPresta` int(10) NOT NULL AUTO_INCREMENT,
  `idUser` int(10) NOT NULL,
  `IdStock` int(10) NOT NULL,
  `FechaPresta` date NOT NULL,
  `FechaDebT` date NOT NULL,
  `FechaDeb` date NOT NULL,
  PRIMARY KEY (`idPresta`),
  KEY `idUser` (`idUser`),
  KEY `IdStock` (`IdStock`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rangos`
--

CREATE TABLE IF NOT EXISTS `rangos` (
  `rango` int(2) NOT NULL,
  `editar user` tinyint(1) NOT NULL,
  `agregar user` tinyint(1) NOT NULL,
  `agregar catalogo` tinyint(1) NOT NULL,
  PRIMARY KEY (`rango`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rangos`
--

INSERT INTO `rangos` (`rango`, `editar user`, `agregar user`, `agregar catalogo`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
--

CREATE TABLE IF NOT EXISTS `Stock` (
  `idStock` int(10) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(300) NOT NULL,
  `Autor` varchar(50) NOT NULL,
  `Cantidad` int(10) NOT NULL,
  `CantidadDisponible` int(10) NOT NULL,
  PRIMARY KEY (`idStock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Stock`
--

INSERT INTO `Stock` (`idStock`, `Codigo`, `Nombre`, `Descripcion`, `Autor`, `Cantidad`, `CantidadDisponible`) VALUES
(1, '5566876764', 'Noriega Super Stars', 'El más exitoso libro de Análisis matemático de todos los tiempos, aquí para que lo disfrutes! :D', 'Arnold Swatchzseneger', 200, 150),
(2, '7767676g', 'Matemática Corporativa I', 'Las oscuras garras del capitalismo nunca encontraron mejor aliado en las matemáticas aprende a robar la plusvalía como un campeón', '', 150, 10),
(3, 'hhjh344', 'La verdad de la milanesa', 'Oculta detrás de un halo de pan rallado se encuentra la verdad, aquello que nunca podrá ser negado', '', 45, 43),
(5, 'hgbj452', 'El agua y el aceite, más allá de la poesia', 'Poesia para cuando uno se aburre y no hay nada mejor para leer', '', 3, 0),
(6, '343455edd', 'Matemática Corporativa II', 'Economía mundial en tiempo de buitres, fino análisis matemático de las antimañas financieras de los paises del "primer mundo".', '', 200, 175),
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

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` int(2) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rango`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'D1xtffaWJXWNHUHfm_gfvOIAsEPCWveH', '$2y$13$ERX32qnbx/w1o23XphQAzu.I0KiK7NmkL79haOLMTDjOubUQOIm7a', NULL, 'lucho.2012.tandil@gmail.com', 1, 10, 1440643943, 1440643943),
(2, 'lucho', 'o7m2YowYjj-1MYv_Kl0YdNE5J_UsGu0p', '$2y$13$6Wz7jDuP3Y.Deuo1YV1ELOrNY6/zpUikNcfwAztWHC28iMmyOMTum', NULL, 'lucho@gmaill.com', 0, 10, 1441812643, 1441812643);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD CONSTRAINT `Prestamos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `DatosUser` (`IdUser`),
  ADD CONSTRAINT `Prestamos_ibfk_2` FOREIGN KEY (`IdStock`) REFERENCES `Stock` (`idStock`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
