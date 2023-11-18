<?php
// get livreurs/{id_joueur}/user
// get livreurs/{id_joueur}/apikey
// get livreurs/{id_compte}
// get livreurs/{id_adresse}
// get livreur/{id}
// set livreur/{id}/delete
// set livreur/add
// set livreur/{id}/compte
// set livreur/{id}/adresse
// set livreur/{id}/nom_groupe

class Livreurs {
    // recupere les livreurs accessible par le joueur (lui a partient ou groupe en communs qui permet le getLivreurs)
    public static function getLivreursByUser($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT livreurs.*,joueurs.pseudo_joueur, comptes.nom_compte, adresses.nom_adresse FROM livreurs
        INNER JOIN groupes_livreurs ON livreurs.id_livreur = groupes_livreurs.id_livreur
        INNER JOIN groupes_joueurs ON groupes_livreurs.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_livreurs.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON livreurs.id_compte = comptes.id_compte
        LEFT JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom_droit = :nom_droit) OR (livreurs.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'nom_droit' => "getlivreurs"
        ));
        $livreurs = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs accessible par la apikey (groupe en communs qui permet le getlivreurs)
    public static function getLivreursByapikey($bdd,$idApiKey) {
        $req = $bdd->prepare('SELECT livreurs.*,joueurs.pseudo_joueur, comptes.nom_compte, adresses.nom_adresse FROM livreurs
        INNER JOIN groupes_livreurs ON livreurs.id_livreur = groupes_livreurs.id_livreur
        INNER JOIN groupes_apikeys ON groupes_livreurs.id_groupe = groupes_apikeys.id_groupe
        INNER JOIN apikeys ON groupes_apikeys.id_apikey = apikeys.id_apikey
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_livreurs.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = groupes_apikeys.id_groupe
        INNER JOIN droits     ON droits.id_droit = apikeys_droits.id_droit
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON livreurs.id_compte = comptes.id_compte
        LEFT JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE apikeys.id_apikey = :id_apikey AND droits.nom_droit = :nom_droit');
        $req->execute(array(
            'id_apikey' => $idApiKey,
            'nom_droit' => "getlivreurs"
        ));
        $livreurs = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs d'un joueur
    public static function getLivreursByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT livreurs.*, joueurs.pseudo_joueur,comptes.nom_compte, adresses.nom_adresse  FROM livreurs
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON livreurs.id_compte = comptes.id_compte
        LEFT JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE livreurs.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $livreurs = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs utilisant un compte precis
    public static function getLivreursByCompte($bdd,$idCompte) {
        $req = $bdd->prepare('SELECT livreurs.*, joueurs.pseudo_joueur,comptes.nom_compte, adresses.nom_adresse  FROM livreurs
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON livreurs.id_compte = comptes.id_compte
        LEFT JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE livreurs.id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $livreurs = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs utilisant une adresse precis
    public static function getLivreursByAdresse($bdd,$idAdresse) {
        $req = $bdd->prepare('SELECT livreurs.*, joueurs.pseudo_joueur,comptes.nom_compte, adresses.nom_adresse  FROM livreurs
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON livreurs.id_compte = comptes.id_compte
        INNER JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE livreurs.id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $idAdresse
        ));
        $livreurs = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreurs;
    }

    // recupere un livreur precis
    public static function getLivreurById($bdd,$idLivreur) {
        $req = $bdd->prepare('SELECT livreurs.*, joueurs.pseudo_joueur,comptes.nom_compte, adresses.nom_adresse  FROM livreurs
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON livreurs.id_compte = comptes.id_compte
        LEFT JOIN adresses ON livreurs.id_adresse = adresses.id_adresse
        WHERE livreurs.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $idLivreur
        ));
        $livreur = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreur;
    }

    private $_idLivreur;
    private $_bdd;

    public function __construct($bdd,$idLivreur = null) {
        $this->_bdd = $bdd;
        if($idLivreur != null) {
            $this->_idLivreur = $idLivreur;
        }
    }

    // recupere l'id du livreur
    public function getIdLivreur() {
        return $this->_idLivreur;
    }

    // modifie le compte d'un livreur
    public function setLivreurCompte($idCompte) {
        $req = $this->_bdd->prepare('UPDATE livreurs SET id_compte = :id_compte WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $this->_idLivreur,
            'id_compte' => $idCompte
        ));
    }

    // modifie l'adresse d'un livreur
    public function setLivreurAdresse($idAdresse) {
        $req = $this->_bdd->prepare('UPDATE livreurs SET id_adresse = :id_adresse WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $this->_idLivreur,
            'id_adresse' => $idAdresse
        ));
    }

    // modifie le nom d'un livreur
    public function setLivreurNom($nomLivreur) {
        $req = $this->_bdd->prepare('UPDATE livreurs SET nom_livreur = :nom_livreur WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $this->_idLivreur,
            'nom_livreur' => $nomLivreur
        ));
    }

    // supprime un livreur precis
    public function deleteLivreur() {
        $req = $this->_bdd->prepare('DELETE FROM livreurs
        WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $this->_idLivreur
        ));
    }

    // ajoute un livreur
    public function addLivreur($idJoueur,$idCompte,$idAdresse,$nomLivreur) {
        $req = $this->_bdd->prepare('INSERT INTO livreurs(id_joueur,id_compte,id_adresse,nom_livreur) VALUES(:id_joueur,:id_compte,:id_adresse,:nom_livreur)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'id_compte' => $idCompte,
            'id_adresse' => $idAdresse,
            'nom_livreur' => $nomLivreur
        ));
        $this->_idLivreur = $this->_bdd->lastInsertId();
    }
}