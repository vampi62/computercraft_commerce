<?php
// get droits
// get droit/{id}

class Droits {
    // recupere les droits
    public static function getDroits($bdd) {
        $req = $bdd->prepare('SELECT * FROM droits');
        $req->execute();
        $droits = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droits;
    }

    // recupere un droit par son id
    public static function getDroitById($bdd,$idDroit) {
        $req = $bdd->prepare('SELECT * FROM droits WHERE id_droit = :id_droit');
        $req->execute(array(
            'id_droit' => $idDroit
        ));
        $droit = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droit;
    }

    // recupere les type_adresses
    public static function getTypeAdresses($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_adresses');
        $req->execute();
        $type_adresses = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_adresses;
    }

    // recupere les type de comptes
    public static function getTypeComptes($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_comptes');
        $req->execute();
        $type_comptes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_comptes;
    }

    // recupere les type d'offres
    public static function getTypeOffres($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_offres');
        $req->execute();
        $type_offres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_offres;
    }

    // recupere les type de roles
    public static function getTypeRoles($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_joueurs');
        $req->execute();
        $type_roles = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_roles;
    }

    // recupere les type de status_commandes
    public static function getTypeStatusCommandes($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_commandes');
        $req->execute();
        $type_commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_commandes;
    }

    // recupere les type de status_litiges
    public static function getTypeStatusLitiges($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_msg_litiges');
        $req->execute();
        $type_status_litiges = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_status_litiges;
    }

    // recupere les type de transactions
    public static function getTypeTransactions($bdd) {
        $req = $bdd->prepare('SELECT * FROM type_transactions');
        $req->execute();
        $type_transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $type_transactions;
    }

    // recupere les chemin_type_commandes
    public static function getCheminStatusCommandes($bdd) {
        $req = $bdd->prepare('SELECT * FROM chemins_type_commandes');
        $req->execute();
        $chemins_type_commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $chemins_type_commandes;
    }

    // recupere les droits d'un joueur sur un element
    public static function getDroitsJoueurOnObject($bdd, $idNom, $idObjet, $type ,$isApi=false) {
        if ($isApi) {
            if ($type == 'groupe') {
                $req = $bdd->prepare('SELECT groupes.*, drgroupe.id_droit AS id_droit_groupe, drapi.id_droit AS id_droit_apikey FROM groupes
                INNER JOIN groupes_apikeys    ON groupes.id_groupe = groupes_apikeys.id_groupe
                INNER JOIN apikeys           ON apikeys.id_apikey = groupes_apikeys.id_apikey
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes.id_groupe
                INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = apikeys.id_apikey
                INNER JOIN droits AS drgroupe  ON droits.id_droit = groupes_droits.id_droit
                INNER JOIN droits AS drapi     ON droits.id_droit = apikeys_droits.id_droit
                WHERE groupes.id_groupe = :idobjet AND apikeys.id_apikey = :idnom');
            } else {
                $req = $bdd->prepare('SELECT '.$type.'s.id_'.$type.', groupes.*, drgroupe.id_droit AS id_droit_groupe, drapi.id_droit AS id_droit_apikey FROM '.$type.'s
                INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
                INNER JOIN groupes_apikeys    ON groupes_'.$type.'s.id_groupe = groupes_apikeys.id_groupe
                INNER JOIN groupes           ON groupes.id_groupe = groupes_apikeys.id_groupe
                INNER JOIN apikeys           ON apikeys.id_apikey = groupes_apikeys.id_apikey
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
                INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = apikeys.id_apikey
                INNER JOIN droits AS drgroupe  ON droits.id_droit = groupes_droits.id_droit
                INNER JOIN droits AS drapi     ON droits.id_droit = apikeys_droits.id_droit
                WHERE '.$type.'s.id_'.$type.' = :idobjet AND apikeys.id_apikey = :idnom');
            }
        } else {
            if ($type == 'groupe') {
                $req = $bdd->prepare('SELECT groupes.*, drgroupe.id_droit AS id_droit_groupe FROM groupes
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes.id_groupe
                INNER JOIN droits AS drgroupe  ON droits.id_droit = groupes_droits.id_droit
                WHERE groupes.id_groupe = :idobjet AND groupes_droits.id_droit = :idnom');
            } else {
                $req = $bdd->prepare('SELECT '.$type.'s.id_'.$type.', groupes.*, drgroupe.id_droit AS id_droit_groupe FROM '.$type.'s
                INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
                INNER JOIN groupes           ON groupes.id_groupe = groupes_'.$type.'s.id_groupe
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
                INNER JOIN droits AS drgroupe  ON droits.id_droit = groupes_droits.id_droit
                WHERE '.$type.'s.id_'.$type.' = :idobjet AND groupes_droits.id_droit = :idnom');
            }
        }
        $req->execute(array(
            'idobjet' => $idObjet,
            'idnom' => $idNom
        ));
        $liste = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $liste;
    }
}