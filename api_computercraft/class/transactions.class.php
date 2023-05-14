<?php
// get transactions/{id_compte}
// get transactions/{id_admin}
// get transaction/{id}
// set transaction/add

class Transactions {
    // recupere les transactions du compte
    public static function getTransactionsByCompte($bdd,$compte_id) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_compte_debiteur = :compte_id OR id_compte_crediteur = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
        $transactions = $req->fetchAll();
		$req->closeCursor();
        return $transactions;
    }

    // recupere les transactions executer par un admin
    public static function getTransactionsByAdmin($bdd,$admin_id) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_admin = :admin_id');
        $req->execute(array(
            'admin_id' => $admin_id
        ));
        $transactions = $req->fetchAll();
		$req->closeCursor();
        return $transactions;
    }

    // recupere la transaction
    public static function getTransaction($bdd,$transaction_id) {
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id = :transaction_id');
        $req->execute(array(
            'transaction_id' => $transaction_id
        ));
        $transaction = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transaction;
    }
    
    // ajoute une transaction
    public static function addTransaction($bdd,$compte_id,$admin_id,$montant,$nom,$description,$id_status_transaction,$id_type_transaction,$id_commande) {
        $date = date("Y-m-d H:i:s");
        $req = $bdd->prepare('INSERT INTO transactions(id_compte,id_admin,somme,date,nom,description,id_status_transaction,id_type_transaction,id_commande) VALUES(:compte_id,:admin_id,:somme,:date,:nom,:description,:id_status_transaction,:id_type_transaction,:id_commande)');
        $req->execute(array(
            'compte_id' => $compte_id,
            'admin_id' => $admin_id,
            'somme' => $montant,
            'date' => $date,
            'nom' => $nom,
            'description' => $description,
            'id_status_transaction' => $id_status_transaction,
            'id_type_transaction' => $id_type_transaction,
            'id_commande' => $id_commande
        ));
        return $bdd->lastInsertId();
    }
}