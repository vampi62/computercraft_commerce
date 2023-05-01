<?php
// get keyapi/{id_utilisateur}/user
// get keyapi/{id_groupe}/user
// get keyapi/{id}
// set keyapi/{id}/nom
// set keyapi/{id}/mdp
// set keyapi/{id}/delete
// set keyapi/{id}/droits/{id}/add
// set keyapi/{id}/droits/{id}/delete
// set keyapi/add

class Keyapis {
    public static function getKeyapis_user($bdd,$user_id) {
        // recupere les keyapis des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM keyapis 
        INNER JOIN groupe_keyapis ON keyapis.id_keyapi = groupe_keyapis.id_keyapi
        INNER JOIN groupe_utilisateur ON groupe_keyapis.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE (groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action) OR (keyapis.id_joueur = :user_id)');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getkeyapis"
        ));
        $keyapis = $req->fetchAll();
        return $keyapis;
    }

    public static function getkeyapisGroupe_user($bdd,$id_groupe,$user_id) {
        // recupere les keyapis des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM keyapis 
        INNER JOIN groupe_keyapis ON keyapis.id_keyapi = groupe_keyapis.id_keyapi
        INNER JOIN groupe_utilisateur ON groupe_keyapis.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action AND groupe_keyapis.id_groupe = :id_groupe');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getkeyapis",
            'id_groupe' => $id_groupe
        ));
        $keyapis = $req->fetchAll();
        return $keyapis;
    }

    public static function getKeyapis($bdd,$id) {
        $req = $bdd->prepare('SELECT * FROM keyapis WHERE id_keyapi = :id');
        $req->execute(array(
            'id' => $id
        ));
        $keyapi = $req->fetch(PDO::FETCH_ASSOC);
        return $keyapi;
    }

    public static function setKeyapis_nom($bdd,$id,$nom) {
        $req = $bdd->prepare('UPDATE keyapis SET nom = :nom WHERE id_keyapi = :id');
        $req->execute(array(
            'id' => $id,
            'nom' => $nom
        ));
        return true;
    }

    public static function setKeyapis_mdp($bdd,$id,$mdp) {
        $req = $bdd->prepare('UPDATE keyapis SET mdp = :mdp WHERE id_keyapi = :id');
        $req->execute(array(
            'id' => $id,
            'mdp' => $mdp
        ));
        return true;
    }

    public static function setKeyapis_delete($bdd,$id) {
        $req = $bdd->prepare('DELETE FROM keyapis WHERE id_keyapi = :id');
        $req->execute(array(
            'id' => $id
        ));
        return true;
    }

    public static function setKeyapis_droits_add($bdd,$id,$id_droit) {
        $req = $bdd->prepare('INSERT INTO keyapis_droits(id_keyapi,id_droit) VALUES(:id,:id_droit)');
        $req->execute(array(
            'id' => $id,
            'id_droit' => $id_droit
        ));
        return true;
    }

    public static function setKeyapis_droits_delete($bdd,$id,$id_droit) {
        $req = $bdd->prepare('DELETE FROM keyapis_droits WHERE id_keyapi = :id AND id_droit = :id_droit');
        $req->execute(array(
            'id' => $id,
            'id_droit' => $id_droit
        ));
        return true;
    }

    public static function setKeyapis_add($bdd,$nom,$mdp,$id_joueur) {
        $req = $bdd->prepare('INSERT INTO keyapis(nom,mdp,id_joueur) VALUES(:nom,:mdp,:id_joueur)');
        $req->execute(array(
            'nom' => $nom,
            'mdp' => $mdp,
            'id_joueur' => $id_joueur
        ));
        return true;
    }
}