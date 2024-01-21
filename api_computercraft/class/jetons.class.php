<?php
// get jetons
// get jeton/{id}
// set jeton/{id}/value
// set jeton/{id}/delete
// set jeton/add
class Jetons {
	// recuperation le tableau de jeton
	public static function getJetons($bdd) {
		$req = $bdd->query('SELECT jetons.*,joueurs.pseudo_joueur FROM jetons INNER JOIN joueurs ON joueurs.id_joueur = jetons.id_joueur');
		$list_jetons = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $list_jetons;
	}

	// recuperation le tableau de jeton
	public static function getJetonByJoueur($bdd,$idJoueur) {
		$req = $bdd->prepare('SELECT jetons.*,joueurs.pseudo_joueur FROM jetons INNER JOIN joueurs ON joueurs.id_joueur = jetons.id_joueur WHERE jetons.id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $idJoueur
		));
		$jeton = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $jeton;
	}

	private $_idJoueur;
    private $_bdd;

    public function __construct($bdd,$idJoueur = null) {
        $this->_bdd = $bdd;
        if($idJoueur != null) {
            $this->_idJoueur = $idJoueur;
			if ($this->getJetonByJoueur($bdd,$idJoueur) == null) { // si le jeton n'existe pas
				$this->addJeton();
			}
        }
    }

    // recupere l'id du joueur utilisant le jeton
    public function getIdJoueurJeton() {
        return $this->_idJoueur;
    }

	// creer une nouvelle entre dans la table jeton
	public function addJeton() {
		$req = $this->_bdd->prepare('INSERT INTO jetons(jeton1_jeton, jeton10_jeton, jeton100_jeton, jeton1k_jeton, jeton10k_jeton, id_joueur, last_update_jeton) VALUES(:jeton1_jeton, :jeton10_jeton, :jeton100_jeton, :jeton1k_jeton, :jeton10k_jeton, :id_joueur, :last_update_jeton)');
		$req->execute(array(
			'jeton1_jeton' => 0,
			'jeton10_jeton' => 0,
			'jeton100_jeton' => 0,
			'jeton1k_jeton' => 0,
			'jeton10k_jeton' => 0,
			'id_joueur' => $this->_idJoueur,
			'last_update_jeton' => date("Y-m-d H:i:s")
		));
		$this->_idJoueur = $this->_bdd->lastInsertId();
	}

	// modifier une entre dans la table jeton
	public function setJeton($jeton) {
		$req = $this->_bdd->prepare('UPDATE jetons SET jeton1_jeton = :jeton1_jeton, jeton10_jeton = :jeton10_jeton, jeton100_jeton = :jeton100_jeton, jeton1k_jeton = :jeton1k_jeton, jeton10k_jeton = :jeton10k_jeton, last_update_jeton = :last_update_jeton WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'jeton1_jeton' => intval($jeton["1"]),
			'jeton10_jeton' => intval($jeton["10"]),
			'jeton100_jeton' => intval($jeton["100"]),
			'jeton1k_jeton' => intval($jeton["1k"]),
			'jeton10k_jeton' => intval($jeton["10k"]),
			'id_joueur' => $this->_idJoueur,
			'last_update_jeton' => date("Y-m-d H:i:s")
		));
	}

	// supprimer une entre dans la table jeton
	public function deleteJeton() {
		$req = $this->_bdd->prepare('DELETE FROM jetons WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $this->_idJoueur
		));
	}
}