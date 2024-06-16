<?php
// get litiges/{id_commande}
// set litige/add
// set litige/{id}/delete

class LitigeMsgs {
    // recupere le fil de discution litige par rapport a l'id de commande
    public static function getLitigeMsgsByCommande($bdd,$idCommande,$limit = 100,$offset = 0) {
        // recupere les litiges de la commande
        $req = $bdd->prepare('SELECT * FROM msg_litiges WHERE id_commande = :id_commande
        ORDER BY id_msg_litige ASC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
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
    public static function addLitigeMsg($bdd,$idCommande,$texteMsgLitige,$idTypeMsgLitige,$idJoueur) {
        $req = $bdd->prepare('INSERT INTO msg_litiges(id_commande,date_msg_litige,texte_msg_litige,id_type_msg_litige,id_joueur) VALUES(:id_commande,:date_msg_litige,:texte_msg_litige,:id_type_msg_litige,:id_joueur)');
        $req->execute(array(
            'id_commande' => $idCommande,
            'date_msg_litige' => date("Y-m-d H:i:s"),
            'texte_msg_litige' => $texteMsgLitige,
            'id_type_msg_litige' => $idTypeMsgLitige,
            'id_joueur' => $idJoueur
        ));
        return $bdd->lastInsertId();
    }
}