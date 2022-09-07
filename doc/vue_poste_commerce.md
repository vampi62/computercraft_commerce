description de toutes les vues pour le poste commerce

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
    - offre_commerce
    - commande_commerce
    - tranaction_commerce
    - config_pc
      - demande_login_pc
        - mise_a_jour
        - edit_config
        - reboot
        - info

![navigation](doc/vue/commerce/nav.png)
- la page nav est visible sur toutes les vue sauf la vue setup_login_pc et le mode update