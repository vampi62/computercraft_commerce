<?php
// get keypayByKey/{key}
// get keypay/{id}
// get keypay/{id_offre}
// set keypay/add

class Keypay {
    // recupere une keypay par sa cle
    public static function getKeypayByKey($bdd,$cle) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE cle = :cle');
        $req->execute(array(
            'cle' => $cle
        ));
        $keypay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // recupere une keypay
    public static function getKeypay($bdd,$keypay_id) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE id = :keypay_id');
        $req->execute(array(
            'keypay_id' => $keypay_id
        ));
        $keypay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // recupere les keypays d'une offre
    public static function getKeypayByOffre($bdd,$offre_id) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE id_offre = :offre_id');
        $req->execute(array(
            'offre_id' => $offre_id
        ));
        $keypay = $req->fetchAll();
		$req->closeCursor();
        return $keypay;
    }

    // ajoute une keypay
    public static function addKeypay($bdd,$offre_id,$cle,$quantite,$date_expire,$prix_unitaire,$id_offre) {
        // ajoute une keypay
        $req = $bdd->prepare('INSERT INTO keypay(id_offre,cle,quantite,date_expire,prix_unitaire,id_offre) VALUES(:offre_id,:cle,:quantite,:date_expire,:prix_unitaire,:id_offre)');
        $req->execute(array(
            'offre_id' => $offre_id,
            'cle' => $cle,
            'quantite' => $quantite,
            'date_expire' => $date_expire,
            'prix_unitaire' => $prix_unitaire,
            'id_offre' => $id_offre
        ));
        return $bdd->lastInsertId();
    }
}