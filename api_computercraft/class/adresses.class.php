<?php
// get adresses/{id_joueur}/user
// get adresses/{id_joueur}/apikey
// get adresse/{id}
// set adresse/{id}/coo
// set adresse/{id}/name
// set adresse/{id}/description
// set adresse/{id}/type
// set adresse/add
// set adresse/{id}/delete
class Adresses {
    // recupere les adresses accessible par le joueur (lui a partient ou groupes en communs qui permet le getadresses)
    public static function getAdressesWithUser($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur FROM adresses 
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_joueurs ON groupes_adresses.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom = :nom_droit) OR (adresses.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'nom_droit' => "getAdresses"
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses accessible par la apikey (groupe en communs qui permet le getadresses)
    public static function getAdressesWithapikey($bdd,$idApiKey) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur, livreurs.nom_livreur FROM adresses
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_apikeys ON groupes_adresses.id_groupe = groupes_apikeys.id_groupe
        INNER JOIN apikeys ON groupes_apikeys.id_apikey = apikeys.id_apikey
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = groupes_apikeys.id_groupe
        INNER JOIN droits     ON droits.id_droit = apikeys_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_adresse = adresses.id_adresse
        WHERE apikeys.id_apikey = :id_apikey AND droits.nom = :nom_droit');
        $req->execute(array(
            'id_apikey' => $idApiKey,
            'nom_droit' => "getAdresses"
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses d'un joueur
    public static function getAdressesByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses 
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $adresses;
    }

    // recupere les adresse d'un livreur
    public static function getAdressesByLivreur($bdd,$idLivreur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses 
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $idLivreur
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $adresses;
    }

    // recupere l'adresse
    public static function getAdresseById($bdd,$idAdresse) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $idAdresse
        ));
        $adresse = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresse;
    }

    private $_idAdresse;
    private $_bdd;

    public function __construct($bdd,$idAdresse = null) {
        $this->_bdd = $bdd;
        if($idAdresse != null) {
            $this->_idAdresse = $idAdresse;
        }
    }

    // recupere l'id de l'adresse
    public function getIdAdresse() {
        return $this->_idAdresse;
    }

    // modifie les Coordonnees de l'adresse
    public function setAdresseCoordonnees($cooAdresse) {
        $req = $this->_bdd->prepare('UPDATE adresses SET coo_adresse = :coo_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'coo_adresse' => $cooAdresse,
            'id_adresse' => $_idAdresse
        ));
    }

    // modifie le nom de l'adresse
    public function setAdresseNom($nomAdresse) {
        $req = $this->_bdd->prepare('UPDATE adresses SET nom_adresse = :nom_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'nom_adresse' => $nomAdresse,
            'id_adresse' => $_idAdresse
        ));
    }

    // modifie la description de l'adresse
    public function setAdresseDescription($descriptionAdresse) {
        $req = $this->_bdd->prepare('UPDATE adresses SET description_adresse = :description_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'description_adresse' => $descriptionAdresse,
            'id_adresse' => $_idAdresse
        ));
    }

    // modifie le type de l'adresse
    public function setAdresseType($idTypeAdresse) {
        $req = $this->_bdd->prepare('UPDATE adresses SET id_type_adresse = :id_type_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_type_adresse' => $idTypeAdresse,
            'id_adresse' => $_idAdresse
        ));
    }

    // supprime l'adresse
    public function deleteAdresse() {
        $req = $this->_bdd->prepare('DELETE FROM adresses WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $_idAdresse
        ));
    }

    // ajoute une adresse
    public function addAdresse($cooAdresse,$nomAdresse,$descriptionAdresse,$idTypeAdresse) {
        $req = $this->_bdd->prepare('INSERT INTO adresses (id_joueur,coo_adresse,nom_adresse,description_adresse,id_type_adresse) VALUES (:id_joueur,:coo_adresse,:nom_adresse,:description_adresse,:id_type_adresse)');
        $req->execute(array(
            'id_joueur' => $_idAdresse,
            'coo_adresse' => $cooAdresse,
            'nom_adresse' => $nomAdresse,
            'description_adresse' => $descriptionAdresse,
            'id_type_adresse' => $idTypeAdresse
        ));
        $this->_idAdresse = $this->_bdd->lastInsertId();
    }
}