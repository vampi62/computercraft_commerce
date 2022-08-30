<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/

if(isset($_GET['action']))
{
	switch ($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{
		//commande
		case 'commandeadd':
			//require('admin/actions/commandeAdd.php');
		break;

		case 'commandedelete':
			//require('admin/actions/commandeDelete.php');
		break;

		case 'commandeupdateadresseexp':
			//require('admin/actions/commandeUpdateAdresseExp.php');
		break;

		case 'commandeupdateadressedes':
			//require('admin/actions/commandeUpdateAdresseDes.php');
		break;

		case 'commandeupdatedescription':
			//require('admin/actions/commandeUpdateDescription.php');
		break;

		case 'commandeupdatestatut':
			//require('admin/actions/commandeUpdateStatut.php');
		break;

		//jeton
		case 'jetondelete':
			require('admin/actions/jetonDelete.php');
		break;

		//joueur
		case 'joueurdelete':
			require('admin/actions/joueurDelete.php');
		break;

		case 'joueurupdatecompte':
			require('admin/actions/joueurUpdateCompte.php');
		break;

		case 'joueurupdatemail':
			require('admin/actions/joueurUpdateMail.php');
		break;

		case 'joueurupdatemdp': 
			require('admin/actions/joueurUpdateMdp.php');
		break;

		case 'joueurupdatenbr':
			require('admin/actions/joueurUpdateNbr.php');
		break;

		case 'joueurupdatepseudo':
			require('admin/actions/joueurUpdatePseudo.php');
		break;

		case 'joueurupdaterole':
			require('admin/actions/joueurUpdateRole.php');
		break;

		case 'joueurupdateresettoken':
			require('admin/actions/joueurUpdateResetToken.php');
		break;

		//list
		case 'listadresse':
			require('admin/actions/listAdresse.php');
		break;

		case 'listcommande':
			require('admin/actions/listCommande.php');
		break;

		case 'listjeton':
			require('admin/actions/listJeton.php');
		break;

		case 'listjoueur':
			require('admin/actions/listJoueur.php');
		break;

		case 'listoffre':
			require('admin/actions/listOffre.php');
		break;

		case 'listtransaction':
			require('admin/actions/listTransaction.php');
		break;

		//offre
		case 'offreadd':
			//require('admin/actions/offreAdd.php');
		break;

		case 'offredelete':
			//require('admin/actions/offreDelete.php');
		break;

		case 'offreupdateadresse':
			//require('admin/actions/offreUpdateAdresse.php');
		break;

		case 'offreupdatedescription':
			//require('admin/actions/offreUpdateDescription.php');
		break;

		case 'offreupdatelivraison':
			//require('admin/actions/offreUpdateLivraison.php');
		break;

		case 'offreupdatenom':
			//require('admin/actions/offreUpdateNom.php');
		break;

		case 'offreupdateproprio':
			//require('admin/actions/offreUpdateProprio.php');
		break;

		case 'offreupdatetype':
			//require('admin/actions/offreUpdateType.php');
		break;

		//transaction
		case 'transactionadd':
			//require('admin/actions/transactionAdd.php');
		break;

		case 'transactiondelete':
			//require('admin/actions/transactionDelete.php');
		break;

		case 'transactionupdatedescription':
			//require('admin/actions/transactionUpdateDescription.php');
		break;

		case 'transactionupdatestatut':
			//require('admin/actions/transactionUpdateStatut.php');
		break;

		case 'transactionupdatetype':
			//require('admin/actions/transactionUpdateType.php');
		break;
	}
}