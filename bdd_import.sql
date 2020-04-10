-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2020 at 04:16 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`id`, `nom`) VALUES
(1, 'L3 MIAGE APP'),
(2, 'M1 MIAGE APP'),
(3, 'M2 MIAGE APP');

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `intitule`, `description`, `status`) VALUES
(69, 'cours IHM 1', 'Pas encore de description pour ce cours', 1),
(70, 'cours IHM 2', 'Pas encore de description pour ce cours', 1),
(71, 'cours IHM 3', 'Pas encore de description pour ce cours', 1),
(72, 'ensemble des cours', 'Pas encore de description pour ce cours', 1),
(77, 'zdq', 'Pas encore de description pour ce cours', 1),
(81, 'test', 'Pas encore de description pour ce cours', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cours_classe`
--

DROP TABLE IF EXISTS `cours_classe`;
CREATE TABLE IF NOT EXISTS `cours_classe` (
  `cours_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  PRIMARY KEY (`cours_id`,`classe_id`),
  KEY `IDX_E007AEFE7ECF78B0` (`cours_id`),
  KEY `IDX_E007AEFE8F5EA509` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cours_classe`
--

INSERT INTO `cours_classe` (`cours_id`, `classe_id`) VALUES
(69, 1),
(77, 1),
(77, 3),
(81, 2);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_211FE8207ECF78B0` (`cours_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `cours_id`, `nom`, `path`, `status`) VALUES
(34, 69, 'cours1.pdf', '/projetL3/uploads/cours1.pdf', 1),
(35, 70, 'cours2.pdf', '/projetL3/uploads/cours2.pdf', 1),
(36, 71, 'cours3.pdf', '/projetL3/uploads/cours3.pdf', 1),
(37, 72, 'cours1.pdf', '/projetL3/uploads/cours1.pdf', 1),
(38, 72, 'cours2.pdf', '/projetL3/uploads/cours2.pdf', 1),
(39, 72, 'cours3.pdf', '/projetL3/uploads/cours3.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `dateCreation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2D602AF3E7927C74` (`email`),
  KEY `IDX_2D602AF38F5EA509` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CEFA2C71E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `email`, `motDePasse`, `prenom`) VALUES
(1, 'Nourhene Ben Rabah', 'tt9814023@gmail.com', 'UzUKMwI9UDkCOA==', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours_classe`
--
ALTER TABLE `cours_classe`
  ADD CONSTRAINT `FK_E007AEFE7ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E007AEFE8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_211FE8207ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`);

--
-- Constraints for table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_2D602AF38F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);

DELIMITER $$
--
-- Events
--
DROP EVENT `suppresion des etudiants`$$
CREATE DEFINER=`root`@`localhost` EVENT `suppresion des etudiants` ON SCHEDULE EVERY 1 YEAR STARTS '2020-08-25 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM ELEVE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
