<?php
// get jetons
// get jeton/{id}
// set jeton/{id}/value
// set jeton/{id}/delete
// set jeton/add
class Jetons {
	// recuperation le tableau de jeton
	public static function getJetons($bdd) {
		$req = $bdd->query('SELECT jeton.*,joueurs.pseudo_joueur FROM jeton INNER JOIN joueurs ON joueurs.id_joueur = jeton.id_joueur');
		$list_jetons = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $list_jetons;
	}

	// recuperation le tableau de jeton
	public static function getJetonByJoueur($bdd,$id_joueur) {
		$req = $bdd->prepare('SELECT jeton.*,joueurs.pseudo_joueur FROM jeton INNER JOIN joueurs ON joueurs.id_joueur = jeton.id_joueur WHERE jeton.id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
		));
		$jeton = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $jeton;
	}

	// creer une nouvelle entre dans la table jeton
	public static function addJeton($bdd,$id_joueur) {
		$req = $bdd->prepare('INSERT INTO jeton(jeton1_jeton, jeton10_jeton, jeton100_jeton, jeton1k_jeton, jeton10k_jeton, id_joueur, last_update_jeton) VALUES(:jeton1_jeton, :jeton10_jeton, :jeton100_jeton, :jeton1k_jeton, :jeton10k_jeton, :id_joueur, :last_update_jeton)');
		$req->execute(array(
			'jeton1_jeton' => 0,
			'jeton10_jeton' => 0,
			'jeton100_jeton' => 0,
			'jeton1k_jeton' => 0,
			'jeton10k_jeton' => 0,
			'id_joueur' => $id_joueur,
			'last_update_jeton' => date("Y-m-d H:i:s")
		));
		return $bdd->lastInsertId();
	}

	// modifier une entre dans la table jeton
	public static function setJeton($bdd,$id_joueur,$jeton) {
		$req = $bdd->prepare('UPDATE jeton SET jeton1_jeton = :jeton1_jeton, jeton10_jeton = :jeton10_jeton, jeton100_jeton = :jeton100_jeton, jeton1k_jeton = :jeton1k_jeton, jeton10k_jeton = :jeton10k_jeton, last_update_jeton = :last_update_jeton WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'jeton1_jeton' => intval($jeton["1"]),
			'jeton10_jeton' => intval($jeton["10"]),
			'jeton100_jeton' => intval($jeton["100"]),
			'jeton1k_jeton' => intval($jeton["1k"]),
			'jeton10k_jeton' => intval($jeton["10k"]),
			'id_joueur' => $id_joueur,
			'last_update_jeton' => date("Y-m-d H:i:s")
		));
	}

	// supprimer une entre dans la table jeton
	public static function deleteJeton($bdd,$id_joueur) {
		$req = $bdd->prepare('DELETE FROM jeton WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
		));
	}
}
?>
