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
    public static function getKeyApisWithUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT keyapis.*,joueurs.pseudo_joueur FROM keyapis 
        INNER JOIN groupes_keyapis ON keyapis.id_keyapi = groupes_keyapis.id_keyapi
        INNER JOIN groupes_joueurs ON groupes_keyapis.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON keyapis.id_joueur = joueurs.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND liste_droits.nom_droit = :nom_droit) OR (keyapis.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'nom_droit' => "getkeyapis"
        ));
        $keyapis = $req->fetchAll();
		$req->closeCursor();
        return $keyapis;
    }

    // recupere les keyapis d'un joueur
    public static function getKeyApisByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM keyapis WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $keyapis = $req->fetchAll();
        $req->closeCursor();
        return $keyapis;
    }

    // recupere les info d'une keyapi avec son id
    public static function getKeyapiById($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM keyapis WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        $keyapi = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keyapi;
    }

    // recupere les info d'une keyapi avec son nom
    public static function getKeyapiByNom($bdd,$nom_keyapi) {
        $req = $bdd->prepare('SELECT * FROM keyapis WHERE nom_keyapi = :nom_keyapi');
        $req->execute(array(
            'nom_keyapi' => $nom_keyapi
        ));
        $keyapi = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keyapi;
    }

    // recupere les droits d'une keyapi
    public static function getDroitsByKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM liste_droits INNER JOIN keyapis_droits ON liste_droits.id_droit = keyapis_droits.id_droit WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        $droits = $req->fetchAll();
		$req->closeCursor();
        return $droits;
    }

    // change le nom d'une keyapi
    public static function setKeyapiNom($bdd,$id_keyapi,$nom_keyapi) {
        $req = $bdd->prepare('UPDATE keyapis SET nom_keyapi = :nom_keyapi WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'nom_keyapi' => $nom_keyapi
        ));
        return true;
    }

    //change le mdp d'une keyapi
    public static function setKeyapiMdp($bdd,$id_keyapi,$mdp_keyapi) {
        $req = $bdd->prepare('UPDATE keyapis SET mdp_keyapi = :mdp_keyapi WHERE id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'mdp_keyapi' => password_hash($mdp_keyapi, PASSWORD_DEFAULT)
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
    public static function addKeyapiDroits($bdd,$id_keyapi,$id_droit) {
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
    public static function addKeyapi($bdd,$nom_keyapi,$mdp_keyapi,$id_joueur,$pseudo_proprio) {
        $req = $bdd->prepare('INSERT INTO keyapis(nom_keyapi,mdp_keyapi,id_joueur) VALUES(:nom_keyapi,:mdp_keyapi,:id_joueur)');
        $req->execute(array(
            'nom_keyapi' => $pseudo_proprio . "-" . $nom_keyapi,
            'mdp_keyapi' => password_hash($mdp_keyapi, PASSWORD_DEFAULT),
            'id_joueur' => $id_joueur
        ));
        return true;
    }
}