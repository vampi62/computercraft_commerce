<?php
class Checkdroits 
{
    public static function checkperm($bdd, $id_objet, $action, $type, $id_user, $idkey = 0)
    {
        if (!$idkey > 0) {
            $req = $bdd->prepare('SELECT * FROM groupe_'.$type.' INNER JOIN groupe_keyapi ON groupe_'.$type.'.id_groupe = groupe_keyapi.id_groupe INNER JOIN keyapi_droits ON keyapi_droits.id_groupe = groupe_keyapi.id_groupe INNER JOIN liste_droits ON liste_droits.id_droit = keyapi_droits.id_droit WHERE groupe_'.$type.'.id_'.$type.' = :id_'.$type . ' AND liste_droits.nom = :action');
            $req->execute(array(
                'id_user' => $id_user,
                'action' => $action
            ));
            if (!mysql_num_rows($req) > 0) {
                $req->closeCursor();
                return false;
            }
        }
        $req = $bdd->prepare('SELECT * FROM '.$type.' WHERE id = :id');
        $req->execute(array(
            'id' => $id_objet
        ));
        $donnees = $req->fetch();
        $req->closeCursor();
        if ($donnees['id_joueur'] == $id_user)
        {
            return true;
        }
        else
        {
            $req = $bdd->prepare('SELECT * FROM groupe_'.$type.' INNER JOIN groupe_joueur ON groupe_'.$type.'.id_groupe = groupe_joueur.id_groupe INNER JOIN groupe_droits ON groupe_droits.id_groupe = groupe_joueur.id_groupe INNER JOIN liste_droits ON liste_droits.id_droit = groupe_droits.id_droit WHERE groupe_'.$type.'.id_'.$type.' = :id_'.$type . ' AND liste_droits.nom = :action');
            $req->execute(array(
                'id_'.$type => $id_objet,
                'action' => $action
            ));
            if (mysql_num_rows($req) > 0) {
                $req->closeCursor();
                return true;
            } else {
                $req->closeCursor();
                return false;
            }
        }
        return false;
    }
}
// si compte est proprio de l'objet
    // -- permet l'action
// si compte est membre d'un groupe d'on l'objet est membre (si login user)
    // si groupe a les droits sur l'objet pour effectuer l'action
        // -- permet l'action

// si compte est membre d'un groupe d'on l'objet est membre (si login apikey)
    // si api key a les droits pour effectuer l'action
        // si groupe a les droits sur l'objet pour effectuer l'action
            // -- permet l'action

// note : seul le proprio du groupe ou de l'objet peut le creer/supprimer ou changer ses groupes