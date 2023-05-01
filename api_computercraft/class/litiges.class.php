<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class Litiges {
    public static function getLitiges_commande($bdd,$commande_id) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM litiges WHERE id_commande = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id
        ));
        $litiges = $req->fetchAll();
        return $litiges;
    }
    public static function addLitige($bdd,$commande_id,$description,$id_status_litige) {
        // ajoute un litige
        $date = date("Y-m-d H:i:s");
        $req = $bdd->prepare('INSERT INTO litiges(id_commande,date,description,id_status_litige) VALUES(:commande_id,:date,:description,:id_status_litige)');
        $req->execute(array(
            'commande_id' => $commande_id,
            'date' => $date,
            'description' => $description,
            'id_status_litige' => $id_status_litige
        ));
        $litige_id = $bdd->lastInsertId();
        return $litige_id;
    }
    public static function deleteLitige($bdd,$litige_id) {
        // supprime le litige
        $req = $bdd->prepare('DELETE FROM litiges WHERE id = :litige_id');
        $req->execute(array(
            'litige_id' => $litige_id
        ));
    }
}