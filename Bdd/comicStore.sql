-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2021 a las 16:22:43
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
DROP DATABASE IF EXISTS comicStore;
CREATE DATABASE  comicStore;
USE  comicStore;
--
-- Base de datos: `comicstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(10) NOT NULL,
  `nombreCategoria` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`) VALUES
(1, 'Accion'),
(2, 'Fantasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(10) NOT NULL,
  `usuarioCliente` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emailCliente` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contrasennaCliente` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigoCookieCliente` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fotoDePerfilCliente` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombreCliente` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidosCliente` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comic`
--

CREATE TABLE `comic` (
  `idComic` int(10) NOT NULL,
  `tituloComic` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precioComic` int(10) NOT NULL,
  `cantidadComic` int(10) NOT NULL,
  `portadaComic` varchar(60) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `idCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `comic`
--

INSERT INTO `comic` (`idComic`, `tituloComic`, `precioComic`, `cantidadComic`, `portadaComic`, `idCategoria`) VALUES
(1, 'AquaMan', 18, 50, '1', 1),
(2, 'Justice League', 25, 50, '2', 2),
(3, 'SpiderMan', 18, 50, '3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(10) NOT NULL,
  `idCliente` int(10) NOT NULL,
  `direccionEnvioPedido` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fechaConfrmacionPedido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `nombreCategoria` (`nombreCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `usuario` (`usuarioCliente`),
  ADD UNIQUE KEY `email` (`emailCliente`);

--
-- Indices de la tabla `comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`idComic`),
  ADD UNIQUE KEY `portadaComic` (`portadaComic`),
  ADD KEY `ForeignKey` (`idCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comic`
--
ALTER TABLE `comic`
  MODIFY `idComic` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `ForeignKey` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
