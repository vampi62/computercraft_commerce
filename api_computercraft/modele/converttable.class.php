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
}
?>