<?php
class Mail
{
	private $reponseConnection;
	
	public function __construct($pseudo, $email, $bdd)
	{	
		$reponseConnection = $bdd->prepare('SELECT * FROM liste_users WHERE pseudo = :pseudo AND email = :email');
		$reponseConnection->execute(array(
			'email' => $email,
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