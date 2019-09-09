-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 02, 2019 at 07:50 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `adopte_un_stage`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_area`
--

CREATE TABLE `activity_area` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_area`
--

INSERT INTO `activity_area` (`id`, `name`) VALUES
(1, 'Agriculture'),
(2, 'Chimie, pharmacie'),
(3, 'Énergie'),
(4, 'Maintenance, entretien'),
(5, 'Armée, sécurité'),
(6, 'Commerce, distribution'),
(7, 'Enseignement'),
(8, 'Mécanique'),
(9, 'Art, Design'),
(10, 'Communication - Marketing - Pub'),
(11, 'Environnement'),
(12, 'Mode, industrie textile'),
(13, 'Audiovisuel - Spectacle'),
(14, 'Construction aéronautique, ferroviaire et navale'),
(15, 'Fonction publique'),
(16, 'Recherche'),
(17, 'Audit, gestion'),
(18, 'Culture - Artisanat d\'art'),
(19, 'Hôtellerie, restauration'),
(20, 'Santé'),
(21, 'Automobile'),
(22, 'Droit, justice'),
(23, 'Industrie alimentaire'),
(24, 'Social'),
(25, 'Banque, assurance'),
(26, 'Edition, Journalisme'),
(27, 'Informatique'),
(28, 'Sport, loisirs – Tourisme'),
(29, 'Électronique'),
(30, 'Logistique, transport'),
(31, 'Traduction - interprétariat '),
(32, 'Communication'),
(33, 'BTP, architecture'),
(34, 'Verre, béton, céramique');

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `enterprise_name` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `avatar` text,
  `bio` longtext,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `vkey` varchar(255) DEFAULT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_title` text,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enterprises`
--

INSERT INTO `enterprises` (`id`, `enterprise_name`, `email`, `password`, `phone`, `avatar`, `bio`, `verified`, `vkey`, `register_date`, `job_title`, `isAdmin`) VALUES
(1, 'IKEAMETZ', 'ikea@gmail.com', '$2y$10$TehGJK2HG1tUHb9/uwHRAuHnjldvIMc7Gbua/wSchZL6EjHkV9LJG', '0606060606', 'fd0ab54e1efba933f4828fcb2ce559a2.jpg', 'Dans le cadre d\'un contrat d\'apprentissage, vous serez accompagné par votre tuteur qui vous accompagnera dans l\'accomplissement de votre BAC +3 à l\'AFTRAL.', 1, '1564740687IKEA', '2019-08-02 12:11:27', 'Alternance transport/logistique BAC +3', 0),
(5, 'Institut Français des Affaires', 'ifa-formation@gmail.com', '$2y$10$gU5CvrqE6.BQiVPRPW8dJOaGraPvhst68.Qo4dY1D0ImX7zgJNNY6', '0628393418', '10a6fd60d77e332662787483ced1e6bc.jpg', 'L\'institut Français des Affaires est un centre de formation situé à Metz', 1, '1565193649IFA', '2019-08-07 18:00:49', 'Jury Formation Développeur Web', 0),
(6, 'Cora', 'cora@gmail.com', '$2y$10$ev/omjRh4lVDyBgJse6N0OYfqFrha0vRM4Q5WYdXAlIKIVtKxq0dy', '0678945637', '3ba7184d2381cbfad4b550cc01d49f22.png', 'Je suis cora', 1, '1565253155Cora', '2019-08-08 10:32:35', 'Caissière', 0),
(7, 'Leclerc', 'leclerc@gmail.com', '$2y$10$Wi/ToSXu2FYxp5PgR4tLguKurL78j.Jb52UiplHC2rZZBHSRn1oui', '0766778390', '760ad5731e3d95a73d577e5ff8c24769.jpg', 'Je suis leclerc', 1, '1565253364Leclerc', '2019-08-08 10:36:04', 'Préparateur de commandes drive', 0),
(12, 'INSEE', 'insee@gmail.com', '$2y$10$uARh/U8Zz6Z9IyrJaCEq6uQrUcafTCxCIpU3gGtkcn3gitQuB7jPu', '0675467382', '192e54300e5e54ca9a169248b5d4ef8a.jpg', 'Je suis l\'insee', 1, '1565272473INSEE', '2019-08-08 15:54:34', 'Informaticien', 0),
(13, 'SNCF', 'sncf@gmail.com', '$2y$10$uEZo1W6pTkz0FFUv8W1dcuNEiH9vEZBQkn9tv5meMCJKoQWjeBP3y', '0756849324', 'f8b01c7fb8bb7e05d41c5e079ee38979.jpg', 'Contrôler les tickets des personnes montant dans les trains.', 1, '1565272817SNCF', '2019-08-08 16:00:17', 'Contrôleur', 0),
(14, 'Le Met\'', 'lemet@gmail.com', '$2y$10$4m20fF0v3gi1zXOZMc90pOPzDVYjkINx1qK453kI6vWbWrCBLCkVq', '0654763546', 'b23c951c0eefa6132a1cf272b2e46d1a.png', 'Je suis le Met\'', 1, '1565273043Le Met\'', '2019-08-08 16:04:03', 'Conducteur de bus', 0),
(15, 'LuxAir', 'luxair@gmail.com', '$2y$10$ZzlEFrOWtQAeW6LKLJFeTuPGU0YUQ/xr9.2IiH.Y6EkPLLQqPcDVu', '+35227862027', '8ab965258d3839fbb3067bc05b687910.png', 'Afin d\'agrandir nos effectifs, nous recherchons un responsable transport disponible et impliqué', 1, '1565273212LuxAir', '2019-08-08 16:06:53', 'Responsable transport ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enterprises_activity_area`
--

CREATE TABLE `enterprises_activity_area` (
  `activity_area_id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enterprises_activity_area`
--

INSERT INTO `enterprises_activity_area` (`activity_area_id`, `enterprise_id`) VALUES
(6, 1),
(7, 5),
(13, 6),
(5, 7),
(15, 12),
(28, 13),
(28, 14),
(30, 15),
(29, 16),
(18, 21);

-- --------------------------------------------------------

--
-- Table structure for table `enterprises_addresses`
--

CREATE TABLE `enterprises_addresses` (
  `id` int(11) NOT NULL,
  `enterprise_id` int(11) NOT NULL,
  `addresse_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enterprises_addresses`
--

INSERT INTO `enterprises_addresses` (`id`, `enterprise_id`, `addresse_name`) VALUES
(1, 1, 'Montigny-lès-Metz, Grand-Est, France'),
(2, 5, 'Metz, Grand-Est, France'),
(3, 6, 'Moulins, Auvergne-Rhône-Alpes, France'),
(4, 7, 'Marly, Hauts-de-France, France'),
(5, 12, 'Metz, Grand-Est, France'),
(6, 13, 'Metz, Grand-Est, France'),
(7, 14, 'Metz, Grand-Est, France'),
(8, 15, 'Luxembourg, Luxembourg'),
(9, 16, 'Metz, Grand-Est, France'),
(10, 21, 'Novéant-sur-Moselle, Grand-Est, France');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL COMMENT 'Prénom',
  `lastname` text NOT NULL COMMENT 'Nom',
  `email` text NOT NULL COMMENT 'Email',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe',
  `gender` varchar(1) NOT NULL DEFAULT 'm' COMMENT 'Sexe',
  `age` int(11) DEFAULT NULL COMMENT 'Age',
  `phone` varchar(12) DEFAULT NULL COMMENT 'Téléphone',
  `avatar` text COMMENT 'Photo',
  `speech` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `vkey` varchar(255) DEFAULT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d''inscription',
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `firstname`, `lastname`, `email`, `password`, `gender`, `age`, `phone`, `avatar`, `speech`, `verified`, `vkey`, `register_date`, `isAdmin`) VALUES
(1, 'Anthony', 'Lacrabère', 'anthony.lacrabere@gmail.com', '$2y$10$5rSozxyQ4xjmG0PV/vpPkuEgstPZIlR3b4PxagOdu/GBTe4WFIoOO', 'h', 24, '0658295329', '87949ae5fbc5ea12fed63cc4fdc81b2e.jpg', 'Recherche stage en tant que développeur web afin de valider les compétences acquises lors de ma formation. Période : du 23/09/2019 au 30/10/2019', 1, '', '2019-06-13 09:23:28', 1),
(2, 'LACRABERE', 'Elyo', 'elyo@hotmail.com', '$2y$10$8y7dpLjWEKDM6BD.BmKZU.p5Ont83tnqfYtt8fkKoQbgYwxvTAvHu', 'h', 1, '0759585958', '34709d378f6a6ffb8b3a59fec83a66d2.jpg', 'this is speech', 1, '', '2019-06-14 09:32:56', 0),
(3, 'Michael', 'Taize', 'MickaTaize@gmail.com', '$2y$10$hzaAQ0jdzL4ecIomm.esPeXK2gE4uJIsvi6GWll3ox65pJg94Udgi', 'h', 30, '0606060606', '34709d378f6a6ffb8b3a59fec83a66d2.jpg', 'Je suis micka', 1, '1562915776Michael', '2019-07-12 09:16:16', 0),
(4, 'Marjorie', 'Siad', 'MarjoSiad@gmail.com', '$2y$10$v8mxxGma.92fja.jEsFVi.4/4rNQQv/ifjzHaWKTe5ZiT3WT6Ts7W', 'f', 27, '0606060606', '34709d378f6a6ffb8b3a59fec83a66d2.jpg', 'Je suis marjorie', 1, '1562915846Marjorie', '2019-07-12 09:17:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `interns_activity_area`
--

CREATE TABLE `interns_activity_area` (
  `activity_area_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interns_activity_area`
--

INSERT INTO `interns_activity_area` (`activity_area_id`, `intern_id`) VALUES
(27, 1),
(5, 2),
(9, 3),
(18, 4),
(29, 6),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `interns_addresses`
--

CREATE TABLE `interns_addresses` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `addresse_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interns_addresses`
--

INSERT INTO `interns_addresses` (`id`, `intern_id`, `addresse_name`) VALUES
(16, 1, 'Moulins-lès-Metz, Grand-Est, France'),
(17, 2, 'Metz, Grand-Est, France'),
(18, 3, 'Metz, Grand-Est, France'),
(19, 4, 'Nanterre, Île-de-France, France'),
(20, 6, 'Méteren, Hauts-de-France, France'),
(21, 7, 'Meudon, Île-de-France, France');

-- --------------------------------------------------------

--
-- Table structure for table `interns_qualifications_level`
--

CREATE TABLE `interns_qualifications_level` (
  `intern_id` int(11) NOT NULL,
  `qualification_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interns_qualifications_level`
--

INSERT INTO `interns_qualifications_level` (`intern_id`, `qualification_level_id`) VALUES
(1, 4),
(2, 1),
(3, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `interns_skills`
--

CREATE TABLE `interns_skills` (
  `skill_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interns_skills`
--

INSERT INTO `interns_skills` (`skill_id`, `intern_id`) VALUES
(245, 1),
(232, 2),
(230, 3),
(243, 4),
(4, 6),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `intern_like` tinyint(4) NOT NULL DEFAULT '0',
  `enterprise_like` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mp`
--

CREATE TABLE `mp` (
  `id` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `dest` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications_level`
--

CREATE TABLE `qualifications_level` (
  `id` int(11) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qualifications_level`
--

INSERT INTO `qualifications_level` (`id`, `level`) VALUES
(1, 'Sans diplôme'),
(2, 'Niveau V (DNB, BEP, CAP)'),
(3, 'Niveau IV (Bac +0)'),
(4, 'Niveau III (Bac +1 et Bac +2)'),
(5, 'Niveau II (Bac +3 et Bac +4)'),
(6, 'Niveau I (Bac +5 et plus)');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(31, 'Esprit d\'équipe'),
(33, 'Intelligent'),
(34, 'Inventif'),
(35, 'Innovateur'),
(36, 'Ingénieux'),
(37, 'Indépendant'),
(38, 'Imaginatif'),
(39, 'Logique'),
(40, 'Méthodique'),
(41, 'Médiateur'),
(42, 'Méticuleux'),
(43, 'Mobile'),
(44, 'Motivé'),
(45, 'Original'),
(46, 'Optimiste'),
(47, 'Ordonné'),
(48, 'Passionné'),
(49, 'Patient'),
(51, 'Persévérant'),
(52, 'Perspicace'),
(53, 'Persuasif'),
(54, 'Ponctuel'),
(55, 'Polyvalent'),
(56, 'Positif'),
(57, 'Raisonnable'),
(58, 'Réservé'),
(59, 'Sociable'),
(65, 'Perfectionniste'),
(230, 'Ambitieux'),
(231, 'Amical'),
(232, 'Artiste'),
(233, 'Assidu'),
(234, 'Audacieux'),
(235, 'Autonome'),
(236, 'Convaincant'),
(237, 'Combatif'),
(238, 'Calme'),
(239, 'Compétitif'),
(240, 'Compréhensif'),
(241, 'Conciliant'),
(242, 'Confiant'),
(243, 'Consciencieux'),
(244, 'Courageux'),
(245, 'Créatif'),
(246, 'Curieux'),
(247, 'Débrouillard'),
(248, 'Déterminé'),
(249, 'Dévoué'),
(250, 'Diplomate'),
(251, 'Dynamique'),
(252, 'Disponible'),
(253, 'Discret'),
(261, 'e'),
(278, 'Aidant'),
(279, 'Altruiste');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_area`
--
ALTER TABLE `activity_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enterprises_addresses`
--
ALTER TABLE `enterprises_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interns_addresses`
--
ALTER TABLE `interns_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp`
--
ALTER TABLE `mp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications_level`
--
ALTER TABLE `qualifications_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_area`
--
ALTER TABLE `activity_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `enterprises_addresses`
--
ALTER TABLE `enterprises_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `interns_addresses`
--
ALTER TABLE `interns_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mp`
--
ALTER TABLE `mp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `qualifications_level`
--
ALTER TABLE `qualifications_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;
