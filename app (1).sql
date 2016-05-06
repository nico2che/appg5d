-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 06 Mai 2016 à 10:10
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_sport` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `min_participants` int(11) NOT NULL,
  `visibilite` enum('public','prive') NOT NULL,
  `recurrence` enum('occasionnel','quotidien','hebdomadaire','mensuel','annuel') NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupes`
--

INSERT INTO `groupes` (`id`, `titre`, `description`, `id_sport`, `id_club`, `max_participants`, `min_participants`, `visibilite`, `recurrence`, `niveau`) VALUES
(1, 'Competition de tennis', 'Bonjour,\r\n\r\nVoici une description...\r\n\r\nnvsdkn, kenvjnd ,,efveferv !!\r\n', 165, 0, 10, 2, 'public', 'occasionnel', 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_membres`
--

CREATE TABLE `groupes_membres` (
  `id` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupes_membres`
--

INSERT INTO `groupes_membres` (`id`, `id_groupe`, `id_membre`, `type`) VALUES
(1, 1, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes_membres`
--
ALTER TABLE `groupes_membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `groupes_membres`
--
ALTER TABLE `groupes_membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
