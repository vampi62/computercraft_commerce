# computercraft_commerce

ce projet permet de créer un système d'échange et de banque sur un monde minecraft par l'intermédiaire du mod computercraft.
les joueurs peuvent consulter les offres et les stocks des commerces, effectuer des commandes, consulter leur compte en banque et effectuer des transactions entre eux.

## prérequis

- mod computercraft ou cc-tweaked sur le serveur
  - minecraft 1.7.10 - computercraft 1.75
  - minecraft 1.18.2 - cc-tweaked 1.100.9
  - CraftOS-1.7 ou CraftOS-1.8
- option http activé dans les config du mod
- un serveur web apache avec une base de donnée (mysql ou mariadb) (dockerfile et commande fourni si besoin)

## installation du serveur web et de l'api

1. creer un serveur apache-php-mysql (si vous voulez installer le serveur apache-php avec docker compiler l'image dans le repertoire docker)
2. placer dans le dossier de prod du serveur les repertoires api_computercraft et lua (noublier pas de les rendre accessible pour l'utilisateur du service apache ou docker)
3. completer la section "DataBase" dans le fichier config (computercraft_commerce\api_computercraft\init\config\config.yml)
4. executer l'installation en suivant la section "installation" dans la documentation (computercraft_commerce\doc\api_installation_maintenance.md)

## docker

ce docker ne contient qu'un serveur apache avec php, vous devez installer mysql ou mariadb avec un compte et une base de donnée pour l'api, le tout sur un autre conteneur ou autre.
sauf indication contraire il ne sera pas necessaire de surprimer le conteneur docker pour mètre à jour l'api ou le repertoire de programme lua, pour mettre à jour les fichiers il sufira de les deposer dans le volume ou le repertoire externe.
(attention) ne remplacer pas votre fichier config : /api_computercraft/init/config/config.yml

privigier l'utilisation de l'https pour la connexion entre les postes computercraft et l'api
les versions de computercraft sur minecraft 1.7.10 ne supporte pas les certificats let's encrypt, il faudra donc utiliser un certificat d'une autorité de certification reconnu par le poste computercraft ou passer que en http (non recommandé sauf si serveur minecraft et api sur le même réseau local)
n'oublier pas l'utilisation de fail2ban pour protéger votre serveur web


1. telechargement du repertoire git et compilation de l'image docker
```sh
cd /opt
sudo git clone https://github.com/vampi62/computercraft_commerce.git
cd /computercraft_commerce
sudo docker network create --subnet=172.18.0.0/16 dockernet
docker build -t computercraft_commerce:latest .
```

2. serveur sql mariadb
```sh
sudo docker run --net dockernet --ip 172.18.0.12 --name mariadb --restart=always -d \
	  -v mariadb:/var/lib/mysql \
	  -p 3306:3306 \
	  --env MARIADB_USER=youruser --env MARIADB_PASSWORD=yourpassword --env MARIADB_ROOT_PASSWORD=yourrootpassword \
	  mariadb:latest
```
si vous creer un conteneur mariadb n'oublier pas de fixer l'ip du conteneur elle devra être indiquer dans le fichier config.yml
les deux conteneur doivent être dans le même sous-reseau pour communiquer


3.a. connexion http et https en direct sur le conteneur
3.a.1. génération d'un certificat ssl avec certbot
```sh
docker run -it --rm -p 80:80 -p 443:443 --name certbot \
    -v "/etc/letsencrypt:/etc/letsencrypt" \
    -v "/var/lib/letsencrypt:/var/lib/letsencrypt" \
    certbot/certbot certonly
```
3.a.2. création du conteneur utilisant le certificat ssl
```sh
sudo docker run --net dockernet --ip 172.18.0.11 --name computercraft_commerce --restart=always -d \
	  -v /opt/html:/var/www/html \
	  -v "/etc/letsencrypt:/etc/letsencrypt" \
	  -v "/var/lib/letsencrypt:/var/lib/letsencrypt" \
	  -p 80:80 \
	  -p 443:443 \
	  computercraft_commerce:latest
```

3.b. connexion http et https via un reverse proxy (ou juste http en direct sur le conteneur)
3.b.1. création du conteneur sans certificat ssl (pour une utilisation via un reverse proxy configurer sur le serveur web du serveur ou d'un autre conteneur)
```sh
sudo docker run --net dockernet --ip 172.18.0.11 --name computercraft_commerce --restart=always -d \
	  -v /opt/html:/var/www/html \
	  -p 9081:80 \
	  computercraft_commerce:latest
```
3.b.2. configuration du reverse proxy sur le serveur web externe
```sh
nano /etc/apache2/sites-available/000-default-le-ssl.conf

ProxyRequests Off
ProxyPreserveHost On
<Location /api_computercraft/>
	RewriteRule ^/api_computercraft$ api_computercraft/ [R]
	ProxyPass http://127.0.0.1:9081/api_computercraft/
	ProxyPassReverse http://127.0.0.1:9081/api_computercraft/
</Location>
```

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
