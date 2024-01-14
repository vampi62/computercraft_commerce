<?php
class Wirelessredstones {
    // recupere les wirelessredstones
    public static function getWirelessRedstones($bdd,$offset,$nbParPage, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstones.*, joueurs.pseudo_joueur
            FROM wireless_redstones LEFT JOIN joueurs ON wireless_redstones.id_joueur = joueurs.id_joueur
            WHERE id_wireless_redstone >= :offset
            ORDER BY id_wireless_redstone
            LIMIT :nbParPage');
        } else {
            $req = $bdd->prepare('SELECT wireless_redstones.id_wireless_redstone, wireless_redstones.date_reservation_wireless_redstone
            FROM wireless_redstones
            WHERE id_wireless_redstone >= :offset
            ORDER BY id_wireless_redstone
            LIMIT :nbParPage');
        }
        $req->execute(array(
            'offset' => $offset,
            'nbparpage' => $nbParPage
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere un wirelessredstones par son id
    public static function getWirelessRedstoneById($bdd,$idWirelessRedstone, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstones.*, joueurs.pseudo_joueur
            FROM wireless_redstones LEFT JOIN joueurs ON wireless_redstones.id_joueur = joueurs.id_joueur
            WHERE id_wireless_redstone = :id_wireless_redstone');
        } else {
            $req = $bdd->prepare('SELECT wireless_redstones.id_wireless_redstone, wireless_redstones.date_reservation_wireless_redstone
            FROM wireless_redstones
            WHERE id_wireless_redstone = :id_wireless_redstone');
        }
        $req->execute(array(
            'id_wireless_redstone' => $idWirelessRedstone
        ));
        $wirelessredstone = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstone;
    }

    // recupere les wirelessredstones d'un joueur
    public static function getWirelessRedstonesByJoueur($bdd,$idJoueur) {
        $req = $bdd->prepare('SELECT * FROM wireless_redstones WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere les wirelessredstones non reserver
    public static function getWirelessRedstonesNonReserver($bdd,$offset,$nbParPage) {
        $req = $bdd->prepare('SELECT * FROM wireless_redstones
        WHERE id_joueur IS NULL AND id_wireless_redstone >= :offset1
        ORDER BY id_wireless_redstone
        LIMIT :nbage');
        $req->execute(array(
            'offset1' => $offset,
            'nbage' => $nbParPage
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