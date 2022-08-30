# computercraft_commerce

ce projet permet de créer un système d'échange et de banque sur un monde minecraft par l'intermédiaire du mod computercraft.

## prérequis

- mod computercraft sur le serveur
- option http activé dans les config du mod
- un serveur web apache avec une base de donnée

## installation du serveur web

1. creer un serveur apache-php-mysql (si vous voulez installer le serveur apache-php avec docker compiler l'image dans le repertoire docker)
2. placer dans le dossier de prod du serveur les repertoires api_computercraft et lua (noublier pas de les rendre accessible pour l'utilisateur du service apache ou docker)
3. completer la section "DataBase" dans le fichier config (computercraft_commerce\api_computercraft\modele\config\config.yml)
4. executer l'installation (http://__nom_du_serveur_http_ou_ip__:__port_si_non_80__/api_computercraft/installation/index.php?pseudo=__pseudo_compte_admin__&mdp=__mdp_admin__&mdpconfirm=__confirm_mdp_admin__&email=__email_admin__)
- remplacer les éléments suivant par les votre : __nom_du_serveur_http_ou_ip__ , __port_si_non_80__ , __pseudo_compte_admin__ , __mdp_admin__ , __confirm_mdp_admin__ , __email_admin__
- le mot de passe doit faire plus de 8 caractères, avoir une majuscule, une minuscule et un chiffre
- l'email doit avoir un format valide, exemple : monmail@mail.com

## docker

ce docker ne contient qu'un serveur apache avec php, vous devez installer mysql ou mariadb avec un compte et une base de donnée pour l'api, le tout sur un autre conteneur ou autre.
une fois creer le conteneur n'a plus à être supprimer, pour mettre a jour les fichiers deposer les dans le volume ou le repertoire externe
(attention) ne remplacer pas votre fichier config : /api_computercraft/modele/config/config.yml
```sh
cd /computercraft_commerce
docker build -t mc-php-site:latest .
sudo docker run --name apache_computercraft --restart=always -d \
	  -v /opt/html:/var/www/html \
	  -p 9081:9081 \
	  mc-php-site:latest
```

## minecraft installation computercraft
1. télécharger le script d'installation avec la commande : __pastebin get su1j9ve5 startup__
2. redémarrer le poste et selectionner le programme à installer parmis ceux proposé

(note : les postes computercraft ne sont pas encore finalisé)

- [ ] client (poste pour que chaque joueurs puissent commander et consulter les informations le concernant)
- [ ] commerce (traite les commandes, actualise les stocks et prix des offres qui lui sont lier)
- [ ] banque-terminal (permet au joueur d'effectuer des depots, retaits ou transferts de compte à compte)
- [ ] banque-routeur (envoie les commandes du poste commerce au client si les 2 le permettent)
- [ ] banque-admin (traite les transaction entre le client et le commerce lors de l'achat)
