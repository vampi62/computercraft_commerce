description de toutes les vues pour le poste client

les programmes computercraft sont encore en cours de développement,
certaines fonctionnalités presenter ci-dessous sont susceptible de ne pas être encore implémenter ou totalement fonctionnelle.

chaque vue se presente comme ceci
- chaque vue a pour dimension
  - longueur X de 1 a 51
  - hauteur Y de 1 a 19
- le background des parties sélectionnable est en gris

## liste des pages et leur arborescence

- setup_login_pc (si pas de login pc d'enregistrer (premier démarrage))
  - menu
    - login
      - inscription
      - mdp_oublie
      - update_mdp (pas d'image)
      - update_mail (pas d'image)
    - offre_client
      - panier
        - filtre
        - plus_info_offre
      - filtre
      - plus_info_offre
    - offre_commerce
      - filtre
      - edit_offre
    - commande_client
      - filtre
      - plus_info
        - litige (integration en pause)
    - commande_commerce
      - filtre
      - plus_info
    - transaction_client
      - filtre
      - plus_info
        - litige (integration en pause)
    - transaction_commerce
      - filtre
      - plus_info
    - demande_login_pc
      - config_pc
        - mise_a_jour
        - edit_config
        - info

la partie ci-dessous est independent du reste, elle peut être appeler à n'importe quel endroit de l'arborescence au dessus à partir de menu

- adresse
  - add/edit_addr

![navigation](doc/vue/client/nav.png)
- la page nav est visible sur toutes les vue sauf la vue setup_login_pc et le mode update

![navigation](doc/vue/client/setup_login_pc.png)
- ce mot de passe est uniquement conserver sur le poste local il n'est pas lier a votre compte

![navigation](doc/vue/client/demande_login_pc.png)

![navigation](doc/vue/client/menu.png)
- portail client : faite vos achat et suivez vos commandes
- portail commerce : editer vos offre et gerez les commande que vous recevez

![navigation](doc/vue/client/login.png)

![navigation](doc/vue/client/mdp_oublie.png)

![navigation](doc/vue/client/inscription.png)

![navigation](doc/vue/client/info.png)

![navigation](doc/vue/client/config_pc.png)
- le bouton edit_config ouvre le fichier pour editer la config reseau, lors de l'enregistrement des modification, un test sera effectuer, si le test echoue votre modification ne sera pas sauvegarder

![navigation](doc/vue/client/mise_a_jour.png)
- la page va verifier sur votre serveur http si une nouvelle version y est stockée

![navigation](doc/vue/client/offre_client.png)

![navigation](doc/vue/client/panier.png)

![navigation](doc/vue/client/filtre.png)
- la page filtre garde le même modèle seul le nombre de ligne change


![navigation](doc/vue/client/transaction.png)

![navigation](doc/vue/client/commande.png)

![navigation](doc/vue/client/plus_info_offre.png)
- le bouton __ajouter au panier__ change en retirer si l'on se trouve dans le panier

![navigation](doc/vue/client/plus_info_commande.png)
- le bouton __litige__ sert à annuler une commande et a obtenir un remboursement (ce bouton n'est pas encore fonctionnel)

![navigation](doc/vue/client/plus_info_commande_commerce.png)
- le bouton __confirm envoie__ change en fonction du statut de la commande

![navigation](doc/vue/client/plus_info_transaction.png)
- le bonton __id cmd__ redirige vers une page plus_info_commande

![navigation](doc/vue/client/offre_commerce.png)
- le bouton __histo__ redirige vers une page transaction avec les filtres pour n'afficher que les transaction

![navigation](doc/vue/client/edit_offre.png)

![navigation](doc/vue/client/adresse.png)

![navigation](doc/vue/client/edit_adresse.png)
