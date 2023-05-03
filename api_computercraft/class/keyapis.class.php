<?php
// get keyapi/{id_joueur}/user
// get keyapi/{id_groupe}/user
// get keyapi/{id}
// get keyapi/{id}/droits
// set keyapi/{id}/nom
// set keyapi/{id}/mdp
// set keyapi/{id}/delete
// set keyapi/{id}/droits/{id}/add
// set keyapi/{id}/droits/{id}/delete
// set keyapi/add

class Keyapis {
    // recupere les keyapis visible pour un joueur (si groupe a les droits)
    public static function getKeyApisByUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM keyapis 
        INNER JOIN groupes_keyapis ON keyapis.id_keyapi = groupes_keyapis.id_keyapi
        INNER JOIN groupes_joueurs ON groupes_keyapis.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND liste_droits.nom = :action) OR (keyapis.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'action' => "getkeyapis"
        ));
        $keyapis = $req->fetchAll();
        return $keyapis;
    }

    // recupere les info d'une keyapi
    public static function getKeyapis($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM keyapis WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        $keyapi = $req->fetch(PDO::FETCH_ASSOC);
        return $keyapi;
    }

    // recupere les droits d'une keyapi
    public static function getKeyApisDroits($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT liste_droits.* FROM liste_droits INNER JOIN keyapis_droits ON liste_droits.id_droit = keyapis_droits.id_droit WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        $droits = $req->fetchAll();
        return $droits;
    }

    // change le nom d'une keyapi
    public static function setKeyapisNom($bdd,$id_keyapi,$nom) {
        $req = $bdd->prepare('UPDATE keyapis SET nom = :nom WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'nom' => $nom
        ));
        return true;
    }

    //change le mdp d'une keyapi
    public static function setKeyapisMdp($bdd,$id_keyapi,$mdp) {
        $req = $bdd->prepare('UPDATE keyapis SET mdp = :mdp WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'mdp' => password_hash($mdp, PASSWORD_DEFAULT)
        ));
        return true;
    }

    // supprime une keyapi
    public static function deleteKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('DELETE FROM keyapis WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        return true;
    }

    // ajoute un droit a une keyapi
    public static function setKeyapiDroits($bdd,$id_keyapi,$id_droit) {
        $req = $bdd->prepare('INSERT INTO keyapis_droits(id_keyapi,id_droit) VALUES(:id_keyapi,:id_droit)');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'id_droit' => $id_droit
        ));
        return true;
    }

    // supprime un droit d'une keyapi
    public static function deleteKeyapiDroits($bdd,$id_keyapi,$id_droit) {
        $req = $bdd->prepare('DELETE FROM keyapis_droits WHERE id_keyapi = :id_keyapi AND id_droit = :id_droit');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'id_droit' => $id_droit
        ));
        return true;
    }

    // creer une keyapi
    public static function setKeyapi($bdd,$nom,$mdp,$id_joueur) {
        $req = $bdd->prepare('INSERT INTO keyapis(nom,mdp,id_joueur) VALUES(:nom,:mdp,:id_joueur)');
        $req->execute(array(
            'nom' => $nom,
            'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
            'id_joueur' => $id_joueur
        ));
        return true;
    }
}