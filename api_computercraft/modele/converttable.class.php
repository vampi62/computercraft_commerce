<?php
class ConvertTable
{
	static public function gettableidplayer($bdd)
	{
		$req = $bdd->query('SELECT id, pseudo FROM liste_users');
		$list = array();
		$lastid = 0;
		while ($donnees = $req->fetch())
		{
			$list[$donnees['id']] = $donnees['pseudo'];
			if ($donnees['id'] > $lastid)
			{
				$lastid = $donnees['id'];
			}
		}
		for ($j=1; j <= $lastid; $j++)
		{
			if (empty($list[$j]))
			{
				$list[$j] = "_joueur_supprimer_";
			}

		}

		$req->closeCursor();
		return $list;
	}

	static public function getIdAdresse($bdd,$id)
	{
		$req = $bdd->prepare('SELECT * FROM liste_adresses WHERE id = :id');
		$req->execute(array(
			'proprio' => $proprio,
			'id' => $id
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		return $req;
	}
}
?>