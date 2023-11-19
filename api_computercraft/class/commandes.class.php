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
// set commande/{id}/code_retrait_commande
// set commande/add

class Commandes {
    // recupere les commandes ayant ce compte comme vendeur ou client
    public static function getCommandesByCompte($bdd,$idCompte) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_compte_vendeur = :id_compte OR commandes.id_compte_client = :id_compte');
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette adresse comme vendeur ou client
    public static function getCommandesByAdresse($bdd,$idAdresse) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_adresse_client = :id_adresse OR commandes.id_adresse_vendeur = :id_adresse');
        $req->execute(array(
            'id_adresse' => $idAdresse
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce compte vendeur
    public static function getCommandesByCompteVendeur($bdd,$idCompteVendeur) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        INNER JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_compte_vendeur = :id_compte_vendeur');
        $req->execute(array(
            'id_compte_vendeur' => $idCompteVendeur
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce compte client
    public static function getCommandesByCompteClient($bdd,$idCompteClient) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        INNER JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_compte_client = :id_compte_client');
        $req->execute(array(
            'id_compte_client' => $idCompteClient
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette adresse vendeur
    public static function getCommandesByAdresseVendeur($bdd,$idAdresseVendeur) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        INNER JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_adresse_vendeur = :id_adresse_vendeur');
        $req->execute(array(
            'id_adresse_vendeur' => $idAdresseVendeur
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette adresse client
    public static function getCommandesByAdresseClient($bdd,$idAdresseClient) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        INNER JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_adresse_client = :id_adresse_client');
        $req->execute(array(
            'id_adresse_client' => $idAdresseClient
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant ce livreur
    public static function getCommandesByLivreur($bdd,$idLivreur) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        INNER JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_livreur = :id_livreur');
        $req->execute(array(
            'id_livreur' => $idLivreur
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commandes;
    }

    // recupere les commandes ayant cette offre
    public static function getCommandesByOffre($bdd,$idOffre) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        INNER JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_offre = :id_offre');
        $req->execute(array(
            'id_offre' => $idOffre
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $commandes;
    }

    // recupere la commande
    public static function getCommandeById($bdd,$idCommande) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $idCommande
        ));
        $commande = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $commande;
    }

    // recupere les commande via le status
    public static function getCommandesByStatus($bdd,$idTypeCommande) {
        $req = $bdd->prepare('SELECT commandes.*, covendeur.nom_compte AS nom_compte_vendeur ,coclient.nom_compte AS nom_compte_client ,advendeur.nom_adresse AS nom_adresse_vendeur,adclient.nom_adresse AS nom_adresse_client,livreurs.nom_livreur,offres.nom_offre FROM commandes 
        LEFT JOIN comptes AS covendeur ON commandes.id_compte_vendeur = covendeur.id_compte
        LEFT JOIN comptes AS coclient ON commandes.id_compte_client = coclient.id_compte
        LEFT JOIN adresses AS advendeur ON commandes.id_adresse_vendeur = advendeur.id_adresse
        LEFT JOIN adresses AS adclient ON commandes.id_adresse_client = adclient.id_adresse
        LEFT JOIN livreurs ON commandes.id_livreur = livreurs.id_livreur
        LEFT JOIN offres ON commandes.id_offre = offres.id_offre
        WHERE commandes.id_type_commande = :id_type_commande');
        $req->execute(array(
            'id_type_commande' => $idTypeCommande
        ));
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $commandes;
    }
    

    private $_idCommande;
    private $_bdd;

    public function __construct($bdd,$idCommande = null) {
        $this->_bdd = $bdd;
        if($idCommande != null) {
            $this->_idCommande = $idCommande;
        }
    }

    // recupere l'id de la Commande
    public function getIdCommande() {
        return $this->_idCommande;
    }

    // modifie le status de la commande
    public function setCommandeStatus($idTypeCommande) {
        $req = $this->_bdd->prepare('UPDATE commandes SET id_type_commande = :id_type_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $this->_idCommande,
            'id_type_commande' => $idTypeCommande
        ));
    }

    // le suivi n'est a modifier qu'avec une mise a jour du status de la commande
    // modifie le suivi de la commande
    public function setCommandeSuivi($suiviCommande,$sautDeLigne) {
        // recuperation du suivi de la commande
        $commande = Commandes::getCommandeById($this->_bdd,$this->_idCommande);
        $req = $this->_bdd->prepare('UPDATE commandes SET suivi_commande = :suivi_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $this->_idCommande,
            'suivi_commande' => $commande['suivi_commande'] . $suiviCommande . "-+-" . date("Y-m-d H:i:s") . $sautDeLigne
        ));
    }

    // modifie date de livraison de la commande
    public function setCommandeDateLivraison($dateLivraisonCommande) {
        $req = $this->_bdd->prepare('UPDATE commandes SET date_livraison_commande = :date_livraison_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $this->_idCommande,
            'date_livraison_commande' => $dateLivraisonCommande
        ));
    }

    // modifie le code de retrait de la commande
    public function setCommandeCodeRetrait($codeRetraitCommande) {
        $req = $this->_bdd->prepare('UPDATE commandes SET code_retrait_commande = :code_retrait_commande WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $this->_idCommande,
            'code_retrait_commande' => $codeRetraitCommande
        ));
    }

    // modifile l'id du livreur de la commande
    public function setCommandeLivreur($idLivreur) {
        $req = $this->_bdd->prepare('UPDATE commandes SET id_livreur = :id_livreur WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $this->_idCommande,
            'id_livreur' => $idLivreur
        ));
    }

    // ajoute une commande
    public function addCommande($nomCommande,$quantiteCommande,$prixUnitaireCommande,$fraitLivraisonCommande,$descriptionCommande,$codeRetraitCommande,$idAdresseVendeur,$idAdresseClient,$idOffre,$idCompteVendeur,$idCompteClient) {
        $req = $this->_bdd->prepare('INSERT INTO commandes(nom_commande,quantite_commande,prix_unitaire_commande,frait_livraison_commande,description_commande,suivi_commande,date_commande_commande,code_retrait_commande,id_adresse_vendeur,id_adresse_client,id_offre,id_compte_vendeur,id_compte_client,id_type_commande) VALUES(:nom_commande,:quantite_commande,:prix_unitaire_commande,:frait_livraison_commande,:description_commande,:suivi_commande,:date_commande_commande,:code_retrait_commande,:id_adresse_vendeur,:id_adresse_client,:id_offre,:id_compte_vendeur,:id_compte_client,1)');
        $req->execute(array(
            'nom_commande' => $nomCommande,
            'quantite_commande' => $quantiteCommande,
            'prix_unitaire_commande' => $prixUnitaireCommande,
            'frait_livraison_commande' => $fraitLivraisonCommande,
            'description_commande' => $descriptionCommande,
            'suivi_commande' => "",
            'date_commande_commande' => date("Y-m-d H:i:s"),
            'code_retrait_commande' => $codeRetraitCommande,
            'id_adresse_vendeur' => $idAdresseVendeur,
            'id_adresse_client' => $idAdresseClient,
            'id_offre' => $idOffre,
            'id_compte_vendeur' => $idCompteVendeur,
            'id_compte_client' => $idCompteClient
        ));
        $this->_idCommande = $this->_bdd->lastInsertId();
    }
}