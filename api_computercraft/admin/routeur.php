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

    //addcompte
    //deletecompte
    //editcomptenom
    //getcomptebyid
    //getcomptesbyjoueur
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
    case 'getcomptesbyjoueur':
        $printmessage = require('compte/getcomptesbyjoueur.php');
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

    //addtransaction
    //edittransactionstatus
    //exectransaction
    //gettransactionbyid
    //gettransactionsbyadmin
    //gettransactionsbycommande
    //gettransactionsbycompte
    case 'addtransaction':
        $printmessage = require('transaction/addtransaction.php');
    break;
    case 'edittransactionstatus':
        $printmessage = require('transaction/edittransactionstatus.php');
    break;
    case 'exectransaction':
        $printmessage = require('transaction/exectransaction.php');
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