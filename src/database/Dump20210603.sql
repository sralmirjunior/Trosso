-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Jun-2021 às 10:00
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trosso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `boards`
--

DROP TABLE IF EXISTS `boards`;
CREATE TABLE IF NOT EXISTS `boards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `boards`
--

INSERT INTO `boards` (`id`, `name`) VALUES
(1, 'quadro teste'),
(3, 'test'),
(4, 'intencao'),
(5, 'test'),
(6, 'test 2'),
(7, 'test 4'),
(8, 'criar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `fk_list_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_list_id` (`fk_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cards`
--

INSERT INTO `cards` (`id`, `description`, `fk_list_id`) VALUES
(5, 'seriooo', 10),
(7, 'heaudhauhdead', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lists`
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `fk_board_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_board_id` (`fk_board_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lists`
--

INSERT INTO `lists` (`id`, `name`, `fk_board_id`) VALUES
(3, 'primeira lista', 3),
(4, 'nova lista', 7),
(10, '1234', 4),
(11, '1234', 8),
(12, '1234', 7),
(13, '13451345', 7),
(14, 'oloco meu', 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_card_id_list_id` FOREIGN KEY (`fk_list_id`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `fk_list_id_board_id` FOREIGN KEY (`fk_board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
