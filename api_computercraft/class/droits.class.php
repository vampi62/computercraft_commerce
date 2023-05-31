<?php
// get droits
// get droit/{id}

class Droits {
    // recupere les droits
    public static function getDroits($bdd) {
        $req = $bdd->prepare('SELECT * FROM droits');
        $req->execute();
        $droits = $req->fetchAll();
		$req->closeCursor();
        return $droits;
    }

    // recupere un droit par son id
    public static function getDroitById($bdd,$id_droit) {
        $req = $bdd->prepare('SELECT * FROM droits WHERE id_droit = :id_droit');
        $req->execute(array(
            'id_droit' => $id_droit
        ));
        $droit = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droit;
    }

    // recupere les type_adresses
    public static function getTypeAdresses($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_adresses');
        $req->execute();
        $type_adresses = $req->fetchAll();
        $req->closeCursor();
        return $type_adresses;
    }

    // recupere les type de comptes
    public static function getTypeComptes($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_comptes');
        $req->execute();
        $type_comptes = $req->fetchAll();
        $req->closeCursor();
        return $type_comptes;
    }

    // recupere les type d'offres
    public static function getTypeOffres($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_offres');
        $req->execute();
        $type_offres = $req->fetchAll();
        $req->closeCursor();
        return $type_offres;
    }

    // recupere les type de roles
    public static function getTypeRoles($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_roles');
        $req->execute();
        $type_roles = $req->fetchAll();
        $req->closeCursor();
        return $type_roles;
    }

    // recupere les type de status_commandes
    public static function getTypeStatusCommandes($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_status_commandes');
        $req->execute();
        $type_status_commandes = $req->fetchAll();
        $req->closeCursor();
        return $type_status_commandes;
    }

    // recupere les type de status_litiges
    public static function getTypeStatusLitiges($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_status_litiges');
        $req->execute();
        $type_status_litiges = $req->fetchAll();
        $req->closeCursor();
        return $type_status_litiges;
    }

    // recupere les type de status_transactions
    public static function getTypeStatusTransactions($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_status_transactions');
        $req->execute();
        $type_status_transactions = $req->fetchAll();
        $req->closeCursor();
        return $type_status_transactions;
    }

    // recupere les type de transactions
    public static function getTypeTransactions($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_transactions');
        $req->execute();
        $type_transactions = $req->fetchAll();
        $req->closeCursor();
        return $type_transactions;
    }

    // recupere les chemin_status_commandes
    public static function getCheminStatusCommandes($bdd) {
        $req = $bdd->prepare('SELECT * FROM chemin_status_commandes');
        $req->execute();
        $chemin_status_commandes = $req->fetchAll();
        $req->closeCursor();
        return $chemin_status_commandes;
    }
}