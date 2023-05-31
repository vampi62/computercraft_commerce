# panel d'administration de l'api http

## table des matieres
==================
* [panel_admin de l'api http](#panel_admin-de-lapi-http)
    * [table des matieres](#table-des-matieres)
    * [description](#description)
    * [liste des actions](#liste-des-actions)
        * [nom_action (exemple)](#nom_action-exemple)
        * [gestion des adresses](#gestion-des-adresses)
            * [addadresse](#addadresse)
            * [deleteadresse](#deleteadresse)
            * [editadressecoo](#editadressecoo)
            * [editadressedescription](#editadressedescription)
            * [editadresselivreur](#editadresselivreur)
            * [editadressenom](#editadressenom)
            * [editadressetype](#editadressetype)
            * [getadressebyid](#getadressebyid)
            * [getadressesbyjoueur](#getadressesbyjoueur)
            * [getadressesbylivreur](#getadressesbylivreur)
        * [gestion des commandes](#gestion-des-commandes)
            * [addcommande](#addcommande)
            * [editcommandecoderetrait](#editcommandecoderetrait)
            * [editcommandedatelivraison](#editcommandedatelivraison)
            * [editcommandestatus](#editcommandestatus)
            * [editcommandetransaction](#editcommandetransaction)
            * [getcommandebyid](#getcommandebyid)
            * [getcommandebytransaction](#getcommandebytransaction)
            * [getcommandesbyadresse](#getcommandesbyadresse)
            * [getcommandesbyadresseclient](#getcommandesbyadresseclient)
            * [getcommandesbyadressevendeur](#getcommandesbyadressevendeur)
            * [getcommandesbycompte](#getcommandesbycompte)
            * [getcommandesbycompteclient](#getcommandesbycompteclient)
            * [getcommandesbycomptevendeur](#getcommandesbycomptevendeur)
            * [getcommandesbylivreur](#getcommandesbylivreur)
            * [getcommandesbyoffre](#getcommandesbyoffre)
        * [gestion des comptes](#gestion-des-comptes)
            * [addcompte](#addcompte)
            * [deletecompte](#deletecompte)
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptebyjoueur](#getcomptebyjoueur)
        * [gestion des groupes](#gestion-des-groupes)
            * [addgroupeadresse](#addgroupeadresse)
            * [addgroupekeyapi](#addgroupekeyapi)
            * [addgroupecompte](#addgroupecompte)
            * [addgroupedroit](#addgroupedroit)
            * [addgroupe](#addgroupe)
            * [addgroupejoueur](#addgroupejoueur)
            * [addgroupelivreur](#addgroupelivreur)
            * [addgroupeoffre](#addgroupeoffre)
            * [deletegroupeadresse](#deletegroupeadresse)
            * [deletegroupekeyapi](#deletegroupekeyapi)
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
            * [getgroupesbykeyapi](#getgroupesbykeyapi)
            * [getgroupesbycompte](#getgroupesbycompte)
            * [getgroupesbyjoueur](#getgroupesbyjoueur)
            * [getgroupesbyjoueurmembre](#getgroupesbyjoueurmembre)
            * [getgroupesbylivreur](#getgroupesbylivreur)
            * [getgroupesbyoffre](#getgroupesbyoffre)
            * [getjoueursbygroupe](#getjoueursbygroupe)
            * [getkeyapisbygroupe](#getkeyapisbygroupe)
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
        * [gestion des keyapi](#gestion-des-keyapi)
            * [addkeyapi](#addkeyapi)
            * [deletekeyapi](#deletekeyapi)
            * [addkeyapidroit](#addkeyapidroit)
            * [deletekeyapidroit](#deletekeyapidroit)
            * [editkeyapimdp](#editkeyapimdp)
            * [editkeyapinom](#editkeyapinom)
            * [getkeyapibyid](#getkeyapibyid)
            * [getkeyapidroitsbyid](#getkeyapidroitsbyid)
            * [getkeyapisbyjoueur](#getkeyapisbyjoueur)
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

## liste des actions

### nom_action (exemple)
- param1	:(type) parametre obligatoire
- param2    :(type)(optionnel) parametre non obligatoire

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

action="listuserdata&mdp=__mdp__&pseudo=__pseudo__" -- exemple d'action
list_ou_code_retour = http_get(action)
print(list_ou_code_retour.status_code())-- =200 si la commande a ete effectuer
print(list_ou_code_retour.message())
print(list_ou_code_retour.data())-- n'est retourner que si une action get.. est effectuer avec succes
```
### gestion des adresses

#### addadresse
#### deleteadresse
#### editadressecoo
#### editadressedescription
#### editadresselivreur
#### editadressenom
#### editadressetype
#### getadressebyid
#### getadressesbyjoueur
#### getadressesbylivreur


### gestion des commandes

#### addcommande
#### editcommandecoderetrait
#### editcommandedatelivraison
#### editcommandestatus
#### editcommandetransaction
#### getcommandebyid
#### getcommandebytransaction
#### getcommandesbyadresse
#### getcommandesbyadresseclient
#### getcommandesbyadressevendeur
#### getcommandesbycompte
#### getcommandesbycompteclient
#### getcommandesbycomptevendeur
#### getcommandesbylivreur
#### getcommandesbyoffre


### gestion des comptes

#### addcompte
#### deletecompte
#### editcomptenom
#### getcomptebyid
#### getcomptebyjoueur


### gestion des groupes

#### addgroupeadresse
#### addgroupekeyapi
#### addgroupecompte
#### addgroupedroit
#### addgroupe
#### addgroupejoueur
#### addgroupelivreur
#### addgroupeoffre
#### deletegroupeadresse
#### deletegroupekeyapi
#### deletegroupecompte
#### deletegroupedroit
#### deletegroupe
#### deletegroupejoueur
#### deletegroupelivreur
#### deletegroupeoffre
#### editgroupenom
#### getadressesbygroupe
#### getcomptesbygroupe
#### getdroitsbygroupe
#### getgroupebyid
#### getgroupesbyadresse
#### getgroupesbykeyapi
#### getgroupesbycompte
#### getgroupesbyjoueur
#### getgroupesbyjoueurmembre
#### getgroupesbylivreur
#### getgroupesbyoffre
#### getjoueursbygroupe
#### getkeyapisbygroupe
#### getlivreursbygroupe
#### getoffresbygroupe


### gestion des jetons

#### addjeton
#### deletejeton
#### editjeton
#### getjetonbyjoueur
#### getjetons


### gestion des joueurs

#### addjoueur
#### deletejoueur
#### editjoueuremail
#### editjoueurmdp
#### editjoueurnbroffre
#### editjoueurpseudo
#### editjoueurrole
#### getjoueurbyid
#### getjoueurbypseudo
#### getjoueurs


### gestion des keyapi

#### addkeyapi
#### deletekeyapi
#### addkeyapidroit
#### deletekeyapidroit
#### editkeyapimdp
#### editkeyapinom
#### getkeyapibyid
#### getkeyapidroitsbyid
#### getkeyapisbyjoueur


### gestion des keypay

#### getkeypaybyid
#### getkeypaysbyoffre


### gestion des litiges

#### addlitigemsg
#### deletelitigemsg
#### getlitigemsgsbycommande


### gestion des livraisons

#### addlivreur
#### deletelivreur
#### editlivreuradresse
#### editlivreurcompte
#### editlivreurnom
#### getlivreurbyid
#### getlivreursbyadresse
#### getlivreursbycompte
#### getlivreursbyjoueur


### gestion des offres

#### addoffre
#### deleteoffre
#### editoffreadresse
#### editoffrecompte
#### editoffredescription
#### editoffrenom
#### editoffreprix
#### editoffrestock
#### editoffretype
#### getoffrebyid
#### getoffres
#### getoffresbyadresse
#### getoffresbycompte
#### getoffresbyjoueur


### gestion des transactions

#### addtransaction
#### gettransactionbyid
#### gettransactionsbyadmin
#### gettransactionsbycommande
#### gettransactionsbycompte