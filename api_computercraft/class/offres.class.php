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
    // recupere toutes les offres
    public static function getOffres($bdd,$bool_remove_inactive=FALSE) {
        $req = $bdd->prepare('SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse');
        $req->execute();
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($bool_remove_inactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres d'un joueur
    public static function getOffresByJoueur($bdd,$id_joueur,$bool_remove_inactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_joueur = :id_joueur");
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($bool_remove_inactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres associer a un compte
    public static function getOffresByCompte($bdd,$id_compte,$bool_remove_inactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_compte = :id_compte");
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($bool_remove_inactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere les offres associer a une adresse
    public static function getOffresByAdresse($bdd,$id_adresse,$bool_remove_inactive=FALSE) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_adresse = :id_adresse");
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
        $offres = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if ($bool_remove_inactive) {
            return self::removeInactiveOffre($offres);
        }
        else {
            return $offres;
        }
    }

    // recupere l'offre
    public static function getOffreById($bdd,$id_offre) {
        $req = $bdd->prepare("SELECT offres.*,joueurs.pseudo_joueur,comptes.nom_compte,adresses.nom_adresse FROM offres 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur
        INNER JOIN comptes ON offres.id_compte = comptes.id_compte
        INNER JOIN adresses ON offres.id_adresse = adresses.id_adresse
        WHERE offres.id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre
        ));
        $offre = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $offre;
    }

    // retire de la liste toutes les offres qui n'ont pas de prix, de compte, d'adresse, de type de produit, de description ou de nom
    private static function removeInactiveOffre($liste_offres) {
        $liste_offres_active = array();
        foreach ($liste_offres as $offre) {
            if ($offre['prix'] != null && $offre['id_compte'] != null && $offre['id_adresse'] != null && $offre['id_type_offre'] != null && $offre['description'] != null && $offre['nom'] != null) {
                array_push($liste_offres_active,$offre);
            }
        }
        return $liste_offres_active;
    }

    // modifie la date de derniere modification de l'offre
    private static function updateLastUpdate($bdd,$id_offre) {
        $req = $bdd->prepare("UPDATE offres SET last_update_offre = :last_update_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'last_update_offre' => date('Y-m-d H:i:s')
        ));
    }

    // modifie le compte associer a l'offre
    public static function setOffreCompte($bdd,$id_offre,$id_compte) {
        $req = $bdd->prepare("UPDATE offres SET id_compte = :id_compte WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_compte' => $id_compte
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie l'adresse associer a l'offre
    public static function setOffreAdresse($bdd,$id_offre,$id_adresse) {
        $req = $bdd->prepare("UPDATE offres SET id_adresse = :id_adresse WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_adresse' => $id_adresse
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie le type de livraison associer a l'offre
    public static function setOffreType($bdd,$id_offre,$id_type_offre) {
        $req = $bdd->prepare("UPDATE offres SET id_type_offre = :id_type_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_type_offre' => $id_type_offre
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie le prix de l'offre
    public static function setOffrePrix($bdd,$id_offre,$prix_offre) {
        $req = $bdd->prepare("UPDATE offres SET prix_offre = :prix_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'prix_offre' => $prix_offre
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie la description de l'offre
    public static function setOffreDescription($bdd,$id_offre,$description_offre) {
        $req = $bdd->prepare("UPDATE offres SET description_offre = :description_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'description_offre' => $description_offre
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie le nom de l'offre
    public static function setOffreNom($bdd,$id_offre,$nom_offre) {
        $req = $bdd->prepare("UPDATE offres SET nom_offre = :nom_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'nom_offre' => $nom_offre
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // modifie le stock de l'offre
    public static function setOffreStock($bdd,$id_offre,$stock_offre) {
        $req = $bdd->prepare("UPDATE offres SET stock_offre = :stock_offre WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'stock_offre' => $stock_offre
        ));
        self::updateLastUpdate($bdd,$id_offre);
    }

    // supprime l'offre
    public static function deleteOffre($bdd,$id_offre) {
        $req = $bdd->prepare("DELETE FROM offres WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre
        ));
    }

    // ajoute une offre
    public static function addOffre($bdd,$id_joueur,$id_compte,$id_adresse,$id_type_offre,$prix_offre,$description_offre,$nom_offre,$stock_offre) {
        $req = $bdd->prepare("INSERT INTO offres(id_joueur,id_compte,id_adresse,id_type_offre,prix_offre,description_offre,nom_offre,stock_offre,last_update_offre) VALUES(:id_joueur,:id_compte,:id_adresse,:id_type_offre,:prix_offre,:description_offre,:nom_offre,:stock_offre,:last_update_offre)");
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_compte' => $id_compte,
            'id_adresse' => $id_adresse,
            'id_type_offre' => $id_type_offre,
            'prix_offre' => $prix_offre,
            'description_offre' => $description_offre,
            'nom_offre' => $nom_offre,
            'stock_offre' => $stock_offre,
            'last_update_offre' => date('Y-m-d H:i:s')
        ));
        return $bdd->lastInsertId();
    }
}