<?php
// get transactions/{id_compte}
// get transactions/{id_admin}
// get transaction/{id}
// set transaction/add

class Transactions {
    // recupere les transaction en attente
    public static function getTransactionsEnAttente($bdd) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_admin = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_type_status_transaction = 1');
        $req->execute();
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $transactions;
    }

    // recupere les transactions du compte
    public static function getTransactionsByCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_admin = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_compte_debiteur = :id_compte OR transactions.id_compte_crediteur = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transactions;
    }

    // recupere les transactions executer par un admin
    public static function getTransactionsByAdmin($bdd,$id_admin) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        INNER JOIN joueurs ON transactions.id_admin = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_admin = :id_admin');
        $req->execute(array(
            'id_admin' => $id_admin
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transactions;
    }

    // recupere la transaction
    public static function getTransactionById($bdd,$id_transaction) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_admin = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_transaction = :id_transaction');
        $req->execute(array(
            'id_transaction' => $id_transaction
        ));
        $transaction = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transaction;
    }

    public static function getTransactionsByCommande($bdd,$id_commande) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_admin = joueurs.id_joueur
        INNER JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $transactions;
    }
    
    // ajoute une transaction
    public static function addTransaction($bdd,$id_compte_debiteur,$id_compte_crediteur,$id_admin,$somme_transaction,$nom_transaction,$description_transaction,$id_type_transaction,$id_commande) {
        $req = $bdd->prepare('INSERT INTO transactions(id_compte_debiteur,id_compte_crediteur,id_admin,somme_transaction,date_transaction,nom_transaction,description_transaction,id_type_status_transaction,id_type_transaction,id_commande) VALUES(:id_compte_debiteur,:id_compte_crediteur,:id_admin,:somme_transaction,:date_transaction,:nom_transaction,:description_transaction,1,:id_type_transaction,:id_commande)');
        $req->execute(array(
            'id_compte_debiteur' => $id_compte_debiteur,
            'id_compte_crediteur' => $id_compte_crediteur,
            'id_admin' => $id_admin,
            'somme_transaction' => $somme_transaction,
            'date_transaction' => date("Y-m-d H:i:s"),
            'nom_transaction' => $nom_transaction,
            'description_transaction' => $description_transaction,
            'id_type_transaction' => $id_type_transaction,
            'id_commande' => $id_commande
        ));
        return $bdd->lastInsertId();
    }

    // modifie le status d'une transaction
    public static function setStatusTransaction($bdd,$id_transaction,$id_type_status_transaction,$id_admin) {
        $req = $bdd->prepare('UPDATE transactions SET id_type_status_transaction = :id_type_status_transaction, id_admin = :id_admin WHERE id_transaction = :id_transaction');
        $req->execute(array(
            'id_transaction' => $id_transaction,
            'id_type_status_transaction' => $id_type_status_transaction,
            'id_admin' => $id_admin
        ));
    }
}