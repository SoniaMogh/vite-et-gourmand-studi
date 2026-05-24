-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2026 at 02:21 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

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

DROP TABLE IF EXISTS `allergenes`;
CREATE TABLE IF NOT EXISTS `allergenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `stars` int NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `stars`, `commentaire`, `status`, `created_at`) VALUES
(1, 1, 3, 'Très bon', 0, '2026-05-19 11:03:00'),
(2, 3, 5, 'Je veux juste tester pour voir si tout va bien. Est-ce que ça fonctionne toujours si j\'ai un long texte ou pas ? Je parle du design avec les étoiles.', 1, '2026-05-19 11:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `date_prestation` date NOT NULL,
  `heure_livraison` time NOT NULL,
  `adresse_livraison` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code_postal_livraison` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville_livraison` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix_menu` double NOT NULL,
  `nbre_pers` int NOT NULL,
  `prix_livraison` double NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pret_materiel` tinyint(1) DEFAULT '0',
  `restitution_materiel` tinyint(1) DEFAULT '0',
  `contact_annulation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `raison_annulation` text,
  `user_id` int NOT NULL,
  `menu_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `date_commande`, `date_prestation`, `heure_livraison`, `adresse_livraison`, `code_postal_livraison`, `ville_livraison`, `prix_menu`, `nbre_pers`, `prix_livraison`, `status`, `pret_materiel`, `restitution_materiel`, `contact_annulation`, `raison_annulation`, `user_id`, `menu_id`) VALUES
(1, '2026-05-15', '2026-05-20', '12:00:00', 'rue de rue', '11111', 'Ville', 137, 5, 11, 'annule', 0, 0, 'mail', 'Je le veux', 1, 1),
(2, '2027-05-15', '2027-11-04', '20:00:00', 'ruuue la rue de l\'avenue', '22222', 'Ville', 105, 3, 1, NULL, 1, 0, NULL, NULL, 5, 1),
(3, '2026-05-18', '2026-08-21', '12:00:00', 'efgthzefzef', '12345', 'adzde', 175, 5, 11, 'livre', 0, 0, NULL, NULL, 5, 3),
(5, '0000-00-00', '2026-05-30', '17:50:00', 'test', '11111', 'Bordeaux', 364.5, 0, 0, NULL, 1, 0, NULL, NULL, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `desserts`
--

DROP TABLE IF EXISTS `desserts`;
CREATE TABLE IF NOT EXISTS `desserts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `desserts`
--

INSERT INTO `desserts` (`id`, `titre`, `description`) VALUES
(1, 'Nuage Chocolat Croustillant', 'Mousse au chocolat noir, éclats de noissette, biscuit croustillant.'),
(2, 'Perle d’Hiver', 'Poire pochée, crème vanille légère, crumble croustillant.');

-- --------------------------------------------------------

--
-- Table structure for table `dessert_allergene`
--

DROP TABLE IF EXISTS `dessert_allergene`;
CREATE TABLE IF NOT EXISTS `dessert_allergene` (
  `dessert_id` int NOT NULL,
  `allergene_id` int NOT NULL,
  PRIMARY KEY (`dessert_id`,`allergene_id`),
  KEY `allergene_id` (`allergene_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dessert_allergene`
--

INSERT INTO `dessert_allergene` (`dessert_id`, `allergene_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `entrees`
--

DROP TABLE IF EXISTS `entrees`;
CREATE TABLE IF NOT EXISTS `entrees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entrees`
--

INSERT INTO `entrees` (`id`, `titre`, `description`) VALUES
(1, 'Burrata Gourmande', 'Burrata crémeuse, tomates anciennes, pesto basilic, roquette, pignons torréfiés'),
(6, 'Royale de Châtaigne', 'Crème de châtaigne onctueuse, éclats de noisettes torréfiées, herbes fraîches.');

-- --------------------------------------------------------

--
-- Table structure for table `entree_allergene`
--

DROP TABLE IF EXISTS `entree_allergene`;
CREATE TABLE IF NOT EXISTS `entree_allergene` (
  `entree_id` int NOT NULL,
  `allergene_id` int NOT NULL,
  PRIMARY KEY (`entree_id`,`allergene_id`),
  KEY `allergene_id` (`allergene_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entree_allergene`
--

INSERT INTO `entree_allergene` (`entree_id`, `allergene_id`) VALUES
(1, 1),
(6, 1),
(1, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `horaires`
--

DROP TABLE IF EXISTS `horaires`;
CREATE TABLE IF NOT EXISTS `horaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `morning_opening` time DEFAULT NULL,
  `morning_closing` time DEFAULT NULL,
  `night_opening` time DEFAULT NULL,
  `night_closing` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `img_path` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entree_id` (`entree_id`),
  KEY `plat_id` (`plat_id`),
  KEY `dessert_id` (`dessert_id`),
  KEY `regime_id` (`regime_id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `titre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plats`
--

INSERT INTO `plats` (`id`, `titre`, `description`) VALUES
(1, 'Suprême de Volaille Fontant', 'Suprême de volaille rôti, sauce forestière, gratin dauphinois, légumes rôtis de saison.'),
(3, 'Suprême des Fêtes', 'Magret de canard rôti, purée de patate douce, légumes glacés, jus réduit.');

-- --------------------------------------------------------

--
-- Table structure for table `plat_allergene`
--

DROP TABLE IF EXISTS `plat_allergene`;
CREATE TABLE IF NOT EXISTS `plat_allergene` (
  `plat_id` int NOT NULL,
  `allergene_id` int NOT NULL,
  PRIMARY KEY (`plat_id`,`allergene_id`),
  KEY `allergene_id` (`allergene_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plat_allergene`
--

INSERT INTO `plat_allergene` (`plat_id`, `allergene_id`) VALUES
(1, 1),
(3, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `regimes`
--

DROP TABLE IF EXISTS `regimes`;
CREATE TABLE IF NOT EXISTS `regimes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `suivis_commandes`;
CREATE TABLE IF NOT EXISTS `suivis_commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commande_id` int DEFAULT NULL,
  `accepte` datetime DEFAULT NULL,
  `en_preparation` datetime DEFAULT NULL,
  `en_cours_de_livraison` datetime DEFAULT NULL,
  `livre` datetime DEFAULT NULL,
  `restitution_materiel` datetime DEFAULT NULL,
  `terminee` datetime DEFAULT NULL,
  `annule` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `commande_id` (`commande_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suivis_commandes`
--

INSERT INTO `suivis_commandes` (`id`, `commande_id`, `accepte`, `en_preparation`, `en_cours_de_livraison`, `livre`, `restitution_materiel`, `terminee`, `annule`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, '2026-05-18 15:48:29', '2026-05-18 16:14:35', '2026-05-18 16:22:21', '2026-05-18 16:24:09', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `libelle`) VALUES
(1, 'Classique'),
(2, 'Evenement'),
(3, 'Noël');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `code_postal`, `ville`, `birthday`, `password`, `role`, `created_at`) VALUES
(1, 'John', 'Joe', '0111111111', 'test@test.fr', 'rue de rue', '00000', 'ezrzer', NULL, '$2y$10$ifJAMmp4PF737gw.L4fpeOQR.pRFKuDhZQmF8uCNoFANG6.wt/Uz.', NULL, '2026-05-12 01:03:22'),
(3, 'Jannet', 'Johnson', '0123456789', 'test1@test.fr', 'rue de rue', '11111', 'Bordeaux', NULL, '$2y$10$9C371pkRFxL5Ge.9/Qc/C.KS0hxUoQOd7YDdx/vgyCsRtdfLGZVAS', NULL, '2026-05-14 16:29:50'),
(4, 'Jeremy', 'Joiza', '0987654321', 'test2@test.fr', 'rue de rue', '22222', 'Bordeaux', NULL, '$2y$10$rg9xl1T/Mo.OdRoaAanM7uOFTWT0X7YKwTO1.GCXHhQyKZ7zc2G8u', NULL, '2026-05-14 17:13:32'),
(5, 'Josy', 'Jade', '0687654321', 'test3@test.fr', 'rue', '33333', 'Bordeaux', NULL, '$2y$10$9EAZ/2QEefqTLT9hlIf8Z.NUp9.gpTAF7.Lf3R2GB7HK77yABku6W', 'admin', '2026-05-14 17:23:08'),
(7, 'Jolly', 'Jorton', '0264838164', 'test5@test.fr', 'Juste une rue', '01234', 'Ville de Bordeaux', NULL, '$2y$10$UW4v143e2RgqcG9UD30bTuAtfqwmAoVL79c1C54goUTD.fpvQR5QG', 'employe', '2026-05-20 13:29:40');

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
