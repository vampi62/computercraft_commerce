<?php
class Commande
{
	private $bdd;
	private $pseudo;
	private $role;
	private $_Serveur_;
	
	public function __construct($player, $bdd, $_Serveur_)
	{	
		$this->bdd = $bdd;
		$this->pseudo = $player['id'];
		$this->role = $player['role'];
		$this->_Serveur_ = $_Serveur_;
	}

	public function getCommandeBanque()
	{
		$req = $this->bdd->query('SELECT * FROM commandes WHERE statut = 2');
		$req = $req->fetch(PDO::FETCH_ASSOC);
		return $req;
	}
	public function getCommandeCommerce()
	{
		$req = $this->bdd->prepare('SELECT * FROM commandes WHERE expediteur = :expediteur');
		$req->execute(array(
			'expediteur' => $this->pseudo
		));
		
		$req = $this->rangeCommande($req);
		return $req;
	}
	public function getCommandeClient()
	{
		$req = $this->bdd->prepare('SELECT * FROM commandes WHERE recepteur = :recepteur');
		$req->execute(array(
			'recepteur' => $this->pseudo
		));
		
		$req = $this->rangeCommande($req);
		return $req;
	}

	public function setCommande($datatcommande)
	{
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		$suivie = $date . " " . $heure . " - " . $this->_Serveur_['statut_echange']['1'] . $this->_Serveur_['balise']['case_ligne_suite'];	
		$req = $this->bdd->prepare('INSERT INTO commandes(id_offre, id_transaction, expediteur, recepteur, nom_commande, quantite, somme, prix_unitaire, type, livraison, suivie, description, statut, date, heure) VALUES(:id_offre, 0, :expediteur, :recepteur, :nom_commande, :quantite, :somme, :prix_unitaire, :type, :livraison, :suivie, :description, :statut, :date, :heure)');
		$req->execute(array(
			'id_offre' => $datatcommande["ref_commande"],
			'expediteur' => $datatcommande["expediteur"],
			'recepteur' => $this->pseudo,
			'nom_commande' => $datatcommande["nom_commande"],
			'quantite' => $datatcommande["quantite"],
			'somme' => $datatcommande["somme"],
			'prix_unitaire' => $datatcommande["prix_unitaire"],
			'type' => $datatcommande["type"],
			'livraison' => $datatcommande["livraison"],
			'suivie' => $suivie,
			'description' => $datatcommande["description"],
			'statut' => 1,
			'date' => $date,
			'heure' => $heure
		));
	}

	public function setLinktansactionCommande($id,$id_transaction)
	{	
		$req = $this->bdd->prepare('UPDATE commandes SET id_transaction = :id_transaction WHERE id = :id');
		$req->execute(array(
			'id_transaction' => $id_transaction,
			'id' => $id
		));
	}

	public function setstatutCommande($id,$statut)
	{
		if ($this->checkPaternstatutCommande($id,$statut)) {
			$suivie = $this->getSuivieCommande($id) . date("d/m/Y H:i:s") . " - " . $this->_Serveur_['statut_echange'][$statut] . $this->_Serveur_['balise']['case_ligne_suite'];	
			$req = $this->bdd->prepare('UPDATE commandes SET statut = :statut, suivie = :suivie WHERE id = :id');
			$req->execute(array(
				'statut' => $statut,
				'suivie' => $suivie,
				'id' => $id
			));
			return true;
		} else {
			return false;
		}
	}


	private function rangeCommande($req)
	{
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
		$list_statut = array();
		$list_date = array();
		$list_heure = array();

		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$list_id[] = $donnees['id'];
			$list_id_offre[] = $donnees['id_offre'];
			$list_id_transaction[] = $donnees['id_transaction'];
			$list_nom_commande[] = $donnees['nom_commande'];
			$list_expediteur[] = $listidplayer[$donnees['expediteur']];
			$list_recepteur[] = $listidplayer[$donnees['recepteur']];
			$list_quantite[] = $donnees['quantite'];
			$list_somme[] = $donnees['somme'];
			$list_prix_unitaire[] = $donnees['prix_unitaire'];
			$list_type[] = $donnees['type'];
			$list_livraison[] = $donnees['livraison'];
			$list_suivie[] = $donnees['suivie'];
			$list_description[] = $donnees['description'];
			$list_statut[] = $donnees['statut'];
			$list_date[] = $donnees['date'];
			$list_heure[] = $donnees['heure'];
		}
		$req->closeCursor();
		return array($list_id,$list_id_offre,$list_id_transaction,$list_nom_commande,$list_expediteur,$list_recepteur,$list_quantite,$list_somme,$list_prix_unitaire,$list_type,$list_livraison,$list_suivie,$list_description,$list_statut,$list_date,$list_heure);
	}

	private function checkPaternstatutCommande($id,$statut)
	{
		$req = $this->bdd->prepare('SELECT statut, expediteur FROM commandes WHERE id = :id');
		$req->execute(array(
			'id' => $id
		));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		switch ($req['statut'])
		{
			case "1": // en attente de validation
				if ($this->pseudo == $req['expediteur']) {
					if ($statut == '2') // valider
					{
						return true;
					}
					elseif ($statut == '10') // refuser
					{
						return true;
					}
				}
			break;
			case "2": // paiement en attente
				if ($this->role == 2) {
					if ($statut == '3') // paiement valider
					{
						return true;
					}
					if ($statut == '11') // paiement refuser
					{
						return true;
					}
				}
			break;
			case "3": // paiement valider
				if ($this->pseudo == $req['expediteur']) {
					if ($statut == '4') // expedition en attente
					{
						return true;
					}
				}
			break;
			case "4": // expedition en attente
				if ($this->pseudo == $req['expediteur']) {
					if ($statut == '5') // expedition en cours
					{
						return true;
					}
				}
			break;
			case "5": // expedition en cours
				if ($this->pseudo == $req['expediteur']) {
					if ($statut == '6') // expedition terminer
					{
						return true;
					}
				}
			break;
			return false;
		}
	}

	private function getSuivieCommande($id)
	{
		$req = $this->bdd->prepare('SELECT suivie FROM commandes WHERE id = :id');
		$req->execute(array(
			'id' => $id
		));
		$user=$req->fetch();
		$req->closeCursor();
		return $user[0];
	}
}
?>
