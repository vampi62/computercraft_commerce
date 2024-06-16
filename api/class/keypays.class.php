<?php
// get keypayByKey/{key}
// get keypay/{id}
// get keypay/{id_offre}
// set keypay/add

class Keypays {
    // recupere une keypay par sa cle
    public static function getKeypayByKey($bdd,$cleKeyPay) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypays WHERE cle_keypay = :cle_keypay');
        $req->execute(array(
            'cle_keypay' => $cleKeyPay
        ));
        $keyPay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keyPay;
    }

    // recupere une keypay
    public static function getKeypayById($bdd,$idKeyPay) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypays WHERE id_keypay = :id_keypay');
        $req->execute(array(
            'id_keypay' => $idKeyPay
        ));
        $keyPay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keyPay;
    }

    // recupere les keypays d'une offre
    public static function getKeypaysByOffre($bdd,$idOffre,$limit = 100,$offset = 0) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypays WHERE id_offre = :id_offre
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_offre' => $idOffre
        ));
        $keypay = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // ajoute une keypay
    public static function addKeypay($bdd,$idOffre,$cleKeyPay,$quantiteKeyPay,$prixUnitaireKeyPay) {
        // ajoute une keypay
        $req = $bdd->prepare('INSERT INTO keypays(id_offre,cle_keypay,quantite_keypay,date_expire_keypay,prix_unitaire_keypay) VALUES(:id_offre,:cle_keypay,:quantite_keypay,:date_expire_keypay,:prix_unitaire_keypay)');
        $req->execute(array(
            'cle_keypay' => $cleKeyPay,
            'quantite_keypay' => $quantiteKeyPay,
            'date_expire_keypay' => date("Y-m-d H:i:s", strtotime('+2 minutes')),
            'prix_unitaire_keypay' => $prixUnitaireKeyPay,
            'id_offre' => $idOffre
        ));
        return $bdd->lastInsertId();
    }
}