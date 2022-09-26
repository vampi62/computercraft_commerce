<?php
class checkToken
{
	private $bdd;
   
	public function __construct($pseudo, $token, $bdd)
	{   
		$reponseConnection = $bdd->prepare('SELECT * FROM liste_users WHERE resettoken = :token AND pseudo = :pseudo');
		$reponseConnection->execute(array(
			'token' => $token,
			'pseudo' => $pseudo
			));
		$reponseConnection = $reponseConnection->fetch(PDO::FETCH_ASSOC);
		$this->reponseConnection = $reponseConnection;
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
}
?>