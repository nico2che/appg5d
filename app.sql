-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 06 Juin 2016 à 08:25
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

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
  `description` text NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `code_postale` int(11) NOT NULL,
  `site` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `approuve` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clubs`
--

INSERT INTO `clubs` (`id`, `nom`, `description`, `localisation`, `code_postale`, `site`, `telephone`, `email`, `departement_id`, `approuve`) VALUES
(1, 'club1', 'test de club', 'crecy-la-chapelle', 77580, 'http://www.google.fr', '01.14.25.86.95', 'bidule.truc@gmail.com', 77, 1),
(3, 'club2', 'test', 'Paris', 75009, '', '01.25.75.23.25', '', 75, 1),
(4, 'club3', 'test club de tennis', 'Crecy-la-Chapelle', 77580, '', '', 'machin.chose@gmail.com', 77, 1),
(5, 'club de foot', 'vfdgdrdsf ', 'quelque part', 48520, '', '', 'zefze.zefz@gmail.fr', 48, 1),
(6, 'nouveau', 'coucou bienvenue', 'partout', 30200, '', '', '', 84, 1),
(7, 'bestclub basket', 'hello', 'je c pas', 87520, '', '', '', 87, 1),
(8, 'kendo academie', 'club de kendo pour tout les niveaux', 'meaux', 77500, '', '', '', 78, 1);

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

--
-- Contenu de la table `commentaires_clubs`
--

INSERT INTO `commentaires_clubs` (`id`, `id_club`, `id_membre`, `commentaire`, `note`) VALUES
(1, 1, 2, 'test', 5),
(2, 1, 3, 'coucou', 3),
(17, 3, 4, 'coucou', 2),
(12, 1, 4, 'coucou', 2),
(18, 4, 4, 'coucou', 2);

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
-- Structure de la table `dates_membres`
--

CREATE TABLE `dates_membres` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dates_membres`
--

INSERT INTO `dates_membres` (`id`, `id_membre`, `id_date`) VALUES
(35, 1, 8),
(39, 1, 13),
(43, 1, 16),
(44, 1, 15),
(45, 1, 17),
(46, 1, 18);

-- --------------------------------------------------------

--
-- Structure de la table `dates_rencontres`
--

CREATE TABLE `dates_rencontres` (
  `id` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `duree` time NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `coordonnees` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dates_rencontres`
--

INSERT INTO `dates_rencontres` (`id`, `id_groupe`, `date`, `duree`, `localisation`, `coordonnees`) VALUES
(14, 1, '2016-05-23 10:00:00', '06:00:00', 'Luxembourg, Paris, France', '48.845577,2.3398520000000644'),
(15, 1, '2016-05-26 14:00:00', '03:00:00', 'Invalides, Paris, France', '48.8593608,2.3138126999999713'),
(16, 3, '2016-06-26 13:26:00', '01:00:00', 'Luxembourg, Paris, France', '48.845577,2.3398520000000644'),
(17, 5, '2016-06-04 14:00:00', '01:00:00', 'Stade de France, Saint-Denis, France', '48.9244592,2.3601644999999962'),
(18, 6, '2016-06-04 14:00:00', '03:00:00', 'club escrime cachan, AllÃ©e Pierre de Montreuil, Cachan, France', '48.7862808,2.3316388000000643'),
(19, 9, '2016-06-15 15:00:00', '03:00:00', 'Karate Club de Maisse, Paris, France', '48.86601729999999,2.391281899999967'),
(20, 9, '2016-06-15 15:00:00', '03:00:00', 'Karate Club de Maisse, Paris, France', '48.86601729999999,2.391281899999967'),
(21, 9, '2016-06-15 15:00:00', '03:00:00', 'Karate Club de Maisse, Paris, France', '48.86601729999999,2.391281899999967');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `departement_id` int(11) NOT NULL,
  `departement_code` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom_uppercase` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom_soundex` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`departement_id`, `departement_code`, `departement_nom`, `departement_nom_uppercase`, `departement_slug`, `departement_nom_soundex`) VALUES
(1, '01', 'Ain', 'AIN', 'ain', 'A500'),
(2, '02', 'Aisne', 'AISNE', 'aisne', 'A250'),
(3, '03', 'Allier', 'ALLIER', 'allier', 'A460'),
(5, '05', 'Hautes-Alpes', 'HAUTES-ALPES', 'hautes-alpes', 'H32412'),
(4, '04', 'Alpes-de-Haute-Provence', 'ALPES-DE-HAUTE-PROVENCE', 'alpes-de-haute-provence', 'A412316152'),
(6, '06', 'Alpes-Maritimes', 'ALPES-MARITIMES', 'alpes-maritimes', 'A41256352'),
(7, '07', 'ArdÃ¨che', 'ARDÃCHE', 'ardeche', 'A632'),
(8, '08', 'Ardennes', 'ARDENNES', 'ardennes', 'A6352'),
(9, '09', 'AriÃ¨ge', 'ARIÃGE', 'ariege', 'A620'),
(10, '10', 'Aube', 'AUBE', 'aube', 'A100'),
(11, '11', 'Aude', 'AUDE', 'aude', 'A300'),
(12, '12', 'Aveyron', 'AVEYRON', 'aveyron', 'A165'),
(13, '13', 'Bouches-du-RhÃ´ne', 'BOUCHES-DU-RHÃNE', 'bouches-du-rhone', 'B2365'),
(14, '14', 'Calvados', 'CALVADOS', 'calvados', 'C4132'),
(15, '15', 'Cantal', 'CANTAL', 'cantal', 'C534'),
(16, '16', 'Charente', 'CHARENTE', 'charente', 'C653'),
(17, '17', 'Charente-Maritime', 'CHARENTE-MARITIME', 'charente-maritime', 'C6535635'),
(18, '18', 'Cher', 'CHER', 'cher', 'C600'),
(19, '19', 'CorrÃ¨ze', 'CORRÃZE', 'correze', 'C620'),
(20, '2a', 'Corse-du-sud', 'CORSE-DU-SUD', 'corse-du-sud', 'C62323'),
(21, '2b', 'Haute-corse', 'HAUTE-CORSE', 'haute-corse', 'H3262'),
(22, '21', 'CÃ´te-d\'or', 'CÃTE-D\'OR', 'cote-dor', 'C360'),
(23, '22', 'CÃ´tes-d\'armor', 'CÃTES-D\'ARMOR', 'cotes-darmor', 'C323656'),
(24, '23', 'Creuse', 'CREUSE', 'creuse', 'C620'),
(25, '24', 'Dordogne', 'DORDOGNE', 'dordogne', 'D6325'),
(26, '25', 'Doubs', 'DOUBS', 'doubs', 'D120'),
(27, '26', 'DrÃ´me', 'DRÃME', 'drome', 'D650'),
(28, '27', 'Eure', 'EURE', 'eure', 'E600'),
(29, '28', 'Eure-et-Loir', 'EURE-ET-LOIR', 'eure-et-loir', 'E6346'),
(30, '29', 'FinistÃ¨re', 'FINISTÃRE', 'finistere', 'F5236'),
(31, '30', 'Gard', 'GARD', 'gard', 'G630'),
(32, '31', 'Haute-Garonne', 'HAUTE-GARONNE', 'haute-garonne', 'H3265'),
(33, '32', 'Gers', 'GERS', 'gers', 'G620'),
(34, '33', 'Gironde', 'GIRONDE', 'gironde', 'G653'),
(35, '34', 'HÃ©rault', 'HÃRAULT', 'herault', 'H643'),
(36, '35', 'Ile-et-Vilaine', 'ILE-ET-VILAINE', 'ile-et-vilaine', 'I43145'),
(37, '36', 'Indre', 'INDRE', 'indre', 'I536'),
(38, '37', 'Indre-et-Loire', 'INDRE-ET-LOIRE', 'indre-et-loire', 'I536346'),
(39, '38', 'IsÃ¨re', 'ISÃRE', 'isere', 'I260'),
(40, '39', 'Jura', 'JURA', 'jura', 'J600'),
(41, '40', 'Landes', 'LANDES', 'landes', 'L532'),
(42, '41', 'Loir-et-Cher', 'LOIR-ET-CHER', 'loir-et-cher', 'L6326'),
(43, '42', 'Loire', 'LOIRE', 'loire', 'L600'),
(44, '43', 'Haute-Loire', 'HAUTE-LOIRE', 'haute-loire', 'H346'),
(45, '44', 'Loire-Atlantique', 'LOIRE-ATLANTIQUE', 'loire-atlantique', 'L634532'),
(46, '45', 'Loiret', 'LOIRET', 'loiret', 'L630'),
(47, '46', 'Lot', 'LOT', 'lot', 'L300'),
(48, '47', 'Lot-et-Garonne', 'LOT-ET-GARONNE', 'lot-et-garonne', 'L3265'),
(49, '48', 'LozÃ¨re', 'LOZÃRE', 'lozere', 'L260'),
(50, '49', 'Maine-et-Loire', 'MAINE-ET-LOIRE', 'maine-et-loire', 'M346'),
(51, '50', 'Manche', 'MANCHE', 'manche', 'M200'),
(52, '51', 'Marne', 'MARNE', 'marne', 'M650'),
(53, '52', 'Haute-Marne', 'HAUTE-MARNE', 'haute-marne', 'H3565'),
(54, '53', 'Mayenne', 'MAYENNE', 'mayenne', 'M000'),
(55, '54', 'Meurthe-et-Moselle', 'MEURTHE-ET-MOSELLE', 'meurthe-et-moselle', 'M63524'),
(56, '55', 'Meuse', 'MEUSE', 'meuse', 'M200'),
(57, '56', 'Morbihan', 'MORBIHAN', 'morbihan', 'M615'),
(58, '57', 'Moselle', 'MOSELLE', 'moselle', 'M240'),
(59, '58', 'NiÃ¨vre', 'NIÃVRE', 'nievre', 'N160'),
(60, '59', 'Nord', 'NORD', 'nord', 'N630'),
(61, '60', 'Oise', 'OISE', 'oise', 'O200'),
(62, '61', 'Orne', 'ORNE', 'orne', 'O650'),
(63, '62', 'Pas-de-Calais', 'PAS-DE-CALAIS', 'pas-de-calais', 'P23242'),
(64, '63', 'Puy-de-DÃ´me', 'PUY-DE-DÃME', 'puy-de-dome', 'P350'),
(65, '64', 'PyrÃ©nÃ©es-Atlantiques', 'PYRÃNÃES-ATLANTIQUES', 'pyrenees-atlantiques', 'P65234532'),
(66, '65', 'Hautes-PyrÃ©nÃ©es', 'HAUTES-PYRÃNÃES', 'hautes-pyrenees', 'H321652'),
(67, '66', 'PyrÃ©nÃ©es-Orientales', 'PYRÃNÃES-ORIENTALES', 'pyrenees-orientales', 'P65265342'),
(68, '67', 'Bas-Rhin', 'BAS-RHIN', 'bas-rhin', 'B265'),
(69, '68', 'Haut-Rhin', 'HAUT-RHIN', 'haut-rhin', 'H365'),
(70, '69', 'RhÃ´ne', 'RHÃNE', 'rhone', 'R500'),
(71, '70', 'Haute-SaÃ´ne', 'HAUTE-SAÃNE', 'haute-saone', 'H325'),
(72, '71', 'SaÃ´ne-et-Loire', 'SAÃNE-ET-LOIRE', 'saone-et-loire', 'S5346'),
(73, '72', 'Sarthe', 'SARTHE', 'sarthe', 'S630'),
(74, '73', 'Savoie', 'SAVOIE', 'savoie', 'S100'),
(75, '74', 'Haute-Savoie', 'HAUTE-SAVOIE', 'haute-savoie', 'H321'),
(76, '75', 'Paris', 'PARIS', 'paris', 'P620'),
(77, '76', 'Seine-Maritime', 'SEINE-MARITIME', 'seine-maritime', 'S5635'),
(78, '77', 'Seine-et-Marne', 'SEINE-ET-MARNE', 'seine-et-marne', 'S53565'),
(79, '78', 'Yvelines', 'YVELINES', 'yvelines', 'Y1452'),
(80, '79', 'Deux-SÃ¨vres', 'DEUX-SÃVRES', 'deux-sevres', 'D2162'),
(81, '80', 'Somme', 'SOMME', 'somme', 'S500'),
(82, '81', 'Tarn', 'TARN', 'tarn', 'T650'),
(83, '82', 'Tarn-et-Garonne', 'TARN-ET-GARONNE', 'tarn-et-garonne', 'T653265'),
(84, '83', 'Var', 'VAR', 'var', 'V600'),
(85, '84', 'Vaucluse', 'VAUCLUSE', 'vaucluse', 'V242'),
(86, '85', 'VendÃ©e', 'VENDÃE', 'vendee', 'V530'),
(87, '86', 'Vienne', 'VIENNE', 'vienne', 'V500'),
(88, '87', 'Haute-Vienne', 'HAUTE-VIENNE', 'haute-vienne', 'H315'),
(89, '88', 'Vosges', 'VOSGES', 'vosges', 'V200'),
(90, '89', 'Yonne', 'YONNE', 'yonne', 'Y500'),
(91, '90', 'Territoire de Belfort', 'TERRITOIRE DE BELFORT', 'territoire-de-belfort', 'T636314163'),
(92, '91', 'Essonne', 'ESSONNE', 'essonne', 'E250'),
(93, '92', 'Hauts-de-Seine', 'HAUTS-DE-SEINE', 'hauts-de-seine', 'H32325'),
(94, '93', 'Seine-Saint-Denis', 'SEINE-SAINT-DENIS', 'seine-saint-denis', 'S525352'),
(95, '94', 'Val-de-Marne', 'VAL-DE-MARNE', 'val-de-marne', 'V43565'),
(96, '95', 'Val-d\'oise', 'VAL-D\'OISE', 'val-doise', 'V432'),
(97, '976', 'Mayotte', 'MAYOTTE', 'mayotte', 'M300'),
(98, '971', 'Guadeloupe', 'GUADELOUPE', 'guadeloupe', 'G341'),
(99, '973', 'Guyane', 'GUYANE', 'guyane', 'G500'),
(100, '972', 'Martinique', 'MARTINIQUE', 'martinique', 'M6352'),
(101, '974', 'RÃ©union', 'RÃUNION', 'reunion', 'R500');

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

--
-- Contenu de la table `forum_messages`
--

INSERT INTO `forum_messages` (`id`, `id_sujet`, `id_membre`, `message`, `date`) VALUES
(5, 2, 1, 's<v', '2016-06-01 05:21:22'),
(7, 12, 2, 'ffuyjh', '2016-06-06 10:01:04');

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

CREATE TABLE `forum_sujets` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `type` enum('aide','sport') NOT NULL,
  `id_sport` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `resolu` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `forum_sujets`
--

INSERT INTO `forum_sujets` (`id`, `id_membre`, `type`, `id_sport`, `titre`, `message`, `date`, `resolu`) VALUES
(2, 1, 'aide', 0, 'Besoin d\'aide !', 'Bonjour,\r\n\r\nJe n\'arrive pas Ã  me connecter.\r\n\r\nMerci', '2016-06-01 05:18:56', 0),
(3, 1, 'aide', 0, 'Comment faire ?', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(4, 6, 'aide', 0, 'Demande de rajout sur le site', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(5, 5, 'aide', 0, 'Je ne peux plus accÃ©der Ã  mon groupe', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(6, 2, 'aide', 0, 'Help', 'Bonjour,\r\n\r\nJe n\'arrive pas Ã  me connecter.\r\n\r\nMerci', '2016-06-01 05:18:56', 0),
(7, 1, 'aide', 0, 'Une idÃ©e pour votre site !', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(8, 4, 'aide', 0, 'Merci beaucoup !', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(9, 6, 'aide', 0, 'Je ne peux plus accÃ©der Ã  mon groupe encore une fois', 'Bonjour \r\n\r\nComment faire ?', '2016-06-01 05:23:25', 0),
(10, 6, 'aide', 0, 'Oups', 'Bonjour,\r\n\r\nJe n\'arrive pas Ã  me connecter.\r\n\r\nMerci', '2016-06-01 05:18:56', 0),
(11, 1, 'aide', 1, 'OÃ¹ aller faire son sport ?', 'Question !', '2016-06-01 05:37:21', 0);

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_sport` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `min_participants` int(11) NOT NULL,
  `visibilite` enum('public','prive') NOT NULL,
  `recurrence` enum('occasionnel','quotidien','hebdomadaire','mensuel','annuel') NOT NULL,
  `niveau` int(11) NOT NULL,
  `tendance` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupes`
--

INSERT INTO `groupes` (`id`, `titre`, `id_departement`, `description`, `id_sport`, `id_club`, `max_participants`, `min_participants`, `visibilite`, `recurrence`, `niveau`, `tendance`) VALUES
(1, 'CompÃ©tition de tennis !', 76, 'Bonjour,\r\nVoici mon groupe de sport', 165, 0, 8, 1, 'public', 'hebdomadaire', 2, 0),
(4, 'Promenade en montagne', 66, 'Description d\'un groupe\r\n\r\nAlpinisme et compagnie', 5, 0, 0, 2, 'public', 'occasionnel', 1, 0),
(3, 'Nom du groupe un peu plus long', 86, 'Description d\'un groupe de hockeyyy', 83, 0, 0, 0, 'public', 'occasionnel', 1, 0),
(5, 'Rencontres foot', 45, 'Bonjour !\r\n\r\nRetrouvons nous tous les samedi aprÃ¨s midi pour jouer au foot\r\n\r\n4v4\r\n5v5\r\n6v6\r\n7v7\r\nou 8v8', 69, 0, 16, 8, 'public', 'hebdomadaire', 2, 0),
(6, 'CompÃ©tition d\'escrime - Participez au nouveau tournoi officiel version 2016 !', 57, 'Bla bla bla\r\n\r\nbla bla bla', 65, 0, 0, 0, 'public', 'quotidien', 3, 0),
(7, 'Dansons !', 32, 'danse danse danse !\r\n\r\n10 max', 55, 0, 10, 0, 'public', 'mensuel', 1, 0),
(8, 'Regroupement de moto', 34, 'Faisons un tour !', 107, 0, 0, 0, 'public', 'occasionnel', 1, 0),
(9, 'Combats de rue', 76, 'Comme chaque annÃ©e, assistez Ã  nos combats de karatÃ© !\r\n\r\nVenez nombreux', 94, 0, 0, 0, 'public', 'annuel', 3, 0),
(10, 'Rendez-vous en ULM !', 30, 'Viens !', 176, 0, 4, 0, 'public', 'occasionnel', 3, 0),
(11, 'AprÃ¨s-midi tandem !', 73, 'Pour les nouveaux !\r\n\r\nOn part tous en voiture !', 116, 0, 5, 0, 'public', 'occasionnel', 1, 0),
(12, 'RÃ©gate amicale d\'aviron', 76, 'Tous niveaux !', 13, 0, 20, 11, 'public', 'occasionnel', 1, 0);

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
(2, 1, 2, 0),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(16, 3, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `description` text,
  `date_naissance` date DEFAULT NULL,
  `id_departement` varchar(255) DEFAULT NULL,
  `sexe` enum('homme','femme','autre') DEFAULT NULL,
  `bannis` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('membre','admin') NOT NULL DEFAULT 'membre'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `nom`, `prenom`, `email`, `mot_de_passe`, `description`, `date_naissance`, `id_departement`, `sexe`, `bannis`, `role`) VALUES
(1, 'nico2che', 'de CHEVIGNE', 'Nicolas', 'nico2che@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'je suis un bolosss', '0000-00-00', '90', 'homme', 0, 'membre'),
(2, 'erjibg', 'erjzsdnc', 'nicolas', 'neve@vre.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Une jolie description avec plein de fleurs\r\n\r\nYoupi', NULL, '17', 'femme', 0, 'membre'),
(3, '', 'chipon', 'romain', 'romain.chipon@free.fr', '42c3bcf92c52146ed7c639a87b5425adda4f0a04', '', NULL, NULL, NULL, 1, 'membre'),
(4, '', 'chipon', 'romain', 'romain.chipon77@free.fr', '231e305b64f8db3bffcb86e45555eb21ad90ab2e', '', NULL, NULL, NULL, 1, 'membre'),
(5, 'pixi', 'Bonnefont', 'Francois-Xavier', 'bonnefontfx@gmail.com', 'c5b2cc208ff1bdf8eba0a171ca431e8d50c71a56', NULL, '1995-12-13', '78000', 'homme', 0, 'admin');

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

-- --------------------------------------------------------

--
-- Structure de la table `sport_club`
--

CREATE TABLE `sport_club` (
  `id_clubs` int(11) NOT NULL,
  `id_sports` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sport_club`
--

INSERT INTO `sport_club` (`id_clubs`, `id_sports`) VALUES
(1, 19),
(3, 19),
(4, 30),
(1, 37),
(3, 10),
(4, 10),
(5, 10);

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
-- Index pour la table `dates_membres`
--
ALTER TABLE `dates_membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dates_rencontres`
--
ALTER TABLE `dates_rencontres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`departement_id`),
  ADD KEY `departement_slug` (`departement_slug`),
  ADD KEY `departement_code` (`departement_code`),
  ADD KEY `departement_nom_soundex` (`departement_nom_soundex`);

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
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
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
-- Index pour la table `sport_club`
--
ALTER TABLE `sport_club`
  ADD KEY `id_clubs` (`id_clubs`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commentaires_clubs`
--
ALTER TABLE `commentaires_clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `contacte_message`
--
ALTER TABLE `contacte_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `dates_membres`
--
ALTER TABLE `dates_membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `dates_rencontres`
--
ALTER TABLE `dates_rencontres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `departement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `forum_sujets`
--
ALTER TABLE `forum_sujets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `groupes_membres`
--
ALTER TABLE `groupes_membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
