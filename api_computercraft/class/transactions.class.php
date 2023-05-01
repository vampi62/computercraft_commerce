<?php
// get transactions/{id_compte}
// get transactions/{id_admin}
// get transaction/{id}
// set transaction/add

class Transactions {
    public static function getTransactions_compte($bdd,$compte_id) {
        // recupere les transactions du compte
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_compte_debiteur = :compte_id OR id_compte_crediteur = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
        $transactions = $req->fetchAll();
        return $transactions;
    }
    public static function getTransactions_admin($bdd,$admin_id) {
        // recupere les transactions de l'admin
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id_admin = :admin_id');
        $req->execute(array(
            'admin_id' => $admin_id
        ));
        $transactions = $req->fetchAll();
        return $transactions;
    }
    public static function getTransaction($bdd,$transaction_id) {
        // recupere la transaction
        $req = $bdd->prepare('SELECT * FROM transactions WHERE id = :transaction_id');
        $req->execute(array(
            'transaction_id' => $transaction_id
        ));
        $transaction = $req->fetch(PDO::FETCH_ASSOC);
        return $transaction;
    }
    public static function addTransaction($bdd,$compte_id,$admin_id,$montant,$nom,$description,$id_status_transaction,$id_type_transaction,$id_commande) {
        // ajoute une transaction
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
        $transaction_id = $bdd->lastInsertId();
        return $transaction_id;
    }
}