-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 05 Avril 2017 à 09:36
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
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`) VALUES
(1, 'yao', 'guanyaoxie@gmail.com', '1e72bffe225fd7e4429d18db78433280e2780d25'),
(2, 'd', 'd@toto.fr', '44e42e127470fbabfa4fedcd415ad34605d539a9'),
(3, 'de', 'd@toto.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(4, 'de', 'd@toto.comdd', '9c969ddf454079e3d439973bbab63ea6233e4087'),
(5, 'def', 'd@toto.comddf', 'f6949a8c7d5b90b4a698660bbfb9431503fbb995'),
(6, '1', '1@1.fr', '356a192b7913b04c54574d18c28d46e6395428ab'),
(7, 'isma', 'isma@gmail.com', '482eb9fcbff61e68be14a22327c3a35121da901f'),
(8, 'toto', 'toto@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(9, 'ismael', 'ismael@gmail.com', '482eb9fcbff61e68be14a22327c3a35121da901f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
