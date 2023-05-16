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
    // recupere les commandes ayant ce compte comme vendeur ou client
    public static function getCommandesByCompte($bdd,$id_compte) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_compte_vendeur = :id_compte OR id_compte_client = :id_compte');
        $req->execute(array(
            'id_compte' => $id_compte
        ));
        $commandes = $req->fetchAll();
        $req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce compte vendeur
    public static function getCommandesByCompteVendeur($bdd,$id_compte_vendeur) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_compte_vendeur = :id_compte_vendeur');
        $req->execute(array(
            'id_compte_vendeur' => $id_compte_vendeur
        ));
        $commandes = $req->fetchAll();
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce compte client
    public static function getCommandesByCompteClient($bdd,$id_compte_client) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_compte_client = :id_compte_client');
        $req->execute(array(
            'id_compte_client' => $id_compte_client
        ));
        $commandes = $req->fetchAll();
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette adresse vendeur
    public static function getCommandesByAdresseVendeur($bdd,$id_adresse_vendeur) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_adresse_vendeur = :id_adresse_vendeur');
        $req->execute(array(
            'id_adresse_vendeur' => $id_adresse_vendeur
        ));
        $commandes = $req->fetchAll();
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette adresse client
    public static function getCommandesByAdresseClient($bdd,$id_adresse_client) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_adresse_client = :id_adresse_client');
        $req->execute(array(
            'id_adresse_client' => $id_adresse_client
        ));
        $commandes = $req->fetchAll();
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce livreur
    public static function getCommandesByLivreur($bdd,$id_livreur) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $id_livreur
        ));
        $commandes = $req->fetchAll();
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette offre
    public static function getCommandesByOffre($bdd,$id_offre) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_offre = :id_offre');
        $req->execute(array(
            'id_offre' => $id_offre
        ));
        $commandes = $req->fetchAll();
        $req->closeCursor();
        return $commandes;
    }

    // recupere la commande
    public static function getCommande($bdd,$id_commande) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande
        ));
        $commande = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commande;
    }

    // modifie le status de la commande
    public static function setCommandeStatus($bdd,$id_commande,$id_status) {
        $req = $bdd->prepare('UPDATE commandes SET id_status = :id_status WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'id_status' => $id_status
        ));
    }

    // lier une transaction à la commande
    public static function setCommandeTransaction($bdd,$id_commande,$id_transaction) {
        $req = $bdd->prepare('UPDATE commandes SET id_transaction = :id_transaction WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'id_transaction' => $id_transaction
        ));
    }

    // modifie le suivi de la commande
    public static function setCommandeSuivi($bdd,$id_commande,$suivi) {
        $req = $bdd->prepare('UPDATE commandes SET suivi = :suivi WHERE id = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'suivi' => $suivi
        ));
    }

    // modifie date de livraison de la commande
    public static function setCommandeDateLivraison($bdd,$id_commande,$date_livraison) {
        $req = $bdd->prepare('UPDATE commandes SET date_livraison = :date_livraison WHERE id = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'date_livraison' => $date_livraison
        ));
    }

    // modifie le code de retrait de la commande
    public static function setCommandeCodeRetrait($bdd,$id_commande,$code_retrait) {
        $req = $bdd->prepare('UPDATE commandes SET code_retrait = :code_retrait WHERE id = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'code_retrait' => $code_retrait
        ));
    }

    // ajoute une commande
    public static function setCommande($bdd,$nom_produit,$quantite,$prix_unitaire,$frait_livraison,$description,$suivi,$date_livraison,$code_retrait,$id_adresse_vendeur,$id_adresse_client,$id_offre,$id_transaction,$id_compte_vendeur,$id_compte_client,$id_types_status_commande,$id_livreur) {
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