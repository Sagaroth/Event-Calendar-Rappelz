-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 12 mars 2019 à 15:47
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
CREATE DATABASE IF NOT EXISTS `calendar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `calendar`;

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

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `organisateur`, `orgaavailable`, `donator`, `color`, `start`, `end`, `creation_time`, `md5_checksum`) VALUES
(12, 'Event de Nessy 1', '', 'Nessyloch', '', '', '#f83f90', '2019-03-06 00:00:00', '2019-03-07 00:00:00', '2019-03-12 14:21:39', '839ab5c63e2d5a9a4f21db785c9adff0'),
(13, 'Event de Nessy 2', '', 'Nessyloch', '', '', '#f14afb', '2019-03-07 00:00:00', '2019-03-08 00:00:00', '2019-03-12 14:21:48', 'aa2b23f5352c62ecc9b54279f7d3f17c'),
(14, 'Event d\'Holyblood 1', '', 'Holyblood', '', '', '#43aaf8', '2019-03-08 00:00:00', '2019-03-09 00:00:00', '2019-03-12 14:22:18', 'f9541c90f4bd96b4755177c14f61028d'),
(15, 'Event d\'Holyblood 2', '', 'Holyblood', '', '', '#f83f90', '2019-03-09 00:00:00', '2019-03-10 00:00:00', '2019-03-12 14:22:32', '20578abcdf28df4dfa6cf71f5ba0ec42'),
(16, 'Event de Leriana', '', 'Leriana', '', '', '#66bb6a', '2019-03-05 00:00:00', '2019-03-06 00:00:00', '2019-03-12 15:17:17', '39867b629957f821955b4e86f255e505');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `creation_time`) VALUES
(6, 'holyblood', 'bbf9061ba254329ba5a28b7c79628c1d', 1, '2019-03-04 16:03:31'),
(7, 'Leriana', 'bbf9061ba254329ba5a28b7c79628c1d', 1, '2019-03-08 15:32:25'),
(8, 'Nessyloch', 'bbf9061ba254329ba5a28b7c79628c1d', 0, '2019-03-08 15:46:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

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
