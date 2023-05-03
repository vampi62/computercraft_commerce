<?php
// get offres/{id_utilisateur}
// get offres/{id_compte}
// get offres/{id_adresse}
// get offre/{id}
// set offre/{id}/compte
// set offre/{id}/adresse
// set offre/{id}/id_type_produit
// set offre/{id}/prix
// set offre/{id}/description
// set offre/{id}/nom
// set offre/{id}/stock
// set offre/{id}/delete
// set offre/add

class Offres {
    // recupere toutes les offres
    public static function getOffres($bdd) {
        $req = $bdd->prepare('SELECT * FROM offres');
        $req->execute();
        $offres = $req->fetchAll();
        return $offres;
    }

    // recupere les offres d'un utilisateur
    public static function getOffres_joueur($bdd,$id_joueur) {
        $bdd->prepare("SELECT * FROM offres WHERE id_joueur = :id_joueur");
        $req->execute(array(
            'id_joueur' => "id_joueur"
        ));
        $offres = $req->fetchAll();
        return $offres;
    }

    // recupere les offres associer a un compte
    public static function getOffres_compte($bdd,$id_compte) {
        $bdd->prepare("SELECT * FROM offres WHERE id_compte = :id_compte");
        $req->execute(array(
            'id_compte' => "id_compte"
        ));
        $offres = $req->fetchAll();
        return $offres;
    }

    // recupere les offres associer a une adresse
    public static function getOffres_adresse($bdd,$id_adresse) {
        $bdd->prepare("SELECT * FROM offres WHERE id_adresse = :id_adresse");
        $req->execute(array(
            'id_adresse' => "id_adresse"
        ));
        $offres = $req->fetchAll();
        return $offres;
    }

    // recupere l'offre
    public static function getOffre($bdd,$id_offre) {
        $bdd->prepare("SELECT * FROM offres WHERE id = :id_offre");
        $req->execute(array(
            'id_offre' => "id_offre"
        ));
        $offre = $req->fetch(PDO::FETCH_ASSOC);
        return $offre;
    }

    // modifie la date de derniere modification de l'offre
    private static function update_last_update($bdd,$id_offre) {
        $bdd->prepare("UPDATE offres SET last_update = :last_update WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'last_update' => date('Y-m-d H:i:s')
        ));
    }

    // modifie le compte associer a l'offre
    public static function setOffre_compte($bdd,$id_offre,$id_compte) {
        $bdd->prepare("UPDATE offres SET id_compte = :id_compte WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_compte' => $id_compte
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie l'adresse associer a l'offre
    public static function setOffre_adresse($bdd,$id_offre,$id_adresse) {
        $bdd->prepare("UPDATE offres SET id_adresse = :id_adresse WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_adresse' => $id_adresse
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie le type de livraison associer a l'offre
    public static function setOffre_type_produit($bdd,$id_offre,$id_type_produit) {
        $bdd->prepare("UPDATE offres SET id_type_produit = :id_type_produit WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'id_type_produit' => $id_type_produit
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie le prix de l'offre
    public static function setOffre_prix($bdd,$id_offre,$prix) {
        $bdd->prepare("UPDATE offres SET prix = :prix WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'prix' => $prix
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie la description de l'offre
    public static function setOffre_description($bdd,$id_offre,$description) {
        $bdd->prepare("UPDATE offres SET description = :description WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'description' => $description
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie le nom de l'offre
    public static function setOffre_nom($bdd,$id_offre,$nom) {
        $bdd->prepare("UPDATE offres SET nom = :nom WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'nom' => $nom
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // modifie le stock de l'offre
    public static function setOffre_stock($bdd,$id_offre,$stock) {
        $bdd->prepare("UPDATE offres SET stock = :stock WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre,
            'stock' => $stock
        ));
        self::update_last_update($bdd,$id_offre);
    }

    // supprime l'offre
    public static function deleteOffre($bdd,$id_offre) {
        $bdd->prepare("DELETE FROM offres WHERE id_offre = :id_offre");
        $req->execute(array(
            'id_offre' => $id_offre
        ));
    }

    // ajoute une offre
    public static function addOffre($bdd,$id_joueur,$id_compte,$id_adresse,$id_type_produit,$prix,$description,$nom,$stock) {
        $bdd->prepare("INSERT INTO offres(id_joueur,id_compte,id_adresse,id_type_produit,prix,description,nom,stock,last_update) VALUES(:id_joueur,:id_compte,:id_adresse,:id_type_produit,:prix,:description,:nom,:stock,:last_update)");
        $req->execute(array(
            'id_joueur' => $id_joueur,
            'id_compte' => $id_compte,
            'id_adresse' => $id_adresse,
            'id_type_produit' => $id_type_produit,
            'prix' => $prix,
            'description' => $description,
            'nom' => $nom,
            'stock' => $stock,
            'last_update' => date('Y-m-d H:i:s')
        ));
        $id_offre = $bdd->lastInsertId();
        return $id_offre;
    }
}