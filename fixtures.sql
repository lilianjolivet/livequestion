-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 05 Juin 2020 à 22:13
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `live_question`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `Id_amis` int(11) NOT NULL,
  `Profil_demande` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Profil_reception` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Demande_amis` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`Id_amis`, `Profil_demande`, `Profil_reception`, `Demande_amis`) VALUES
(5, 'laura', 'lucas', 0),
(6, 'lucas', 'asuka', 0),
(13, 'laura', 'asuka', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `Id_categorie` int(11) NOT NULL,
  `Libelle_categorie` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`Id_categorie`, `Libelle_categorie`) VALUES
(1, 'informatique'),
(2, 'cinema'),
(3, 'jeux video');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `Id_profil` int(11) NOT NULL,
  `Pseudo_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Mail_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `MotDePasse_profil` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Genre_profil` varchar(50) CHARACTER SET latin1 NOT NULL,
  `#Id_role` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`Id_profil`, `Pseudo_profil`, `Mail_profil`, `MotDePasse_profil`, `Genre_profil`, `#Id_role`, `avatar`) VALUES
(15, 'lucas', 'lucas@hotmail.fr', '$2y$10$vlLk/Fd6gQJbLnZa1vicAuPWaJM3EFbC5DHfh2b1wzsoah4Ci6jQi', 'male', 2, '15.jpg'),
(22, 'laura', 'zffzefzef@zfzef.fr', '$2y$10$uqkArEXYUWNnbo5fphSw5.hF/wsQapltVWCjAu.gOtQ3kkt8zG7ty', 'femelle', 1, 'default.jpg'),
(24, 'asuka', 'aazeaz', '$2y$10$xNdQOxRrvUIZ79PgHrMx5.VAQc79MGU/ahauVSsgqjdzvwSX9EyQW', 'femelle', 1, '24.png');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `Id_question` int(11) NOT NULL,
  `Titre_question` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Date_creation_question` datetime DEFAULT NULL,
  `#Id_profil` int(11) DEFAULT NULL,
  `#Id_categorie` int(11) DEFAULT NULL,
  `unique_key` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`Id_question`, `Titre_question`, `Date_creation_question`, `#Id_profil`, `#Id_categorie`, `unique_key`) VALUES
(96, 'wesh ', '2020-06-03 11:54:30', 15, 1, '5ed7735618016'),
(97, 'les gars', '2020-06-03 11:54:37', 15, 1, '5ed7735d2b8ac');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `Id_reponse` int(11) NOT NULL,
  `Contenu_reponse` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Date_reponse` datetime NOT NULL,
  `#Id_profil` int(11) DEFAULT NULL,
  `#Id_question` int(11) NOT NULL,
  `#unique_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `Id_role` int(11) NOT NULL,
  `Libelle_role` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`Id_role`, `Libelle_role`) VALUES
(1, 'membre'),
(2, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `Id_vote` int(11) NOT NULL,
  `Action_vote` int(11) NOT NULL,
  `#Id_question` int(11) NOT NULL,
  `#Id_profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`Id_amis`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Id_categorie`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`Id_profil`),
  ADD KEY `#Id_role` (`#Id_role`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Id_question`),
  ADD KEY `#Id_profil` (`#Id_profil`),
  ADD KEY `#Id_categorie` (`#Id_categorie`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`Id_reponse`),
  ADD KEY `#Id_profil` (`#Id_profil`),
  ADD KEY `#Id_question` (`#Id_question`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id_role`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`Id_vote`),
  ADD KEY `#Id_question` (`#Id_question`),
  ADD KEY `#Id_profil` (`#Id_profil`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `Id_amis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `Id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `Id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `Id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `Id_reponse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `Id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `Id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `FK_#Id_role` FOREIGN KEY (`#Id_role`) REFERENCES `role` (`Id_role`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_#Id_categorie` FOREIGN KEY (`#Id_categorie`) REFERENCES `categorie` (`Id_categorie`),
  ADD CONSTRAINT `FK_#Id_profil` FOREIGN KEY (`#Id_profil`) REFERENCES `profil` (`Id_profil`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_#Id_profil2` FOREIGN KEY (`#Id_profil`) REFERENCES `profil` (`Id_profil`),
  ADD CONSTRAINT `FK_#Id_question` FOREIGN KEY (`#Id_question`) REFERENCES `question` (`Id_question`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`#Id_question`) REFERENCES `question` (`Id_question`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`#Id_profil`) REFERENCES `profil` (`Id_profil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
