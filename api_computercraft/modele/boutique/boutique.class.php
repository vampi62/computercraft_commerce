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
		$list_proprio = array();
		$list_prix = array();
		$list_nbr_dispo = array();
		$list_type = array();
		$list_livraison = array();
		$list_nom = array();
		$list_description = array();
		$list_statut = array();

		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$list_id[] = $donnees['id'];
			$list_proprio[] = $listidplayer[$donnees['proprio']];
			$list_prix[] = $donnees['prix'];
			$list_nbr_dispo[] = $donnees['nbr_dispo'];
			$list_type[] = $donnees['type'];
			$list_livraison[] = $donnees['livraison'];
			$list_nom[] = $donnees['nom'];
			$list_description[] = $donnees['description'];
		}
		$req->closeCursor();
   	 	return array($list_id,$list_proprio,$list_prix,$list_nbr_dispo,$list_type,$list_livraison,$list_nom,$list_description);
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
	public function setNouvellesOffre()
	{
		$req = $this->bdd->prepare('INSERT INTO liste_offres(proprio, prix, nbr_dispo, type, livraison, nom, description) VALUES(:proprio, 0, 0, 0, 0, "","")');
		$req->execute(array(
			'proprio' => $this->proprio
			));
	}
}
?>
