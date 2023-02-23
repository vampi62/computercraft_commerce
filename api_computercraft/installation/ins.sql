#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: liste_droits
#------------------------------------------------------------

CREATE TABLE liste_droits(
        id_droits Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        groupe    tinyint(1) NOT NULL ,
        api       tinyint(1) NOT NULL
	,CONSTRAINT liste_droits_PK PRIMARY KEY (id_droits)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_produit
#------------------------------------------------------------

CREATE TABLE liste_types_produit(
        id_type_produit Int  Auto_increment  NOT NULL ,
        nom             Varchar (50) NOT NULL
	,CONSTRAINT liste_types_produit_PK PRIMARY KEY (id_type_produit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_adresse
#------------------------------------------------------------

CREATE TABLE liste_types_adresse(
        id_type_adresse Int  Auto_increment  NOT NULL ,
        nom             Varchar (50) NOT NULL
	,CONSTRAINT liste_types_adresse_PK PRIMARY KEY (id_type_adresse)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_status
#------------------------------------------------------------

CREATE TABLE liste_types_status(
        id_status Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL
	,CONSTRAINT liste_types_status_PK PRIMARY KEY (id_status)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: chemin_status
#------------------------------------------------------------

CREATE TABLE chemin_status(
        id_status                            Int  Auto_increment  NOT NULL ,
        client                               tinyint(1) NOT NULL ,
        vendeur                              tinyint(1) NOT NULL ,
        livreur                              tinyint(1) NOT NULL ,
        admin                                tinyint(1) NOT NULL ,
        id_status_liste_types_status         Int NOT NULL ,
        id_status_liste_types_status_arriver Int NOT NULL
	,CONSTRAINT chemin_status_PK PRIMARY KEY (id_status)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_compte
#------------------------------------------------------------

CREATE TABLE liste_types_compte(
        id_type_compte Int  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL
	,CONSTRAINT liste_types_compte_PK PRIMARY KEY (id_type_compte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_transaction
#------------------------------------------------------------

CREATE TABLE liste_types_transaction(
        id_type_transaction Int  Auto_increment  NOT NULL ,
        nom                 Varchar (50) NOT NULL
	,CONSTRAINT liste_types_transaction_PK PRIMARY KEY (id_type_transaction)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_types_status_transaction
#------------------------------------------------------------

CREATE TABLE liste_types_status_transaction(
        id_status_transaction Int  Auto_increment  NOT NULL ,
        nom                   Varchar (50) NOT NULL
	,CONSTRAINT liste_types_status_transaction_PK PRIMARY KEY (id_status_transaction)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: preset_droits_nom
#------------------------------------------------------------

CREATE TABLE preset_droits_nom(
        id_preset_nom Int  Auto_increment  NOT NULL ,
        nom           Varchar (50) NOT NULL ,
        groupe        tinyint(1) NOT NULL ,
        api           tinyint(1) NOT NULL
	,CONSTRAINT preset_droits_nom_PK PRIMARY KEY (id_preset_nom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liste_type_role
#------------------------------------------------------------

CREATE TABLE liste_type_role(
        id_table_select_role Int  Auto_increment  NOT NULL ,
        nom                  Varchar (50) NOT NULL ,
        description          Text NOT NULL
	,CONSTRAINT liste_type_role_PK PRIMARY KEY (id_table_select_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: preset_droits
#------------------------------------------------------------

CREATE TABLE preset_droits(
        id_droits     Int NOT NULL ,
        id_preset_nom Int NOT NULL ,
        valeur        tinyint(1) NOT NULL
	,CONSTRAINT preset_droits_PK PRIMARY KEY (id_droits,id_preset_nom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: joueurs
#------------------------------------------------------------

CREATE TABLE joueurs(
        id_joueur            Int  Auto_increment  NOT NULL ,
        pseudo               Varchar (50) NOT NULL ,
        mdp                  Varchar (50) NOT NULL ,
        email                Varchar (50) NOT NULL ,
        resettoken           Varchar (50) NOT NULL ,
        last_login           Date NOT NULL ,
        expire_resettoken    Date NOT NULL ,
        id_compte            Int ,
        id_table_select_role Int NOT NULL
	,CONSTRAINT joueurs_PK PRIMARY KEY (id_joueur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groupes
#------------------------------------------------------------

CREATE TABLE groupes(
        id_groupe         Int  Auto_increment  NOT NULL ,
        nom               Varchar (50) NOT NULL ,
        id_joueur         Int NOT NULL ,
        id_groupe_groupes Int
	,CONSTRAINT groupes_PK PRIMARY KEY (id_groupe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comptes
#------------------------------------------------------------

CREATE TABLE comptes(
        id_compte      Int  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL ,
        solde          Double NOT NULL ,
        id_joueur      Int NOT NULL ,
        id_groupe      Int ,
        id_type_compte Int NOT NULL
	,CONSTRAINT comptes_PK PRIMARY KEY (id_compte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: offres
#------------------------------------------------------------

CREATE TABLE offres(
        id_offre        Int  Auto_increment  NOT NULL ,
        prix            Float NOT NULL ,
        stock           Int NOT NULL ,
        nom             Varchar (50) NOT NULL ,
        description     Text NOT NULL ,
        last_update     Date NOT NULL ,
        id_joueur       Int NOT NULL ,
        id_compte       Int NOT NULL ,
        id_adresse      Int NOT NULL ,
        id_groupe       Int ,
        id_type_produit Int NOT NULL
	,CONSTRAINT offres_PK PRIMARY KEY (id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commandes
#------------------------------------------------------------

CREATE TABLE commandes(
        id_commande         Int  Auto_increment  NOT NULL ,
        nom_produit         Varchar (50) NOT NULL ,
        quantite            Int NOT NULL ,
        prix_unitaire       Float NOT NULL ,
        frait_livraison     Float NOT NULL ,
        description         Text NOT NULL ,
        suivi               Text NOT NULL ,
        date_commande       Date NOT NULL ,
        date_livraison      Date NOT NULL ,
        code_retrait        Varchar (50) NOT NULL ,
        id_offre            Int NOT NULL ,
        id_adresse          Int NOT NULL ,
        id_adresse_adresses Int NOT NULL ,
        id_transaction      Int ,
        id_joueur           Int NOT NULL ,
        id_joueur_joueurs   Int NOT NULL ,
        id_status           Int NOT NULL ,
        id_livreur          Int
	,CONSTRAINT commandes_PK PRIMARY KEY (id_commande)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adresses
#------------------------------------------------------------

CREATE TABLE adresses(
        id_adresse      Int  Auto_increment  NOT NULL ,
        nom             Varchar (50) NOT NULL ,
        coo             Varchar (50) NOT NULL ,
        description     Text NOT NULL ,
        id_joueur       Int NOT NULL ,
        id_type_adresse Int NOT NULL ,
        id_groupe       Int
	,CONSTRAINT adresses_PK PRIMARY KEY (id_adresse)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: litiges
#------------------------------------------------------------

CREATE TABLE litiges(
        id_litige   Int  Auto_increment  NOT NULL ,
        texte       Text NOT NULL ,
        date        Date NOT NULL ,
        id_commande Int NOT NULL ,
        id_joueur   Int NOT NULL
	,CONSTRAINT litiges_PK PRIMARY KEY (id_litige)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: transactions
#------------------------------------------------------------

CREATE TABLE transactions(
        id_transaction        Int  Auto_increment  NOT NULL ,
        nom                   Varchar (50) NOT NULL ,
        somme                 Double NOT NULL ,
        description           Text NOT NULL ,
        date                  Date NOT NULL ,
        id_status_transaction Int NOT NULL ,
        id_type_transaction   Int NOT NULL ,
        id_joueur             Int NOT NULL ,
        id_commande           Int ,
        id_compte             Int NOT NULL ,
        id_compte_comptes     Int NOT NULL
	,CONSTRAINT transactions_PK PRIMARY KEY (id_transaction)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: jeton_banque
#------------------------------------------------------------

CREATE TABLE jeton_banque(
        id_jeton    Int  Auto_increment  NOT NULL ,
        p1          Int NOT NULL ,
        p10         Int NOT NULL ,
        p100        Int NOT NULL ,
        p1k         Int NOT NULL ,
        p10k        Int NOT NULL ,
        last_update Date NOT NULL ,
        id_joueur   Int NOT NULL
	,CONSTRAINT jeton_banque_PK PRIMARY KEY (id_jeton)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: keyapi
#------------------------------------------------------------

CREATE TABLE keyapi(
        id_keyapi Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        mdp       Varchar (50) NOT NULL ,
        id_joueur Int NOT NULL ,
        id_groupe Int
	,CONSTRAINT keyapi_PK PRIMARY KEY (id_keyapi)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: keypay
#------------------------------------------------------------

CREATE TABLE keypay(
        id_keypay     Int  Auto_increment  NOT NULL ,
        cle           Varchar (50) NOT NULL ,
        date_expire   Date NOT NULL ,
        quantite      Int NOT NULL ,
        prix_unitaire Float NOT NULL ,
        id_joueur     Int NOT NULL ,
        id_offre      Int NOT NULL
	,CONSTRAINT keypay_PK PRIMARY KEY (id_keypay)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: livreur
#------------------------------------------------------------

CREATE TABLE livreur(
        id_livreur Int  Auto_increment  NOT NULL ,
        nom_groupe Varchar (50) NOT NULL ,
        id_joueur  Int NOT NULL ,
        id_compte  Int NOT NULL ,
        id_adresse Int NOT NULL ,
        id_groupe  Int
	,CONSTRAINT livreur_PK PRIMARY KEY (id_livreur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groupe_utilisateur
#------------------------------------------------------------

CREATE TABLE groupe_utilisateur(
        id_joueur Int NOT NULL ,
        id_groupe Int NOT NULL
	,CONSTRAINT groupe_utilisateur_PK PRIMARY KEY (id_joueur,id_groupe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groupe_droits
#------------------------------------------------------------

CREATE TABLE groupe_droits(
        id_droits Int NOT NULL ,
        id_groupe Int NOT NULL ,
        valeur    tinyint(1) NOT NULL
	,CONSTRAINT groupe_droits_PK PRIMARY KEY (id_droits,id_groupe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: keyapi_droits
#------------------------------------------------------------

CREATE TABLE keyapi_droits(
        id_droits Int NOT NULL ,
        id_keyapi Int NOT NULL ,
        valeur    tinyint(1) NOT NULL
	,CONSTRAINT keyapi_droits_PK PRIMARY KEY (id_droits,id_keyapi)
)ENGINE=InnoDB;




ALTER TABLE chemin_status
	ADD CONSTRAINT chemin_status_liste_types_status0_FK
	FOREIGN KEY (id_status_liste_types_status)
	REFERENCES liste_types_status(id_status);

ALTER TABLE chemin_status
	ADD CONSTRAINT chemin_status_liste_types_status1_FK
	FOREIGN KEY (id_status_liste_types_status_arriver)
	REFERENCES liste_types_status(id_status);

ALTER TABLE preset_droits
	ADD CONSTRAINT preset_droits_liste_droits0_FK
	FOREIGN KEY (id_droits)
	REFERENCES liste_droits(id_droits);

ALTER TABLE preset_droits
	ADD CONSTRAINT preset_droits_preset_droits_nom1_FK
	FOREIGN KEY (id_preset_nom)
	REFERENCES preset_droits_nom(id_preset_nom);

ALTER TABLE joueurs
	ADD CONSTRAINT joueurs_comptes0_FK
	FOREIGN KEY (id_compte)
	REFERENCES comptes(id_compte);

ALTER TABLE joueurs
	ADD CONSTRAINT joueurs_liste_type_role1_FK
	FOREIGN KEY (id_table_select_role)
	REFERENCES liste_type_role(id_table_select_role);

ALTER TABLE groupes
	ADD CONSTRAINT groupes_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE groupes
	ADD CONSTRAINT groupes_groupes1_FK
	FOREIGN KEY (id_groupe_groupes)
	REFERENCES groupes(id_groupe);

ALTER TABLE comptes
	ADD CONSTRAINT comptes_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE comptes
	ADD CONSTRAINT comptes_groupes1_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE comptes
	ADD CONSTRAINT comptes_liste_types_compte2_FK
	FOREIGN KEY (id_type_compte)
	REFERENCES liste_types_compte(id_type_compte);

ALTER TABLE offres
	ADD CONSTRAINT offres_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE offres
	ADD CONSTRAINT offres_comptes1_FK
	FOREIGN KEY (id_compte)
	REFERENCES comptes(id_compte);

ALTER TABLE offres
	ADD CONSTRAINT offres_adresses2_FK
	FOREIGN KEY (id_adresse)
	REFERENCES adresses(id_adresse);

ALTER TABLE offres
	ADD CONSTRAINT offres_groupes3_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE offres
	ADD CONSTRAINT offres_liste_types_produit4_FK
	FOREIGN KEY (id_type_produit)
	REFERENCES liste_types_produit(id_type_produit);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_offres0_FK
	FOREIGN KEY (id_offre)
	REFERENCES offres(id_offre);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_adresses1_FK
	FOREIGN KEY (id_adresse)
	REFERENCES adresses(id_adresse);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_adresses2_FK
	FOREIGN KEY (id_adresse_adresses)
	REFERENCES adresses(id_adresse);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_transactions3_FK
	FOREIGN KEY (id_transaction)
	REFERENCES transactions(id_transaction);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_joueurs4_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_joueurs5_FK
	FOREIGN KEY (id_joueur_joueurs)
	REFERENCES joueurs(id_joueur);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_liste_types_status6_FK
	FOREIGN KEY (id_status)
	REFERENCES liste_types_status(id_status);

ALTER TABLE commandes
	ADD CONSTRAINT commandes_livreur7_FK
	FOREIGN KEY (id_livreur)
	REFERENCES livreur(id_livreur);

ALTER TABLE adresses
	ADD CONSTRAINT adresses_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE adresses
	ADD CONSTRAINT adresses_liste_types_adresse1_FK
	FOREIGN KEY (id_type_adresse)
	REFERENCES liste_types_adresse(id_type_adresse);

ALTER TABLE adresses
	ADD CONSTRAINT adresses_groupes2_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE litiges
	ADD CONSTRAINT litiges_commandes0_FK
	FOREIGN KEY (id_commande)
	REFERENCES commandes(id_commande);

ALTER TABLE litiges
	ADD CONSTRAINT litiges_joueurs1_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_liste_types_status_transaction0_FK
	FOREIGN KEY (id_status_transaction)
	REFERENCES liste_types_status_transaction(id_status_transaction);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_liste_types_transaction1_FK
	FOREIGN KEY (id_type_transaction)
	REFERENCES liste_types_transaction(id_type_transaction);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_joueurs2_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_comptes3_FK
	FOREIGN KEY (id_compte)
	REFERENCES comptes(id_compte);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_comptes4_FK
	FOREIGN KEY (id_compte_comptes)
	REFERENCES comptes(id_compte);

ALTER TABLE transactions
	ADD CONSTRAINT transactions_comptes5_FK
	FOREIGN KEY (id_commande)
	REFERENCES commandes(id_commande);

ALTER TABLE jeton_banque
	ADD CONSTRAINT jeton_banque_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE keyapi
	ADD CONSTRAINT keyapi_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE keyapi
	ADD CONSTRAINT keyapi_groupes1_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE keypay
	ADD CONSTRAINT keypay_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE keypay
	ADD CONSTRAINT keypay_offres1_FK
	FOREIGN KEY (id_offre)
	REFERENCES offres(id_offre);

ALTER TABLE livreur
	ADD CONSTRAINT livreur_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE livreur
	ADD CONSTRAINT livreur_comptes1_FK
	FOREIGN KEY (id_compte)
	REFERENCES comptes(id_compte);

ALTER TABLE livreur
	ADD CONSTRAINT livreur_adresses2_FK
	FOREIGN KEY (id_adresse)
	REFERENCES adresses(id_adresse);

ALTER TABLE livreur
	ADD CONSTRAINT livreur_groupes3_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE groupe_utilisateur
	ADD CONSTRAINT groupe_utilisateur_joueurs0_FK
	FOREIGN KEY (id_joueur)
	REFERENCES joueurs(id_joueur);

ALTER TABLE groupe_utilisateur
	ADD CONSTRAINT groupe_utilisateur_groupes1_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE groupe_droits
	ADD CONSTRAINT groupe_droits_liste_droits0_FK
	FOREIGN KEY (id_droits)
	REFERENCES liste_droits(id_droits);

ALTER TABLE groupe_droits
	ADD CONSTRAINT groupe_droits_groupes1_FK
	FOREIGN KEY (id_groupe)
	REFERENCES groupes(id_groupe);

ALTER TABLE keyapi_droits
	ADD CONSTRAINT keyapi_droits_liste_droits0_FK
	FOREIGN KEY (id_droits)
	REFERENCES liste_droits(id_droits);

ALTER TABLE keyapi_droits
	ADD CONSTRAINT keyapi_droits_keyapi1_FK
	FOREIGN KEY (id_keyapi)
	REFERENCES keyapi(id_keyapi);
