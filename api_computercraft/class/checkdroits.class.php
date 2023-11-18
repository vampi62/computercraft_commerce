<?php
class Checkdroits {
    // verifie si le compte a un des role requis
    public static function CheckRole($bdd, $pseudoJoueur, $arrayRoleRequis) {
        $req = $bdd->prepare('SELECT * FROM vw_joueurs WHERE pseudo_joueur = :pseudo_joueur');
        $req->execute(array(
            'pseudo_joueur' => $pseudoJoueur
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (in_array($login['nom_type_role'], $arrayRoleRequis)) {
            return true;
        }
        return false;
    }

    // verifie si l'id indiquer est dans la table
    public static function CheckId($bdd, $id, $table) {
        $req = $bdd->prepare('SELECT id_'.$table.' FROM '.$table.'s WHERE id_'.$table.' = :id');
        $req->execute(array(
            'id' => $id
        ));
        $liste = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (!empty($liste)) {
            return true;
        }
        return false;
    }

    // verifie le mot de passe du compte
    public static function CheckMdp($bdd, $nom, $mdp) {
        $req = $bdd->prepare('SELECT mdp_joueur FROM joueurs WHERE pseudo_joueur = :nom');
        $req->execute(array(
            'nom' => $nom
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
		if (!empty($login)) {
			if (password_verify($mdp, $login['mdp_joueur'])) {
				return true;
			}
		}
        return false;
    }

    // verifie si le mot de passe respect les regle de securite
    public static function CheckPasswordSecu($mdp) {
        if (strlen($mdp) < 8) {
            return false;
        }
        if (!preg_match("#[0-9]+#", $mdp)) {
            return false;
        }
        if (!preg_match("#[a-zA-Z]+#", $mdp)) {
            return false;
        }
        return true;
    }

    // verifie le token du compte 
	public function CheckToken($bdd, $pseudoJoueur, $token) {
        $req = $bdd->prepare('SELECT resettoken_joueur FROM joueurs WHERE pseudo_joueur = :pseudo_joueur AND resettoken_joueur IS NOT NULL');
        $req->execute(array(
            'pseudo_joueur' => $pseudoJoueur
        ));
        $reset = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if (!empty($reset)) {
            if ($token == $reset['resettoken']) {
                return true;
            }
        }
		return false;
	}
    
    // verifie si l'api a la permission d'effectuer l'action
    public static function CheckPermApi($bdd, $nom, $action) {
        $req = $bdd->prepare('SELECT COUNT(*) FROM apikeys 
        INNER JOIN apikeys_droits ON apikeys.id_apikey = apikeys_droits.id_apikey 
        INNER JOIN droits ON droits.id_droit = apikeys_droits.id_droit 
        WHERE apikeys.nom = :nom AND droits.nom_droit = :action');
        $req->execute(array(
            'nom' => $nom,
            'action' => $action
        ));
        if ($req->fetchColumn() > 0) {
            $req->closeCursor();
            return true;
        }
        $req->closeCursor();
        return false;
    }

    // verifie si le compte a la permission d'effectuer l'action sur l'objet
    public static function CheckPermObj($bdd, $idNom, $idObjet, $type, $action ,$boolApi=false) {
        if ($boolApi)
        {
            // si compte est membre d'un groupe d'on l'objet est membre (si login apikey)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si api et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT COUNT(*) FROM '.$type.'s
            INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
            INNER JOIN groupes_apikeys    ON groupes_'.$type.'s.id_groupe = groupes_apikeys.id_groupe
            INNER JOIN apikeys           ON apikeys.id_apikey = groupes_apikeys.id_apikey
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
            INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND droits.nom_droit = :action AND apikeys.id_apikey = :idnom');
            $req->execute(array(
                'idobjet' => $idObjet,
                'idnom' => $idNom,
                'action' => $action
            ));
            if (!$req->fetchColumn() > 0) {
                $req->closeCursor();
                return true;
            }
            $req->closeCursor();
            return false;
        }
        else
        {
            // si compte est proprio de l'objet
                // -- permet l'action
            // si compte est membre d'un groupe d'on l'objet est membre (si login user)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si user et obj.proprio son identique alors return true
            $req = $bdd->prepare('SELECT COUNT(*) FROM '.$type.'s WHERE id_'.$type.' = :idobjet AND id_joueur = :idnom');
            $req->execute(array(
                'idobjet' => $idObjet,
                'idnom' => $idNom
            ));
            if ($req->fetchColumn() > 0) {
                $req->closeCursor();
                return true;
            }
            $req->closeCursor();
            # si user et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT COUNT(*) FROM '.$type.'s
            INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
            INNER JOIN groupes_joueur    ON groupes_'.$type.'s.id_groupe = groupes_joueur.id_groupe
            INNER JOIN joueurs           ON joueurs.id_joueur = groupes_joueur.id_joueur
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
            INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND droits.nom_droit = :action AND joueurs.id_joueur = :idnom');
            $req->execute(array(
                'idobjet' => $idObjet,
                'idnom' => $idNom,
                'action' => $action
            ));
            if (!$req->fetchColumn() > 0) {
                $req->closeCursor();
                return true;
            }
            $req->closeCursor();
            return false;
        }
    }

    // verifie si tous les arguments sont present
    // true si empty est permis
    // exemple --> $args_need = array('mdp' => false, 'email' => true) // mdp obligatoire, email facultatif
    public static function CheckArgs($argsSend, $argsNeed, $boolPost=false) {
        foreach ($argsNeed as $key => $value) {
            if (!isset($argsSend[$key])) {
                return false;
            } else {
                if (!$value) {
                    if (empty($argsSend[$key])) {
                        return false;
                    }
                }
                if ($boolPost) {
                    $_POST[$key] = htmlspecialchars($_POST[$key]);
                } else {
                    $_GET[$key] = htmlspecialchars($_GET[$key]);
                }
            }
        }
        return true;
    }

    // verifie si le compte est proprio de l'objet
    public static function CheckProprioObj($bdd, $idNom, $idObjet, $type) {
        $req = $bdd->prepare('SELECT COUNT(*) FROM '.$type.'s WHERE id_'.$type.' = :idobjet AND id_joueur = :idnom');
        $req->execute(array(
            'idobjet' => $idObjet,
            'idnom' => $idNom
        ));
        if ($req->fetchColumn() > 0) {
            $req->closeCursor();
            return true;
        }
        $req->closeCursor();
        return false;
    }

    // verifie le chemin_status_commandes de la commande
    public static function CheckCheminStatusCommande($bdd,$idStatusDepart,$idStatusArriver,$typeUser) {
        $req = $bdd->prepare('SELECT * FROM chemin_status_commandes WHERE id_status_depart = :id_status_depart AND id_status_arriver = :id_status_arriver');
        $req->execute(array(
            'id_status_arriver' => $idStatusArriver,
            'id_status_depart' => $idStatusDepart
        ));
        $cheminStatusCommandes = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if ($cheminStatusCommandes[$typeUser] == "1") {
            return true;
        } else {
            return false;
        }
    }

    // verification code retire_commande
    public static function CheckCodeRetraitCommande($bdd,$codeRetraitCommande,$idCommande) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE id_commande = :id_commande');
        $req->execute(array(
            'id_commande' => $idCommande
        ));
        $commande = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();

        if (!empty($commande)) {
            if ($commande['code_retrait_commande'] == $codeRetraitCommande) {
                return true;
            }
        }
        return false;
    }

    // verification du code api
    public static function CheckCodeApi($bdd,$nomApi,$mdpApiKey) {
        $req = $bdd->prepare('SELECT * FROM apikeys WHERE nom_api = :nom_api');
        $req->execute(array(
            'nom_api' => $nomApi
        ));
        $api = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if (!empty($api)) {
            if ($api['mdp_apikey'] == $mdpApiKey) {
                return true;
            }
        }
        return false;
    }
}
// note : seul le proprio du groupe ou de l'objet peut le creer/supprimer ou changer ses groupes