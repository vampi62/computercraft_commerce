<?php
class joueurs
{
	private $bdd;
	private $reponseConnection;
	private $id;
	
	public function __construct($player, $bdd) {	
		$this->bdd = $bdd;
		$this->id = $player;
	}
	public function getUtilisateur() {
		if (is_int($this->id)) {
			$reponseConnection = $bdd->prepare('SELECT * FROM joueurs WHERE id = :id');
		} else {
			$reponseConnection = $bdd->prepare('SELECT * FROM joueurs WHERE pseudo = :id');
		}
		$reponseConnection->execute(array(
			'id' => $this->id
			));
		return $reponseConnection->fetch(PDO::FETCH_ASSOC);
	}
	public function getUtilisateurs() {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs');
		$reponseConnection->execute();
		return $reponseConnection->fetch(PDO::FETCH_ASSOC);
	}

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
	public function delete() {
		$req = $this->bdd->prepare('DELETE FROM joueurs WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
			));
	}
	public function verifymdp($mdp) {
		if(!empty($this->reponseConnection)) {
			if(password_verify($mdp, $this->reponseConnection['mdp'])) {
				$this->updateLastLogin();
				return true;
			}
		}
		return false;
	}
	public function verifytoken($token) {
		if(!empty($this->reponseConnection)) {
			if(!empty($this->reponseConnection['resettoken'])) {
				if($token == $this->reponseConnection['resettoken']) {
					if(date('Y-m-d H:i:s') <= $this->reponseConnection['expire_resettoken']) {
						$this->updateLastLogin();
						return true;
					}
				}
			}
		}
		return false;
	}
	public function setNouvellesDonneesMdp($mdp) {
		$req = $this->bdd->prepare('UPDATE joueurs SET mdp = :mdp WHERE id = :id');
		$req->execute(array(
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'id' => $this->id
			));
	}
	public function setNouvellesDonneesEmail($email) {
		$req = $this->bdd->prepare('UPDATE joueurs SET email = :email WHERE id = :id');
		$req->execute(array(
			'email' => $email,
			'id' => $this->id
			));
	}
	public function setNouvellesDonneesResetToken($token) {
		$req = $this->bdd->prepare('UPDATE joueurs SET expire_resettoken = :expire, resettoken = :token WHERE id = :id');
		$req->execute(array(
			'token' => $token,
			'expire' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 hour')),
			'id' => $this->id
			));
	}
	public function setNouvellesDonneesRole($role) {
		$req = $this->bdd->prepare('UPDATE joueurs SET id_table_select_role = :id_table_select_role WHERE id = :id');
		$req->execute(array(
			'id_table_select_role' => $role,
			'id' => $this->id
		));
	}
	public function setNouvellesDonneesNbrOffre($nbr_offre) {
		$req = $this->bdd->prepare('UPDATE joueurs SET nbr_offre = :nbr_offre WHERE id = :id');
		$req->execute(array(
			'nbr_offre' => $nbr_offre,
			'id' => $this->id
		));
	}
	private function updateLastLogin() {
		$date = date('Y-m-d H:i:s');
		$req = $this->bdd->prepare('UPDATE joueurs SET last_login = :last_login WHERE id = :id');
		$req->execute(array(
			'last_login' => $date,
			'id' => $this->id
			));
	}
}
?>