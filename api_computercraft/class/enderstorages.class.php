<?php
class Enderstorages {
    // recupere les enderstorages
    public static function getEnderStoragesChest($bdd,$offset,$nbParPage, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_chest.*, joueurs.nom_joueur
            FROM enderstorage_chest LEFT JOIN joueurs ON enderstorage_chest.id_joueur = joueurs.id_joueur
            WHERE id_enderstorage_chest >= :offset
            ORDER BY id_enderstorage_chest
            LIMIT :nbParPage');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_chest.id_enderstorage_chest, enderstorage_chest.color_rang_left, enderstorage_chest.color_rang_center, enderstorage_chest.color_rang_right, enderstorage_chest.date_reservation
            FROM enderstorage_chest
            WHERE id_enderstorage_chest >= :offset
            ORDER BY id_enderstorage_chest
            LIMIT :nbParPage');
        }
        $req->execute(array(
            'offset' => $offset,
            'nbParPage' => $nbParPage
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere un enderstorage par son id
    public static function getEnderStorageChestById($bdd,$idEnderStorageChest, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_chest.*, joueurs.nom_joueur
            FROM enderstorage_chest LEFT JOIN joueurs ON enderstorage_chest.id_joueur = joueurs.id_joueur
            WHERE id_enderstorage_chest = :id_enderstorage_chest');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_chest.id_enderstorage_chest, enderstorage_chest.color_rang_left, enderstorage_chest.color_rang_center, enderstorage_chest.color_rang_right, enderstorage_chest.date_reservation
            FROM enderstorage_chest
            WHERE id_enderstorage_chest = :id_enderstorage_chest');
        }
        $req->execute(array(
            'id_enderstorage_chest' => $idEnderStorageChest
        ));
        $enderstorage = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorage;
    }

    // recupere les enderstorages d'un joueur
    public static function getEnderStoragesChestByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_chest WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere les enderstorages non reserver
    public static function getEnderStoragesChestNonReserver($bdd,$offset,$nbParPage) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_chest
        WHERE id_joueur IS NULL AND id_enderstorage_chest >= :offset
        ORDER BY id_enderstorage_chest
        LIMIT :nbParPage');
        $req->execute(array(
            'offset' => $offset,
            'nbParPage' => $nbParPage
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // set un joueur et la date de la reservation
    public static function setEnderStorageChest($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE enderstorage_chest SET id_joueur = :id_joueur, date_reservation = :date_reservation WHERE id_enderstorage_chest = :id_enderstorage_chest');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation' => $dateReservation,
            'id_enderstorage_chest' => $idReserver
        ));
        $req->closeCursor();
    }

    // recupere les enderstorages
    public static function getEnderStoragesTank($bdd,$offset,$nbParPage,$showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_tank.*, joueurs.nom_joueur
            FROM enderstorage_tank LEFT JOIN joueurs ON enderstorage_tank.id_joueur = joueurs.id_joueur
            WHERE id_enderstorage_tank >= :offset
            ORDER BY id_enderstorage_tank
            LIMIT :nbParPage');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_tank.id_enderstorage_tank, enderstorage_tank.color_rang_left, enderstorage_tank.color_rang_center, enderstorage_tank.color_rang_right, enderstorage_tank.date_reservation
            FROM enderstorage_tank
            WHERE id_enderstorage_tank >= :offset
            ORDER BY id_enderstorage_tank
            LIMIT :nbParPage');
        }
        $req->execute(array(
            'offset' => $offset,
            'nbParPage' => $nbParPage
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere un enderstorage par son id
    public static function getEnderStorageTankById($bdd,$idEnderStorageTank,$showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_tank.*, joueurs.nom_joueur
            FROM enderstorage_tank LEFT JOIN joueurs ON enderstorage_tank.id_joueur = joueurs.id_joueur
            WHERE id_enderstorage_tank = :id_enderstorage_tank');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_tank.id_enderstorage_tank, enderstorage_tank.color_rang_left, enderstorage_tank.color_rang_center, enderstorage_tank.color_rang_right, enderstorage_tank.date_reservation
            FROM enderstorage_tank
            WHERE id_enderstorage_tank = :id_enderstorage_tank');
        }
        $req->execute(array(
            'id_enderstorage_tank' => $idEnderStorageTank
        ));
        $enderstorage = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorage;
    }

    // recupere les enderstorages d'un joueur
    public static function getEnderStoragesTankByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_tank WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere les enderstorages non reserver
    public static function getEnderStoragesTankNonReserver($bdd,$offset,$nbParPage) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_tank
        WHERE id_joueur IS NULL AND id_enderstorage_tank >= :offset
        ORDER BY id_enderstorage_tank
        LIMIT :nbParPage');
        $req->execute(array(
            'offset' => $offset,
            'nbParPage' => $nbParPage
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // set un joueur et la date de la reservation
    public static function setEnderStorageTank($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE enderstorage_tank SET id_joueur = :id_joueur, date_reservation = :date_reservation WHERE id_enderstorage_tank = :id_enderstorage_tank');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation' => $dateReservation,
            'id_enderstorage_tank' => $idReserver
        ));
        $req->closeCursor();
    }
}