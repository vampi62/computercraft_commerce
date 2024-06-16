<?php
class Wirelessredstones {
    // recupere les wirelessredstones
    public static function getWirelessRedstones($bdd, $showUser = false, $limit = 100, $offset = 0) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstones.*, joueurs.pseudo_joueur
            FROM wireless_redstones LEFT JOIN joueurs ON wireless_redstones.id_joueur = joueurs.id_joueur
            WHERE wireless_redstones.id_wireless_redstone >= :offsetd
            ORDER BY wireless_redstones.id_wireless_redstone ASC
            LIMIT ' . $limit);
        } else {
            $req = $bdd->prepare('SELECT wireless_redstones.id_wireless_redstone, wireless_redstones.date_reservation_wireless_redstone
            FROM wireless_redstones
            WHERE wireless_redstones.id_wireless_redstone >= :offsetd
            ORDER BY wireless_redstones.id_wireless_redstone ASC
            LIMIT ' . $limit);
        }
        $req->execute(array(
            'offsetd' => $offset
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere un wirelessredstones par son id
    public static function getWirelessRedstoneById($bdd,$idWirelessRedstone, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstones.*, joueurs.pseudo_joueur
            FROM wireless_redstones.wireless_redstones LEFT JOIN joueurs ON wireless_redstones.id_joueur = joueurs.id_joueur
            WHERE wireless_redstones.id_wireless_redstone = :id_wireless_redstone');
        } else {
            $req = $bdd->prepare('SELECT wireless_redstones.id_wireless_redstone, wireless_redstones.date_reservation_wireless_redstone
            FROM wireless_redstones.wireless_redstones
            WHERE wireless_redstones.id_wireless_redstone = :id_wireless_redstone');
        }
        $req->execute(array(
            'id_wireless_redstone' => $idWirelessRedstone
        ));
        $wirelessredstone = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstone;
    }

    // recupere les wirelessredstones d'un joueur
    public static function getWirelessRedstonesByJoueur($bdd,$idJoueur,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT * FROM wireless_redstones WHERE id_joueur = :id_joueur
        LIMIT ' . $limit . ' OFFSET ' . $offset);
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere les wirelessredstones non reserver
    public static function getWirelessRedstonesNonReserver($bdd,$limit = 100,$offset = 0) {
        $req = $bdd->prepare('SELECT id_wireless_redstone FROM wireless_redstones
        WHERE id_joueur IS NULL AND id_wireless_redstone >= :offset1
        ORDER BY id_wireless_redstone ASC
        LIMIT ' . $limit);
        $req->execute(array(
            'offset1' => $offset
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // set un joueur et la date de la reservation
    public static function setWirelessRedstone($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE wireless_redstones SET id_joueur = :id_joueur, date_reservation_wireless_redstone = :date_reservation_wireless_redstone WHERE id_wireless_redstone = :id_wireless_redstone');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation_wireless_redstone' => $dateReservation,
            'id_wireless_redstone' => $idReserver
        ));
        $req->closeCursor();
    }
}