<?php
class Adresse
{
	private $bdd;
	private $pseudo;
	
	public function __construct($player, $bdd)
	{
		$this->bdd = $bdd;
		$this->pseudo = $player['id'];
	}

	public function getIdAdresse($nom)
	{
		$req = $bdd->prepare('SELECT id, type FROM liste_adresses WHERE proprio = :pseudo AND nom = :nom');
		$req->execute(array(
			'pseudo' => $this->pseudo,
			'nom' => $nom
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		return $req;
	}
	public function getAdresseListe()
	{
		$req = $this->bdd->prepare('SELECT * FROM liste_adresses WHERE proprio = :pseudo');
		$req->execute(array(
			'pseudo' => $this->pseudo
		));
		$list_nom = array();
		$list_type = array();
		$list_coo = array();
		$list_description = array();
		while ($donnees = $req->fetch())
		{
			$list_nom[] = $donnees['nom'];
			$list_type[] = $donnees['type'];
			$list_coo[] = $donnees['coo'];
			$list_description[] = $donnees['description'];
		}
		$req->closeCursor();
   	 	return array($list_nom,$list_type,$list_coo,$list_description);
	}
	public function setNouvellesDonneesNom($id,$nom)
	{
		$req = $this->bdd->prepare('UPDATE liste_adresses SET nom = :nom WHERE id = :id AND proprio = :proprio');
		$req->execute(array(
			'id' => $id,
			'nom' => $nom,
			'proprio' => $this->pseudo
		));
	}
	public function setNouvellesDonneesType($id,$type)
	{
		$req = $this->bdd->prepare('UPDATE liste_adresses SET type = :type WHERE id = :id AND proprio = :proprio');
		$req->execute(array(
			'id' => $id,
			'type' => $type,
			'proprio' => $this->pseudo
		));
	}
	public function setNouvellesDonneesCoo($id,$coo)
	{
		$req = $this->bdd->prepare('UPDATE liste_adresses SET coo = :coo WHERE id = :id AND proprio = :proprio');
		$req->execute(array(
			'id' => $id,
			'coo' => $coo,
			'proprio' => $this->pseudo
		));
	}
	public function setNouvellesDonneesDescription($id,$description)
	{
		$req = $this->bdd->prepare('UPDATE liste_adresses SET description = :description WHERE id = :id AND proprio = :proprio');
		$req->execute(array(
			'id' => $id,
			'description' => $description,
			'proprio' => $this->pseudo
		));
	}
	public function addAdresse($nom,$type,$coo,$description)
	{
		$req = $this->bdd->prepare('INSERT INTO liste_adresses(proprio, nom, type, coo, description) VALUES(:proprio, :nom, :type, :coo, :description)');
		$req->execute(array(
			'proprio' => $this->pseudo,
			'nom' => $nom,
			'type' => $type,
			'coo' => $coo,
			'description' => $ddescription
		));
	}
	public function deleteAdresse($id)
	{
		$req = $this->bdd->prepare('DELETE FROM liste_adresses WHERE proprio = :proprio AND id = :id');
		$req->execute(array(
			'proprio' => $this->pseudo,
			'id' => $id
		));
	}
}
?>
