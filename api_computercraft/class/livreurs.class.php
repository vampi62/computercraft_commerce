<?php
// get livreurs/{id_joueur}/user
// get livreurs/{id_joueur}/keyapi
// get livreurs/{id_compte}
// get livreurs/{id_adresse}
// get livreur/{id}
// set livreur/{id}/delete
// set livreur/add
// set livreur/{id}/compte
// set livreur/{id}/adresse
// set livreur/{id}/nom_groupe

class Livreurs {
    // recupere les livreurs accessible par le joueur (lui a partient ou groupe en communs qui permet le getLivreurs)
    public static function getLivreursByUser($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT livreurs.*,joueurs.pseudo_joueur FROM livreurs 
        INNER JOIN groupes_livreurs ON livreurs.id_livreur = groupes_livreurs.id_livreur
        INNER JOIN groupes_joueurs ON groupes_livreurs.id_groupe = groupes_joueurs.id_groupe
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_livreurs.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND liste_droits.nom_droit = :nom_droit) OR (livreurs.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'nom_droit' => "getlivreurs"
        ));
        $livreurs = $req->fetchAll();
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs accessible par la keyapi (groupe en communs qui permet le getlivreurs)
    public static function getLivreursByKeyApi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT livreurs.*,joueurs.pseudo_joueur FROM livreurs
        INNER JOIN groupes_livreurs ON livreurs.id_livreur = groupes_livreurs.id_livreur
        INNER JOIN groupes_keyapis ON groupes_livreurs.id_groupe = groupes_keyapis.id_groupe
        INNER JOIN keyapis ON groupes_keyapis.id_keyapi = keyapis.id_keyapi
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_livreurs.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
        INNER JOIN keyapis_droits    ON keyapis_droits.id_keyapi = groupes_keyapis.id_groupe
        INNER JOIN liste_droits     ON liste_droits.id_droit = keyapis_droits.id_droit
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        WHERE keyapis.id_keyapi = :id_keyapi AND liste_droits.nom_droit = :nom_droit');
        $req->execute(array(
            'id_keyapi' => $id_keyapi,
            'nom_droit' => "getlivreurs"
        ));
        $livreurs = $req->fetchAll();
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs d'un joueur
    public static function getLivreursByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT * FROM livreurs
        WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $livreurs = $req->fetchAll();
        $req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs utilisant un compte precis
    public static function getLivreursByCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT * FROM livreurs
        WHERE id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $livreurs = $req->fetchAll();
		$req->closeCursor();
        return $livreurs;
    }

    // recupere les livreurs utilisant une adresse precis
    public static function getLivreursByAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('SELECT * FROM livreurs
        WHERE id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
        $livreurs = $req->fetchAll();
		$req->closeCursor();
        return $livreurs;
    }

    // recupere un livreur precis
    public static function getLivreurById($bdd,$id_livreur) {
        $req = $bdd->prepare('SELECT * FROM livreurs
        WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur
        ));
        $livreur = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $livreur;
    }

    // supprime un livreur precis
    public static function deleteLivreur($bdd,$id_livreur) {
        $req = $bdd->prepare('DELETE FROM livreurs
        WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur
        ));
    }

    // ajoute un livreur
    public static function addLivreur($bdd,$id_joueur,$id_compte,$id_adresse,$nom_livreur) {
        $req = $bdd->prepare('INSERT INTO livreurs(id_joueur,id_compte,id_adresse,nom_livreur) VALUES(:id_joueur,:id_compte,:id_adresse,:nom_livreur)');
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_compte' => $id_compte,
            'id_adresse' => $id_adresse,
            'nom_livreur' => $nom_livreur
        ));
        return $bdd->lastInsertId();
    }

    // modifie le compte d'un livreur
    public static function setLivreurCompte($bdd,$id_livreur,$id_compte) {
        $req = $bdd->prepare('UPDATE livreurs SET id_compte = :id_compte WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur,
            'id_compte' => $id_compte
        ));
    }

    // modifie l'adresse d'un livreur
    public static function setLivreurAdresse($bdd,$id_livreur,$id_adresse) {
        $req = $bdd->prepare('UPDATE livreurs SET id_adresse = :id_adresse WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur,
            'id_adresse' => $id_adresse
        ));
    }

    // modifie le nom d'un livreur
    public static function setLivreurNom($bdd,$id_livreur,$nom_livreur) {
        $req = $bdd->prepare('UPDATE livreurs SET nom_livreur = :nom_livreur WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur,
            'nom_livreur' => $nom_livreur
        ));
    }
}