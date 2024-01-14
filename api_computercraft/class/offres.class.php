<?php
// get offres/{id_joueur}
// get offres/{id_compte}
// get offres/{id_adresse}
// get offre/{id}
// set offre/{id}/compte
// set offre/{id}/adresse
// set offre/{id}/id_type_produit
// set offre/{id}/prix
// set offre/{id}/description
// set offre/{id}/nom
// set offre/{id}/stock
// set offre/{id}/delete
// set offre/add

class Offres {
    // recupere les offres accessible par le joueur (lui a partient ou groupe en communs qui permet le getoffres)
    public static function getOffresByUser($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres
        LEFT JOIN groupes_offres ON offres.id_offre = groupes_offres.id_offre
        LEFT JOIN groupes_joueurs ON groupes_offres.id_groupe = groupes_joueurs.id_groupe
        LEFT JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_offres.id_groupe
        LEFT JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom_droit = :nom_droit) OR (offres.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'nom_droit' => "getOffres"
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $offres;
    }

    // recupere les offres accessible par la apikey (groupe en communs qui permet le getoffres)
    public static function getOffresByApiKey($bdd,$idApiKey) {
        $req = $bdd->prepare('SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres
        INNER JOIN groupes_offres ON offres.id_offre = groupes_offres.id_offre
        INNER JOIN groupes_apikeys ON groupes_offres.id_groupe = groupes_apikeys.id_groupe
        INNER JOIN apikeys ON groupes_apikeys.id_apikey = apikeys.id_apikey
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_offres.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = groupes_apikeys.id_groupe
        INNER JOIN droits     ON droits.id_droit = apikeys_droits.id_droit
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE apikeys.id_apikey = :id_apikey AND droits.nom_droit = :nom_droit');
        $req->execute(array(
            'id_apikey' => $idApiKey,
            'nom_droit' => "getOffres"
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $offres;
    }

    // recupere toutes les offres
    public static function getOffres($bdd,$boolRemoveInactive=FALSE) {
        $req = $bdd->prepare('SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse');
        $req->execute();
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($boolRemoveInactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres d'un joueur
    public static function getOffresByJoueur($bdd,$idJoueur,$boolRemoveInactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_joueur = :id_joueur");
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($boolRemoveInactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres associer a un compte
    public static function getOffresByCompte($bdd,$idCompte,$boolRemoveInactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_compte = :id_compte");
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($boolRemoveInactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres associer a une adresse
    public static function getOffresByAdresse($bdd,$idAdresse,$boolRemoveInactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_adresse = :id_adresse");
        $req->execute(array(
            'id_adresse' => $idAdresse
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($boolRemoveInactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere l'offre
    public static function getOffreById($bdd,$idOffre,$boolRemoveInactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        LEFT JOIN comptes ON offres.id_compte = comptes.id_compte
        LEFT JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $idOffre
        ));
        $offre = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($boolRemoveInactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // retire de la liste toutes les offres qui n'ont pas de prix, de compte, d'adresse, de type de produit, de description ou de nom
    private static function removeInactiveOffre($listeOffres) {
        $listeOffresActive = array();
        foreach ($listeOffres as $offre) {
            if ($offre['prix'] != null && $offre['id_compte'] != null && $offre['id_adresse'] != null && $offre['id_type_offre'] != null && $offre['description'] != null && $offre['nom'] != null) {
                array_push($listeOffresActive,$offre);
            }
        }
        return $listeOffresActive;
    }

    private $_idOffre;
    private $_bdd;

    public function __construct($bdd,$idOffre = null) {
        $this->_bdd = $bdd;
        if($idOffre != null) {
            $this->_idOffre = $idOffre;
        }
    }

    // recupere l'id de l'offre
    public function getIdOffre() {
        return $this->_idOffre;
    }

    // modifie le compte associer a l'offre
    public function setOffreCompte($idCompte) {
        $req = $this->_bdd->prepare("UPDATE offres SET id_compte = :id_compte WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'id_compte' => $idCompte
        ));
        $this->updateLastUpdate();
    }

    // modifie l'adresse associer a l'offre
    public function setOffreAdresse($idAdresse) {
        $req = $this->_bdd->prepare("UPDATE offres SET id_adresse = :id_adresse WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'id_adresse' => $idAdresse
        ));
        $this->updateLastUpdate();
    }

    // modifie le type de livraison associer a l'offre
    public function setOffreType($idTypeOffre) {
        $req = $this->_bdd->prepare("UPDATE offres SET id_type_offre = :id_type_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'id_type_offre' => $idTypeOffre
        ));
        $this->updateLastUpdate();
    }

    // modifie le prix de l'offre
    public function setOffrePrix($prixOffre) {
        $req = $this->_bdd->prepare("UPDATE offres SET prix_offre = :prix_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'prix_offre' => $prixOffre
        ));
        $this->updateLastUpdate();
    }

    // modifie la description de l'offre
    public function setOffreDescription($descriptionOffre) {
        $req = $this->_bdd->prepare("UPDATE offres SET description_offre = :description_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'description_offre' => $descriptionOffre
        ));
        $this->updateLastUpdate();
    }

    // modifie le nom de l'offre
    public function setOffreNom($nomOffre) {
        $req = $this->_bdd->prepare("UPDATE offres SET nom_offre = :nom_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'nom_offre' => $nomOffre
        ));
        $this->updateLastUpdate();
    }

    // modifie le stock de l'offre
    public function setOffreStock($stockOffre) {
        $req = $this->_bdd->prepare("UPDATE offres SET stock_offre = :stock_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'stock_offre' => $stockOffre
        ));
        $this->updateLastUpdate();
    }

    // supprime l'offre
    public function deleteOffre() {
        $req = $this->_bdd->prepare("DELETE FROM offres WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre
        ));
    }

    // ajoute une offre
    public function addOffre($idJoueur,$idCompte,$idAdresse,$idTypeOffre,$prixOffre,$descriptionOffre,$nomOffre,$stockOffre) {
        $req = $this->_bdd->prepare("INSERT INTO offres(id_joueur,id_compte,id_adresse,id_type_offre,prix_offre,description_offre,nom_offre,stock_offre,last_update_offre) VALUES(:id_joueur,:id_compte,:id_adresse,:id_type_offre,:prix_offre,:description_offre,:nom_offre,:stock_offre,:last_update_offre)");
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'id_compte' => $idCompte,
            'id_adresse' => $idAdresse,
            'id_type_offre' => $idTypeOffre,
            'prix_offre' => $prixOffre,
            'description_offre' => $descriptionOffre,
            'nom_offre' => $nomOffre,
            'stock_offre' => $stockOffre,
            'last_update_offre' => date('Y-m-d H:i:s')
        ));
        $this->_idOffre = $this->_bdd->lastInsertId();
    }

    // modifie la date de derniere modification de l'offre
    private function updateLastUpdate() {
        $req = $this->_bdd->prepare("UPDATE offres SET last_update_offre = :last_update_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $this->_idOffre,
            'last_update_offre' => date('Y-m-d H:i:s')
        ));
    }
}