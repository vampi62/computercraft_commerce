<?php
class Wirelessredstones {
    // recupere les wirelessredstones
    public static function getWirelessRedstones($bdd,$page,$nbParPage, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstone.*, joueurs.nom_joueur
            FROM wireless_redstone INNER JOIN joueurs ON wireless_redstone.id_joueur = joueurs.id_joueur
            ORDER BY id_wireless_redstone LIMIT :pagination, :nbParPage');
        } else {
            $req = $bdd->prepare('SELECT wireless_redstone.id_wireless_redstone, wireless_redstone.date_reservation
            FROM wireless_redstone
            ORDER BY id_wireless_redstone LIMIT :pagination, :nbParPage');
        }
        $req->execute(array(
            'pagination' => $page*$nbParPage,
            'nbParPage' => $nbParPage
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere un wirelessredstones par son id
    public static function getWirelessRedstoneById($bdd,$idWirelessRedstone, $showUser = false) {
        if ($showUser) {
            $req = $bdd->prepare('SELECT wireless_redstone.*, joueurs.nom_joueur
            FROM wireless_redstone INNER JOIN joueurs ON wireless_redstone.id_joueur = joueurs.id_joueur
            WHERE id_wireless_redstone = :id_wireless_redstone');
        } else {
            $req = $bdd->prepare('SELECT wireless_redstone.id_wireless_redstone, wireless_redstone.date_reservation
            FROM wireless_redstone
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
        $req = $bdd->prepare('SELECT * FROM wireless_redstone WHERE id_joueur = :id_joueur');
        $req->execute(array(
            'id_joueur' => $idJoueur
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // recupere les wirelessredstones non reserver
    public static function getWirelessRedstonesNonReserver($bdd,$page,$nbParPage) {
        $req = $bdd->prepare('SELECT * FROM wireless_redstone WHERE id_joueur IS NULL ORDER BY id_wireless_redstone LIMIT :pagination, :nbParPage');
        $req->execute(array(
            'pagination' => $page*$nbParPage,
            'nbParPage' => $nbParPage
        ));
        $wirelessredstones = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $wirelessredstones;
    }

    // set un joueur et la date de la reservation
    public static function setWirelessRedstone($bdd,$idReserver,$idJoueur = null,$dateReservation = null) {
        $req = $bdd->prepare('UPDATE wireless_redstone SET id_joueur = :id_joueur, date_reservation = :date_reservation WHERE id_wireless_redstone = :id_wireless_redstone');
        $req->execute(array(
            'id_joueur' => $idJoueur,
            'date_reservation' => $dateReservation,
            'id_wireless_redstone' => $idReserver
        ));
        $req->closeCursor();
    }
}