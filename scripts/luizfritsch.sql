-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Jul-2020 às 16:14
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luizfritsch`
--
CREATE DATABASE IF NOT EXISTS `luizfritsch` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `luizfritsch`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristicas`
--

DROP TABLE IF EXISTS `caracteristicas`;
CREATE TABLE IF NOT EXISTS `caracteristicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(19) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `nome`) VALUES
(1, 'Esporte'),
(2, 'Classico'),
(3, 'Turbo'),
(4, 'Economico'),
(5, 'Para cidade'),
(6, 'Para longas viagens');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristicas_carro`
--

DROP TABLE IF EXISTS `caracteristicas_carro`;
CREATE TABLE IF NOT EXISTS `caracteristicas_carro` (
  `fk_caracteristica` int(11) NOT NULL,
  `fk_carro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caracteristicas_carro`
--

INSERT INTO `caracteristicas_carro` (`fk_caracteristica`, `fk_carro`) VALUES
(3, 52),
(4, 52),
(3, 53),
(6, 53),
(2, 54),
(5, 54),
(3, 56),
(4, 56),
(5, 56),
(3, 57),
(6, 57),
(3, 63),
(5, 63),
(4, 62),
(5, 62),
(4, 64),
(6, 64);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmr_chassi` varchar(17) NOT NULL,
  `fk_modelo` int(11) NOT NULL,
  `ano` int(5) NOT NULL,
  `placa` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carro`
--

INSERT INTO `carro` (`id`, `nmr_chassi`, `fk_modelo`, `ano`, `placa`) VALUES
(52, '7fd8hhf889das5d6g', 5, 2020, 'FCK1956'),
(53, 'jk834h39sa7nb4da8', 10, 2019, 'FCK7983'),
(54, '9sdy8777hd43sa5ui', 9, 2006, 'FJC0256'),
(62, '56fkskfdf5f34k2kf', 16, 2020, 'FKF9572'),
(56, '7666c6c6c6d6d6d6a', 8, 2018, 'FKX9786'),
(63, 'gg87g2789g897gc87', 1, 1810, 'FGF6585'),
(64, '99999999999999999', 11, 9999, '9999999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`) VALUES
(1, 'Ford'),
(2, 'Chevrolet'),
(3, 'Fiat'),
(4, 'Hyundai');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

DROP TABLE IF EXISTS `modelo`;
CREATE TABLE IF NOT EXISTS `modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_marca` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `fk_marca`, `nome`) VALUES
(1, 1, 'mustang'),
(2, 1, 'eco sport'),
(3, 1, 'fusion'),
(4, 1, 'ka'),
(5, 2, 'camaro'),
(6, 2, 'cruze'),
(7, 2, 'trail blazer'),
(8, 2, 'equinox'),
(9, 3, 'doblo'),
(10, 3, 'argo'),
(11, 3, 'mobi'),
(12, 3, 'cronos'),
(13, 4, 'tucson'),
(14, 4, 'santa fe'),
(15, 4, 'ix35'),
(16, 4, 'creta');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
