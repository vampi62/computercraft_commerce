<?php
class Checkdroits
{
    public static function check_role($bdd, $nom, $array_role_reqis)
    {
        $req = $bdd->prepare('SELECT id_table_select_role FROM utilisateurs WHERE nom = :nom');
        $req->execute(array(
            'nom' => $nom
        ));
        $req = $req->fetch(PDO::FETCH_ASSOC);
        if (in_array($req['id_table_select_role'], $array_role_reqis))
        {
            return true;
        }
        return false;
    }

    public static function check_password($bdd, $nom, $mdp,$bool_api)
    {
        #si bool_api=true compare avec la table api
        #si bool_api=false compare avec la table utilisateurs

        if ($bool_api)
        {
            $req = $bdd->prepare('SELECT mdp FROM keyapi WHERE nom = :nom');
        }
        else
        {
            $req = $bdd->prepare('SELECT mdp FROM utilisateurs WHERE nom = :nom');
        }
        $req->execute(array(
            'nom' => $nom
        ));
        $req = $req->fetch(PDO::FETCH_ASSOC);
		if(!empty($req)) {
			if(password_verify($mdp, $req['mdp'])) {
				return true;
			}
		}
        return false;
    }

    public static function check_perm_api($bdd, $nom, $action)
    {
        $req = $bdd->prepare('SELECT * FROM keyapi INNER JOIN keyapi_droits ON keyapi.id_keyapi = keyapi_droits.id_keyapi INNER JOIN liste_droits ON liste_droits.id_droit = keyapi_droits.id_droit WHERE keyapi.nom = :nom AND liste_droits.nom = :action');
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

    public static function check_perm_obj($bdd, $idnom, $idobjet, $type, $action ,$bool_api)
    {
        if ($bool_api)
        {
            // si compte est membre d'un groupe d'on l'objet est membre (si login apikey)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si api et obj sont dans un meme groupe qui permet l'action alors return true
            $req = $bdd->prepare('SELECT * FROM '.$type.'s
            INNER JOIN groupe_'.$type.' ON '.$type.'s.id_'.$type.' = groupe_'.$type.'.id_'.$type.'
            INNER JOIN groupe_keyapi    ON groupe_'.$type.'.id_groupe = groupe_keyapi.id_groupe
            INNER JOIN keyapi           ON keyapi.id_keyapi = groupe_keyapi.id_keyapi
            INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_'.$type.'.id_groupe
            INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND liste_droits.nom = :action AND keyapi.id_keyapi = :idnom');
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
            INNER JOIN groupe_'.$type.' ON '.$type.'s.id_'.$type.' = groupe_'.$type.'.id_'.$type.'
            INNER JOIN groupe_utilisateur    ON groupe_'.$type.'.id_groupe = groupe_utilisateur.id_groupe
            INNER JOIN utilisateurs           ON utilisateurs.id_utilisateur = groupe_utilisateur.id_utilisateur
            INNER JOIN groupe_droits    ON groupe_droits.id_groupe = groupe_'.$type.'.id_groupe
            INNER JOIN liste_droits     ON liste_droits.id_droit = groupe_droits.id_droit
            WHERE '.$type.'s.id_'.$type.' = :idobjet AND liste_droits.nom = :action AND utilisateurs.id_utilisateur = :idnom');
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

    public static function check_proprio_obj($bdd, $idnom, $idobjet, $type)
    {
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
}
// note : seul le proprio du groupe ou de l'objet peut le creer/supprimer ou changer ses groupes