
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
-- Structure de la table `enderstorage_chest`
--

CREATE TABLE `enderstorage_chest` (
  `id_enderstorage_chest` int(11) UNSIGNED NOT NULL,
  `color_rang_left` smallint(5) UNSIGNED NOT NULL,
  `color_rang_center` smallint(5) UNSIGNED NOT NULL,
  `color_rang_right` smallint(5) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `date_reservation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enderstorage_chest`
--

INSERT INTO `enderstorage_chest` (`id_enderstorage_chest`, `color_rang_left`, `color_rang_center`, `color_rang_right`, `id_joueur`, `date_reservation`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 1, 2, NULL, NULL),
(3, 1, 1, 4, NULL, NULL),
(4, 1, 1, 8, NULL, NULL),
(5, 1, 1, 16, NULL, NULL),
(6, 1, 1, 32, NULL, NULL),
(7, 1, 1, 64, NULL, NULL),
(8, 1, 1, 128, NULL, NULL),
(9, 1, 1, 256, NULL, NULL),
(10, 1, 1, 512, NULL, NULL),
(11, 1, 1, 1024, NULL, NULL),
(12, 1, 1, 2048, NULL, NULL),
(13, 1, 1, 4096, NULL, NULL),
(14, 1, 1, 8912, NULL, NULL),
(15, 1, 1, 16384, NULL, NULL),
(16, 1, 1, 32768, NULL, NULL),
(17, 1, 2, 1, NULL, NULL);

--
-- Structure de la table `enderstorage_tank`
--

CREATE TABLE `enderstorage_tank` (
  `id_enderstorage_tank` int(11) UNSIGNED NOT NULL,
  `color_rang_left` smallint(5) UNSIGNED NOT NULL,
  `color_rang_center` smallint(5) UNSIGNED NOT NULL,
  `color_rang_right` smallint(5) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `date_reservation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enderstorage_tank`
--

INSERT INTO `enderstorage_tank` (`id_enderstorage_tank`, `color_rang_left`, `color_rang_center`, `color_rang_right`, `id_joueur`, `date_reservation`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 1, 2, NULL, NULL),
(3, 1, 1, 4, NULL, NULL),
(4, 1, 1, 8, NULL, NULL),
(5, 1, 1, 16, NULL, NULL),
(6, 1, 1, 32, NULL, NULL),
(7, 1, 1, 64, NULL, NULL),
(8, 1, 1, 128, NULL, NULL),
(9, 1, 1, 256, NULL, NULL),
(10, 1, 1, 512, NULL, NULL),
(11, 1, 1, 1024, NULL, NULL),
(12, 1, 1, 2048, NULL, NULL),
(13, 1, 1, 4096, NULL, NULL),
(14, 1, 1, 8912, NULL, NULL),
(15, 1, 1, 16384, NULL, NULL),
(16, 1, 1, 32768, NULL, NULL),
(17, 1, 2, 1, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enderstorage_chest`
--
ALTER TABLE `enderstorage_chest`
  ADD PRIMARY KEY (`id_enderstorage_chest`),
  ADD KEY `enderstorage_chest_joueurs0_FK` (`id_joueur`);
  
--
-- Index pour la table `enderstorage_tank`
--
ALTER TABLE `enderstorage_tank`
  ADD PRIMARY KEY (`id_enderstorage_tank`),
  ADD KEY `enderstorage_tank_joueurs0_FK` (`id_joueur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enderstorage_chest`
--
ALTER TABLE `enderstorage_chest`
  MODIFY `id_enderstorage_chest` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `enderstorage_tank`
--
ALTER TABLE `enderstorage_tank`
  MODIFY `id_enderstorage_tank` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enderstorage_chest`
--
ALTER TABLE `enderstorage_chest`
  ADD CONSTRAINT `enderstorage_chest_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE;
  
--
-- Contraintes pour la table `enderstorage_chest`
--
ALTER TABLE `enderstorage_tank`
  ADD CONSTRAINT `enderstorage_tank_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
