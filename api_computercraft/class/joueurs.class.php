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
class joueurs
{
	private $bdd;
	private $reponseConnection;
	private $id;
	
	public function __construct($player, $bdd) {	
		$this->bdd = $bdd;
		$this->id = $player;
	}

	// recupere les infos du joueurs via son id ou son pseudo
	public function getUtilisateur() {
		if (is_int($this->id)) {
			$reponseConnection = $bdd->prepare('SELECT * FROM joueurs WHERE id = :id');
		} else {
			$reponseConnection = $bdd->prepare('SELECT * FROM joueurs WHERE pseudo = :id');
		}
		$reponseConnection->execute(array(
			'id' => $this->id
			));
		$this->reponseConnection = $reponseConnection->fetch(PDO::FETCH_ASSOC);
		return $this->reponseConnection;
	}

	// recupere les infos de tous les joueurs
	public function getAllUtilisateurs() {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs');
		$reponseConnection->execute();
		return $reponseConnection->fetchAll();
	}

	// creer un nouveau joueur
	public function inscription($email, $mdp) {
		$req = $this->bdd->prepare('INSERT INTO joueurs(pseudo, email, mdp, last_login, id_table_select_role, max_offres) VALUES(:pseudo, :email, :mdp, :last_login, :id_table_select_role, :max_offres)');
		$req->execute(array(
			'pseudo' => $this->id,
			'email' => $email,
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'last_login' => date('Y-m-d H:i:s'),
			'id_table_select_role' => 2,
			'max_offres' => $_Serveur_['General']['offre_depart']
			));
	}

	// supprime le joueur
	public function delete() {
		$req = $this->bdd->prepare('DELETE FROM joueurs WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
			));
	}

	// modifie le mot de passe du joueur
	public function setMdp($mdp) {
		$req = $this->bdd->prepare('UPDATE joueurs SET mdp = :mdp WHERE id = :id');
		$req->execute(array(
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'id' => $this->id
			));
	}

	// modifie l'email
	public function setEmail($email) {
		$req = $this->bdd->prepare('UPDATE joueurs SET email = :email WHERE id = :id');
		$req->execute(array(
			'email' => $email,
			'id' => $this->id
			));
	}

	// modifie le resettoken du joueur
	public function setResetToken($token) {
		$req = $this->bdd->prepare('UPDATE joueurs SET expire_resettoken = :expire, resettoken = :token WHERE id = :id');
		$req->execute(array(
			'token' => $token,
			'expire' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 hour')),
			'id' => $this->id
			));
	}

	// change le role du joueur
	public function setRole($role) {
		$req = $this->bdd->prepare('UPDATE joueurs SET id_table_select_role = :id_table_select_role WHERE id = :id');
		$req->execute(array(
			'id_table_select_role' => $role,
			'id' => $this->id
		));
	}

	// change le nombre d'offre maximum du joueur
	public function setNbrOffre($nbr_offre) {
		$req = $this->bdd->prepare('UPDATE joueurs SET nbr_offre = :nbr_offre WHERE id = :id');
		$req->execute(array(
			'nbr_offre' => $nbr_offre,
			'id' => $this->id
		));
	}

	// change la date de derniere connexion du joueur
	private function setLastLogin() {
		$date = date('Y-m-d H:i:s');
		$req = $this->bdd->prepare('UPDATE joueurs SET last_login = :last_login WHERE id = :id');
		$req->execute(array(
			'last_login' => $date,
			'id' => $this->id
			));
	}
}
?>