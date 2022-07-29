<?php
class Mail
{
	private $reponseConnection;
	
    public function __construct($email, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT * FROM liste_users WHERE email = :email');
		$reponseConnection->execute(array(
			'email' => $email,
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