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
		$joueurs = $req->fetchAll();
		$req->closeCursor();
		return $joueurs;
	}

	// recupere les infos du joueurs via son id
	public static function getJoueurbyId($bdd,$id_joueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs INNER JOIN joueur_roles ON vw_joueurs.id_joueur_role = joueur_roles.id_joueur_role WHERE vw_joueurs.id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
			));
		$joueurs = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $joueurs;
	}

	// recupere les infos du joueurs via son pseudo
	public static function getJoueurbyPseudo($bdd,$pseudo_joueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs INNER JOIN joueur_roles ON vw_joueurs.id_joueur_role = joueur_roles.id_joueur_role WHERE vw_joueurs.pseudo_joueur = :pseudo_joueur');
		$req->execute(array(
			'pseudo_joueur' => $pseudo_joueur
			));
			$joueurs = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return $joueurs;
	}

	// recupere les infos du joueurs via son email
	public static function getJoueurByMail($bdd,$pseudo_joueur,$email_joueur) {
		$req = $bdd->prepare('SELECT * FROM vw_joueurs WHERE email_joueur = :email_joueur AND pseudo_joueur = :pseudo_joueur');
		$req->execute(array(
			'email_joueur' => $email_joueur,
			'pseudo_joueur' => $pseudo_joueur
			));
			$joueurs = $req->fetch(PDO::FETCH_ASSOC);
			$req->closeCursor();
			return $joueurs;
	}

	// creer un nouveau joueur
	public static function addJoueur($bdd,$pseudo_joueur,$email_joueur,$mdp_joueur,$offre_depart,$id_role=2) {
		$req = $bdd->prepare('INSERT INTO joueurs(pseudo_joueur, email_joueur, mdp_joueur, last_login_joueur, id_joueur_role, max_offres_joueur) VALUES(:pseudo_joueur, :email_joueur, :mdp_joueur, :last_login_joueur, :id_joueur_role, :max_offres_joueur)');
		$req->execute(array(
			'pseudo_joueur' => $pseudo_joueur,
			'email_joueur' => $email_joueur,
			'mdp_joueur' => password_hash($mdp_joueur, PASSWORD_DEFAULT),
			'last_login_joueur' => date('Y-m-d H:i:s'),
			'id_joueur_role' => $id_role,
			'max_offres_joueur' => $offre_depart
			));
	}

	// supprime le joueur
	public static function deleteJoueur($bdd,$id_joueur) {
		$req = $bdd->prepare('DELETE FROM joueurs WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur' => $id_joueur
			));
	}

	// modifie le pseudo du joueur
	public static function setJoueurPseudo($bdd,$id_joueur,$pseudo_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET pseudo_joueur = :pseudo_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'pseudo_joueur' => $pseudo_joueur,
			'id_joueur' => $id_joueur
			));
	}

	// modifie le mot de passe du joueur
	public static function setJoueurMdp($bdd,$id_joueur,$mdp_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET mdp_joueur = :mdp_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'mdp_joueur' => password_hash($mdp_joueur, PASSWORD_DEFAULT),
			'id_joueur' => $id_joueur
			));
	}

	// modifie l'email
	public static function setJoueurEmail($bdd,$id_joueur,$email_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET email_joueur = :email_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'email_joueur' => $email_joueur,
			'id_joueur' => $id_joueur
			));
	}

	// modifie le resettoken du joueur
	public static function setJoueurResetToken($bdd,$id_joueur,$token_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET expire_resettoken_joueur = :expire_joueur, resettoken_joueur = :token_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'token_joueur' => $token_joueur,
			'expire_joueur' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 hour')),
			'id_joueur' => $id_joueur
			));
	}

	// change le role du joueur
	public static function setJoueurRole($bdd,$id_joueur,$role) {
		$req = $bdd->prepare('UPDATE joueurs SET id_joueur_role = :id_joueur_role WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'id_joueur_role' => $role,
			'id_joueur' => $id_joueur
		));
	}

	// change le nombre d'offre maximum du joueur
	public static function setJoueurNbrOffre($bdd,$id_joueur,$max_offres_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET max_offres_joueur = :max_offres_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'max_offres_joueur' => $max_offres_joueur,
			'id_joueur' => $id_joueur
		));
	}

	// change la date de derniere connexion du joueur
	public static function setJoueurLastLogin($bdd,$id_joueur) {
		$req = $bdd->prepare('UPDATE joueurs SET last_login_joueur = :last_login_joueur WHERE id_joueur = :id_joueur');
		$req->execute(array(
			'last_login_joueur' => date('Y-m-d H:i:s'),
			'id_joueur' => $id_joueur
			));
	}
}
?>