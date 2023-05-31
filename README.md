# computercraft_commerce

ce projet permet de créer un système d'échange et de banque sur un monde minecraft par l'intermédiaire du mod computercraft.

## prérequis

- mod computercraft ou cc-tweaked sur le serveur
  - minecraft 1.7.10 - computercraft 1.75
  - minecraft 1.18.2 - cc-tweaked 1.100.9
  - CraftOS-1.7 ou CraftOS-1.8
- option http activé dans les config du mod
- un serveur web apache avec une base de donnée

## installation du serveur web

1. creer un serveur apache-php-mysql (si vous voulez installer le serveur apache-php avec docker compiler l'image dans le repertoire docker)
2. placer dans le dossier de prod du serveur les repertoires api_computercraft et lua (noublier pas de les rendre accessible pour l'utilisateur du service apache ou docker)
3. completer la section "DataBase" dans le fichier config (computercraft_commerce\api_computercraft\class\config\config.yml)
4. executer l'installation en suivant la section "installation" dans la documentation (computercraft_commerce\doc\api_installation_maintenance.md)

## docker

ce docker ne contient qu'un serveur apache avec php, vous devez installer mysql ou mariadb avec un compte et une base de donnée pour l'api, le tout sur un autre conteneur ou autre.
sauf indication contraire il ne sera pas necessaire de surprimer le contenneur docker pour metre a jour l'api ou le repertoire de programme lua, pour mettre a jour les fichiers il sufira de les deposer dans le volume ou le repertoire externe.
(attention) ne remplacer pas votre fichier config : /api_computercraft/class/config/config.yml
```sh
cd /computercraft_commerce
sudo docker network create --subnet=172.18.0.0/16 dockernet
docker build -t apache_computercraft:latest .
sudo docker run --net dockernet --ip 172.18.0.11 --name apache_computercraft --restart=always -d \
	  -v /opt/html:/var/www/html \
	  -p 9081:80 \
	  apache_computercraft:latest
sudo docker run --net dockernet --ip 172.18.0.12 --name mariadb --restart=always -d \
	  -v mariadb:/var/lib/mysql \
	  -p 3306:3306 \
	  --env MARIADB_USER=youruser --env MARIADB_PASSWORD=yourpassword --env MARIADB_ROOT_PASSWORD=yourrootpassword \
	  mariadb:latest
```
si vous creer un conteneur mariadb n'oublier pas de fixer l'ip du conteneur elle devra être indiquer dans le fichier config.yml
les deux conteneur doivent être dans le même sous-reseau pour communiquer

## minecraft installation computercraft
1. télécharger le script d'installation avec la commande : __pastebin get su1j9ve5 startup__
2. redémarrer le poste et selectionner le programme à installer parmis ceux proposé

(note : sur les ancienne version de computercraft pastebien ne fonctionne plus entrer les commandes ci-dessous en changent bien les champs)
```lua
lua
t = http.get("http://__nom_du_serveur_http_ou_ip__:__port_si_non_80__/lua/update.lua")
t = t.readAll()
f = fs.open("startup","w")
f.write(t)
f.close()
os.reboot()
```
(note : les postes computercraft ne sont pas encore finalisé)
(note 11/09 : le poste client fonctionne mais la partie commerce n'est pas terminer)

- [ ] client (poste pour que chaque joueurs puissent commander et consulter les informations le concernant)
- [ ] commerce (traite les commandes, actualise les stocks et prix des offres qui lui sont lier)
- [ ] banque-terminal (permet au joueur d'effectuer des depots, retaits ou transferts de compte à compte)
- [ ] banque-routeur (envoie les commandes du poste commerce au client si les 2 le permettent)
- [ ] banque-admin (traite les transaction entre le client et le commerce lors de l'achat)
