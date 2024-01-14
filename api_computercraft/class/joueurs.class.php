<?php
// get joueurs
// get joueur/{id}
// get joueur/{id_groupe}
// set joueur/{id}/pseudo
// set joueur/{id}/mdp
// set joueur/{id}/email
// set joueur/{id}/delete
// set joueur/add
// set joueur/{id}/resettoken
// set joueur/{id}/role/{id}
// set joueur/{id}/lastlogin
// set joueur/{id}/maxoffres
// set joueur/{id}/expiretoken
class Joueurs {
	// recupere les infos des joueurs
	public static function getJoueurs($bdd) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs');
		$req->execute();
		$joueurs = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $joueurs;
	}

	// recupere les infos du joueurs via son id
	public static function getJoueurById($bdd,$idJoueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $idJoueur
			));
		$joueurs = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $joueurs;
	}

	// recupere les infos du joueurs via son pseudo
	public static function getJoueurByPseudo($bdd,$pseudoJoueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs WHERE pseudo_joueur = :pseudo_joueur');
		$req->execute(array(
			'pseudo_joueur' => $pseudoJoueur
			));
			$joueurs = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return $joueurs;
	}

	// recupere les infos du joueurs via son email
	public static function getJoueurByMail($bdd,$pseudoJoueur,$emailJoueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs WHERE email_joueur = :email_joueur AND pseudo_joueur = :pseudo_joueur');
		$req->execute(array(
			'email_joueur' => $emailJoueur,
			'pseudo_joueur' => $pseudoJoueur
		));
		$joueurs = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $joueurs;
	}

    private $_idJoueur;
    private $_bdd;

    public function __construct($bdd,$idJoueur = null) {
        $this->_bdd = $bdd;
        if($idJoueur != null) {
            $this->_idJoueur = $idJoueur;
        }
    }

	public function getJoueurNbrOffre() {
		$req = $this->_bdd->prepare('SELECT max_offres_joueur FROM joueurs WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $this->_idJoueur
		));
		$joueur = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $joueur['max_offres_joueur'];
	}

    // recupere l'id du joueur
    public function getIdJoueur() {
        return $this->_idJoueur;
    }

	// supprime le joueur
	public function deleteJoueur() {
		$req = $this->_bdd->prepare('DELETE FROM joueurs WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $this->_idJoueur
		));
	}

	// modifie le pseudo du joueur
	public function setJoueurPseudo($pseudoJoueur) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET pseudo_joueur = :pseudo_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'pseudo_joueur' => $pseudoJoueur,
			'id_joueur' => $this->_idJoueur
		));
	}

	// modifie le mot de passe du joueur
	public function setJoueurMdp($mdpJoueur) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET mdp_joueur = :mdp_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'mdp_joueur' => password_hash($mdpJoueur, PASSWORD_DEFAULT),
			'id_joueur' => $this->_idJoueur
		));
	}

	// modifie l'email
	public function setJoueurEmail($emailJoueur) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET email_joueur = :email_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'email_joueur' => $emailJoueur,
			'id_joueur' => $this->_idJoueur
		));
	}

	// modifie le resettoken du joueur
	public function setJoueurResetToken($tokenJoueur=null) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET expire_resettoken_joueur = :expire_joueur, resettoken_joueur = :token_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'token_joueur' => $tokenJoueur,
			'expire_joueur' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 hour')),
			'id_joueur' => $this->_idJoueur
		));
	}

	// change le role du joueur
	public function setJoueurRole($role) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET id_type_role = :id_type_role WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_type_role' => $role,
			'id_joueur' => $this->_idJoueur
		));
	}

	// change le nombre d'offre maximum du joueur
	public function setJoueurNbrOffre($maxOffresJoueur) {
		$req = $this->_bdd->prepare('UPDATE joueurs SET max_offres_joueur = :max_offres_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'max_offres_joueur' => $maxOffresJoueur,
			'id_joueur' => $this->_idJoueur
		));
	}

	// change la date de derniere connexion du joueur
	public function setJoueurLastLogin() {
		$req = $this->_bdd->prepare('UPDATE joueurs SET last_login_joueur = :last_login_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'last_login_joueur' => date('Y-m-d H:i:s'),
			'id_joueur' => $this->_idJoueur
		));
	}

	// creer un nouveau joueur
	public function addJoueur($pseudoJoueur,$emailJoueur,$mdpJoueur,$offreDepart,$idTypeRole=1) { // 1 = utilisateur, 2 = admin, 3 = terminal
		$req = $this->_bdd->prepare('INSERT INTO joueurs(pseudo_joueur, email_joueur, mdp_joueur, last_login_joueur, id_type_joueur, max_offres_joueur) VALUES(:pseudo_joueur, :email_joueur, :mdp_joueur, :last_login_joueur, :id_type_joueur, :max_offres_joueur)');
		$req->execute(array(
			'pseudo_joueur' => $pseudoJoueur,
			'email_joueur' => $emailJoueur,
			'mdp_joueur' => password_hash($mdpJoueur, PASSWORD_DEFAULT),
			'last_login_joueur' => date('Y-m-d H:i:s'),
			'id_type_joueur' => $idTypeRole,
			'max_offres_joueur' => $offreDepart
		));
		$this->_idJoueur = $this->_bdd->lastInsertId();
	}
}