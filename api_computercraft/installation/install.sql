-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 192.168.2.52
-- Généré le : sam. 18 nov. 2023 à 12:55
-- Version du serveur : 10.7.3-MariaDB-1:10.7.3+maria~focal
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mc_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id_adresse` int(11) UNSIGNED NOT NULL,
  `nom_adresse` varchar(50) NOT NULL,
  `coo_adresse` varchar(50) NOT NULL,
  `description_adresse` varchar(450) NOT NULL,
  `id_type_adresse` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `apikeys`
--

CREATE TABLE `apikeys` (
  `id_apikey` int(11) UNSIGNED NOT NULL,
  `mdp_apikey` varchar(200) NOT NULL,
  `nom_apikey` varchar(50) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `apikeys_droits`
--

CREATE TABLE `apikeys_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `id_apikey` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chemins_type_commandes`
--

CREATE TABLE `chemins_type_commandes` (
  `id_chemin_type_commandes` int(11) UNSIGNED NOT NULL,
  `client_chemin_type_commandes` tinyint(1) NOT NULL,
  `vendeur_chemin_type_commandes` tinyint(1) NOT NULL,
  `livreur_chemin_type_commandes` tinyint(1) NOT NULL,
  `admin_chemin_type_commandes` tinyint(1) NOT NULL,
  `id_type_commande_debut` int(11) UNSIGNED NOT NULL,
  `id_type_commande_suite` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chemins_type_commandes`
--

INSERT INTO `chemins_type_commandes` (`id_chemin_type_commandes`, `client_chemin_type_commandes`, `vendeur_chemin_type_commandes`, `livreur_chemin_type_commandes`, `admin_chemin_type_commandes`, `id_type_commande_debut`, `id_type_commande_suite`) VALUES
(1, 0, 1, 0, 0, 1, 2),
(2, 0, 1, 0, 0, 1, 3),
(3, 0, 0, 0, 1, 3, 4),
(4, 0, 0, 0, 1, 3, 5),
(5, 0, 1, 0, 0, 5, 6),
(6, 0, 0, 1, 0, 6, 7),
(7, 0, 0, 1, 0, 7, 8),
(8, 0, 0, 1, 0, 8, 7),
(9, 0, 0, 1, 0, 7, 9),
(10, 0, 0, 1, 0, 9, 10),
(11, 1, 0, 0, 0, 10, 11),
(12, 1, 0, 0, 0, 10, 12),
(13, 1, 0, 0, 0, 12, 13),
(14, 1, 0, 0, 0, 1, 14),
(15, 1, 0, 0, 0, 3, 14),
(16, 1, 0, 0, 0, 5, 14),
(17, 1, 0, 0, 0, 6, 14),
(18, 0, 1, 0, 0, 15, 16);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(11) UNSIGNED NOT NULL,
  `nom_commande` varchar(50) NOT NULL,
  `quantite_commande` int(11) UNSIGNED NOT NULL,
  `prix_unitaire_commande` decimal(15,2) UNSIGNED NOT NULL,
  `frais_livraison` decimal(15,2) UNSIGNED NOT NULL,
  `description_commande` varchar(450) NOT NULL,
  `suivi_commande` varchar(4096) NOT NULL,
  `date_commande_commande` datetime NOT NULL,
  `date_livraison_commande` datetime DEFAULT NULL,
  `code_retrait_commande` varchar(50) NOT NULL,
  `id_type_commande` int(11) UNSIGNED NOT NULL,
  `id_livreur` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_client` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_vendeur` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse_client` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse_vendeur` int(11) UNSIGNED DEFAULT NULL,
  `id_offre` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) UNSIGNED NOT NULL,
  `nom_compte` varchar(50) NOT NULL,
  `solde_compte` double UNSIGNED NOT NULL,
  `id_type_compte` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `nom_droit` varchar(50) NOT NULL,
  `fonction_droit` varchar(50) NOT NULL,
  `groupe_droit` tinyint(1) NOT NULL,
  `apikey_droit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id_droit`, `nom_droit`, `fonction_droit`, `groupe_droit`, `apikey_droit`) VALUES
(1, 'getAdresses', 'getAdresses', 1, 1),
(2, 'getApiKeys', 'getApiKeys', 1, 1),
(3, 'getComptes', 'getComptes', 1, 1),
(4, 'getDroits', 'getDroits', 1, 1),
(5, 'getApiKeysDroits', 'getApiKeysDroits', 1, 1),
(6, 'getGroupes', 'getGroupes', 1, 1),
(7, 'getJoueurs', 'getJoueurs', 1, 1),
(8, 'getLivreurs', 'getLivreurs', 1, 1),
(9, 'getOffres', 'getOffres', 1, 1),
(10, 'editCompteNom', 'editCompteNom', 1, 1),
(11, 'editAdresseNom', 'editAdresseNom', 1, 1),
(12, 'editAdresseDescription', 'editAdresseDescription', 1, 1),
(13, 'editAdresseCoo', 'editAdresseCoo', 1, 1),
(14, 'addKeyPay', 'addKeyPay', 1, 1),
(15, 'getKeyPaysByOffre', 'getKeyPaysByOffre', 1, 1),
(16, 'addTransactionViaApiKey', 'addTransactionViaApiKey', 1, 1),
(17, 'getTransactionsByCompte', 'getTransactionsByCompte', 1, 1),
(18, 'getTransactionsByCompteAndCommande', 'getTransactionsByCompteAndCommande', 1, 1),
(19, 'addAdresseToOffre', 'addAdresseToOffre', 1, 1),
(20, 'addCompteToOffre', 'addCompteToOffre', 1, 1),
(21, 'editOffreAdresse', 'editOffreAdresse', 1, 1),
(22, 'editOffreCompte', 'editOffreCompte', 1, 1),
(23, 'editOffreDescription', 'editOffreDescription', 1, 1),
(24, 'editOffreNom', 'editOffreNom', 1, 1),
(25, 'editOffrePrix', 'editOffrePrix', 1, 1),
(26, 'editOffreStock', 'editOffreStock', 1, 1),
(27, 'editOffreType', 'editOffreType', 1, 1),
(28, 'getOffresByAdresse', 'getOffresByAdresse', 1, 1),
(29, 'getOffresByCompte', 'getOffresByCompte', 1, 1),
(30, 'addAdresseToLivreur', 'addAdresseToLivreur', 1, 1),
(31, 'addCompteToLivreur', 'addCompteToLivreur', 1, 1),
(32, 'editLivreurAdresse', 'editLivreurAdresse', 1, 1),
(33, 'editLivreurCompte', 'editLivreurCompte', 1, 1),
(34, 'editLivreurNom', 'editLivreurNom', 1, 1),
(35, 'getLivreursByAdresse', 'getLivreursByAdresse', 1, 1),
(36, 'getLivreursByCompte', 'getLivreursByCompte', 1, 1),
(37, 'addCommandeViaApiKey', 'addCommandeViaApiKey', 1, 1),
(38, 'addAdresseToCommande', 'addAdresseToCommande', 1, 1),
(39, 'addCompteToCommande', 'addCompteToCommande', 1, 1),
(40, 'livreurValideNewCommande', 'livreurValideNewCommande', 1, 1),
(41, 'clientEditStatusCommande', 'clientEditStatusCommande', 1, 1),
(42, 'livreurEditStatusCommande', 'livreurEditStatusCommande', 1, 1),
(43, 'vendeurEditStatusCommande', 'vendeurEditStatusCommande', 1, 1),
(44, 'clientGetCommande', 'clientGetCommande', 1, 1),
(45, 'livreurGetCommande', 'livreurGetCommande', 1, 1),
(46, 'vendeurGetCommande', 'vendeurGetCommande', 1, 1),
(47, 'getCommandeByAdresse', 'getCommandeByAdresse', 1, 1),
(48, 'getCommandeByAdresseClient', 'getCommandeByAdresseClient', 1, 1),
(49, 'getCommandeByAdresseVendeur', 'getCommandeByAdresseVendeur', 1, 1),
(50, 'getCommandeByCompte', 'getCommandeByCompte', 1, 1),
(51, 'getCommandeByCompteClient', 'getCommandeByCompteClient', 1, 1),
(52, 'getCommandeByCompteVendeur', 'getCommandeByCompteVendeur', 1, 1),
(53, 'getCommandeByLivreur', 'getCommandeByLivreur', 1, 1),
(54, 'getCommandeByOffre', 'getCommandeByOffre', 1, 1),
(55, 'editLitigeMsgsByCommandeClient', 'editLitigeMsgsByCommandeClient', 1, 1),
(56, 'editLitigeMsgsByCommandeLivreur', 'editLitigeMsgsByCommandeLivreur', 1, 1),
(57, 'editLitigeMsgsByCommandeVendeur', 'editLitigeMsgsByCommandeVendeur', 1, 1),
(58, 'getLitigeMsgsByCommandeClient', 'getLitigeMsgsByCommandeClient', 1, 1),
(59, 'getLitigeMsgsByCommandeLivreur', 'getLitigeMsgsByCommandeLivreur', 1, 1),
(60, 'getLitigeMsgsByCommandeVendeur', 'getLitigeMsgsByCommandeVendeur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `nom_groupe` varchar(50) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_adresses`
--

CREATE TABLE `groupes_adresses` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_adresse` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_apikeys`
--

CREATE TABLE `groupes_apikeys` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_apikey` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_comptes`
--

CREATE TABLE `groupes_comptes` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_droits`
--

CREATE TABLE `groupes_droits` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_droit` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_joueurs`
--

CREATE TABLE `groupes_joueurs` (
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_livreurs`
--

CREATE TABLE `groupes_livreurs` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_livreur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_offres`
--

CREATE TABLE `groupes_offres` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `jetons`
--

CREATE TABLE `jetons` (
  `id_jeton` int(11) UNSIGNED NOT NULL,
  `jeton1_jeton` int(11) UNSIGNED NOT NULL,
  `jeton10_jeton` int(11) UNSIGNED NOT NULL,
  `jeton100_jeton` int(11) UNSIGNED NOT NULL,
  `jeton1k_jeton` int(11) UNSIGNED NOT NULL,
  `jeton10k_jeton` int(11) UNSIGNED NOT NULL,
  `last_update_jeton` datetime NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `pseudo_joueur` varchar(50) NOT NULL,
  `mdp_joueur` varchar(200) NOT NULL,
  `max_offres_joueur` int(11) UNSIGNED NOT NULL,
  `email_joueur` varchar(50) NOT NULL,
  `resettoken_joueur` varchar(50) DEFAULT NULL,
  `last_login_joueur` datetime NOT NULL,
  `expire_resettoken_joueur` datetime DEFAULT NULL,
  `id_type_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keypays`
--

CREATE TABLE `keypays` (
  `id_keypay` int(11) UNSIGNED NOT NULL,
  `cle_keypay` varchar(50) NOT NULL,
  `date_expire_keypay` datetime NOT NULL,
  `quantite_keypay` int(11) UNSIGNED NOT NULL,
  `prix_unitaire_keypay` decimal(15,2) UNSIGNED NOT NULL,
  `id_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `livreurs`
--

CREATE TABLE `livreurs` (
  `id_livreur` int(11) UNSIGNED NOT NULL,
  `nom_livreur` varchar(50) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `msg_litiges`
--

CREATE TABLE `msg_litiges` (
  `id_msg_litige` int(11) UNSIGNED NOT NULL,
  `texte_msg_litige` varchar(450) NOT NULL,
  `date_msg_litige` datetime NOT NULL,
  `id_type_msg_litige` int(11) UNSIGNED NOT NULL,
  `id_commande` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id_offre` int(11) UNSIGNED NOT NULL,
  `prix_offre` decimal(15,2) UNSIGNED NOT NULL,
  `stock_offre` int(11) UNSIGNED NOT NULL,
  `nom_offre` varchar(50) NOT NULL,
  `description_offre` varchar(450) NOT NULL,
  `last_update_offre` datetime NOT NULL,
  `id_type_offre` int(11) UNSIGNED NOT NULL,
  `id_adresse` int(11) UNSIGNED DEFAULT NULL,
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) UNSIGNED NOT NULL,
  `nom_transaction` varchar(50) NOT NULL,
  `somme_transaction` int(11) UNSIGNED NOT NULL,
  `description_transaction` varchar(450) NOT NULL,
  `date_transaction` datetime NOT NULL,
  `id_type_transaction` int(11) UNSIGNED NOT NULL,
  `id_commande` int(11) UNSIGNED DEFAULT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_debiteur` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_crediteur` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_adresses`
--

CREATE TABLE `type_adresses` (
  `id_type_adresse` int(11) UNSIGNED NOT NULL,
  `nom_type_adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_adresses`
--

INSERT INTO `type_adresses` (`id_type_adresse`, `nom_type_adresse`) VALUES
(1, 'reception'),
(2, 'point relai'),
(3, 'commerce mixte'),
(4, 'commerce local'),
(5, 'commerce auto');

-- --------------------------------------------------------

--
-- Structure de la table `type_commandes`
--

CREATE TABLE `type_commandes` (
  `id_type_commande` int(11) UNSIGNED NOT NULL,
  `nom_type_commande` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_commandes`
--

INSERT INTO `type_commandes` (`id_type_commande`, `nom_type_commande`) VALUES
(1, 'validation en attente'),
(2, 'validation refuser'),
(3, 'paiement en attente'),
(4, 'paiement refuser'),
(5, 'preparation en cours'),
(6, 'livraison en attente'),
(7, 'livraison en cours'),
(8, 'livraison en pause'),
(9, 'livraison en point'),
(10, 'livrer'),
(11, 'valider'),
(12, 'refuser'),
(13, 'litige'),
(14, 'annuler'),
(15, 'commande direct en attente'),
(16, 'commande direct terminer');

-- --------------------------------------------------------

--
-- Structure de la table `type_comptes`
--

CREATE TABLE `type_comptes` (
  `id_type_compte` int(11) UNSIGNED NOT NULL,
  `nom_type_compte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_comptes`
--

INSERT INTO `type_comptes` (`id_type_compte`, `nom_type_compte`) VALUES
(1, 'courant'),
(2, 'entreprise_livreur'),
(3, 'entreprise_commerce');

-- --------------------------------------------------------

--
-- Structure de la table `type_joueurs`
--

CREATE TABLE `type_joueurs` (
  `id_type_joueur` int(11) UNSIGNED NOT NULL,
  `nom_type_joueur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_joueurs`
--

INSERT INTO `type_joueurs` (`id_type_joueur`, `nom_type_joueur`) VALUES
(1, 'utilisateur'),
(2, 'admin'),
(3, 'terminal');

-- --------------------------------------------------------

--
-- Structure de la table `type_msg_litiges`
--

CREATE TABLE `type_msg_litiges` (
  `id_type_msg_litige` int(11) UNSIGNED NOT NULL,
  `nom_type_msg_litige` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_msg_litiges`
--

INSERT INTO `type_msg_litiges` (`id_type_msg_litige`, `nom_type_msg_litige`) VALUES
(1, 'requete'),
(2, 'message'),
(3, 'proposition'),
(4, 'resolution'),
(5, 'validation'),
(6, 'rejet');

-- --------------------------------------------------------

--
-- Structure de la table `type_offres`
--

CREATE TABLE `type_offres` (
  `id_type_offre` int(11) UNSIGNED NOT NULL,
  `nom_type_offre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_offres`
--

INSERT INTO `type_offres` (`id_type_offre`, `nom_type_offre`) VALUES
(1, 'produit'),
(2, 'liquide'),
(3, 'gaz'),
(4, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `type_transactions`
--

CREATE TABLE `type_transactions` (
  `id_type_transaction` int(11) UNSIGNED NOT NULL,
  `nom_type_transaction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_transactions`
--

INSERT INTO `type_transactions` (`id_type_transaction`, `nom_type_transaction`) VALUES
(1, 'retrait'),
(2, 'depot'),
(3, 'achat'),
(4, 'remboursement'),
(5, 'livraison'),
(6, 'transfert'),
(7, 'abonnement');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vw_joueurs`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vw_joueurs` (
`id_joueur` int(11)
,`pseudo_joueur` varchar(50)
,`email_joueur` varchar(50)
,`last_login_joueur` datetime
,`max_offres_joueur` int(11)
,`id_type_joueur` int(11)
,`nom_type_joueur` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vw_joueurs`
--
DROP TABLE IF EXISTS `vw_joueurs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vampi62`@`%` SQL SECURITY DEFINER VIEW `vw_joueurs`  AS SELECT `joueurs`.`id_joueur` AS `id_joueur`, `joueurs`.`pseudo_joueur` AS `pseudo_joueur`, `joueurs`.`email_joueur` AS `email_joueur`, `joueurs`.`last_login_joueur` AS `last_login_joueur`, `joueurs`.`max_offres_joueur` AS `max_offres_joueur`, `joueurs`.`id_type_joueur` AS `id_type_joueur`, `type_joueurs`.`nom_type_joueur` AS `nom_type_joueur` FROM (`joueurs` join `type_joueurs` on(`joueurs`.`id_type_joueur` = `type_joueurs`.`id_type_joueur`))  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `adresses_ibfk_1` (`id_type_adresse`),
  ADD KEY `adresses_ibfk_2` (`id_joueur`);

--
-- Index pour la table `apikeys`
--
ALTER TABLE `apikeys`
  ADD PRIMARY KEY (`id_apikey`),
  ADD KEY `apikeys_ibfk_1` (`id_joueur`);

--
-- Index pour la table `apikeys_droits`
--
ALTER TABLE `apikeys_droits`
  ADD PRIMARY KEY (`id_droit`,`id_apikey`),
  ADD KEY `apikeys_droits_ibfk_2` (`id_apikey`);

--
-- Index pour la table `chemins_type_commandes`
--
ALTER TABLE `chemins_type_commandes`
  ADD PRIMARY KEY (`id_chemin_type_commandes`),
  ADD KEY `chemins_type_commandes_ibfk_1` (`id_type_commande_debut`),
  ADD KEY `chemins_type_commandes_ibfk_2` (`id_type_commande_suite`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `commandes_ibfk_1` (`id_type_commande`),
  ADD KEY `commandes_ibfk_2` (`id_livreur`),
  ADD KEY `commandes_ibfk_3` (`id_compte_client`),
  ADD KEY `commandes_ibfk_4` (`id_compte_vendeur`),
  ADD KEY `commandes_ibfk_5` (`id_adresse_client`),
  ADD KEY `commandes_ibfk_6` (`id_adresse_vendeur`),
  ADD KEY `commandes_ibfk_7` (`id_offre`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `comptes_ibfk_1` (`id_type_compte`),
  ADD KEY `comptes_ibfk_2` (`id_joueur`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `groupes_ibfk_1` (`id_joueur`);

--
-- Index pour la table `groupes_adresses`
--
ALTER TABLE `groupes_adresses`
  ADD PRIMARY KEY (`id_groupe`,`id_adresse`),
  ADD KEY `groupes_adresses_ibfk_2` (`id_adresse`);

--
-- Index pour la table `groupes_apikeys`
--
ALTER TABLE `groupes_apikeys`
  ADD PRIMARY KEY (`id_groupe`,`id_apikey`),
  ADD KEY `groupes_apikeys_ibfk_2` (`id_apikey`);

--
-- Index pour la table `groupes_comptes`
--
ALTER TABLE `groupes_comptes`
  ADD PRIMARY KEY (`id_groupe`,`id_compte`),
  ADD KEY `groupes_comptes_ibfk_2` (`id_compte`);

--
-- Index pour la table `groupes_droits`
--
ALTER TABLE `groupes_droits`
  ADD PRIMARY KEY (`id_groupe`,`id_droit`),
  ADD KEY `groupes_droits_ibfk_2` (`id_droit`);

--
-- Index pour la table `groupes_joueurs`
--
ALTER TABLE `groupes_joueurs`
  ADD PRIMARY KEY (`id_joueur`,`id_groupe`),
  ADD KEY `groupes_joueurs_ibfk_2` (`id_groupe`);

--
-- Index pour la table `groupes_livreurs`
--
ALTER TABLE `groupes_livreurs`
  ADD PRIMARY KEY (`id_groupe`,`id_livreur`),
  ADD KEY `groupes_livreurs_ibfk_2` (`id_livreur`);

--
-- Index pour la table `groupes_offres`
--
ALTER TABLE `groupes_offres`
  ADD PRIMARY KEY (`id_groupe`,`id_offre`),
  ADD KEY `groupes_offres_ibfk_2` (`id_offre`);

--
-- Index pour la table `jetons`
--
ALTER TABLE `jetons`
  ADD PRIMARY KEY (`id_jeton`),
  ADD KEY `jetons_ibfk_1` (`id_joueur`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `joueurs_ibfk_1` (`id_type_joueur`);

--
-- Index pour la table `keypays`
--
ALTER TABLE `keypays`
  ADD PRIMARY KEY (`id_keypay`),
  ADD KEY `keypays_ibfk_1` (`id_offre`);

--
-- Index pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD PRIMARY KEY (`id_livreur`),
  ADD KEY `livreurs_ibfk_1` (`id_joueur`),
  ADD KEY `livreurs_ibfk_2` (`id_compte`),
  ADD KEY `livreurs_ibfk_3` (`id_adresse`);

--
-- Index pour la table `msg_litiges`
--
ALTER TABLE `msg_litiges`
  ADD PRIMARY KEY (`id_msg_litige`),
  ADD KEY `msg_litiges_ibfk_1` (`id_type_msg_litige`),
  ADD KEY `msg_litiges_ibfk_2` (`id_commande`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `offres_ibfk_1` (`id_type_offre`),
  ADD KEY `offres_ibfk_2` (`id_adresse`),
  ADD KEY `offres_ibfk_3` (`id_compte`),
  ADD KEY `offres_ibfk_4` (`id_joueur`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transactions_ibfk_1` (`id_type_transaction`),
  ADD KEY `transactions_ibfk_2` (`id_commande`),
  ADD KEY `transactions_ibfk_3` (`id_joueur`),
  ADD KEY `transactions_ibfk_4` (`id_compte_debiteur`),
  ADD KEY `transactions_ibfk_5` (`id_compte_crediteur`);

--
-- Index pour la table `type_adresses`
--
ALTER TABLE `type_adresses`
  ADD PRIMARY KEY (`id_type_adresse`);

--
-- Index pour la table `type_commandes`
--
ALTER TABLE `type_commandes`
  ADD PRIMARY KEY (`id_type_commande`);

--
-- Index pour la table `type_comptes`
--
ALTER TABLE `type_comptes`
  ADD PRIMARY KEY (`id_type_compte`);

--
-- Index pour la table `type_joueurs`
--
ALTER TABLE `type_joueurs`
  ADD PRIMARY KEY (`id_type_joueur`);

--
-- Index pour la table `type_msg_litiges`
--
ALTER TABLE `type_msg_litiges`
  ADD PRIMARY KEY (`id_type_msg_litige`);

--
-- Index pour la table `type_offres`
--
ALTER TABLE `type_offres`
  ADD PRIMARY KEY (`id_type_offre`);

--
-- Index pour la table `type_transactions`
--
ALTER TABLE `type_transactions`
  ADD PRIMARY KEY (`id_type_transaction`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `apikeys`
--
ALTER TABLE `apikeys`
  MODIFY `id_apikey` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chemins_type_commandes`
--
ALTER TABLE `chemins_type_commandes`
  MODIFY `id_chemin_type_commandes` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id_droit` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id_groupe` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jetons`
--
ALTER TABLE `jetons`
  MODIFY `id_jeton` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keypays`
--
ALTER TABLE `keypays`
  MODIFY `id_keypay` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livreurs`
--
ALTER TABLE `livreurs`
  MODIFY `id_livreur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `msg_litiges`
--
ALTER TABLE `msg_litiges`
  MODIFY `id_msg_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id_offre` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_adresses`
--
ALTER TABLE `type_adresses`
  MODIFY `id_type_adresse` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type_commandes`
--
ALTER TABLE `type_commandes`
  MODIFY `id_type_commande` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `type_comptes`
--
ALTER TABLE `type_comptes`
  MODIFY `id_type_compte` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_joueurs`
--
ALTER TABLE `type_joueurs`
  MODIFY `id_type_joueur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_msg_litiges`
--
ALTER TABLE `type_msg_litiges`
  MODIFY `id_type_msg_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_offres`
--
ALTER TABLE `type_offres`
  MODIFY `id_type_offre` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_transactions`
--
ALTER TABLE `type_transactions`
  MODIFY `id_type_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`id_type_adresse`) REFERENCES `type_adresses` (`id_type_adresse`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adresses_ibfk_2` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `apikeys`
--
ALTER TABLE `apikeys`
  ADD CONSTRAINT `apikeys_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `apikeys_droits`
--
ALTER TABLE `apikeys_droits`
  ADD CONSTRAINT `apikeys_droits_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id_droit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `apikeys_droits_ibfk_2` FOREIGN KEY (`id_apikey`) REFERENCES `apikeys` (`id_apikey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chemins_type_commandes`
--
ALTER TABLE `chemins_type_commandes`
  ADD CONSTRAINT `chemins_type_commandes_ibfk_1` FOREIGN KEY (`id_type_commande_debut`) REFERENCES `type_commandes` (`id_type_commande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chemins_type_commandes_ibfk_2` FOREIGN KEY (`id_type_commande_suite`) REFERENCES `type_commandes` (`id_type_commande`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_type_commande`) REFERENCES `type_commandes` (`id_type_commande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_livreur`) REFERENCES `livreurs` (`id_livreur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`id_compte_client`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_4` FOREIGN KEY (`id_compte_vendeur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_5` FOREIGN KEY (`id_adresse_client`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_6` FOREIGN KEY (`id_adresse_vendeur`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_7` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`id_type_compte`) REFERENCES `type_comptes` (`id_type_compte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_ibfk_2` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `groupes_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_adresses`
--
ALTER TABLE `groupes_adresses`
  ADD CONSTRAINT `groupes_adresses_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_adresses_ibfk_2` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_apikeys`
--
ALTER TABLE `groupes_apikeys`
  ADD CONSTRAINT `groupes_apikeys_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_apikeys_ibfk_2` FOREIGN KEY (`id_apikey`) REFERENCES `apikeys` (`id_apikey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_comptes`
--
ALTER TABLE `groupes_comptes`
  ADD CONSTRAINT `groupes_comptes_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_comptes_ibfk_2` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_droits`
--
ALTER TABLE `groupes_droits`
  ADD CONSTRAINT `groupes_droits_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_droits_ibfk_2` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id_droit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_joueurs`
--
ALTER TABLE `groupes_joueurs`
  ADD CONSTRAINT `groupes_joueurs_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_joueurs_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_livreurs`
--
ALTER TABLE `groupes_livreurs`
  ADD CONSTRAINT `groupes_livreurs_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_livreurs_ibfk_2` FOREIGN KEY (`id_livreur`) REFERENCES `livreurs` (`id_livreur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_offres`
--
ALTER TABLE `groupes_offres`
  ADD CONSTRAINT `groupes_offres_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_offres_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `jetons`
--
ALTER TABLE `jetons`
  ADD CONSTRAINT `jetons_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_ibfk_1` FOREIGN KEY (`id_type_joueur`) REFERENCES `type_joueurs` (`id_type_joueur`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `keypays`
--
ALTER TABLE `keypays`
  ADD CONSTRAINT `keypays_ibfk_1` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD CONSTRAINT `livreurs_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livreurs_ibfk_2` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `livreurs_ibfk_3` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `msg_litiges`
--
ALTER TABLE `msg_litiges`
  ADD CONSTRAINT `msg_litiges_ibfk_1` FOREIGN KEY (`id_type_msg_litige`) REFERENCES `type_msg_litiges` (`id_type_msg_litige`) ON UPDATE CASCADE,
  ADD CONSTRAINT `msg_litiges_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_ibfk_1` FOREIGN KEY (`id_type_offre`) REFERENCES `type_offres` (`id_type_offre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_ibfk_2` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_ibfk_3` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_ibfk_4` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_type_transaction`) REFERENCES `type_transactions` (`id_type_transaction`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`id_compte_debiteur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_5` FOREIGN KEY (`id_compte_crediteur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
