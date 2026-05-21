-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: May 21, 2026 at 11:07 AM
-- Server version: 8.0.46
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viteetgourmand`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergenes`
--

CREATE TABLE `allergenes` (
  `id` int NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `allergenes`
--

INSERT INTO `allergenes` (`id`, `libelle`) VALUES
(1, 'Lait'),
(2, 'Fruit à coque'),
(3, 'Sulfites'),
(4, 'Oeufs'),
(5, 'Gluten');

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `stars` int NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `stars`, `commentaire`, `status`, `created_at`) VALUES
(1, 1, 3, 'Très bon', 1, '2026-05-19 11:03:00'),
(2, 3, 5, 'Je veux juste tester pour voir si tout va bien. Est-ce que ça fonctionne toujours si j\'ai un long texte ou pas ? Je parle du design avec les étoiles.', 0, '2026-05-19 11:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_prestation` date NOT NULL,
  `heure_livraison` time NOT NULL,
  `adresse_livraison` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code_postal_livraison` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville_livraison` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix_menu` double NOT NULL,
  `nbre_pers` int NOT NULL,
  `prix_livraison` double DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pret_materiel` tinyint(1) DEFAULT '0',
  `restitution_materiel` tinyint(1) DEFAULT '0',
  `contact_annulation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `raison_annulation` text,
  `user_id` int NOT NULL,
  `menu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `date_commande`, `date_prestation`, `heure_livraison`, `adresse_livraison`, `code_postal_livraison`, `ville_livraison`, `prix_menu`, `nbre_pers`, `prix_livraison`, `status`, `pret_materiel`, `restitution_materiel`, `contact_annulation`, `raison_annulation`, `user_id`, `menu_id`) VALUES
(1, '2026-05-15 00:00:00', '2026-05-20', '12:00:00', 'rue de rue', '11111', 'Ville', 137, 5, 11, NULL, 0, 0, 'mail', 'Je le veux', 1, 1),
(2, '2027-05-15 00:00:00', '2027-11-04', '20:00:00', 'ruuue la rue de l\'avenue', '22222', 'Ville', 105, 3, 1, 'accepte', 1, 0, NULL, NULL, 4, 1),
(3, '2026-05-18 00:00:00', '2026-08-21', '12:00:00', 'efgthzefzef', '12345', 'adzde', 175, 5, 11, 'restitution_materiel', 0, 0, NULL, NULL, 4, 3),
(7, '2026-05-21 10:14:05', '2026-05-30', '12:20:00', 'test', '11111', 'Bordeaux', 364.5, 15, NULL, NULL, 1, 0, NULL, NULL, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `desserts`
--

CREATE TABLE `desserts` (
  `id` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `desserts`
--

INSERT INTO `desserts` (`id`, `titre`, `description`) VALUES
(1, 'Nuage Chocolat Croustillant', 'Mousse au chocolat noir, éclats de noissette, biscuit croustillant.'),
(2, 'Perle d’Hiver', 'Poire pochée, crème vanille légère, crumble croustillant.'),
(3, 'Écrin Praliné', 'Entremets noisette chocolat, cœur fondant.');

-- --------------------------------------------------------

--
-- Table structure for table `dessert_allergene`
--

CREATE TABLE `dessert_allergene` (
  `dessert_id` int NOT NULL,
  `allergene_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dessert_allergene`
--

INSERT INTO `dessert_allergene` (`dessert_id`, `allergene_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(3, 2),
(1, 4),
(3, 4),
(1, 5),
(2, 5),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `entrees`
--

CREATE TABLE `entrees` (
  `id` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entrees`
--

INSERT INTO `entrees` (`id`, `titre`, `description`) VALUES
(1, 'Burrata Gourmande', 'Burrata crémeuse, tomates anciennes, pesto basilic, roquette, pignons torréfiés'),
(6, 'Royale de Châtaigne', 'Crème de châtaigne onctueuse, éclats de noisettes torréfiées, herbes fraîches.'),
(7, 'Élégance Végétale', 'Carpaccio de betterave, chèvre frais, noix torréfiées, vinaigrette au miel.');

-- --------------------------------------------------------

--
-- Table structure for table `entree_allergene`
--

CREATE TABLE `entree_allergene` (
  `entree_id` int NOT NULL,
  `allergene_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entree_allergene`
--

INSERT INTO `entree_allergene` (`entree_id`, `allergene_id`) VALUES
(1, 1),
(6, 1),
(7, 1),
(1, 2),
(6, 2),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `horaires`
--

CREATE TABLE `horaires` (
  `id` int NOT NULL,
  `jour` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `morning_opening` time DEFAULT NULL,
  `morning_closing` time DEFAULT NULL,
  `night_opening` time DEFAULT NULL,
  `night_closing` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `horaires`
--

INSERT INTO `horaires` (`id`, `jour`, `morning_opening`, `morning_closing`, `night_opening`, `night_closing`) VALUES
(1, 'Lundi au Samedi', '12:00:00', '16:00:00', '19:00:00', '00:00:00'),
(2, 'Dimanche', '12:00:00', '16:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int NOT NULL,
  `entree_id` int NOT NULL,
  `plat_id` int NOT NULL,
  `dessert_id` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `nbre_pers_min` int NOT NULL,
  `prix_par_pers` double NOT NULL,
  `regime_id` int NOT NULL,
  `theme_id` int NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `quantite_restante` int NOT NULL,
  `img_path` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `entree_id`, `plat_id`, `dessert_id`, `titre`, `nbre_pers_min`, `prix_par_pers`, `regime_id`, `theme_id`, `description`, `quantite_restante`, `img_path`) VALUES
(1, 1, 1, 1, 'Convivial & Gourmand', 2, 35, 1, 1, 'Partagez un repas en famille ou entre amis.', 9, 'assets/pictures/fresh-product-key-point.jpg'),
(3, 1, 1, 1, 'Esprit de fête', 2, 45, 1, 3, 'Partagez un plat chaud entouré de vos être chers pour Noël.', 17, 'assets/pictures/homepage-bigtitle.jpg'),
(5, 6, 3, 2, 'Éclat Festif', 15, 27, 1, 3, 'Partagez un plat chaud entouré de vos amis et collègues pour Noël.', 36, 'assets/pictures/6a0c3296e1d94_qesdrf.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `titre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `email`, `titre`, `description`, `user_id`, `created_at`) VALUES
(1, 'test@test.fr', 'Je veux tester', 'Ce n\'est qu\'un test', 1, '2026-05-11 14:08:36'),
(2, 'oui@zefzn.fr', 'ergeg', 'azerty', 1, '2026-05-11 16:25:53'),
(3, 'oui@zefzn.fr', 'ergeg', 'azerty', 1, '2026-05-11 20:03:40'),
(4, 'oui@ze.fr', 'test', 'test', 1, '2026-05-11 20:40:25'),
(5, 'oui@zefzn.fr', 'ergeg', 'zefef', 1, '2026-05-12 15:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `plats`
--

CREATE TABLE `plats` (
  `id` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plats`
--

INSERT INTO `plats` (`id`, `titre`, `description`) VALUES
(1, 'Suprême de Volaille Fontant', 'Suprême de volaille rôti, sauce forestière, gratin dauphinois, légumes rôtis de saison.'),
(3, 'Suprême des Fêtes', 'Magret de canard rôti, purée de patate douce, légumes glacés, jus réduit.'),
(4, 'Pièce d’Exception', 'Filet de bœuf rôti, mousseline de panais, légumes glacés, jus corsé.');

-- --------------------------------------------------------

--
-- Table structure for table `plat_allergene`
--

CREATE TABLE `plat_allergene` (
  `plat_id` int NOT NULL,
  `allergene_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plat_allergene`
--

INSERT INTO `plat_allergene` (`plat_id`, `allergene_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `regimes`
--

CREATE TABLE `regimes` (
  `id` int NOT NULL,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `regimes`
--

INSERT INTO `regimes` (`id`, `libelle`) VALUES
(1, 'Classique'),
(2, 'Végétarien');

-- --------------------------------------------------------

--
-- Table structure for table `suivis_commandes`
--

CREATE TABLE `suivis_commandes` (
  `id` int NOT NULL,
  `commande_id` int DEFAULT NULL,
  `accepte` datetime DEFAULT NULL,
  `en_preparation` datetime DEFAULT NULL,
  `en_cours_de_livraison` datetime DEFAULT NULL,
  `livre` datetime DEFAULT NULL,
  `restitution_materiel` datetime DEFAULT NULL,
  `terminee` datetime DEFAULT NULL,
  `annule` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suivis_commandes`
--

INSERT INTO `suivis_commandes` (`id`, `commande_id`, `accepte`, `en_preparation`, `en_cours_de_livraison`, `livre`, `restitution_materiel`, `terminee`, `annule`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, '2026-05-18 15:48:29', '2026-05-18 16:14:35', '2026-05-18 16:22:21', '2026-05-18 16:24:09', '2026-05-21 09:12:13', NULL, NULL),
(13, 2, '2026-05-21 09:22:09', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int NOT NULL,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `libelle`) VALUES
(1, 'Classique'),
(2, 'Evenement'),
(3, 'Noël'),
(4, 'Halloween'),
(5, 'Gastronomique');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `code_postal` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `code_postal`, `ville`, `birthday`, `password`, `role`, `created_at`) VALUES
(1, 'John', 'Joe', '0111111111', 'test@test.fr', 'rue de rue', '00000', 'ezrzer', NULL, '$2y$10$ifJAMmp4PF737gw.L4fpeOQR.pRFKuDhZQmF8uCNoFANG6.wt/Uz.', NULL, '2026-05-12 01:03:22'),
(3, 'Jannet', 'Johnson', '0123456789', 'test1@test.fr', 'rue de rue', '11111', 'Bordeaux', NULL, '$2y$10$9C371pkRFxL5Ge.9/Qc/C.KS0hxUoQOd7YDdx/vgyCsRtdfLGZVAS', NULL, '2026-05-14 16:29:50'),
(4, 'Joiza', 'Jeremy', '0115432111', 'test2@test.fr', 'rue', '22222', 'Bordeaux', NULL, '$2y$10$UMFFQOnooswwTLVGcev7e.nOFsVLXLVe4wS5hsq7xtmxrlXEdpbJW', NULL, '2026-05-14 17:13:32'),
(5, 'Josy', 'Jade', '0687654321', 'test3@test.fr', 'rue', '33333', 'Bordeaux', NULL, '$2y$10$9EAZ/2QEefqTLT9hlIf8Z.NUp9.gpTAF7.Lf3R2GB7HK77yABku6W', 'admin', '2026-05-14 17:23:08'),
(7, 'Jolly', 'Jorton', '0264838164', 'test5@test.fr', 'Juste une rue', '01234', 'Ville de Bordeaux', NULL, '$2y$10$UW4v143e2RgqcG9UD30bTuAtfqwmAoVL79c1C54goUTD.fpvQR5QG', 'employe', '2026-05-20 13:29:40'),
(8, 'Jacques', 'Jirac', '0123456789', 'test6@test.fr', 'rue de rue', '66666', 'Bordeaux', NULL, '$2y$10$rJElYGw3RbHsI80UIXJJeukZCc3V.qiRqGi.tM/FasfE6zQZEFYme', 'employe', '2026-05-21 09:49:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergenes`
--
ALTER TABLE `allergenes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `desserts`
--
ALTER TABLE `desserts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dessert_allergene`
--
ALTER TABLE `dessert_allergene`
  ADD PRIMARY KEY (`dessert_id`,`allergene_id`),
  ADD KEY `allergene_id` (`allergene_id`);

--
-- Indexes for table `entrees`
--
ALTER TABLE `entrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entree_allergene`
--
ALTER TABLE `entree_allergene`
  ADD PRIMARY KEY (`entree_id`,`allergene_id`),
  ADD KEY `allergene_id` (`allergene_id`);

--
-- Indexes for table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entree_id` (`entree_id`),
  ADD KEY `plat_id` (`plat_id`),
  ADD KEY `dessert_id` (`dessert_id`),
  ADD KEY `regime_id` (`regime_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plat_allergene`
--
ALTER TABLE `plat_allergene`
  ADD PRIMARY KEY (`plat_id`,`allergene_id`),
  ADD KEY `allergene_id` (`allergene_id`);

--
-- Indexes for table `regimes`
--
ALTER TABLE `regimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suivis_commandes`
--
ALTER TABLE `suivis_commandes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commande_id` (`commande_id`) USING BTREE;

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergenes`
--
ALTER TABLE `allergenes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `desserts`
--
ALTER TABLE `desserts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entrees`
--
ALTER TABLE `entrees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plats`
--
ALTER TABLE `plats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regimes`
--
ALTER TABLE `regimes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suivis_commandes`
--
ALTER TABLE `suivis_commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `dessert_allergene`
--
ALTER TABLE `dessert_allergene`
  ADD CONSTRAINT `dessert_allergene_ibfk_1` FOREIGN KEY (`dessert_id`) REFERENCES `desserts` (`id`),
  ADD CONSTRAINT `dessert_allergene_ibfk_3` FOREIGN KEY (`allergene_id`) REFERENCES `allergenes` (`id`);

--
-- Constraints for table `entree_allergene`
--
ALTER TABLE `entree_allergene`
  ADD CONSTRAINT `entree_allergene_ibfk_1` FOREIGN KEY (`entree_id`) REFERENCES `entrees` (`id`),
  ADD CONSTRAINT `entree_allergene_ibfk_2` FOREIGN KEY (`allergene_id`) REFERENCES `allergenes` (`id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`entree_id`) REFERENCES `entrees` (`id`),
  ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`),
  ADD CONSTRAINT `menus_ibfk_3` FOREIGN KEY (`dessert_id`) REFERENCES `desserts` (`id`),
  ADD CONSTRAINT `menus_ibfk_4` FOREIGN KEY (`regime_id`) REFERENCES `regimes` (`id`),
  ADD CONSTRAINT `menus_ibfk_5` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `plat_allergene`
--
ALTER TABLE `plat_allergene`
  ADD CONSTRAINT `plat_allergene_ibfk_1` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`),
  ADD CONSTRAINT `plat_allergene_ibfk_2` FOREIGN KEY (`allergene_id`) REFERENCES `allergenes` (`id`);

--
-- Constraints for table `suivis_commandes`
--
ALTER TABLE `suivis_commandes`
  ADD CONSTRAINT `suivis_commandes_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
