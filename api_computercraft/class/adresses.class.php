<?php
// get adresses/{id_groupe}
// get adresses/{id_utilisateur}
// get adresse/{id}
// set adresse/{id}/coo
// set adresse/{id}/name
// set adresse/{id}/description
// set adresse/{id}/type
// set adresse/{id}/groupe/{id}/add
// set adresse/{id}/groupe/{id}/delete
// set adresse/add
// set adresse/{id}/delete
class Adresses
{
    public static function getAdresses_user($bdd,$user_id) {
        // recupere les adresses des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM adresses 
        INNER JOIN groupe_adresses ON adresses.id_adresse = groupe_adresses.id_adresse
        INNER JOIN groupe_utilisateur ON groupe_adresses.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE (groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action) OR (adresses.id_joueur = :user_id)');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getAdresses"
        ));
        $adresses = $req->fetchAll();
        return $adresses;
    }

    public static function getAdresses_apikey($bdd,$apikey) {
        // recupere les adresses du proprio de l'apikey (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM adresses
        INNER JOIN groupe_adresses ON adresses.id_adresse = groupe_adresses.id_adresse
        INNER JOIN groupe_apikey ON groupe_adresses.id_groupe = groupe_apikey.id_groupe
        INNER JOIN apikeys ON groupe_apikey.id_apikey = apikeys.id_apikey
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        INNER JOIN apikey_droits    ON apikey_droits.id_apikey = groupe_apikey.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = apikey_droits.id_droit
        WHERE apikeys.nom = :nom AND liste_droits.nom = :action AND adresses.id_joueur = apikeys.id_joueur');
        $req->execute(array(
            'nom' => $apikey,
            'action' => "getAdresses"
        ));
        $adresses = $req->fetchAll();
        return $adresses;
    }

    public static function getAdressesGroupe_user($bdd,$id_groupe,$user_id) {
        // recupere les adresses des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM adresses 
        INNER JOIN groupe_adresses ON adresses.id_adresse = groupe_adresses.id_adresse
        INNER JOIN groupe_utilisateur ON groupe_adresses.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getAdresses"
        ));
        $adresses = $req->fetchAll();
        return $adresses;
    }

    public static function getAdressesGroupe_apikey($bdd,$id_groupe,$apikey) {
        // recupere les adresses du proprio de l'apikey (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM adresses
        INNER JOIN groupe_adresses ON adresses.id_adresse = groupe_adresses.id_adresse
        INNER JOIN groupe_apikey ON groupe_adresses.id_groupe = groupe_apikey.id_groupe
        INNER JOIN apikeys ON groupe_apikey.id_apikey = apikeys.id_apikey
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_adresses.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        INNER JOIN apikey_droits    ON apikey_droits.id_apikey = groupe_apikey.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = apikey_droits.id_droit
        WHERE apikeys.nom = :nom AND liste_droits.nom = :action AND groupe_adresses.id_groupe = :id_groupe');
        $req->execute(array(
            'nom' => $apikey,
            'action' => "getAdresses",
            'id_groupe' => $id_groupe
        ));
        $adresses = $req->fetchAll();
        return $adresses;
    }

    public static function getAdresse($bdd,$id) {
        $req = $bdd->prepare('SELECT * FROM adresses WHERE id = :id');
        $req->execute(array(
            'id' => $id
        ));
        $adresse = $req->fetch();
        return $adresse;
    }

    public static function setAdresseCoordonnees($bdd,$id,$coo) {
        $req = $bdd->prepare('UPDATE adresses SET coo = :coo WHERE id = :id');
        $req->execute(array(
            'coo' => $coo,
            'id' => $id
        ));
    }

    public static function setAdresseName($bdd,$id,$name) {
        $req = $bdd->prepare('UPDATE adresses SET name = :name WHERE id = :id');
        $req->execute(array(
            'name' => $name,
            'id' => $id
        ));
    }

    public static function setAdresseDescription($bdd,$id,$description) {
        $req = $bdd->prepare('UPDATE adresses SET description = :description WHERE id = :id');
        $req->execute(array(
            'description' => $description,
            'id' => $id
        ));
    }

    public static function setAdresseType($bdd,$id,$type) {
        $req = $bdd->prepare('UPDATE adresses SET type = :type WHERE id = :id');
        $req->execute(array(
            'type' => $type,
            'id' => $id
        ));
    }

    public static function setAdresseGroupeAdd($bdd,$id,$groupe_id) {
        $req = $bdd->prepare('INSERT INTO adresses_groupe (adresse_id,groupe_id) VALUES (:adresse_id,:groupe_id)');
        $req->execute(array(
            'adresse_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public static function setAdresseGroupeDelete($bdd,$id,$groupe_id) {
        $req = $bdd->prepare('DELETE FROM adresses_groupe WHERE adresse_id = :adresse_id AND groupe_id = :groupe_id');
        $req->execute(array(
            'adresse_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public static function setAdresseAdd($bdd,$user_id,$coo,$name,$description,$type) {
        $req = $bdd->prepare('INSERT INTO adresses (user_id,coo,name,description,type) VALUES (:user_id,:coo,:name,:description,:type)');
        $req->execute(array(
            'user_id' => $user_id,
            'coo' => $coo,
            'name' => $name,
            'description' => $description,
            'type' => $type
        ));
    }

    public static function setAdresseDelete($bdd,$user_id,$id) {
        $req = $bdd->prepare('DELETE FROM adresses WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'id' => $id,
            'user_id' => $user_id
        ));
    }
}