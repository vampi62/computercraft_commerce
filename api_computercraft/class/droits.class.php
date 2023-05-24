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
    public static function getDroit($bdd,$id_droit) {
        $req = $bdd->prepare('SELECT * FROM droits WHERE id_droit = :id_droit');
        $req->execute(array(
            'id_droit' => $id_droit
        ));
        $droit = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $droit;
    }
}