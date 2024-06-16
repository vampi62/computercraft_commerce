<?php
// get transactions/{id_compte}
// get transactions/{id_joueur}
// get transaction/{id}
// set transaction/add

class Transactions {
    // recupere les transaction en attente
    public static function getTransactionsByCompteAndCommande($bdd,$idCompte,$idCommande,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_joueur = joueurs.id_joueur
        INNER JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE (transactions.id_compte_debiteur = :id_compte OR transactions.id_compte_crediteur = :id_compte) AND transactions.id_commande = :id_commande
        ORDER BY transactions.id_transaction DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_compte' => $idCompte,
            'id_commande' => $idCommande
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $transactions;
    }

    // recupere les transactions du compte
    public static function getTransactionsByCompte($bdd,$idCompte,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_joueur = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_compte_debiteur = :id_compte OR transactions.id_compte_crediteur = :id_compte
        ORDER BY transactions.id_transaction DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transactions;
    }

    // recupere les transactions executer par un admin
    public static function getTransactionsByAdmin($bdd,$idAdmin,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        INNER JOIN joueurs ON transactions.id_joueur = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_joueur = :id_joueur
        ORDER BY transactions.id_transaction DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_joueur' => $idAdmin
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transactions;
    }

    // recupere la transaction
    public static function getTransactionById($bdd,$idTransaction,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_joueur = joueurs.id_joueur
        LEFT JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_transaction = :id_transaction');
        $req->execute(array(
            'id_transaction' => $idTransaction
        ));
        $transaction = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $transaction;
    }

    public static function getTransactionsByCommande($bdd,$idCommande,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT transactions.*, codebit.nom_compte as nom_compte_debiteur, cocred.nom_compte as nom_compte_crediteur, commandes.nom_commande FROM transactions 
        LEFT JOIN comptes AS codebit ON transactions.id_compte_debiteur = codebit.id_compte
        LEFT JOIN comptes AS cocred ON transactions.id_compte_crediteur = cocred.id_compte
        LEFT JOIN joueurs ON transactions.id_joueur = joueurs.id_joueur
        INNER JOIN commandes ON transactions.id_commande = commandes.id_commande
        WHERE transactions.id_commande = :id_commande
        ORDER BY transactions.id_transaction DESC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_commande' => $idCommande
        ));
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $transactions;
    }

    // ajoute une transaction
    //
    public static function addTransaction($bdd,$idCompteDebiteur=null,$idCompteCrediteur=null,$idAdmin=null,$sommeTransaction,$nomTransaction,$descriptionTransaction,$idTypeTransaction,$idCommande=null) {
        $req = $bdd->prepare('INSERT INTO transactions(id_compte_debiteur,id_compte_crediteur,id_joueur,somme_transaction,date_transaction,nom_transaction,description_transaction,id_type_transaction,id_commande) VALUES(:id_compte_debiteur,:id_compte_crediteur,:id_joueur,:somme_transaction,:date_transaction,:nom_transaction,:description_transaction,:id_type_transaction,:id_commande)');
        $req->execute(array(
            'id_compte_debiteur' => $idCompteDebiteur,
            'id_compte_crediteur' => $idCompteCrediteur,
            'id_joueur' => $idAdmin,
            'somme_transaction' => $sommeTransaction,
            'date_transaction' => date("Y-m-d H:i:s"),
            'nom_transaction' => $nomTransaction,
            'description_transaction' => $descriptionTransaction,
            'id_type_transaction' => $idTypeTransaction,
            'id_commande' => $idCommande
        ));
        return $bdd->lastInsertId();
    }
}