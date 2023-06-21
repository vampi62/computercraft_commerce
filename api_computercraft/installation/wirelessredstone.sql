
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
-- Structure de la table `wirelessredstone`
--

CREATE TABLE `wirelessredstone` (
  `id_wirelessredstone` int(11) UNSIGNED NOT NULL,
  `id_joueur` int(11) UNSIGNED DEFAULT NULL,
  `date_reservation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `wirelessredstone`
--

INSERT INTO `wirelessredstone` (`id_wirelessredstone`, `id_joueur`, `date_reservation`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL),
(6, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL),
(9, NULL, NULL),
(10, NULL, NULL),
(11, NULL, NULL),
(12, NULL, NULL),
(13, NULL, NULL),
(14, NULL, NULL),
(15, NULL, NULL),
(16, NULL, NULL),
(17, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `wirelessredstone`
--
ALTER TABLE `wirelessredstone`
  ADD PRIMARY KEY (`id_wirelessredstone`),
  ADD KEY `wirelessredstone_joueurs0_FK` (`id_joueur`);
  
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `wirelessredstone`
--
ALTER TABLE `wirelessredstone`
  MODIFY `id_wirelessredstone` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wirelessredstone`
--
ALTER TABLE `wirelessredstone`
  ADD CONSTRAINT `wirelessredstone_joueurs0_FK` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`) ON DELETE SET NULL ON UPDATE CASCADE;
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
