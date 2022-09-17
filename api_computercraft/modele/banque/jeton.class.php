<?php
class Jeton
{
	private $bdd;
	private $banque_user_id;
	
	private $reponseConnection;
	
	public function __construct($player, $bdd)
	{	
		$reponseConnection = $bdd->prepare('SELECT * FROM jeton_banque WHERE id_user = :id_user');
		$reponseConnection->execute(array(
			'id_user' => $player['id'],
			));
		$reponseConnection = $reponseConnection->fetch(PDO::FETCH_ASSOC);
		$this->reponseConnection = $reponseConnection;
		$this->bdd = $bdd;
		$this->banque_user_id = $player['id'];

	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

	public function getJeton()
	{
		$req = $this->bdd->query('SELECT * FROM jeton_banque');
		$req = $this->rangejeton($req);
		return $req;
	}

	public function setInitJeton($jeton)
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$req = $this->bdd->prepare('INSERT INTO jeton_banque(jeton1, jeton10, jeton100, jeton1k, jeton10k, id_user, date, heure) VALUES(:jeton1, :jeton10, :jeton100, :jeton1k, :jeton10k, :id_user, :date, :heure)');
		$req->execute(array(
			'jeton1' => $jeton["1"],
			'jeton10' => $jeton["10"],
			'jeton100' => $jeton["100"],
			'jeton1k' => $jeton["1k"],
			'jeton10k' => $jeton["10k"],
			'id_user' => $this->banque_user_id,
			'date' => $date,
			'heure' => $heure
		));
	}

	public function setSyncJeton($jeton)
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$req = $this->bdd->prepare('UPDATE jeton_banque SET jeton1 = :jeton1, jeton10 = :jeton10, jeton100 = :jeton100, jeton1k = :jeton1k, jeton10k = :jeton10k, date = :date, heure = :heure WHERE id_user = :id_user');
		$req->execute(array(
			'jeton1' => intval($jeton["1"]),
			'jeton10' => intval($jeton["10"]),
			'jeton100' => intval($jeton["100"]),
			'jeton1k' => intval($jeton["1k"]),
			'jeton10k' => intval($jeton["10k"]),
			'id_user' => $this->banque_user_id,
			'date' => $date,
			'heure' => $heure
		));
	}

	private function rangejeton($req)
	{
		$list_jetons = array();
		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$jeton = array(1 => $listidplayer[$donnees['id_user']]);
			$jeton[] = $donnees['jeton1'];
			$jeton[] = $donnees['jeton10'];
			$jeton[] = $donnees['jeton100'];
			$jeton[] = $donnees['jeton1k'];
			$jeton[] = $donnees['jeton10k'];
			$jeton[] = $donnees['date'];
			$jeton[] = $donnees['heure'];
			if (empty($list_jetons))
			{
				$list_jetons = array(1 => $jeton);
			}
			else
			{
				$list_jetons[] = $jeton;
			}
		}
		$req->closeCursor();
		return $list_jetons;
	}
}
?>
