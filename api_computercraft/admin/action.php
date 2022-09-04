<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/

if(isset($_GET['action']))
{
	switch (strtolower($_GET['action'])) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{
		//adresse
		case 'adressedelete':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/adresseDelete.php');
		break;

		case 'adresseupdatecoo':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/adresseUpdateCoo.php');
		break;

		case 'adresseupdatedescription':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/adresseUpdateDescription.php');
		break;

		case 'adresseupdatenom':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/adresseUpdateNom.php');
		break;

		case 'adresseupdatetype':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/adresseUpdateType.php');
		break;

		//commande
		case 'commandedelete':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/commandeDelete.php');
		break;

		case 'commandeupdatetextadresseexpediteur':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/commandeUpdateTextAdresseExpediteur.php');
		break;

		case 'commandeupdatetextadresserecepteur':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/commandeUpdateTextAdresseRecepteur.php');
		break;

		case 'commandeupdatedescription':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/commandeUpdateDescription.php');
		break;

		case 'commandeupdatestatut':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/commandeUpdateStatut.php');
		break;

		//jeton
		case 'jetondelete':
			// paramètres - mdp - pseudo - player
			require('admin/actions/jetonDelete.php');
		break;

		//joueur
		case 'joueurdelete':
			// paramètres - mdp - pseudo - player
			require('admin/actions/joueurDelete.php');
		break;

		case 'joueurupdatecompte':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdateCompte.php');
		break;

		case 'joueurupdatemail':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdateMail.php');
		break;

		case 'joueurupdatemdp': 
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdateMdp.php');
		break;

		case 'joueurupdatenbr':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdateNbr.php');
		break;

		case 'joueurupdatepseudo':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdatePseudo.php');
		break;

		case 'joueurupdaterole':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/joueurUpdateRole.php');
		break;

		case 'joueurupdateresettoken':
			// paramètres - mdp - pseudo - player - newdata
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
			// paramètres - mdp - pseudo - player
			require('admin/actions/offreAdd.php');
		break;

		case 'offredelete':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/offreDelete.php');
		break;

		case 'offreupdateadresse':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateAdresse.php');
		break;

		case 'offreupdatedescription':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateDescription.php');
		break;

		case 'offreupdatelivraison':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateLivraison.php');
		break;

		case 'offreupdatenom':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateNom.php');
		break;

		case 'offreupdateproprio':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateProprio.php');
		break;

		case 'offreupdatetype':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/offreUpdateType.php');
		break;

		//transaction
		case 'transactionadd':
			// paramètres - mdp - pseudo - crediteur - debiteur - somme - type - description - statut
			require('admin/actions/transactionAdd.php');
		break;

		case 'transactiondelete':
			// paramètres - mdp - pseudo - player - newdata
			require('admin/actions/transactionDelete.php');
		break;

		case 'transactionupdatedescription':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/transactionUpdateDescription.php');
		break;

		case 'transactionupdatestatut':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/transactionUpdateStatut.php');
		break;

		case 'transactionupdatetype':
			// paramètres - mdp - pseudo - player - newdata - newtypedata
			require('admin/actions/transactionUpdateType.php');
		break;
	}
}