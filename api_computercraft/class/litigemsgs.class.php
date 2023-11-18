<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class LitigeMsgs {
    // recupere le fil de discution litige par rapport a l'id de commande
    public static function getLitigeMsgsByCommande($bdd,$idCommande) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM msg_litiges WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $idCommande
        ));
        $litiges = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $litiges;
    }
    
    // supprime le message du fil de discution litige
    public static function deleteLitigeMsg($bdd,$idMsgLitige) {
        $req = $bdd->prepare('DELETE FROM msg_litiges WHERE id_msg_litige = :id_msg_litige');
        $req->execute(array(
            'id_msg_litige' => $idMsgLitige
        ));
    }

    // ajoute un message au fil de discution litige
    public static function addLitigeMsg($bdd,$idCommande,$descriptionMsgLitige,$idStatusMsgLitige) {
        $req = $bdd->prepare('INSERT INTO msg_litiges(id_commande,date_msg_litige,description_msg_litige,id_status_msg_litige) VALUES(:id_commande,:date_msg_litige,:description_msg_litige,:id_status_msg_litige)');
        $req->execute(array(
            'id_commande' => $idCommande,
            'date_msg_litige' => date("Y-m-d H:i:s"),
            'description_msg_litige' => $descriptionMsgLitige,
            'id_status_msg_litige' => $idStatusMsgLitige
        ));
        return $bdd->lastInsertId();
    }
}