-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 29 déc. 2020 à 16:29
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `comicStore`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categoria`
--

CREATE TABLE `Categoria` (
  `idCategoria` int(10) NOT NULL,
  `nombreCategoria` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Cliente`
--

CREATE TABLE `Cliente` (
  `idCliente` int(10) NOT NULL,
  `usuario` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contrasenna` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigoCookie` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fotoDePerfil` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombreCliente` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Comic`
--

CREATE TABLE `Comic` (
  `idComic` int(10) NOT NULL,
  `tituloComic` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `portadaComic` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Pedido`
--

CREATE TABLE `Pedido` (
  `idPedido` int(10) NOT NULL,
  `idCliente` int(10) NOT NULL,
  `direccionEnvio` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fechaConfrmacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `nombreCategoria` (`nombreCategoria`);

--
-- Index pour la table `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `Comic`
--
ALTER TABLE `Comic`
  ADD PRIMARY KEY (`idComic`),
  ADD UNIQUE KEY `portadaComic` (`portadaComic`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Comic`
--
ALTER TABLE `Comic`
  MODIFY `idComic` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
