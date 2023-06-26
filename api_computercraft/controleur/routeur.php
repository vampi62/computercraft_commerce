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

    //editjeton
    //getjetons
    case 'editjeton':
        $printmessage = require('jeton/editjeton.php');
    break;
    case 'getjetons':
        $printmessage = require('jeton/getjetons.php');
    break;

    //addjoueur
    //deletejoueur
    //editjoueuremail
    //editjoueurmdp
    //editjoueurpseudo
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
    case 'editjoueurpseudo':
        $printmessage = require('joueur/editjoueurpseudo.php');
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

    //addtransaction
    //edittransactionstatus
    //exectransaction
    //execalltransactions
    //gettransactionbyid
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
    case 'execalltransactions':
        $printmessage = require('transaction/execalltransactions.php');
    break;
    case 'gettransactionbyid':
        $printmessage = require('transaction/gettransactionbyid.php');
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