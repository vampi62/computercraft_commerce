<?php
// get jetons
// get jeton/{id}
// set jeton/{id}/value
// set jeton/{id}/delete
// set jeton/add
class jetons
{
	private $bdd;
	private $id;
	
	private $reponseConnection;
	
	public function __construct($player, $bdd)
	{
		$this->bdd = $bdd;
		$this->id = $player;
	}

	public function getJetons()
	{
		$req = $this->bdd->query('SELECT joueurs.pseudo, jeton_banque.* FROM jeton_banque INNER JOIN joueurs ON joueurs.id_joueur = jeton_banque.id_jeton');
		$list_jetons = array();
		while ($donnees = $req->fetch())
		{
			$jeton = array();
			$jeton['pseudo'] = $donnees['pseudo'];
			$jeton['jeton1'] = $donnees['jeton1'];
			$jeton['jeton10'] = $donnees['jeton10'];
			$jeton['jeton100'] = $donnees['jeton100'];
			$jeton['jeton1k'] = $donnees['jeton1k'];
			$jeton['jeton10k'] = $donnees['jeton10k'];
			$jeton['last_update'] = $donnees['last_update'];
			$list_jetons[] = $jeton;
		}
		$req->closeCursor();
		return $list_jetons;
	}

	public function setInitJeton($jeton)
	{
		$date = date("Y-m-d H:i:s");
		$req = $this->bdd->prepare('INSERT INTO jeton_banque(jeton1, jeton10, jeton100, jeton1k, jeton10k, id_user, date, heure) VALUES(:jeton1, :jeton10, :jeton100, :jeton1k, :jeton10k, :id_user, :date, :heure)');
		$req->execute(array(
			'jeton1' => $jeton["1"],
			'jeton10' => $jeton["10"],
			'jeton100' => $jeton["100"],
			'jeton1k' => $jeton["1k"],
			'jeton10k' => $jeton["10k"],
			'id_user' => $this->id,
			'date' => $date
		));
	}

	public function setSyncJeton($jeton)
	{
		$date = date("Y-m-d H:i:s");
		$req = $this->bdd->prepare('UPDATE jeton_banque SET jeton1 = :jeton1, jeton10 = :jeton10, jeton100 = :jeton100, jeton1k = :jeton1k, jeton10k = :jeton10k, date = :date, heure = :heure WHERE id_user = :id_user');
		$req->execute(array(
			'jeton1' => intval($jeton["1"]),
			'jeton10' => intval($jeton["10"]),
			'jeton100' => intval($jeton["100"]),
			'jeton1k' => intval($jeton["1k"]),
			'jeton10k' => intval($jeton["10k"]),
			'id_user' => $this->id,
			'date' => $date
		));
	}
}
?>
