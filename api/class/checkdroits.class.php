<?php
class Checkdroits {
    // verifie si le compte a un des role requis
    public static function checkRole($bdd, $pseudoJoueur, $arrayRoleRequis) {
        $req = $bdd->prepare('SELECT nom_type_joueur FROM vw_joueurs WHERE pseudo_joueur = :pseudo_joueur');
        $req->execute(array(
            'pseudo_joueur' => $pseudoJoueur
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (in_array($login['nom_type_joueur'], $arrayRoleRequis)) {
            return true;
        }
        return false;
    }

    // verifie si l'id indiquer est dans la table
    public static function checkId($bdd, $id, $table) {
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

    // verifie le mode de connexion du compte et son authentification
    public static function checkMode($bdd,$argsSend,$permMethode, $boolPost=false) {
        if (self::checkArgs($argsSend,array('user' => false,'mdpuser' => false), $boolPost)) {
            if (!$permMethode['user']) {
                return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action avec un compte utilisateur.');
            }
            $sessionLogin = self::_checkMdp($bdd, $argsSend['user'], $argsSend['mdpuser']);
            if (!$sessionLogin) {
                return array('status_code' => 403, 'message' => 'identifiant ou mot de passe incorrect.');
            }
            return array('isApi' => false,'idLogin' => $sessionLogin[0],'pseudoLogin' => $sessionLogin[1]);
        } elseif (self::checkArgs($argsSend,array('apikey' => false, 'mdpapikey' => false), $boolPost)) {
            if (!$permMethode['apikey']) {
                return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action avec une apikey.');
            }
            $sessionLogin = self::_checkMdpApi($bdd, $argsSend['apikey'], $argsSend['mdpapikey']);
            if (!$sessionLogin) {
                return array('status_code' => 403, 'message' => 'identifiant ou mot de passe incorrect.');
            }
            return array('isApi' => true,'idLogin' => $sessionLogin[0],'pseudoLogin' => $sessionLogin[1]);
        } else {
            return array('status_code' => 400, 'message' => 'Il manque des parametres.');
        }
    }

    // verifie la connexion pour un compte admin
    public static function checkAdmin($bdd,$argsSend, $boolPost=false) {
        if (!self::checkArgs($argsSend,array('useradmin' => false,'mdpadmin' => false), $boolPost)) {
            return array('status_code' => 400, 'message' => 'Il manque des parametres.');
        }
        $sessionLogin = self::_checkMdp($bdd, $argsSend['useradmin'], $argsSend['mdpadmin']);
        if (!$sessionLogin) {
            return array('status_code' => 403, 'message' => 'identifiant ou mot de passe incorrect.');
        }
        if (!self::checkRole($bdd, $argsSend['useradmin'], array('admin'))) {
            return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
        }
        return array('isApi' => false,'idLogin' => $sessionLogin[0],'pseudoLogin' => $sessionLogin[1]);
    }

    // verifie la connexion pour une apikey banque
    public static function checkTerminalApi($bdd,$argsSend, $boolPost=false) {
        if (!self::checkArgs($argsSend,array('userbanque' => false,'mdpbanque' => false), $boolPost)) {
            return array('status_code' => 400, 'message' => 'Il manque des parametres.');
        }
        $sessionLogin = self::_checkMdpApi($bdd, $argsSend['userbanque'], $argsSend['mdpbanque']);
        if (!$sessionLogin) {
            return array('status_code' => 403, 'message' => 'identifiant ou mot de passe incorrect.');
        }
        return array('isApi' => true,'idLogin' => $sessionLogin[0],'pseudoLogin' => $sessionLogin[1]);
    }

    // verifie le mot de passe du compte
    private static function _checkMdp($bdd, $nom, $mdp) {
        $req = $bdd->prepare('SELECT id_joueur,mdp_joueur FROM joueurs WHERE pseudo_joueur = :nom');
        $req->execute(array(
            'nom' => $nom
        ));
        $login = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
		if (!empty($login)) {
			if (password_verify($mdp, $login['mdp_joueur'])) {
				return [$login['id_joueur'],$nom];
			}
		}
        return false;
    }

    // verification du mdp de l'api
    private static function _checkMdpApi($bdd,$nomApiKey,$mdpApiKey) {
        $req = $bdd->prepare('SELECT id_apikey,mdp_apikey FROM apikeys WHERE nom_apikey = :nom_apikey');
        $req->execute(array(
            'nom_apikey' => $nomApiKey
        ));
        $api = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
        if (!empty($api)) {
            if ($api['mdp_apikey'] == $mdpApiKey) {
                return [$api['id_apikey'],$nomApiKey];
            }
        }
        return false;
    }

    // verifie si le mot de passe respect les regle de securite
    public static function checkPasswordSecu($mdp) {
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

    // genere un mot de passe aleatoire securise
    public static function generatePassword($length = 16) {
        if ($length < 8) {
            $length = 8;
        }
        $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        if (!self::checkPasswordSecu($result)) {
            return self::generatePassword($length);
        }
        return $result;
    }

    // verifie le token du compte 
	public function checkToken($bdd, $pseudoJoueur, $token) {
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
    public static function checkPermApi($bdd, $nom, $action) {
        $req = $bdd->prepare('SELECT apikeys.id_apikey FROM apikeys 
        INNER JOIN apikeys_droits ON apikeys.id_apikey = apikeys_droits.id_apikey 
        INNER JOIN droits ON droits.id_droit = apikeys_droits.id_droit 
        WHERE apikeys.nom = :nom AND droits.nom_droit = :action
        LIMIT 1');
        $req->execute(array(
            'nom' => $nom,
            'action' => $action
        ));
        $liste = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (!empty($liste)) {
            return true;
        }
        return false;
    }

    // verifie si le compte a la permission d'effectuer l'action sur l'objet
    public static function checkPermObj($bdd, $idNom, $idObjet, $type, $action ,$isApi=false) {
        if ($isApi) {
            // si compte est membre d'un groupe d'on l'objet est membre (si login apikey)
                // si groupe et apikey a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si api et obj sont dans un meme groupe qui permet l'action alors return true
            if ($type == 'groupe') {
                $req = $bdd->prepare('SELECT groupes.id_groupe FROM groupes
                INNER JOIN groupes_apikeys    ON groupes.id_groupe = groupes_apikeys.id_groupe
                INNER JOIN apikeys           ON apikeys.id_apikey = groupes_apikeys.id_apikey
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes.id_groupe
                INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = apikeys.id_apikey
                INNER JOIN droits AS drgroupe  ON drgroupe.id_droit = groupes_droits.id_droit
                INNER JOIN droits AS drapi     ON drapi.id_droit = apikeys_droits.id_droit
                WHERE groupes.id_groupe = :idobjet AND drgroupe.nom_droit = :action AND apikeys.id_apikey = :idnom
                LIMIT 1');
            } elseif ($type == 'apikey') {
                $req = $bdd->prepare('SELECT apikeys.id_apikey FROM apikeys
                INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = apikeys.id_apikey
                INNER JOIN droits     ON droits.id_droit = apikeys_droits.id_droit
                WHERE apikeys.id_apikey = :idobjet AND droits.nom_droit = :action AND apikeys.id_apikey = :idnom
                LIMIT 1');
            } else {
                $req = $bdd->prepare('SELECT '.$type.'s.id_'.$type.' FROM '.$type.'s
                INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
                INNER JOIN groupes_apikeys    ON groupes_'.$type.'s.id_groupe = groupes_apikeys.id_groupe
                INNER JOIN apikeys           ON apikeys.id_apikey = groupes_apikeys.id_apikey
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
                INNER JOIN apikeys_droits    ON apikeys_droits.id_apikey = apikeys.id_apikey
                INNER JOIN droits AS drgroupe  ON drgroupe.id_droit = groupes_droits.id_droit
                INNER JOIN droits AS drapi     ON drapi.id_droit = apikeys_droits.id_droit
                WHERE '.$type.'s.id_'.$type.' = :idobjet AND drgroupe.nom_droit = :action AND apikeys.id_apikey = :idnom
                LIMIT 1');
            }
            $req->execute(array(
                'idobjet' => $idObjet,
                'idnom' => $idNom,
                'action' => $action
            ));
            $liste = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();
            if (!empty($liste)) {
                return true;
            }
            return false;
        } else {
            // si compte est proprio de l'objet
                // -- permet l'action
            // si compte est membre d'un groupe d'on l'objet est membre (si login user)
                // si groupe a les droits sur l'objet pour effectuer l'action
                    // -- permet l'action
            # si user et obj.proprio son identique alors return true
            $isProprio = self::checkProprioObj($bdd, $idNom, $idObjet, $type);
            if ($isProprio) {
                return true;
            }
            return false;
            if ($type == 'groupe') { 
                $req = $bdd->prepare('SELECT groupes.id_groupe FROM groupes
                INNER JOIN groupes_joueur    ON groupes.id_groupe = groupes_joueur.id_groupe
                INNER JOIN joueurs           ON joueurs.id_joueur = groupes_joueur.id_joueur
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes.id_groupe
                INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
                WHERE groupes.id_groupe = :idobjet AND droits.nom_droit = :action AND joueurs.id_joueur = :idnom
                LIMIT 1');
            } else {
                $req = $bdd->prepare('SELECT '.$type.'s.id_'.$type.' FROM '.$type.'s
                INNER JOIN groupes_'.$type.'s ON '.$type.'s.id_'.$type.' = groupes_'.$type.'s.id_'.$type.'
                INNER JOIN groupes_joueur    ON groupes_'.$type.'s.id_groupe = groupes_joueur.id_groupe
                INNER JOIN joueurs           ON joueurs.id_joueur = groupes_joueur.id_joueur
                INNER JOIN groupes_droits    ON groupes_droits.id_groupe = groupes_'.$type.'s.id_groupe
                INNER JOIN droits     ON droits.id_droit = groupes_droits.id_droit
                WHERE '.$type.'s.id_'.$type.' = :idobjet AND droits.nom_droit = :action AND joueurs.id_joueur = :idnom
                LIMIT 1');
            }
            # si user et obj sont dans un meme groupe qui permet l'action alors return true
            $req->execute(array(
                'idobjet' => $idObjet,
                'idnom' => $idNom,
                'action' => $action
            ));
            $liste = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();
            if (!empty($liste)) {
                return true;
            }
            return false;
        }
    }

    // verifie si tous les arguments sont present
    // true si empty est permis
    // exemple --> $args_need = array('mdp' => false, 'email' => true) // mdp obligatoire, email facultatif
    public static function checkArgs($argsSend, $argsNeed, $boolPost=false) {
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
    public static function checkProprioObj($bdd, $idNom, $idObjet, $type) {
        $req = $bdd->prepare('SELECT '.$type.'s.id_'.$type.' FROM '.$type.'s WHERE id_'.$type.' = :idobjet AND id_joueur = :idnom');
        $req->execute(array(
            'idobjet' => $idObjet,
            'idnom' => $idNom
        ));
        $liste = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (!empty($liste)) {
            return true;
        }
        return false;
    }

    // verifie le chemin_type_commandes de la commande
    public static function checkCheminTypeCommande($bdd,$idTypeArriver,$idTypeDepart,$typeUser) {
        $req = $bdd->prepare('SELECT * FROM chemins_type_commandes WHERE id_type_commande_debut = :id_type_commande_debut AND id_type_commande_suite = :id_type_commande_suite');
        $req->execute(array(
            'id_type_commande_suite' => $idTypeArriver,
            'id_type_commande_debut' => $idTypeDepart
        ));
        $cheminTypeCommandes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        for ($i=0; $i < count($cheminTypeCommandes); $i++) {
            if ($cheminTypeCommandes[$i][$typeUser . "_chemin_type_commandes"] == "1") {
                return true;
            }
        }
        return false;
    }

    // verification code retire_commande
    public static function checkCodeRetraitCommande($bdd,$codeRetraitCommande,$idCommande) {
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
}
// note : seul le proprio du groupe ou de l'objet peut le creer/supprimer ou changer ses groupes