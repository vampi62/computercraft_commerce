CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `id_offre` int(11) UNSIGNED,
  `id_transaction` int(11) UNSIGNED NOT NULL,
  `nom_commande` varchar(55) NOT NULL,
  `expediteur` int(11) UNSIGNED NOT NULL,
  `recepteur` int(11) UNSIGNED NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `somme` int(11) UNSIGNED NOT NULL,
  `prix_unitaire` float UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `livraison` tinyint(3) UNSIGNED NOT NULL,
  `suivie` text NOT NULL,
  `description` text NOT NULL,
  `statuts` tinyint(3) UNSIGNED NOT NULL,
  `date` varchar(55) NOT NULL,
  `heure` varchar(55) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `liste_offres` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `proprio` int(11) UNSIGNED NOT NULL,
  `prix` float UNSIGNED NOT NULL,
  `nbr_dispo` int(11) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `livraison` tinyint(3) UNSIGNED NOT NULL,
  `nom` varchar(55) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `liste_users` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(55) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `compte` double NOT NULL,
  `nbr_offre` int(11) UNSIGNED NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `id_commandes` int(11) UNSIGNED NOT NULL,
  `crediteur` int(11) UNSIGNED NOT NULL,
  `debiteur` int(11) UNSIGNED NOT NULL,
  `somme` float UNSIGNED NOT NULL,
  `type` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `statuts` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `heure` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
