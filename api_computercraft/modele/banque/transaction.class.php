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
		$list_transactions = array();
		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$transaction = array();
			$transaction['id'] = $donnees['id'];
			$transaction['id_commandes'] = $donnees['id_commandes'];
			$transaction['id_admin_exec'] = $listidplayer[$donnees['id_admin_exec']];
			$transaction['crediteur'] = $listidplayer[$donnees['crediteur']];
			$transaction['debiteur'] = $listidplayer[$donnees['debiteur']];
			$transaction['somme'] = $donnees['somme'];
			$transaction['type'] = $donnees['type'];
			$transaction['description'] = $donnees['description'];
			$transaction['statut'] = $donnees['statut'];
			$transaction['date'] = $donnees['date'];
			$transaction['heure'] = $donnees['heure'];
			if (empty($list_transactions))
			{
				$list_transactions = array(1 => $transaction);
			}
			else
			{
				$list_transactions[] = $transaction;
			}
		}
		$req->closeCursor();
   	 	return $list_transactions;
	}
	public function setTransaction($datatransaction)
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$req = $this->bdd->prepare('INSERT INTO transactions(id_commandes, id_admin_exec, debiteur, crediteur, somme, type, description, statut, date, heure) VALUES(:id_commandes, :id_admin_exec, :debiteur, :crediteur, :somme, :type, :description, :statut, :date, :heure)');
		$req->execute(array(
			'id_commandes' => $datatransaction["ref_commande"],
			'id_admin_exec' => $this->pseudo,
			'crediteur' => $datatransaction["crediteur"],
			'debiteur' => $datatransaction["debiteur"],
			'somme' => $datatransaction["somme"],
			'type' => $datatransaction["type"],
			'description' => $datatransaction["description"],
			'statut' => $datatransaction["statut"],
			'date' => $date,
			'heure' => $heure
		));
		return $this->bdd->lastInsertId();
	}
}
?>
