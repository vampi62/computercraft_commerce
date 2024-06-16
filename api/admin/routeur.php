<?php
require_once 'class/router.class.php';
$router = new Router();
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
        //getcommandesbystatus              -> GET /commandes/status/{id_status}
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
        $router->add('/api/config', ['controller' => 'config', 'action' => 'getconfig']);
        $router->add('/api/ntp', ['controller' => 'ntp', 'action' => 'getntp']);
        $router->add('/api/adresse/{id_adresse:\d+}', ['controller' => 'adresse', 'action' => 'getadressebyid']);
        $router->add('/api/adresses/joueur/{id_joueur:\d+}', ['controller' => 'adresse', 'action' => 'getadressesbyjoueur']);
        $router->add('/api/apikey/{id_apikey:\d+}', ['controller' => 'apikey', 'action' => 'getapikeybyid']);
        $router->add('/api/apikey/{id_apikey:\d+}/droits', ['controller' => 'apikey', 'action' => 'getdroitsbyapikey']);
        $router->add('/api/apikeys/joueur/{id_joueur:\d+}', ['controller' => 'apikey', 'action' => 'getapikeysbyjoueur']);
        $router->add('/api/commande/{id_commande:\d+}', ['controller' => 'commande', 'action' => 'getcommandebyid']);
        $router->add('/api/commandes/adresse/{id_adresse:\d+}', ['controller' => 'commande', 'action' => 'getcommandesbyadresse']);
        $router->add('/api/commandes/adresse/{id_adresse:\d+}/client', ['controller' => 'commande', 'action' => 'getcommandesbyadresseclient']);
        $router->add('/api/commandes/adresse/{id_adresse:\d+}/vendeur', ['controller' => 'commande', 'action' => 'getcommandesbyadressevendeur']);
        $router->add('/api/commandes/compte/{id_compte:\d+}', ['controller' => 'commande', 'action' => 'getcommandesbycompte']);
        $router->add('/api/commandes/compte/{id_compte:\d+}/client', ['controller' => 'commande', 'action' => 'getcommandesbycompteclient']);
        $router->add('/api/commandes/compte/{id_compte:\d+}/vendeur', ['controller' => 'commande', 'action' => 'getcommandesbycomptevendeur']);
        $router->add('/api/commandes/livreur/{id_livreur:\d+}', ['controller' => 'commande', 'action' => 'getcommandesbylivreur']);
        $router->add('/api/commandes/offre/{id_offre:\d+}', ['controller' => 'commande', 'action' => 'getcommandesbyoffre']);
        $router->add('/api/commandes/status/{id_status:\d+}', ['controller' => 'commande', 'action' => 'getcommandesbystatus']);
        $router->add('/api/compte/{id_compte:\d+}', ['controller' => 'compte', 'action' => 'getcomptebyid']);
        $router->add('/api/comptes/joueur/{id_joueur:\d+}', ['controller' => 'compte', 'action' => 'getcomptesbyjoueur']);
        $router->add('/api/enderstorageschest', ['controller' => 'enderstorageschest', 'action' => 'getenderstorageschest']);
        $router->add('/api/enderstorageschest/{id_enderstorageschest:\d+}', ['controller' => 'enderstorageschest', 'action' => 'getenderstorageschestbyid']);
        $router->add('/api/enderstorageschest/joueur/{id_joueur:\d+}', ['controller' => 'enderstorageschest', 'action' => 'getenderstorageschestbyjoueur']);
        $router->add('/api/enderstorageschest/dispo', ['controller' => 'enderstorageschest', 'action' => 'getenderstorageschestdispo']);
        $router->add('/api/enderstoragestank', ['controller' => 'enderstoragestank', 'action' => 'getenderstoragestank']);
        $router->add('/api/enderstoragestank/{id_enderstoragestank:\d+}', ['controller' => 'enderstoragestank', 'action' => 'getenderstoragestankbyid']);
        $router->add('/api/enderstoragestank/joueur/{id_joueur:\d+}', ['controller' => 'enderstoragestank', 'action' => 'getenderstoragestankbyjoueur']);
        $router->add('/api/enderstoragestank/dispo', ['controller' => 'enderstoragestank', 'action' => 'getenderstoragestankdispo']);
        $router->add('/api/groupe/{id_groupe:\d+}/adresses', ['controller' => 'groupe', 'action' => 'getadressesbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/apikeys', ['controller' => 'groupe', 'action' => 'getapikeysbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/comptes', ['controller' => 'groupe', 'action' => 'getcomptesbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/droits', ['controller' => 'groupe', 'action' => 'getdroitsbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}', ['controller' => 'groupe', 'action' => 'getgroupebyid']);
        $router->add('/api/groupes/adresse/{id_adresse:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbyadresse']);
        $router->add('/api/groupes/apikey/{id_apikey:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbyapikey']);
        $router->add('/api/groupes/compte/{id_compte:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbycompte']);
        $router->add('/api/groupes/joueur/{id_joueur:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbyjoueur']);
        $router->add('/api/groupes/joueurmembre/{id_joueur:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbyjoueurmembre']);
        $router->add('/api/groupes/livreur/{id_livreur:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbylivreur']);
        $router->add('/api/groupes/offre/{id_offre:\d+}', ['controller' => 'groupe', 'action' => 'getgroupesbyoffre']);
        $router->add('/api/groupe/{id_groupe:\d+}/joueurs', ['controller' => 'groupe', 'action' => 'getjoueursbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/livreurs', ['controller' => 'groupe', 'action' => 'getlivreursbygroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/offres', ['controller' => 'groupe', 'action' => 'getoffresbygroupe']);
        $router->add('/api/jeton/joueur/{id_joueur:\d+}', ['controller' => 'jeton', 'action' => 'getjetonbyjoueur']);
        $router->add('/api/jetons', ['controller' => 'jeton', 'action' => 'getjetons']);
        $router->add('/api/joueur/{id_joueur:\d+}', ['controller' => 'joueur', 'action' => 'getjoueurbyid']);
        $router->add('/api/joueur/pseudo/{pseudo}', ['controller' => 'joueur', 'action' => 'getjoueurbypseudo']);
        $router->add('/api/joueurs', ['controller' => 'joueur', 'action' => 'getjoueurs']);
        $router->add('/api/keypay/{id_keypay:\d+}', ['controller' => 'keypay', 'action' => 'getkeypaybyid']);
        $router->add('/api/keypays/offre/{id_offre:\d+}', ['controller' => 'keypay', 'action' => 'getkeypaysbyoffre']);
        $router->add('/api/litigemsgs/commande/{id_commande:\d+}', ['controller' => 'litigemsg', 'action' => 'getlitigemsgsbycommande']);
        $router->add('/api/livreur/{id_livreur:\d+}', ['controller' => 'livreur', 'action' => 'getlivreurbyid']);
        $router->add('/api/livreurs/adresse/{id_adresse:\d+}', ['controller' => 'livreur', 'action' => 'getlivreursbyadresse']);
        $router->add('/api/livreurs/compte/{id_compte:\d+}', ['controller' => 'livreur', 'action' => 'getlivreursbycompte']);
        $router->add('/api/livreurs/joueur/{id_joueur:\d+}', ['controller' => 'livreur', 'action' => 'getlivreursbyjoueur']);
        $router->add('/api/offre/{id_offre:\d+}', ['controller' => 'offre', 'action' => 'getoffrebyid']);
        $router->add('/api/offres', ['controller' => 'offre', 'action' => 'getoffres']);
        $router->add('/api/offres/adresse/{id_adresse:\d+}', ['controller' => 'offre', 'action' => 'getoffresbyadresse']);
        $router->add('/api/offres/compte/{id_compte:\d+}', ['controller' => 'offre', 'action' => 'getoffresbycompte']);
        $router->add('/api/offres/joueur/{id_joueur:\d+}', ['controller' => 'offre', 'action' => 'getoffresbyjoueur']);
        $router->add('/api/transaction/{id_transaction:\d+}', ['controller' => 'transaction', 'action' => 'gettransactionbyid']);
        $router->add('/api/transactions/admin/{id_admin:\d+}', ['controller' => 'transaction', 'action' => 'gettransactionsbyadmin']);
        $router->add('/api/transactions/commande/{id_commande:\d+}', ['controller' => 'transaction', 'action' => 'gettransactionsbycommande']);
        $router->add('/api/transactions/compte/{id_compte:\d+}', ['controller' => 'transaction', 'action' => 'gettransactionsbycompte']);
        $router->add('/api/wireless', ['controller' => 'wireless', 'action' => 'getwireless']);
        $router->add('/api/wireless/{id_wireless:\d+}', ['controller' => 'wireless', 'action' => 'getwirelessbyid']);
        $router->add('/api/wireless/joueur/{id_joueur:\d+}', ['controller' => 'wireless', 'action' => 'getwirelessbyjoueur']);
        $router->add('/api/wireless/dispo', ['controller' => 'wireless', 'action' => 'getwirelessdispo']);
        $resultEND = $router->dispatch($_SERVER['REQUEST_URI']);
        foreach ($resultEND[0] as $key => $value) {
            $_GET[$key] = $value;
        }
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
        $router->add('/api/adresse', ['controller' => 'adresse', 'action' => 'addadresse']);
        $router->add('/api/apikey', ['controller' => 'apikey', 'action' => 'addapikey']);
        $router->add('/api/apikey/{id_apikey:\d+}/droit/{id_droit:\d+}', ['controller' => 'apikey', 'action' => 'addapikeydroit']);
        $router->add('/api/commande', ['controller' => 'commande', 'action' => 'addcommande']);
        $router->add('/api/compte', ['controller' => 'compte', 'action' => 'addcompte']);
        $router->add('/api/groupe', ['controller' => 'groupe', 'action' => 'addgroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/adresse/{id_adresse:\d+}', ['controller' => 'groupe', 'action' => 'addgroupeadresse']);
        $router->add('/api/groupe/{id_groupe:\d+}/apikey/{id_apikey:\d+}', ['controller' => 'groupe', 'action' => 'addgroupeapikey']);
        $router->add('/api/groupe/{id_groupe:\d+}/compte/{id_compte:\d+}', ['controller' => 'groupe', 'action' => 'addgroupecompte']);
        $router->add('/api/groupe/{id_groupe:\d+}/droit/{id_droit:\d+}', ['controller' => 'groupe', 'action' => 'addgroupedroit']);
        $router->add('/api/groupe/{id_groupe:\d+}/joueur/{id_joueur:\d+}', ['controller' => 'groupe', 'action' => 'addgroupejoueur']);
        $router->add('/api/groupe/{id_groupe:\d+}/livreur/{id_livreur:\d+}', ['controller' => 'groupe', 'action' => 'addgroupelivreur']);
        $router->add('/api/groupe/{id_groupe:\d+}/offre/{id_offre:\d+}', ['controller' => 'groupe', 'action' => 'addgroupeoffre']);
        $router->add('/api/joueur', ['controller' => 'joueur', 'action' => 'addjoueur']);
        $router->add('/api/litigemsg', ['controller' => 'litigemsg', 'action' => 'addlitigemsg']);
        $router->add('/api/livreur', ['controller' => 'livreur', 'action' => 'addlivreur']);
        $router->add('/api/offre', ['controller' => 'offre', 'action' => 'addoffre']);
        $router->add('/api/transaction', ['controller' => 'transaction', 'action' => 'addtransaction']);
        $router->add('/api/banqueterminal', ['controller' => 'banqueterminal', 'action' => 'addbanqueterminal']);
        $resultEND = $router->dispatch($_SERVER['REQUEST_URI']);
        foreach ($resultEND[0] as $key => $value) {
            $_POST[$key] = $value;
        }
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
        $router->add('/api/adresse/{id_adresse:\d+}/coo', ['controller' => 'adresse', 'action' => 'editadressecoo']);
        $router->add('/api/adresse/{id_adresse:\d+}/description', ['controller' => 'adresse', 'action' => 'editadressedescription']);
        $router->add('/api/adresse/{id_adresse:\d+}/nom', ['controller' => 'adresse', 'action' => 'editadressenom']);
        $router->add('/api/apikey/{id_apikey:\d+}/mdp', ['controller' => 'apikey', 'action' => 'editapikeymdp']);
        $router->add('/api/apikey/{id_apikey:\d+}/nom', ['controller' => 'apikey', 'action' => 'editapikeynom']);
        $router->add('/api/commande/{id_commande:\d+}/coderetrait', ['controller' => 'commande', 'action' => 'editcommandecoderetrait']);
        $router->add('/api/commande/{id_commande:\d+}/datelivraison', ['controller' => 'commande', 'action' => 'editcommandedatelivraison']);
        $router->add('/api/commande/{id_commande:\d+}/livreur', ['controller' => 'commande', 'action' => 'editcommandelivreur']);
        $router->add('/api/commande/{id_commande:\d+}/status', ['controller' => 'commande', 'action' => 'editcommandestatus']);
        $router->add('/api/compte/{id_compte:\d+}/nom', ['controller' => 'compte', 'action' => 'editcomptenom']);
        $router->add('/api/enderstorageschest/{id_enderstorageschest:\d+}', ['controller' => 'enderstorageschest', 'action' => 'editenderstorageschest']);
        $router->add('/api/enderstoragestank/{id_enderstoragestank:\d+}', ['controller' => 'enderstoragestank', 'action' => 'editenderstoragestank']);
        $router->add('/api/groupe/{id_groupe:\d+}/nom', ['controller' => 'groupe', 'action' => 'editgroupenom']);
        $router->add('/api/jeton/{id_jeton:\d+}', ['controller' => 'jeton', 'action' => 'editjeton']);
        $router->add('/api/joueur/{id_joueur:\d+}/email', ['controller' => 'joueur', 'action' => 'editjoueuremail']);
        $router->add('/api/joueur/{id_joueur:\d+}/mdp', ['controller' => 'joueur', 'action' => 'editjoueurmdp']);
        $router->add('/api/joueur/{id_joueur:\d+}/nbroffre', ['controller' => 'joueur', 'action' => 'editjoueurnbroffre']);
        $router->add('/api/joueur/{id_joueur:\d+}/pseudo', ['controller' => 'joueur', 'action' => 'editjoueurpseudo']);
        $router->add('/api/joueur/{id_joueur:\d+}/role', ['controller' => 'joueur', 'action' => 'editjoueurrole']);
        $router->add('/api/livreur/{id_livreur:\d+}/adresse', ['controller' => 'livreur', 'action' => 'editlivreuradresse']);
        $router->add('/api/livreur/{id_livreur:\d+}/compte', ['controller' => 'livreur', 'action' => 'editlivreurcompte']);
        $router->add('/api/livreur/{id_livreur:\d+}/nom', ['controller' => 'livreur', 'action' => 'editlivreurnom']);
        $router->add('/api/offre/{id_offre:\d+}/adresse', ['controller' => 'offre', 'action' => 'editoffreadresse']);
        $router->add('/api/offre/{id_offre:\d+}/compte', ['controller' => 'offre', 'action' => 'editoffrecompte']);
        $router->add('/api/offre/{id_offre:\d+}/description', ['controller' => 'offre', 'action' => 'editoffredescription']);
        $router->add('/api/offre/{id_offre:\d+}/nom', ['controller' => 'offre', 'action' => 'editoffrenom']);
        $router->add('/api/offre/{id_offre:\d+}/prix', ['controller' => 'offre', 'action' => 'editoffreprix']);
        $router->add('/api/offre/{id_offre:\d+}/stock', ['controller' => 'offre', 'action' => 'editoffrestock']);
        $router->add('/api/offre/{id_offre:\d+}/type', ['controller' => 'offre', 'action' => 'editoffretype']);
        $router->add('/api/wireless/{id_wireless:\d+}', ['controller' => 'wireless', 'action' => 'editwireless']);
        $resultEND = $router->dispatch($_SERVER['REQUEST_URI']);
        foreach ($resultEND[0] as $key => $value) {
            $_POST[$key] = $value;
        }
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
        $router->add('/api/adresse/{id_adresse:\d+}', ['controller' => 'adresse', 'action' => 'deleteadresse']);
        $router->add('/api/apikey/{id_apikey:\d+}', ['controller' => 'apikey', 'action' => 'deleteapikey']);
        $router->add('/api/apikey/{id_apikey:\d+}/droit/{id_droit:\d+}', ['controller' => 'apikey', 'action' => 'deleteapikeydroit']);
        $router->add('/api/compte/{id_compte:\d+}', ['controller' => 'compte', 'action' => 'deletecompte']);
        $router->add('/api/groupe/{id_groupe:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupe']);
        $router->add('/api/groupe/{id_groupe:\d+}/adresse/{id_adresse:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupeadresse']);
        $router->add('/api/groupe/{id_groupe:\d+}/apikey/{id_apikey:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupeapikey']);
        $router->add('/api/groupe/{id_groupe:\d+}/compte/{id_compte:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupecompte']);
        $router->add('/api/groupe/{id_groupe:\d+}/droit/{id_droit:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupedroit']);
        $router->add('/api/groupe/{id_groupe:\d+}/joueur/{id_joueur:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupejoueur']);
        $router->add('/api/groupe/{id_groupe:\d+}/livreur/{id_livreur:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupelivreur']);
        $router->add('/api/groupe/{id_groupe:\d+}/offre/{id_offre:\d+}', ['controller' => 'groupe', 'action' => 'deletegroupeoffre']);
        $router->add('/api/jeton/{id_jeton:\d+}', ['controller' => 'jeton', 'action' => 'deletejeton']);
        $router->add('/api/joueur/{id_joueur:\d+}', ['controller' => 'joueur', 'action' => 'deletejoueur']);
        $router->add('/api/litigemsg/{id_litigemsg:\d+}', ['controller' => 'litigemsg', 'action' => 'deletelitigemsg']);
        $router->add('/api/livreur/{id_livreur:\d+}', ['controller' => 'livreur', 'action' => 'deletelivreur']);
        $router->add('/api/offre/{id_offre:\d+}', ['controller' => 'offre', 'action' => 'deleteoffre']);
        $resultEND = $router->dispatch($_SERVER['REQUEST_URI']);
        foreach ($resultEND[0] as $key => $value) {
            $_POST[$key] = $value;
        }
    break;
    default:
        return array('status_code' => 405, 'message' => 'Méthode non autorisée.');
    break;
}
if ($resultEND[1] == '') {
    $printmessage = array('status_code' => 404, 'message' => 'Not Found');
} else {
    $endpoint = 'admin' . $resultEND[1];
    if (file_exists($endpoint)) {
        $printmessage = require($endpoint);
    } else {
        $printmessage = array('status_code' => 405, 'message' => 'Méthode inconue.');
    }
}
$printmessage['debug'] = $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'];
if (isset($endpoint)) {
    $printmessage['endpoint'] = $endpoint;
}
return $printmessage;