<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés
*/
if (isset($_GET['action']))
{
	switch(strtolower($_GET['action']))	{
		//// config
		// getntp

		// getconfig

		// install

		// update

		//// utilisateur
		// inscription

		// changement mdp

		// changement email

		// changement pseudo

		// mdp oublie

		// recupmdp

		// changement role

		// changer max_offres

		// supprimer utilisateur

		//// groupe
		// add_groupe

		// supprimer groupe

		// changer nom groupe

		// ajouter un droit

		// retirer un droit

		// ajouter un utilisateur

		// retirer un utilisateur

		// ajouter une offre

		// retirer une offre

		// ajouter un compte

		// retirer un compte

		// ajouter une adresse

		// retirer une adresse

		// ajouter un livreur

		// retirer un livreur

		// ajouter une keyapi

		// retirer une keyapi

		// get groupes

		// get groupe{id}

		// get groupes{id_utilisateur}

		// get groupes{id_offre}

		// get groupes{id_compte}

		// get groupes{id_adresse}

		// get groupes{id_livreur}

		// get groupes{id_keyapi}

		// get offre{id_groupe}

		// get compte{id_groupe}

		// get adresse{id_groupe}

		// get livreur{id_groupe}

		// get keyapi{id_groupe}

		// get utilisateurs{id_groupe}

		//// jeton
		// init sync jeton

		// sync jeton

		// retire sync jeton

		// get jeton

		//// offre
		//get offres

		// get offre{id}

		// set offre

		// delete offre

		// add offre

		//// compte
		// add compte

		// delete compte

		// edit nom compte

		//// adresse
		// add adresse

		// delete adresse

		// edit type adresse

		// edit nom adresse

		// edit coo adresse

		// edit description adresse

		// get adresse{id}

		// get adresses

		//// livreur
		// add livreur

		// delete livreur

		// changer nom_groupe

		// changer compte

		// changer adresse

		//// keyapi
		// add keyapi

		// changer mdp

		// changer nom

		// get keyapi{id}
		
		// get keyapis

		// delete keyapi

		// ajouter un droit

		// retirer un droit

		//// commande
		// add commande

		// add keypay

		// get keypay{key}

		// get keypay{id}

		// get commandes_vendeur_adr

		// get commandes_vendeur_compte

		// get commandes_client_adr

		// get commandes_client_compte

		// get commandes_livreur

		// get commande{id}

		// ouvrir_litige{id}



		// valide_commande{id}

		// paiement_commande{id}

		// annuler_commande{id}

		// prepa_commande{id}

		// expedition_commande{id}

		// relai_commande{id}

		// reception_commande{id}

		// retrait_commande{id}

		// get_commande_en_attente

		// get commandes_pretes




		//// transaction
		// get transaction{id}

		// get transactions

		// get transactions{id_admin}

		// execute transaction

		//// litige
		// add litigemsg

		// get litigemsg
		
		// delete litigemsg

	}
}
?>