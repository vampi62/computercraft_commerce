<?php
// get transactions/{id_compte}
// get transactions/{id_admin}
// get transaction/{id}
// set transaction/add

class Transactions {
    // recupere les transactions du compte
    public static function getTransactionsByCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_compte_debiteur = :id_compte OR id_compte_crediteur = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $transactions = $req->fetchAll();
		$req->closeCursor();
        return $transactions;
    }

    // recupere les transactions executer par un admin
    public static function getTransactionsByAdmin($bdd,$id_admin) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_admin = :id_admin');
        $req->execute(array(
            'id_admin' => $id_admin
        ));
        $transactions = $req->fetchAll();
		$req->closeCursor();
        return $transactions;
    }

    // recupere la transaction
    public static function getTransaction($bdd,$id_transaction) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_transaction = :id_transaction');
        $req->execute(array(
            'id_transaction' => $id_transaction
        ));
        $transaction = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transaction;
    }
    
    // ajoute une transaction
    public static function addTransaction($bdd,$id_compte_debiteur,$id_compte_crediteur,$id_admin,$somme_compte,$nom,$description,$id_status_transaction,$id_type_transaction,$id_commande) {
        $req = $bdd->prepare('INSERT INTO transactions(id_compte_debiteur,id_compte_crediteur,id_admin,somme_compte,date_compte,nom_compte,description_compte,id_status_transaction,id_type_transaction,id_commande) VALUES(:id_compte_debiteur,:id_compte_crediteur,:id_admin,:somme,:date_compte,:nom_compte,:description_compte,:id_status_transaction,:id_type_transaction,:id_commande)');
        $req->execute(array(
            'id_compte_debiteur' => $id_compte_debiteur,
            'id_compte_crediteur' => $id_compte_crediteur,
            'id_admin' => $id_admin,
            'somme_compte' => $somme_compte,
            'date_compte' => date("Y-m-d H:i:s"),
            'nom_compte' => $nom_compte,
            'description_compte' => $description_compte,
            'id_status_transaction' => $id_status_transaction,
            'id_type_transaction' => $id_type_transaction,
            'id_commande' => $id_commande
        ));
        return $bdd->lastInsertId();
    }
}