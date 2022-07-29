<?php
class Transaction
{
	private $bdd;
    private $pseudo;
	
    public function __construct($player, $bdd)
    {
		$this->bdd = $bdd;
		$this->pseudo = $player['id'];
	}
	
	public function getTransactionListe()
	{
		$req = $this->bdd->prepare('SELECT * FROM transactions WHERE crediteur = :player OR debiteur = :player');
		$req->execute(array(
			'player' => $this->pseudo
		));
		$list_id = array();
		$list_id_commandes = array();
		$list_crediteur = array();
		$list_debiteur = array();
		$list_somme = array();
		$list_type = array();
		$list_description = array();
		$list_statuts = array();
		$list_date = array();
		$list_heure = array();

		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$list_id[] = $donnees['id'];
			$list_id_commandes[] = $donnees['id_commandes'];
			$list_crediteur[] = $listidplayer[$donnees['crediteur']];
			$list_debiteur[] = $listidplayer[$donnees['debiteur']];
			$list_somme[] = $donnees['somme'];
			$list_type[] = $donnees['type'];
			$list_description[] = $donnees['description'];
			$list_statuts[] = $donnees['statuts'];
			$list_date[] = $donnees['date'];
			$list_heure[] = $donnees['heure'];
		}
		$req->closeCursor();
   	 	return array($list_id,$list_id_commandes,$list_crediteur,$list_debiteur,$list_somme,$list_type,$list_description,$list_statuts,$list_date,$list_heure);
	}
	public function setTransaction($datatransaction)
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$req = $this->bdd->prepare('INSERT INTO transactions(id_commandes, debiteur, crediteur, somme, type, description, statuts, date, heure) VALUES(:id_commandes, :debiteur, :crediteur, :somme, :type, :description, :statuts, :date, :heure)');
		$req->execute(array(
			'id_commandes' => $datatransaction["ref_commande"],
			'crediteur' => $datatransaction["crediteur"],
			'debiteur' => $datatransaction["debiteur"],
			'somme' => $datatransaction["somme"],
			'type' => $datatransaction["type"],
			'description' => $datatransaction["description"],
			'statuts' => $datatransaction["statuts"],
			'date' => $date,
			'heure' => $heure
		));
		return $this->bdd->lastInsertId();
	}
}
?>
