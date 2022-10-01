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
		$list_offres = array();
		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$adresse = ConvertTable::getIdAdresse($this->bdd,$donnees['id_adresse']);
			$offre = array();
			$offre['id'] = $donnees['id'];
			$offre['adresse'] = $adresse;
			$offre['id_adresse'] = $donnees['id_adresse'];
			$offre['proprio'] = $listidplayer[$donnees['proprio']];
			$offre['prix'] = $donnees['prix'];
			$offre['nbr_dispo'] = $donnees['nbr_dispo'];
			$offre['type'] = $donnees['type'];
			$offre['livraison'] = $donnees['livraison'];
			$offre['nom'] = $donnees['nom'];
			$offre['description'] = $donnees['description'];
			$offre['last_update'] = $donnees['last_update'];
			if ($this->proprio == $donnees['proprio'])
			{
				$offre['nbr_commande'] = $this->getnbrcommande($donnees['id']);
			}
			else
			{
				$offre['nbr_commande'] = 0;
			}
			if (empty($list_offres))
			{
				$list_offres = array(1 => $offre);
			}
			else
			{
				$list_offres[] = $offre;
			}
		}
		$req->closeCursor();
   	 	return $list_offres;
	}
	
	private function getnbrcommande($id_offre)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) FROM commandes WHERE expediteur = :expediteur AND id_offre = :id_offre AND statut < 6');
		$req->execute(array(
			'expediteur' => $this->proprio,
			'id_offre' => $id_offre
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		return $req["COUNT(id)"];
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
