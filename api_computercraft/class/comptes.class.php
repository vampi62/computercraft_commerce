<?php
// get comptes/{id_utilisateur}/user
// get comptes/{id_utilisateur}/keyapi
// get comptes/{id_groupe}/user
// get comptes/{id_groupe}/keyapi
// get compte/{id}
// set compte/{id}/groupe/{id}/add
// set compte/{id}/groupe/{id}/delete
// set compte/{id}/solde
// set compte/{id}/delete
// set compte/add
class Comptes {
    public static function getComptes_user($bdd,$user_id) {
        // recupere les comptes des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM comptes 
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_utilisateur ON groupe_comptes.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE (groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action) OR (comptes.id_joueur = :user_id)');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }

    public static function getComptes_keyapi($bdd,$keyapi) {
        // recupere les comptes du proprio de l'keyapi (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM comptes
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_keyapi ON groupe_comptes.id_groupe = groupe_keyapi.id_groupe
        INNER JOIN keyapis ON groupe_keyapi.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        INNER JOIN keyapi_droits    ON keyapi_droits.id_keyapi = groupe_keyapi.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapi_droits.id_droit
        WHERE keyapis.nom = :nom AND liste_droits.nom = :action');
        $req->execute(array(
            'nom' => $keyapi,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }

    public static function getComptresGroupe_user($bdd,$id_groupe,$user_id) {
        // recupere les comptes des autres utilisateurs (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM comptes 
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_utilisateur ON groupe_comptes.id_groupe = groupe_utilisateur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE groupe_utilisateur.id_joueur = :user_id AND liste_droits.nom = :action AND groupe_comptes.id_groupe = :id_groupe');
        $req->execute(array(
            'user_id' => $user_id,
            'action' => "getcomptes",
            'id_groupe' => $id_groupe
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }

    public static function getComptesGroupe_keyapi($bdd,$id_groupe,$keyapi) {
        // recupere les comptes du proprio de l'keyapi (si groupe a les droits)
        $req = $bdd->prepare('SELECT * FROM comptes
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_keyapi ON groupe_comptes.id_groupe = groupe_keyapi.id_groupe
        INNER JOIN keyapis ON groupe_keyapi.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        INNER JOIN keyapi_droits    ON keyapi_droits.id_keyapi = groupe_keyapi.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapi_droits.id_droit
        WHERE keyapis.nom = :nom AND liste_droits.nom = :action AND groupe_comptes.id_groupe = :id_groupe');
        $req->execute(array(
            'nom' => $keyapi,
            'action' => "getcomptes",
            'id_groupe' => $id_groupe
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }
    
    public static function getCompte($bdd,$compte_id) {
        // recupere le compte
        $req = $bdd->prepare('SELECT * FROM comptes WHERE id = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
        $compte = $req->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }

    public static function setCompteGroupeAdd($bdd,$id,$groupe_id) {
        $req = $bdd->prepare('INSERT INTO comptes_groupe (compte_id,groupe_id) VALUES (:compte_id,:groupe_id)');
        $req->execute(array(
            'compte_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public static function setcompteGroupeDelete($bdd,$id,$groupe_id) {
        $req = $bdd->prepare('DELETE FROM comptes_groupe WHERE compte_id = :compte_id AND groupe_id = :groupe_id');
        $req->execute(array(
            'compte_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public static function setCompte_solde($bdd,$compte_id,$solde) {
        // modifie le solde du compte
        $req = $bdd->prepare('UPDATE comptes SET solde = :solde WHERE id = :compte_id');
        $req->execute(array(
            'solde' => $solde,
            'compte_id' => $compte_id
        ));
    }
    public static function setCompte_delete($bdd,$compte_id) {
        // supprime le compte
        $req = $bdd->prepare('DELETE FROM comptes WHERE id = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
    }
    public static function setCompte_add($bdd,$utilisateur_id,$groupe_id,$solde) {
        // ajoute un compte
        $req = $bdd->prepare('INSERT INTO comptes(id_utilisateur,id_groupe,solde) VALUES(:utilisateur_id,:groupe_id,:solde)');
        $req->execute(array(
            'utilisateur_id' => $utilisateur_id,
            'groupe_id' => $groupe_id,
            'solde' => $solde
        ));
    }
}