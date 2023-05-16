<?php
// get jetons
// get jeton/{id}
// set jeton/{id}/value
// set jeton/{id}/delete
// set jeton/add
class Jetons {
	// recuperation le tableau de jeton
	public static function getJetons($bdd) {
		$req = $bdd->query('SELECT joueurs.pseudo, jeton_banque.* FROM jeton_banque INNER JOIN joueurs ON joueurs.id_joueur = jeton_banque.id_jeton');
		$list_jetons = $req->fetchAll();
		$req->closeCursor();
        return $list_jetons;
	}

	// recuperation le tableau de jeton
	public static function getJetonByJoueur($bdd,$id_joueur) {
		$req = $bdd->prepare('SELECT * FROM jeton_banque WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
		));
		$jeton = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $jeton;
	}

	// creer une nouvelle entre dans la table jeton_banque
	public static function setInitJeton($bdd,$id_joueur,$jeton) {
		$date = date("Y-m-d H:i:s");
		$req = $bdd->prepare('INSERT INTO jeton_banque(jeton1, jeton10, jeton100, jeton1k, jeton10k, id_joueur, date, heure) VALUES(:jeton1, :jeton10, :jeton100, :jeton1k, :jeton10k, :id_joueur, :date, :heure)');
		$req->execute(array(
			'jeton1' => $jeton["1"],
			'jeton10' => $jeton["10"],
			'jeton100' => $jeton["100"],
			'jeton1k' => $jeton["1k"],
			'jeton10k' => $jeton["10k"],
			'id_joueur' => $id_joueur,
			'date' => $date
		));
	}

	// modifier une entre dans la table jeton_banque
	public static function setSyncJeton($bdd,$id_joueur,$jeton) {
		$date = date("Y-m-d H:i:s");
		$req = $bdd->prepare('UPDATE jeton_banque SET jeton1 = :jeton1, jeton10 = :jeton10, jeton100 = :jeton100, jeton1k = :jeton1k, jeton10k = :jeton10k, date = :date, heure = :heure WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'jeton1' => intval($jeton["1"]),
			'jeton10' => intval($jeton["10"]),
			'jeton100' => intval($jeton["100"]),
			'jeton1k' => intval($jeton["1k"]),
			'jeton10k' => intval($jeton["10k"]),
			'id_joueur' => $id_joueur,
			'date' => $date
		));
	}
}
?>
