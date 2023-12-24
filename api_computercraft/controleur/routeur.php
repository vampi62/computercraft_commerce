<?php
switch(strtolower($_GET['action']))	{
    //getconfig
    //getntp
    case 'getconfig':
        $printmessage = require('getconfig.php');
    break;
    case 'getntp':
        $printmessage = require('getntp.php');
    break;

    //addadresse
    //deleteadresse
    //editadressecoo
    //editadressedescription
    //editadressenom
    //getadressebyid
    //getadresses
    case 'addadresse':
        $printmessage = require('adresse/addadresse.php');
    break;
    case 'deleteadresse':
        $printmessage = require('adresse/deleteadresse.php');
    break;
    case 'editadressecoo':
        $printmessage = require('adresse/editadressecoo.php');
    break;
    case 'editadressedescription':
        $printmessage = require('adresse/editadressedescription.php');
    break;
    case 'editadressenom':
        $printmessage = require('adresse/editadressenom.php');
    break;
    case 'getadressebyid':
        $printmessage = require('adresse/getadressebyid.php');
    break;
    case 'getadresses':
        $printmessage = require('adresse/getadresses.php');
    break;

    //addapikey
    //addapikeydroit
    //deleteapikey
    //deleteapikeydroit
    //editapikeymdp
    //editapikeynom
    //getapikeybyid
    //getapikeydroitsbyid
    //getapikeys
    case 'addapikey':
        $printmessage = require('apikey/addapikey.php');
    break;
    case 'addapikeydroit':
        $printmessage = require('apikey/addapikeydroit.php');
    break;
    case 'deleteapikey':
        $printmessage = require('apikey/deleteapikey.php');
    break;
    case 'deleteapikeydroit':
        $printmessage = require('apikey/deleteapikeydroit.php');
    break;
    case 'editapikeymdp':
        $printmessage = require('apikey/editapikeymdp.php');
    break;
    case 'editapikeynom':
        $printmessage = require('apikey/editapikeynom.php');
    break;
    case 'getapikeybyid':
        $printmessage = require('apikey/getapikeybyid.php');
    break;
    case 'getapikeydroitsbyid':
        $printmessage = require('apikey/getapikeydroitsbyid.php');
    break;
    case 'getapikeys':
        $printmessage = require('apikey/getapikeys.php');
    break;
    
    //addcommande
    //editcommandelivreur
    //editcommandestatus
    //getcommandebyid
    //getcommandesbyadresse
    //getcommandesbyadresseclient
    //getcommandesbyadressevendeur
    //getcommandesbycompte
    //getcommandesbycompteclient
    //getcommandesbycomptevendeur
    //getcommandesbylivreur
    //getcommandesbynolivreur
    //getcommandesbyoffre
    case 'addcommande':
        $printmessage = require('commande/addcommande.php');
    break;
    case 'editcommandelivreur':
        $printmessage = require('commande/editcommandelivreur.php');
    break;
    case 'editcommandestatus':
        $printmessage = require('commande/editcommandestatus.php');
    break;
    case 'getcommandebyid':
        $printmessage = require('commande/getcommandebyid.php');
    break;
    case 'getcommandesbyadresse':
        $printmessage = require('commande/getcommandesbyadresse.php');
    break;
    case 'getcommandesbyadresseclient':
        $printmessage = require('commande/getcommandesbyadresseclient.php');
    break;
    case 'getcommandesbyadressevendeur':
        $printmessage = require('commande/getcommandesbyadressevendeur.php');
    break;
    case 'getcommandesbycompte':
        $printmessage = require('commande/getcommandesbycompte.php');
    break;
    case 'getcommandesbycompteclient':
        $printmessage = require('commande/getcommandesbycompteclient.php');
    break;
    case 'getcommandesbycomptevendeur':
        $printmessage = require('commande/getcommandesbycomptevendeur.php');
    break;
    case 'getcommandesbylivreur':
        $printmessage = require('commande/getcommandesbylivreur.php');
    break;
    case 'getcommandesbynolivreur':
        $printmessage = require('commande/getcommandesbynolivreur.php');
    break;
    case 'getcommandesbyoffre':
        $printmessage = require('commande/getcommandesbyoffre.php');
    break;

    //addcompte
    //deletecompte
    //editcomptenom
    //getcomptebyid
    //getcomptes
    case 'addcompte':
        $printmessage = require('compte/addcompte.php');
    break;
    case 'deletecompte':
        $printmessage = require('compte/deletecompte.php');
    break;
    case 'editcomptenom':
        $printmessage = require('compte/editcomptenom.php');
    break;
    case 'getcomptebyid':
        $printmessage = require('compte/getcomptebyid.php');
    break;
    case 'getcomptes':
        $printmessage = require('compte/getcomptes.php');
    break;

    //getenderstorageschest
    //getenderstorageschestbyid
    //getenderstorageschestbyjoueur
    //getenderstorageschestdispo
    //getenderstoragestank
    //getenderstoragestankbyid
    //getenderstoragestankbyjoueur
    //getenderstoragestankdispo
    //setenderstorageschest
    //setenderstoragestank
    case 'getenderstorageschest':
        $printmessage = require('enderstorage/getenderstorageschest.php');
    break;
    case 'getenderstorageschestbyid':
        $printmessage = require('enderstorage/getenderstorageschestbyid.php');
    break;
    case 'getenderstorageschestbyjoueur':
        $printmessage = require('enderstorage/getenderstorageschestbyjoueur.php');
    break;
    case 'getenderstorageschestdispo':
        $printmessage = require('enderstorage/getenderstorageschestdispo.php');
    break;
    case 'getenderstoragestank':
        $printmessage = require('enderstorage/getenderstoragestank.php');
    break;
    case 'getenderstoragestankbyid':
        $printmessage = require('enderstorage/getenderstoragestankbyid.php');
    break;
    case 'getenderstoragestankbyjoueur':
        $printmessage = require('enderstorage/getenderstoragestankbyjoueur.php');
    break;
    case 'getenderstoragestankdispo':
        $printmessage = require('enderstorage/getenderstoragestankdispo.php');
    break;
    case 'setenderstorageschest':
        $printmessage = require('enderstorage/setenderstorageschest.php');
    break;
    case 'setenderstoragestank':
        $printmessage = require('enderstorage/setenderstoragestank.php');
    break;

    //addgroupe
    //addgroupeadresse
    //addgroupeapikey
    //addgroupecompte
    //addgroupedroit
    //addgroupejoueur
    //addgroupelivreur
    //addgroupeoffre
    //deletegroupe
    //deletegroupeadresse
    //deletegroupeapikey
    //deletegroupecompte
    //deletegroupedroit
    //deletegroupejoueur
    //deletegroupelivreur
    //deletegroupeoffre
    //editgroupenom
    //getadressesbygroupe
    //getapikeysbygroupe
    //getcomptesbygroupe
    //getdroitsbygroupe
    //getgroupebyid
    //getgroupesbyadresse
    //getgroupesbyapikey
    //getgroupesbycompte
    //getgroupesbyjoueur
    //getgroupesbyjoueurmembre
    //getgroupesbylivreur
    //getgroupesbyoffre
    //getjoueursbygroupe
    //getlivreursbygroupe
    //getoffresbygroupe
    case 'addgroupe':
        $printmessage = require('groupe/addgroupe.php');
    break;
    case 'addgroupeadresse':
        $printmessage = require('groupe/addgroupeadresse.php');
    break;
    case 'addgroupeapikey':
        $printmessage = require('groupe/addgroupeapikey.php');
    break;
    case 'addgroupecompte':
        $printmessage = require('groupe/addgroupecompte.php');
    break;
    case 'addgroupedroit':
        $printmessage = require('groupe/addgroupedroit.php');
    break;
    case 'addgroupejoueur':
        $printmessage = require('groupe/addgroupejoueur.php');
    break;
    case 'addgroupelivreur':
        $printmessage = require('groupe/addgroupelivreur.php');
    break;
    case 'addgroupeoffre':
        $printmessage = require('groupe/addgroupeoffre.php');
    break;
    case 'deletegroupe':
        $printmessage = require('groupe/deletegroupe.php');
    break;
    case 'deletegroupeadresse':
        $printmessage = require('groupe/deletegroupeadresse.php');
    break;
    case 'deletegroupeapikey':
        $printmessage = require('groupe/deletegroupeapikey.php');
    break;
    case 'deletegroupecompte':
        $printmessage = require('groupe/deletegroupecompte.php');
    break;
    case 'deletegroupedroit':
        $printmessage = require('groupe/deletegroupedroit.php');
    break;
    case 'deletegroupejoueur':
        $printmessage = require('groupe/deletegroupejoueur.php');
    break;
    case 'deletegroupelivreur':
        $printmessage = require('groupe/deletegroupelivreur.php');
    break;
    case 'deletegroupeoffre':
        $printmessage = require('groupe/deletegroupeoffre.php');
    break;
    case 'editgroupenom':
        $printmessage = require('groupe/editgroupenom.php');
    break;
    case 'getadressesbygroupe':
        $printmessage = require('groupe/getadressesbygroupe.php');
    break;
    case 'getapikeysbygroupe':
        $printmessage = require('groupe/getapikeysbygroupe.php');
    break;
    case 'getcomptesbygroupe':
        $printmessage = require('groupe/getcomptesbygroupe.php');
    break;
    case 'getdroitsbygroupe':
        $printmessage = require('groupe/getdroitsbygroupe.php');
    break;
    case 'getgroupebyid':
        $printmessage = require('groupe/getgroupebyid.php');
    break;
    case 'getgroupesbyadresse':
        $printmessage = require('groupe/getgroupesbyadresse.php');
    break;
    case 'getgroupesbyapikey':
        $printmessage = require('groupe/getgroupesbyapikey.php');
    break;
    case 'getgroupesbycompte':
        $printmessage = require('groupe/getgroupesbycompte.php');
    break;
    case 'getgroupesbyjoueur':
        $printmessage = require('groupe/getgroupesbyjoueur.php');
    break;
    case 'getgroupesbyjoueurmembre':
        $printmessage = require('groupe/getgroupesbyjoueurmembre.php');
    break;
    case 'getgroupesbylivreur':
        $printmessage = require('groupe/getgroupesbylivreur.php');
    break;
    case 'getgroupesbyoffre':
        $printmessage = require('groupe/getgroupesbyoffre.php');
    break;
    case 'getjoueursbygroupe':
        $printmessage = require('groupe/getjoueursbygroupe.php');
    break;
    case 'getlivreursbygroupe':
        $printmessage = require('groupe/getlivreursbygroupe.php');
    break;
    case 'getoffresbygroupe':
        $printmessage = require('groupe/getoffresbygroupe.php');
    break;

    //editjeton
    //getjetonbyjoueur
    //getjetons
    case 'editjeton':
        $printmessage = require('jeton/editjeton.php');
    break;
    case 'getjetonbyjoueur':
        $printmessage = require('jeton/getjetonbyjoueur.php');
    break;
    case 'getjetons':
        $printmessage = require('jeton/getjetons.php');
    break;

    //addjoueur
    //deletejoueur
    //editjoueuremail
    //editjoueurmdp
    //editjoueurnbroffre
    //editjoueurpseudo
    //editjoueurrole
    //getjoueurbyid
    //getjoueurbypseudo
    //getjoueurs
    //recuperationmdpbyemail
    //recuperationmdpbyemailtoken
    case 'addjoueur':
        $printmessage = require('joueur/addjoueur.php');
    break;
    case 'deletejoueur':
        $printmessage = require('joueur/deletejoueur.php');
    break;
    case 'editjoueuremail':
        $printmessage = require('joueur/editjoueuremail.php');
    break;
    case 'editjoueurmdp':
        $printmessage = require('joueur/editjoueurmdp.php');
    break;
    case 'editjoueurnbroffre':
        $printmessage = require('joueur/editjoueurnbroffre.php');
    break;
    case 'editjoueurpseudo':
        $printmessage = require('joueur/editjoueurpseudo.php');
    break;
    case 'editjoueurrole':
        $printmessage = require('joueur/editjoueurrole.php');
    break;
    case 'getjoueurbyid':
        $printmessage = require('joueur/getjoueurbyid.php');
    break;
    case 'getjoueurbypseudo':
        $printmessage = require('joueur/getjoueurbypseudo.php');
    break;
    case 'getjoueurs':
        $printmessage = require('joueur/getjoueurs.php');
    break;
    case 'recuperationmdpbyemail':
        $printmessage = require('joueur/recuperationmdpbyemail.php');
    break;
    case 'recuperationmdpbyemailtoken':
        $printmessage = require('joueur/recuperationmdpbyemailtoken.php');
    break;

    //addkeypay
    //getkeypaybyid
    //getkeypaysbyoffre
    case 'addkeypay':
        $printmessage = require('keypay/addkeypay.php');
    break;
    case 'getkeypaybyid':
        $printmessage = require('keypay/getkeypaybyid.php');
    break;
    case 'getkeypaysbyoffre':
        $printmessage = require('keypay/getkeypaysbyoffre.php');
    break;

    //addlitigemsg
    //deletelitigemsg
    //getlitigemsgsbycommande
    case 'addlitigemsg':
        $printmessage = require('litigemsg/addlitigemsg.php');
    break;
    case 'deletelitigemsg':
        $printmessage = require('litigemsg/deletelitigemsg.php');
    break;
    case 'getlitigemsgsbycommande':
        $printmessage = require('litigemsg/getlitigemsgsbycommande.php');
    break;

    //addlivreur
    //deletelivreur
    //editlivreuradresse
    //editlivreurcompte
    //editlivreurnom
    //getlivreurbyid
    //getlivreurs
    //getlivreursbyadresse
    //getlivreursbycompte
    case 'addlivreur':
        $printmessage = require('livreur/addlivreur.php');
    break;
    case 'deletelivreur':
        $printmessage = require('livreur/deletelivreur.php');
    break;
    case 'editlivreuradresse':
        $printmessage = require('livreur/editlivreuradresse.php');
    break;
    case 'editlivreurcompte':
        $printmessage = require('livreur/editlivreurcompte.php');
    break;
    case 'editlivreurnom':
        $printmessage = require('livreur/editlivreurnom.php');
    break;
    case 'getlivreurbyid':
        $printmessage = require('livreur/getlivreurbyid.php');
    break;
    case 'getlivreurs':
        $printmessage = require('livreur/getlivreurs.php');
    break;
    case 'getlivreursbyadresse':
        $printmessage = require('livreur/getlivreursbyadresse.php');
    break;
    case 'getlivreursbycompte':
        $printmessage = require('livreur/getlivreursbycompte.php');
    break;

    //addoffre
    //deleteoffre
    //editoffreadresse
    //editoffrecompte
    //editoffredescription
    //editoffrenom
    //editoffreprix
    //editoffrestock
    //editoffretype
    //getoffrebyid
    //getoffres
    //getoffresall
    //getoffresbyadresse
    //getoffresbycompte
    case 'addoffre':
        $printmessage = require('offre/addoffre.php');
    break;
    case 'deleteoffre':
        $printmessage = require('offre/deleteoffre.php');
    break;
    case 'editoffreadresse':
        $printmessage = require('offre/editoffreadresse.php');
    break;
    case 'editoffrecompte':
        $printmessage = require('offre/editoffrecompte.php');
    break;
    case 'editoffredescription':
        $printmessage = require('offre/editoffredescription.php');
    break;
    case 'editoffrenom':
        $printmessage = require('offre/editoffrenom.php');
    break;
    case 'editoffreprix':
        $printmessage = require('offre/editoffreprix.php');
    break;
    case 'editoffrestock':
        $printmessage = require('offre/editoffrestock.php');
    break;
    case 'editoffretype':
        $printmessage = require('offre/editoffretype.php');
    break;
    case 'getoffrebyid':
        $printmessage = require('offre/getoffrebyid.php');
    break;
    case 'getoffres':
        $printmessage = require('offre/getoffres.php');
    break;
    case 'getoffresall':
        $printmessage = require('offre/getoffresall.php');
    break;
    case 'getoffresbyadresse':
        $printmessage = require('offre/getoffresbyadresse.php');
    break;
    case 'getoffresbycompte':
        $printmessage = require('offre/getoffresbycompte.php');
    break;

    //addtransaction
    //gettransactionsbycompte
    //gettransactionbyid
    case 'addtransaction':
        $printmessage = require('transaction/addtransaction.php');
    break;
    case 'gettransactionsbycompte':
        $printmessage = require('transaction/gettransactionsbycompte.php');
    break;
    case 'gettransactionbyid':
        $printmessage = require('transaction/gettransactionbyid.php');
    break;

    //getwireless
    //getwirelessbyid
    //getwirelessbyjoueur
    //getwirelessdispo
    //setwireless
    case 'getwireless':
        $printmessage = require('wireless/getwireless.php');
    break;
    case 'getwirelessbyid':
        $printmessage = require('wireless/getwirelessbyid.php');
    break;
    case 'getwirelessbyjoueur':
        $printmessage = require('wireless/getwirelessbyjoueur.php');
    break;
    case 'getwirelessdispo':
        $printmessage = require('wireless/getwirelessdispo.php');
    break;
    case 'setwireless':
        $printmessage = require('wireless/setwireless.php');
    break;
    default:
        $printmessage = array('status_code' => 400, 'message' => 'Action non definie.');
    break;
}
return $printmessage;
?>