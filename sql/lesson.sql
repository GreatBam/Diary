-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  mar. 04 oct. 2022 à 09:34
-- Version du serveur :  8.0.16
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lesson`
--

-- --------------------------------------------------------

--
-- Structure de la table `diaries`
--

CREATE TABLE `diaries` (
  `diariesId` int(11) NOT NULL,
  `diariesContent` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `diaries`
--

INSERT INTO `diaries` (`diariesId`, `diariesContent`, `fk_userId`) VALUES
(2, 'Test part 2 suspense\r\n\r\nlkjasdcklsabclkjsac\r\n\r\nksgdlkbgasdklcbhas', 4),
(6, 'Salut test 2 ça marche !!!\r\n\r\nlkjashdcklbhasljkdcb\r\n\r\nklasclkbsckAKLSC', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userId`, `email`, `password`) VALUES
(4, 'email.test@try.com', '$2y$10$64LfWfkbeaoIjQxawTwI.OF/NB69lGyoXT5yCRUQe95wEi2XW6X2u'),
(5, 'curry@test.com', '$2y$10$vNqD5.W/OLbOCtza4cAB.uvjFodye3fAv.SO6NIbT7twV/zO7FSSC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `diaries`
--
ALTER TABLE `diaries`
  ADD PRIMARY KEY (`diariesId`),
  ADD UNIQUE KEY `fk_userId` (`fk_userId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `diaries`
--
ALTER TABLE `diaries`
  MODIFY `diariesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `diaries`
--
ALTER TABLE `diaries`
  ADD CONSTRAINT `diaries_ibfk_1` FOREIGN KEY (`fk_userId`) REFERENCES `users` (`userId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
