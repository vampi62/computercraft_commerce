api http acces via GET


## nom_action (exemple)
- param1	:(type) parametre obligatoire
- param2    :(type)(optionnel) parametre non obligatoire

http://0.0.0.0:9081/api_computercraft/index.php?action=__nom_action&param1=__param1__&param2=__param2__

return (string) ==> renvoie un nombre faite correspondre la valeur avec la section __message_error__ du fichier config.yml<br/>
return (array) ==> affiche la table de manière à être récuperer par computercraft, utiliser le code ci-dessous pour reconvertir la sortie en array dans computercraft
```lua
global_url = "0.0.0.0"
global_port = "9081"
global_uri = "api_computercraft"
function http_get(action)
	local source_return, err = http.get("http://"..global_url..":"..global_port.."/"..global_uri.."/index.php?action="..action)
	local source_text = source_return.readAll()
	if source_text ~= "db_error" then
		return textutils.unserialise(source_text) -- renvoie une table ou un nombre
	else
		return "db_error"
	end
end

action="listuserdata&mdp=__mdp__&pseudo=__pseudo__" -- exemple d'action
list_ou_code_retour = http_get(action)
```

# installation

http://ipserveur/api_computercraft/installation/index.php?

- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le role de ce compte est d'administer le site via le panel admin (voir section en bas de cette page)
- mdpconfirm	:(string) doit être identique à __mdp__
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/installation/index.php?action=install&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&email=__email__

return (string)

# fonctionnement

http://ipserveur/api_computercraft/index.php?


## inscription
- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le compte aura le role 0 (client) par defaut avec le nom d'offre defini dans le fichier config
- mdpconfirm	:(string) doit être identique à __mdp__
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/index.php?action=inscription&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&email=__email__

return (string)

## listntp

http://0.0.0.0:9081/api_computercraft/index.php?action=listntp

return (array)

## listconfig

http://0.0.0.0:9081/api_computercraft/index.php?action=listconfig

return (array)

## listuserdata
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listuserdata&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listusertransaction
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listusertransaction&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listusercommande
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listusercommande&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listuseradresse
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listuseradresse&mdp=__mdp__&pseudo=__pseudo__

return (array)

## updatemail
- mdp			:(string)
- pseudo		:(string)
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/index.php?action=updatemail&mdp=__mdp__&pseudo=__pseudo__&email=__email__

return (string)

## updatemdp
- mdp			:(string)
- pseudo		:(string)
- mdpnouveau	:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- mdpconfirm	:(string) doit être identique à __mdpnouveau__

http://0.0.0.0:9081/api_computercraft/index.php?action=updatemdp&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&mdpnouveau=__mdpnouveau__

return (string)

## updateadressedefaut
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) entrer le nom d'une adresse creer au préalable (cette adresse servira de boite au lettre par defaut)(l'adresse doit avoir l'attribut type=1)

http://0.0.0.0:9081/api_computercraft/index.php?action=updateadressedefaut&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__

return (string)

## listoffresboutique

http://0.0.0.0:9081/api_computercraft/index.php?action=listoffresboutique

return (array)

## listoffresboutique
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listoffresboutique&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__

cette commande permet en plus de recuperer la liste des offres du marcher de recuperer le nombre de commande sur vos offre uniquement

return (array)

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

return (array)

## achat
- mdp			:(string)
- pseudo		:(string)
- id			:(int) id de l'offre à acheter
- quantite		:(int) quantité à acheter

http://0.0.0.0:9081/api_computercraft/index.php?action=achat&mdp=__mdp__&pseudo=__pseudo__&id=__id__&quantite=__quantite__

return (string)

## listcommandes
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listcommandes&mdp=__mdp__&pseudo=__pseudo__

return (array)

## updatecommandestatut
- mdp			:(string)
- pseudo		:(string) seul le compte expediteur peuvent changer le statut par ce biais
- id			:(int) id de la commande à modifier
- statut		:(int) nouveau statut de la commande

http://0.0.0.0:9081/api_computercraft/index.php?action=updatecommandestatut&mdp=__mdp__&pseudo=__pseudo__&id=__id__&statut=__statut__

return (string)

1-->2 (vendeur) <br/>
1-->10 (vendeur)(à l'appréciation du vendeur) <br/>
2-->3 (banque_admin : role=2) <br/>
2-->11 (banque_admin : role=2)(si le client n'a pas les fond) <br/>
3-->4 (vendeur) <br/>
4-->5 (vendeur ou banque_routeur) <br/>
5-->6 (vendeur ou banque_routeur) <br/>
6-->7 (client) <br/>
1-3-->13 (client) <br/>
4-6-->20-24 (client) <br/>
20-24-->25 (admin) <br/>

1: commande effectuer validation vendeur en attente <br/>
2: echange accepter paiement en attente <br/>
3: echange accepter paiement valider <br/>
4: commande pret a envoyer <br/>
5: commande en cours de livraison <br/>
6: commande arrivée <br/>
7: terminer <br/>
10: echange refuser par le vendeur <br/>
11: echange accepter paiement refuser <br/>
13: commande annuler par le client<br/>
20: litige commande non recu <br/>
21: litige commande non conforme <br/>
22: litige commande trop long <br/>
23: litige commande plus interesser <br/>
24: litige commande trop cher <br/>
25: litige commande resolu <br/>
	
## transaction
- mdp			:(string)
- pseudo		:(string) seul un compte compteur avec un role=2 (banque-routeur) peuvent utiliser le type commande
- type			:(int) =1(commande)

http://0.0.0.0:9081/api_computercraft/index.php?action=transaction&mdp=__mdp__&pseudo=__pseudo__&type=commande

return (string)

## transaction
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role=1 (banque-terminal) peuvent utiliser les type ci-dessous
- type			:(int)  2=transfert - 3=depot - 4=retrait - 5=achat option
- crediteur		:(string) pseudo du compte qui recoit
- debiteur		:(string) pseudo du compte qui envoie
- somme			:(float) somme a transferer
- description	:(text) text libre
- mdpuser		:(string) mot de passe de l'utilisateur réalisant la transaction

http://0.0.0.0:9081/api_computercraft/index.php?action=transaction&mdp=__mdp__&pseudo=__pseudo__&type=transfert&crediteur=__crediteur__&debiteur=__debiteur__&somme=__somme__&description=__description__&mdpuser=__mdpuser__

return (string)

## updatejetoncoffre
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role=1 (banque-terminal) peuvent entrer ses jeton
- jeton1		:(int) nombres de jeton
- jeton10		:(int) nombres de jeton
- jeton100		:(int) nombres de jeton
- jeton1k		:(int) nombres de jeton
- jeton10k		:(int) nombres de jeton

http://0.0.0.0:9081/api_computercraft/index.php?action=updatejetoncoffre&mdp=__mdp__&pseudo=__pseudo__&jeton1=__jeton1__&jeton10=__jeton10__&jeton100=__jeton100__&jeton1k=__jeton1k__&jeton10k=__jeton10k__

return (string)

## listjetoncoffre
- mdp			:(string)
- pseudo		:(string) seul un compteur avec un role superieur ou égal à 1 peut recuperer la liste des jetons

http://0.0.0.0:9081/api_computercraft/index.php?action=listjetoncoffre&mdp=__mdp__&pseudo=__pseudo__

return (array)

## addadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de la nouvelle adresse - il ne peut pas avoir 2 adresses avec le même nom
- type			:(int) (0:inactive 1:adresse de reception 2:adresse de commerce)
- coo			:(text) text libre pour les coordonnée xyz
- description	:(text) text libre

http://0.0.0.0:9081/api_computercraft/index.php?action=addadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__&type=__type__&coo=__coo__&description=__description__

return (string)

## updateadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de l'adresse donnée
- type			:(int)(optionnel) pour changer le type l'offre de doit pas être utiliser (0:inactive 1:adresse de reception 2:adresse de commerce)
- coo			:(text)(optionnel) text libre pour les coordonnée xyz
- description	:(text)(optionnel) text libre
- nouveaunom	:(string)(optionnel) nouveau nom pour l'adresse - il ne peut pas avoir 2 adresses avec le même nom

http://0.0.0.0:9081/api_computercraft/index.php?action=updateadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__&type=__type__&coo=__coo__&description=__description__&nouveaunom=__nouveaunom__

return (array)

## deleteadresse
- mdp			:(string)
- pseudo		:(string)
- nom			:(string) nom de l'adresse à supprimer (l'adresse ne doit pas être utiliser pour être supprimer)

http://0.0.0.0:9081/api_computercraft/index.php?action=deleteadresse&mdp=__mdp__&pseudo=__pseudo__&nom=__nom__

return (string)

## changemdpmail
- pseudo		:(string)
- email			:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=changemdpmail&pseudo=__pseudo__&email=__email__

return (string)

## recuperationmailmdp
- pseudo		:(string)
- token			:(string) token reçu par mail via la commande __changemdpmail__

http://0.0.0.0:9081/api_computercraft/index.php?action=recuperationmailmdp&pseudo=__pseudo__&token=__token__

return (string)


# panel admin
utiliser un compte avec un role = 10 (compte creer à l'installation du site)

## jetondelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=jetondelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__

return (string)

## joueurdelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurdelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__

return (string)

## joueurupdatecompte
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) 

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatecompte&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdatemail
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) nouveau mail

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatemail&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdatemdp
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) nouveau mot de passe

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatemdp&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdatenbr
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) re-compte le nombre d'offre au nom du joueur

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatenbr&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdatepseudo
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(string) changer le pseudo du joueur (le changement ne se fera pas si le nouveau pseudo est déjà utiliser)

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdatepseudo&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdaterole
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(int) nouveau role du joueur (vous ne pouvez pas changer le role du compte utiliser dans __pseudo__)

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdaterole&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## joueurupdateresettoken
- mdp			:(string)
- pseudo		:(string)
- player		:(string) pseudo du joueur a modifier
- newdata		:(bool) null --> supprimer le token, non null --> genere un nouveau token

http://0.0.0.0:9081/api_computercraft/index.php?action=joueurupdateresettoken&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (array)

## listadresse
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listadresse&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listcommande
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listcommande&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listjeton
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listjeton&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listjoueur
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listjoueur&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listoffre
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listoffre&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## listtransaction
- mdp			:(string)
- pseudo		:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=listtransaction&admin=1&mdp=__mdp__&pseudo=__pseudo__

return (array)

## adressedelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur propriétaire de l'adresse
- newdata		:(string) nom de l'adresse a supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=adressedelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## adresseupdatecoo
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur propriétaire de l'adresse
- newdata		:(string) nom de l'adresse à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=adresseupdatecoo&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## adresseupdatedescription
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur propriétaire de l'adresse
- newdata		:(string) nom de l'adresse à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=adresseupdatedescription&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## adresseupdatenom
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur propriétaire de l'adresse
- newdata		:(string) nom de l'adresse à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=adresseupdatenom&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## adresseupdatetype
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur propriétaire de l'adresse
- newdata		:(string) nom de l'adresse à modifier
- newtypedata	:(int)

http://0.0.0.0:9081/api_computercraft/index.php?action=adresseupdatetype&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## commandedelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur ayant fait la commande
- newdata		:(string) id de la commande à supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=commandedelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## commandeupdatetextadresseexpediteur
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur ayant fait la commande
- newdata		:(string) id de la commande à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=commandeupdatetextadresseexpediteur&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## commandeupdatetextadresserecepteur
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur ayant fait la commande
- newdata		:(string) id de la commande à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=commandeupdatetextadresserecepteur&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## commandeupdatedescription
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur ayant fait la commande
- newdata		:(string) id de la commande à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=commandeupdatedescription&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## commandeupdatestatut
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur ayant fait la commande
- newdata		:(string) id de la commande à modifier
- newtypedata	:(int)

http://0.0.0.0:9081/api_computercraft/index.php?action=commandeupdatestatut&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreadd
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de cette nouvelle offre

http://0.0.0.0:9081/api_computercraft/index.php?action=offreadd&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offredelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=offredelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdateadresse
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdateadresse&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdatedescription
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdatedescription&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdatelivraison
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(int)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdatelivraison&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdatenom
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdatenom&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdateproprio
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdateproprio&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## offreupdatetype
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du proprio de l'offre
- newdata		:(string) id de l'offre à modifier
- newtypedata	:(int)

http://0.0.0.0:9081/api_computercraft/index.php?action=offreupdatetype&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## transactionadd
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur debiter
- cplayer		:(string) nom du joueur crediter
- newdata		:(float) somme
- newtypedata	:(text) description

http://0.0.0.0:9081/api_computercraft/index.php?action=transactionadd&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## transactiondelete
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur debiter
- newdata		:(string) id de la transaction à supprimer

http://0.0.0.0:9081/api_computercraft/index.php?action=transactiondelete&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## transactionupdatedescription
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur debiter
- newdata		:(string) id de la transaction à modifier
- newtypedata	:(text)

http://0.0.0.0:9081/api_computercraft/index.php?action=transactionupdatedescription&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## transactionupdatestatut
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur debiter
- newdata		:(string) id de la transaction à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=transactionupdatestatut&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)

## transactionupdatetype
- mdp			:(string)
- pseudo		:(string)
- player		:(string) nom du joueur debiter
- newdata		:(string) id de la transaction à modifier
- newtypedata	:(string)

http://0.0.0.0:9081/api_computercraft/index.php?action=transactionupdatetype&admin=1&mdp=__mdp__&pseudo=__pseudo__&player=__player__&newdata=__newdata__

return (string)
