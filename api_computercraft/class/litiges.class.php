<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class Litiges {
    // recupere le fil de discution litige par rapport a l'id de commande
    public static function getLitigesByCommande($bdd,$commande_id) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM litiges WHERE id_commande = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id
        ));
        $litiges = $req->fetchAll();
		$req->closeCursor();
        return $litiges;
    }

    // ajoute un message au fil de discution litige
    public static function addLitige($bdd,$commande_id,$description,$id_status_litige) {
        $date = date("Y-m-d H:i:s");
        $req = $bdd->prepare('INSERT INTO litiges(id_commande,date,description,id_status_litige) VALUES(:commande_id,:date,:description,:id_status_litige)');
        $req->execute(array(
            'commande_id' => $commande_id,
            'date' => $date,
            'description' => $description,
            'id_status_litige' => $id_status_litige
        ));
        return $bdd->lastInsertId();
    }
    
    // supprime le message du fil de discution litige
    public static function deleteLitige($bdd,$id_litige) {
        $req = $bdd->prepare('DELETE FROM litiges WHERE id_litige = :id_litige');
        $req->execute(array(
            'id_litige' => $id_litige
        ));
    }
}