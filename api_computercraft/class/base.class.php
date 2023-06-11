<?php
class Base {
	private $bdd;
	public function __construct($_Serveur_) {	
		try {
			$bdd = new PDO('mysql:host=' .$_Serveur_['dbAdress'] .';charset=utf8;dbname=' .$_Serveur_['dbName'].';port=' .$_Serveur_['dbPort'], $_Serveur_['dbUser'], $_Serveur_['dbPassword']);
			$this->bdd = $bdd;
		}
		catch (Exception $e) {
			die('Erreur : ' .$e->getMessage() .'<br />Veuillez contacter un administrateur');
		}
	}
	public function getConnection() {
		return $this->bdd;
	}
}
?>