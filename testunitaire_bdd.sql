-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 07:39 PM
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
CREATE DATABASE IF NOT EXISTS `testunitaire` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testunitaire`;

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
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `intitule`, `description`, `status`) VALUES
(69, 'cours IHM 1', 'Ceci est le premiere cours d\'IHM', 1),
(70, 'cours IHM 2', 'Pas encore de description pour ce cours', 1),
(71, 'cours IHM 3', 'Pas encore de description pour ce cours', 1),
(72, 'ensemble des cours', 'Pas encore de description pour ce cours', 1),
(77, 'zdq', 'Pas encore de description pour ce cours', 1);

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
(77, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `email`, `motDePasse`, `prenom`, `classe_id`, `dateCreation`) VALUES
(206, 'Gudin', 'mickaelgudin@gmail.com', 'AGIMPVViCnxebw==', 'Mickael', 1, '2020-04-13 14:02:29');

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
(1, 'Ben Rabah', 'tt9814023@gmail.com', 'BGIPNlFuVD0AOg==', 'Nourhene');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `appreciation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5C7EA6A5853CD175` (`quiz_id`),
  KEY `IDX_5C7EA6A5A6CC7B2` (`eleve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `quiz_id`, `date`, `appreciation`, `note`, `eleve_id`) VALUES
(18, 1, '2020-04-13 14:34:03', NULL, '1/2', 206),
(21, NULL, '2020-04-18 01:50:39', NULL, '0/0', 206);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `intitule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F812B18853CD175` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `intitule`) VALUES
(1, 1, 'Quelle library a remplacé JavaFX a t-il remplacé ?'),
(2, 1, 'Quelle IDE est préférable pour JavaFX ?'),
(20, 11, 'question1'),
(21, 11, 'question2');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_42055AC6C6E55B5` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `nom`) VALUES
(1, 'QCM1'),
(11, 'quiz1');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_classe`
--

DROP TABLE IF EXISTS `quiz_classe`;
CREATE TABLE IF NOT EXISTS `quiz_classe` (
  `classe_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  PRIMARY KEY (`quiz_id`,`classe_id`),
  KEY `IDX_62C34FCF8F5EA509` (`classe_id`),
  KEY `IDX_62C34FCF853CD175` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quiz_classe`
--

INSERT INTO `quiz_classe` (`classe_id`, `quiz_id`) VALUES
(1, 1),
(1, 11),
(2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estVrai` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_900BE75B1E27F6BF` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id`, `question_id`, `contenu`, `estVrai`) VALUES
(13, 1, 'AWT', 1),
(14, 1, 'SWING', 1),
(15, 1, 'Je ne sais pas', 0),
(16, 2, 'Eclipse', 0),
(17, 2, 'NetBeans', 1),
(18, 2, 'Tous', 0),
(52, 20, 'reponse1', 0),
(53, 20, 'reponse2', 1),
(54, 20, 'reponse3', 1),
(55, 21, 'reponse 2 1', 0),
(56, 21, 'reponse 2 2', 1);

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

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `FK_5C7EA6A5853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_5C7EA6A5A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_4F812B18853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `quiz_classe`
--
ALTER TABLE `quiz_classe`
  ADD CONSTRAINT `FK_62C34FCF853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_62C34FCF8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_900BE75B1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

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
