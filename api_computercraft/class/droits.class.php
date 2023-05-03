<?php
// get droits
// get droit/{id}

class Droits {
    // recupere les droits
    public static function getDroits($bdd) {
        $req = $bdd->prepare('SELECT * FROM liste_droits');
        $req->execute();
        $droits = $req->fetchAll();
        return $droits;
    }

    // recupere un droit par son id
    public static function getDroit($bdd,$id) {
        $req = $bdd->prepare('SELECT * FROM liste_droits WHERE id_droit = :id');
        $req->execute(array(
            'id' => $id
        ));
        $droit = $req->fetch(  );
        return $droit;
    }
}