api http acces via GET

action=nom_action&&param1=text&&param2=text
##nom_action
- param1	: parametre obligatoire
- param2   o: parametre optionnel

#installation

http://ipserveur/api_computercraft/installation/index.php?
- mdp			: le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		: le role de ce compte est de changer le role et gerer le panel admin
- mdpconfirm	: doit être identique à "mdp"
- email			: l'email doit etre valide


#fonctionnement

http://ipserveur/api_computercraft/index.php?


##inscription
- mdp			: le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		: le compte aura le role 0 (client) par defaut avec le nom d'offre definit dans le fichier config
- mdpconfirm	: doit être identique à "mdp"
- email			: l'email doit etre valide

##listntp

##listconfig

##listuserdata
- mdp
- pseudo

##listusertransaction
- mdp
- pseudo

##listusercommande
- mdp
- pseudo

##updatemail
- mdp
- pseudo
- email			: l'email doit etre valide

##updatemdp
- mdp
- pseudo
- mdpnouveau	: le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- mdpconfirm	: doit être identique à "mdp"

##updateadressedefaut
- mdp
- pseudo
- nom			: entrer le nom d'une adresse creer au préalable (cette adresse servira de boite au lettre par defaut)

##listoffresboutique
- id			: id de l'offre a modifier
- prix			: prix a l'unité
- nbr_dispo	   o: nom dispo en stock
- type		   o: type de l'offre (0:vide - 1:objet - 2:liquide - 3:gaz - 4:autre)
- livraison	   o: type de livraison de l'offre (0:vide - 1:auto-rout - 2:manu)
- nom		   o: nom de l'objet a vendre
- description  o: descriptif de l'offre
- nomadresse   o: adresse du point de commerce

##achat
- mdp
- pseudo
- id			: id de l'offre à acheter
- quantite		: quantité à acheter

##listcommandes
- mdp
- pseudo

##updatecommandestatut
- mdp
- pseudo		: seul le compte expediteur peuvent changer le statut par ce biais
- id			: id de la commande à modifier
- statut		: nouveau statut de la commande

##transaction
- mdp
- pseudo		: seul un compte compteur avec un role=2 (banque-routeur) peuvent utiliser le type commande
- type			: commande

##transaction
- mdp
- pseudo		: seul un compteur avec un role=1 (banque-terminal) peuvent utiliser les type ci-dessous
- type			: commande - transfert - depot - retrait - achatoffre
- crediteur		: speudo du compte qui recoit
- debiteur		: speudo du compte qui envoie
- somme			: somme a transferer
- description	: text libre
- mdpuser		: mot de passe de l'utilisateur réalisant la transaction

##updatejetoncoffre
- mdp
- pseudo		: seul un compteur avec un role=1 (banque-terminal) peuvent entrer ses jeton
- jeton1		: nombres de jeton
- jeton10		: nombres de jeton
- jeton100		: nombres de jeton
- jeton1k		: nombres de jeton
- jeton10k		: nombres de jeton

##listjetoncoffre
- mdp
- pseudo		: seul un compteur avec un role superieur ou égal à 1 peut recuperer la liste des jetons

##addadresse
- mdp
- pseudo
- nom			: nom de la nouvelle adresse - il ne peut pas avoir 2 adresses avec le même nom
- type			: 0 adresse de reception - 1 adresse d'emission
- coo			: text libre pour les coordonnée xyz
- description	: text libre

##updateadresse
- mdp
- pseudo
- nom			: nom de l'adresse donnée
- type		   o: pour changer le type l'offre de doit pas être utiliser
- coo		   o: text libre pour les coordonnée xyz
- description  o: text libre
- nouveaunom   o: nouveau nom pour l'adresse - il ne peut pas avoir 2 adresses avec le même nom

##deleteadresse
- mdp
- pseudo
- nom			: nom de l'adresse à supprimer (l'adresse ne doit pas être utiliser pour être supprimer)


#panel admin

pas encore integrer