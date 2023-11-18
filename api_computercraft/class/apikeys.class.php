<?php
// get apikey/{id_joueur}/user
// get apikey/{id_groupe}/user
// get apikey/{id}
// get apikey/{id}/droits
// set apikey/{id}/nom
// set apikey/{id}/mdp
// set apikey/{id}/delete
// set apikey/{id}/droits/{id}/add
// set apikey/{id}/droits/{id}/delete
// set apikey/add

class apikeys {
    // recupere les apikeys visible pour un joueur (si groupe a les droits)
    public static function getApiKeysWithUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT apikeys.*,joueurs.pseudo_joueur FROM apikeys 
        INNER JOIN groupes_apikeys ON apikeys.id_apikey = groupes_apikeys.id_apikey
        INNER JOIN groupes_joueurs ON groupes_apikeys.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_apikeys.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON apikeys.id_joueur = joueurs.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom_droit = :nom_droit) OR (apikeys.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'nom_droit' => "getapikeys"
        ));
        $apikeys = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $apikeys;
    }

    // recupere les apikeys d'un joueur
    public static function getApiKeysByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT apikeys.*,joueurs.pseudo_joueur FROM apikeys INNER JOIN joueurs ON apikeys.id_joueur = joueurs.id_joueur WHERE apikeys.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $apikeys = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $apikeys;
    }

    // recupere les info d'une apikey avec son id
    public static function getApiKeyById($bdd,$id_apikey) {
        $req = $bdd->prepare('SELECT apikeys.*,joueurs.pseudo_joueur FROM apikeys INNER JOIN joueurs ON apikeys.id_joueur = joueurs.id_joueur WHERE apikeys.id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $id_apikey
        ));
        $apikey = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $apikey;
    }

    // recupere les info d'une apikey avec son nom
    public static function getApiKeyByNom($bdd,$nom_apikey) {
        $req = $bdd->prepare('SELECT apikeys.*,joueurs.pseudo_joueur FROM apikeys INNER JOIN joueurs ON apikeys.id_joueur = joueurs.id_joueur WHERE apikeys.nom_apikey = :nom_apikey');
        $req->execute(array(
            'nom_apikey' => $nom_apikey
        ));
        $apikey = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $apikey;
    }

    // recupere les droits d'une apikey
    public static function getDroitsByApiKey($bdd,$id_apikey) {
        $req = $bdd->prepare('SELECT * FROM droits INNER JOIN apikeys_droits ON droits.id_droit = apikeys_droits.id_droit WHERE apikeys_droits.id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $id_apikey
        ));
        $droits = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droits;
    }


    private $_idApiKey;
    private $_bdd;

    public function __construct($bdd,$idApiKey = null) {
        $this->_bdd = $bdd;
        if($idApiKey != null) {
            $this->_idApiKey = $idApiKey;
        }
    }

    // recupere l'id de l'ApiKey
    public function getIdApiKey() {
        return $this->_idApiKey;
    }

    // change le nom d'une apikey
    public function setApiKeyNom($nomApiKey,$idJoueur) {
        $req = $this->_bdd->prepare('UPDATE apikeys SET nom_apikey = :nom_apikey WHERE id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $this->_idApiKey,
            'nom_apikey' => $idJoueur . "-" . $nomApiKey,
        ));
    }

    //change le mdp d'une apikey
    public function setApiKeyMdp($mdpApiKey) {
        $req = $this->_bdd->prepare('UPDATE apikeys SET mdp_apikey = :mdp_apikey WHERE id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $this->_idApiKey,
            'mdp_apikey' => $mdpApiKey
        ));
    }

    // supprime un droit d'une apikey
    public function deleteApiKeyDroits($idDroit) {
        $req = $this->_bdd->prepare('DELETE FROM apikeys_droits WHERE id_apikey = :id_apikey AND id_droit = :id_droit');
        $req->execute(array(
            'id_apikey' => $this->_idApiKey,
            'id_droit' => $idDroit
        ));
    }

    // ajoute un droit a une apikey
    public function addApiKeyDroits($idDroit) {
        $req = $this->_bdd->prepare('INSERT INTO apikeys_droits(id_apikey,id_droit) VALUES(:id_apikey,:id_droit)');
        $req->execute(array(
            'id_apikey' => $this->_idApiKey,
            'id_droit' => $idDroit
        ));
    }

    // supprime une apikey
    public function deleteApiKey() {
        $req = $this->_bdd->prepare('DELETE FROM apikeys WHERE id_apikey = :id_apikey');
        $req->execute(array(
            'id_apikey' => $this->_idApiKey
        ));
    }

    // creer une apikey
    public function addApiKey($nomApiKey,$mdpApiKey,$idJoueur) {
        $req = $this->_bdd->prepare('INSERT INTO apikeys(nom_apikey,mdp_apikey,id_joueur) VALUES(:nom_apikey,:mdp_apikey,:id_joueur)');
        $req->execute(array(
            'nom_apikey' => $idJoueur . "-" . $nomApiKey,
            'mdp_apikey' => $mdpApiKey,
            'id_joueur' => $idJoueur
        ));
        $this->_idApiKey = $this->_bdd->lastInsertId();
    }
}