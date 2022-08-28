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
		for ($j=1; $j <= $lastid; $j++)
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
		$req = $bdd->prepare('SELECT nom,type,coo,description FROM liste_adresses WHERE id = :id');
		$req->execute(array(
			'id' => $id
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		if(empty($req))
		{
			$req = array();
			$req['nom'] = "";
			$req['type'] = "";
			$req['coo'] = "";
			$req['description'] = "";
		}
		return $req;
	}
	
	static public function offreUsedId($bdd,$id)
	{
		$req = $bdd->prepare('SELECT * FROM liste_offres WHERE id_adresse = :id');
		$req->execute(array(
			'id' => $id
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		if(empty($req))
		{
			return false; // si il n'y a pas d'offre qui utilise l'id adresse
		}
		return true;
	}
}
?>