-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 22 mars 2019 à 15:35
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `ID` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`ID`, `message`) VALUES
('jean', 'Je vais creer un monstre salut cest mathieu sevilla je teste 3 messages'),
('jean', 'Je vais creer un monstre salut cest mathieu sevilla je teste 3 messages'),
('jean', 'Je vais creer un monstre salut cest mathieu sevilla je teste 3 messages'),
('jean', 'salut ca va ?'),
('jean', 'salut ca va ?'),
('jean', 'salut ca va ?'),
('jean', 'salut'),
('admin', 'yo'),
('admin', 'de'),
('admin', 'de'),
('', 'de'),
('', 'salut'),
('', 'salut'),
('jean', 'salut !\r\n'),
('admin', 'salut!'),
('jean', 'yooo');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `TITLE` text NOT NULL,
  `BODY` text NOT NULL,
  `CONTENT` text NOT NULL,
  `TYPE` int(11) NOT NULL,
  `ID_game` int(11) NOT NULL,
  `reponse` varchar(40) NOT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`TITLE`, `BODY`, `CONTENT`, `TYPE`, `ID_game`, `reponse`, `image`) VALUES
('Introduction', 'Ceci est l\'explication de l\'énigme, Blablablablanla', '<img src = \'test.png\'>', 0, 0, 'lol', ''),
('ENIGME 2', 'body de lenigme 2', '<img href = \'salut\'>', 0, 1, 'salut', '<img ede >'),
('salut', 'eniiiiiigme', 'frf', 0, 3, 'ouuuui', 'nooooon'),
('salut', 'eniiiiiigme', 'frf', 0, 2, 'ouuuui', 'nooooon'),
('salut', 'eniiiiiigme', 'frf', 0, 4, 'ouuuui', 'nooooon');

-- --------------------------------------------------------

--
-- Structure de la table `game_radio`
--

CREATE TABLE `game_radio` (
  `ID_game` text NOT NULL,
  `radio1` varchar(20) NOT NULL,
  `radio2` varchar(20) NOT NULL,
  `radio3` varchar(20) NOT NULL,
  `radio4` varchar(20) NOT NULL,
  `radio5` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `game_select`
--

CREATE TABLE `game_select` (
  `ID_game` int(11) NOT NULL,
  `select1` varchar(40) NOT NULL,
  `select2` varchar(40) NOT NULL,
  `select3` varchar(40) NOT NULL,
  `select4` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `scores`
--

CREATE TABLE `scores` (
  `ID` varchar(20) NOT NULL,
  `progression` int(11) NOT NULL,
  `time` time NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `scores`
--

INSERT INTO `scores` (`ID`, `progression`, `time`, `points`) VALUES
('jean', 1, '00:00:00', 0),
('admin', 0, '00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `ID` varchar(20) NOT NULL,
  `joueur1` varchar(20) NOT NULL,
  `joueur2` varchar(20) NOT NULL,
  `joueur3` varchar(20) NOT NULL,
  `joueur4` varchar(20) NOT NULL,
  `joueur5` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`ID`, `joueur1`, `joueur2`, `joueur3`, `joueur4`, `joueur5`) VALUES
('jean', 'de', 'dede', '', '', ''),
('admin', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` varchar(20) NOT NULL,
  `PASSWORD` text NOT NULL,
  `EMAIL` text NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  `HELP` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `PASSWORD`, `EMAIL`, `ADMIN`, `HELP`) VALUES
('admin', 'admin', 'admin@admin', 1, 0),
('jean', 'crunch', 'jean@salut', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
