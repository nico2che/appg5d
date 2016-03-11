-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 11 Mars 2016 à 18:09
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

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
-- Structure de la table `aide`
--

CREATE TABLE IF NOT EXISTS `aide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires_clubs`
--

CREATE TABLE IF NOT EXISTS `commentaires_clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_club` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_club` (`id_club`,`id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dates_rencontres`
--

CREATE TABLE IF NOT EXISTS `dates_rencontres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_groupe` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `duree` time NOT NULL,
  `localisation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE IF NOT EXISTS `forum_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sujet` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

CREATE TABLE IF NOT EXISTS `forum_sujets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `type` enum('aide','sport') NOT NULL,
  `id_sport` int(11) NOT NULL,
  `resolu` tinyint(1) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_sport` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `min_participants` int(11) NOT NULL,
  `visibilite` enum('public','prive') NOT NULL,
  `recurrence` enum('occasionnel','quotidien','hebdomadaire','mensuel','annuel') NOT NULL,
  `niveau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_naissance` date NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `sexe` enum('homme','femme','autre') NOT NULL,
  `bannis` tinyint(1) NOT NULL,
  `role` enum('membre','admin') NOT NULL,
  `activite_forum` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `description`, `date_naissance`, `localisation`, `sexe`, `bannis`, `role`, `activite_forum`) VALUES
(1, 'de chevigne', 'nicolas', 'nico2che@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', '', '0000-00-00', '', 'homme', 0, 'membre', '');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
