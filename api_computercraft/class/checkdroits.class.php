<?php
class Checkdroits {
    // verifie si le compte a un des role requis
    public static function CheckRole($bdd, $pseudo, $array_role_requis) {
        $req = $bdd->prepare('SELECT joueur_roles.* FROM joueur_roles INNER JOIN joueurs ON joueurs.id_joueur_role = joueur_roles.id_joueur_role WHERE joueurs.pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (in_array($login['nom_joueur_roles'], $array_role_requis)) {
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
        if(!empty($liste)) {
            return true;
        }
        return false;
    }

    // verifie le mot de passe du compte
    public static function CheckPassword($bdd, $nom, $mdp,$iskeyapi=false) {
        #si iskeyapi=TRUE compare avec la table api
        #si iskeyapi=FALSE compare avec la table joueurs
        #autre compare avec la table livreurs

        if ($iskeyapi) {
            $req = $bdd->prepare('SELECT mdp_keyapi FROM keyapis WHERE nom_keyapi = :nom');
        } else {
            $req = $bdd->prepare('SELECT mdp_joueur FROM joueurs WHERE pseudo_joueur = :nom');
        }
        $req->execute(array(
            'nom' => $nom
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
		if(!empty($login)) {
			if(password_verify($mdp, $login['mdp'])) {
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
	public function CheckToken($bdd, $nom, $token) {
        $req = $bdd->prepare('SELECT resettoken_joueur FROM joueurs WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo
        ));
        $reset = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if(!empty($reset)) {
            if($token == $reset['resettoken']) {
                return true;
            }
        }
		return false;
	}
    
    // verifie si l'api a la permission d'effectuer l'action
    public static function CheckPermApi($bdd, $nom, $action) {
        $req = $bdd->prepare('SELECT * FROM keyapis 
        INNER JOIN keyapis_droits ON keyapis.id_keyapi = keyapis_droits.id_keyapi 
        INNER JOIN droits ON droits.id_droit = keyapis_droits.id_droit 
        WHERE keyapis.nom = :nom AND droits.nom_droit = :action');
        $req->execute(array(
            'nom' => $nom,
            'action' => $action
        ));
        if (mysql_num_rows($req) > 0) {
            $req->closeCursor();
            return true;
        }
        $req->closeCursor();
        return false;
    }

    // verifie si le compte a la permission d'effectuer l'action sur l'objet
    public static function CheckPermObj($bdd, $idnom, $idobjet, $type, $action ,$bool_api=false) {
        if ($bool_api)
        {
            // si compte est membre d'un groupe d'on l'objet est membre (si login keyapi)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si api et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT * FROM '.$type.'s
            INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
            INNER JOIN groupes_keyapis    ON groupes_'.$type.'s.id_groupe = groupes_keyapis.id_groupe
            INNER JOIN keyapis           ON keyapis.id_keyapi = groupes_keyapis.id_keyapi
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
            INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND droits.nom_droit = :action AND keyapis.id_keyapi = :idnom');
            $req->execute(array(
                'idobjet' => $idobjet,
                'idnom' => $idnom,
                'action' => $action
            ));
            if (!mysql_num_rows($req) > 0) {
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
            $req = $bdd->prepare('SELECT * FROM '.$type.'s WHERE id_'.$type.' = :idobjet AND id_joueur = :idnom');
            $req->execute(array(
                'idobjet' => $idobjet,
                'idnom' => $idnom
            ));
            if (mysql_num_rows($req) > 0) {
                $req->closeCursor();
                return true;
            }
            $req->closeCursor();
            # si user et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT * FROM '.$type.'s
            INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
            INNER JOIN groupes_joueur    ON groupes_'.$type.'s.id_groupe = groupes_joueur.id_groupe
            INNER JOIN joueurs           ON joueurs.id_joueur = groupes_joueur.id_joueur
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
            INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND droits.nom_droit = :action AND joueurs.id_joueur = :idnom');
            $req->execute(array(
                'idobjet' => $idobjet,
                'idnom' => $idnom,
                'action' => $action
            ));
            if (!mysql_num_rows($req) > 0) {
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
    public static function CheckArgs($args_send, $args_need, $bool_post=false) {
        foreach ($args_need as $key => $value) {
            if (!isset($args_send[$key])) {
                return false;
            } else {
                if (!$value) {
                    if (empty($args_send[$key])) {
                        return false;
                    }
                }
                if ($bool_post) {
                    $_POST[$key] = htmlspecialchars($_POST[$key]);
                } else {
                    $_GET[$key] = htmlspecialchars($_GET[$key]);
                }
            }
        }
        return true;
    }

    // verifie si le compte est proprio de l'objet
    public static function CheckProprioObj($bdd, $idnom, $idobjet, $type) {
        $req = $bdd->prepare('SELECT * FROM '.$type.'s WHERE id_'.$type.' = :idobjet AND id_joueur = :idnom');
        $req->execute(array(
            'idobjet' => $idobjet,
            'idnom' => $idnom
        ));
        if (mysql_num_rows($req) > 0) {
            $req->closeCursor();
            return true;
        }
        $req->closeCursor();
        return false;
    }

    // verifie le chemin_status de la commande
    public static function CheckCheminStatus($bdd,$id_status_depart,$id_status_arriver,$type_user) {
        $req = $bdd->prepare('SELECT * FROM chemin_status WHERE id_status_depart = :id_status_depart AND id_status_arriver = :id_status_arriver');
        $req->execute(array(
            'id_status_arriver' => $id_status_arriver,
            'id_status_depart' => $id_status_depart
        ));
        $chemin_status = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if ($chemin_status[$type_user] == "1") {
            return true;
        } else {
            return false;
        }
    }

    // verification code retire_commande
    public static function CheckCodeRetraitCommande($bdd,$code_retrait_commande,$id_commande) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE code_retrait_commande = :code_retrait_commande AND id_commande = :id_commande');
        $req->execute(array(
            'code_retrait_commande' => $code_retrait_commande,
            'id_commande' => $id_commande
        ));
        if (mysql_num_rows($req) > 0) {
            $req->closeCursor();
            return true;
        }
        $req->closeCursor();
        return false;
    }
}
// note : seul le proprio du groupe ou de l'objet peut le creer/supprimer ou changer ses groupes