# computercraft_commerce

ce projet permet de créer un système d'échange et de banque sur un monde minecraft par l'intermédiaire du mod computercraft.
les joueurs peuvent consulter les offres et les stocks des commerces, effectuer des commandes, consulter leur compte en banque et effectuer des transactions entre eux.

## prérequis

- mod computercraft ou cc-tweaked sur le serveur
  - minecraft 1.7.10 - computercraft 1.75
  - minecraft 1.18.2 - cc-tweaked 1.100.9
  - CraftOS-1.7 ou CraftOS-1.8
- option http activé dans les config du mod
- un serveur web apache avec une base de donnée (mysql ou mariadb)

## installation du serveur web et de l'api

1. creer un serveur apache-php-mysql
2. placer dans le dossier de prod du serveur les repertoires api_computercraft et lua
3. completer la section "DataBase" et "SMTP" dans le fichier config (computercraft_commerce\api_computercraft\init\config\config.yml)
3.1. les valeurs des variable nbr_offre_defaut,nbr_offre_max,prix_offre,moduleshowuser de la section "General" et "Module" peuvent etre modifier
4. executer l'installation en suivant la section "installation" dans la documentation (computercraft_commerce\doc\api_installation_maintenance.md)


4. connexion
votre serveur est configurer il ne reste plus qu'a ouvrir sur votre routeur les ports que vous avez choisi pour le http et le https et rediriger les requetes vers le serveur
et a appeler l'api avec l'url :
http://__nom_du_domaine_ou_ip__/api_computercraft/
https://__nom_du_domaine__/api_computercraft/


## minecraft installation computercraft
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

- [ ] client (poste pour que chaque joueurs puissent commander et consulter les informations le concernant)
- [ ] commerce (traite les commandes, actualise les stocks et prix des offres qui lui sont lier)
- [ ] banque-terminal (permet au joueur d'effectuer des depots, retaits ou transferts de compte à compte)
- [ ] banque-routeur (envoie les commandes du poste commerce au client si les 2 le permettent)
- [ ] banque-admin (poste utilisé par les administrateurs pour effectuer des opérations sur les comptes des joueurs)
- [ ] locker (permet de servire de point relai pour les commandes)
