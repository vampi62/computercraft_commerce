<?php
// get comptes/{id_joueur}/user
// get comptes/{id_joueur}/keyapi
// get compte/{id}
// set compte/{id}/solde_compte
// set compte/{id}/delete
// set compte/add
class Comptes {
    // recupere les comptes accessible par le joueur (lui a partient ou groupe en communs qui permet le getcomptes)
    public static function getComptesWithUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes
        LEFT JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        LEFT JOIN groupes_joueurs ON groupes_comptes.id_groupe = groupes_joueurs.id_groupe
        LEFT JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        LEFT JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom_droit = :nom_droit) OR (comptes.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'nom_droit' => "getcomptes"
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $comptes;
    }

    // recupere les comptes accessible par la keyapi (groupe en communs qui permet le getcomptes)
    public static function getComptesWithKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes
        INNER JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        INNER JOIN groupes_keyapis ON groupes_comptes.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN keyapis ON groupes_keyapis.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN keyapis_droits    ON keyapis_droits.id_keyapi = groupes_keyapis.id_groupe
        INNER JOIN droits     ON droits.id_droit = keyapis_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur
        WHERE keyapis.id_keyapi = :id_keyapi AND droits.nom_droit = :nom_droit');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'nom_droit' => "getcomptes"
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $comptes;
    }

    // recupere les comptes d'un joueur
    public static function getComptesByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur WHERE comptes.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $comptes;
    }

    // recupere le compte
    public static function getCompteById($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur WHERE comptes.id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $compte = $req->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }

    // le solde_compte ne peut être modifier qu'avec une transaction pour garder une trace des mouvements
    // modifie le solde_compte du compte
    public static function setCompteSolde($bdd,$id_compte,$solde_compte) {
        $req = $bdd->prepare('UPDATE comptes SET solde_compte = :solde_compte WHERE id_compte = :id_compte');
        $req->execute(array(
            'solde_compte' => $solde_compte,
            'id_compte' => $id_compte
        ));
    }

    // modifie le nom du compte
    public static function setCompteNom($bdd,$id_compte,$nom_compte) {
        $req = $bdd->prepare('UPDATE comptes SET nom_compte = :nom_compte WHERE id_compte = :id_compte');
        $req->execute(array(
            'nom_compte' => $nom_compte,
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
    public static function addCompte($bdd,$id_joueur,$id_type_compte,$nom_compte) {
        $req = $bdd->prepare('INSERT INTO comptes(id_joueur,id_type_compte,nom_compte,solde_compte) VALUES(:id_joueur,:id_type_compte,:nom_compte, 0)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_type_compte' => $id_type_compte,
            'nom_compte' => $nom_compte
        ));
        return $bdd->lastInsertId();
    }
}