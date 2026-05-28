-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 28 mai 2026 à 13:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_blog_personnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(180) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `image`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Bienvenue sur mon blog', 'Ceci est un premier article de démonstration. Vous pouvez le modifier ou le supprimer depuis l\'administration.', NULL, 1, '2026-05-27 01:12:32', NULL),
(2, 'Pourquoi apprendre PHP orienté objet ?', 'La programmation orientée objet aide à organiser le code en classes responsables. Dans ce projet, Database gère la connexion, Article gère les articles, User et Auth gèrent la connexion administrateur.', NULL, 1, '2026-05-27 01:12:32', NULL),
(4, 'elections presidentielles', 'les elections presidentielles au real madrid se tiendrons le 7 juin', NULL, 0, '2026-05-27 02:19:29', NULL),
(5, 'elections presidentielles', 'les elections presidentielles au real madrid se tiendrons le 7 juin', NULL, 0, '2026-05-27 02:22:19', NULL),
(7, 'elections presidentielles', 'les elections presidentielles au real madrid se tiendrons le 7 juin', NULL, 0, '2026-05-27 02:23:09', NULL),
(8, 'elections presidentielles', 'les elections presidentielles au real madrid se tiendrons le 7 juin', NULL, 0, '2026-05-27 02:24:21', NULL),
(9, 'elections presidentielles', 'les elections presidentielles au real madrid se tiendrons le 7 juin', NULL, 0, '2026-05-27 02:27:20', NULL),
(10, 'coupe du monde', 'la coupe du monde commence bientot', NULL, 1, '2026-05-27 02:29:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Administrateur', 'admin@example.com', '$2y$10$.REbcybsDjJseAMDOBMJ/eXaUXt8HD2x.rnb6XHCOmxjpY4J3xBQ.', '2026-05-27 01:12:32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
