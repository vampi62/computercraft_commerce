-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 192.168.2.52
-- Généré le : dim. 28 mai 2023 à 20:36
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
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_type_adresse` int(11) UNSIGNED NOT NULL,
  `id_livreur` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chemin_status_commandes`
--

CREATE TABLE `chemin_status_commandes` (
  `id_chemin_status` int(11) UNSIGNED NOT NULL,
  `client_chemin_status` tinyint(1) UNSIGNED NOT NULL,
  `vendeur_chemin_status` tinyint(1) UNSIGNED NOT NULL,
  `livreur_chemin_status` tinyint(1) UNSIGNED NOT NULL,
  `admin_chemin_status` tinyint(1) UNSIGNED NOT NULL,
  `id_type_status_commande_debut` int(11) UNSIGNED NOT NULL,
  `id_type_status_commande_suite` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chemin_status_commandes`
--

INSERT INTO `chemin_status_commandes` (`id_chemin_status`, `client_chemin_status`, `vendeur_chemin_status`, `livreur_chemin_status`, `admin_chemin_status`, `id_type_status_commande_debut`, `id_type_status_commande_suite`) VALUES
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
(17, 1, 0, 0, 0, 6, 14);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(11) UNSIGNED NOT NULL,
  `nom_produit_commande` varchar(50) NOT NULL,
  `quantite_commande` int(11) UNSIGNED NOT NULL,
  `prix_unitaire_commande` float NOT NULL,
  `frait_livraison_commande` float NOT NULL,
  `description_commande` varchar(450) NOT NULL,
  `suivi_commande` varchar(4096) NOT NULL,
  `date_commande_commande` datetime NOT NULL,
  `date_livraison_commande` datetime DEFAULT NULL,
  `code_retrait_commande` varchar(50) NOT NULL,
  `id_offre` int(11) UNSIGNED DEFAULT NULL,
  `id_transaction` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_client` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_vendeur` int(11) UNSIGNED DEFAULT NULL,
  `id_type_status_commande` int(11) UNSIGNED NOT NULL,
  `id_livreur` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse_client` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse_vendeur` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) UNSIGNED NOT NULL,
  `nom_compte` varchar(50) NOT NULL,
  `solde_compte` double NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_type_compte` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `nom_droit` varchar(50) NOT NULL,
  `fonction_droit` varchar(50) NOT NULL,
  `groupe_droit` tinyint(1) UNSIGNED NOT NULL,
  `api_droit` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Structure de la table `groupes_comptes`
--

CREATE TABLE `groupes_comptes` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_keyapis`
--

CREATE TABLE `groupes_keyapis` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_keyapi` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_livreurs`
--

CREATE TABLE `groupes_livreurs` (
  `id_livreur` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
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
-- Structure de la table `groupes_utilisateurs`
--

CREATE TABLE `groupes_utilisateurs` (
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_droits`
--

CREATE TABLE `groupe_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `jeton`
--

CREATE TABLE `jeton` (
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
  `email_joueur` varchar(50) NOT NULL,
  `resettoken_joueur` varchar(50) DEFAULT NULL,
  `last_login_joueur` datetime NOT NULL,
  `expire_resettoken_joueur` datetime DEFAULT NULL,
  `max_offres_joueur` int(11) UNSIGNED NOT NULL,
  `id_type_role` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keyapis`
--

CREATE TABLE `keyapis` (
  `id_keyapi` int(11) UNSIGNED NOT NULL,
  `nom_keyapi` varchar(50) NOT NULL,
  `mdp_keyapi` varchar(200) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keyapis_droits`
--

CREATE TABLE `keyapis_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `id_keyapi` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keypay`
--

CREATE TABLE `keypay` (
  `id_keypay` int(11) UNSIGNED NOT NULL,
  `cle_keypay` varchar(50) NOT NULL,
  `date_expire_keypay` date NOT NULL,
  `quantite_keypay` int(11) UNSIGNED NOT NULL,
  `prix_unitaire_keypay` float NOT NULL,
  `id_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `litiges`
--

CREATE TABLE `litiges` (
  `id_litige` int(11) UNSIGNED NOT NULL,
  `texte_litige` varchar(450) NOT NULL,
  `date_litige` datetime NOT NULL,
  `id_commande` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `id_type_status_litige` int(11) UNSIGNED NOT NULL
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
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id_offre` int(11) UNSIGNED NOT NULL,
  `prix_offre` float NOT NULL,
  `stock_offre` int(11) UNSIGNED NOT NULL,
  `nom_offre` varchar(50) NOT NULL,
  `description_offre` varchar(450) NOT NULL,
  `last_update_offre` datetime NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse` int(11) UNSIGNED DEFAULT NULL,
  `id_type_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) UNSIGNED NOT NULL,
  `nom_transaction` varchar(50) NOT NULL,
  `somme_transaction` double NOT NULL,
  `description_transaction` varchar(450) NOT NULL,
  `date_transaction` datetime NOT NULL,
  `id_type_status_transaction` int(11) UNSIGNED NOT NULL,
  `id_type_transaction` int(11) UNSIGNED NOT NULL,
  `id_admin` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_debiteur` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_crediteur` int(11) UNSIGNED DEFAULT NULL,
  `id_commande` int(11)  UNSIGNED DEFAULT NULL
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
-- Structure de la table `type_roles`
--

CREATE TABLE `type_roles` (
  `id_type_role` int(11) UNSIGNED NOT NULL,
  `nom_type_role` varchar(50) NOT NULL,
  `description_type_role` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_roles`
--

INSERT INTO `type_roles` (`id_type_role`, `nom_type_role`, `description_type_role`) VALUES
(1, 'utilisateur', ''),
(2, 'admin', ''),
(3, 'terminal', '');

-- --------------------------------------------------------

--
-- Structure de la table `type_status_commandes`
--

CREATE TABLE `type_status_commandes` (
  `id_type_status_commande` int(11) UNSIGNED NOT NULL,
  `nom_type_status_commande` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_status_commandes`
--

INSERT INTO `type_status_commandes` (`id_type_status_commande`, `nom_type_status_commande`) VALUES
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
(14, 'annuler');

-- --------------------------------------------------------

--
-- Structure de la table `type_status_litiges`
--

CREATE TABLE `type_status_litiges` (
  `id_type_status_litige` int(11) UNSIGNED NOT NULL,
  `nom_type_status_litige` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_status_litiges`
--

INSERT INTO `type_status_litiges` (`id_type_status_litige`, `nom_type_status_litige`) VALUES
(1, 'requete'),
(2, 'message'),
(3, 'proposition'),
(4, 'resolution'),
(5, 'validation'),
(6, 'rejet');

-- --------------------------------------------------------

--
-- Structure de la table `type_status_transactions`
--

CREATE TABLE `type_status_transactions` (
  `id_type_status_transaction` int(11) UNSIGNED NOT NULL,
  `nom_type_status_transaction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_status_transactions`
--

INSERT INTO `type_status_transactions` (`id_type_status_transaction`, `nom_type_status_transaction`) VALUES
(1, 'en attente')
(2, 'valider'),
(3, 'refuser'),
(4, 'rembourser');
(5, 'annuler');

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
(6, 'remboursement empreint'),
(7, 'empreint'),
(8, 'transfert'),
(9, 'abonnement');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `adresses_joueurs0_FK` (`id_joueur`),
  ADD KEY `adresses_type_adresses1_FK` (`id_type_adresse`);

--
-- Index pour la table `chemin_status_commandes`
--
ALTER TABLE `chemin_status_commandes`
  ADD PRIMARY KEY (`id_chemin_status`),
  ADD KEY `chemin_status_type_status_commandes0_FK` (`id_type_status_commande_debut`),
  ADD KEY `chemin_status_type_status_commandes1_FK` (`id_type_status_commande_suite`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `commandes_adresses5_FK` (`id_adresse_client`),
  ADD KEY `commandes_adresses6_FK` (`id_adresse_vendeur`),
  ADD KEY `commandes_comptes1_FK` (`id_compte_client`),
  ADD KEY `commandes_comptes2_FK` (`id_compte_vendeur`),
  ADD KEY `commandes_livreurs4_FK` (`id_livreur`),
  ADD KEY `commandes_offres0_FK` (`id_offre`),
  ADD KEY `commandes_type_status_commandes3_FK` (`id_type_status_commande`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `comptes_joueurs0_FK` (`id_joueur`),
  ADD KEY `comptes_type_comptes1_FK` (`id_type_compte`);

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
  ADD KEY `groupes_joueurs0_FK` (`id_joueur`);

--
-- Index pour la table `groupes_adresses`
--
ALTER TABLE `groupes_adresses`
  ADD PRIMARY KEY (`id_groupe`,`id_adresse`),
  ADD KEY `groupes_adresses_adresses1_FK` (`id_adresse`);

--
-- Index pour la table `groupes_comptes`
--
ALTER TABLE `groupes_comptes`
  ADD PRIMARY KEY (`id_groupe`,`id_compte`),
  ADD KEY `groupes_comptes_comptes1_FK` (`id_compte`);

--
-- Index pour la table `groupes_keyapis`
--
ALTER TABLE `groupes_keyapis`
  ADD PRIMARY KEY (`id_groupe`,`id_keyapi`),
  ADD KEY `groupes_keyapis_keyapis1_FK` (`id_keyapi`);

--
-- Index pour la table `groupes_livreurs`
--
ALTER TABLE `groupes_livreurs`
  ADD PRIMARY KEY (`id_livreur`,`id_groupe`),
  ADD KEY `groupes_livreurs_groupes1_FK` (`id_groupe`);

--
-- Index pour la table `groupes_offres`
--
ALTER TABLE `groupes_offres`
  ADD PRIMARY KEY (`id_groupe`,`id_offre`),
  ADD KEY `groupes_offres_offres1_FK` (`id_offre`);

--
-- Index pour la table `groupes_utilisateurs`
--
ALTER TABLE `groupes_utilisateurs`
  ADD PRIMARY KEY (`id_joueur`,`id_groupe`),
  ADD KEY `groupes_utilisateurs_groupes1_FK` (`id_groupe`);

--
-- Index pour la table `groupe_droits`
--
ALTER TABLE `groupe_droits`
  ADD PRIMARY KEY (`id_droit`,`id_groupe`),
  ADD KEY `groupe_droits_groupes1_FK` (`id_groupe`);

--
-- Index pour la table `jeton`
--
ALTER TABLE `jeton`
  ADD PRIMARY KEY (`id_jeton`),
  ADD KEY `jeton_joueurs0_FK` (`id_joueur`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `joueurs_type_roles0_FK` (`id_type_role`);

--
-- Index pour la table `keyapis`
--
ALTER TABLE `keyapis`
  ADD PRIMARY KEY (`id_keyapi`),
  ADD KEY `keyapis_joueurs0_FK` (`id_joueur`);

--
-- Index pour la table `keyapis_droits`
--
ALTER TABLE `keyapis_droits`
  ADD PRIMARY KEY (`id_droit`,`id_keyapi`),
  ADD KEY `keyapi_droits_keyapis1_FK` (`id_keyapi`);

--
-- Index pour la table `keypay`
--
ALTER TABLE `keypay`
  ADD PRIMARY KEY (`id_keypay`),
  ADD KEY `keypay_offres0_FK` (`id_offre`);

--
-- Index pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD PRIMARY KEY (`id_litige`),
  ADD KEY `litiges_commandes0_FK` (`id_commande`),
  ADD KEY `litiges_joueurs1_FK` (`id_joueur`),
  ADD KEY `litiges_type_status_litiges2_FK` (`id_type_status_litige`);

--
-- Index pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD PRIMARY KEY (`id_livreur`),
  ADD KEY `livreurs_adresses2_FK` (`id_adresse`),
  ADD KEY `livreurs_comptes1_FK` (`id_compte`),
  ADD KEY `livreurs_joueurs0_FK` (`id_joueur`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `offres_adresses2_FK` (`id_adresse`),
  ADD KEY `offres_comptes1_FK` (`id_compte`),
  ADD KEY `offres_joueurs0_FK` (`id_joueur`),
  ADD KEY `offres_type_offres3_FK` (`id_type_offre`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transactions_commandes5_FK` (`id_commande`),
  ADD KEY `transactions_comptes3_FK` (`id_compte_debiteur`),
  ADD KEY `transactions_comptes4_FK` (`id_compte_crediteur`),
  ADD KEY `transactions_joueurs2_FK` (`id_admin`),
  ADD KEY `transactions_type_status_transactions0_FK` (`id_type_status_transaction`),
  ADD KEY `transactions_type_transactions1_FK` (`id_type_transaction`);

--
-- Index pour la table `type_adresses`
--
ALTER TABLE `type_adresses`
  ADD PRIMARY KEY (`id_type_adresse`);

--
-- Index pour la table `type_comptes`
--
ALTER TABLE `type_comptes`
  ADD PRIMARY KEY (`id_type_compte`);

--
-- Index pour la table `type_offres`
--
ALTER TABLE `type_offres`
  ADD PRIMARY KEY (`id_type_offre`);

--
-- Index pour la table `type_roles`
--
ALTER TABLE `type_roles`
  ADD PRIMARY KEY (`id_type_role`);

--
-- Index pour la table `type_status_commandes`
--
ALTER TABLE `type_status_commandes`
  ADD PRIMARY KEY (`id_type_status_commande`);

--
-- Index pour la table `type_status_litiges`
--
ALTER TABLE `type_status_litiges`
  ADD PRIMARY KEY (`id_type_status_litige`);

--
-- Index pour la table `type_status_transactions`
--
ALTER TABLE `type_status_transactions`
  ADD PRIMARY KEY (`id_type_status_transaction`);

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
-- AUTO_INCREMENT pour la table `chemin_status_commandes`
--
ALTER TABLE `chemin_status_commandes`
  MODIFY `id_chemin_status` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id_droit` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id_groupe` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jeton`
--
ALTER TABLE `jeton`
  MODIFY `id_jeton` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keyapis`
--
ALTER TABLE `keyapis`
  MODIFY `id_keyapi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keypay`
--
ALTER TABLE `keypay`
  MODIFY `id_keypay` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `litiges`
--
ALTER TABLE `litiges`
  MODIFY `id_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livreurs`
--
ALTER TABLE `livreurs`
  MODIFY `id_livreur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `type_comptes`
--
ALTER TABLE `type_comptes`
  MODIFY `id_type_compte` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_offres`
--
ALTER TABLE `type_offres`
  MODIFY `id_type_offre` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_roles`
--
ALTER TABLE `type_roles`
  MODIFY `id_type_role` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_status_commandes`
--
ALTER TABLE `type_status_commandes`
  MODIFY `id_type_status_commande` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `type_status_litiges`
--
ALTER TABLE `type_status_litiges`
  MODIFY `id_type_status_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_status_transactions`
--
ALTER TABLE `type_status_transactions`
  MODIFY `id_type_status_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_transactions`
--
ALTER TABLE `type_transactions`
  MODIFY `id_type_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adresses_type_adresses1_FK` FOREIGN KEY (`id_type_adresse`) REFERENCES `type_adresses` (`id_type_adresse`) ON UPDATE CASCADE;
  ADD CONSTRAINT `adresses_id_livreur2_FK` FOREIGN KEY (`id_livreur`) REFERENCES `livreurs`(`id_livreur`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `chemin_status_commandes`
--
ALTER TABLE `chemin_status_commandes`
  ADD CONSTRAINT `chemin_status_type_status_commandes0_FK` FOREIGN KEY (`id_type_status_commande_debut`) REFERENCES `type_status_commandes` (`id_type_status_commande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chemin_status_type_status_commandes1_FK` FOREIGN KEY (`id_type_status_commande_suite`) REFERENCES `type_status_commandes` (`id_type_status_commande`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_adresses5_FK` FOREIGN KEY (`id_adresse_client`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_adresses6_FK` FOREIGN KEY (`id_adresse_vendeur`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_comptes1_FK` FOREIGN KEY (`id_compte_client`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_comptes2_FK` FOREIGN KEY (`id_compte_vendeur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_livreurs4_FK` FOREIGN KEY (`id_livreur`) REFERENCES `livreurs` (`id_livreur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_offres0_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_type_status_commandes3_FK` FOREIGN KEY (`id_type_status_commande`) REFERENCES `type_status_commandes` (`id_type_status_commande`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_type_comptes1_FK` FOREIGN KEY (`id_type_compte`) REFERENCES `type_comptes` (`id_type_compte`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `groupes_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_adresses`
--
ALTER TABLE `groupes_adresses`
  ADD CONSTRAINT `groupes_adresses_adresses1_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_adresses_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_comptes`
--
ALTER TABLE `groupes_comptes`
  ADD CONSTRAINT `groupes_comptes_comptes1_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_comptes_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_keyapis`
--
ALTER TABLE `groupes_keyapis`
  ADD CONSTRAINT `groupes_keyapis_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_keyapis_keyapis1_FK` FOREIGN KEY (`id_keyapi`) REFERENCES `keyapis` (`id_keyapi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_livreurs`
--
ALTER TABLE `groupes_livreurs`
  ADD CONSTRAINT `groupes_livreurs_groupes1_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_livreurs_livreurs0_FK` FOREIGN KEY (`id_livreur`) REFERENCES `livreurs` (`id_livreur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_offres`
--
ALTER TABLE `groupes_offres`
  ADD CONSTRAINT `groupes_offres_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_offres_offres1_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes_utilisateurs`
--
ALTER TABLE `groupes_utilisateurs`
  ADD CONSTRAINT `groupes_utilisateurs_groupes1_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupes_utilisateurs_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_droits`
--
ALTER TABLE `groupe_droits`
  ADD CONSTRAINT `groupe_droits_droits0_FK` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id_droit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_droits_groupes1_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `jeton`
--
ALTER TABLE `jeton`
  ADD CONSTRAINT `jeton_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_type_roles0_FK` FOREIGN KEY (`id_type_role`) REFERENCES `type_roles` (`id_type_role`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `keyapis`
--
ALTER TABLE `keyapis`
  ADD CONSTRAINT `keyapis_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `keyapis_droits`
--
ALTER TABLE `keyapis_droits`
  ADD CONSTRAINT `keyapi_droits_droits0_FK` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id_droit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keyapi_droits_keyapis1_FK` FOREIGN KEY (`id_keyapi`) REFERENCES `keyapis` (`id_keyapi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `keypay`
--
ALTER TABLE `keypay`
  ADD CONSTRAINT `keypay_offres0_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD CONSTRAINT `litiges_commandes0_FK` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `litiges_joueurs1_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `litiges_type_status_litiges2_FK` FOREIGN KEY (`id_type_status_litige`) REFERENCES `type_status_litiges` (`id_type_status_litige`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD CONSTRAINT `livreurs_adresses2_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `livreurs_comptes1_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `livreurs_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_adresses2_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_comptes1_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_type_offres3_FK` FOREIGN KEY (`id_type_offre`) REFERENCES `type_offres` (`id_type_offre`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_commandes5_FK` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_comptes3_FK` FOREIGN KEY (`id_compte_debiteur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_comptes4_FK` FOREIGN KEY (`id_compte_crediteur`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_joueurs2_FK` FOREIGN KEY (`id_admin`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_type_status_transactions0_FK` FOREIGN KEY (`id_type_status_transaction`) REFERENCES `type_status_transactions` (`id_type_status_transaction`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_type_transactions1_FK` FOREIGN KEY (`id_type_transaction`) REFERENCES `type_transactions` (`id_type_transaction`) ON UPDATE CASCADE;

CREATE VIEW vw_joueurs AS SELECT joueurs.id_joueur, joueurs.pseudo_joueur, joueurs.email_joueur , joueurs.last_login_joueur, joueurs.max_offres_joueur, joueurs.id_type_role, type_roles.nom_type_role FROM joueurs INNER JOIN type_roles ON joueurs.id_type_role = type_roles.id_type_role;

-- tache planifiée tous les jours pour supprimer les keypay expirées
CREATE EVENT IF NOT EXISTS `event_keypay` ON SCHEDULE EVERY 1 DAY STARTS '2019-12-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM keypay WHERE date_expire_keypay < NOW();

-- tache planifiée tous les 5 min pour recuperer les transaction en attente
CREATE EVENT IF NOT EXISTS `event_transaction` ON SCHEDULE EVERY 5 MINUTE STARTS '2019-12-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE transactions SET id_type_status_transaction = 2 WHERE id_type_status_transaction = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
