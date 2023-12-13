# panel d'administration de l'api http

## table des matieres
==================
* [panel_admin de l'api http](#panel_admin-de-lapi-http)
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
            * [getadressesbyjoueur](#getadressesbyjoueur)
        * [gestion des commandes](#gestion-des-commandes)
            * [addcommande](#addcommande)
            * [editcommandecoderetrait](#editcommandecoderetrait)
            * [editcommandedatelivraison](#editcommandedatelivraison)
            * [editcommandestatus](#editcommandestatus)
            * [editcommandelivreur](#editcommandelivreur)
            * [getcommandebyid](#getcommandebyid)
            * [getcommandesbyadresse](#getcommandesbyadresse)
            * [getcommandesbyadresseclient](#getcommandesbyadresseclient)
            * [getcommandesbyadressevendeur](#getcommandesbyadressevendeur)
            * [getcommandesbycompte](#getcommandesbycompte)
            * [getcommandesbycompteclient](#getcommandesbycompteclient)
            * [getcommandesbycomptevendeur](#getcommandesbycomptevendeur)
            * [getcommandesbylivreur](#getcommandesbylivreur)
            * [getcommandesbyoffre](#getcommandesbyoffre)
            * [getcommandesbystatus](#getcommandesbystatus)
        * [gestion des comptes](#gestion-des-comptes)
            * [addcompte](#addcompte)
            * [deletecompte](#deletecompte)
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptebyjoueur](#getcomptebyjoueur)
        * [gestion des groupes](#gestion-des-groupes)
            * [addgroupeadresse](#addgroupeadresse)
            * [addgroupeapikey](#addgroupeapikey)
            * [addgroupecompte](#addgroupecompte)
            * [addgroupedroit](#addgroupedroit)
            * [addgroupe](#addgroupe)
            * [addgroupejoueur](#addgroupejoueur)
            * [addgroupelivreur](#addgroupelivreur)
            * [addgroupeoffre](#addgroupeoffre)
            * [deletegroupeadresse](#deletegroupeadresse)
            * [deletegroupeapikey](#deletegroupeapikey)
            * [deletegroupecompte](#deletegroupecompte)
            * [deletegroupedroit](#deletegroupedroit)
            * [deletegroupe](#deletegroupe)
            * [deletegroupejoueur](#deletegroupejoueur)
            * [deletegroupelivreur](#deletegroupelivreur)
            * [deletegroupeoffre](#deletegroupeoffre)
            * [editgroupenom](#editgroupenom)
            * [getadressesbygroupe](#getadressesbygroupe)
            * [getcomptesbygroupe](#getcomptesbygroupe)
            * [getdroitsbygroupe](#getdroitsbygroupe)
            * [getgroupebyid](#getgroupebyid)
            * [getgroupesbyadresse](#getgroupesbyadresse)
            * [getgroupesbyapikey](#getgroupesbyapikey)
            * [getgroupesbycompte](#getgroupesbycompte)
            * [getgroupesbyjoueur](#getgroupesbyjoueur)
            * [getgroupesbyjoueurmembre](#getgroupesbyjoueurmembre)
            * [getgroupesbylivreur](#getgroupesbylivreur)
            * [getgroupesbyoffre](#getgroupesbyoffre)
            * [getjoueursbygroupe](#getjoueursbygroupe)
            * [getapikeysbygroupe](#getapikeysbygroupe)
            * [getlivreursbygroupe](#getlivreursbygroupe)
            * [getoffresbygroupe](#getoffresbygroupe)
        * [gestion des jeton](#gestion-des-jeton)
            * [addjeton](#addjeton)
            * [deletejeton](#deletejeton)
            * [editjeton](#editjeton)
            * [getjetonbyjoueur](#getjetonbyjoueur)
            * [getjetons](#getjetons)
        * [gestion des joueurs](#gestion-des-joueurs)
            * [addjoueur](#addjoueur)
            * [deletejoueur](#deletejoueur)
            * [editjoueuremail](#editjoueuremail)
            * [editjoueurmdp](#editjoueurmdp)
            * [editjoueurnbroffre](#editjoueurnbroffre)
            * [editjoueurpseudo](#editjoueurpseudo)
            * [editjoueurrole](#editjoueurrole)
            * [getjoueurbyid](#getjoueurbyid)
            * [getjoueurbypseudo](#getjoueurbypseudo)
            * [getjoueurs](#getjoueurs)
        * [gestion des apikey](#gestion-des-apikey)
            * [addapikey](#addapikey)
            * [deleteapikey](#deleteapikey)
            * [addapikeydroit](#addapikeydroit)
            * [deleteapikeydroit](#deleteapikeydroit)
            * [editapikeymdp](#editapikeymdp)
            * [editapikeynom](#editapikeynom)
            * [getapikeybyid](#getapikeybyid)
            * [getapikeydroitsbyid](#getapikeydroitsbyid)
            * [getapikeysbyjoueur](#getapikeysbyjoueur)
        * [gestion des keypay](#gestion-des-keypay)
            * [getkeypaybyid](#getkeypaybyid)
            * [getkeypaysbyoffre](#getkeypaysbyoffre)
        * [gestion des litiges](#gestion-des-litiges)
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
            * [getlivreursbyadresse](#getlivreursbyadresse)
            * [getlivreursbycompte](#getlivreursbycompte)
            * [getlivreursbyjoueur](#getlivreursbyjoueur)
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
            * [getoffresbyadresse](#getoffresbyadresse)
            * [getoffresbycompte](#getoffresbycompte)
            * [getoffresbyjoueur](#getoffresbyjoueur)
        * [gestion des transactions](#gestion-des-transactions)
            * [addtransaction](#addtransaction)
            * [gettransactionbyid](#gettransactionbyid)
            * [gettransactionsbyadmin](#gettransactionsbyadmin)
            * [gettransactionsbycommande](#gettransactionsbycommande)
            * [gettransactionsbycompte](#gettransactionsbycompte)

## description

le panel admin sert a administrer les données de l'api sans les restriction de droits ou d'ordre de fonctionnement.
les actions du panel doivent être effectuer par un compte avec un rang "admin".
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
| 403 | vous n'avez pas les droits ou les identifiant admin sont incorrect |
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

action="getjoueurbypseudo&mdp=__mdp__&pseudo=__pseudo__&admin=true" -- exemple d'action
list_ou_code_retour = http_get(action)
print(list_ou_code_retour.status_code())-- =200 si la commande a ete effectuer
print(list_ou_code_retour.message())
print(list_ou_code_retour.data())-- n'est retourner que si une action get.. est effectuer avec succes
```

### getntp
http:/__global_url__:__global_port__/__global_uri__/index.php?action=getntp&admin=true


### getconfig
http://__global_url__:__global_port__/__global_uri__/index.php?action=getconfig&admin=true


### gestion des adresses
#### addadresse
- admin	        :(str) pseudo du compte admin
- mdpadmin	        :(str) mdp du compte admin
- id_joueur	        :(int) id du joueur auquel appartiendra l'adresse
- nom	            :(str) nom de la nouvelle adresse
- id_type_adresse	:(int) id du type d'adresse (obtenir les type existant avec la commande getconfig)
- description	    :(str) description de l'adresse
- coo	            :(str) coordonnée de l'adresse
- id_livreur	    :(int)(vide) si l'adresse n'est pas un point de livraison, sinon id du livreur qui livre à cette adresse

http://__global_url__:__global_port__/__global_uri__/index.php?action=addadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&nom=__nom__&id_type_adresse=__id_type_adresse__&description=__description__&coo=__coo__&id_livreur=__id_livreur__

#### deleteadresse
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse à supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deleteadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### editadressecoo
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse à modifier
- coo	        :(str) nouvelle coordonnée de l'adresse

http://__global_url__:__global_port__/__global_uri__/index.php?action=editadressecoo&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__&coo=__coo__

#### editadressedescription
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse à modifier
- description	:(str) nouvelle description de l'adresse

http://__global_url__:__global_port__/__global_uri__/index.php?action=editadressedescription&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__&description=__description__

#### editadressenom
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse à modifier
- nom	        :(str) nouveau nom de l'adresse

http://__global_url__:__global_port__/__global_uri__/index.php?action=editadressenom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__&nom=__nom__

#### getadressebyid
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getadressebyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getadressesbyjoueur
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_joueur	    :(int) id du joueur auquel appartiennent les adresses

http://__global_url__:__global_port__/__global_uri__/index.php?action=getadressesbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__


### gestion des commandes
#### addcommande
- admin	                :(str) pseudo du compte admin
- mdpadmin	                :(str) mdp du compte admin
- id_offre	                :(int) id de l'offre
- id_adresse_client	        :(int) id de l'adresse du client
- id_compte_client	        :(int) id du compte du client
- id_type_commande	:(int) id du type de status de la commande
- code_retrait_commande	    :(str) code de retrait de la commande
- description	            :(str) description de la commande
- frait	                    :(float) frait de la commande
- prixu	                    :(float) prix unitaire de la commande
- quant	                    :(int) quantité de la commande
- nom	                    :(str) nom de la commande

http://__global_url__:__global_port__/__global_uri__/index.php?action=addcommande&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&id_adresse_client=__id_adresse_client__&id_compte_client=__id_compte_client__&id_type_commande=__id_type_commande__&code_retrait_commande=__code_retrait__&description=__description__&frait=__frait__&prixu=__prixu__&quant=__quant__&nom=__nom__

#### editcommandecoderetrait
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_commande	:(int) id de la commande à modifier
- code_retrait_commande	:(str) nouveau code de retrait de la commande

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcommandecoderetrait&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&code_retrait_commande=__code_retrait__

#### editcommandedatelivraison
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_commande	:(int) id de la commande à modifier
- date_livraison	:(str)(vide) nouvelle date de livraison de la commande (envoyer "" pour supprimer la date de livraison)

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcommandedatelivraison&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&date_livraison=__date_livraison__

#### editcommandestatus
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_commande	:(int) id de la commande à modifier
- id_type_commande	:(int) nouvelle id du type de status de la commande

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcommandestatus&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&id_type_commande=__id_type_commande__

#### editcommandelivreur
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_commande	:(int) id de la commande à modifier
- id_livreur	:(int)(vide) id du livreur de la commande (envoyer "" pour supprimer le lien au livreur)

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcommandelivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&id_livreur=__id_livreur__

#### getcommandebyid
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_commande	:(int) id de la commande à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandebyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__

#### getcommandesbyadresse
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbyadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getcommandesbyadresseclient
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbyadresseclient&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getcommandesbyadressevendeur
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_adresse	:(int) id de l'adresse des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbyadressevendeur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getcommandesbycompte
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_compte	:(int) id du compte des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbycompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getcommandesbycompteclient
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_compte	:(int) id du compte des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbycompteclient&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getcommandesbycomptevendeur
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_compte	:(int) id du compte des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbycomptevendeur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getcommandesbylivreur
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_livreur	:(int) id du livreur des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbylivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__

#### getcommandesbyoffre
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_offre	:(int) id de l'offre des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbyoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__

#### getcommandesbystatus
- admin	    :(str) pseudo du compte admin
- mdpadmin	    :(str) mdp du compte admin
- id_type_commande	:(int) id du type de status des commandes à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcommandesbystatus&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_type_commande=__id_type_commande__

### gestion des comptes
#### addcompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- nom		:(str) nom du compte
- id_joueur :(int) id du joueur auquel appartiendra le compte
- id_type_compte :(int) id du type de compte

http://__global_url__:__global_port__/__global_uri__/index.php?action=addcompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&nom=__nom__&id_joueur=__id_joueur__&id_type_compte=__id_type_compte__

#### deletecompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte à supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletecompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### editcomptenom
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte à modifier
- nom		:(str) nouveau nom du compte

http://__global_url__:__global_port__/__global_uri__/index.php?action=editcomptenom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__&nom=__nom__

#### getcomptebyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcomptebyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getcomptebyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur auquel appartient les compte à obtenir

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcomptebyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__


### gestion des groupes
#### addgroupeadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter l'adresse
- id_adresse :(int) id de l'adresse à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupeadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_adresse=__id_adresse__

#### addgroupeapikey
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter l\'apikey
- id_apikey :(int) id de l\'apikey à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupeapikey&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_apikey=__id_apikey__

#### addgroupecompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter le compte
- id_compte :(int) id du compte à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupecompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_compte=__id_compte__

#### addgroupedroit
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter le droit
- id_droit :(int) id du droit à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupedroit&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_droit=__id_droit__

#### addgroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- nom :(str) nom du groupe
- id_joueur :(int) id du joueur auquel appartiendra le groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&nom=__nom__&id_joueur=__id_joueur__

#### addgroupejoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter le joueur
- id_joueur :(int) id du joueur à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupejoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_joueur=__id_joueur__

#### addgroupelivreur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter le livreur
- id_livreur :(int) id du livreur à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupelivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_livreur=__id_livreur__

#### addgroupeoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel ajouter l'offre
- id_offre :(int) id de l'offre à ajouter au groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=addgroupeoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_offre=__id_offre__

#### deletegroupeadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer l'adresse
- id_adresse :(int) id de l'adresse à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupeadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_adresse=__id_adresse__

#### deletegroupeapikey
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer l\'apikey
- id_apikey :(int) id de l\'apikey à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupeapikey&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_apikey=__id_apikey__

#### deletegroupecompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer le compte
- id_compte :(int) id du compte à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupecompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_compte=__id_compte__

#### deletegroupedroit
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer le droit
- id_droit :(int) id du droit à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupedroit&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_droit=__id_droit__

#### deletegroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe à supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### deletegroupejoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer le joueur
- id_joueur :(int) id du joueur à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupejoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_joueur=__id_joueur__

#### deletegroupelivreur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer le livreur
- id_livreur :(int) id du livreur à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupelivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_livreur=__id_livreur__

#### deletegroupeoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe auquel supprimer l'offre
- id_offre :(int) id de l'offre à supprimer du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletegroupeoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&id_offre=__id_offre__

#### editgroupenom
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe à modifier
- nom :(str) nouveau nom du groupe

http://__global_url__:__global_port__/__global_uri__/index.php?action=editgroupenom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__&nom=__nom__

#### getadressesbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les adresses

http://__global_url__:__global_port__/__global_uri__/index.php?action=getadressesbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getcomptesbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les comptes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getcomptesbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getdroitsbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les droits

http://__global_url__:__global_port__/__global_uri__/index.php?action=getdroitsbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getgroupebyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les infos

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupebyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getgroupesbyadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_adresse :(int) id de l'adresse dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbyadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getgroupesbyapikey
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbyapikey&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__

#### getgroupesbycompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbycompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getgroupesbyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### getgroupesbyjoueurmembre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbyjoueurmembre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### getgroupesbylivreur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbylivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__

#### getgroupesbyoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre dont on veut les groupes

http://__global_url__:__global_port__/__global_uri__/index.php?action=getgroupesbyoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__

#### getjoueursbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les joueurs

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueursbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getapikeysbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les apikeys

http://__global_url__:__global_port__/__global_uri__/index.php?action=getapikeysbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getlivreursbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les livreurs

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlivreursbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

#### getoffresbygroupe
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_groupe :(int) id du groupe dont on veut les offres

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffresbygroupe&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_groupe=__id_groupe__

### gestion des jetons
#### addjeton
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut creer un jeton

http://__global_url__:__global_port__/__global_uri__/index.php?action=addjeton&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### deletejeton
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut supprimer le jeton

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletejeton&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### editjeton
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut modifier le jeton
- 1 		:(str) jeton
- 10 		:(str) jeton
- 100 		:(str) jeton
- 1k 		:(str) jeton
- 10k 		:(str) jeton

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjeton&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&1=__1__&10=__10__&100=__100__&1k=__1k__&10k=__10k__

#### getjetonbyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur dont on veut le jeton

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjetonbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### getjetons
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjetons&admin=true&admin=__admin__&mdpadmin=__mdpadmin__


### gestion des joueurs
#### addjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- email 	:(str) email du joueur
- mdp 		:(str) mdp du joueur
- nbroffre 	:(int)(vide) nombre d'offre du joueur (defaut nbr prevu dans le fichier config)
- pseudo 	:(str) pseudo du joueur
- id_type_role 	:(str) id role du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=addjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&email=__email__&mdp=__mdp__&nbroffre=__nbroffre__&pseudo=__pseudo__&id_type_role=__id_type_role__

#### deletejoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletejoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### editjoueuremail
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a modifier
- email 	:(str) email du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueuremail&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&email=__email__

#### editjoueurmdp
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a modifier
- mdp 		:(str) mdp du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurmdp&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&mdp=__mdp__

#### editjoueurnbroffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a modifier
- nbroffre 	:(int) nombre d'offre du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurnbroffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&nbroffre=__nbroffre__

#### editjoueurpseudo
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a modifier
- pseudo 	:(str) pseudo du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurpseudo&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&pseudo=__pseudo__

#### editjoueurrole
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a modifier
- id_type_role :(int) role du joueur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editjoueurrole&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&id_type_role=__id_type_role__

#### getjoueurbyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurbyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__

#### getjoueurbypseudo
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- pseudo 	:(str) pseudo du joueur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurbypseudo&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&pseudo=__pseudo__

#### getjoueurs
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin

http://__global_url__:__global_port__/__global_uri__/index.php?action=getjoueurs&admin=true&admin=__admin__&mdpadmin=__mdpadmin__


### gestion des apikey
#### addapikey
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- nom 		:(str) nom de l\'apikey
- mdp 		:(str) mdp de l\'apikey
- id_joueur :(int) id du joueur a qui appartient l\'apikey

http://__global_url__:__global_port__/__global_uri__/index.php?action=addapikey&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&nom=__nom__&mdp=__mdp__&id_joueur=__id_joueur__

#### deleteapikey
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deleteapikey&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__

#### addapikeydroit
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a modifier
- id_droit 	:(int) id du droit a ajouter

http://__global_url__:__global_port__/__global_uri__/index.php?action=addapikeydroit&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__&id_droit=__id_droit__

#### deleteapikeydroit
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a modifier
- id_droit 	:(int) id du droit a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deleteapikeydroit&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__&id_droit=__id_droit__

#### editapikeymdp
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a modifier
- mdp 		:(str) nouveau mdp de l\'apikey

http://__global_url__:__global_port__/__global_uri__/index.php?action=editapikeymdp&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__&mdp=__mdp__

#### editapikeynom
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a modifier
- nom 		:(str) nouveau nom de l\'apikey

http://__global_url__:__global_port__/__global_uri__/index.php?action=editapikeynom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__&nom=__nom__

#### getapikeybyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getapikeybyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__

#### getapikeydroitsbyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_apikey :(int) id de l\'apikey a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getapikeydroitsbyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_apikey=__id_apikey__

#### getapikeysbyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getapikeysbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__


### gestion des keypay
#### getkeypaybyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_keypay :(int) id de la keypay a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getkeypaybyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_keypay=__id_keypay__

#### getkeypaysbyoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre 	:(int) id de l'offre a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getkeypaysbyoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__


### gestion des litiges
#### addlitigemsg
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_commande :(int) id de la commande a laquelle est lie le litige
- description :(str) description du litige
- id_status_litigemsg :(int) id du status du litige

http://__global_url__:__global_port__/__global_uri__/index.php?action=addlitigemsg&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&description=__description__&id_status_litigemsg=__id_status_litigemsg__

#### deletelitigemsg
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_litigemsg :(int) id du litige a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletelitigemsg&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_litigemsg=__id_litigemsg__

#### getlitigemsgsbycommande
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_commande :(int) id de la commande a laquelle sont lie les litiges

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlitigemsgsbycommande&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__


### gestion des livraisons
#### addlivreur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur qui est livreur
- id_adresse :(int)(vide) id de l'adresse du livreur
- id_compte :(int)(vide) id du compte du livreur
- nom 		:(str) nom du livreur

http://__global_url__:__global_port__/__global_uri__/index.php?action=addlivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&id_adresse=__id_adresse__&id_compte=__id_compte__&nom=__nom__

#### deletelivreur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deletelivreur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__

#### editlivreuradresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur a modifier
- id_adresse :(int)(vide) id de la nouvelle adresse du livreur , si vide alors le lien entre le livreur et l'adresse est supprime (le livreur n'a plus actif tant qu'il n'a pas d'adresse)

http://__global_url__:__global_port__/__global_uri__/index.php?action=editlivreuradresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__&id_adresse=__id_adresse__

#### editlivreurcompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur a modifier
- id_compte :(int)(vide) id du nouveau compte du livreur, si vide alors le lien entre le livreur et le compte est supprime (le livreur n'a plus actif tant qu'il n'a pas de compte)

http://__global_url__:__global_port__/__global_uri__/index.php?action=editlivreurcompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__&id_compte=__id_compte__

#### editlivreurnom
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur a modifier
- nom 		:(str) nouveau nom du livreur

http://__global_url__:__global_port__/__global_uri__/index.php?action=editlivreurnom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__&nom=__nom__

#### getlivreurbyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_livreur :(int) id du livreur a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlivreurbyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_livreur=__id_livreur__

#### getlivreursbyadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_adresse :(int) id de l'adresse des livreurs a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlivreursbyadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getlivreursbycompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte des livreurs a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlivreursbycompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getlivreursbyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur des livreurs a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getlivreursbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__


### gestion des offres
#### addoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur qui propose l'offre
- id_adresse :(int)(vide) id de l'adresse de l'offre
- id_compte :(int)(vide) id du compte de l'offre
- nom 		:(str)(vide) nom de l'offre
- description :(str)(vide) description de l'offre
- prix 		:(float)(vide) prix de l'offre
- stock 	:(int)(vide) stock de l'offre
- id_type_offre :(str) id type de l'offre

les champs peuvent etre vide, mais l'offre ne sera active que si les champs sont tous remplis

http://__global_url__:__global_port__/__global_uri__/index.php?action=addoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__&id_adresse=__id_adresse__&id_compte=__id_compte__&nom=__nom__&description=__description__&prix=__prix__&stock=__stock__&id_type_offre=__id_type_offre__

#### deleteoffre
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a supprimer

http://__global_url__:__global_port__/__global_uri__/index.php?action=deleteoffre&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__

#### editoffreadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- id_adresse :(int)(vide) id de la nouvelle adresse de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffreadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&id_adresse=__id_adresse__

#### editoffrecompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- id_compte :(int)(vide) id du nouveau compte de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffrecompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&id_compte=__id_compte__

#### editoffredescription
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- description :(str)(vide) nouvelle description de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffredescription&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&description=__description__

#### editoffrenom
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- nom :(str)(vide) nouveau nom de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffrenom&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&nom=__nom__

#### editoffreprix
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- prix :(float)(vide) nouveau prix de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffreprix&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&prix=__prix__

#### editoffrestock
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- stock :(int)(vide) nouveau stock de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffrestock&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&stock=__stock__

#### editoffretype
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a modifier
- id_type_offre :(int) nouveau type de l'offre

http://__global_url__:__global_port__/__global_uri__/index.php?action=editoffretype&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__&id_type_offre=__id_type_offre__

#### getoffrebyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_offre :(int) id de l'offre a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffrebyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_offre=__id_offre__

#### getoffres
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffres&admin=true&admin=__admin__&mdpadmin=__mdpadmin__

#### getoffresbyadresse
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_adresse :(int) id de l'adresse des offres a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffresbyadresse&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_adresse=__id_adresse__

#### getoffresbycompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte des offres a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffresbycompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__

#### getoffresbyjoueur
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_joueur :(int) id du joueur des offres a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=getoffresbyjoueur&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_joueur=__id_joueur__


### gestion des transactions
#### addtransaction
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_commande :(int)(vide) id de la commande de la transaction (peut etre null)
- id_type_transaction :(int) id du type de la transaction
- id_compte_crediteur :(int)(vide) id du compte crediteur
- id_compte_debiteur :(int)(vide) id du compte debiteur
- montant :(float) montant de la transaction
- nom :(str) nom de la transaction
- description :(str) description de la transaction

au moins un des deux compte peut etre "vide"

http://__global_url__:__global_port__/__global_uri__/index.php?action=addtransaction&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__&id_type_transaction=__id_type_transaction__&id_compte_crediteur=__id_compte_crediteur__&id_compte_debiteur=__id_compte_debiteur__&montant=__montant__&nom=__nom__&description=__description__

#### gettransactionbyid
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_transaction :(int) id de la transaction a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionbyid&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_transaction=__id_transaction__

#### gettransactionsbyadmin
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_admin :(int) id de l'admin des transactions a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionsbyadmin&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_admin=__id_admin__

#### gettransactionsbycommande
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_commande :(int) id de la commande des transactions a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionsbycommande&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_commande=__id_commande__

#### gettransactionsbycompte
- admin	:(str) pseudo du compte admin
- mdpadmin	:(str) mdp du compte admin
- id_compte :(int) id du compte des transactions a recuperer

http://__global_url__:__global_port__/__global_uri__/index.php?action=gettransactionsbycompte&admin=true&admin=__admin__&mdpadmin=__mdpadmin__&id_compte=__id_compte__
