<?php
// get groupes/{id_joueur}
// get groupes/{id_compte}
// get groupes/{id_offre}
// get groupes/{id_adresse}
// get groupes/{id_livreur}
// get groupes/{id_apikey}
// get groupes/{id_groupe}/joueurs
// get groupes/{id_groupe}/comptes
// get groupes/{id_groupe}/offres
// get groupes/{id_groupe}/adresses
// get groupes/{id_groupe}/livreurs
// get groupes/{id_groupe}/apikeys
// get groupe/{id}
// get groupe/droits/{id}
// set groupe/{id}/offre/{id}/add
// set groupe/{id}/offre/{id}/delete
// set groupe/{id}/adresse/{id}/add
// set groupe/{id}/adresse/{id}/delete
// set groupe/{id}/compte/{id}/add
// set groupe/{id}/compte/{id}/delete
// set groupe/{id}/apikey/{id}/add
// set groupe/{id}/apikey/{id}/delete
// set groupe/{id}/joueur/{id}/add
// set groupe/{id}/joueur/{id}/delete
// set groupe/{id}/livreur/{id}/add
// set groupe/{id}/livreur/{id}/delete
// set groupe/{id}/nom
// set groupe/{id}/delete
// set groupe/{id}/droits/{id}/add
// set groupe/{id}/droits/{id}/delete
// set groupe/add

class Groupes {
    // recupere les groupes d'un joueur
    public static function getGroupesByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur
        WHERE groupes.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un joueur membre
    public static function getGroupesByJoueurMembre($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_joueurs ON groupes_joueurs.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_joueurs.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un compte
    public static function getGroupesByCompte($bdd,$idCompte) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_comptes ON groupes_comptes.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_comptes.id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une offre
    public static function getGroupesByOffre($bdd,$idOffre) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_offres ON groupes_offres.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_offres.id_offre = :id_offre');
        $req->execute(array(
            'id_offre' => $idOffre
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une adresse
    public static function getGroupesByAdresse($bdd,$idAdresse) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_adresses ON groupes_adresses.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_adresses.id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $idAdresse
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un livreur
    public static function getGroupesByLivreur($bdd,$idLivreur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_livreurs ON groupes_livreurs.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_livreurs.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $idLivreur
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une apikey
    public static function getGroupesByapikey($bdd,$idApiKey) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_apikeys ON groupes_apikeys.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_apikeys.id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $idApiKey
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les joueurs d'un groupe
    public static function getJoueursByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_joueurs.*,joueurs.pseudo_joueur FROM groupes_joueurs 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_joueurs.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les comptes d'un groupe
    public static function getComptesByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_comptes.*,comptes.nom_compte,joueurs.pseudo_joueur FROM groupes_comptes 
        INNER JOIN comptes ON groupes_comptes.id_compte = comptes.id_compte 
        INNER JOIN joueurs ON comptes.id_joueur = joueurs.id_joueur 
        WHERE groupes_comptes.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les offres d'un groupe
    public static function getOffresByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_offres.*,offres.nom_offre,joueurs.pseudo_joueur FROM groupes_offres 
        INNER JOIN offres ON groupes_offres.id_offre = offres.id_offre 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur 
        WHERE groupes_offres.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les adresses d'un groupe
    public static function getAdressesByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_adresses.*,adresses.nom_adresse,joueurs.pseudo_joueur FROM groupes_adresses 
        INNER JOIN adresses ON groupes_adresses.id_adresse = adresses.id_adresse 
        INNER JOIN joueurs ON adresses.id_joueur = joueurs.id_joueur
        WHERE groupes_adresses.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les comptes d'un groupe
    public static function getLivreursByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_livreurs.*,livreurs.nom_livreur,joueurs.pseudo_joueur FROM groupes_livreurs 
        INNER JOIN livreurs ON groupes_livreurs.id_livreur = livreurs.id_livreur 
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        WHERE groupes_livreurs.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les apikeys d'un groupe
    public static function getapikeysByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes_apikey.*,apikeys.nom_apikey,joueurs.pseudo_joueur FROM groupes_apikeys 
        INNER JOIN apikeys ON groupes.id_apikey = apikeys.id_apikey 
        WHERE groupes_apikey.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupes;
    }

    // recupere les droits d'un groupe
    public static function getDroitsByGroupe($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT * FROM droits 
        INNER JOIN groupes_droits ON droits.id_droit = groupes_droits.id_droit 
        WHERE groupes_droits.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $droits = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droits;
    }

    // recupere les infos d'un groupe
    public static function getGroupeById($bdd,$idGroupe) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $idGroupe
        ));
        $groupe = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupe;
    }

    private $_idGroupe;
    private $_bdd;

    public function __construct($bdd,$idGroupe = null) {
        $this->_bdd = $bdd;
        if($idGroupe != null) {
            $this->_idGroupe = $idGroupe;
        }
    }

    // recupere l'id du groupe
    public function getIdGroupe() {
        return $this->_idGroupe;
    }

    // ajoute une offre au groupe
    public function addGroupeOffre($idOffre) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_offres(id_groupe,id_offre) VALUES(:id_groupe,:id_offre)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_offre' => $idOffre
        ));
    }

    // retire une offre du groupe
    public function deleteGroupeOffre($idOffre) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_offres WHERE id_groupe = :id_groupe AND id_offre = :id_offre');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_offre' => $idOffre
        ));
    }

    // ajoute une adresse au groupe
    public function addGroupeAdresse($idAdresse) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_adresses(id_groupe,id_adresse) VALUES(:id_groupe,:id_adresse)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_adresse' => $idAdresse
        ));
    }

    // retire une adresse du groupe
    public function deleteGroupeAdresse($idAdresse) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_adresses WHERE id_groupe = :id_groupe AND id_adresse = :id_adresse');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_adresse' => $idAdresse
        ));
    }

    // ajoute un compte au groupe
    public function addGroupeCompte($idCompte) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_comptes(id_groupe,id_compte) VALUES(:id,:id_compte)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_compte' => $idCompte
        ));
    }

    // retire un compte du groupe
    public function deleteGroupeCompte($idCompte) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_comptes WHERE id_groupe = :id_groupe AND id_compte = :id_compte');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_compte' => $idCompte
        ));
    }

    // ajoute une apikey au groupe
    public function addGroupeapikey($idApiKey) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_apikeys(id_groupe,id_apikey) VALUES(:id,:id_apikey)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_apikey' => $idApiKey
        ));
    }

    // retire une apikey du groupe
    public function deleteGroupeapikey($idApiKey) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_apikeys WHERE id_groupe = :id_groupe AND id_apikey = :id_apikey');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_apikey' => $idApiKey
        ));
    }

    // ajoute un joueur au groupe
    public function addGroupeJoueur($idJoueur) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_joueurs(id_groupe,id_joueur) VALUES(:id,:id_joueur)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_joueur' => $idJoueur
        ));
    }

    // retire un joueur du groupe
    public function deleteGroupeJoueur($idJoueur) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_joueurs WHERE id_groupe = :id_groupe AND id_joueur = :id_joueur');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_joueur' => $idJoueur
        ));
    }

    // ajoute un livreur au groupe
    public function addGroupeLivreur($idLivreur) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_livreurs(id_groupe,id_livreur) VALUES(:id_groupe,:id_livreur)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_livreur' => $idLivreur
        ));
    }

    // retire un livreur au groupe
    public function deleteGroupeLivreur($idLivreur) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_livreurs WHERE id_groupe = :id_groupe AND id_livreur = :id_livreur');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_livreur' => $idLivreur
        ));
    }

    // modifie le nom d'un groupe
    public function setGroupeNom($nom) {
        $req = $this->_bdd->prepare('UPDATE groupes SET nom = :nom WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'nom' => $nom
        ));
    }

    // supprime un groupe
    public function deleteGroupe() {
        $req = $this->_bdd->prepare('DELETE FROM groupes WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe
        ));
    }

    // ajoute un droit a un groupe
    public function addGroupeDroits($idDroits) {
        $req = $this->_bdd->prepare('INSERT INTO groupes_droits(id_groupe,id_droits) VALUES(:id_groupe,:id_droits)');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_droits' => $idDroits
        ));
    }

    // supprime un droit d'un groupe
    public function deleteGroupeDroits($idDroits) {
        $req = $this->_bdd->prepare('DELETE FROM groupes_droits WHERE id_groupe = :id_groupe AND id_droits = :id_droits');
        $req->execute(array(
            'id_groupe' => $this->_idGroupe,
            'id_droits' => $idDroits
        ));
    }

    // ajoute un groupe
    public function addGroupe($nom,$idJoueur) {
        $req = $this->_bdd->prepare('INSERT INTO groupes(nom,id_joueur) VALUES(:nom,:id_joueur)');
        $req->execute(array(
            'nom' => $nom,
            'id_joueur' => $idJoueur
        ));
        $this->_idGroupe = $this->_bdd->lastInsertId();
    }
}