# computercraft_commerce

ce projet permet de créer un système d'échange et de banque sur un monde minecraft par l'intermédiaire du mod computercraft.
les joueurs peuvent consulter les offres et les stocks des commerces, effectuer des commandes, consulter leur compte en banque et effectuer des transactions entre eux.

## prérequis

- mod computercraft ou cc-tweaked sur le serveur
  - si minecraft 1.7.10 ou inférieur : computercraft >=1.75 (CraftOS-1.7)
  - si minecraft 1.8 ou supérieur : cc-tweaked >=1.100.9 (CraftOS-1.8)
- option http activé dans les config du mod
- un serveur web (apache,nginx) avec php et une base de donnée (mysql ou mariadb)

## (1) installation du serveur web et de l'api

1. creer votre serveur web (il doit etre accessible par le serveur minecraft)
2. activer le module rewrite d'apache
3. sur votre seveur sql creer une base de donnée et un utilisateur avec les droits sur cette base
4. clonez le projet dans le dossier racine de votre serveur web
5. ouvrer le fichier de configuration (computercraft_commerce\api\init\config\config.yml)
5.1 inserer les informations de connexion a la base de donnée, les informations de connexion au serveur smtp pour les mails de recuperation de mot de passe au d'autre parametre optionnel
```yaml
Install: false # ne pas editer
General:
    NbrOffreDefaut: 5 # nombre d'offre par defaut pour les nouveaux inscrits
    NbrOffreMax: 25 # nombre d'offre maximum par utilisateur
    PrixOffre: 5000 # prix pour ajouter une offre
    CaseLigneSuite: _br_ # pour les retours a la ligne dans les descriptions
    Name: computercraft_api # nom de l'api
    Version: 2.0
    ModuleShowUser: true # afficher les utilisateurs pour les reservations dans les modules
DataBase: # base de donnée
    dbAdress: 0.0.0.0
    dbName: dbname
    dbUser: dbuser
    dbPassword: dbpass
    dbPort: 3306
SMTP: # serveur smtp pour les mails de recuperation de mot de passe
    Host: smtp.serveur.net
    Username: snmpuser
    Password: snmppass
    Protocol: ssl
    Port: 465
    From: mailsender
    Reply: mailtoreply
MaxLengthChamps: # longueur maximum des champs (ne pas editer)
    Nom: 50
    Description: 450
    Coo: 50
    Code: 50
    Pseudo: 50
    Email: 50
Module: # module supplementaire, mettez true si les mods sont installé
    EnderStorage: true
    WirelessRedstone: true
```

4. executer l'installation
votre serveur est configurer il ne reste plus qu'a ouvrir sur votre routeur les ports que vous avez choisi pour le http et le https et rediriger les requetes vers le serveur
et a appeler l'api avec l'url :
http://__nom_du_domaine_ou_ip__/computercraft_commerce/api/
https://__nom_du_domaine__/computercraft_commerce/api/

5. commande avec postman
importer les elements present dans le dossier postman dans votre compte
vous pouvez tester les requetes avec postman
la documentation est disponible ci-dessous :
 - [documentation admin](/docs/api_panel_admin.md)
 - [documentation user](/docs/api_panel_user_via_user.md)
 - [documentation apikey](/docs/api_panel_user_via_apikey.md)


## (2) installation du poste admin sur minecraft
1. télécharger le script d'installation avec la commande : __pastebin get su1j9ve5 startup__ (si pastebin ne fonctionne pas voir la section ci-dessous)
2. redémarrer le poste et selectionner le programme à installer parmis ceux proposé

(note : sur les ancienne version de computercraft, pastebien ne fonctionne plus entrer les commandes ci-dessous en changent bien les champs)
```lua
lua
t = http.get("http://__nom_du_serveur_ou_ip__:__port_si_non_80__/lua/install.lua")
t = t.readAll()
f = fs.open("startup","w")
f.write(t)
f.close()
os.reboot()
```