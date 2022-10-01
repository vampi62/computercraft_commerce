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
		$suivie = $date . " " . $heure . " - " . $this->_Serveur_['statut_echange']['1'] . $this->_Serveur_['General']['case_ligne_suite'];	
		$req = $this->bdd->prepare('INSERT INTO commandes(id_offre, id_transaction, expediteur, recepteur, text_adresse_expediteur, text_adresse_recepteur, nom_commande, quantite, somme, prix_unitaire, type, livraison, suivie, description, statut, date, heure) VALUES(:id_offre, 0, :expediteur, :recepteur, :text_adresse_expediteur, :text_adresse_recepteur, :nom_commande, :quantite, :somme, :prix_unitaire, :type, :livraison, :suivie, :description, :statut, :date, :heure)');
		$req->execute(array(
			'id_offre' => $datatcommande["ref_commande"],
			'expediteur' => $datatcommande["expediteur"],
			'recepteur' => $this->pseudo,
			'text_adresse_expediteur' => $datatcommande["text_adresse_expediteur"],
			'text_adresse_recepteur' => $datatcommande["text_adresse_recepteur"],
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

	public function setstatutCommande($id,$statut,$booltransaction)
	{
		if ($this->checkPaternstatutCommande($id,$statut,$booltransaction)) {
			$suivie = $this->getSuivieCommande($id) . date("d/m/Y H:i:s") . " - " . $this->_Serveur_['statut_echange'][$statut] . $this->_Serveur_['General']['case_ligne_suite'];	
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
		$list_commandes = array();
		$listidplayer = ConvertTable::gettableidplayer($this->bdd);
		while ($donnees = $req->fetch())
		{
			$commande = array();
			$commande['id'] = $donnees['id'];
			$commande['id_offre'] = $donnees['id_offre'];
			$commande['id_transaction'] = $donnees['id_transaction'];
			$commande['nom_commande'] = $donnees['nom_commande'];
			$commande['expediteur'] = $listidplayer[$donnees['expediteur']];
			$commande['recepteur'] = $listidplayer[$donnees['recepteur']];
			$commande['text_adresse_expediteur'] = $donnees['text_adresse_expediteur'];
			$commande['text_adresse_recepteur'] = $donnees['text_adresse_recepteur'];
			$commande['quantite'] = $donnees['quantite'];
			$commande['somme'] = $donnees['somme'];
			$commande['prix_unitaire'] = $donnees['prix_unitaire'];
			$commande['type'] = $donnees['type'];
			$commande['livraison'] = $donnees['livraison'];
			$commande['suivie'] = $donnees['suivie'];
			$commande['description'] = $donnees['description'];
			$commande['statut'] = $donnees['statut'];
			$commande['date'] = $donnees['date'];
			$commande['heure'] = $donnees['heure'];
			if (empty($list_commandes))
			{
				$list_commandes = array(1 => $commande);
			}
			else
			{
				$list_commandes[] = $commande;
			}
		}
		$req->closeCursor();
		return $list_commandes;
	}

	private function checkPaternstatutCommande($id,$statut,$booltransaction)
	{
		$req = $this->bdd->prepare('SELECT statut, expediteur, recepteur FROM commandes WHERE id = :id');
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
				if ($this->pseudo == $req['recepteur']) {
					if ($statut == '13') // commande annuler par le client
					{
						return true;
					}
				}
			break;
			case "2": // paiement en attente
				if (($this->role == 2) AND ($booltransaction)) {
					if ($statut == '3') // paiement valider
					{
						return true;
					}
					if ($statut == '11') // paiement refuser
					{
						return true;
					}
				}
				if ($this->pseudo == $req['recepteur']) {
					if ($statut == '13') // commande annuler par le client
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
				if ($this->pseudo == $req['recepteur']) {
					if ($statut >= '20' and $statut <= '24' ) // ouverture litige par le client
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
				if ($this->pseudo == $req['recepteur']) {
					if ($statut >= '20' and $statut <= '24' ) // ouverture litige par le client
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
				if ($this->pseudo == $req['recepteur']) {
					if ($statut >= '20' and $statut <= '24' ) // ouverture litige par le client
					{
						return true;
					}
				}
			case "6": // expedition en cours
				if ($this->pseudo == $req['recepteur']) {
					if ($statut == '7') // commande terminer - valider par le client
					{
						return true;
					}
					if ($statut >= '20' and $statut <= '24' ) // ouverture litige par le client
					{
						return true;
					}
				}
			case "20": // litige
			case "21": // litige
			case "22": // litige
			case "23": // litige
			case "24": // litige
				if ($this->role == 10) {
					if ($statut == '25') // litige terminer - valider par admin
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
