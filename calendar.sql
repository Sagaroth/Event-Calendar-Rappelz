-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 01 avr. 2019 à 20:51
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `creation_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `creation_time`) VALUES
(6, 'holyblood', '$2y$10$xt5En8ppQnHOJkJ7Za0Aw.0JOLsj.HquIImS67tvXCvSaxxK.uddO', 1, '2019-03-04 16:03:31'),
(10, 'leriana', '$2y$10$rT3FGeWohiE9MLwmWHXFh.YQ0fAYb6z4CU.q2MmPpCPPsZYsnxhSu', 1, '2019-04-01 20:49:02'),
(11, 'nessyloch', '$2y$10$uc7n4uOKJUJqLziOppVag.w.3SFksKvYFv6cm1ckCqIv3zA8Sae8q', 0, '2019-04-01 20:49:46');

-- --------------------------------------------------------

--
-- Structure de la table `usersavalaibles`
--

DROP TABLE IF EXISTS `usersavalaibles`;
CREATE TABLE IF NOT EXISTS `usersavalaibles` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `server` varchar(255) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  KEY `username` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `usersavalaibles`
--

INSERT INTO `usersavalaibles` (`uid`, `user`, `server`, `pass`, `email`, `profile_photo`) VALUES
(41, 'Leriana', 'Lamia', NULL, NULL, NULL),
(42, 'Starman', 'Abhuva', NULL, NULL, NULL),
(43, 'Holyblood', 'Lamia', NULL, NULL, NULL),
(44, 'Nessy', 'Abhuva', NULL, NULL, NULL),
(45, 'Mulhog', 'Autre', NULL, NULL, NULL),
(46, 'Pokegaia', 'Lamia', NULL, NULL, NULL),
(47, 'Sagaroth', 'Les deux serveurs', NULL, NULL, NULL),
(49, 'Holyblood', 'Abhuva', NULL, NULL, NULL),
(53, 'L\'holyblood', 'Lamia', NULL, NULL, NULL),
(77, 'sfdffgfdfdfdfd', 'Les deux serveurs', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
