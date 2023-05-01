<?php
// get commandes/{id_compte_vendeur}
// get commandes/{id_compte_client}
// get commandes/{id_adresse_vendeur}
// get commandes/{id_adresse_client}
// get commandes/{id_livreur}
// get commande/{id}
// set commande/{id}/status/{id}
// set commande/{id}/transaction/{id}/add
// set commande/{id}/suivi
// set commande/{id}/date_livraison
// set commande/{id}/code_retrait
// set commande/add

class Commandes {
    public static function getCommandes_comptev($bdd,$compte_id) {
        // recupere les commandes du vendeur
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_compte_vendeur = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
        $commandes = $req->fetchAll();
        return $commandes;
    }
    public static function getCommandes_comptec($bdd,$compte_id) {
        // recupere les commandes du client
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_compte_client = :compte_id');
        $req->execute(array(
            'compte_id' => $compte_id
        ));
        $commandes = $req->fetchAll();
        return $commandes;
    }
    public static function getCommandes_adressev($bdd,$adresse_id) {
        // recupere les commandes du vendeur
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_adresse_vendeur = :adresse_id');
        $req->execute(array(
            'adresse_id' => $adresse_id
        ));
        $commandes = $req->fetchAll();
        return $commandes;
    }
    public static function getCommandes_adressec($bdd,$adresse_id) {
        // recupere les commandes du client
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_adresse_client = :adresse_id');
        $req->execute(array(
            'adresse_id' => $adresse_id
        ));
        $commandes = $req->fetchAll();
        return $commandes;
    }
    public static function getCommandes_livreur($bdd,$livreur_id) {
        // recupere les commandes du livreur
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_livreur = :livreur_id');
        $req->execute(array(
            'livreur_id' => $livreur_id
        ));
        $commandes = $req->fetchAll();
        return $commandes;
    }
    public static function getCommande($bdd,$commande_id) {
        // recupere une commande
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id
        ));
        $commande = $req->fetch();
        return $commande;
    }
    public static function setCommande_status($bdd,$commande_id,$status_id) {
        // change le status d'une commande
        $req = $bdd->prepare('UPDATE commandes SET id_status = :status_id WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id,
            'status_id' => $status_id
        ));
    }
    public static function setCommande_transaction($bdd,$commande_id,$transaction_id) {
        // ajoute une transaction a une commande
        $req = $bdd->prepare('UPDATE commandes SET id_transaction = :transaction_id WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id,
            'transaction_id' => $transaction_id
        ));
    }
    public static function setCommande_suivi($bdd,$commande_id,$suivi) {
        // ajoute un suivi a une commande
        $req = $bdd->prepare('UPDATE commandes SET suivi = :suivi WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id,
            'suivi' => $suivi
        ));
    }
    public static function setCommande_date_livraison($bdd,$commande_id,$date_livraison) {
        // ajoute une date de livraison a une commande
        $req = $bdd->prepare('UPDATE commandes SET date_livraison = :date_livraison WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id,
            'date_livraison' => $date_livraison
        ));
    }
    public static function setCommande_code_retrait($bdd,$commande_id,$code_retrait) {
        // ajoute un code de retrait a une commande
        $req = $bdd->prepare('UPDATE commandes SET code_retrait = :code_retrait WHERE id = :commande_id');
        $req->execute(array(
            'commande_id' => $commande_id,
            'code_retrait' => $code_retrait
        ));
    }
    public static function setCommande($bdd,$nom_produit,$quantite,$prix_unitaire,$frait_livraison,$description,$suivi,$date_livraison,$code_retrait,$id_adresse_vendeur,$id_adresse_client,$id_offre,$id_transaction,$id_compte_vendeur,$id_compte_client,$id_types_status_commande,$id_livreur) {
        // ajoute une commande
        $date_commande = date("Y-m-d H:i:s");
        $req = $bdd->prepare('INSERT INTO commandes(nom_produit,quantite,prix_unitaire,frait_livraison,description,suivi,date_commande,date_livraison,code_retrait,id_adresse_vendeur,id_adresse_client,id_offre,id_transaction,id_compte_vendeur,id_compte_client,id_types_status_commande,id_livreur) VALUES(:nom_produit,:quantite,:prix_unitaire,:frait_livraison,:description,:suivi,:date_commande,:date_livraison,:code_retrait,:id_adresse_vendeur,:id_adresse_client,:id_offre,:id_transaction,:id_compte_vendeur,:id_compte_client,:id_types_status_commande,:id_livreur)');
        $req->execute(array(
            'nom_produit' => $nom_produit,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'frait_livraison' => $frait_livraison,
            'description' => $description,
            'suivi' => $suivi,
            'date_commande' => $date_commande,
            'date_livraison' => $date_livraison,
            'code_retrait' => $code_retrait,
            'id_adresse_vendeur' => $id_adresse_vendeur,
            'id_adresse_client' => $id_adresse_client,
            'id_offre' => $id_offre,
            'id_transaction' => $id_transaction,
            'id_compte_vendeur' => $id_compte_vendeur,
            'id_compte_client' => $id_compte_client,
            'id_types_status_commande' => $id_types_status_commande,
            'id_livreur' => $id_livreur
        ));
    
    }
}