api http acces via GET

action=nom_action&&param1=text&&param2=text
## nom_action
- param1	:(type) parametre obligatoire
- param2    :(type)(optionnel) parametre non obligatoire

# installation

http://ipserveur/api_computercraft/installation/index.php?

- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le role de ce compte est d'administer le site via le panel admin (voir section en bas de cette page)
- mdpconfirm	:(string) doit être identique à __mdp__
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/installation/index.php?action=install&mdp=&pseudo=__pseudo__&mdpconfirm=__mdp__&email=__email__


# fonctionnement

http://ipserveur/api_computercraft/index.php?


## inscription
- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le compte aura le role 0 (client) par defaut avec le nom d'offre defini dans le fichier config
- mdpconfirm	:(string) doit être identique à __mdp__
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/index.php?action=inscription&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&email=__email__

## listntp

http://0.0.0.0:9081/api_computercraft/index.php?action=listntp

## listconfig

http://0.0.0.0:9081/api_computercraft/index.php?action=listconfig

## listuserdata
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listuserdata&mdp=__mdp__&pseudo=__pseudo__

## listusertransaction
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listusertransaction&mdp=__mdp__&pseudo=__pseudo__

## listusercommande
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listusercommande&mdp=__mdp__&pseudo=__pseudo__

## updatemail
- mdp			:(string)
- pseudo		:(string)
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/index.php?action=updatemail&mdp=__mdp__&pseudo=__pseudo__&email=__email__

## updatemdp
- mdp			:(string)
- pseudo		:(string)
- mdpnouveau	:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- mdpconfirm	:(string) doit être identique à __mdpnouveau__

http://0.0.0.0:9081/api_computercraft/index.php?action=updatemdp&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&mdpnouveau=__mdpnouveau__

## updateadressedefaut
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) entrer le nom d'une adresse creer au préalable (cette adresse servira de boite au lettre par defaut)(l'adresse doit avoir l'attribut type=1)

http://0.0.0.0:9081/api_computercraft/index.php?action=updateadressedefaut&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__

## listoffresboutique

http://0.0.0.0:9081/api_computercraft/index.php?action=listoffresboutique

## updateoffreboutique
- mdp			:(string)
- pseudo		:(string)
- id			:(int) id de l'offre a modifier
- prix			:(float) prix a l'unité
- nbr_dispo		:(int)(optionnel) nom dispo en stock
- type			:(int)(optionnel) type de l'offre (0:vide - 1:objet - 2:liquide - 3:gaz - 4:autre)
- livraison		:(int)(optionnel) type de livraison de l'offre (0:vide - 1:auto-rout - 2:manu)
- nom			:(string)(optionnel) nom de l'objet a vendre
- description	:(text)(optionnel) descriptif de l'offre
- nomadresse	:(string)(optionnel) adresse du point de commerce (l'adresse doit avoir l'attribut type=2)

http://0.0.0.0:9081/api_computercraft/index.php?action=updateoffreboutique&mdp=__mdp__&pseudo=__pseudo__&id=__id__&prix=__prix__&nbr_dispo=__nbr_dispo__&type=__type__&livraison=__livraison__&nom=__nom__&description=__description__&nomadresse=__nomadresse__

## achat
- mdp			:(string)
- pseudo		:(string)
- id			:(int) id de l'offre à acheter
- quantite		:(int) quantité à acheter

http://0.0.0.0:9081/api_computercraft/index.php?action=achat&mdp=__mdp__&pseudo=__pseudo__&id=__id__&quantite=__quantite__

## listcommandes
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listcommandes&mdp=__mdp__&pseudo=__pseudo__

## updatecommandestatut
- mdp			:(string)
- pseudo		:(string) seul le compte expediteur peuvent changer le statut par ce biais
- id			:(int) id de la commande à modifier
- statut		:(int) nouveau statut de la commande

http://0.0.0.0:9081/api_computercraft/index.php?action=updatecommandestatut&mdp=__mdp__&pseudo=__pseudo__&id=__id__&statut=__statut__

1-->2 (vendeur) <br/>
1-->10 (vendeur)(à l'appréciation du vendeur) <br/>
2-->3 (banque_admin : role=2) <br/>
2-->11 (banque_admin : role=2)(si le client n'a pas les fond) <br/>
3-->4 (vendeur) <br/>
4-->5 (vendeur ou banque_routeur) <br/>
5-->6 (vendeur ou banque_routeur) <br/>
1: commande effectuer validation vendeur en attente <br/>
2: echange accepter paiement en attente <br/>
3: echange accepter paiement valider <br/>
4: commande pret a envoyer <br/>
5: commande en cours de livraison <br/>
6: terminer <br/>
10: echange refuser par le vendeur <br/>
11: echange accepter paiement refuser <br/>
	
## transaction
- mdp			:(string)
- pseudo		:(string) seul un compte compteur avec un role=2 (banque-routeur) peuvent utiliser le type commande
- type			:(string) commande

http://0.0.0.0:9081/api_computercraft/index.php?action=transaction&mdp=__mdp__&pseudo=__pseudo__&type=commande

## transaction
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role=1 (banque-terminal) peuvent utiliser les type ci-dessous
- type			:(string) commande - transfert - depot - retrait - achatoffre
- crediteur		:(string) pseudo du compte qui recoit
- debiteur		:(string) pseudo du compte qui envoie
- somme			:(float) somme a transferer
- description	:(text) text libre
- mdpuser		:(string) mot de passe de l'utilisateur réalisant la transaction

http://0.0.0.0:9081/api_computercraft/index.php?action=transaction&mdp=__mdp__&pseudo=__pseudo__&type=transfert&crediteur=__crediteur__&debiteur=__debiteur__&somme=__somme__&description=__description__&mdpuser=__mdpuser__

## updatejetoncoffre
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role=1 (banque-terminal) peuvent entrer ses jeton
- jeton1		:(int) nombres de jeton
- jeton10		:(int) nombres de jeton
- jeton100		:(int) nombres de jeton
- jeton1k		:(int) nombres de jeton
- jeton10k		:(int) nombres de jeton

http://0.0.0.0:9081/api_computercraft/index.php?action=updatejetoncoffre&mdp=__mdp__&pseudo=__pseudo__&jeton1=__jeton1__&jeton10=__jeton10__&jeton100=__jeton100__&jeton1k=__jeton1k__&jeton10k=__jeton10k__

## listjetoncoffre
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role superieur ou égal à 1 peut recuperer la liste des jetons

http://0.0.0.0:9081/api_computercraft/index.php?action=listjetoncoffre&mdp=__mdp__&pseudo=__pseudo__

## addadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de la nouvelle adresse - il ne peut pas avoir 2 adresses avec le même nom
- type			:(int) (0:inactive 1:adresse de reception 2:adresse de commerce)
- coo			:(text) text libre pour les coordonnée xyz
- description	:(text) text libre

http://0.0.0.0:9081/api_computercraft/index.php?action=addadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__&type=__type__&coo=__coo__&description=__description__

## updateadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de l'adresse donnée
- type			:(int)(optionnel) pour changer le type l'offre de doit pas être utiliser (0:inactive 1:adresse de reception 2:adresse de commerce)
- coo			:(text)(optionnel) text libre pour les coordonnée xyz
- description	:(text)(optionnel) text libre
- nouveaunom	:(string)(optionnel) nouveau nom pour l'adresse - il ne peut pas avoir 2 adresses avec le même nom

http://0.0.0.0:9081/api_computercraft/index.php?action=updateadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__&type=__type__&coo=__coo__&description=__description__&nouveaunom=__nouveaunom__

## deleteadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de l'adresse à supprimer (l'adresse ne doit pas être utiliser pour être supprimer)

http://0.0.0.0:9081/api_computercraft/index.php?action=deleteadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__

## changemdpmail
- pseudo		:(string)
- email			:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=changemdpmail&pseudo=__pseudo__&email=__email__

## recuperationmailmdp
- pseudo		:(string)
- token			:(string) token reçu par mail via la commande __changemdpmail__

http://0.0.0.0:9081/api_computercraft/index.php?action=recuperationmailmdp&pseudo=__pseudo__&token=__token__


# panel admin
utiliser un compte avec un role = 10 (compte creer à l'installation du site)

## jetondelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=jetondelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__

## joueurdelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurdelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__

## joueurupdatecompte
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) 

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatecompte&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurupdatemail
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) nouveau mail

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatemail&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurupdatemdp
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) nouveau mot de passe

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatemdp&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurupdatenbr
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) re-compte le nombre d'offre au nom du joueur

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatenbr&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurupdatepseudo
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) changer le pseudo du joueur (le changement ne se fera pas si le nouveau pseudo est déjà utiliser)

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatepseudo&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurupdaterole
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(int) nouveau role du joueur (vous ne pouvez pas changer le role du compte utiliser dans __pseudo__)

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdaterole&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## joueurUpdateresettoken
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(bool) null --> supprimer le token, non null --> genere un nouveau token

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurUpdateresettoken&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

## listadresse
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listadresse&admin=1&mdp=__mdp__&pseudo=__pseudo__

## listcommande
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listcommande&admin=1&mdp=__mdp__&pseudo=__pseudo__

## listjeton
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listjeton&admin=1&mdp=__mdp__&pseudo=__pseudo__

## listjoueur
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listjoueur&admin=1&mdp=__mdp__&pseudo=__pseudo__

## listoffre
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listoffre&admin=1&mdp=__mdp__&pseudo=__pseudo__

## listtransaction
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listtransaction&admin=1&mdp=__mdp__&pseudo=__pseudo__

d'autre commande pour le pannel admin seront integrer prochainement