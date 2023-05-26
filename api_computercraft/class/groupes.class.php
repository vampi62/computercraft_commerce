<?php
// get groupes/{id_joueur}
// get groupes/{id_compte}
// get groupes/{id_offre}
// get groupes/{id_adresse}
// get groupes/{id_livreur}
// get groupes/{id_keyapi}
// get groupes/{id_groupe}/joueurs
// get groupes/{id_groupe}/comptes
// get groupes/{id_groupe}/offres
// get groupes/{id_groupe}/adresses
// get groupes/{id_groupe}/livreurs
// get groupes/{id_groupe}/keyapis
// get groupe/{id}
// get groupe/droits/{id}
// set groupe/{id}/offre/{id}/add
// set groupe/{id}/offre/{id}/delete
// set groupe/{id}/adresse/{id}/add
// set groupe/{id}/adresse/{id}/delete
// set groupe/{id}/compte/{id}/add
// set groupe/{id}/compte/{id}/delete
// set groupe/{id}/keyapi/{id}/add
// set groupe/{id}/keyapi/{id}/delete
// set groupe/{id}/joueur/{id}/add
// set groupe/{id}/joueur/{id}/delete
// set groupe/{id}/livreur/{id}/add
// set groupe/{id}/livreur/{id}/delete
// set groupe/{id}/nom
// set groupe/{id}/delete
// set groupe/{id}/droits/{id}/add
// set groupe/{id}/droits/{id}/delete
// set groupe/add

class Groupes {
    // recupere les groupes d'un joueur
    public static function getGroupesByJoueur($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur
        WHERE groupes.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $groupes = $req->fetchAll();
        $req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un joueur membre
    public static function getGroupesByJoueurMembre($bdd,$id_joueur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_joueurs ON groupes_joueurs.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_joueurs.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $id_joueur
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un compte
    public static function getGroupesByCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_comptes ON groupes_comptes.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_comptes.id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une offre
    public static function getGroupesByOffre($bdd,$id_offre) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_offres ON groupes_offres.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_offres.id_offre = :id_offre');
        $req->execute(array(
            'id_offre' => $id_offre
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une adresse
    public static function getGroupesByAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_adresses ON groupes_adresses.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_adresses.id_adresse = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'un livreur
    public static function getGroupesByLivreur($bdd,$id_livreur) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_livreurs ON groupes_livreurs.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_livreurs.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les groupes d'une keyapi
    public static function getGroupesByKeyapi($bdd,$id_keyapi) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN groupes_keyapis ON groupes_keyapis.id_groupe = groupes.id_groupe 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_keyapis.id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_keyapi' => $id_keyapi
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les joueurs d'un groupe
    public static function getJoueursByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_joueurs.*,joueurs.pseudo_joueur FROM groupes_joueurs 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE groupes_joueurs.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les comptes d'un groupe
    public static function getComptesByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_comptes.*,comptes.nom_compte,joueurs.pseudo_joueur FROM groupes_comptes 
        INNER JOIN comptes ON groupes_comptes.id_compte = comptes.id_compte 
        INNER JOIN joueurs ON comptes.id_joueur = joueurs.id_joueur 
        WHERE groupes_comptes.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les offres d'un groupe
    public static function getOffresByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_offres.*,offres.nom_offre,joueurs.pseudo_joueur FROM groupes_offres 
        INNER JOIN offres ON groupes_offres.id_offre = offres.id_offre 
        INNER JOIN joueurs ON offres.id_joueur = joueurs.id_joueur 
        WHERE groupes_offres.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les adresses d'un groupe
    public static function getAdressesByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_adresses.*,adresses.nom_adresse,joueurs.pseudo_joueur FROM groupes_adresses 
        INNER JOIN adresses ON groupes_adresses.id_adresse = adresses.id_adresse 
        INNER JOIN joueurs ON adresses.id_joueur = joueurs.id_joueur
        WHERE groupes_adresses.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les comptes d'un groupe
    public static function getLivreursByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_livreurs.*,livreurs.nom_livreur,joueurs.pseudo_joueur FROM groupes_livreurs 
        INNER JOIN livreurs ON groupes_livreurs.id_livreur = livreurs.id_livreur 
        INNER JOIN joueurs ON livreurs.id_joueur = joueurs.id_joueur
        WHERE groupes_livreurs.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les keyapis d'un groupe
    public static function getKeyapisByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes_keyapi.*,keyapis.nom_keyapi,joueurs.pseudo_joueur FROM groupes_keyapis 
        INNER JOIN keyapis ON groupes.id_keyapi = keyapis.id_keyapi 
        WHERE groupes_keyapi.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_keyapi
        ));
        $groupes = $req->fetchAll();
		$req->closeCursor();
        return $groupes;
    }

    // recupere les droits d'un groupe
    public static function getDroitsByGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT * FROM liste_droits 
        INNER JOIN groupes_droits ON liste_droits.id_droit = groupes_droits.id_droit 
        WHERE groupes_droits.id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $droits = $req->fetchAll();
		$req->closeCursor();
        return $droits;
    }

    // recupere les infos d'un groupe
    public static function getGroupeById($bdd,$id_groupe) {
        $req = $bdd->prepare('SELECT groupes.*,joueurs.pseudo_joueur FROM groupes 
        INNER JOIN joueurs ON groupes.id_joueur = joueurs.id_joueur 
        WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
        $groupe = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $groupe;
    }

    // ajoute une offre au groupe
    public static function addGroupeOffre($bdd,$id_groupe,$id_offre) {
        $req = $bdd->prepare('INSERT INTO groupes_offres(id_groupe,id_offre) VALUES(:id_groupe,:id_offre)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_offre' => $id_offre
        ));
    }

    // retire une offre du groupe
    public static function deleteGroupeOffre($bdd,$id_groupe,$id_offre) {
        $req = $bdd->prepare('DELETE FROM groupes_offres WHERE id_groupe = :id_groupe AND id_offre = :id_offre');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_offre' => $id_offre
        ));
    }

    // ajoute une adresse au groupe
    public static function addGroupeAdresse($bdd,$id_groupe,$id_adresse) {
        $req = $bdd->prepare('INSERT INTO groupes_adresses(id_groupe,id_adresse) VALUES(:id_groupe,:id_adresse)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_adresse' => $id_adresse
        ));
    }

    // retire une adresse du groupe
    public static function deleteGroupeAdresse($bdd,$id_groupe,$id_adresse) {
        $req = $bdd->prepare('DELETE FROM groupes_adresses WHERE id_groupe = :id_groupe AND id_adresse = :id_adresse');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_adresse' => $id_adresse
        ));
    }

    // ajoute un compte au groupe
    public static function addGroupeCompte($bdd,$id_groupe,$id_compte) {
        $req = $bdd->prepare('INSERT INTO groupes_comptes(id_groupe,id_compte) VALUES(:id,:id_compte)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_compte' => $id_compte
        ));
    }

    // retire un compte du groupe
    public static function deleteGroupeCompte($bdd,$id_groupe,$id_compte) {
        $req = $bdd->prepare('DELETE FROM groupes_comptes WHERE id_groupe = :id_groupe AND id_compte = :id_compte');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_compte' => $id_compte
        ));
    }

    // ajoute une keyapi au groupe
    public static function addGroupeKeyApi($bdd,$id_groupe,$id_keyapi) {
        $req = $bdd->prepare('INSERT INTO groupes_keyapis(id_groupe,id_keyapi) VALUES(:id,:id_keyapi)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_keyapi' => $id_keyapi
        ));
    }

    // retire une keyapi du groupe
    public static function deleteGroupeKeyApi($bdd,$id_groupe,$id_keyapi) {
        $req = $bdd->prepare('DELETE FROM groupes_keyapis WHERE id_groupe = :id_groupe AND id_keyapi = :id_keyapi');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_keyapi' => $id_keyapi
        ));
    }

    // ajoute un joueur au groupe
    public static function addGroupeJoueur($bdd,$id_groupe,$id_joueur) {
        $req = $bdd->prepare('INSERT INTO groupes_joueurs(id_groupe,id_joueur) VALUES(:id,:id_joueur)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_joueur' => $id_joueur
        ));
    }

    // retire un joueur du groupe
    public static function deleteGroupeJoueur($bdd,$id_groupe,$id_joueur) {
        $req = $bdd->prepare('DELETE FROM groupes_joueurs WHERE id_groupe = :id_groupe AND id_joueur = :id_joueur');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_joueur' => $id_joueur
        ));
    }

    // ajoute un livreur au groupe
    public static function addGroupeLivreur($bdd,$id_groupe,$id_livreur) {
        $req = $bdd->prepare('INSERT INTO groupes_livreurs(id_groupe,id_livreur) VALUES(:id_groupe,:id_livreur)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_livreur' => $id_livreur
        ));
    }

    // retire un livreur au groupe
    public static function deleteGroupeLivreur($bdd,$id_groupe,$id_livreur) {
        $req = $bdd->prepare('DELETE FROM groupes_livreurs WHERE id_groupe = :id_groupe AND id_livreur = :id_livreur');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_livreur' => $id_livreur
        ));
    }

    // modifie le nom d'un groupe
    public static function setGroupeNom($bdd,$id_groupe,$nom) {
        $req = $bdd->prepare('UPDATE groupes SET nom = :nom WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'nom' => $nom
        ));
    }

    // supprime un groupe
    public static function deleteGroupe($bdd,$id_groupe) {
        $req = $bdd->prepare('DELETE FROM groupes WHERE id_groupe = :id_groupe');
        $req->execute(array(
            'id_groupe' => $id_groupe
        ));
    }

    // ajoute un droit a un groupe
    public static function addGroupeDroits($bdd,$id_groupe,$id_droits) {
        $req = $bdd->prepare('INSERT INTO groupes_droits(id_groupe,id_droits) VALUES(:id_groupe,:id_droits)');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_droits' => $id_droits
        ));
    }

    // supprime un droit d'un groupe
    public static function deleteGroupeDroits($bdd,$id_groupe,$id_droits) {
        $req = $bdd->prepare('DELETE FROM groupes_droits WHERE id_groupe = :id_groupe AND id_droits = :id_droits');
        $req->execute(array(
            'id_groupe' => $id_groupe,
            'id_droits' => $id_droits
        ));
    }

    // ajoute un groupe
    public static function addGroupe($bdd,$nom,$id_joueur) {
        $req = $bdd->prepare('INSERT INTO groupes(nom,id_joueur) VALUES(:nom,:id_joueur)');
        $req->execute(array(
            'nom' => $nom,
            'id_joueur' => $id_joueur
        ));
    }
}