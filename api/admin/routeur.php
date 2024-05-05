<?php
$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
// tant que entrypoint n'est pas egal a api on continue le shift
do {
    $pathlocal = array_shift($request);
} while ($pathlocal != 'api' && count($request) > 0);
// on vide l'uri des sous dossiers jusqu'a arriver a api
if (count($request) == 0) {
    return array('status_code' => 405, 'message' => 'Méthode non autorisée.');
}
if (strpos($request[0], '?') !== false) {
    $request[0] = substr($request[0], 0, strpos($request[0], '?'));
}
// si le dernier caractère de $endpoint est un 's', on le supprime
$endpoint = array_shift($request);
if (substr($endpoint, -1) == 's') {
    if (substr($endpoint, -2) == 'ss') { // exception pour "wireless"
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
        //getadressesbyjoueur               -> GET /adresses/joueur/{id_joueur}
        //getapikeybyid                     -> GET /apikey/{id_apikey}
        //getdroitsbyapikey                 -> GET /apikey/{id_apikey}/droits
        //getapikeysbyjoueur                -> GET /apikeys/joueur/{id_joueur}
        //getcommandebyid                   -> GET /commande/{id_commande}
        //getcommandesbyadresse             -> GET /commandes/adresse/{id_adresse}
        //getcommandesbyadresseclient       -> GET /commandes/adresse/{id_adresse}/client
        //getcommandesbyadressevendeur      -> GET /commandes/adresse/{id_adresse}/vendeur
        //getcommandesbycompte              -> GET /commandes/compte/{id_compte}
        //getcommandesbycompteclient        -> GET /commandes/compte/{id_compte}/client
        //getcommandesbycomptevendeur       -> GET /commandes/compte/{id_compte}/vendeur
        //getcommandesbylivreur             -> GET /commandes/livreur/{id_livreur}
        //getcommandesbyoffre               -> GET /commandes/offre/{id_offre}
        //getcommandesbystatus              -> GET /commandes/status/{status}
        //getcomptebyid                     -> GET /compte/{id_compte}
        //getcomptesbyjoueur                -> GET /comptes/joueur/{id_joueur}
        //getenderstorageschest             -> GET /enderstorageschest
        //getenderstorageschestbyid         -> GET /enderstorageschest/{id_enderstorageschest}
        //getenderstorageschestbyjoueur     -> GET /enderstorageschest/joueur/{id_joueur}
        //getenderstorageschestdispo        -> GET /enderstorageschest/dispo
        //getenderstoragestank              -> GET /enderstoragestank
        //getenderstoragestankbyid          -> GET /enderstoragestank/{id_enderstoragestank}
        //getenderstoragestankbyjoueur      -> GET /enderstoragestank/joueur/{id_joueur}
        //getenderstoragestankdispo         -> GET /enderstoragestank/dispo
        //getadressesbygroupe               -> GET /groupe/{id_groupe}/adresses
        //getapikeysbygroupe                -> GET /groupe/{id_groupe}/apikeys
        //getcomptesbygroupe                -> GET /groupe/{id_groupe}/comptes
        //getdroitsbygroupe                 -> GET /groupe/{id_groupe}/droits
        //getgroupebyid                     -> GET /groupe/{id_groupe}
        //getgroupesbyadresse               -> GET /groupes/adresse/{id_adresse}
        //getgroupesbyapikey                -> GET /groupes/apikey/{id_apikey}
        //getgroupesbycompte                -> GET /groupes/compte/{id_compte}
        //getgroupesbyjoueur                -> GET /groupes/joueur/{id_joueur}
        //getgroupesbyjoueurmembre          -> GET /groupes/joueurmembre/{id_joueur}
        //getgroupesbylivreur               -> GET /groupes/livreur/{id_livreur}
        //getgroupesbyoffre                 -> GET /groupes/offre/{id_offre}
        //getjoueursbygroupe                -> GET /groupe/{id_groupe}/joueurs
        //getlivreursbygroupe               -> GET /groupe/{id_groupe}/livreurs
        //getoffresbygroupe                 -> GET /groupe/{id_groupe}/offres
        //getjetonbyjoueur                  -> GET /jeton/joueur/{id_joueur}
        //getjetons                         -> GET /jetons
        //getjoueurbyid                     -> GET /joueur/{id_joueur}
        //getjoueurbypseudo                 -> GET /joueur/pseudo/{pseudo}
        //getjoueurs                        -> GET /joueurs
        //getkeypaybyid                     -> GET /keypay/{id_keypay}
        //getkeypaysbyoffre                 -> GET /keypays/offre/{id_offre}
        //getlitigemsgsbycommande           -> GET /litigemsgs/commande/{id_commande}
        //getlivreurbyid                    -> GET /livreur/{id_livreur}
        //getlivreursbyadresse              -> GET /livreurs/adresse/{id_adresse}
        //getlivreursbycompte               -> GET /livreurs/compte/{id_compte}
        //getlivreursbyjoueur               -> GET /livreurs/joueur/{id_joueur}
        //getoffrebyid                      -> GET /offre/{id_offre}
        //getoffres                         -> GET /offres
        //getoffresbyadresse                -> GET /offres/adresse/{id_adresse}
        //getoffresbycompte                 -> GET /offres/compte/{id_compte}
        //getoffresbyjoueur                 -> GET /offres/joueur/{id_joueur}
        //gettransactionbyid                -> GET /transaction/{id_transaction}
        //gettransactionsbyadmin            -> GET /transactions/admin/{id_admin}
        //gettransactionsbycommande         -> GET /transactions/commande/{id_commande}
        //gettransactionsbycompte           -> GET /transactions/compte/{id_compte}
        //getwireless                       -> GET /wireless
        //getwirelessbyid                   -> GET /wireless/{id_wireless}
        //getwirelessbyjoueur               -> GET /wireless/joueur/{id_joueur}
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
                    if (count($request) > 0) {
                        if (strpos($request[0], '?') !== false) {
                            $request[0] = substr($request[0], 0, strpos($request[0], '?'));
                        }
                        if (is_numeric($request[0])) {
                            $_GET['id_'.$nomVariable] = array_shift($request);
                        } else {
                            $_GET[$nomVariable] = array_shift($request);
                        }
                    }
                }
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'admin/' . $dossier . '/get' . $endpoint . '.php';
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
        //addlitigemsg      -> POST /litigemsg
        //addlivreur        -> POST /livreur
        //addoffre          -> POST /offre
        //addtransaction    -> POST /transaction
        //addbanqueterminal -> POST /banqueterminal
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            if (strpos($request[0], '?') !== false) {
                $request[0] = substr($request[0], 0, strpos($request[0], '?'));
            }
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'admin/' . $dossier . '/add' . $endpoint . '.php';
    break;
    case 'PUT':
        //editadressecoo                -> PUT /adresse/{id_adresse}/coo
        //editadressedescription        -> PUT /adresse/{id_adresse}/description
        //editadressenom                -> PUT /adresse/{id_adresse}/nom
        //editapikeymdp                 -> PUT /apikey/{id_apikey}/mdp
        //editapikeynom                 -> PUT /apikey/{id_apikey}/nom
        //editcommandecoderetrait       -> PUT /commande/{id_commande}/coderetrait
        //editcommandedatelivraison     -> PUT /commande/{id_commande}/datelivraison
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
        //editjoueurrole                -> PUT /joueur/{id_joueur}/role
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
            if (strpos($request[0], '?') !== false) {
                $request[0] = substr($request[0], 0, strpos($request[0], '?'));
            }
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'admin/' . $dossier . '/edit' . $endpoint . '.php';
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
        //deletejeton           -> DELETE /jeton/{id_jeton}
        //deletejoueur          -> DELETE /joueur/{id_joueur}
        //deletelitigemsg       -> DELETE /litigemsg/{id_litigemsg}
        //deletelivreur         -> DELETE /livreur/{id_livreur}
        //deleteoffre           -> DELETE /offre/{id_offre}
        parse_str(file_get_contents("php://input"), $_POST);
        $nomVariable = $endpoint;
        while (count($request) > 0) {
            if (strpos($request[0], '?') !== false) {
                $request[0] = substr($request[0], 0, strpos($request[0], '?'));
            }
            if (is_numeric($request[0])) {
                $_POST['id_'.$nomVariable] = array_shift($request);
            } else {
                $nomVariable = array_shift($request);
                $endpoint .= $nomVariable;
            }
        }
        $endpoint = 'admin/' . $dossier . '/delete' . $endpoint . '.php';
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