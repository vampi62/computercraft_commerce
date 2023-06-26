<?php
// get adresses/{id_joueur}/user
// get adresses/{id_joueur}/keyapi
// get adresse/{id}
// set adresse/{id}/coo
// set adresse/{id}/name
// set adresse/{id}/description
// set adresse/{id}/type
// set adresse/add
// set adresse/{id}/delete
class Adresses {
    // recupere les adresses accessible par le joueur (lui a partient ou groupes en communs qui permet le getadresses)
    public static function getAdressesWithUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur, livreurs.nom_livreur FROM adresses 
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_joueurs ON groupes_adresses.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_adresse = adresses.id_adresse
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom = :nom_droit) OR (adresses.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'nom_droit' => "getAdresses"
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses accessible par la keyapi (groupe en communs qui permet le getadresses)
    public static function getAdressesWithKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur, livreurs.nom_livreur FROM adresses
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_keyapis ON groupes_adresses.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN keyapis ON groupes_keyapis.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN keyapis_droits    ON keyapis_droits.id_keyapi = groupes_keyapis.id_groupe
        INNER JOIN droits     ON droits.id_droit = keyapis_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_adresse = adresses.id_adresse
        WHERE keyapis.id_keyapi = :id_keyapi AND droits.nom = :nom_droit');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'nom_droit' => "getAdresses"
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses d'un joueur
    public static function getAdressesByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses 
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $adresses;
    }

    // recupere les adresse d'un livreur
    public static function getAdressesByLivreur($bdd,$id_livreur) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses 
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur
        ));
        $adresses = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $adresses;
    }

    // recupere l'adresse
    public static function getAdresseById($bdd,$id_adresse) {
        $req = $bdd->prepare('SELECT adresses.*,joueurs.pseudo_joueur,livreurs.nom_livreur FROM adresses
        INNER JOIN joueurs ON joueurs.id_joueur = adresses.id_joueur
        LEFT JOIN livreurs ON livreurs.id_livreur = adresses.id_livreur WHERE adresses.id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
        $adresse = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresse;
    }

    // modifie les Coordonnees de l'adresse
    public static function setAdresseCoordonnees($bdd,$id_adresse,$coo_adresse) {
        $req = $bdd->prepare('UPDATE adresses SET coo_adresse = :coo_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'coo_adresse' => $coo_adresse,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie le nom de l'adresse
    public static function setAdresseNom($bdd,$id_adresse,$nom_adresse) {
        $req = $bdd->prepare('UPDATE adresses SET nom_adresse = :nom_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'nom_adresse' => $nom_adresse,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie la description de l'adresse
    public static function setAdresseDescription($bdd,$id_adresse,$description_adresse) {
        $req = $bdd->prepare('UPDATE adresses SET description_adresse = :description_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'description_adresse' => $description_adresse,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie le livreur de l'adresse
    public static function setAdresseLivreur($bdd,$id_adresse,$id_livreur) {
        $req = $bdd->prepare('UPDATE adresses SET id_livreur = :id_livreur WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_livreur' => $id_livreur,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie le type de l'adresse
    public static function setAdresseType($bdd,$id_adresse,$id_type_adresse) {
        $req = $bdd->prepare('UPDATE adresses SET id_type_adresse = :id_type_adresse WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_type_adresse' => $id_type_adresse,
            'id_adresse' => $id_adresse
        ));
    }

    // ajoute une adresse
    public static function addAdresse($bdd,$id_joueur,$coo_adresse,$nom_adresse,$description_adresse,$id_type_adresse,$id_livreur) {
        if ($id_livreur == "") {
            $id_livreur = NULL;
        }
        $req = $bdd->prepare('INSERT INTO adresses (id_joueur,coo_adresse,nom_adresse,description_adresse,id_type_adresse,id_livreur) VALUES (:id_joueur,:coo_adresse,:nom_adresse,:description_adresse,:id_type_adresse,:id_livreur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'coo_adresse' => $coo_adresse,
            'nom_adresse' => $nom_adresse,
            'description_adresse' => $description_adresse,
            'id_type_adresse' => $id_type_adresse,
            'id_livreur' => $id_livreur
        ));
        return $bdd->lastInsertId();
    }

    // supprime l'adresse
    public static function deleteAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('DELETE FROM adresses WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
    }
}