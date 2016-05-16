-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 17 Mai 2016 à 00:55
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
-- Structure de la table `aide`
--

CREATE TABLE `aide` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires_clubs`
--

CREATE TABLE `commentaires_clubs` (
  `id` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contacte_message`
--

CREATE TABLE `contacte_message` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `sujet` varchar(256) NOT NULL,
  `contenu` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contacte_message`
--

INSERT INTO `contacte_message` (`id`, `nom`, `email`, `sujet`, `contenu`) VALUES
(5, 'chipon', 'romain.chipon@free.fr', 'test', 'test'),
(6, 'chipon', 'romain.chipon@free.fr', 'test3', 'sqeesdf'),
(7, 'chipon', 'romain.chipon@free.fr', 'test4', 'TESTE'),
(8, 'chipon', 'romain.chipon@free.fr', 'test45', 'dfrhgdsgs');

-- --------------------------------------------------------

--
-- Structure de la table `dates_rencontres`
--

CREATE TABLE `dates_rencontres` (
  `id` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `duree` time NOT NULL,
  `localisation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dates_rencontres`
--

INSERT INTO `dates_rencontres` (`id`, `id_groupe`, `date`, `duree`, `localisation`) VALUES
(1, 1, '2016-05-10 14:15:00', '03:00:00', 'test'),
(2, 1, '2016-05-11 14:15:00', '03:00:00', 'test'),
(3, 1, '2016-05-10 00:00:00', '01:00:00', 'Luxembourg, Paris, France'),
(4, 1, '2016-05-17 00:00:00', '01:00:00', 'Le Branday, Saint-MÃªme-le-Tenu, France');

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE `forum_messages` (
  `id` int(11) NOT NULL,
  `id_sujet` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

CREATE TABLE `forum_sujets` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `type` enum('aide','sport') NOT NULL,
  `id_sport` int(11) NOT NULL,
  `resolu` tinyint(1) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `forum_sujets`
--

INSERT INTO `forum_sujets` (`id`, `id_membre`, `type`, `id_sport`, `resolu`, `titre`, `message`, `date`) VALUES
(1, 1, 'aide', 0, 0, 'edede', 'qrvsfdv', '2016-05-06 11:20:05');

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
(1, 1, 1, 1),
(2, 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
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
  `activite_forum` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `description`, `date_naissance`, `localisation`, `sexe`, `bannis`, `role`, `activite_forum`) VALUES
(1, 'de CHEVIGNE', 'Nicolas', 'nico2che@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', '', '0000-00-00', '', 'homme', 0, 'membre', ''),
(2, 'erjzsdnc', 'nicolas', 'nevÃ @vre.com', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077', '', NULL, NULL, NULL, 0, 'membre', '0'),
(3, 'test', 'test', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', NULL, NULL, NULL, 0, 'membre', '0');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`id`, `nom`, `description`) VALUES
(1, 'Accrobranche\r\n', ''),
(2, 'A&#233;robic\r\n', ''),
(3, 'Agility\r\n', ''),
(4, 'A&#239;kido\r\n', ''),
(5, 'Alpinisme\r\n', ''),
(6, 'Amazone\r\n', ''),
(7, 'Apn&#233;e\r\n', ''),
(8, 'Aquagym\r\n', ''),
(9, 'Athl&#233;tisme\r\n', ''),
(10, 'Attelage\r\n', ''),
(11, 'Autre\r\n', ''),
(12, 'Autres danses\r\n', ''),
(13, 'Aviron\r\n', ''),
(14, 'Badminton\r\n', ''),
(15, 'Balltrap\r\n', ''),
(16, 'Bandy\r\n', ''),
(17, 'Base jump\r\n', ''),
(18, 'Baseball\r\n', ''),
(19, 'Basket Ball\r\n', ''),
(20, 'Beach soccer\r\n', ''),
(21, 'Beach volley\r\n', ''),
(22, 'Billard am&#233;ricain\r\n', ''),
(23, 'Billard anglais (pool)\r\n', ''),
(24, 'Billard fran&#231;ais\r\n', ''),
(25, 'BMX\r\n', ''),
(26, 'Bobsleigh\r\n', ''),
(27, 'Bodyboard\r\n', ''),
(28, 'Bodybuilding\r\n', ''),
(29, 'Boomerang\r\n', ''),
(30, 'Bowling\r\n', ''),
(31, 'Boxe anglaise\r\n', ''),
(32, 'Boxe fran&#231;aise\r\n', ''),
(33, 'Boxe tha&#239;landaise\r\n', ''),
(34, 'Bras de fer\r\n', ''),
(35, 'Bridge\r\n', ''),
(36, 'Canne et Baton\r\n', ''),
(37, 'Cano&#235;-kayak\r\n', ''),
(38, 'Canyonisme\r\n', ''),
(39, 'Capoeira\r\n', ''),
(40, 'Cerf-volant\r\n', ''),
(41, 'Chambara\r\n', ''),
(42, 'Combat libre\r\n', ''),
(43, 'Concours complet\r\n', ''),
(44, 'Course d\'orientation\r\n', ''),
(45, 'Course sur Route\r\n', ''),
(46, 'Cricket\r\n', ''),
(47, 'Curling\r\n', ''),
(48, 'Cyclisme artistique\r\n', ''),
(49, 'Cyclisme sur piste\r\n', ''),
(50, 'Cyclisme sur route\r\n', ''),
(51, 'Cyclotourisme\r\n', ''),
(52, 'Danse actuelle\r\n', ''),
(53, 'Danse classique\r\n', ''),
(54, 'Danse de salon\r\n', ''),
(55, 'Danse moderne\r\n', ''),
(56, 'Dragster\r\n', ''),
(57, 'Dressage\r\n', ''),
(58, 'Echecs\r\n', ''),
(59, 'Endurance &#233;questre\r\n', ''),
(60, 'Enduro\r\n', ''),
(61, 'Equitation carmargue\r\n', ''),
(62, 'Equitation islandaise\r\n', ''),
(63, 'Equitation western\r\n', ''),
(64, 'Escalade\r\n', ''),
(65, 'Escrime\r\n', ''),
(66, 'Fitness\r\n', ''),
(67, 'Fl&#233;chettes\r\n', ''),
(68, 'Footbag\r\n', ''),
(69, 'Football\r\n', ''),
(70, 'Football am&#233;ricain\r\n', ''),
(71, 'Footing / Running\r\n', ''),
(72, 'Force basque\r\n', ''),
(73, 'Formule 1\r\n', ''),
(74, 'Freestyle\r\n', ''),
(75, 'Full-contact\r\n', ''),
(76, 'Golf\r\n', ''),
(77, 'Grappling\r\n', ''),
(78, 'Gym poussette\r\n', ''),
(79, 'Gymnastique artistique\r\n', ''),
(80, 'Gymnastique rythmique\r\n', ''),
(81, 'Halt&#233;rophilie\r\n', ''),
(82, 'Handball\r\n', ''),
(83, 'Hockey\r\n', ''),
(84, 'Hockey sur glace\r\n', ''),
(85, 'Horse ball\r\n', ''),
(86, 'Jet ski\r\n', ''),
(87, 'Jeu de paume\r\n', ''),
(88, 'Jeux de soci&#233;t&#233;\r\n', ''),
(89, 'Jeux vid&#233;os\r\n', ''),
(90, 'Jiu jitsu\r\n', ''),
(91, 'Jorkyball\r\n', ''),
(92, 'Judo\r\n', ''),
(93, 'K-1\r\n', ''),
(94, 'Karat&#233;\r\n', ''),
(95, 'Karting\r\n', ''),
(96, 'Kempo boxing\r\n', ''),
(97, 'Kendo\r\n', ''),
(98, 'Kickboxing\r\n', ''),
(99, 'Kitesurf\r\n', ''),
(100, 'Krav Maga\r\n', ''),
(101, 'Kung fu\r\n', ''),
(102, 'Luge\r\n', ''),
(103, 'Lutte\r\n', ''),
(104, 'Marche\r\n', ''),
(105, 'Marche Nordique\r\n', ''),
(106, 'Molkky\r\n', ''),
(107, 'Moto\r\n', ''),
(108, 'Motocross\r\n', ''),
(109, 'Motoneige\r\n', ''),
(110, 'Musculation\r\n', ''),
(111, 'Nascar\r\n', ''),
(112, 'Natation\r\n', ''),
(113, 'Natation synchronis&#233;e\r\n', ''),
(114, 'Nia\r\n', ''),
(115, 'Paint ball\r\n', ''),
(116, 'Parachutisme\r\n', ''),
(117, 'Parapente\r\n', ''),
(118, 'Patinage artistique\r\n', ''),
(119, 'Patinage de vitesse\r\n', ''),
(120, 'P&#234;che sportive\r\n', ''),
(121, 'Pelote basque\r\n', ''),
(122, 'P&#233;tanque\r\n', ''),
(123, 'Pilates\r\n', ''),
(124, 'Planche &#224; voile\r\n', ''),
(125, 'Plong&#233;e sous-marine\r\n', ''),
(126, 'Poker\r\n', ''),
(127, 'Polo\r\n', ''),
(128, 'Qi Gong\r\n', ''),
(129, 'Qi Gong Sib&#233;rien\r\n', ''),
(130, 'Quad\r\n', ''),
(131, 'Rafting\r\n', ''),
(132, 'Raid nature\r\n', ''),
(133, 'Rallye motoris&#233;\r\n', ''),
(134, 'Randonn&#233;e &#224; cheval\r\n', ''),
(135, 'Randonn&#233;e/marche\r\n', ''),
(136, 'Roller\r\n', ''),
(137, 'Rugby\r\n', ''),
(138, 'Sarbacane\r\n', ''),
(139, 'Saut d\'obstacles\r\n', ''),
(140, 'Self d&#233;fense\r\n', ''),
(141, 'Set-pool\r\n', ''),
(142, 'Skateboard\r\n', ''),
(143, 'Ski\r\n', ''),
(144, 'Ski jo&#235;ring\r\n', ''),
(145, 'SKI nautique\r\n', ''),
(146, 'Skike\r\n', ''),
(147, 'Snooker\r\n', ''),
(148, 'Snowboard\r\n', ''),
(149, 'Snowkite\r\n', ''),
(150, 'Speedminton\r\n', ''),
(151, 'Speed-riding\r\n', ''),
(152, 'Speedway\r\n', ''),
(153, 'Sp&#233;l&#233;ologie\r\n', ''),
(154, 'Squash\r\n', ''),
(155, 'Streetboard\r\n', ''),
(156, 'Street-hockey\r\n', ''),
(157, 'Stretching\r\n', ''),
(158, 'Stunt\r\n', ''),
(159, 'Sumo\r\n', ''),
(160, 'Surf\r\n', ''),
(161, 'Swin Golf\r\n', ''),
(162, 'Taekwondo\r\n', ''),
(163, 'Tai-chi-chuan\r\n', ''),
(164, 'Tarot\r\n', ''),
(165, 'Tennis\r\n', ''),
(166, 'Tennis de table\r\n', ''),
(167, 'Tir\r\n', ''),
(168, 'Tir &#224; la corde\r\n', ''),
(169, 'Tir &#224; l\'arc\r\n', ''),
(170, 'Tourisme &#233;questre\r\n', ''),
(171, 'Trail\r\n', ''),
(172, 'Trampoline\r\n', ''),
(173, 'TREC\r\n', ''),
(174, 'Trial motoris&#233;\r\n', ''),
(175, 'Triathlon\r\n', ''),
(176, 'ULM\r\n', ''),
(177, 'Ultimate\r\n', ''),
(178, 'V&#233;lo tout terrain (VTT)\r\n', ''),
(179, 'Viet-vo-dao\r\n', ''),
(180, 'Voile\r\n', ''),
(181, 'Vol libre\r\n', ''),
(182, 'Volley-ball\r\n', ''),
(183, 'Voltige\r\n', ''),
(184, 'Voltige a&#233;rienne\r\n', ''),
(185, 'Wakeboard\r\n', ''),
(186, 'Water polo\r\n', ''),
(187, 'Yoga\r\n', ''),
(188, 'Yoga Bikram\r\n', ''),
(189, 'Yoseikan Budo', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `aide`
--
ALTER TABLE `aide`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires_clubs`
--
ALTER TABLE `commentaires_clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_club` (`id_club`,`id_membre`);

--
-- Index pour la table `contacte_message`
--
ALTER TABLE `contacte_message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dates_rencontres`
--
ALTER TABLE `dates_rencontres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forum_sujets`
--
ALTER TABLE `forum_sujets`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `aide`
--
ALTER TABLE `aide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commentaires_clubs`
--
ALTER TABLE `commentaires_clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contacte_message`
--
ALTER TABLE `contacte_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `dates_rencontres`
--
ALTER TABLE `dates_rencontres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `forum_sujets`
--
ALTER TABLE `forum_sujets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `groupes_membres`
--
ALTER TABLE `groupes_membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
