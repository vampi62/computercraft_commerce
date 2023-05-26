<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class LitigesMsg {
    // recupere le fil de discution litige par rapport a l'id de commande
    public static function getLitigesMsgByCommande($bdd,$id_commande) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM litigesmsg WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande
        ));
        $litiges = $req->fetchAll();
		$req->closeCursor();
        return $litiges;
    }

    // ajoute un message au fil de discution litige
    public static function addLitigeMsg($bdd,$id_commande,$description_litige,$id_status_litige) {
        $req = $bdd->prepare('INSERT INTO litigesmsg(id_commande,date_litige,description_litige,id_status_litige) VALUES(:id_commande,:date_litige,:description_litige,:id_status_litige)');
        $req->execute(array(
            'id_commande' => $id_commande,
            'date_litige' => date("Y-m-d H:i:s"),
            'description_litige' => $description_litige,
            'id_status_litige' => $id_status_litige
        ));
        return $bdd->lastInsertId();
    }
    
    // supprime le message du fil de discution litige
    public static function deleteLitigeMsg($bdd,$id_litige) {
        $req = $bdd->prepare('DELETE FROM litigesmsg WHERE id_litige = :id_litige');
        $req->execute(array(
            'id_litige' => $id_litige
        ));
    }
}