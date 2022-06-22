<?php
function create_user($bdd,$new_player,$mdp,$mail)
{
	$req = $bdd->prepare('SELECT * FROM liste_users WHERE pseudo = :pseudo OR mail = :mail');
    $req->execute(array(
        'pseudo' => $new_player,
        'mail' => $mail
    ));
	$user=$req->fetch();
	$req->closeCursor();
    if (!$user)
    {
		$api_key_commerce = gen_api_key();
		$req = $bdd->prepare('INSERT INTO liste_users(pseudo, mdp, api_key_commerce, mail, compte, emprunt, nbr_offre, nbr_abo, role) VALUES(:player, :mdp, :api_key_commerce, :mail, 0, 0, 0, 0, \'client\')');
		$req->execute(array(
			'player' => $new_player,
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'api_key_commerce' => $api_key_commerce,
			'mail' => $mail
		));
        return "0";
    }
    else
    {
        return "5";
    }
}
function connect_user($bdd,$player,$mdp,$mod_api)
{
    $req = $bdd->prepare('SELECT * FROM liste_users WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $player
    ));
    while ($donnees = $req->fetch())
	{
		$id = $donnees['id'];
		$pseudo = $donnees['pseudo'];
		$db_mdp = $donnees['mdp'];
		$api_key_commerce = $donnees['api_key_commerce'];
		$compte = $donnees['compte'];
		$emprunt = $donnees['emprunt'];
		$nbr_offre = $donnees['nbr_offre'];
		$nbr_abo = $donnees['nbr_abo'];
		$role = $donnees['role'];
    }
	$req->closeCursor();
	if (!$mod_api)
	{
		if (password_hash($mdp, PASSWORD_DEFAULT) == $db_mdp)
		{
			return array("login"=>true,"api_access"=>false,"id"=>$id,"pseudo"=>$pseudo,"role"=>$role,"nbr_offre"=>$nbr_offre,"nbr_abo"=>$nbr_abo,"emprunt"=>$emprunt,"compte"=>$compte,"api_key_commerce"=>$api_key_commerce);
		}
		else
		{
			return array("login"=>false,"api_access"=>false,"pseudo"=>$player);
		}
	}
	else
	{
		if ($mdp == $api_key_commerce)
		{
			return array("login"=>true,"api_access"=>true,"id"=>$id,"pseudo"=>$pseudo,"role"=>$role,"nbr_offre"=>$nbr_offre,"nbr_abo"=>$nbr_abo,"emprunt"=>$emprunt,"compte"=>$compte,"api_key_commerce"=>$api_key_commerce);
		}
		else
		{
			return array("login"=>false,"api_access"=>true,"pseudo"=>$player);
		}
	}
}
function update_user($bdd,$session,$new_mdp,$new_mail)
{
	if ($new_mdp)
	{
		$req = $bdd->prepare('UPDATE liste_users SET mdp = :mdp WHERE id = :id');
		$req->execute(array(
			'mdp' => $new_mdp,
			'id' => $session["id"]
		));
	}
	
	if ($new_mail)
	{
		$req = $bdd->prepare('UPDATE liste_users SET mail = :mail WHERE id = :id');
		$req->execute(array(
			'mail' => $new_mail,
			'id' => $session["id"]
		));
	}
	return "0";
}
function list_offre($bdd,$player,$type,$livraison,$nom)
{
	if ($player)
	{
		$player = convert_player_to_id($bdd,$player);
	}
	$list_id = array();
	$list_proprio = array();
	$list_prix = array();
	$list_nbr_dispo = array();
	$list_type = array();
	$list_livraison = array();
	$list_nom = array();
	$list_description = array();
	$list_statuts = array();
	$req = $bdd->query('SELECT * FROM liste_offres');
	while ($donnees = $req->fetch())
	{
		$filtre = false;
		if ($player)
		{
			if ($player != $donnees['proprio'])
			{
				$filtre = true;
			}
		}
		if ($type)
		{
			if ($type != $donnees['type'])
			{
				$filtre = true;
			}
		}
		if ($livraison)
		{
			if ($livraison != $donnees['livraison'])
			{
				$filtre = true;
			}
		}
		if ($nom)
		{
			if ($nom != $donnees['nom'])
			{
				$filtre = true;
			}
		}
		if (!$filtre)
		{
			$list_id[] = $donnees['id'];
			$list_proprio[] = convert_id_to_player($bdd,$donnees['proprio']);
			$list_prix[] = $donnees['prix'];
			$list_nbr_dispo[] = $donnees['nbr_dispo'];
			$list_type[] = $donnees['type'];
			$list_livraison[] = $donnees['livraison'];
			$list_nom[] = $donnees['nom'];
			$list_description[] = $donnees['description'];
			$list_statuts[] = $donnees['statuts'];
		}
	}
	$req->closeCursor();
    return array($list_id,$list_proprio,$list_prix,$list_nbr_dispo,$list_type,$list_livraison,$list_nom,$list_description,$list_statuts);
}
function update_offre($bdd,$session,$id,$prix,$nbr_dispo,$type,$livraison,$nom,$description,$statuts)
{
	$query = "";
	if ($prix)
	{
		if ($prix > 0)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "prix = " . $prix;
		}
		else
		{
			return "21";
		}
	}
	if ($nbr_dispo)
	{
		if ($nbr_dispo > 0)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "nbr_dispo = " . $nbr_dispo;
		}
		else
		{
			return "22";
		}
	}
	if (!$session["api_access"])
	{
		if ($type)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "type = " . $type;
		}
		if ($livraison)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "livraison = " . $livraison;
		}
		if ($nom)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "nom = " . $nom;
		}
		if ($description)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "description = " . $description;
		}
		if ($statuts)
		{
			if ($query != "")
			{
				$query .= " AND ";
			}
			$query .= "statuts = " . $statuts;
		}
	}
	$query = "UPDATE liste_offres SET " . $query . " WHERE proprio = " . $session["id"] . " AND id = " . $id;
	$req = $bdd->prepare($query);
	$req->execute();
	return "0";
}
function achat($bdd,$session,$ref_commande,$quantite)
{
	$req = $bdd->prepare('SELECT * FROM liste_offres WHERE id = :id');
	$req->execute(array(
        'id' => $ref_commande
	));
	$donnees = $req->fetch();
	$nom_commande = $donnees['nom'];
	$expediteur = $donnees['proprio'];
	$unitaire = $donnees['prix'];
	$type = $donnees['type'];
	$livraison = $donnees['livraison'];
	$suivie = next_suivie("achat");
	$description = $donnees['description'];
	$list_nbr_dispo = $donnees['nbr_dispo'];
	$req->closeCursor();
	$somme = $quantite * $unitaire;
	if ($list_nbr_dispo < $quantite)
	{
		return "15";
	}
	if (0 >= $quantite)
	{
		return "22";
	}
	if ($session["compte"] < $somme)
	{
		return "13";
	}
	$req = $bdd->prepare('INSERT INTO commandes(id_offre, id_transaction, expediteur, recepteur, nom_commande, quantite, somme, prix_unitaire, type, livraison, suivie, description, statuts) VALUES(:id_offre, 0, :expediteur, :recepteur, :nom_commande, :quantite, :somme, :prix_unitaire, :type, :livraison, :suivie, :description, :statuts)');
	$req->execute(array(
        'id_offre' => $ref_commande,
        'expediteur' => $expediteur,
        'recepteur' => $session["id"],
        'nom_commande' => $nom_commande,
        'quantite' => $quantite,
        'somme' => $somme,
        'prix_unitaire' => $unitaire,
        'type' => $type,
        'livraison' => $livraison,
        'suivie' => $suivie,
        'description' => $description,
        'statuts' => $_Serveur_['statuts_echange']['1']
	));
	return "0";
}
function list_commande($bdd,$session)
{
	if ($session["api_access"])
	{
		if ($session["role"] == $_Serveur_['role']['banque'])
		{
			$req = $bdd->prepare('SELECT * FROM commandes WHERE statuts = :statuts');
			$req->execute(array(
				'statuts' => $_Serveur_['statuts_echange']['2'],
				'statuts_pret' => $_Serveur_['statuts_echange']['4'],
				'statuts_l_en_cours' => $_Serveur_['statuts_echange']['5']
			));
		}
		else
		{
			$req = $bdd->prepare('SELECT * FROM commandes WHERE expediteur = :expediteur AND (statuts = :statuts_valide OR statuts = :statuts_paie OR statuts = :statuts_pret OR statuts = :statuts_l_en_cours)');
			$req->execute(array(
				'expediteur' => $session["id"],
				'statuts_valide' => $_Serveur_['statuts_echange']['1'],
				'statuts_paie' => $_Serveur_['statuts_echange']['3'],
				'statuts_pret' => $_Serveur_['statuts_echange']['4'],
				'statuts_l_en_cours' => $_Serveur_['statuts_echange']['5']
			));
		}
	}
	else
	{
		$req = $bdd->prepare('SELECT * FROM commandes WHERE recepteur = :recepteur');
		$req->execute(array(
			'recepteur' => $session["id"]
		));
	}
	
	$list_id = array();
	$list_id_offre = array();
	$list_id_transaction = array();
	$list_nom_commande = array();
	$list_expediteur = array();
	$list_recepteur = array();
	$list_quantite = array();
	$list_somme = array();
	$list_prix_unitaire = array();
	$list_type = array();
	$list_livraison = array();
	$list_suivie = array();
	$list_description = array();
	$list_statuts = array();
	while ($donnees = $req->fetch())
	{
		$list_id[] = $donnees['id'];
		$list_id_offre[] = $donnees['id_offre'];
		$list_id_transaction[] = $donnees['id_transaction'];
		$list_nom_commande[] = $donnees['nom_commande'];
		$list_expediteur[] = convert_id_to_player($bdd,$donnees['expediteur']);
		$list_recepteur[] = convert_id_to_player($bdd,$donnees['recepteur']);
		$list_quantite[] = $donnees['quantite'];
		$list_somme[] = $donnees['somme'];
		$list_prix_unitaire[] = $donnees['prix_unitaire'];
		$list_type[] = $donnees['type'];
		$list_livraison[] = $donnees['livraison'];
		$list_suivie[] = $donnees['suivie'];
		$list_description[] = $donnees['description'];
		$list_statuts[] = $donnees['statuts'];
	}
	$req->closeCursor();
    return array($list_id,$list_id_offre,$list_id_transaction,$list_nom_commande,$list_expediteur,$list_recepteur,$list_quantite,$list_somme,$list_prix_unitaire,$list_type,$list_livraison,$list_suivie,$list_description,$list_statuts);
}
function edit_commande_statuts_commerce($bdd,$session,$id,$statuts)
{
	$verif_edit = false;
	$statuts_commande = get_statuts_commande($bdd,$id);
    if ($statuts_commande == $_Serveur_['statuts_echange']['1'])
	{
		if ($statuts == $_Serveur_['statuts_echange']['2'])
		{
			$verif_edit = true;
		}
		elseif ($statuts == $_Serveur_['statuts_echange']['10'])
		{
			$verif_edit = true;
		}
	}
    elseif ($statuts_commande == $_Serveur_['statuts_echange']['3'])
	{
		if ($statuts == $_Serveur_['statuts_echange']['2'])
		{
			$verif_edit = true;
		}
	}
    elseif ($statuts_commande == $_Serveur_['statuts_echange']['4'])
	{
		if ($statuts == $_Serveur_['statuts_echange']['2'])
		{
			$verif_edit = true;
		}
	}
    elseif ($statuts_commande == $_Serveur_['statuts_echange']['5'])
	{
		if ($statuts == $_Serveur_['statuts_echange']['2'])
		{
			$verif_edit = true;
		}
	}

	if ($verif_edit)
	{
		$suivie_db = get_suivie_commande($bdd,$id);
		$suivie = $suivie_db . next_suivie($statuts);
		$req = $bdd->prepare('UPDATE commandes SET statuts = :statuts, suivie = :suivie WHERE id = :id AND expediteur = :expediteur');
		$req->execute(array(
			'statuts' => $statuts,
			'suivie' => $suivie,
			'expediteur' => $session["id"],
			'id' => $id
		));
		return "0";
	}
	else
	{
		return "11";
	}
}
function list_transaction($bdd,$session)
{
    $req = $bdd->prepare('SELECT * FROM transactions WHERE expediteur = :expediteur OR recepteur = :recepteur');
    $req->execute(array(
        'expediteur' => $session["id"],
        'recepteur' => $session["id"]
    ));
	$list_id = array();
	$list_id_commandes = array();
	$list_expediteur = array();
	$list_recepteur = array();
	$list_somme = array();
	$list_type = array();
	$list_statuts = array();
	$list_description = array();
	$list_date = array();
	$list_heure = array();
	while ($donnees = $req->fetch())
	{
		$list_id[] = $donnees['id'];
		$list_id_commandes[] = $donnees['id_commandes'];
		$list_expediteur[] = convert_id_to_player($bdd,$donnees['expediteur']);
		$list_recepteur[] = convert_id_to_player($bdd,$donnees['recepteur']);
		$list_somme[] = $donnees['somme'];
		$list_type[] = $donnees['type'];
		$list_description[] = $donnees['description'];
		$list_statuts[] = $donnees['statuts'];
		$list_date[] = $donnees['date'];
		$list_heure[] = $donnees['heure'];
	}
	$req->closeCursor();
    return array($list_id,$list_id_commandes,$list_expediteur,$list_recepteur,$list_somme,$list_type,$list_description,$list_statuts,$list_date,$list_heure);
}
function transaction($bdd,$somme,$type,$description,$recepteur,$expediteur,$ref_commande)
{
	$date = date("Y-m-d");
	$heure = date("H:i:s");
	switch ($type)
	{
		case "transfert":
			$compte_expediteur = get_compte_player($bdd,$donnees['expediteur']);
			$compte_recepteur = get_compte_player($bdd,$donnees['recepteur']);
			$expediteur = convert_id_to_player($bdd,$donnees['expediteur']);
			$recepteur = convert_id_to_player($bdd,$donnees['recepteur']);
			$somme = $donnees['somme'];
			$description = $donnees['description'];
			if ($compte_recepteur["compte"] >= $somme)
			{
				$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
				$req->execute(array(
					'compte' => $compte_recepteur["compte"]-$somme,
					'id' => $compte_recepteur["id"]
				));
				$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
				$req->execute(array(
					'compte' => $compte_expediteur["compte"]+$somme,
					'id' => $compte_expediteur["id"]
				));
				$statuts = "transfert valider";
				$code_statuts = "0";
			}
			else
			{
				$statuts = "transfert refuser";
				$code_statuts = "13";
			}
			inscription_transaction($bdd,$expediteur,$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
			return $code_statuts;
		case "depot":
			$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
			$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
			$req->execute(array(
				'compte' => $compte_recepteur["compte"]+$somme,
				'id' => $compte_recepteur["id"]
			));
			$statuts = "depot de " . $somme . "realiser";
			inscription_transaction($bdd,$recepteur,$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
			return "0";
		case "retrait":
			$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
			if ($compte_recepteur["compte"] >= $somme)
			{
				$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
				$req->execute(array(
					'compte' => $compte_recepteur["compte"]-$somme,
					'id' => $compte_recepteur["id"]
				));
				$statuts = "retrait de " . $somme . "realiser";
				inscription_transaction($bdd,$recepteur,$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
				return "0";
			}
			return "13";
		case "emprunt":
			$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
			if ($compte_recepteur["emprunt"]+$somme <= $max_emprunt)
			{
				$req = $bdd->prepare('UPDATE liste_users SET emprunt = :emprunt WHERE id = :id');
				$req->execute(array(
					'emprunt' => $compte_recepteur["emprunt"]+$somme,
					'id' => $compte_recepteur["id"]
				));
				$statuts = "emprunt de " . $somme . " realiser";
				$code_statuts = "0";
			}
			else
			{
				if ($compte_recepteur["emprunt"] <= $max_emprunt)
				{
					$somme = $max_emprunt - $compte_recepteur["emprunt"];
					$req = $bdd->prepare('UPDATE liste_users SET emprunt = :emprunt WHERE id = :id');
					$req->execute(array(
						'emprunt' => $compte_recepteur["emprunt"]+$somme,
						'id' => $compte_recepteur["id"]
					));
					$statuts = "emprunt de " . $somme . " realiser";
					$code_statuts = "0";
				}
				else
				{
					$statuts = "plafond d'emprunt ateint";
					$code_statuts = "14";
				}
			}
			inscription_transaction($bdd,"banque",$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
			return $code_statuts;
		case "remboursement":
			$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
			if ($compte_recepteur["compte"] >= $somme)
			{
				if ($compte_recepteur["emprunt"] <= $somme)
				{
					$somme = $compte_recepteur["emprunt"];
				}
				$req = $bdd->prepare('UPDATE liste_users SET emprunt = :emprunt, compte = :compte WHERE id = :id');
				$req->execute(array(
					'emprunt' => $compte_recepteur["emprunt"]-$somme,
					'compte' => $compte_recepteur["compte"]-$somme,
					'id' => $compte_recepteur["id"]
				));
				$statuts = "remboursement emprunt de " . $somme . " realiser";
				inscription_transaction($bdd,$recepteur,"banque",$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
				return "0";
			}
			return "13";
		case "administratif":
			if ($ref_commande == "add_offre")
			{
				$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
				if ($compte_recepteur["nbr_offre"]+1 =< $max_offre)
                {
					if ($compte_recepteur["compte"] >= $somme)
					{
						$req = $bdd->prepare('UPDATE liste_users SET compte = :compte, nbr_offre = :nbr_offre WHERE id = :id');
						$req->execute(array(
							'compte' => $compte_recepteur["compte"]-$somme,
							'nbr_offre' => $compte_recepteur["nbr_offre"]+1,
							'id' => $compte_recepteur["id"]
						));
						$req = $bdd->prepare('INSERT INTO liste_offres(proprio, prix, nbr_dispo, type, livraison, nom, description, statuts) VALUES(:player, 0, 0, \'null\', \'null\', \'null\', \'null\', \'null\')');
						$req->execute(array(
							'player' => $compte_recepteur["id"]
						));
						$statuts = "paiement valider";
						$code_statuts = "0";
					}
					else
					{
						$statuts = "paiement refuser";
						$code_statuts = "13";
					}
					inscription_transaction($bdd,"banque",$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
				}
				else
				{
					$code_statuts = "10";
				}
				return $code_statuts;
			}
			if ($ref_commande == "add_abo")
			{
				$compte_recepteur = get_compte_player($bdd,convert_player_to_id($bdd,$recepteur));
				if ($compte_recepteur["nbr_abo"]+1 =< $max_abo)
                {
					if ($compte_recepteur["compte"] >= $somme)
					{
						$req = $bdd->prepare('UPDATE liste_users SET compte = :compte, nbr_abo = :nbr_abo WHERE id = :id');
						$req->execute(array(
							'compte' => $compte_recepteur["compte"]-$somme,
							'nbr_abo' => $compte_recepteur["nbr_abo"]+1,
							'id' => $compte_recepteur["id"]
						));
						$req = $bdd->prepare('INSERT INTO liste_offres(proprio, prix, plafond, nom, description, type, jour_intervale, statuts) VALUES(:player, 0, 0, \'null\', \'null\', \'null\', 0, \'null\')');
						$req->execute(array(
							'player' => $compte_recepteur["id"]
						));
						$statuts = "paiement valider";
						$code_statuts = "0";
					}
					else
					{
						$statuts = "paiement refuser";
						$code_statuts = "13";
					}
					inscription_transaction($bdd,"banque",$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande);
				}
				else
				{
					$code_statuts = "10";
				}
				return $code_statuts;
			}
	}
	return "6";
}

function init_jeton($bdd,$session,$jeton1,$jeton10,$jeton100,$jeton1k,$jeton10k)
{
	$date = date("Y-m-d");
	$heure = date("H:i:s");
	$req = $bdd->prepare('INSERT INTO jeton_banque(jeton1, jeton10, jeton100, jeton1k, jeton10k, id_user, date, heure) VALUES(:jeton1, :jeton10, :jeton100, :jeton1k, :jeton10k, :id_user, :date, :heure)');
	$req->execute(array(
		'jeton1' => $jeton1,
		'jeton10' => $jeton10,
		'jeton100' => $jeton100,
		'jeton1k' => $jeton1k,
		'jeton10k' => $jeton10k,
		'id_user' => $session["id"],
        'date' => $date,
        'heure' => $heure
	));
	return "0";
}
function sync_jeton($bdd,$session,$jeton10,$jeton100,$jeton1k,$jeton10k,$jeton100k)
{
	$date = date("Y-m-d");
	$heure = date("H:i:s");
	$req = $bdd->prepare('UPDATE jeton_banque SET jeton1 = :jeton1, jeton10 = :jeton10, jeton100 = :jeton100, jeton1k = :jeton1k, jeton10k = :jeton10k, date = :date, heure = :heure, WHERE id_user = :id_user');
	$req->execute(array(
		'jeton1' => $jeton1,
		'jeton10' => $jeton10,
		'jeton100' => $jeton100,
		'jeton1k' => $jeton1k,
		'jeton10k' => $jeton10k,
		'id_user' => $session["id"],
        'date' => $date,
        'heure' => $heure
	));
	return "0";
}




function next_suivie($statuts)
{
	return date("d/m/Y H:i:s") . " - " . $statuts . "-br-";
}
function gen_api_key()
{
	$alphabet = '4A1B81CD4EF8G3HI5JK5L6M7N7OP0QR9S3T6UVW02X9YZ2';
	$api_key_commerce = '';
	$alphaLength = strlen($alphabet) - 1;
	for ($i = 0; $i < 12; $i++)
	{
		$n = mt_rand(0, $alphaLength);
		$api_key_commerce .= $alphabet[$n];
	}
	return $api_key_commerce;
}
function inscription_transaction($bdd,$expediteur,$recepteur,$somme,$type,$description,$statuts,$date,$heure,$ref_commande)
{
    if ($ref_commande == "")
	{
		$ref_commande = "0";
	}
	$req = $bdd->prepare('INSERT INTO transactions(id_commandes, expediteur, recepteur, somme, type, description, statuts, date, heure) VALUES(:id_commandes, :expediteur, :recepteur, :somme, :type, :description, :statuts, :date, :heure)');
	$req->execute(array(
        'id_commandes' => $ref_commande,
        'expediteur' => convert_player_to_id($bdd,$expediteur),
        'recepteur' => convert_player_to_id($bdd,$recepteur),
        'somme' => $somme,
        'type' => $type,
        'description' => $description,
        'statuts' => $statuts,
        'date' => $date,
        'heure' => $heure
	));
	return $bdd->lastInsertId();
}
function edit_commande_statuts_banque($bdd,$id,$statuts,$id_transaction)
{
    $suivie_db = get_suivie_commande($bdd,$id);
	$suivie = $suivie_db . next_suivie($statuts);
	$req = $bdd->prepare('UPDATE commandes SET statuts = :statuts, suivie = :suivie, id_transaction = :id_transaction WHERE id = :id');
    $req->execute(array(
        'statuts' => $statuts,
        'suivie' => $suivie,
        'id_transaction' => $id_transaction,
        'id' => $id
    ));
}
function get_statuts_commande($bdd,$id)
{
    $req = $bdd->prepare('SELECT statuts FROM commandes WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
	$user=$req->fetch();
	$req->closeCursor();
    return $user[0];
}
function get_suivie_commande($bdd,$id)
{
    $req = $bdd->prepare('SELECT suivie FROM commandes WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
	$user=$req->fetch();
	$req->closeCursor();
    return $user[0];
}
function convert_player_to_id($bdd,$player)
{
    $req = $bdd->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $player
    ));
	$user=$req->fetch();
	$req->closeCursor();
    return $user[0];
}
function convert_id_to_player($bdd,$id)
{
    $req = $bdd->prepare('SELECT pseudo FROM liste_users WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
	$user=$req->fetch();
	$req->closeCursor();
    return $user[0];
}
function get_compte_player($bdd,$id)
{
    $req = $bdd->prepare('SELECT compte, emprunt, nbr_offre, nbr_abo FROM liste_users WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
	$user=$req->fetch();
	$req->closeCursor();
    return array("compte"=>$user["compte"],"emprunt"=>$user["emprunt"],"nbr_offre"=>$user["nbr_offre"],"nbr_abo"=>$user["nbr_abo"],"id"=>$id);
}
function printlog($bdd,$id_user,$action,$code_return,$para)
{
	$req = $bdd->prepare('INSERT INTO log(id_user, action, code_return, para, date, time) VALUES(:id_user, :action, :code_return, :para, :date, :heure)');
	$req->execute(array(
        'id_user' => $id_user,
        'action' => $action,
        'code_return' => $code_return,
        'para' => $para,
        'date' => date("Y-m-d"),
        'heure' => date("H:i:s")
	));
}
function banque_traitement_transaction_commerce($bdd,$ref_commande)
{
	$date = date("Y-m-d");
	$heure = date("H:i:s");
	$req = $bdd->prepare('SELECT * FROM commandes WHERE id = :id AND statuts = :statuts');
	$req->execute(array(
		'id' => $ref_commande,
		'statuts' => $_Serveur_['statuts_echange']['2']
	));
	$donnees = $req->fetch();
	$req->closeCursor();
	if (!$donnees)
	{
		$compte_expediteur = get_compte_player($bdd,$donnees['expediteur']);
		$compte_recepteur = get_compte_player($bdd,$donnees['recepteur']);
		$expediteur = convert_id_to_player($bdd,$donnees['expediteur']);
		$recepteur = convert_id_to_player($bdd,$donnees['recepteur']);
		$somme = $donnees['somme'];
		$description = $donnees['description'];
		if ($compte_recepteur["compte"] >= $somme)
		{
			$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
			$req->execute(array(
				'compte' => $compte_recepteur["compte"]-$somme,
				'id' => $compte_recepteur["id"]
			));
			$req = $bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
			$req->execute(array(
				'compte' => $compte_expediteur["compte"]+$somme,
				'id' => $compte_expediteur["id"]
			));
			$statuts = "paiement valider";
			$commerce_statuts = $_Serveur_['statuts_echange']['3'];
			$code_statuts = "0";
		}
		else
		{
			$statuts = "paiement refuser";
			$commerce_statuts = $_Serveur_['statuts_echange']['11'];
			$code_statuts = "13";
		}
		$id_transaction = inscription_transaction($bdd,$expediteur,$recepteur,$somme,"commerce",$description,$statuts,$date,$heure,$ref_commande);
		edit_commande_statuts_banque($bdd,$ref_commande,$commerce_statuts,$id_transaction);
		return $code_statuts;
	}
	return "1";
}