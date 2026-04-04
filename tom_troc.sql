-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 04 avr. 2026 à 05:05
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(128) NOT NULL,
  `picture_uri` varchar(255) DEFAULT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `owner_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`book_id`, `title`, `description`, `author`, `picture_uri`, `availability`, `owner_id`, `created_at`) VALUES
(17, 'Esther', 'Un roman sensible et lumineux sur les liens familiaux, la reconstruction et les petites victoires du quotidien. Le récit alterne moments intimes et passages contemplatifs, avec une écriture élégante qui met en valeur le silence, la nature et la mémoire. Parfait pour les lecteurs qui aiment les histoires humaines et les personnages nuancés.', 'Alabaster', '20260328054818_esther.jpg', 1, 1, '2026-03-20 08:00:00'),
(18, 'The Kinfolk Table', 'Un ouvrage mêlant cuisine, photographie et art de vivre. Les recettes sont accompagnées de portraits et de récits sur la convivialité, le partage et les rituels simples qui font du repas un moment de rencontre. Idéal pour inspirer des dîners chaleureux et une approche plus consciente du quotidien.', 'Nathan Williams', '20260327115231_the-kinfolk-table.jpg', 1, 2, '2026-03-20 08:05:00'),
(19, 'Wabi Sabi', 'Un essai accessible sur la beauté de l’imperfection et l’art de ralentir. L’autrice propose des pistes concrètes pour simplifier son environnement, retrouver du sens et cultiver une sérénité durable. Un livre apaisant qui invite à porter un regard plus doux sur soi-même et sur le monde.', 'Beth Kempton', '20260327140110_wabi-sabi.jpg', 1, 3, '2026-03-20 08:10:00'),
(20, 'Milk and Honey', 'Recueil de poèmes courts sur l’amour, la perte, la guérison et la résilience. La langue est directe, émotionnelle et percutante, avec des textes qui se lisent d’une traite ou se savourent lentement. Une lecture qui touche par sa sincérité et son universalité.', 'Rupi Kaur', '20260327140426_milk-and-honey.jpg', 0, 4, '2026-03-20 08:15:00'),
(21, 'Delight!', 'Livre visuel consacré aux idées créatives qui transforment l’expérience utilisateur. Entre design, narration et détail émotionnel, il montre comment une décision graphique ou éditoriale peut créer de la surprise et de la joie. Très utile pour les profils produit, UX et direction artistique.', 'Justin Rosow', '20260327140526_delight.jpg', 0, 5, '2026-03-20 08:20:00'),
(22, 'Milwaukee Mission', 'Un projet éditorial orienté photographie et patrimoine, qui documente lieux, textures et atmosphères urbaines. Le livre se distingue par sa composition soignée, ses contrastes et la qualité de ses images. Une belle pièce pour les amateurs d’architecture, de design éditorial et de récits visuels.', 'Elder Cooper Low', '20260327140247_milwaukee-mission.jpg', 1, 6, '2026-03-20 08:25:00'),
(23, 'Minimalist Graphics', 'Une exploration des principes du design minimaliste à travers des exemples concrets, des grilles, des palettes limitées et un usage maîtrisé de la typographie. Le livre aide à comprendre comment simplifier sans appauvrir, et comment donner plus d’impact en retirant le superflu.', 'Julia Schonlau', '20260327140156_minimalist-graphics.jpg', 1, 7, '2026-03-20 08:30:00'),
(24, 'Hygge', 'Un guide chaleureux sur l’art de créer une ambiance confortable et conviviale. L’auteur partage des rituels simples autour de la lumière, des saisons, de la cuisine et des relations sociales. Un livre parfait pour apporter plus de douceur et d’équilibre dans sa routine.', 'Meik Wiking', '20260327140027_hygge.jpg', 1, 1, '2026-03-20 08:35:00'),
(25, 'Innovation', 'Un essai stimulant qui retrace les mécanismes de l’innovation à travers l’histoire des sciences, des techniques et des idées. L’auteur insiste sur la collaboration, les échanges et l’expérimentation comme moteurs du progrès. Lecture recommandée pour les curieux d’économie, de technologie et de société.', 'Matt Ridley', '20260327135601_innovation.jpg', 0, 2, '2026-03-20 08:40:00'),
(26, 'Psalms', 'Une édition élégante de textes spirituels et poétiques qui invitent à la réflexion, à la gratitude et à la contemplation. Le rythme et la musicalité des passages en font un compagnon de lecture calme, à ouvrir à n’importe quel moment de la journée.', 'Alabaster', '20260327140127_psalms.jpg', 1, 3, '2026-03-20 08:45:00'),
(27, 'Thinking, Fast & Slow', 'Référence majeure en psychologie cognitive, ce livre distingue les mécanismes intuitifs et analytiques de la pensée. Il montre comment nos biais influencent nos décisions, du quotidien aux enjeux professionnels. Dense mais passionnant, il offre des outils concrets pour mieux raisonner.', 'Daniel Kahneman', '20260327140440_thinking-fast-and-slow.jpg', 0, 4, '2026-03-20 08:50:00'),
(28, 'A Book Full Of Hope', 'Un recueil poétique centré sur la reconstruction, l’acceptation de soi et la capacité à traverser les épreuves. Les textes sont courts, accessibles et portés par une tonalité encourageante. Une lecture réconfortante à garder près de soi.', 'Rupi Kaur', '20260327140540_a-book-full-of-hope.jpg', 1, 5, '2026-03-20 08:55:00'),
(29, 'The Subtle Art Of Not Giving A F*ck', 'Un ouvrage de développement personnel au ton direct, qui propose de mieux choisir ses priorités et d’accepter l’inconfort comme partie intégrante de la vie. L’auteur bouscule les injonctions au positivisme permanent et invite à une forme de lucidité pragmatique.', 'Mark Manson', '20260327140336_the-subtle-art.jpg', 1, 6, '2026-03-20 09:00:00'),
(30, 'Narnia', 'Classique de la fantasy, ce roman ouvre les portes d’un monde merveilleux peuplé de créatures inoubliables et de conflits symboliques entre ombre et lumière. Une aventure riche en imagination, accessible aux jeunes lecteurs comme aux adultes nostalgiques.', 'C.S. Lewis', '20260327140211_narnia.jpg', 0, 7, '2026-03-20 09:05:00'),
(31, 'Company Of One', 'Un manifeste pour les indépendants et petites structures qui souhaitent grandir autrement. L’auteur défend l’idée d’une entreprise volontairement compacte, rentable et alignée avec un mode de vie équilibré. Très utile pour freelances, créateurs et entrepreneurs pragmatiques.', 'Paul Jarvis', '20260327140038_company-of-one.jpg', 0, 1, '2026-03-20 09:10:00'),
(32, 'The Two Towers', 'Deuxième volet d’une saga majeure de fantasy, ce tome mêle tension, paysages épiques et destins croisés. Le récit alterne stratégie, amitié et résistance face à l’obscurité, avec une montée dramatique continue. Une lecture incontournable pour les amateurs d’aventure et de mythologie moderne.\r\n', 'J.R.R. Tolkien', '20260327135833_the-two-towers.jpg', 0, 2, '2026-03-20 09:15:00');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `content`, `sender_id`, `receiver_id`, `created_at`) VALUES
(1, 'Comment vas tu ? ', 1, 2, '2026-03-25 04:42:00'),
(2, 'Je vais bien et toi ? ', 2, 1, '2026-03-25 04:43:00'),
(3, 'As tu finis ta lecture ?', 1, 2, '2026-03-25 04:44:00'),
(4, 'Salut Evavou !', 1, 7, '2026-03-25 09:12:39'),
(5, 'Salut Mikado, ça va ?!', 7, 1, '2026-03-25 09:13:39'),
(6, 'Très bien merci et toi ? ', 1, 7, '2026-03-25 09:14:39'),
(7, 'Coucou', 1, 3, '2026-03-25 09:55:34'),
(8, 'Hello', 3, 1, '2026-03-25 09:56:34'),
(9, 'Ça bouquine ?', 3, 1, '2026-03-25 09:57:34'),
(10, 'Comme toujours :-)', 1, 3, '2026-03-31 03:25:01'),
(11, 'Et toi ? ', 1, 3, '2026-03-31 03:25:20'),
(12, 'Alors tu es sur quel livre en ce moment ? ', 1, 7, '2026-03-31 03:25:42'),
(13, 'Le hobbit ', 7, 1, '2026-03-31 03:26:45'),
(14, 'Bonjour Mikado ! Comment vas tu ? ', 5, 1, '2026-03-31 03:54:55'),
(15, 'Coucou Mia, c\'est Tata Océ, qu\'est-ce que tu lis en moment ? ', 8, 4, '2026-03-31 04:02:12'),
(16, 'Tu ne me réponds pas ?', 1, 5, '2026-03-31 12:08:03'),
(17, 'Mais ça va bien !', 1, 5, '2026-03-31 12:08:24'),
(18, 'Qu\'est ce que tu lis en ce moment ?', 1, 5, '2026-03-31 12:08:46'),
(19, 'Je lis un livre sur les fourmis ', 5, 1, '2026-03-31 12:09:44'),
(20, 'Très intéressantes ces petites bêtes', 5, 1, '2026-03-31 12:10:14'),
(21, 'Tu savais qu\'avant de devenir une reine, cette femelle peut voler pour aller chercher son reproducteur ?', 5, 1, '2026-03-31 12:11:33'),
(22, 'ahahah! j\'adore ce genre de lectures ', 1, 5, '2026-03-31 12:12:15'),
(23, 'Et non je ne le savais pas ', 1, 5, '2026-03-31 12:12:33'),
(24, 'sympa comme info', 1, 5, '2026-03-31 12:24:58'),
(25, 'Moi je lis le seigneur des anneaux ', 1, 5, '2026-03-31 12:32:31'),
(26, 'Le premier : \"La communauté de l\'anneau\"', 1, 5, '2026-03-31 12:34:09'),
(27, 'non pas encore', 1, 2, '2026-04-01 08:17:29'),
(28, 'Pareil je ne peux pas m\'en empêcher', 1, 3, '2026-04-03 09:21:23'),
(29, 'Je suis mordu', 1, 3, '2026-04-03 09:21:57'),
(30, 'Je suis mordu', 1, 3, '2026-04-03 09:23:20'),
(31, 'un vrai fou', 1, 3, '2026-04-03 09:23:29');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture_uri` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `picture_uri`, `created_at`) VALUES
(1, 'Mikadodo', 'mikado@gmail.com', '$2y$12$zgwtcZC1bzTdZ1Y2DUO1E./D0k/XeHO82QH/EOrZaTXflBI.aN2Z6', '20260401101800_mikadoda.jpg', '2026-04-01 08:18:04'),
(2, 'Mika', 'mika@gmail.com', '$2y$12$YFJyLHTCexxnZh7jJIjPM..mnL8ppD2ttKzYA1UqzPz28YWPimVum', '20260327102035_mika.jpg', '2026-03-27 09:20:35'),
(3, 'Anaïs', 'anais@gmail.com', '$2y$12$dbZAVEU7FatamfELHaliIe7vysDpci3MmeA8kwwHj8M4iWk4OsO4q', '20260327101945_anais.jpg', '2026-03-27 09:19:45'),
(4, 'Miacadabra', 'miacadabra@gmail.com', '$2y$12$c0d9FjwvrIlcpMESWyP39eujStOfhk1vgVhOpweLQ.vi5.tm3txRO', '20260327101901_miacadabra.jpg', '2026-03-27 09:19:01'),
(5, 'Ellabouille', 'ellabouille@gmail.com', '$2y$12$xkR8BL81ngAvC3E240UyouISNQUNGE8YePufgrTTcq.sVdn0/01.a', '20260327101027_ellabouille.jpg', '2026-03-27 09:10:27'),
(6, 'Anitata', 'anitata@gmail.com', '$2y$12$/oTR7E5ZGxEgOmqSW.0pl.9pst7nGvZ8oAG7hSMsJlQZ44GgpN5ky', '20260327101920_anitata.jpg', '2026-03-27 09:19:20'),
(7, 'Evavou', 'evavou@gmail.com', '$2y$12$MbrCWcxxjoFOCBVGRPbR/eBZxj1zdZW2OXdaZlfF23eRBEbtYhq2u', '20260327101003_evavou.jpg', '2026-03-27 09:10:03'),
(8, 'Océcédille', 'oceane@gmail.com', '$2y$12$bsrUqqruX.yyweyZM7FNS.SZ8MbgYCjEm0CIj3lkuUBySddwXCfWC', '20260327100937_océcédille.jpg', '2026-03-27 09:09:37'),
(9, 'test', 'test@gmail.com', '$2y$12$NFqp/vyAJVJY.mTHYrSYWu7NAfUwGKm9ET6ZCYjEtF1jmCgB6uOem', NULL, '2026-03-25 16:08:38'),
(10, 'toto', 'toto@gmail.com', '$2y$12$5SHrVsTHY2b.jIbd5wILke3WVZhq2Y7B2n5ayDPH153Ko00wT9auO', NULL, '2026-03-25 16:20:03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `fk_book_owner_id_user` (`owner_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `fk_message_sender_id_user` (`sender_id`),
  ADD KEY `fk_message_receiver_id_user` (`receiver_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_owner_id_user` FOREIGN KEY (`owner_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_receiver_id_user` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk_message_sender_id_user` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
