-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 02 Juin 2016 à 10:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `description` text,
  `date_naissance` date DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `sexe` enum('homme','femme','autre') DEFAULT NULL,
  `bannis` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('membre','admin') NOT NULL DEFAULT 'membre',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `nom`, `prenom`, `email`, `mot_de_passe`, `description`, `date_naissance`, `localisation`, `sexe`, `bannis`, `role`) VALUES
(1, '', 'de CHEVIGNE', 'Nicolas', 'nico2che@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', '', '0000-00-00', '', 'homme', 0, 'membre'),
(2, '', 'erjzsdnc', 'nicolas', 'nevÃ @vre.com', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077', '', NULL, NULL, NULL, 0, 'membre'),
(3, '', 'chipon', 'romain', 'romain.chipon@free.fr', '42c3bcf92c52146ed7c639a87b5425adda4f0a04', '', NULL, NULL, NULL, 0, 'membre'),
(4, '', 'chipon', 'romain', 'romain.chipon77@free.fr', '231e305b64f8db3bffcb86e45555eb21ad90ab2e', '', NULL, NULL, NULL, 0, 'membre'),
(5, 'pixi', 'Bonnefont', 'Francois-Xavier', 'bonnefontfx@gmail.com', 'fxb', NULL, '1995-12-13', '78000', 'homme', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
