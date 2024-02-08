# panel de production de l'api http

## table des matieres
==================
* [panel de l'api http](#panel-de-lapi-http)
    * [table des matieres](#table-des-matieres)
    * [description](#description)
    * [liste des actions](#liste-des-actions)
        * [nom_action (exemple)](#nom_action-exemple)
        * [getntp](#getntp)
        * [getconfig](#getconfig)
        * [gestion des adresses](#gestion-des-adresses)
            * [addadresse](#addadresse)
            * [deleteadresse](#deleteadresse)
            * [editadressecoo](#editadressecoo)
            * [editadressedescription](#editadressedescription)
            * [editadressenom](#editadressenom)
            * [getadressebyid](#getadressebyid)
            * [getadresses](#getadresses)
            * [getadressesbygroupe](#getadressesbygroupe)
        * [gestion des apikey](#gestion-des-apikey)
            * [addapikey](#addapikey)
            * [addapikeydroit](#addapikeydroit)
            * [deleteapikey](#deleteapikey)
            * [deleteapikeydroit](#deleteapikeydroit)
            * [editapikeymdp](#editapikeymdp)
            * [editapikeynom](#editapikeynom)
            * [getapikeybyid](#getapikeybyid)
            * [getapikeys](#getapikeys)
            * [getapikeysbygroupe](#getapikeysbygroupe)
            * [getdroitsbyapikey](#getdroitsbyapikey)
        * [gestion des commandes](#gestion-des-commandes)
            * [addcommande](#addcommande)
            * [editcommandelivreur](#editcommandelivreur)
            * [editcommandestatus](#editcommandestatus)
            * [getcommandebyid](#getcommandebyid)
            * [getcommandesbyadresse](#getcommandesbyadresse)
            * [getcommandesbyadresseclient](#getcommandesbyadresseclient)
            * [getcommandesbyadressevendeur](#getcommandesbyadressevendeur)
            * [getcommandesbycompte](#getcommandesbycompte)
            * [getcommandesbycompteclient](#getcommandesbycompteclient)
            * [getcommandesbycomptevendeur](#getcommandesbycomptevendeur)
            * [getcommandesbylivreur](#getcommandesbylivreur)
            * [getcommandesbyoffre](#getcommandesbyoffre)
            * [getcommandesnolivreur](#getcommandesnolivreur)
        * [gestion des comptes](#gestion-des-comptes)
            * [addcompte](#addcompte)
            * [deletecompte](#deletecompte)
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptes](#getcompte)
            * [getcomptesbygroupe](#getcomptesbygroupe)
        * [gestion des enderstorageschest](#gestion-des-enderstorageschest)
            * [editenderstorageschest](#editenderstorageschest)
            * [getenderstorageschest](#getenderstorageschest)
            * [getenderstorageschestbyid](#getenderstorageschestbyid)
            * [getenderstorageschestdispo](#getenderstorageschestdispo)
            * [getenderstorageschestjoueur](#getenderstorageschestjoueur)
        * [gestion des enderstoragestank](#gestion-des-enderstoragestank)
            * [editenderstoragestank](#editenderstoragestank)
            * [getenderstoragestank](#getenderstoragestank)
            * [getenderstoragestankbyid](#getenderstoragestankbyid)
            * [getenderstoragestankdispo](#getenderstoragestankdispo)
            * [getenderstoragestankjoueur](#getenderstoragestankjoueur)
        * [gestion des groupes](#gestion-des-groupes)
            * [addgroupe](#addgroupe)
            * [addgroupeadresse](#addgroupeadresse)
            * [addgroupeapikey](#addgroupeapikey)
            * [addgroupecompte](#addgroupecompte)
            * [addgroupedroit](#addgroupedroit)
            * [addgroupejoueur](#addgroupejoueur)
            * [addgroupelivreur](#addgroupelivreur)
            * [addgroupeoffre](#addgroupeoffre)
            * [deletegroupe](#deletegroupe)
            * [deletegroupeadresse](#deletegroupeadresse)
            * [deletegroupeapikey](#deletegroupeapikey)
            * [deletegroupecompte](#deletegroupecompte)
            * [deletegroupedroit](#deletegroupedroit)
            * [deletegroupejoueur](#deletegroupejoueur)
            * [deletegroupelivreur](#deletegroupelivreur)
            * [deletegroupeoffre](#deletegroupeoffre)
            * [editgroupenom](#editgroupenom)
            * [getdroitsbygroupe](#getdroitsbygroupe)
            * [getgroupebyid](#getgroupebyid)
            * [getgroupes](#getgroupes)
            * [getgroupesbyadresse](#getgroupesbyadresse)
            * [getgroupesbyapikey](#getgroupesbyapikey)
            * [getgroupesbycompte](#getgroupesbycompte)
            * [getgroupesbyjoueurmembre](#getgroupesbyjoueurmembre)
            * [getgroupesbylivreur](#getgroupesbylivreur)
            * [getgroupesbyoffre](#getgroupesbyoffre)
        * [gestion des jeton](#gestion-des-jeton)
            * [getjetonbyjoueur](#getjetonbyjoueur)
            * [getjetons](#getjetons)
        * [gestion des joueurs](#gestion-des-joueurs)
            * [addjoueur](#addjoueur)
            * [deletejoueur](#deletejoueur)
            * [editjoueuremail](#editjoueuremail)
            * [editjoueurmdp](#editjoueurmdp)
            * [editjoueurnbroffre](#editjoueurnbroffre)
            * [editjoueurpseudo](#editjoueurpseudo)
            * [editjoueurrecupmdpbyemail](#editjoueurrecupmdpbyemail)
            * [editjoueurrecupmdpbyemailtoken](#editjoueurrecupmdpbyemailtoken)
            * [getjoueurbyid](#getjoueurbyid)
            * [getjoueurbypseudo](#getjoueurbypseudo)
            * [getjoueursbygroupe](#getjoueursbygroupe)
            * [getjoueursbygroupe](#getjoueursbygroupe)
        * [gestion des keypay](#gestion-des-keypay)
            * [addkeypay](#addkeypay)
            * [getkeypaybyid](#getkeypaybyid)
            * [getkeypaysbyoffre](#getkeypaysbyoffre)
        * [gestion des litigemsg](#gestion-des-litigemsg)
            * [addlitigemsg](#addlitigemsg)
            * [deletelitigemsg](#deletelitigemsg)
            * [getlitigemsgsbycommande](#getlitigemsgsbycommande)
        * [gestion des livreurs](#gestion-des-livreurs)
            * [addlivreur](#addlivreur)
            * [deletelivreur](#deletelivreur)
            * [editlivreuradresse](#editlivreuradresse)
            * [editlivreurcompte](#editlivreurcompte)
            * [editlivreurnom](#editlivreurnom)
            * [getlivreurbyid](#getlivreurbyid)
            * [getlivreurs](#getlivreurs)
            * [getlivreursbyadresse](#getlivreursbyadresse)
            * [getlivreursbycompte](#getlivreursbycompte)
            * [getlivreursbygroupe](#getlivreursbygroupe)
        * [gestion des offres](#gestion-des-offres)
            * [addoffre](#addoffre)
            * [deleteoffre](#deleteoffre)
            * [editoffreadresse](#editoffreadresse)
            * [editoffrecompte](#editoffrecompte)
            * [editoffredescription](#editoffredescription)
            * [editoffrenom](#editoffrenom)
            * [editoffreprix](#editoffreprix)
            * [editoffrestock](#editoffrestock)
            * [editoffretype](#editoffretype)
            * [getoffrebyid](#getoffrebyid)
            * [getoffres](#getoffres)
            * [getoffresall](#getoffresall)
            * [getoffresbyadresse](#getoffresbyadresse)
            * [getoffresbycompte](#getoffresbycompte)
            * [getoffresbygroupe](#getoffresbygroupe)
        * [gestion des transactions](#gestion-des-transactions)
            * [addtransaction](#addtransaction)
            * [gettransactionbyid](#gettransactionbyid)
            * [gettransactionsbycompte](#gettransactionsbycompte)
            * [gettransactionsbycomptecommande](#gettransactionsbycomptecommande)
        * [gestion des wireless](#gestion-des-wireless)
            * [editendwireless](#editendwireless)
            * [getendwireless](#getendwireless)
            * [getendwirelessbyid](#getendwirelessbyid)
            * [getendwireless](#getendwireless)
            * [getendwirelessdispo](#getendwirelessdispo)

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

http://0.0.0.0:9081/api/index.php?action=__nom_action__&__param1__=__param1_val__&__param2__=__param2_val__

return (json_format)<br/>

```lua
global_url = "0.0.0.0"
global_port = "9081"
global_uri = "api"
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
