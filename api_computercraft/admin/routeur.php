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
    //editadresselivreur
    //editadressenom
    //editadressetype
    //getadressebyid
    //getadressesbyjoueur
    //getadressesbylivreur
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
    case 'editadresselivreur':
        $printmessage = require('adresse/editadresselivreur.php');
    break;
    case 'editadressenom':
        $printmessage = require('adresse/editadressenom.php');
    break;
    case 'editadressetype':
        $printmessage = require('adresse/editadressetype.php');
    break;
    case 'getadressebyid':
        $printmessage = require('adresse/getadressebyid.php');
    break;
    case 'getadressesbyjoueur':
        $printmessage = require('adresse/getadressesbyjoueur.php');
    break;
    case 'getadressesbylivreur':
        $printmessage = require('adresse/getadressesbylivreur.php');
    break;
    
    //addcommande
    //editcommandecoderetrait
    //editcommandedatelivraison
    //editcommandestatus
    //editcommandetransaction
    //getcommandebyid
    //getcommandebytransaction
    //getcommandesbyadresse
    //getcommandesbyadresseclient
    //getcommandesbyadressevendeur
    //getcommandesbycompte
    //getcommandesbycompteclient
    //getcommandesbycomptevendeur
    //getcommandesbylivreur
    //getcommandesbyoffre
    case 'addcommande':
        $printmessage = require('commande/addcommande.php');
    break;
    case 'editcommandecoderetrait':
        $printmessage = require('commande/editcommandecoderetrait.php');
    break;
    case 'editcommandedatelivraison':
        $printmessage = require('commande/editcommandedatelivraison.php');
    break;
    case 'editcommandestatus':
        $printmessage = require('commande/editcommandestatus.php');
    break;
    case 'editcommandetransaction':
        $printmessage = require('commande/editcommandetransaction.php');
    break;
    case 'getcommandebyid':
        $printmessage = require('commande/getcommandebyid.php');
    break;
    case 'getcommandebytransaction':
        $printmessage = require('commande/getcommandebytransaction.php');
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
    case 'getcommandesbyoffre':
        $printmessage = require('commande/getcommandesbyoffre.php');
    break;

    //addcompte
    //deletecompte
    //editcomptenom
    //getcomptebyid
    //getcomptebyjoueur
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
    case 'getcomptebyjoueur':
        $printmessage = require('compte/getcomptebyjoueur.php');
    break;

    //addgroupeadresse
    //addgroupekeyapi
    //addgroupecompte
    //addgroupedroit
    //addgroupe
    //addgroupejoueur
    //addgroupelivreur
    //addgroupeoffre
    //deletegroupeadresse
    //deletegroupekeyapi
    //deletegroupecompte
    //deletegroupedroit
    //deletegroupe
    //deletegroupejoueur
    //deletegroupelivreur
    //deletegroupeoffre
    //editgroupenom
    //getadressesbygroupe
    //getcomptesbygroupe
    //getdroitsbygroupe
    //getgroupebyid
    //getgroupesbyadresse
    //getgroupesbykeyapi
    //getgroupesbycompte
    //getgroupesbyjoueur
    //getgroupesbyjoueurmembre
    //getgroupesbylivreur
    //getgroupesbyoffre
    //getjoueursbygroupe
    //getkeyapisbygroupe
    //getlivreursbygroupe
    //getoffresbygroupe
    case 'addgroupeadresse':
        $printmessage = require('groupe/addgroupeadresse.php');
    break;
    case 'addgroupekeyapi':
        $printmessage = require('groupe/addgroupekeyapi.php');
    break;
    case 'addgroupecompte':
        $printmessage = require('groupe/addgroupecompte.php');
    break;
    case 'addgroupedroit':
        $printmessage = require('groupe/addgroupedroit.php');
    break;
    case 'addgroupe':
        $printmessage = require('groupe/addgroupe.php');
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
    case 'deletegroupeadresse':
        $printmessage = require('groupe/deletegroupeadresse.php');
    break;
    case 'deletegroupekeyapi':
        $printmessage = require('groupe/deletegroupekeyapi.php');
    break;
    case 'deletegroupecompte':
        $printmessage = require('groupe/deletegroupecompte.php');
    break;
    case 'deletegroupedroit':
        $printmessage = require('groupe/deletegroupedroit.php');
    break;
    case 'deletegroupe':
        $printmessage = require('groupe/deletegroupe.php');
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
    case 'getgroupesbykeyapi':
        $printmessage = require('groupe/getgroupesbykeyapi.php');
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
    case 'getkeyapisbygroupe':
        $printmessage = require('groupe/getkeyapisbygroupe.php');
    break;
    case 'getlivreursbygroupe':
        $printmessage = require('groupe/getlivreursbygroupe.php');
    break;
    case 'getoffresbygroupe':
        $printmessage = require('groupe/getoffresbygroupe.php');
    break;

    //addjeton
    //deletejeton
    //editjeton
    //getjetonbyjoueur
    //getjetons
    case 'addjeton':
        $printmessage = require('jeton/addjeton.php');
    break;
    case 'deletejeton':
        $printmessage = require('jeton/deletejeton.php');
    break;
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

    //addkeyapi
    //deletekeyapi
    //addkeyapidroit
    //deletekeyapidroit
    //editkeyapimdp
    //editkeyapinom
    //getkeyapibyid
    //getkeyapidroitsbyid
    //getkeyapisbyjoueur
    case 'addkeyapi':
        $printmessage = require('keyapi/addkeyapi.php');
    break;
    case 'deletekeyapi':
        $printmessage = require('keyapi/deletekeyapi.php');
    break;
    case 'addkeyapidroit':
        $printmessage = require('keyapi/addkeyapidroit.php');
    break;
    case 'deletekeyapidroit':
        $printmessage = require('keyapi/deletekeyapidroit.php');
    break;
    case 'editkeyapimdp':
        $printmessage = require('keyapi/editkeyapimdp.php');
    break;
    case 'editkeyapinom':
        $printmessage = require('keyapi/editkeyapinom.php');
    break;
    case 'getkeyapibyid':
        $printmessage = require('keyapi/getkeyapibyid.php');
    break;
    case 'getkeyapidroitsbyid':
        $printmessage = require('keyapi/getkeyapidroitsbyid.php');
    break;
    case 'getkeyapisbyjoueur':
        $printmessage = require('keyapi/getkeyapisbyjoueur.php');
    break;

    //getkeypaybyid
    //getkeypaysbyoffre
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
    //getlivreursbyadresse
    //getlivreursbycompte
    //getlivreursbyjoueur
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
    case 'getlivreursbyadresse':
        $printmessage = require('livreur/getlivreursbyadresse.php');
    break;
    case 'getlivreursbycompte':
        $printmessage = require('livreur/getlivreursbycompte.php');
    break;
    case 'getlivreursbyjoueur':
        $printmessage = require('livreur/getlivreursbyjoueur.php');
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
    //getoffresbyadresse
    //getoffresbycompte
    //getoffresbyjoueur
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
    case 'getoffresbyadresse':
        $printmessage = require('offre/getoffresbyadresse.php');
    break;
    case 'getoffresbycompte':
        $printmessage = require('offre/getoffresbycompte.php');
    break;
    case 'getoffresbyjoueur':
        $printmessage = require('offre/getoffresbyjoueur.php');
    break;

    //addtransaction
    //gettransactionbyid
    //gettransactionsbyadmin
    //gettransactionsbycommande
    //gettransactionsbycompte
    case 'addtransaction':
        $printmessage = require('transaction/addtransaction.php');
    break;
    case 'gettransactionbyid':
        $printmessage = require('transaction/gettransactionbyid.php');
    break;
    case 'gettransactionsbyadmin':
        $printmessage = require('transaction/gettransactionsbyadmin.php');
    break;
    case 'gettransactionsbycommande':
        $printmessage = require('transaction/gettransactionsbycommande.php');
    break;
    case 'gettransactionsbycompte':
        $printmessage = require('transaction/gettransactionsbycompte.php');
    break;
    default:
        $printmessage = array('status_code' => 400, 'message' => 'Action non definie.');
    break;
}
return $printmessage;
?>