<?php
class Adresse
{
    private $bdd;
    private $user_id;

    public function __construct($connexion,$user_id)
    {
        $this->bdd = $connexion;
        $this->user_id = $user_id;
    }

    public function getAdresses() {
        $req = $this->bdd->prepare('SELECT * FROM adresses WHERE user_id = :user_id');
        $req->execute(array(
            'user_id' => $this->user_id
        ));
        $adresses = $req->fetchAll();
        return $adresses;
    }

    public function getAdresse($id) {
        $req = $this->bdd->prepare('SELECT * FROM adresses WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'id' => $id,
            'user_id' => $this->user_id
        ));
        $adresse = $req->fetch();
        return $adresse;
    }

    public function setAdresseCoordonnees($id,$coo) {
        $req = $this->bdd->prepare('UPDATE adresses SET coo = :coo WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'coo' => $coo,
            'id' => $id,
            'user_id' => $this->user_id
        ));
    }

    public function setAdresseName($id,$name) {
        $req = $this->bdd->prepare('UPDATE adresses SET name = :name WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'name' => $name,
            'id' => $id,
            'user_id' => $this->user_id
        ));
    }

    public function setAdresseDescription($id,$description) {
        $req = $this->bdd->prepare('UPDATE adresses SET description = :description WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'description' => $description,
            'id' => $id,
            'user_id' => $this->user_id
        ));
    }

    public function setAdresseType($id,$type) {
        $req = $this->bdd->prepare('UPDATE adresses SET type = :type WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'type' => $type,
            'id' => $id,
            'user_id' => $this->user_id
        ));
    }

    public function setAdresseGroupeAdd($id,$groupe_id) {
        $req = $this->bdd->prepare('INSERT INTO adresses_groupe (adresse_id,groupe_id) VALUES (:adresse_id,:groupe_id)');
        $req->execute(array(
            'adresse_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public function setAdresseGroupeDelete($id,$groupe_id) {
        $req = $this->bdd->prepare('DELETE FROM adresses_groupe WHERE adresse_id = :adresse_id AND groupe_id = :groupe_id');
        $req->execute(array(
            'adresse_id' => $id,
            'groupe_id' => $groupe_id
        ));
    }

    public function setAdresseAdd($coo,$name,$description,$type) {
        $req = $this->bdd->prepare('INSERT INTO adresses (user_id,coo,name,description,type) VALUES (:user_id,:coo,:name,:description,:type)');
        $req->execute(array(
            'user_id' => $this->user_id,
            'coo' => $coo,
            'name' => $name,
            'description' => $description,
            'type' => $type
        ));
    }

    public function setAdresseDelete($id) {
        $req = $this->bdd->prepare('DELETE FROM adresses WHERE id = :id AND user_id = :user_id');
        $req->execute(array(
            'id' => $id,
            'user_id' => $this->user_id
        ));
    }
}
// get adresses
// get adresse/{id}
// set adresse/{id}/coo
// set adresse/{id}/name
// set adresse/{id}/description
// set adresse/{id}/type
// set adresse/{id}/groupe/{id}/add
// set adresse/{id}/groupe/{id}/delete
// set adresse/add
// set adresse/{id}/delete