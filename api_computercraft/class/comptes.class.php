<?php
// get comptes/{id_joueur}/user
// get comptes/{id_joueur}/keyapi
// get compte/{id}
// set compte/{id}/solde
// set compte/{id}/delete
// set compte/add
class Comptes {
    // recupere les comptes accessible par le joueur (lui a partient ou groupe en communs qui permet le getcomptes)
    public static function getComptes_user($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM comptes 
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_joueur ON groupe_comptes.id_groupe = groupe_joueur.id_groupe
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        WHERE (groupe_joueur.id_joueur = :id_joueur AND liste_droits.nom = :action) OR (comptes.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }

    // recupere les comptes accessible par la keyapi (groupe en communs qui permet le getcomptes)
    public static function getComptes_keyapi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM comptes
        INNER JOIN groupe_comptes ON comptes.id_compte = groupe_comptes.id_compte
        INNER JOIN groupe_keyapi ON groupe_comptes.id_groupe = groupe_keyapi.id_groupe
        INNER JOIN keyapis ON groupe_keyapi.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
        INNER JOIN keyapi_droits    ON keyapi_droits.id_keyapi = groupe_keyapi.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapi_droits.id_droit
        WHERE keyapis.id_keyapi = :id_keyapi AND liste_droits.nom = :action');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
        return $comptes;
    }
    
    // recupere le compte
    public static function getCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT * FROM comptes WHERE id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $compte = $req->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }

    // modifie le solde du compte
    public static function setCompte_solde($bdd,$id_compte,$solde) {
        $req = $bdd->prepare('UPDATE comptes SET solde = :solde WHERE id_compte = :id_compte');
        $req->execute(array(
            'solde' => $solde,
            'id_compte' => $id_compte
        ));
    }

    // supprime le compte
    public static function setCompte_delete($bdd,$id_compte) {
        $req = $bdd->prepare('DELETE FROM comptes WHERE id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
    }

    // ajoute un compte
    public static function setCompte_add($bdd,$id_joueur,$id_type_compte,$nom,$solde) {
        $req = $bdd->prepare('INSERT INTO comptes(id_joueur,id_groupe,id_type_compte,nom,solde) VALUES(:id_joueur,:groupe_id,:id_type_compte,:nom,:solde)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_type_compte' => $id_type_compte,
            'nom' => $nom,
            'solde' => $solde
        ));
    }
}