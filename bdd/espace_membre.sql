-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 05 Avril 2017 à 09:23
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE IF NOT EXISTS `connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `connexion`
--

INSERT INTO `connexion` (`id`, `nom_user`, `nom_projet`) VALUES
(2, 'Quentin2', 'test'),
(3, 'Aze', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`, `avatar`) VALUES
(1, 'Quentin', 'qg@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', ''),
(2, 'Quentin9', 'a@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', '2.jpg'),
(4, 'Azet', 'az@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', '4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `membres_projet`
--

CREATE TABLE IF NOT EXISTS `membres_projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `membres_projet`
--

INSERT INTO `membres_projet` (`id`, `nom_user`, `nom_projet`) VALUES
(1, 'Aze', 'test4'),
(2, 'Quentin', 'azae'),
(3, 'Quentin9', 'azae'),
(4, 'Azet', 'gui');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `motdepasse2` text NOT NULL,
  `admin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `nom`, `motdepasse2`, `admin`) VALUES
(7, 'test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Quentin2'),
(8, 'test4', '', 'Quentin2'),
(9, 'azae', '', 'Quentin9'),
(10, 'gui', '', 'Azet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
