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
		$reponseConnection = $bdd->prepare('SELECT joueurs.id_joueur,joueurs.pseudo,joueurs.email,joueurs.max_offres,liste_type_role.nom FROM joueurs
		INNER JOIN liste_type_role ON joueurs.id_table_select_role = liste_type_role.id_table_select_role');
		$reponseConnection->execute();
		return $reponseConnection->fetchAll();
	}

	// recupere les infos du joueurs via son id
	public static function getJoueurbyId($bdd,$id_joueur) {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs INNER JOIN liste_type_role ON joueurs.id_table_select_role = liste_type_role.id_table_select_role WHERE joueurs.id_joueur = :id_joueur');
		$reponseConnection->execute(array(
			'id_joueur' => $id_joueur
			));
		return $reponseConnection->fetch(PDO::FETCH_ASSOC);
	}

	// recupere les infos du joueurs via son pseudo
	public static function getJoueurbyPseudo($bdd,$pseudo) {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs INNER JOIN liste_type_role ON joueurs.id_table_select_role = liste_type_role.id_table_select_role WHERE joueurs.pseudo = :pseudo');
		$reponseConnection->execute(array(
			'pseudo' => $pseudo
			));
		return $reponseConnection->fetch(PDO::FETCH_ASSOC);
	}

	// recupere les infos du joueurs via son email
	public static function getJoueurByMail($bdd,$pseudo,$email) {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs WHERE email = :email AND pseudo = :pseudo');
		$reponseConnection->execute(array(
			'email' => $email,
			'pseudo' => $pseudo
			));
		return $reponseConnection->fetch(PDO::FETCH_ASSOC);
	}

	// recupere les infos de tous les joueurs
	public static function getAllJoueurs($bdd) {
		$reponseConnection = $bdd->prepare('SELECT * FROM joueurs');
		$reponseConnection->execute();
		return $reponseConnection->fetchAll();
	}

	// creer un nouveau joueur
	public static function inscription($bdd,$pseudo,$email,$mdp,$offre_depart) {
		$req = $bdd->prepare('INSERT INTO joueurs(pseudo, email, mdp, last_login, id_table_select_role, max_offres) VALUES(:pseudo, :email, :mdp, :last_login, :id_table_select_role, :max_offres)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'email' => $email,
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'last_login' => date('Y-m-d H:i:s'),
			'id_table_select_role' => 2,
			'max_offres' => $offre_depart
			));
	}

	// supprime le joueur
	public static function deleteJoueur($bdd,$id_joueur) {
		$req = $bdd->prepare('DELETE FROM joueurs WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
			));
	}

	// modifie le mot de passe du joueur
	public static function setMdp($bdd,$id_joueur,$mdp) {
		$req = $bdd->prepare('UPDATE joueurs SET mdp = :mdp WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'id_joueur' => $id_joueur
			));
	}

	// modifie l'email
	public static function setEmail($bdd,$id_joueur,$email) {
		$req = $bdd->prepare('UPDATE joueurs SET email = :email WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'email' => $email,
			'id_joueur' => $id_joueur
			));
	}

	// modifie le resettoken du joueur
	public static function setResetToken($bdd,$id_joueur,$token) {
		$req = $bdd->prepare('UPDATE joueurs SET expire_resettoken = :expire, resettoken = :token WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'token' => $token,
			'expire' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 hour')),
			'id_joueur' => $id_joueur
			));
	}

	// change le role du joueur
	public static function setRole($bdd,$id_joueur,$role) {
		$req = $bdd->prepare('UPDATE joueurs SET id_table_select_role = :id_table_select_role WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_table_select_role' => $role,
			'id_joueur' => $id_joueur
		));
	}

	// change le nombre d'offre maximum du joueur
	public static function setNbrOffre($bdd,$id_joueur,$nbr_offre) {
		$req = $bdd->prepare('UPDATE joueurs SET nbr_offre = :nbr_offre WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'nbr_offre' => $nbr_offre,
			'id_joueur' => $id_joueur
		));
	}

	// change la date de derniere connexion du joueur
	public static function setLastLogin($bdd,$id_joueur) {
		$date = date('Y-m-d H:i:s');
		$req = $bdd->prepare('UPDATE joueurs SET last_login = :last_login WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'last_login' => $date,
			'id_joueur' => $id_joueur
			));
	}
}
?>