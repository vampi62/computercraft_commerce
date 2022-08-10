<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés
*/
if(isset($_GET['action']))
{
	switch($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 		
		//connection doit être appelé à chaque action securisée car computercraft n'enregistre pas de session
		
		// action libre

		case 'listntp': // compte libre
			include('controleur/listntp.php');
		break;

		case 'listconfig': // compte libre
			include('controleur/listConfig.php');
		break;

		// gestion utilisateur

		case 'inscription': // compte libre
			// paramètres - mdp - pseudo - mdpconfirm - email
			include('controleur/joueur/inscription.php');
		break;

		case 'listuserdata': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/listUserData.php');
		break;

		case 'listusertransaction': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/listUserTransaction.php');
		break;

		case 'listusercommande': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/joueur/listUserCommande.php');
		break;

		case 'updatemail': // compte normal
			// paramètres - mdp - pseudo - email
			include('controleur/joueur/updateMail.php');
		break;

		case 'updatemdp': // compte normal
			// paramètres - mdp - pseudo - mdpconfirm - mdpnouveau
			include('controleur/joueur/updateMdp.php');
		break;

		case 'updateadressedefaut': // compte normal
			// paramètres - mdp - pseudo - nom
			include('controleur/joueur/updateAdresseDefaut.php');
		break;

		// boutique

		case 'listoffresboutique': // compte libre
			include('controleur/boutique/listOffresBoutique.php');
		break;

		case 'updateoffreboutique': // compte normal
			// paramètres - mdp - pseudo - id - prix - nbr_dispo - type - livraison - nom - description - nomadresse
			include('controleur/boutique/updateOffreBoutique.php');
		break;

		case 'achat': // compte normal
			// paramètres - mdp - pseudo - id - quantite
			include('controleur/boutique/achat.php');
		break;

		// adresse

		case 'addadresse': // compte normal
			// paramètres - mdp - pseudo - nom - type - coo - description
			include('controleur/adresse/addAdresse.php');
		break;

		case 'updateadresse': // compte normal
			// paramètres - mdp - pseudo - nom - type - coo - description
			include('controleur/adresse/updateAdresse.php');
		break;

		case 'deleteadresse': // compte normal
			// paramètres - mdp - pseudo - nom
			include('controleur/adresse/deleteAdresse.php');
		break;

		// gestion commande pour les commerces et la banque

		case 'listcommandes': // compte normal
			// paramètres - mdp - pseudo
			include('controleur/banque/listCommandes.php');
		break;

		case 'updatecommandestatut': // compte normal
			// paramètres - mdp - pseudo - id - statut
			include('controleur/banque/updateCommandeStatut.php');
		break;

		// gestion reserver pour la banque

		case 'transaction': // compte admin
			// paramètres - mdp - pseudo - type
			// paramètres - mdp - pseudo - type - crediteur - debiteur - mdpuser - pseudouser - somme - description
			include('controleur/banque/transaction.php');
		break;

		case 'updatejetoncoffre': // compte admin
			// paramètres - mdp - pseudo
			include('controleur/banque/updateJetonCoffre.php');
		break;
		
		case 'listjetoncoffre': // compte admin
			// paramètres - mdp - pseudo
			include('controleur/banque/listJetonCoffre.php');
		break;

	}
}
?>