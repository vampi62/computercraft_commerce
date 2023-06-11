<?php
// get keypayByKey/{key}
// get keypay/{id}
// get keypay/{id_offre}
// set keypay/add

class Keypay {
    // recupere une keypay par sa cle
    public static function getKeypayByKey($bdd,$cle_keypay) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE cle_keypay = :cle_keypay');
        $req->execute(array(
            'cle_keypay' => $cle_keypay
        ));
        $keypay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // recupere une keypay
    public static function getKeypayById($bdd,$id_keypay) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE id_keypay = :id_keypay');
        $req->execute(array(
            'id_keypay' => $id_keypay
        ));
        $keypay = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // recupere les keypays d'une offre
    public static function getKeypayByOffre($bdd,$id_offre) {
        // recupere la keypay
        $req = $bdd->prepare('SELECT * FROM keypay WHERE id_offre = :id_offre');
        $req->execute(array(
            'id_offre' => $id_offre
        ));
        $keypay = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $keypay;
    }

    // ajoute une keypay
    public static function addKeypay($bdd,$id_offre,$cle_keypay,$quantite_keypay,$prix_unitaire_keypay) {
        // ajoute une keypay
        $req = $bdd->prepare('INSERT INTO keypay(id_offre,cle_keypay,quantite_keypay,date_expire_keypay,prix_unitaire_keypay) VALUES(:id_offre,:cle_keypay,:quantite_keypay,:date_expire_keypay,:prix_unitaire_keypay)');
        $req->execute(array(
            'cle_keypay' => $cle_keypay,
            'quantite_keypay' => $quantite_keypay,
            'date_expire_keypay' => date("Y-m-d H:i:s", strtotime('+2 minutes')),
            'prix_unitaire_keypay' => $prix_unitaire_keypay,
            'id_offre' => $id_offre
        ));
        return $bdd->lastInsertId();
    }
}