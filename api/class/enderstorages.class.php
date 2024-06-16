<?php
class Enderstorages {
    // recupere les enderstorages
    public static function getEnderStoragesChest($bdd, $showUser = false, $limit = 100, $offset = 0) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_chests.*, joueurs.pseudo_joueur
            FROM enderstorage_chests LEFT JOIN joueurs ON enderstorage_chests.id_joueur = joueurs.id_joueur
            WHERE enderstorage_chests.id_enderstorage_chest >= :offset1
            ORDER BY enderstorage_chests.id_enderstorage_chest ASC
            LIMIT ' . $limit);
        } else {
            $req = $bdd->prepare('SELECT enderstorage_chests.id_enderstorage_chest, enderstorage_chests.color_rang_left_enderstorage_chest, enderstorage_chests.color_rang_center_enderstorage_chest, enderstorage_chests.color_rang_right_enderstorage_chest, enderstorage_chests.date_reservation_enderstorage_chest
            FROM enderstorage_chests
            WHERE enderstorage_chests.id_enderstorage_chest >= :offset1
            ORDER BY enderstorage_chests.id_enderstorage_chest ASC
            LIMIT ' . $limit);
        }
        $req->execute(array(
            'offset1' => $offset
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere un enderstorage par son id
    public static function getEnderStorageChestById($bdd,$idEnderStorageChest, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_chests.*, joueurs.pseudo_joueur
            FROM enderstorage_chests LEFT JOIN joueurs ON enderstorage_chests.id_joueur = joueurs.id_joueur
            WHERE enderstorage_chests.id_enderstorage_chest = :id_enderstorage_chest');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_chests.id_enderstorage_chest, enderstorage_chests.color_rang_left_enderstorage_chest, enderstorage_chests.color_rang_center_enderstorage_chest, enderstorage_chests.color_rang_right_enderstorage_chest, enderstorage_chests.date_reservation_enderstorage_chest
            FROM enderstorage_chests
            WHERE enderstorage_chests.id_enderstorage_chest = :id_enderstorage_chest');
        }
        $req->execute(array(
            'id_enderstorage_chest' => $idEnderStorageChest
        ));
        $enderstorage = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorage;
    }

    // recupere les enderstorages d'un joueur
    public static function getEnderStoragesChestByJoueur($bdd,$idJoueur,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_chests WHERE id_joueur = :id_joueur
        ORDER BY enderstorage_chests.id_enderstorage_chest ASC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere les enderstorages non reserver
    public static function getEnderStoragesChestNonReserver($bdd,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT id_enderstorage_chest, color_rang_left_enderstorage_chest, color_rang_center_enderstorage_chest, color_rang_right_enderstorage_chest FROM enderstorage_chests
        WHERE id_joueur IS NULL AND id_enderstorage_chest >= :offset1
        ORDER BY id_enderstorage_chest ASC
        LIMIT ' . $limit);
        $req->execute(array(
            'offset1' => $offset
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // set un joueur et la date de la reservation
    public static function setEnderStorageChest($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE enderstorage_chests SET id_joueur = :id_joueur, date_reservation_enderstorage_chest = :date_reservation_enderstorage_chest
        WHERE id_enderstorage_chest = :id_enderstorage_chest');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation_enderstorage_chest' => $dateReservation,
            'id_enderstorage_chest' => $idReserver
        ));
        $req->closeCursor();
    }

    // recupere les enderstorages
    public static function getEnderStoragesTank($bdd,$showUser = false,$limit = 100,$offset = 0) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_tanks.*, joueurs.pseudo_joueur
            FROM enderstorage_tanks LEFT JOIN joueurs ON enderstorage_tanks.id_joueur = joueurs.id_joueur
            WHERE enderstorage_tanks.id_enderstorage_tank >= :offset1
            ORDER BY enderstorage_tanks.id_enderstorage_tank
            LIMIT ' . $limit);
        } else {
            $req = $bdd->prepare('SELECT enderstorage_tanks.id_enderstorage_tank, enderstorage_tanks.color_rang_left_enderstorage_tank, enderstorage_tanks.color_rang_center_enderstorage_tank, enderstorage_tanks.color_rang_right_enderstorage_tank, enderstorage_tanks.date_reservation_enderstorage_tank
            FROM enderstorage_tanks
            WHERE enderstorage_tanks.id_enderstorage_tank >= :offset1
            ORDER BY enderstorage_tanks.id_enderstorage_tank
            LIMIT ' . $limit);
        }
        $req->execute(array(
            'offset1' => $offset
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere un enderstorage par son id
    public static function getEnderStorageTankById($bdd,$idEnderStorageTank,$showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT enderstorage_tanks.*, joueurs.pseudo_joueur
            FROM enderstorage_tanks LEFT JOIN joueurs ON enderstorage_tanks.id_joueur = joueurs.id_joueur
            WHERE enderstorage_tanks.id_enderstorage_tank = :id_enderstorage_tank');
        } else {
            $req = $bdd->prepare('SELECT enderstorage_tanks.id_enderstorage_tank, enderstorage_tanks.color_rang_left_enderstorage_tank, enderstorage_tanks.color_rang_center_enderstorage_tank, enderstorage_tanks.color_rang_right_enderstorage_tank, enderstorage_tanks.date_reservation_enderstorage_tank
            FROM enderstorage_tanks
            WHERE enderstorage_tanks.id_enderstorage_tank = :id_enderstorage_tank');
        }
        $req->execute(array(
            'id_enderstorage_tank' => $idEnderStorageTank
        ));
        $enderstorage = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorage;
    }

    // recupere les enderstorages d'un joueur
    public static function getEnderStoragesTankByJoueur($bdd,$idJoueur,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT * FROM enderstorage_tanks WHERE id_joueur = :id_joueur
        ORDER BY enderstorage_tanks ASC
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // recupere les enderstorages non reserver
    public static function getEnderStoragesTankNonReserver($bdd,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT id_enderstorage_tank, color_rang_left_enderstorage_tank, color_rang_center_enderstorage_tank, color_rang_right_enderstorage_tank FROM enderstorage_tanks
        WHERE id_joueur IS NULL AND id_enderstorage_tank >= :offset1
        ORDER BY id_enderstorage_tank ASC
        LIMIT ' . $limit);
        $req->execute(array(
            'offset1' => $offset
        ));
        $enderstorages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $enderstorages;
    }

    // set un joueur et la date de la reservation
    public static function setEnderStorageTank($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE enderstorage_tanks SET id_joueur = :id_joueur, date_reservation_enderstorage_tank = :date_reservation_enderstorage_tank WHERE id_enderstorage_tank = :id_enderstorage_tank');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation_enderstorage_tank' => $dateReservation,
            'id_enderstorage_tank' => $idReserver
        ));
        $req->closeCursor();
    }
}