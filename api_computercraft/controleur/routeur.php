<?php
$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
// tant que entrypoint n'est pas egal a api_computercraft on continue le shift
$pathlocal = array_shift($request);
while ($pathlocal != 'api_computercraft') {
    $pathlocal = array_shift($request);
} // on vide l'uri des sous dossiers jusqu'a arriver a api_computercraft
// si le dernier caractère de $endpoint est un 's', on le supprime
if (count($request) == 0) {
    return array('status_code' => 405, 'message' => 'Méthode non autorisée.');
}
if (strpos($request[0], '?') !== false) {
    $request[0] = substr($request[0], 0, strpos($request[0], '?'));
}
$endpoint = array_shift($request);
if (substr($endpoint, -1) == 's') {
    if (substr($endpoint, -2) == 'ss') {
        $dossier = $endpoint;
    } else {
        $dossier = substr($endpoint, 0, -1);
    }
} else {
    $dossier = $endpoint;
}
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        //getconfig                         -> GET /config
        //getntp                            -> GET /ntp
        //getadressebyid                    -> GET /adresse/{id_adresse}
        //getadresses                       -> GET /adresses
        //getadressesbygroupe               -> GET /adresses/groupe/{id_groupe}
        //getapikeybyid                     -> GET /apikey/{id_apikey}
        //getapikeys                        -> GET /apikeys
        //getapikeysbygroupe                -> GET /apikeys/groupe/{id_groupe}
        //getdroitsbyapikey                 -> GET /apikey/{id_apikey}/droits
        //getcommandebyid                   -> GET /commande/{id_commande}
        //getcommandesbyadresse             -> GET /commandes/adresse/{id_adresse}
        //getcommandesbyadresseclient       -> GET /commandes/adresse/{id_adresse}/client
        //getcommandesbyadressevendeur      -> GET /commandes/adresse/{id_adresse}/vendeur
        //getcommandesbycompte              -> GET /commandes/compte/{id_compte}
        //getcommandesbycompteclient        -> GET /commandes/compte/{id_compte}/client
        //getcommandesbycomptevendeur       -> GET /commandes/compte/{id_compte}/vendeur
        //getcommandesbylivreur             -> GET /commandes/livreur/{id_livreur}
        //getcommandesnolivreur             -> GET /commandes/nolivreur
        //getcommandesbyoffre               -> GET /commandes/offre/{id_offre}
        //getcomptebyid                     -> GET /compte/{id_compte}
        //getcomptes                        -> GET /comptes
        //getcomptesbygroupe                -> GET /comptes/groupe/{id_groupe}
        //getenderstorageschest             -> GET /enderstorageschest
        //getenderstorageschestbyid         -> GET /enderstorageschest/{id_enderstorageschest}
        //getenderstorageschestbyjoueur     -> GET /enderstorageschest/joueur/{id_joueur}
        //getenderstorageschestdispo        -> GET /enderstorageschest/dispo
        //getenderstoragestank              -> GET /enderstoragestank
        //getenderstoragestankbyid          -> GET /enderstoragestank/{id_enderstoragestank}
        //getenderstoragestankbyjoueur      -> GET /enderstoragestank/joueur/{id_joueur}
        //getenderstoragestankdispo         -> GET /enderstoragestank/dispo
        //getdroitsbygroupe                 -> GET /groupe/{id_groupe}/droits
        //getgroupebyid                     -> GET /groupe/{id_groupe}
        //getgroupesbyadresse               -> GET /groupes/adresse/{id_adresse}
        //getgroupesbyapikey                -> GET /groupes/apikey/{id_apikey}
        //getgroupesbycompte                -> GET /groupes/compte/{id_compte}
        //getgroupesbyjoueur                -> GET /groupes/joueur/{id_joueur}
        //getgroupesbyjoueurmembre          -> GET /groupes/joueurmembre/{id_joueur}
        //getgroupesbylivreur               -> GET /groupes/livreur/{id_livreur}
        //getgroupesbyoffre                 -> GET /groupes/offre/{id_offre}
        //getjetonbyjoueur                  -> GET /jeton/joueur/{id_joueur}
        //getjetons                         -> GET /jetons
        //getjoueurbyid                     -> GET /joueur/{id_joueur}
        //getjoueurbypseudo                 -> GET /joueur/pseudo/{pseudo}
        //getjoueurs                        -> GET /joueurs
        //getjoueursbygroupe                -> GET /joueurs/groupe/{id_groupe}
        //getkeypaybyid                     -> GET /keypay/{id_keypay}
        //getkeypaysbyoffre                 -> GET /keypays/offre/{id_offre}
        //getlitigemsgsbycommande           -> GET /litigemsgs/commande/{id_commande}
        //getlivreurbyid                    -> GET /livreur/{id_livreur}
        //getlivreurs                       -> GET /livreurs
        //getlivreursbyadresse              -> GET /livreurs/adresse/{id_adresse}
        //getlivreursbycompte               -> GET /livreurs/compte/{id_compte}
        //getlivreursbygroupe               -> GET /livreurs/groupe/{id_groupe}
        //getoffrebyid                      -> GET /offre/{id_offre}
        //getoffres                         -> GET /offres
        //getoffresall                      -> GET /offres/all
        //getoffresbyadresse                -> GET /offres/adresse/{id_adresse}
        //getoffresbycompte                 -> GET /offres/compte/{id_compte}
        //getoffresbygroupe                 -> GET /offres/groupe/{id_groupe}
        //gettransactionsbycompte           -> GET /transactions/compte/{id_compte}
        //gettransactionsbycomptecommande   -> GET /transactions/compte/{id_compte}/commande/{id_commande}
        //gettransactionbyid                -> GET /transaction/{id_transaction}
        //getwireless                       -> GET /wireless
        //getwirelessbyid                   -> GET /wireless/{id_wireless}
        //getwirelessbyjoueur               -> GET /wireless/joueur/{pseudo_joueur}
        //getwirelessdispo                  -> GET /wireless/dispo
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            # si il y a des parametre get dans l'url on les supprime
            if (strpos($request[0], '?') !== false) {
                $request[0] = substr($request[0], 0, strpos($request[0], '?'));
            }
            if (is_numeric($request[0])) {
                $_GET['id_'.$nomVariable] = array_shift($request);
                if (!strpos($endpoint, 'by')) {
                    if (isset($request[0])) {
                        if (strpos($request[0], '?') !== false) {
                            $request[0] = substr($request[0], 0, strpos($request[0], '?'));
                        }
                        $endpoint = array_shift($request) . 'by' . $endpoint;
                    } else {
                        $endpoint .= 'byid';
                    }
                }
            } else {
                if (!strpos($endpoint, 'by')) {
                    if (isset($request[1])) {
                        $endpoint .= 'by';
                    }
                    $nomVariable = array_shift($request);
                } else {
                    $nomVariable = array_shift($request);
                    if (count($request) > 0 && strpos($request[0], '?') !== false) {
                        $request[0] = substr($request[0], 0, strpos($request[0], '?'));
                    }
                    if (is_numeric($request[0])) {
                        $_GET['id_'.$nomVariable] = array_shift($request);
                    } else {
                        $_GET[$nomVariable] = array_shift($request);
                    }
                }
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'controleur/' . $dossier . '/get' . $endpoint . '.php';
    break;
    case 'POST':
        //addadresse        -> POST /adresse
        //addapikey         -> POST /apikey
        //addapikeydroit    -> POST /apikey/{id_apikey}/droit/{id_droit}
        //addcommande       -> POST /commande
        //addcompte         -> POST /compte
        //addgroupe         -> POST /groupe
        //addgroupeadresse  -> POST /groupe/{id_groupe}/adresse/{id_adresse}
        //addgroupeapikey   -> POST /groupe/{id_groupe}/apikey/{id_apikey}
        //addgroupecompte   -> POST /groupe/{id_groupe}/compte/{id_compte}
        //addgroupedroit    -> POST /groupe/{id_groupe}/droit/{id_droit}
        //addgroupejoueur   -> POST /groupe/{id_groupe}/joueur/{id_joueur}
        //addgroupelivreur  -> POST /groupe/{id_groupe}/livreur/{id_livreur}
        //addgroupeoffre    -> POST /groupe/{id_groupe}/offre/{id_offre}
        //addjoueur         -> POST /joueur
        //addkeypay         -> POST /keypay
        //addlitigemsg      -> POST /litigemsg
        //addlivreur        -> POST /livreur
        //addoffre          -> POST /offre
        //addtransaction    -> POST /transaction
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'controleur/' . $dossier . '/add' . $endpoint . '.php';
    break;
    case 'PUT':
        //editadressecoo                -> PUT /adresse/{id_adresse}/coo
        //editadressedescription        -> PUT /adresse/{id_adresse}/description
        //editadressenom                -> PUT /adresse/{id_adresse}/nom
        //editapikeymdp                 -> PUT /apikey/{id_apikey}/mdp
        //editapikeynom                 -> PUT /apikey/{id_apikey}/nom
        //editcommandelivreur           -> PUT /commande/{id_commande}/livreur
        //editcommandestatus            -> PUT /commande/{id_commande}/status
        //editcomptenom                 -> PUT /compte/{id_compte}/nom
        //editenderstorageschest        -> PUT /enderstorageschest/{id_enderstorageschest}
        //editenderstoragestank         -> PUT /enderstoragestank/{id_enderstoragestank}
        //editgroupenom                 -> PUT /groupe/{id_groupe}/nom
        //editjeton                     -> PUT /jeton/{id_jeton}
        //editjoueuremail               -> PUT /joueur/{id_joueur}/email
        //editjoueurmdp                 -> PUT /joueur/{id_joueur}/mdp
        //editjoueurnbroffre            -> PUT /joueur/{id_joueur}/nbroffre
        //editjoueurpseudo              -> PUT /joueur/{id_joueur}/pseudo
        //editjoueurrecupmdpbyemail     -> PUT /joueur/recupmdpbyemail
        //editjoueurrecupmdpbyemailtoken-> PUT /joueur/recupmdpbyemailtoken
        //editlivreuradresse            -> PUT /livreur/{id_livreur}/adresse
        //editlivreurcompte             -> PUT /livreur/{id_livreur}/compte
        //editlivreurnom                -> PUT /livreur/{id_livreur}/nom
        //editoffreadresse              -> PUT /offre/{id_offre}/adresse
        //editoffrecompte               -> PUT /offre/{id_offre}/compte
        //editoffredescription          -> PUT /offre/{id_offre}/description
        //editoffrenom                  -> PUT /offre/{id_offre}/nom
        //editoffreprix                 -> PUT /offre/{id_offre}/prix
        //editoffrestock                -> PUT /offre/{id_offre}/stock
        //editoffretype                 -> PUT /offre/{id_offre}/type
        //editwireless                  -> PUT /wireless/{id_wireless}
        parse_str(file_get_contents("php://input"), $_POST);
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'controleur/' . $dossier . '/edit' . $endpoint . '.php';
    break;
    case 'DELETE':
        //deleteadresse         -> DELETE /adresse/{id_adresse}
        //deleteapikey          -> DELETE /apikey/{id_apikey}
        //deleteapikeydroit     -> DELETE /apikey/{id_apikey}/droit/{id_droit}
        //deletecompte          -> DELETE /compte/{id_compte}
        //deletegroupe          -> DELETE /groupe/{id_groupe}
        //deletegroupeadresse   -> DELETE /groupe/{id_groupe}/adresse/{id_adresse}
        //deletegroupeapikey    -> DELETE /groupe/{id_groupe}/apikey/{id_apikey}
        //deletegroupecompte    -> DELETE /groupe/{id_groupe}/compte/{id_compte}
        //deletegroupedroit     -> DELETE /groupe/{id_groupe}/droit/{id_droit}
        //deletegroupejoueur    -> DELETE /groupe/{id_groupe}/joueur/{id_joueur}
        //deletegroupelivreur   -> DELETE /groupe/{id_groupe}/livreur/{id_livreur}
        //deletegroupeoffre     -> DELETE /groupe/{id_groupe}/offre/{id_offre}
        //deletejoueur          -> DELETE /joueur/{id_joueur}
        //deletelitigemsg       -> DELETE /litigemsg/{id_litigemsg}
        //deletelivreur         -> DELETE /livreur/{id_livreur}
        //deleteoffre           -> DELETE /offre/{id_offre}
        parse_str(file_get_contents("php://input"), $_POST);
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'controleur/' . $dossier . '/delete' . $endpoint . '.php';
    break;
    default:
        return array('status_code' => 405, 'message' => 'Méthode non autorisée.');
    break;
}
if (file_exists($endpoint)) {
    $printmessage = require($endpoint);
} else {
    $printmessage = array('status_code' => 405, 'message' => 'Méthode inconue.');
}
$printmessage['debug'] = $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'];
$printmessage['endpoint'] = $endpoint;
return $printmessage;