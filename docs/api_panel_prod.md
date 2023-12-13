# panel de production de l'api http

## table des matieres
==================
* [panel_user de l'api http](#panel_user-de-lapi-http)
    * [table des matieres](#table-des-matieres)
    * [description](#description)
    * [liste des actions](#liste-des-actions)
        * [nom_action (exemple)](#nom_action-exemple)
        * [getntp](#getntp)
        * [getconfig](#getconfig)
        * [gestion des comptes](#gestion-des-comptes)
            * [addcompte](#addcompte)
            * [deletecompte](#deletecompte)
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptes](#getcomptes)
        * [gestion des jeton](#gestion-des-jeton)
            * [editjeton](#editjeton)
            * [getjetons](#getjetons)
        * [gestion des joueurs](#gestion-des-joueurs)
            * [addjoueur](#addjoueur)
            * [deletejoueur](#deletejoueur)
            * [editjoueuremail](#editjoueuremail)
            * [editjoueurmdp](#editjoueurmdp)
            * [editjoueurpseudo](#editjoueurpseudo)
            * [getjoueurbyid](#getjoueurbyid)
            * [getjoueurbypseudo](#getjoueurbypseudo)
            * [getjoueurs](#getjoueurs)
            * [recuperationmdpemail](#recuperationmdpemail)
            * [recuperationmdpemailtoken](#recuperationmdpemailtoken)
        * [gestion des transactions](#gestion-des-transactions)
            * [addtransaction](#addtransaction)
            * [edittransactionstatus](#edittransactionstatus)
            * [exectransaction](#exectransaction)
            * [execalltransactions](#execalltransactions)
            * [gettransactionbyid](#gettransactionbyid)
            * [gettransactionsbycompte](#gettransactionsbycompte)

## description

le panel user sert a useristrer les données de l'api sans les restriction de droits ou d'ordre de fonctionnement.
les actions du panel doivent être effectuer par un compte avec un rang "user".
n'utiliser ce panel que pour des conflits ou des erreurs de fonctionnement.

sur certain type il n'est pas possible d'effectuer toutes les action du CRUD, par exemple:

les commande et les transaction ne peuvent pas être supprimer.
les transaction ne peuvent pas être modifier.
les keypay ne peuvent que être consulter.
(dans le panel utilisateur)les keypay se suprimme automatiquement quand la commande est creer ou que la keypay arrive à expiration.

les chaine de caractere sont limiter a 450 caractere pour les champs "description" et a 50 caractere pour les champs "pseudo" et "nom".

| code | description |
|:---:|:--- |
| 200 | la requete a été effectuer avec succes |
| 400 | parametre manquant |
| 403 | vous n'avez pas les droits ou les identifiant user sont incorrect |
| 404 | l'élément indiquer n'existe pas |
| 413 | la longueur d'un parametre est trop longue |
| 500 | le serveur n'a pas pu effectuer la requete |


## liste des actions

### nom_action (exemple)
- param1	:(type) parametre obligatoire
- param2    :(type)(vide) parametre non obligatoire --> doit être envoyer mais la valeur peut être vide

http://0.0.0.0:9081/api_computercraft/index.php?action=__nom_action__&__param1__=__param1_val__&__param2__=__param2_val__

return (json_format)<br/>

```lua
global_url = "0.0.0.0"
global_port = "9081"
global_uri = "api_computercraft"
function http_get(action)
	local source_return, err = http.get("http://"..global_url..":"..global_port.."/"..global_uri.."/index.php?action="..action)
	local source_text = source_return.readAll()
	return textutils.unserialise(source_text)
end

action="getjoueurbypseudo&mdp=__mdpuser__&pseudo=__pseudo__&user=true" -- exemple d'action
list_ou_code_retour = http_get(action)
print(list_ou_code_retour.status_code())-- =200 si la commande a ete effectuer
print(list_ou_code_retour.message())
print(list_ou_code_retour.data())-- n'est retourner que si une action get.. est effectuer avec succes
```

### getntp
http:/__global_url__:__global_port__/__global_uri__/index.php?action=getntp&user=true


### getconfig
http://__global_url__:__global_port__/__global_uri__/index.php?action=getconfig&user=true

### gestion des comptes
#### addcompte
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- nom		:(str) nom du compte
- id_type_compte :(int) id du type de compte

http://__global_url__:__global_port__/__global_uri__/index.php?action=addcompte&user=true&user=__user__&mdpuser=__mdpuser__&nom=__nom__&id_type_compte=__id_type_compte__

#### deletecompte
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_compte :(int) id du compte à supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletecompte&user=true&user=__user__&mdpuser=__mdpuser__&id_compte=__id_compte__

#### editcomptenom
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_compte :(int) id du compte à modifier
- nom		:(str) nouveau nom du compte

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcomptenom&user=true&user=__user__&mdpuser=__mdpuser__&id_compte=__id_compte__&nom=__nom__

#### getcomptebyid
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_compte :(int) id du compte à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcomptebyid&user=true&user=__user__&mdpuser=__mdpuser__&id_compte=__id_compte__

#### getcomptes
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcomptes&user=true&user=__user__&mdpuser=__mdpuser__


### gestion des jetons
#### editjeton
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- 1 		:(str) jeton
- 10 		:(str) jeton
- 100 		:(str) jeton
- 1k 		:(str) jeton
- 10k 		:(str) jeton

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjeton&user=true&user=__user__&mdpuser=__mdpuser__&1=__1__&10=__10__&100=__100__&1k=__1k__&10k=__10k__

#### getjetons
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjetons&user=true&user=__user__&mdpuser=__mdpuser__


### gestion des joueurs
#### addjoueur
- email 	:(str) email du joueur
- mdp 		:(str) mdp du joueur
- pseudo 	:(str) pseudo du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=addjoueur&user=true&email=__email__&mdp=__mdpuser__&pseudo=__pseudo__

#### deletejoueur
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletejoueur&user=true&user=__user__&mdpuser=__mdpuser__&id_joueur=__id_joueur__

#### editjoueuremail
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- email 	:(str) email du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueuremail&user=true&user=__user__&mdpuser=__mdpuser__&id_joueur=__id_joueur__&email=__email__

#### editjoueurmdp
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- mdp 		:(str) mdp du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurmdp&user=true&user=__user__&mdpuser=__mdpuser__&id_joueur=__id_joueur__&mdp=__mdpuser__

#### editjoueurpseudo
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- pseudo 	:(str) pseudo du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurpseudo&user=true&user=__user__&mdpuser=__mdpuser__&id_joueur=__id_joueur__&pseudo=__pseudo__

#### getjoueurbyid
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_joueur :(int) id du joueur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurbyid&user=true&user=__user__&mdpuser=__mdpuser__&id_joueur=__id_joueur__

#### getjoueurbypseudo
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- pseudo 	:(str) pseudo du joueur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurbypseudo&user=true&user=__user__&mdpuser=__mdpuser__&pseudo=__pseudo__

#### getjoueurs
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurs&user=true&user=__user__&mdpuser=__mdpuser__

#### recuperationmdpemail
- pseudo	:(str) pseudo du compte a recuperer
- email	    :(str) email du compte

http://__global_url__:__global_port__/__global_uri__/index.php?action=recuperationmdpemail&user=true&pseudo=__user__&email=__email__

#### recuperationmdpemailtoken
- pseudo	:(str) pseudo du compte a recuperer
- token	    :(str) token recu sur la boite mail

http://__global_url__:__global_port__/__global_uri__/index.php?action=recuperationmdpemailtoken&user=true&pseudo=__user__&token=__token__


### gestion des transactions
#### addtransaction
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_commande :(int)(vide) id de la commande de la transaction (peut etre null)
- id_type_transaction :(int) id du type de la transaction
- id_compte_crediteur :(int)(vide) id du compte crediteur
- id_compte_debiteur :(int)(vide) id du compte debiteur
- montant :(float) montant de la transaction
- nom :(str) nom de la transaction
- description :(str) description de la transaction

au moins un des deux compte peut etre "vide"

http://__global_url__:__global_port__/__global_uri__/index.php?action=addtransaction&user=true&user=__user__&mdpuser=__mdpuser__&id_commande=__id_commande__&id_type_transaction=__id_type_transaction__&id_compte_crediteur=__id_compte_crediteur__&id_compte_debiteur=__id_compte_debiteur__&montant=__montant__&nom=__nom__&description=__description__

#### edittransactionstatus
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_transaction :(int) id de la transaction a modifier
- id_type_status_transaction :(int) id du status de la transaction

http://__global_url__:__global_port__/__global_uri__/index.php?action=edittransactionstatus&user=true&user=__user__&mdpuser=__mdpuser__&id_transaction=__id_transaction__&id_type_status_transaction=__id_type_status_transaction__

#### exectransaction
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_transaction :(int) id de la transaction a executer

http://__global_url__:__global_port__/__global_uri__/index.php?action=exectransaction&user=true&user=__user__&mdpuser=__mdpuser__&id_transaction=__id_transaction__

#### execalltransactions
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user

http://__global_url__:__global_port__/__global_uri__/index.php?action=execalltransactions&user=true&user=__user__&mdpuser=__mdpuser__

#### gettransactionbyid
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_transaction :(int) id de la transaction a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionbyid&user=true&user=__user__&mdpuser=__mdpuser__&id_transaction=__id_transaction__

#### gettransactionsbycompte
- user	:(str) pseudo du compte user
- mdpuser	:(str) mdp du compte user
- id_compte :(int) id du compte des transactions a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionsbycompte&user=true&user=__user__&mdpuser=__mdpuser__&id_compte=__id_compte__
