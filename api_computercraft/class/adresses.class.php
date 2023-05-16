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
        $req = $bdd->prepare('SELECT * FROM adresses 
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_joueurs ON groupes_adresses.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND liste_droits.nom = :action) OR (adresses.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'action' => "getAdresses"
        ));
        $adresses = $req->fetchAll();
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses accessible par la keyapi (groupe en communs qui permet le getadresses)
    public static function getAdressesWithKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM adresses
        INNER JOIN groupes_adresses ON adresses.id_adresse = groupes_adresses.id_adresse
        INNER JOIN groupes_keyapis ON groupes_adresses.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN keyapis ON groupes_keyapis.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        INNER JOIN keyapis_droits    ON keyapis_droits.id_keyapi = groupes_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapis_droits.id_droit
        WHERE keyapis.id_keyapi = :id_keyapi AND liste_droits.nom = :action');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'action' => "getAdresses"
        ));
        $adresses = $req->fetchAll();
		$req->closeCursor();
        return $adresses;
    }

    // recupere les adresses d'un joueur
    public static function getAdresses($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM adresses WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $adresses = $req->fetchAll();
        $req->closeCursor();
        return $adresses;
    }

    // recupere l'adresse
    public static function getAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('SELECT * FROM adresses WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
        $adresse = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $adresse;
    }

    // modifie les Coordonnees de l'adresse
    public static function setAdresseCoordonnees($bdd,$id_adresse,$coo) {
        $req = $bdd->prepare('UPDATE adresses SET coo = :coo WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'coo' => $coo,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie le nom de l'adresse
    public static function setAdresseNom($bdd,$id_adresse,$nom) {
        $req = $bdd->prepare('UPDATE adresses SET nom = :nom WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'nom' => $nom,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie la description de l'adresse
    public static function setAdresseDescription($bdd,$id_adresse,$description) {
        $req = $bdd->prepare('UPDATE adresses SET description = :description WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'description' => $description,
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
    public static function setAdresse($bdd,$id_joueur,$coo,$nom,$description,$id_type_adresse) {
        $req = $bdd->prepare('INSERT INTO adresses (id_joueur,coo,nom,description,id_type_adresse) VALUES (:id_joueur,:coo,:nom,:description,:id_type_adresse)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'coo' => $coo,
            'nom' => $nom,
            'description' => $description,
            'id_type_adresse' => $id_type_adresse
        ));
    }

    // supprime l'adresse
    public static function deleteAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('DELETE FROM adresses WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
    }
}