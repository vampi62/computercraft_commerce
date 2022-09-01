<?php
class Boutique
{
	private $bdd;
	private $proprio;

	public function __construct($player, $bdd)
	{	
		$this->bdd = $bdd;
		$this->proprio = $player['id'];
	}
	
	public function getOffres()
	{
		$req = $this->bdd->query('SELECT * FROM liste_offres');
		$list_id = array();
		$list_id_adresse = array();
		$list_proprio = array();
		$list_prix = array();
		$list_nbr_dispo = array();
		$list_type = array();
		$list_livraison = array();
		$list_nom = array();
		$list_description = array();
		$list_statut = array();
		$list_last_update = array();

		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$adresse = ConvertTable::getIdAdresse($this->bdd,$donnees['id_adresse']);
			$list_id[] = $donnees['id'];
			$list_id_adresse[] = $adresse;
			$list_proprio[] = $listidplayer[$donnees['proprio']];
			$list_prix[] = $donnees['prix'];
			$list_nbr_dispo[] = $donnees['nbr_dispo'];
			$list_type[] = $donnees['type'];
			$list_livraison[] = $donnees['livraison'];
			$list_nom[] = $donnees['nom'];
			$list_description[] = $donnees['description'];
			$list_last_update[] = $donnees['last_update'];
		}
		$req->closeCursor();
   	 	return array($list_id,$list_id_adresse,$list_proprio,$list_prix,$list_nbr_dispo,$list_type,$list_livraison,$list_nom,$list_description,$list_last_update);
	}
	
	public function getnbrOffres()
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) FROM liste_offres WHERE proprio = :id');
		$req->execute(array(
			'id' => $this->proprio
		));
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	public function getOffresbyid($id)
	{
		$req = $this->bdd->prepare('SELECT * FROM liste_offres WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'proprio' => $this->proprio,
			'id' => $id
			));
		return $req->fetch(PDO::FETCH_ASSOC);
	}

	public function getOffresbyidachat($id)
	{
		$req = $this->bdd->prepare('SELECT * FROM liste_offres WHERE id = :id');
		$req->execute(array(
			'id' => $id
			));
		return $req->fetch(PDO::FETCH_ASSOC);
	}

	public function setNouvellesDonneesPrix($prix,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET prix = :prix WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'prix' => $prix,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesNbrDispo($nbr_dispo,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET nbr_dispo = :nbr_dispo WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'nbr_dispo' => $nbr_dispo,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesType($type,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET type = :type WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'type' => $type,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesLivraison($livraison,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET livraison = :livraison WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'livraison' => $livraison,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesNom($nom,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET nom = :nom WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'nom' => $nom,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesDescription($description,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET description = :description WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'description' => $description,
			'proprio' => $this->proprio,
			'id' => $id
			));
	}
	public function setNouvellesDonneesIdAdresse($idadresse,$id)
	{
		$req = $this->bdd->prepare('UPDATE liste_offres SET id_adresse = :id_adresse WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'id_adresse' => $idadresse,
			'proprio' => $this->proprio,
			'id' => $id
		));
	}
	public function setNouvellesDonneesLastUpdate($id)
	{
		$date = date("Y-m-d");
		$req = $this->bdd->prepare('UPDATE liste_offres SET last_update = :last_update WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'last_update' => $date,
			'proprio' => $this->proprio,
			'id' => $id
		));
	}
	public function setNouvellesOffre()
	{
		$date = date("Y-m-d");
		$req = $this->bdd->prepare('INSERT INTO liste_offres(proprio, last_update, prix, nbr_dispo, id_adresse, type, livraison, nom, description) VALUES(:proprio, :last_update, 0, 0, 0, 0, 0, "","")');
		$req->execute(array(
			'proprio' => $this->proprio,
			'last_update' => $date
			));
	}
}
?>
