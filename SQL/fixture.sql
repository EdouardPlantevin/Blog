-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 11 fév. 2022 à 10:41
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `demo_poo`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `author_id` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `short_description`, `created_at`, `updated_at`, `author_id`, `active`, `image`) VALUES
(2, 'Racket-Trip', 'Voici le tout premier projet qui m\'a été confier lors de mon arrivée en alternance dans l\'entreprise Eyefiz Digital. Il s\'agit d\'un site de mise en relation entre joueur et soit club soit coach soit opérateur dans le monde des sports de racket, Le but pour les joueurs est de pouvoir voyager n\'importe ou, tout en ayant un stage dans le sport de son choix. Pour les professionnel, le but est de créer des stages et d\'organiser le voyage de leur client. https://www.racket-trip.com/', 'Pour voyager et se dépenser', '2022-02-11 10:52:08', NULL, '1', 1, 'tennis.png'),
(3, 'Parlons-Crus', 'Parlons crus est un site journalistique sur le thème du vin, avec beaucoup de contenu varier. Il y a par example les articles classique, des \"Matchs\" qui compare deux produits mais aussi des films ou séries toujours sur le thème du vin, il y a aussi un dictionnaire des vins avec une carte qui permet de voir l\'emplacement de fabrication et le lieu où l\'acheter. La cliente étant mal-voyante le site est entièrement penser pour cet handicap.', 'Parlons de vin', '2022-02-11 11:27:31', NULL, '1', 1, 'vin.jpeg'),
(4, 'Centreo', 'Centreo est un site de gestion de centre d\'affaire, globalement c\'est un backoffice commun à tout les centres d\'affaires qui choisisse Centreo pour leur gestion. Avec ce backoffice nous proposons un site client pour réserver des salles ou bien des bureaux, notre premier clients souhaiter aussi faire de la domiciliation ce que nous avons rajouter à centreo. Tout le site client est administrable via Centreo', 'Centre d\'affaire', '2022-02-11 11:33:38', NULL, '1', 1, 'hcenter-5.jpeg'),
(5, 'Raconte-Moi Mon Histoire', 'Raconte-Moi Mon Histoire ou RMMH est site e-commerce de vente de jouer, livre, livre audio pour les tous petits, la particularité de ces produits c\'est la personnalisation des histoires selon le nom de l\'enfant, son doudou, ses amis et divers options choisi par le client, pour que chaque enfant est son histoire unique', 'Enfance heureuse', '2022-02-11 11:39:07', NULL, '1', 1, 'raconte-moi-une-histoire-agenda.png');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `password`, `roles`) VALUES
(1, 'edouard.plantevin@eyefiz.com', 'Plantevin Edouard', '$argon2i$v=19$m=65536,t=4,p=1$UFlLWTMyZDdDRnFKRHZpQQ$ITTWlIDHPph1ByoGmVl1W9HtqyP4WRXb0fCtGCBlkQU', '[\"ROLE_ADMIN\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_index` (`article_id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
