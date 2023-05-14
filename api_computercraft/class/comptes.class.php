<?php
// get comptes/{id_joueur}/user
// get comptes/{id_joueur}/keyapi
// get compte/{id}
// set compte/{id}/solde
// set compte/{id}/delete
// set compte/add
class Comptes {
    // recupere les comptes accessible par le joueur (lui a partient ou groupe en communs qui permet le getcomptes)
    public static function getComptesWithUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM comptes 
        INNER JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        INNER JOIN groupes_joueurs ON groupes_comptes.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND liste_droits.nom = :action) OR (comptes.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
		$req->closeCursor();
        return $comptes;
    }

    // recupere les comptes accessible par la keyapi (groupe en communs qui permet le getcomptes)
    public static function getComptesWithKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT * FROM comptes
        INNER JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        INNER JOIN groupes_keyapis ON groupes_comptes.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN keyapis ON groupes_keyapis.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        INNER JOIN keyapis_droits    ON keyapis_droits.id_keyapi = groupes_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapis_droits.id_droit
        WHERE keyapis.id_keyapi = :id_keyapi AND liste_droits.nom = :action');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'action' => "getcomptes"
        ));
        $comptes = $req->fetchAll();
		$req->closeCursor();
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
    public static function setCompteSolde($bdd,$id_compte,$solde) {
        $req = $bdd->prepare('UPDATE comptes SET solde = :solde WHERE id_compte = :id_compte');
        $req->execute(array(
            'solde' => $solde,
            'id_compte' => $id_compte
        ));
    }

    // supprime le compte
    public static function deleteCompte($bdd,$id_compte) {
        $req = $bdd->prepare('DELETE FROM comptes WHERE id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
    }

    // ajoute un compte
    public static function setCompte($bdd,$id_joueur,$id_type_compte,$nom,$solde) {
        $req = $bdd->prepare('INSERT INTO comptes(id_joueur,id_type_compte,nom,solde) VALUES(:id_joueur,:id_type_compte,:nom,:solde)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_type_compte' => $id_type_compte,
            'nom' => $nom,
            'solde' => $solde
        ));
    }
}