-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 10 déc. 2023 à 23:36
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gecome2`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `prix_ht` double(8,2) NOT NULL,
  `tva` double(8,2) NOT NULL,
  `stock` double(8,2) NOT NULL,
  `famille_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `designation`, `prix_ht`, `tva`, `stock`, `famille_id`) VALUES
(11, 'Laptop', 900.00, 0.15, 50.00, 1),
(12, 'Printer', 250.00, 0.10, 30.00, 2),
(13, 'Smartphone', 700.00, 0.15, 75.00, 1),
(14, 'Tablet', 400.00, 0.10, 40.00, 1),
(15, 'Camera', 350.00, 0.10, 25.00, 3),
(16, 'Chicken', 70.00, 0.10, 700.00, 4),
(17, 'Cartable', 250.00, 0.20, 500.00, 5),
(18, 'Mozzarela', 50.00, 0.20, 500.00, 12),
(19, 'PS5', 7500.00, 0.50, 50.00, 8),
(20, 'Xbox', 3500.00, 0.20, 500.00, 8),
(21, 'Croquette', 85.00, 0.10, 2500.00, 7),
(22, 'Hoddie', 250.00, 0.10, 600.00, 11),
(23, 'Book', 100.00, 0.10, 250.00, 5),
(24, 'LipStick', 150.00, 0.10, 800.00, 6),
(25, 'Brush', 100.00, 0.10, 4500.00, 10),
(26, 'Cream hydrate', 300.00, 0.10, 500.00, 6),
(27, 'PS4', 3500.00, 0.20, 500.00, 8),
(28, 'SWITCH nentendo', 1500.00, 0.20, 650.00, 8),
(29, 'Cheader', 56.00, 0.10, 500.00, 12);

-- --------------------------------------------------------

--
-- Structure de la table `bonlivraison`
--

CREATE TABLE `bonlivraison` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_r` date NOT NULL,
  `reglé` tinyint(1) NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `caissier_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bonlivraison`
--

INSERT INTO `bonlivraison` (`id`, `date_r`, `reglé`, `client_id`, `caissier_id`) VALUES
(6, '2023-12-08', 1, 6, 6),
(7, '2023-12-08', 1, 3, 6),
(9, '2023-12-08', 1, 7, 3),
(10, '2023-12-08', 0, 7, 6),
(11, '2023-12-08', 1, 4, 2),
(12, '2023-12-08', 0, 5, 5),
(13, '2023-12-08', 1, 1, 1),
(27, '2023-12-28', 0, 3, 1),
(32, '2023-12-10', 1, 7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `caissier`
--

CREATE TABLE `caissier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `caissier`
--

INSERT INTO `caissier` (`id`, `nom`, `prenom`, `poste`, `admin`) VALUES
(1, 'Serghini', 'Nadia', 'Cashier', 1),
(2, 'Sara', 'Bouzidi', 'Cashier', 0),
(3, 'Mahmoudy', 'Mohammed', 'Manager', 1),
(4, 'Zeimi', 'Layla', 'Cashier', 0),
(5, 'Younsi', 'Ali', 'Cashier', 0),
(6, 'Alami ', 'Ines', 'Cashier', 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `adresse`, `ville`) VALUES
(1, 'Nesiri', 'Mohammed', '123 Main Street', 'Cairo'),
(2, 'Gedbach', 'Lamiae', '456 Elm Avenue', 'Alexandria'),
(3, 'Merabeh', 'Sami', '789 Oak Lane', 'Giza'),
(4, 'Benaka', 'Jameela', '101 Pine Street', 'Luxor'),
(5, 'kebach', 'Noor', '222 Cedar Avenue', 'Aswan'),
(6, 'Abaoui', 'Chaymae', '123nanami middle city ', 'Ukrain'),
(7, 'Client', 'Passagère', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `detail_bl`
--

CREATE TABLE `detail_bl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `bl_id` bigint(20) UNSIGNED NOT NULL,
  `qte` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detail_bl`
--

INSERT INTO `detail_bl` (`id`, `article_id`, `bl_id`, `qte`) VALUES
(1, 1, 1, 10.00),
(2, 2, 1, 8.50),
(3, 3, 2, 15.25),
(4, 1, 2, 12.00),
(5, 4, 3, 6.75),
(16, 26, 6, 1.00),
(23, 28, 22, 1.00),
(38, 26, 35, 1.00),
(39, 27, 35, 2.00),
(40, 28, 35, 2.00),
(41, 11, 35, 2.00);

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `familleN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`id`, `familleN`) VALUES
(1, 'Electronic'),
(2, 'Office Supplies'),
(3, 'Photography'),
(4, 'Meat'),
(5, 'School'),
(6, 'Beauty'),
(7, 'Animeaux'),
(8, 'Games'),
(10, 'Cleaning tools'),
(11, 'Clothes'),
(12, 'Cheese');

-- --------------------------------------------------------

--
-- Structure de la table `mode_reglement`
--

CREATE TABLE `mode_reglement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mode_reglement`
--

INSERT INTO `mode_reglement` (`id`, `mode`) VALUES
(1, 'Cash'),
(2, 'Credit Card'),
(3, 'Check');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_r` date NOT NULL,
  `montant` double(8,2) NOT NULL,
  `bl_id` bigint(20) UNSIGNED NOT NULL,
  `mode_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_famille_id_foreign` (`famille_id`);

--
-- Index pour la table `bonlivraison`
--
ALTER TABLE `bonlivraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonlivraison_caissier_id_foreign` (`caissier_id`),
  ADD KEY `bonlivraison_client_id_foreign` (`client_id`);

--
-- Index pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `detail_bl`
--
ALTER TABLE `detail_bl`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reglement_mode_id_foreign` (`mode_id`),
  ADD KEY `reglement_bl_id_foreign` (`bl_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `bonlivraison`
--
ALTER TABLE `bonlivraison`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `caissier`
--
ALTER TABLE `caissier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `detail_bl`
--
ALTER TABLE `detail_bl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `article_famille_id_foreign` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `bonlivraison`
--
ALTER TABLE `bonlivraison`
  ADD CONSTRAINT `bonlivraison_caissier_id_foreign` FOREIGN KEY (`caissier_id`) REFERENCES `caissier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bonlivraison_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD CONSTRAINT `reglement_bl_id_foreign` FOREIGN KEY (`bl_id`) REFERENCES `bonlivraison` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reglement_mode_id_foreign` FOREIGN KEY (`mode_id`) REFERENCES `mode_reglement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
