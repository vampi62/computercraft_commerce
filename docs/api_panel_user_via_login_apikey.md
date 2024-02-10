# panel de production de l'api http

## table des matieres
==================
* [panel de l'api http](#panel-de-lapi-http)
    * [table des matieres](#table-des-matieres)
    * [description](#description)
    * [liste des actions](#liste-des-actions)
        * [getntp](#getntp)
        * [getconfig](#getconfig)
        * [gestion des adresses](#gestion-des-adresses)
            * [editadressecoo](#editadressecoo)
            * [editadressedescription](#editadressedescription)
            * [editadressenom](#editadressenom)
            * [getadressebyid](#getadressebyid)
            * [getadresses](#getadresses)
            * [getadressesbygroupe](#getadressesbygroupe)
        * [gestion des apikey](#gestion-des-apikey)
            * [getapikeybyid](#getapikeybyid)
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
            * [editcomptenom](#editcomptenom)
            * [getcomptebyid](#getcomptebyid)
            * [getcomptes](#getcompte)
            * [getcomptesbygroupe](#getcomptesbygroupe)
        * [gestion des groupes](#gestion-des-groupes)
            * [getdroitsbygroupe](#getdroitsbygroupe)
            * [getgroupebyid](#getgroupebyid)
            * [getgroupes](#getgroupes)
        * [gestion des jeton](#gestion-des-jeton)
            * [editjeton](#editjeton)
        * [gestion des joueurs](#gestion-des-joueurs)
            * [getjoueurbyid](#getjoueurbyid)
            * [getjoueurbypseudo](#getjoueurbypseudo)
            * [getjoueurs](#getjoueurs)
            * [getjoueursbygroupe](#getjoueursbygroupe)
        * [gestion des keypay](#gestion-des-keypay)
            * [addkeypay](#addkeypay)
            * [getkeypaybyid](#getkeypaybyid)
            * [getkeypaysbyoffre](#getkeypaysbyoffre)
        * [gestion des livreurs](#gestion-des-livreurs)
            * [editlivreuradresse](#editlivreuradresse)
            * [editlivreurcompte](#editlivreurcompte)
            * [editlivreurnom](#editlivreurnom)
            * [getlivreurbyid](#getlivreurbyid)
            * [getlivreurs](#getlivreurs)
            * [getlivreursbyadresse](#getlivreursbyadresse)
            * [getlivreursbycompte](#getlivreursbycompte)
            * [getlivreursbygroupe](#getlivreursbygroupe)
        * [gestion des offres](#gestion-des-offres)
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

## description

ce panel concerne les endpoints disponible pour les acces apikey

les chaine de caractere sont limiter a 450 caractere pour les champs "description" et a 50 caractere pour les champs "pseudo" et "nom".

| code | description |
|:---:|:--- |
| 200 | la requete a été effectuer avec succes |
| 400 | parametre manquant |
| 403 | vous n'avez pas les droits ou les identifiant apikey sont incorrect |
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
http://__global_url__:__global_port__/__global_uri__/ntp
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
http://__global_url__:__global_port__/__global_uri__/config
```

##### Response
###### Body
- mode: json
```json
{
    "status_code": 200,
    "message": "",
    "data": {
        "General":{"NbrOffreDefaut":,"NbrOffreMax":0,"PrixOffre":0,"CaseLigneSuite":"","Name":"","Version":"0","ModuleShowapikey":true},
        "Module":{"EnderStorage":true,"WirelessRedstone":true},
        ...
    }
}
```

### gestion des adresses
#### editadressecoo
##### Description
modifier les coordonnées d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/coo
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| coo          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editadressedescription
##### Description
modifier la description d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/description
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| description  | (str) texte limité à 450 caractères    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editadressenom
##### Description
modifier le nom d'une adresse

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/adresse/{{id_adresse}}/nom
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### getadressebyid
##### Description
obtenir une adresse par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresse/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getadresses
##### Description
obtenir les adresses visible pour le joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresses?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getadressesbygroupe
##### Description
obtenir les adresses par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/adresses/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
#### getapikeybyid
##### Description
obtenir une apikey par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/apikey/{{id_apikey}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/apikeys/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/apikey/{{id_apikey}}/droits?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commande
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
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
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects

#### editcommandelivreur
##### Description
modifier le livreur d'une commande

##### Request
###### Method   
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/livreur
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| id_livreur   | (int) id du livreur                     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editcommandestatus
##### Description
modifier le status d'une commande

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/commande/{{id_commande}}/status
```

###### Body
- mode: urlencoded

| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| id_type_commande       | (int) 1=validation en attente, 2=validation refapikey, 3=paiement en attente, 4=paiement refapikey, 5=preparation en cours, 6=livraison en attente, 7=livraison en cours, 8=livraison en pause, 9=livraison en point, 10=livrer, 11=valider, 12=refapikey, 13=litige, 14=annuler, 15=commande direct en attente, 16=commande direct terminer |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### getcommandebyid
##### Description
obtenir une commande par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commande/{{id_commande}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/adresse/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/adresseclient/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/adressevendeur/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/compte/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/compteclient/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/comptevendeur/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/livreur/{{id_livreur}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/commandes/offre/{{id_offre}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getcommandesnolivreur
##### Description
obtenir les commandes sans livreur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/commandes/nolivreur?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
#### editcomptenom
##### Description
modifier le nom d'un compte

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/compte/{{id_compte}}/nom
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### getcomptebyid
##### Description
obtenir un compte par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/compte/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getcomptes

##### Description
obtenir les comptes visible pour le joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/comptes{{id_joueur}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getcomptesbygroupe
##### Description
obtenir les comptes par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/comptes/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

### gestion des groupes
#### getdroitsbygroupe
##### Description
obtenir les droits par l'id d'un groupe

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupe/{{id_groupe}}/droits?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getgroupes
##### Description
obtenir les groupes visible pour le joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/groupes?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
#### editjeton
##### Description
modifier un jeton

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/jeton
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| 1            | (int) nombre de jeton de 1 |
| 10           | (int) nombre de jeton de 10 |
| 100          | (int) nombre de jeton de 100 |
| 1k           | (int) nombre de jeton de 1k |
| 10k          | (int) nombre de jeton de 10k |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects

### gestion des joueurs
#### getjoueurbyid
##### Description
obtenir un joueur par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/joueur/{{id_joueur}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/joueur/pseudo/?apikey={{apikey}}&mdpapikey={{mdpapikey}}
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
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
{{site_url}}/joueurs?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/joueurs/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
#### addkeypay
##### Description
ajouter un keypay

##### Request
###### Method
POST
###### URL
```
{{site_url}}/keypay
```
###### Body
- mode: urlencoded
| Key          | Value                            |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| quant        | (int) quantite du keypay              |
| prixu        | (float) prix unitaire du keypay       |
| id_offre     | (int) id de l'offre du keypay         |


#### getkeypaybyid
##### Description
obtenir un keypay par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/keypay/{{id_keypay}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/keypays/offre/{{id_offre}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

### gestion des livreurs
#### editlivreuradresse
##### Description
modifier l'adresse d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/adresse
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| id_adresse   | (int) id de l'adresse                  |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editlivreurcompte
##### Description
modifier le compte d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/compte
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| id_compte    | (int) id du compte                     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editlivreurnom
##### Description
modifier le nom d'un livreur

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/livreur/{{id_livreur}}/nom
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### getlivreurbyid
##### Description
obtenir un livreur par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreur/{{id_livreur}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getlivreurs
##### Description
obtenir les livreurs visible pour le joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getlivreursbyadresse
##### Description
obtenir les livreurs par l'id d'une adresse

##### Request
###### Method
GET
###### URL
```
{{site_url}}/livreurs/adresse/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/livreurs/compte/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/livreurs/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
#### editoffreadresse
##### Description
modifier l'adresse d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/adresse/{{id_adresse}}
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrecompte
##### Description
modifier le compte d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/compte/{{id_compte}}
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffredescription
##### Description
modifier la description d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/description
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| description  | (str) texte limité à 450 caractères    |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrenom
##### Description
modifier le nom d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/nom
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| nom          | (str) texte limité à 50 caractères     |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 413: la longueur d'un paramètre est trop longue
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffreprix
##### Description
modifier le prix d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/prix
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| prix         | (float) prix de l'offre                |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffrestock
##### Description
modifier le stock d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/stock
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
| stock        | (int) stock de l'offre                 |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 400: paramètre manquant
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### editoffretype
##### Description
modifier le type d'une offre

##### Request
###### Method
PUT
###### URL
```
{{site_url}}/offre/{{id_offre}}/type/{{id_type_offre}}
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |

##### Response
###### Status Code
- 200: si la requête a été effectuée avec succès
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects
- 404: l'élément indiqué n'existe pas

#### getoffrebyid
##### Description
obtenir une offre par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offre/{{id_offre}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
obtenir toutes les offres visibles pour le joueur

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### getoffresall
##### Description
obtenir toutes les offres

##### Request
###### Method
GET
###### URL
```
{{site_url}}/offres/all?show_inactive={{show_inactive}}
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
{{site_url}}/offres/adresse/{{id_adresse}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/offres/compte/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/offres/groupe/{{id_groupe}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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
{{site_url}}/transaction
```
###### Body
- mode: urlencoded
| Key          | Value                                  |
|--------------|----------------------------------------|
| apikey         | (str) pseudo apikey                     |
| mdpapikey    | (str) mdp apikey                        |
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
- 403: vous n'avez pas les droits ou les identifiants apikey sont incorrects

#### gettransactionbyid
##### Description
obtenir une transaction par son id

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transaction/{{id_transaction}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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

#### gettransactionsbycompte
##### Description
obtenir les transactions par l'id d'un compte

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transactions/compte/{{id_compte}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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


#### gettransactionsbycompteandcommande
##### Description
obtenir les transactions par l'id d'un compte et l'id d'une commande

##### Request
###### Method
GET
###### URL
```
{{site_url}}/transactions/compte/{{id_compte}}/commande/{{id_commande}}?apikey={{apikey}}&mdpapikey={{mdpapikey}}
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