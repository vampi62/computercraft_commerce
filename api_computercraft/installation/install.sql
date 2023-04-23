-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 192.168.2.52
-- Généré le : sam. 22 avr. 2023 à 08:22
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
  `nom` varchar(50) NOT NULL,
  `coo` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_type_adresse` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chemin_status`
--

CREATE TABLE `chemin_status` (
  `id_status` int(11) UNSIGNED NOT NULL,
  `client` tinyint(1) UNSIGNED NOT NULL,
  `vendeur` tinyint(1) UNSIGNED NOT NULL,
  `livreur` tinyint(1) UNSIGNED NOT NULL,
  `admin` tinyint(1) UNSIGNED NOT NULL,
  `id_types_status_commande` int(11) UNSIGNED NOT NULL,
  `id_types_status_commande_liste_types_status_commande` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(11) UNSIGNED NOT NULL,
  `nom_produit` varchar(50) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `prix_unitaire` float NOT NULL,
  `frait_livraison` float NOT NULL,
  `description` text NOT NULL,
  `suivi` text NOT NULL,
  `date_commande` datetime NOT NULL,
  `date_livraison` datetime DEFAULT NULL,
  `code_retrait` varchar(50) NOT NULL,
  `adresse_vendeur` text NOT NULL,
  `adresse_client` text NOT NULL,
  `id_offre` int(11) UNSIGNED DEFAULT NULL,
  `id_transaction` int(11) UNSIGNED DEFAULT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `id_joueur_joueurs` int(11) UNSIGNED DEFAULT NULL,
  `id_types_status_commande` int(11) UNSIGNED NOT NULL,
  `id_livreur` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `solde` double NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_type_compte` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_adresse`
--

CREATE TABLE `groupe_adresse` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_adresse` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_compte`
--

CREATE TABLE `groupe_compte` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED NOT NULL
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
-- Structure de la table `groupe_keyapi`
--

CREATE TABLE `groupe_keyapi` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_keyapi` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_livreur`
--

CREATE TABLE `groupe_livreur` (
  `id_livreur` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_offre`
--

CREATE TABLE `groupe_offre` (
  `id_groupe` int(11) UNSIGNED NOT NULL,
  `id_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_utilisateur`
--

CREATE TABLE `groupe_utilisateur` (
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_groupe` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `jeton_banque`
--

CREATE TABLE `jeton_banque` (
  `id_jeton` int(11) UNSIGNED NOT NULL,
  `p1` int(11) UNSIGNED NOT NULL,
  `p10` int(11) UNSIGNED NOT NULL,
  `p100` int(11) UNSIGNED NOT NULL,
  `p1k` int(11) UNSIGNED NOT NULL,
  `p10k` int(11) UNSIGNED NOT NULL,
  `last_update` datetime NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `resettoken` varchar(50) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `expire_resettoken` datetime DEFAULT NULL,
  `max_offres` int(11) UNSIGNED NOT NULL,
  `id_table_select_role` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keyapi`
--

CREATE TABLE `keyapi` (
  `id_keyapi` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keyapi_droits`
--

CREATE TABLE `keyapi_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `id_keyapi` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `keypay`
--

CREATE TABLE `keypay` (
  `id_keypay` int(11) UNSIGNED NOT NULL,
  `cle` varchar(200) NOT NULL,
  `date_expire` date NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `prix_unitaire` float NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_offre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_droits`
--

CREATE TABLE `liste_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `groupe` tinyint(1) UNSIGNED NOT NULL,
  `api` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_adresse`
--

CREATE TABLE `liste_types_adresse` (
  `id_type_adresse` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_compte`
--

CREATE TABLE `liste_types_compte` (
  `id_type_compte` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_produit`
--

CREATE TABLE `liste_types_produit` (
  `id_type_produit` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_status_commande`
--

CREATE TABLE `liste_types_status_commande` (
  `id_types_status_commande` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_status_litige`
--

CREATE TABLE `liste_types_status_litige` (
  `id_types_status_litige` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_status_transaction`
--

CREATE TABLE `liste_types_status_transaction` (
  `id_status_transaction` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_types_transaction`
--

CREATE TABLE `liste_types_transaction` (
  `id_type_transaction` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste_type_role`
--

CREATE TABLE `liste_type_role` (
  `id_table_select_role` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `litiges`
--

CREATE TABLE `litiges` (
  `id_litige` int(11) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `date` datetime NOT NULL,
  `id_commande` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `id_types_status_litige` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

CREATE TABLE `livreur` (
  `id_livreur` int(11) UNSIGNED NOT NULL,
  `nom_groupe` varchar(50) NOT NULL,
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
  `prix` float NOT NULL,
  `stock` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `last_update` datetime NOT NULL,
  `id_joueur` int(11) UNSIGNED NOT NULL,
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  `id_adresse` int(11) UNSIGNED DEFAULT NULL,
  `id_type_produit` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `preset_droits`
--

CREATE TABLE `preset_droits` (
  `id_droit` int(11) UNSIGNED NOT NULL,
  `id_preset_nom` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `preset_droits_nom`
--

CREATE TABLE `preset_droits_nom` (
  `id_preset_nom` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `groupe` tinyint(1) UNSIGNED NOT NULL,
  `api` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `somme` double NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `id_status_transaction` int(11) UNSIGNED NOT NULL,
  `id_type_transaction` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  `id_compte_comptes` int(11) UNSIGNED DEFAULT NULL,
  `id_commande` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `adresses_joueurs_FK` (`id_joueur`),
  ADD KEY `adresses_liste_types_adresse0_FK` (`id_type_adresse`);

--
-- Index pour la table `chemin_status`
--
ALTER TABLE `chemin_status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `chemin_status_liste_types_status_commande0_FK` (`id_types_status_commande_liste_types_status_commande`),
  ADD KEY `chemin_status_liste_types_status_commande_FK` (`id_types_status_commande`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `commandes_joueurs1_FK` (`id_joueur`),
  ADD KEY `commandes_joueurs2_FK` (`id_joueur_joueurs`),
  ADD KEY `commandes_liste_types_status_commande3_FK` (`id_types_status_commande`),
  ADD KEY `commandes_livreur4_FK` (`id_livreur`),
  ADD KEY `commandes_offres_FK` (`id_offre`),
  ADD KEY `commandes_transactions0_FK` (`id_transaction`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `comptes_joueurs_FK` (`id_joueur`),
  ADD KEY `comptes_liste_types_compte0_FK` (`id_type_compte`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `groupes_joueurs_FK` (`id_joueur`);

--
-- Index pour la table `groupe_adresse`
--
ALTER TABLE `groupe_adresse`
  ADD PRIMARY KEY (`id_groupe`,`id_adresse`),
  ADD KEY `groupe_adresse_adresses0_FK` (`id_adresse`);

--
-- Index pour la table `groupe_compte`
--
ALTER TABLE `groupe_compte`
  ADD PRIMARY KEY (`id_groupe`,`id_compte`),
  ADD KEY `groupe_compte_comptes0_FK` (`id_compte`);

--
-- Index pour la table `groupe_droits`
--
ALTER TABLE `groupe_droits`
  ADD PRIMARY KEY (`id_droit`,`id_groupe`),
  ADD KEY `groupe_droits_groupes0_FK` (`id_groupe`);

--
-- Index pour la table `groupe_keyapi`
--
ALTER TABLE `groupe_keyapi`
  ADD PRIMARY KEY (`id_groupe`,`id_keyapi`),
  ADD KEY `groupe_keyapi_keyapi0_FK` (`id_keyapi`);

--
-- Index pour la table `groupe_livreur`
--
ALTER TABLE `groupe_livreur`
  ADD PRIMARY KEY (`id_livreur`,`id_groupe`),
  ADD KEY `groupe_livreur_groupes0_FK` (`id_groupe`);

--
-- Index pour la table `groupe_offre`
--
ALTER TABLE `groupe_offre`
  ADD PRIMARY KEY (`id_groupe`,`id_offre`),
  ADD KEY `groupe_offre_offres0_FK` (`id_offre`);

--
-- Index pour la table `groupe_utilisateur`
--
ALTER TABLE `groupe_utilisateur`
  ADD PRIMARY KEY (`id_joueur`,`id_groupe`),
  ADD KEY `groupe_utilisateur_groupes0_FK` (`id_groupe`);

--
-- Index pour la table `jeton_banque`
--
ALTER TABLE `jeton_banque`
  ADD PRIMARY KEY (`id_jeton`),
  ADD KEY `jeton_banque_joueurs_FK` (`id_joueur`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `joueurs_liste_type_role_FK` (`id_table_select_role`);

--
-- Index pour la table `keyapi`
--
ALTER TABLE `keyapi`
  ADD PRIMARY KEY (`id_keyapi`),
  ADD KEY `keyapi_joueurs_FK` (`id_joueur`);

--
-- Index pour la table `keyapi_droits`
--
ALTER TABLE `keyapi_droits`
  ADD PRIMARY KEY (`id_droit`,`id_keyapi`),
  ADD KEY `keyapi_droits_keyapi0_FK` (`id_keyapi`);

--
-- Index pour la table `keypay`
--
ALTER TABLE `keypay`
  ADD PRIMARY KEY (`id_keypay`),
  ADD KEY `keypay_joueurs_FK` (`id_joueur`),
  ADD KEY `keypay_offres0_FK` (`id_offre`);

--
-- Index pour la table `liste_droits`
--
ALTER TABLE `liste_droits`
  ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `liste_types_adresse`
--
ALTER TABLE `liste_types_adresse`
  ADD PRIMARY KEY (`id_type_adresse`);

--
-- Index pour la table `liste_types_compte`
--
ALTER TABLE `liste_types_compte`
  ADD PRIMARY KEY (`id_type_compte`);

--
-- Index pour la table `liste_types_produit`
--
ALTER TABLE `liste_types_produit`
  ADD PRIMARY KEY (`id_type_produit`);

--
-- Index pour la table `liste_types_status_commande`
--
ALTER TABLE `liste_types_status_commande`
  ADD PRIMARY KEY (`id_types_status_commande`);

--
-- Index pour la table `liste_types_status_litige`
--
ALTER TABLE `liste_types_status_litige`
  ADD PRIMARY KEY (`id_types_status_litige`);

--
-- Index pour la table `liste_types_status_transaction`
--
ALTER TABLE `liste_types_status_transaction`
  ADD PRIMARY KEY (`id_status_transaction`);

--
-- Index pour la table `liste_types_transaction`
--
ALTER TABLE `liste_types_transaction`
  ADD PRIMARY KEY (`id_type_transaction`);

--
-- Index pour la table `liste_type_role`
--
ALTER TABLE `liste_type_role`
  ADD PRIMARY KEY (`id_table_select_role`);

--
-- Index pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD PRIMARY KEY (`id_litige`),
  ADD KEY `litiges_commandes_FK` (`id_commande`),
  ADD KEY `litiges_joueurs0_FK` (`id_joueur`),
  ADD KEY `litiges_liste_types_status_litige1_FK` (`id_types_status_litige`);

--
-- Index pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD PRIMARY KEY (`id_livreur`),
  ADD KEY `livreur_adresses1_FK` (`id_adresse`),
  ADD KEY `livreur_comptes0_FK` (`id_compte`),
  ADD KEY `livreur_joueurs_FK` (`id_joueur`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `offres_adresses1_FK` (`id_adresse`),
  ADD KEY `offres_comptes0_FK` (`id_compte`),
  ADD KEY `offres_joueurs_FK` (`id_joueur`),
  ADD KEY `offres_liste_types_produit2_FK` (`id_type_produit`);

--
-- Index pour la table `preset_droits`
--
ALTER TABLE `preset_droits`
  ADD PRIMARY KEY (`id_droit`,`id_preset_nom`),
  ADD KEY `preset_droits_preset_droits_nom0_FK` (`id_preset_nom`);

--
-- Index pour la table `preset_droits_nom`
--
ALTER TABLE `preset_droits_nom`
  ADD PRIMARY KEY (`id_preset_nom`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transactions_commandes4_FK` (`id_commande`),
  ADD KEY `transactions_comptes2_FK` (`id_compte`),
  ADD KEY `transactions_comptes3_FK` (`id_compte_comptes`),
  ADD KEY `transactions_joueurs1_FK` (`id_joueur`),
  ADD KEY `transactions_liste_types_status_transaction_FK` (`id_status_transaction`),
  ADD KEY `transactions_liste_types_transaction0_FK` (`id_type_transaction`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chemin_status`
--
ALTER TABLE `chemin_status`
  MODIFY `id_status` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id_groupe` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jeton_banque`
--
ALTER TABLE `jeton_banque`
  MODIFY `id_jeton` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keyapi`
--
ALTER TABLE `keyapi`
  MODIFY `id_keyapi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keypay`
--
ALTER TABLE `keypay`
  MODIFY `id_keypay` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_droits`
--
ALTER TABLE `liste_droits`
  MODIFY `id_droit` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_adresse`
--
ALTER TABLE `liste_types_adresse`
  MODIFY `id_type_adresse` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_compte`
--
ALTER TABLE `liste_types_compte`
  MODIFY `id_type_compte` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_produit`
--
ALTER TABLE `liste_types_produit`
  MODIFY `id_type_produit` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_status_commande`
--
ALTER TABLE `liste_types_status_commande`
  MODIFY `id_types_status_commande` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_status_litige`
--
ALTER TABLE `liste_types_status_litige`
  MODIFY `id_types_status_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_status_transaction`
--
ALTER TABLE `liste_types_status_transaction`
  MODIFY `id_status_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_types_transaction`
--
ALTER TABLE `liste_types_transaction`
  MODIFY `id_type_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liste_type_role`
--
ALTER TABLE `liste_type_role`
  MODIFY `id_table_select_role` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `litiges`
--
ALTER TABLE `litiges`
  MODIFY `id_litige` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livreur`
--
ALTER TABLE `livreur`
  MODIFY `id_livreur` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id_offre` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `preset_droits_nom`
--
ALTER TABLE `preset_droits_nom`
  MODIFY `id_preset_nom` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adresses_liste_types_adresse0_FK` FOREIGN KEY (`id_type_adresse`) REFERENCES `liste_types_adresse` (`id_type_adresse`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `chemin_status`
--
ALTER TABLE `chemin_status`
  ADD CONSTRAINT `chemin_status_liste_types_status_commande0_FK` FOREIGN KEY (`id_types_status_commande_liste_types_status_commande`) REFERENCES `liste_types_status_commande` (`id_types_status_commande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chemin_status_liste_types_status_commande_FK` FOREIGN KEY (`id_types_status_commande`) REFERENCES `liste_types_status_commande` (`id_types_status_commande`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_joueurs1_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_joueurs2_FK` FOREIGN KEY (`id_joueur_joueurs`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_liste_types_status_commande3_FK` FOREIGN KEY (`id_types_status_commande`) REFERENCES `liste_types_status_commande` (`id_types_status_commande`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_livreur4_FK` FOREIGN KEY (`id_livreur`) REFERENCES `livreur` (`id_livreur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_offres_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_transactions0_FK` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id_transaction`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_liste_types_compte0_FK` FOREIGN KEY (`id_type_compte`) REFERENCES `liste_types_compte` (`id_type_compte`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `groupes_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_adresse`
--
ALTER TABLE `groupe_adresse`
  ADD CONSTRAINT `groupe_adresse_adresses0_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_adresse_groupes_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_compte`
--
ALTER TABLE `groupe_compte`
  ADD CONSTRAINT `groupe_compte_comptes0_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_compte_groupes_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_droits`
--
ALTER TABLE `groupe_droits`
  ADD CONSTRAINT `groupe_droits_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_droits_liste_droits_FK` FOREIGN KEY (`id_droit`) REFERENCES `liste_droits` (`id_droit`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_keyapi`
--
ALTER TABLE `groupe_keyapi`
  ADD CONSTRAINT `groupe_keyapi_groupes_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_keyapi_keyapi0_FK` FOREIGN KEY (`id_keyapi`) REFERENCES `keyapi` (`id_keyapi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_livreur`
--
ALTER TABLE `groupe_livreur`
  ADD CONSTRAINT `groupe_livreur_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_livreur_livreur_FK` FOREIGN KEY (`id_livreur`) REFERENCES `livreur` (`id_livreur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_offre`
--
ALTER TABLE `groupe_offre`
  ADD CONSTRAINT `groupe_offre_groupes_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_offre_offres0_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_utilisateur`
--
ALTER TABLE `groupe_utilisateur`
  ADD CONSTRAINT `groupe_utilisateur_groupes0_FK` FOREIGN KEY (`id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_utilisateur_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `jeton_banque`
--
ALTER TABLE `jeton_banque`
  ADD CONSTRAINT `jeton_banque_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_liste_type_role_FK` FOREIGN KEY (`id_table_select_role`) REFERENCES `liste_type_role` (`id_table_select_role`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `keyapi`
--
ALTER TABLE `keyapi`
  ADD CONSTRAINT `keyapi_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `keyapi_droits`
--
ALTER TABLE `keyapi_droits`
  ADD CONSTRAINT `keyapi_droits_keyapi0_FK` FOREIGN KEY (`id_keyapi`) REFERENCES `keyapi` (`id_keyapi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keyapi_droits_liste_droits_FK` FOREIGN KEY (`id_droit`) REFERENCES `liste_droits` (`id_droit`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `keypay`
--
ALTER TABLE `keypay`
  ADD CONSTRAINT `keypay_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keypay_offres0_FK` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD CONSTRAINT `litiges_commandes_FK` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `litiges_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `litiges_liste_types_status_litige1_FK` FOREIGN KEY (`id_types_status_litige`) REFERENCES `liste_types_status_litige` (`id_types_status_litige`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD CONSTRAINT `livreur_adresses1_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `livreur_comptes0_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `livreur_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_adresses1_FK` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_comptes0_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_joueurs_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offres_liste_types_produit2_FK` FOREIGN KEY (`id_type_produit`) REFERENCES `liste_types_produit` (`id_type_produit`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `preset_droits`
--
ALTER TABLE `preset_droits`
  ADD CONSTRAINT `preset_droits_liste_droits_FK` FOREIGN KEY (`id_droit`) REFERENCES `liste_droits` (`id_droit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preset_droits_preset_droits_nom0_FK` FOREIGN KEY (`id_preset_nom`) REFERENCES `preset_droits_nom` (`id_preset_nom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_commandes4_FK` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_comptes2_FK` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_comptes3_FK` FOREIGN KEY (`id_compte_comptes`) REFERENCES `comptes` (`id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_joueurs1_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_liste_types_status_transaction_FK` FOREIGN KEY (`id_status_transaction`) REFERENCES `liste_types_status_transaction` (`id_status_transaction`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_liste_types_transaction0_FK` FOREIGN KEY (`id_type_transaction`) REFERENCES `liste_types_transaction` (`id_type_transaction`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
