<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés
*/
if(isset($_GET['action']))
{
	switch($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 		
		//connection doit être appelé à chaque action securisée car computercraft n'enregistre pas de session
		
		// gestion utilisateur
		case 'inscription': // compte libre
			// paramètres - mdp - pseudo - mdpconfirm - email
			include('controleur/joueur/inscription.php');
		break;

		case 'ntp': // compte libre
			include('controleur/ntp.php');
		break;

		case 'getconfig': // compte libre
			include('controleur/getConfig.php');
		break;

		
	    case 'getuserdata': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/getUserData.php');
		break;

		case 'getusertransaction': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/getUserTransaction.php');
		break;

		case 'getusercommande': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/getUserCommande.php');
		break;

		case 'editmail': // compte normal
			// paramètres - mdp - pseudo - email
			include('controleur/joueur/editMail.php');
	    break;

	    case 'editmdp': // compte normal
			// paramètres - mdp - pseudo - mdpconfirm - mdpnouveau
			include('controleur/joueur/editMdp.php');
	    break;

		// boutique

		case 'listoffresboutique': // compte libre
			include('controleur/boutique/listOffresBoutique.php');
		break;

		case 'updateoffreboutique': // compte normal
			// paramètres - mdp - pseudo - id - prix - nbr_dispo - type - livraison - nom - description
			include('controleur/boutique/updateOffreBoutique.php');
		break;

		case 'achat': // compte normal
			// paramètres - mdp - pseudo - id - quantite
			include('controleur/boutique/achat.php');
		break;

		// gestion commande pour les commerces et la banque

		case 'listcommandes': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/banque/listCommandes.php');
		break;

		case 'editcommandestatus': // compte normal
			// paramètres - mdp - pseudo - id - statuts
			include('controleur/banque/editCommandeStatus.php');
		break;

		// gestion reserver pour la banque
		case 'transaction': // compte admin
			// paramètres - mdp - pseudo - type
			// paramètres - mdp - pseudo - type - crediteur - debiteur - mdpuser - pseudouser - somme - description
			include('controleur/banque/transaction.php');
		break;

		case 'syncjetoncoffre': // compte admin
			// paramètres - mdp - pseudo
			include('controleur/banque/syncJetonCoffre.php');
		break;

	}
}
?>