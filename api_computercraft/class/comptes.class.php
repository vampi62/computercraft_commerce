<?php
// get comptes/{id_joueur}/user
// get comptes/{id_joueur}/apikey
// get compte/{id}
// set compte/{id}/solde_compte
// set compte/{id}/delete
// set compte/add
class Comptes {
    // recupere les comptes accessible par le joueur (lui a partient ou groupe en communs qui permet le getcomptes)
    public static function getComptesWithUser($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes
        LEFT JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        LEFT JOIN groupes_joueurs ON groupes_comptes.id_groupe = groupes_joueurs.id_groupe
        LEFT JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        LEFT JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur
        WHERE (groupes_joueurs.id_joueur = :id_joueur AND droits.nom_droit = :nom_droit) OR (comptes.id_joueur = :id_joueur)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'nom_droit' => "getcomptes"
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $comptes;
    }

    // recupere les comptes accessible par la apikey (groupe en communs qui permet le getcomptes)
    public static function getComptesWithapikey($bdd,$idApiKey) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes
        INNER JOIN groupes_comptes ON comptes.id_compte = groupes_comptes.id_compte
        INNER JOIN groupes_apikeys ON groupes_comptes.id_groupe = groupes_apikeys.id_groupe
        INNER JOIN apikeys ON groupes_apikeys.id_apikey = apikeys.id_apikey
        INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_comptes.id_groupe
        INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
        INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = groupes_apikeys.id_groupe
        INNER JOIN droits     ON droits.id_droit = apikeys_droits.id_droit
        INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur
        WHERE apikeys.id_apikey = :id_apikey AND droits.nom_droit = :nom_droit');
        $req->execute(array(
            'id_apikey' => $idApiKey,
            'nom_droit' => "getcomptes"
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
		$req->closeCursor();
        return $comptes;
    }

    // recupere les comptes d'un joueur
    public static function getComptesByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur WHERE comptes.id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $comptes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $comptes;
    }

    // recupere le compte
    public static function getCompteById($bdd,$idCompte) {
        $req = $bdd->prepare('SELECT comptes.*,joueurs.pseudo_joueur FROM comptes INNER JOIN joueurs ON joueurs.id_joueur = comptes.id_joueur WHERE comptes.id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $idCompte
        ));
        $compte = $req->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }

    private $_soldeCompte = 0;
    private $_idCompte;
    private $_bdd;

    public function __construct($bdd,$idCompte = null) {
        $this->_bdd = $this->_bdd;
        if($idCompte != null) {
            $this->_idCompte = $idCompte;
            $req = $this->_bdd->prepare('SELECT solde_compte FROM comptes WHERE id_compte = :id_compte');
            $req->execute(array(
                'id_compte' => $this->_idCompte
            ));
            $this->_soldeCompte = $req->fetch(PDO::FETCH_ASSOC)['solde_compte'];
        }
    }

    // recupere l'id du compte
    public function getIdCompte() {
        return $this->_idCompte;
    }

    public function getSolde() {
        return $this->_soldeCompte;
    }
    // le solde_compte ne peut être modifier qu'avec une transaction pour garder une trace des mouvements
    // modifie le solde_compte du compte
    public function setCompteSolde($solde_compte) {
        $req = $this->_bdd->prepare('UPDATE comptes SET solde_compte = :solde_compte WHERE id_compte = :id_compte');
        $req->execute(array(
            'solde_compte' => $soldeCompte,
            'id_compte' => $_idCompte
        ));
    }

    // modifie le nom du compte
    public function setCompteNom($nom_compte) {
        $req = $this->_bdd->prepare('UPDATE comptes SET nom_compte = :nom_compte WHERE id_compte = :id_compte');
        $req->execute(array(
            'nom_compte' => $nomCompte,
            'id_compte' => $_idCompte
        ));
    }

    // supprime le compte
    public function deleteCompte() {
        $req = $this->_bdd->prepare('DELETE FROM comptes WHERE id_compte = :id_compte');
        $req->execute(array(
            'id_compte' => $_idCompte
        ));
    }

    // ajoute un compte
    public function addCompte($idJoueur,$idTypeCompte,$nomCompte) {
        $req = $this->_bdd->prepare('INSERT INTO comptes(id_joueur,id_type_compte,nom_compte,solde_compte) VALUES(:id_joueur,:id_type_compte,:nom_compte, 0)');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'id_type_compte' => $idTypeCompte,
            'nom_compte' => $nomCompte
        ));
        $this->_idCompte = $this->_bdd->lastInsertId();
    }
}