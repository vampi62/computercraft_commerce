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

    // recupere les commandes ayant cette adresse comme vendeur ou client
    public static function getCommandesByAdresse($bdd,$id_adresse) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_adresse_client = :id_adresse OR id_adresse_vendeur = :id_adresse');
        $req->execute(array(
            'id_adresse' => $id_adresse
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

    // recupere les commandes ayant cette transaction
    public static function getCommandesByTransaction($bdd,$id_transaction) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_transaction = :id_transaction');
        $req->execute(array(
            'id_transaction' => $id_transaction
        ));
        $commandes = $req->fetchAll();
        $req->closeCursor();
        return $commandes;
    }

    // recupere la commande
    public static function getCommandeById($bdd,$id_commande) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande
        ));
        $commande = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commande;
    }

    // modifie le status de la commande
    public static function setCommandeStatus($bdd,$id_commande,$id_status_commande) {
        $req = $bdd->prepare('UPDATE commandes SET id_status_commande = :id_status_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'id_status_commande' => $id_status_commande
        ));
    }

    // lier une transaction a la commande
    public static function setCommandeTransaction($bdd,$id_commande,$id_transaction) {
        $req = $bdd->prepare('UPDATE commandes SET id_transaction = :id_transaction WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'id_transaction' => $id_transaction
        ));
    }

    // le suivi n'est a modifier qu'avec une mise a jour du status de la commande
    // modifie le suivi de la commande
    public static function setCommandeSuivi($bdd,$id_commande,$suivi_commande,$saut_de_ligne) {
        // recuperation du suivi de la commande
        $commande = Commande::getCommandeById($bdd,$id_commande);
        $suivi_commandep1 = $commande['suivi_commande'];
        $suivi_commandenext = $suivi_commandep1 . $saut_de_ligne . $suivi_commande . "-+-" . date("Y-m-d H:i:s");
        $req = $bdd->prepare('UPDATE commandes SET suivi_commande = :suivi_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'suivi_commande' => $suivi_commandenext
        ));
    }

    // modifie date de livraison de la commande
    public static function setCommandeDateLivraison($bdd,$id_commande,$date_livraison_commande) {
        $req = $bdd->prepare('UPDATE commandes SET date_livraison_commande = :date_livraison_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'date_livraison_commande' => $date_livraison_commande
        ));
    }

    // modifie le code de retrait de la commande
    public static function setCommandeCodeRetrait($bdd,$id_commande,$code_retrait_commande) {
        $req = $bdd->prepare('UPDATE commandes SET code_retrait_commande = :code_retrait_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $id_commande,
            'code_retrait_commande' => $code_retrait_commande
        ));
    }

    // ajoute une commande
    public static function addCommande($bdd,$nom_produit_commande,$quantite_commande,$prix_unitaire_commande,$frait_livraison_commande,$description_commande,$code_retrait_commande,$id_adresse_vendeur,$id_adresse_client,$id_offre,$id_compte_vendeur,$id_compte_client,$id_types_status_commande) {
        $req = $bdd->prepare('INSERT INTO commandes(nom_produit_commande,quantite_commande,prix_unitaire_commande,frait_livraison_commande,description_commande,suivi_commande,date_commande,code_retrait_commande,id_adresse_vendeur,id_adresse_client,id_offre,id_compte_vendeur,id_compte_client,id_types_status_commande) VALUES(:nom_produit_commande,:quantite_commande,:prix_unitaire_commande,:frait_livraison_commande,:description_commande,:suivi_commande,:date_commande,:code_retrait_commande,:id_adresse_vendeur,:id_adresse_client,:id_offre,:id_compte_vendeur,:id_compte_client,:id_types_status_commande)');
        $req->execute(array(
            'nom_produit_commande' => $nom_produit_commande,
            'quantite_commande' => $quantite_commande,
            'prix_unitaire_commande' => $prix_unitaire_commande,
            'frait_livraison_commande' => $frait_livraison_commande,
            'description_commande' => $description_commande,
            'suivi_commande' => "",
            'date_commande_commande' => date("Y-m-d H:i:s"),
            'code_retrait_commande' => $code_retrait_commande,
            'id_adresse_vendeur' => $id_adresse_vendeur,
            'id_adresse_client' => $id_adresse_client,
            'id_offre' => $id_offre,
            'id_compte_vendeur' => $id_compte_vendeur,
            'id_compte_client' => $id_compte_client,
            'id_types_status_commande' => $id_types_status_commande
        ));
        return $bdd->lastInsertId();
    }
}