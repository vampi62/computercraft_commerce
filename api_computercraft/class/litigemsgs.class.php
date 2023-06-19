<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class LitigeMsgs {
    // recupere le fil de discution litige par rapport a l'id de commande
    public static function getLitigeMsgsByCommande($bdd,$id_commande) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM litigemsgs WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande
        ));
        $litiges = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $litiges;
    }

    // ajoute un message au fil de discution litige
    public static function addLitigeMsg($bdd,$id_commande,$description_litigemsg,$id_status_litigemsg) {
        $req = $bdd->prepare('INSERT INTO litigemsgs(id_commande,date_litigemsg,description_litigemsg,id_status_litigemsg) VALUES(:id_commande,:date_litigemsg,:description_litigemsg,:id_status_litigemsg)');
        $req->execute(array(
            'id_commande' => $id_commande,
            'date_litigemsg' => date("Y-m-d H:i:s"),
            'description_litigemsg' => $description_litigemsg,
            'id_status_litigemsg' => $id_status_litigemsg
        ));
        return $bdd->lastInsertId();
    }
    
    // supprime le message du fil de discution litige
    public static function deleteLitigeMsg($bdd,$id_litigemsg) {
        $req = $bdd->prepare('DELETE FROM litigemsgs WHERE id_litigemsg = :id_litigemsg');
        $req->execute(array(
            'id_litigemsg' => $id_litigemsg
        ));
    }
}