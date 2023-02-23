CREATE TABLE IF NOT EXISTS `liste_users` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(55) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `resettoken` varchar(32),
  `compte` double UNSIGNED NOT NULL,
  `id_adresse` int(11) UNSIGNED NOT NULL,
  `nbr_offre` int(11) UNSIGNED NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  `last_login` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `jeton_banque` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `id_user` int(11) UNSIGNED NOT NULL,
  `jeton1` int(11) UNSIGNED NOT NULL,
  `jeton10` int(11) UNSIGNED NOT NULL,
  `jeton100` int(11) UNSIGNED NOT NULL,
  `jeton1k` int(11) UNSIGNED NOT NULL,
  `jeton10k` int(11) UNSIGNED NOT NULL,
  `date` varchar(55) NOT NULL,
  `heure` varchar(55) NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`id_user`),
  CONSTRAINT `jeton_banque_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `liste_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `liste_offres` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `proprio` int(11) UNSIGNED NOT NULL,
  `id_adresse` int(11) UNSIGNED NOT NULL,
  `prix` double UNSIGNED NOT NULL,
  `nbr_dispo` int(11) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `livraison` tinyint(3) UNSIGNED NOT NULL,
  `nom` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `last_update` varchar(55) NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`proprio`),
  CONSTRAINT `liste_offres_ibfk_1` FOREIGN KEY (`proprio`) REFERENCES `liste_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `liste_adresses` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `proprio` int(11) UNSIGNED NOT NULL,
  `nom` varchar(55) NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `coo` varchar(55) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`proprio`),
  CONSTRAINT `liste_adresses_ibfk_1` FOREIGN KEY (`proprio`) REFERENCES `liste_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `id_commandes` int(11) UNSIGNED NOT NULL,
  `id_admin_exec` int(11) UNSIGNED NOT NULL,
  `crediteur` int(11) UNSIGNED NOT NULL,
  `debiteur` int(11) UNSIGNED NOT NULL,
  `somme` double UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `date` varchar(55) NOT NULL,
  `heure` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `id_offre` int(11) UNSIGNED,
  `id_transaction` int(11) UNSIGNED NOT NULL,
  `nom_commande` varchar(55) NOT NULL,
  `expediteur` int(11) UNSIGNED NOT NULL,
  `recepteur` int(11) UNSIGNED NOT NULL,
  `text_adresse_expediteur` text NOT NULL,
  `text_adresse_recepteur` text NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `somme` double UNSIGNED NOT NULL,
  `prix_unitaire` double UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `livraison` tinyint(3) UNSIGNED NOT NULL,
  `suivie` text NOT NULL,
  `description` text NOT NULL,
  `statut` tinyint(3) UNSIGNED NOT NULL,
  `date` varchar(55) NOT NULL,
  `heure` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE DEFINER=`root`@`%` PROCEDURE `get_arbo_group`(IN `objet_groupe_id` INT UNSIGNED) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER WITH RECURSIVE returnlist AS ( SELECT id_groupe, nom, racine FROM groupe WHERE id_groupe = objet_groupe_id UNION ALL SELECT groupe.id_groupe, groupe.nom, groupe.racine FROM groupe, returnlist WHERE groupe.id_groupe = returnlist.racine ) SELECT returnlist.nom AS nom_dossier, groupe.nom AS nom_racine, returnlist.id_groupe AS id_groupe FROM returnlist LEFT JOIN groupe ON returnlist.racine = groupe.id_groupe ORDER BY returnlist.racine;