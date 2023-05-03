<?php
// classe permettant de récupérer / envoyer des données à la base.
class Base {
	private $bdd;
	// Le constructeur se connecte à la base, il est appellé à chaque chargement de page.
	public function __construct($_Serveur_) {	
		try {
			$bdd = new PDO('mysql:host=' .$_Serveur_['dbAdress'] .';charset=utf8;dbname=' .$_Serveur_['dbName'].';port=' .$_Serveur_['dbPort'], $_Serveur_['dbUser'], $_Serveur_['dbPassword']);
			
			//// Cette requette SQL permet d'encoder correctement tout ce qui rentre / sort de la base.
			//$bdd->exec("SET CHARACTER SET utf8");
			$this->bdd = $bdd;
		}
		catch (Exception $e) {
				die("db_error");
		}
	}
	
	// Ce mutateur enregistre un nouvel joueur dans la base de données, fonction appellée à chaque joueur s'enregistrant.
	public function getConnection() {
		return $this->bdd;
	}
}
?>