-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 06 Mai 2016 à 10:07
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
-- Structure de la table `contacte_message`
--

CREATE TABLE IF NOT EXISTS `contacte_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `sujet` varchar(256) NOT NULL,
  `contenu` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `contacte_message`
--

INSERT INTO `contacte_message` (`id`, `nom`, `email`, `sujet`, `contenu`) VALUES
(5, 'chipon', 'romain.chipon@free.fr', 'test', 'test'),
(6, 'chipon', 'romain.chipon@free.fr', 'test3', 'sqeesdf'),
(7, 'chipon', 'romain.chipon@free.fr', 'test4', 'TESTE'),
(8, 'chipon', 'romain.chipon@free.fr', 'test45', 'dfrhgdsgs');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
