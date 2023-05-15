<?php
class Checkdroits {
    // verifie si le compte a un des role requis
    public static function CheckRole($bdd, $pseudo, $array_role_requis) {
        $req = $bdd->prepare('SELECT liste_type_role.nom FROM liste_type_role INNER JOIN joueurs ON joueurs.id_table_select_role = liste_type_role.id_table_select_role WHERE joueurs.pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (in_array($login['id_table_select_role'], $array_role_requis)) {
            return true;
        }
        return false;
    }

    // verifie le mot de passe du compte
    public static function CheckPassword($bdd, $nom, $mdp,$isapikey=false) {
        #si isapikey=TRUE compare avec la table api
        #si isapikey=FALSE compare avec la table joueurs
        #autre compare avec la table livreurs

        if ($isapikey) {
            $req = $bdd->prepare('SELECT mdp FROM keyapi WHERE nom = :nom');
        } else {
            $req = $bdd->prepare('SELECT mdp FROM joueurs WHERE pseudo = :nom');
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

    // verifie le token du compte 
	public function CheckToken($bdd, $nom, $token) {
        $req = $bdd->prepare('SELECT resettoken FROM joueurs WHERE pseudo = :pseudo');
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
        INNER JOIN liste_droits ON liste_droits.id_droit = keyapis_droits.id_droit 
        WHERE keyapis.nom = :nom AND liste_droits.nom = :action');
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
    public static function CheckPermObj($bdd, $idnom, $idobjet, $type, $action ,$bool_api) {
        if ($bool_api)
        {
            // si compte est membre d'un groupe d'on l'objet est membre (si login keyapi)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si api et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT * FROM '.$type.'s
            INNER JOIN groupes_'.$type.' ON '.$type.'s.id_'.$type.' = groupes_'.$type.'.id_'.$type.'
            INNER JOIN groupes_keyapis    ON groupes_'.$type.'.id_groupe = groupes_keyapis.id_groupe
            INNER JOIN keyapis           ON keyapis.id_keyapi = groupes_keyapis.id_keyapi
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'.id_groupe
            INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND liste_droits.nom = :action AND keyapis.id_keyapi = :idnom');
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
            INNER JOIN groupes_'.$type.' ON '.$type.'s.id_'.$type.' = groupes_'.$type.'.id_'.$type.'
            INNER JOIN groupes_joueur    ON groupes_'.$type.'.id_groupe = groupes_joueur.id_groupe
            INNER JOIN joueurs           ON joueurs.id_joueur = groupes_joueur.id_joueur
            INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'.id_groupe
            INNER JOIN liste_droits     ON liste_droits.id_droit = groupes_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND liste_droits.nom = :action AND joueurs.id_joueur = :idnom');
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
    public static function CheckArgs($args_send, $args_need) {
        foreach ($args_need as $arg) {
            if (!isset($args_send[$arg])) {
                return false;
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
    public static function CheckCodeRetraitCommande($bdd,$code_retrait,$id_commande) {
        $req = $bdd->prepare('SELECT * FROM commandes WHERE code_retrait = :code_retrait AND id_commande = :id_commande');
        $req->execute(array(
            'code_retrait' => $code_retrait,
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