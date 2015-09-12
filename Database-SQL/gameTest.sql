-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 13 Septembre 2015 à 00:24
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `gameTest`
--

-- --------------------------------------------------------

--
-- Structure de la table `PersonnagesTable`
--

CREATE TABLE `PersonnagesTable` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(20) NOT NULL,
  `forcePerso` smallint(3) unsigned NOT NULL,
  `degats` smallint(3) unsigned NOT NULL,
  `niveau` smallint(3) unsigned NOT NULL,
  `experience` smallint(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `PersonnagesTable`
--

INSERT INTO `PersonnagesTable` (`id`, `nom`, `forcePerso`, `degats`, `niveau`, `experience`) VALUES
(1, 'DarkVador', 8, 45, 8, 35),
(2, 'LukeSky', 5, 5, 3, 10),
(3, 'PadawanLittle', 10, 20, 5, 20),
(6, 'YodaBoss', 10, 20, 2, 20),
(11, 'YodaBoss', 5, 0, 1, 1),
(13, 'YodaBoss', 5, 0, 1, 1),
(14, 'YodaBoss', 5, 0, 1, 1),
(15, 'YodaBoss', 5, 0, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `PersonnagesTable`
--
ALTER TABLE `PersonnagesTable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `PersonnagesTable`
--
ALTER TABLE `PersonnagesTable`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;