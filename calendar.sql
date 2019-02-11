-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 fév. 2019 à 16:42
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `calendar`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `organisateur` varchar(255) NOT NULL,
  `orgaavailable` varchar(255) NOT NULL,
  `donator` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `creation_time` varchar(255) NOT NULL,
  `md5_checksum` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `organisateur`, `orgaavailable`, `donator`, `color`, `start`, `end`, `creation_time`, `md5_checksum`) VALUES
(58, 'Holytest', 'qsdfqfqsf', '', '', '', '', '2019-02-13 10:00:00', '2019-02-13 10:30:00', '2019-02-11 16:42:18', '921ed95109e81974b295776102051315');

-- --------------------------------------------------------

--
-- Structure de la table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `md5_checksum` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `upload_time`, `md5_checksum`) VALUES
(55, 'testÃ‰lÃ©ments envoyÃ©s - Gael.Potin@ext.saint-gobain.com - Microsoft Outlook.jpg', '2019-02-11 16:42:18', '921ed95109e81974b295776102051315'),
(56, 'test1024px-Octicons-mark-github.svg.png', '2019-02-11 16:42:18', '921ed95109e81974b295776102051315'),
(57, 'testDCIM15478.jpg', '2019-02-11 16:42:18', '921ed95109e81974b295776102051315'),
(58, 'testÃ‰lÃ©ments envoyÃ©s - Gael.Potin@ext.saint-gobain.com - Microsoft Outlook_2.jpg', '2019-02-11 16:42:18', '921ed95109e81974b295776102051315');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `server` varchar(255) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  KEY `username` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`uid`, `user`, `server`, `pass`, `email`, `profile_photo`) VALUES
(41, 'Leriana', 'Lamia', NULL, NULL, NULL),
(42, 'Starman', 'Abhuva', NULL, NULL, NULL),
(43, 'Holyblood', 'Lamia', NULL, NULL, NULL),
(44, 'Nessy', 'Abhuva', NULL, NULL, NULL),
(45, 'Mulhog', 'Autre', NULL, NULL, NULL),
(46, 'Pokegaia', 'Lamia', NULL, NULL, NULL),
(47, 'Sagaroth', 'Les deux serveurs', NULL, NULL, NULL),
(49, 'Holyblood', 'Abhuva', NULL, NULL, NULL),
(53, 'L\'holyblood', 'Lamia', NULL, NULL, NULL),
(54, 'sfdfd', 'Lamia', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
