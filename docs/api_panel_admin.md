# panel d'administration de l'api http

## table des matieres
==================
* [panel_admin de l'api http](#panel_admin-de-lapi-http)
    * [table des matieres](#table-des-matieres)
    * [description](#description)
    * [liste des actions](#liste-des-actions)
        * [getntp](#getntp)
        * [getconfig](#getconfig)
        * [addbanqueterminal](#addbanqueterminal)
        * [gestion des adresses](#gestion-des-adresses)
            * [addadresse](#addadresse)
            * [deleteadresse](#deleteadresse)
            * [editadressecoo](#editadressecoo)
            * [editadressedescription](#editadressedescription)
            * [editadressenom](#editadressenom)
            * [getadressebyid](#getadressebyid)
            * [getadressesbygroupe](#getadressesbygroupe)
            * [getadressesbyjoueur](#getadressesbyjoueur)
        * [gestion des apikey](#gestion-des-apikey)
            * [addapikey](#addapikey)
            * [addapikeydroit](#addapikeydroit)
            * [deleteapikey](#deleteapikey)
            * [deleteapikeydroit](#deleteapikeydroit)
            * [editapikeymdp](#editapikeymdp)
            * [editapikeynom](#editapikeynom)
            * [getapikeybyid](#getapikeybyid)
            * [getapikeydroitsbyid](#getapikeydroitsbyid)
            * [getapikeysbygroupe](#getapikeysbygroupe)
            * [getapikeysbyjoueur](#getapikeysbyjoueur)
        * [gestion des commandes](#gestion-des-commandes)
            * [addcommande](#addcommande)
            * [editcommandecoderetrait](#editcommandecoderetrait)
            * [editcommandedatelivraison](#editcommandedatelivraison)
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
            * [getcommandesbystatus](#getcommandesbystatus)
        * [gestion des comptes](#gestion-des-comptes)
            * [addcompte](#addcompte)
            * [deletecompte](#deletecompte)
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptesbygroupe](#getcomptesbygroupe)
            * [getcomptesbyjoueur](#getcomptebyjoueur)
        * [gestion des enderstorageschest](#gestion-des-enderstorageschest)
            * [editenderstorageschest](#editenderstorageschest)
            * [getenderstorageschest](#getenderstorageschest)
            * [getenderstorageschestbyid](#getenderstorageschestbyid)
            * [getenderstorageschestbyjoueur](#getenderstorageschestbyjoueur)
            * [getenderstorageschestdispo](#getenderstorageschestdispo)
        * [gestion des enderstoragestank](#gestion-des-enderstoragestank)
            * [editenderstoragestank](#editenderstoragestank)
            * [getenderstoragestank](#getenderstoragestank)
            * [getenderstoragestankbyid](#getenderstoragestankbyid)
            * [getenderstoragestankbyjoueur](#getenderstoragestankbyjoueur)
            * [getenderstoragestankdispo](#getenderstoragestankdispo)
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
            * [getgroupesbyadresse](#getgroupesbyadresse)
            * [getgroupesbyapikey](#getgroupesbyapikey)
            * [getgroupesbycompte](#getgroupesbycompte)
            * [getgroupesbyjoueur](#getgroupesbyjoueur)
            * [getgroupesbyjoueurmembre](#getgroupesbyjoueurmembre)
            * [getgroupesbylivreur](#getgroupesbylivreur)
            * [getgroupesbyoffre](#getgroupesbyoffre)
        * [gestion des jeton](#gestion-des-jeton)
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
            * [getjoueursbygroupe](#getjoueursbygroupe)
        * [gestion des keypays](#gestion-des-keypays)
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
            * [getlivreursbyadresse](#getlivreursbyadresse)
            * [getlivreursbycompte](#getlivreursbycompte)
            * [getlivreursbygroupe](#getlivreursbygroupe)
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
            * [getoffresbygroupe](#getoffresbygroupe)
            * [getoffresbyjoueur](#getoffresbyjoueur)
        * [gestion des transactions](#gestion-des-transactions)
            * [addtransaction](#addtransaction)
            * [gettransactionbyid](#gettransactionbyid)
            * [gettransactionsbyadmin](#gettransactionsbyadmin)
            * [gettransactionsbycommande](#gettransactionsbycommande)
            * [gettransactionsbycompte](#gettransactionsbycompte)
        * [gestion des wireless](#gestion-des-wireless)
            * [editwireless](#editwireless)
            * [gewireless](#getwireless)
            * [gewirelessbyid](#getwirelessbyid)
            * [getwirelessbyjoueur](#getwirelessbyjoueur)
            * [getwirelessdispo](#getwirelessdispo)


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

### getntp
##### Description
obtenir le temps du serveur

##### Request
###### Method
GET
###### URL
```
http://__global_url__:__global_port__/__global_uri__/ntp?admin=true
```

##### Response

###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "seconde": "00",
        "minute": "00",
        "heure": "00",
        "jour": "00",
        "mois": "00",
        "annee": "0000"
    }
}
```


### getconfig
##### Description
obtenir la configuration du serveur

##### Request
###### Method
GET
###### URL
```
http://__global_url__:__global_port__/__global_uri__/config?admin=true
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "General":{"NbrOffreDefaut":,"NbrOffreMax":0,"PrixOffre":0,"CaseLigneSuite":"","Name":"","Version":"0","ModuleShowUser":true},
        "Module":{"EnderStorage":true,"WirelessRedstone":true},
        ...
    }
}
```



### addbanqueterminal
##### Description
ajouter un terminal bancaire

##### Request
###### Method
POST
###### URL
```
{{site_url}}/banqueterminal?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| pseudo       | (str) texte limité à 50 caractères     |
| mdp          | (str) mdp du terminal                  |
| email        | (str) email du terminal                |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "idJoueur":0, 
        "idApiKey":0
    }
}
```

### gestion des adresses
#### addadresse
##### Description
ajouter une adresse à un joueur

##### Request
###### Method
POST
###### URL
```
{{site_url}}/adresse?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| coo          | (str) texte limité à 50 caractères     |
| description  | (str) texte limité à 450 caractères    |
| id_type_adresse | (int) 1=reception, 2=relai, 3-4-5=commerce |
| id_joueur    | (int) id du joueur qui recevra cette objet |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deleteadresse
##### Description
supprimer une adresse d'un joueur

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/adresse/{{id_adresse}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editadressecoo
##### Description
modifier les coordonnées d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/coo?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| coo          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editadressedescription
##### Description
modifier la description d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/description?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| description  | (str) texte limité à 450 caractères    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editadressenom
##### Description
modifier le nom d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getadressebyid
##### Description
obtenir une adresse par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresse/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_adresse": 0,
        "nom": "",
        "coo": "",
        "description": "",
        "id_type_adresse": 0,
        "id_joueur": 0
    }
}
```

#### getadressesbygroupe
##### Description
obtenir les adresses par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresses/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_adresse": 0,
            "nom": "",
            "coo": "",
            "description": "",
            "id_type_adresse": 0,
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getadressesbyjoueur
##### Description
obtenir les adresses par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresses/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_adresse": 0,
            "nom": "",
            "coo": "",
            "description": "",
            "id_type_adresse": 0,
            "id_joueur": 0
        },
        ...
    ]
}
```

### gestion des apikey
#### addapikey
##### Description
ajouter une apikey

##### Request
###### Method
POST
###### URL
```
{{site_url}}/apikey?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| mdp          | (str) mdp de la clé                    |
| id_joueur    | (int) id du joueur qui recevra cette objet |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addapikeydroit
##### Description
ajouter un droit à une apikey

##### Request
###### Method
POST
###### URL
```
{{site_url}}/apikey/{{id_apikey}}/droit/{{id_droit}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deleteapikey
##### Description
supprimer une apikey

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/apikey/{{id_apikey}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### deleteapikeydroit
##### Description
supprimer un droit d'une apikey

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/apikey/{{id_apikey}}/droit/{{id_droit}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### editapikeymdp
##### Description
modifier le mot de passe d'une apikey

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/apikey/{{id_apikey}}/mdp?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| mdp          | (str) mdp de la clé                    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editapikeynom
##### Description
modifier le nom d'une apikey

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/apikey/{{id_apikey}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getapikeybyid
##### Description
obtenir une apikey par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/apikey/{{id_apikey}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_apikey": 0,
        "nom": "",
        "mdp": "",
        "id_joueur": 0
    }
}
```

#### getapikeysbygroupe
##### Description
obtenir les apikeys par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/apikeys/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_apikey": 0,
            "nom": "",
            "mdp": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getapikeysbyjoueur
##### Description
obtenir les apikeys par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/apikeys/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body

- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_apikey": 0,
            "nom": "",
            "mdp": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getapikeydroitsbyid
##### Description
obtenir les droits d'une apikey par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/apikey/{{id_apikey}}/droits?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body

- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_droit": 0,
            "nom": "",
            "description": ""
        },
        ...
    ]
}
```

### gestion des commandes
#### addcommande
##### Description
ajouter une commande

##### Request
###### Method
POST
###### URL
```
{{site_url}}/commande?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| quant        | (int) quantite a commander             |
| prixu        | (float) prix unitaire pour acheter un objet"|
| frait        | (float) frait de livraison             |
| description        | (str) texte limité à 450 caractères    |
| id_adresse_client  | (int) adresse de livraison             |
| id_compte_client   | (int) id compte à facturer             |
| id_offre     | (int) id de l'offre à acheter                |
| code_retrait_commande | (str) code de retrait               |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### editcommandecoderetrait
##### Description
modifier le code de retrait d'une commande

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/coderetrait?admin=true
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| code_retrait_commande | (str) code de retrait                   |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editcommandedatelivraison
##### Description
modifier la date de livraison d'une commande

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/datelivraison?admin=true
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| date_livraison | (str) date de livraison au format "YYYY-MM-DD HH:MM:SS" |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editcommandelivreur
##### Description
modifier le livreur d'une commande

##### Request
###### Method   
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/livreur?admin=true
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_livreur   | (int) id du livreur                     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editcommandestatus
##### Description
modifier le status d'une commande

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/status?admin=true
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_type_commande       | (int) 1=validation en attente, 2=validation refuser, 3=paiement en attente, 4=paiement refuser, 5=preparation en cours, 6=livraison en attente, 7=livraison en cours, 8=livraison en pause, 9=livraison en point, 10=livrer, 11=valider, 12=refuser, 13=litige, 14=annuler, 15=commande direct en attente, 16=commande direct terminer |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getcommandebyid
##### Description
obtenir une commande par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commande/{{id_commande}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_commande": 0,
        "id_offre": 0,
        "id_adresse": 0,
        "id_livreur": 0,
        "date_livraison": "0000-00-00 00:00:00",
        "code_retrait_commande": "",
        "status": 0
    }
}
```

#### getcommandesbyadresse
##### Description
obtenir les commandes par l'id d'une adresse

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/adresse/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbyadresseclient
##### Description
obtenir les commandes par l'id d'une adresse client

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/adresseclient/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbyadressevendeur
##### Description
obtenir les commandes par l'id d'une adresse vendeur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/adressevendeur/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbycompte
##### Description
obtenir les commandes par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbycompteclient
##### Description
obtenir les commandes par l'id d'un compte client

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/compteclient/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbycomptevendeur
##### Description
obtenir les commandes par l'id d'un compte vendeur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/comptevendeur/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbylivreur
##### Description
obtenir les commandes par l'id d'un livreur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/livreur/{{id_livreur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbyoffre
##### Description
obtenir les commandes par l'id d'une offre

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/offre/{{id_offre}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

#### getcommandesbystatus
##### Description
obtenir les commandes par le status

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/status/{{status}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_commande": 0,
            "id_offre": 0,
            "id_adresse": 0,
            "id_livreur": 0,
            "date_livraison": "0000-00-00 00:00:00",
            "code_retrait_commande": "",
            "status": 0
        },
        ...
    ]
}
```

### gestion des comptes
#### addcompte
##### Description
ajouter un compte

##### Request
###### Method
POST
###### URL
```
{{site_url}}/compte?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| id_type_compte | (int) 1=client, 2=livreur, 3=vendeur |
| id_joueur    | (int) id du joueur qui recevra cette objet |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletecompte
##### Description
supprimer un compte

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/compte/{{id_compte}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editcomptenom
##### Description
modifier le nom d'un compte

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/compte/{{id_compte}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getcomptebyid
##### Description
obtenir un compte par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_compte": 0,
        "nom": "",
        "id_type_compte": 0,
        "id_joueur": 0
    }
}
```

#### getcomptesbygroupe
##### Description
obtenir les comptes par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/comptes/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_compte": 0,
            "nom": "",
            "id_type_compte": 0,
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getcomptesbyjoueur

##### Description
obtenir les comptes par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/comptes/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_compte": 0,
            "nom": "",
            "id_type_compte": 0,
            "id_joueur": 0
        },
        ...
    ]
}
```

### gestion des enderstorageschest
#### editenderstoragechest
##### Description
modifier un enderstoragechest

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/enderstoragechest/{{id_enderstoragechest}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_joueur    | (int) id du joueur a qui donner ou retirer l'enderstoragechest |
| reserver     | (bool) true=chest reserver, false=chest libre |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getenderstorageschest
##### Description
obtenir les enderstorageschest

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstorageschest?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragechest": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getenderstoragechestbyid
##### Description
obtenir un enderstoragechest par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstoragechest/{{id_enderstoragechest}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_enderstoragechest": 0,
        "id_joueur": 0,
        "reserver": true
    }
}
```

#### getenderstoragechestbyjoueur
##### Description
obtenir les enderstoragechest par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstoragechests/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragechest": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getenderstorageschestdispo
##### Description
obtenir les enderstoragechest disponible

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstorageschest/dispo?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragechest": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

### gestion des enderstoragestank
#### editenderstoragetank
##### Description
modifier un enderstoragetank

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/enderstoragetank/{{id_enderstoragetank}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_joueur    | (int) id du joueur a qui donner ou retirer l'enderstoragetank |
| reserver     | (bool) true=tank reserver, false=tank libre |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getenderstorageschest
##### Description
obtenir les enderstorageschest

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstorageschest?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragechest": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getenderstoragetankbyid
##### Description
obtenir un enderstoragetank par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstoragetank/{{id_enderstoragetank}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_enderstoragetank": 0,
        "id_joueur": 0,
        "reserver": true
    }
}
```

#### getenderstoragetankbyjoueur
##### Description
obtenir les enderstoragetank par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstoragetanks/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragetank": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getenderstoragetanksdispo
##### Description
obtenir les enderstoragetank disponible

##### Request
###### Method
GET
###### URL
```
{{site_url}}/enderstoragetanks/dispo?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_enderstoragetank": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

### gestion des groupes
#### addgroupe
##### Description
ajouter un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| id_joueur    | (int) id du joueur qui recevra cette objet |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupeadresse
##### Description
ajouter une adresse à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/adresse/{{id_adresse}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupeapikey
##### Description
ajouter une apikey à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/apikey/{{id_apikey}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupecompte
##### Description
ajouter un compte à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/compte/{{id_compte}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupedroit
##### Description
ajouter un droit à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/droit/{{id_droit}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupejoueur
##### Description
ajouter un joueur à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/joueur/{{id_joueur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupelivreur
##### Description
ajouter un livreur à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/livreur/{{id_livreur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### addgroupeoffre
##### Description
ajouter une offre à un groupe

##### Request
###### Method
POST
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/offre/{{id_offre}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupe
##### Description
supprimer un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### deletegroupeadresse
##### Description
supprimer une adresse d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/adresse/{{id_adresse}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupeapikey
##### Description
supprimer une apikey d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/apikey/{{id_apikey}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupecompte
##### Description
supprimer un compte d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/compte/{{id_compte}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupedroit
##### Description
supprimer un droit d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/droit/{{id_droit}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupejoueur
##### Description
supprimer un joueur d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/joueur/{{id_joueur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupelivreur
##### Description
supprimer un livreur d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/livreur/{{id_livreur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletegroupeoffre
##### Description
supprimer une offre d'un groupe

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/offre/{{id_offre}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### editgroupenom
##### Description
modifier le nom d'un groupe

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getdroitsbygroupe
##### Description
obtenir les droits par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/droits?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_droit": 0,
            "nom": "",
            "description": ""
        },
        ...
    ]
}
```

#### getgroupebyid
##### Description
obtenir un groupe par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_groupe": 0,
        "nom": "",
        "id_joueur": 0
    }
}
```

#### getgroupesbyadresse
##### Description
obtenir les groupes par l'id d'une adresse

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/adresse/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbyapikey
##### Description
obtenir les groupes par l'id d'une apikey

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/apikey/{{id_apikey}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbycompte
##### Description
obtenir les groupes par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbyjoueur
##### Description
obtenir les groupes par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbyjoueurmembre
##### Description
obtenir les groupes par l'id d'un joueur membre

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/joueurmembre/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbylivreur
##### Description
obtenir les groupes par l'id d'un livreur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/livreur/{{id_livreur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

#### getgroupesbyoffre
##### Description
obtenir les groupes par l'id d'une offre

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes/offre/{{id_offre}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_groupe": 0,
            "nom": "",
            "id_joueur": 0
        },
        ...
    ]
}
```

### gestion des jeton
#### deletejeton
##### Description
supprimer un jeton

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/jeton?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_joueur    | (int) id du joueur a qui retirer le jeton |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjeton
##### Description
modifier un jeton

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/jeton?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_joueur    | (int) id du joueur qui possède le jeton |
| 1            | (int) nombre de jeton de 1 |
| 10           | (int) nombre de jeton de 10 |
| 100          | (int) nombre de jeton de 100 |
| 1k           | (int) nombre de jeton de 1k |
| 10k          | (int) nombre de jeton de 10k |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### getjetonbyjoueur
##### Description
obtenir les jetons par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/jeton/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_joueur": 0,
        "1": 0,
        "10": 0,
        "100": 0,
        "1k": 0,
        "10k": 0
    }
}
```

#### getjetons
##### Description
obtenir les jetons

##### Request
###### Method
GET
###### URL
```
{{site_url}}/jetons?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_joueur": 0,
            "1": 0,
            "10": 0,
            "100": 0,
            "1k": 0,
            "10k": 0
        },
        ...
    ]
}
```

### gestion des joueurs
#### addjoueur
##### Description
ajouter un joueur

##### Request
###### Method
POST
###### URL
```
{{site_url}}/joueur?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| pseudo       | (str) texte limité à 50 caractères     |
| mdp          | (str) le mot de passe doit avoir un caractères maj,un min,un chiffre et une longeur supérieur à 8 caractères |
| email        | (str) texte limité à 50 caractères (format email) |
| id_role     | (int) 1=client, 2=admin, 3=banque       |
| nbr_offre    | (int) nombre d'offre que le joueur peut avoir |


##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 413: la longueur d'un paramètre est trop longue

#### deletejoueur
##### Description
supprimer un joueur

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/joueur/{{id_joueur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjoueuremail
##### Description
modifier l'email d'un joueur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/joueur/{{id_joueur}}/email?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| email        | (str) texte limité à 50 caractères (format email) |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjoueurmdp
##### Description
modifier le mot de passe d'un joueur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/joueur/{{id_joueur}}/mdp?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| mdp          | (str) le mot de passe doit avoir un caractères maj,un min,un chiffre et une longeur supérieur à 8 caractères |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjoueurnbroffre
##### Description
modifier le nombre d'offre d'un joueur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/joueur/{{id_joueur}}/nbroffre?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nbr_offre    | (int) nombre d'offre que le joueur peut avoir |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjoueurpseudo
##### Description
modifier le pseudo d'un joueur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/joueur/{{id_joueur}}/pseudo?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| pseudo       | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editjoueurrole
##### Description
modifier le role d'un joueur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/joueur/{{id_joueur}}/role/{{id_role}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getjoueurbyid
##### Description
obtenir un joueur par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body

- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_joueur": 0,
        "pseudo": "",
        "email": "",
        "id_role": 0,
        "nbr_offre": 0
    }
}
```

#### getjoueurbypseudo
##### Description
obtenir un joueur par son pseudo

##### Request
###### Method
GET
###### URL
```
{{site_url}}/joueur/pseudo/?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| pseudo       | (str) pseudo du joueur                 |

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_joueur": 0,
        "pseudo": "",
        "email": "",
        "id_role": 0,
        "nbr_offre": 0
    }
}
```

#### getjoueurs
##### Description
obtenir tous les joueurs

##### Request
###### Method
GET
###### URL
```
{{site_url}}/joueurs?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_joueur": 0,
            "pseudo": "",
            "email": "",
            "id_role": 0,
            "nbr_offre": 0
        },
        ...
    ]
}
```

#### getjoueursbygroupe
##### Description
obtenir les joueurs par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/joueurs/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_joueur": 0,
            "pseudo": "",
            "email": "",
            "id_role": 0,
            "nbr_offre": 0
        },
        ...
    ]
}
```

### gestion des keypays
#### getkeypaybyid
##### Description
obtenir un keypay par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/keypay/{{id_keypay}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_keypay": 0,
        "cle_keypay": "",
        "date_expire_keypay": "",
        "quantite_keypay": 0,
        "prix_unitaire_keypay": 0,
        "id_offre": 0
    }
}
```

#### getkeypaysbyoffre
##### Description
obtenir les keypays par l'id d'une offre

##### Request
###### Method
GET
###### URL
```
{{site_url}}/keypays/offre/{{id_offre}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_keypay": 0,
            "cle_keypay": "",
            "date_expire_keypay": "",
            "quantite_keypay": 0,
            "prix_unitaire_keypay": 0,
            "id_offre": 0
        },
        ...
    ]
}
```

### gestion des litigemsg
#### addlitigemsg
##### Description
ajouter un litigemsg

##### Request
###### Method
POST
###### URL
```
{{site_url}}/litigemsg?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_commande  | (int) id de la commande                |
| id_status_litigemsg | (int) type de message (1=requete,2=message,3=proposition,4=resolution,5=validation,6=rejet)  |
| description  | (str) texte limité à 450 caractères    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletelitigemsg
##### Description
supprimer un litigemsg

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/litigemsg/{{id_litigemsg}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

#### getlitigemsgsbycommande
##### Description
obtenir les litigemsgs par l'id d'une commande

##### Request
###### Method
GET
###### URL
```
{{site_url}}/litigemsgs/commande/{{id_commande}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_litigemsg": 0,
            "id_commande": 0,
            "id_status_litigemsg": 0,
            "description": ""
        },
        ...
    ]
}
```

### gestion des livreurs
#### addlivreur
##### Description
ajouter un livreur

##### Request
###### Method
POST
###### URL
```
{{site_url}}/livreur?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| id_joueur    | (int) id du joueur                     |
| id_adresse   | (int) id de l'adresse                  |
| id_compte    | (int) id du compte                     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deletelivreur
##### Description
supprimer un livreur

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/livreur/{{id_livreur}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editlivreuradresse
##### Description
modifier l'adresse d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/adresse?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_adresse   | (int) id de l'adresse                  |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editlivreurcompte
##### Description
modifier le compte d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/compte?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_compte    | (int) id du compte                     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editlivreurnom
##### Description
modifier le nom d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getlivreurbyid
##### Description
obtenir un livreur par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreur/{{id_livreur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_livreur": 0,
        "nom": "",
        "id_joueur": 0,
        "id_adresse": 0,
        "id_compte": 0
    }
}
```

#### getlivreursbyadresse
##### Description
obtenir les livreurs par l'id d'une adresse

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs/adresse/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_livreur": 0,
            "nom": "",
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getlivreursbycompte
##### Description
obtenir les livreurs par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_livreur": 0,
            "nom": "",
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getlivreursbygroupe
##### Description
obtenir les livreurs par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_livreur": 0,
            "nom": "",
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getlivreursbyjoueur
##### Description
obtenir les livreurs par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_livreur": 0,
            "nom": "",
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

### gestion des offres
#### addoffre
##### Description
ajouter une offre

##### Request
###### Method
POST
###### URL
```
{{site_url}}/offre?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |
| description  | (str) texte limité à 450 caractères    |
| prix         | (float) prix de l'offre                |
| stock        | (int) stock de l'offre                 |
| id_type_offre | (int) (1=produit, 2=liquide, 3=gaz, 4=autre) |
| id_joueur    | (int) id du joueur de l'offre          |
| id_adresse   | (int) id de l'adresse de l'offre       |
| id_compte    | (int) id du compte de l'offre          |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### deleteoffre
##### Description
supprimer une offre

##### Request
###### Method
DELETE
###### URL
```
{{site_url}}/offre/{{id_offre}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffreadresse
##### Description
modifier l'adresse d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/adresse/{{id_adresse}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrecompte
##### Description
modifier le compte d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/compte/{{id_compte}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffredescription
##### Description
modifier la description d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/description?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| description  | (str) texte limité à 450 caractères    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrenom
##### Description
modifier le nom d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/nom?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffreprix
##### Description
modifier le prix d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/prix?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| prix         | (float) prix de l'offre                |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrestock
##### Description
modifier le stock d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/stock?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| stock        | (int) stock de l'offre                 |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffretype
##### Description
modifier le type d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/type/{{id_type_offre}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects
- 404: l'élément indiqué n'existe pas

#### getoffrebyid
##### Description
obtenir une offre par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offre/{{id_offre}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_offre": 0,
        "nom": "",
        "description": "",
        "prix": 0,
        "stock": 0,
        "id_type_offre": 0,
        "id_joueur": 0,
        "id_adresse": 0,
        "id_compte": 0
    }
}
```

#### getoffres
##### Description
obtenir toutes les offres

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_offre": 0,
            "nom": "",
            "description": "",
            "prix": 0,
            "stock": 0,
            "id_type_offre": 0,
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getoffresbyadresse
##### Description
obtenir les offres par l'id d'une adresse

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres/adresse/{{id_adresse}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_offre": 0,
            "nom": "",
            "description": "",
            "prix": 0,
            "stock": 0,
            "id_type_offre": 0,
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getoffresbycompte
##### Description
obtenir les offres par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_offre": 0,
            "nom": "",
            "description": "",
            "prix": 0,
            "stock": 0,
            "id_type_offre": 0,
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getoffresbygroupe
##### Description
obtenir les offres par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres/groupe/{{id_groupe}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_offre": 0,
            "nom": "",
            "description": "",
            "prix": 0,
            "stock": 0,
            "id_type_offre": 0,
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

#### getoffresbyjoueur
##### Description
obtenir les offres par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_offre": 0,
            "nom": "",
            "description": "",
            "prix": 0,
            "stock": 0,
            "id_type_offre": 0,
            "id_joueur": 0,
            "id_adresse": 0,
            "id_compte": 0
        },
        ...
    ]
}
```

### gestion des transactions
#### addtransaction
##### Description
ajouter une transaction

##### Request
###### Method
POST
###### URL
```
{{site_url}}/transaction?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_compte_debiteur    | (int) id du joueur de la transaction   |
| id_compte_crediteur   | (int) id de l'adresse de la transaction|
| nom          | (str) texte limité à 50 caractères    |
| description  | (str) texte limité à 450 caractères    |
| montant      | (float) montant de la transaction      |
| id_type_transaction | (int) 1=retrait,2=depot,3=achat,4=remboursement,5=livraison,6=transfert |
| id_commande  | (int) id de la commande                |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### gettransactionbyid
##### Description
obtenir une transaction par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transaction/{{id_transaction}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_transaction": 0,
        "id_compte_debiteur": 0,
        "id_compte_crediteur": 0,
        "nom": "",
        "description": "",
        "montant": 0,
        "id_type_transaction": 0,
        "id_commande": 0
    }
}
```

#### gettransactionsbyadmin
##### Description
obtenir toutes les transactions

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transactions/admin/{{id_admin}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_transaction": 0,
            "id_compte_debiteur": 0,
            "id_compte_crediteur": 0,
            "nom": "",
            "description": "",
            "montant": 0,
            "id_type_transaction": 0,
            "id_commande": 0
        },
        ...
    ]
}
```

#### gettransactionsbycommande
##### Description
obtenir les transactions par l'id d'une commande

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transactions/commande/{{id_commande}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_transaction": 0,
            "id_compte_debiteur": 0,
            "id_compte_crediteur": 0,
            "nom": "",
            "description": "",
            "montant": 0,
            "id_type_transaction": 0,
            "id_commande": 0
        },
        ...
    ]
}
```

#### gettransactionsbycompte
##### Description
obtenir les transactions par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transactions/compte/{{id_compte}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_transaction": 0,
            "id_compte_debiteur": 0,
            "id_compte_crediteur": 0,
            "nom": "",
            "description": "",
            "montant": 0,
            "id_type_transaction": 0,
            "id_commande": 0
        },
        ...
    ]
}
```


### gestion des wireless
#### editwireless
##### Description
modifier un wireless

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/wireless/{{id_wireless}}?admin=true
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| useradmin    | (str) pseudo admin                     |
| mdpadmin     | (str) mdp admin                        |
| id_joueur   | (int) id du joueur a qui donner ou retirer le wireless |
| reserver    | (bool) true pour reserver, false pour retirer la reservation |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants admin sont incorrects

#### getwireless
##### Description
obtenir tous les wireless

##### Request
###### Method
GET
###### URL
```
{{site_url}}/wireless?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_wireless": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getwirelessbyid
##### Description
obtenir un wireless par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/wireless/{{id_wireless}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "id_wireless": 0,
        "id_joueur": 0,
        "reserver": true
    }
}
```

#### getwirelessbyjoueur
##### Description
obtenir les wireless par l'id d'un joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/wireless/joueur/{{id_joueur}}?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_wireless": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```

#### getwirelessdispo
##### Description
obtenir les wireless disponibles

##### Request
###### Method
GET
###### URL
```
{{site_url}}/wireless/dispo?admin=true&useradmin={{useradmin}}&mdpadmin={{mdpadmin}}&offset={{offset}}&limit={{limit}}&show={{show}}
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": [
        {
            "id_wireless": 0,
            "id_joueur": 0,
            "reserver": true
        },
        ...
    ]
}
```
