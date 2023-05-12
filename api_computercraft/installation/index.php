<?php
error_reporting(0);
ini_set('display_errors', 1);
require_once('../class/config/yml.class.php');
require_once('../class/checkdroits.class.php');
$configLecture = new Lire('../class/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();
if ($_Serveur_['Install'] != true) {
	if (isset($_Serveur_['DataBase']['dbAdress']) AND isset($_Serveur_['DataBase']['dbName']) AND isset($_Serveur_['DataBase']['dbUser']) AND isset($_Serveur_['DataBase']['dbPassword']) AND isset($_Serveur_['DataBase']['dbPort'])) {
		if(checkdroits::CheckArgs($_GET,array('pseudo','mdpconfirm','mdp','email'))) {
			$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
			$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
			$_GET['mdpconfirm'] = htmlspecialchars($_GET['mdpconfirm']);
			$_GET['email'] = htmlspecialchars($_GET['email']);
			if (preg_match('@[A-Z]@', $_GET['mdp']) AND preg_match('@[a-z]@', $_GET['mdp']) AND preg_match('@[0-9]@', $_GET['mdp']) AND strlen($_GET['mdp']) > 8) {
				if($_GET['mdp'] == $_GET['mdpconfirm']) {
					if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
						if ((verifyPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort'])) === TRUE) {
							$sql = getPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']);
							$sql->exec(file_get_contents('install.sql'));
							SetHtpasswd();
							SetAdmin($_GET['pseudo'], $_GET['mdp'], $_GET['email'], $sql);
							$_Serveur_['Install'] = true;
							$ecriture = new Ecrire('../class/config/config.yml', $_Serveur_);
							echo 'installation terminer vous pouvez supprimer le repertoire installation';
						} else {
							echo 'identifiant base de donnée incorect';
						}
					} else {
						echo 'email invalide';
					}
				} else {
					echo "le mot de passe n'est pas identique";
				}
			} else {
				echo 'le mot de passe ne respecte pas les regles de securite';
			}
		} else {
			echo 'il manque des parametres';
		}
	} else {
		echo 'fichier config incorrect';
	}
} else {
	echo 'déjà installer';
}
function verifyPDO($hote, $nomBase, $utilisateur, $mdp, $port) {
	try {
		$sql = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBase . ';port=' . $port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		$req = $sql->query('SELECT @@GLOBAL.sql_mode AS sql_mode_global, @@SESSION.sql_mode AS sql_mode_session');
		$data = $req->fetch(PDO::FETCH_ASSOC);
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function getPDO($hote, $nomBase, $utilisateur, $mdp, $port) {
	try {
		$sql = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBase . ';port=' . $port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		return $sql;
	} catch (Exception $e) {
	}
}
function SetHtpasswd() {
	$dir[0] = '../class/.htpasswd';
	$dir[1] = '../controleur/.htpasswd';
	$rand = md5(uniqid(rand(), true));
	for($i = 0; $i < count($dir); $i++) {
		$htaccess = fopen($dir[$i], 'r+');
		fseek($htaccess, 0);
		fputs($htaccess, 'apimc:'. $rand);
	}
}
function SetAdmin($pseudo, $mdp, $email, $bdd) {
	$date = date("Y-m-d");
	$req = $bdd->prepare('INSERT INTO joueurs(pseudo, mdp, email, last_login, id_table_select_role, max_offres) VALUES(:player, :mdp, :email, :last_login, 1, 0)');
	$req->execute(array(
		'player' => $pseudo,
		'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
		'last_login' => $date,
		'email' => $email
	));
	$req = $bdd->prepare('INSERT INTO groupes(nom, id_joueur) VALUES(:nom, :player_id)');
	$req->execute(array(
		'player_id' => 1,
		'nom' => "root"
	));
	$req = $bdd->prepare('INSERT INTO groupe_utilisateur(id_groupe, id_joueur) VALUES(:groupe_id, :player_id)');
	$req->execute(array(
		'groupe_id' => 1,
		'player_id' => 1
	));
	$req = $this->bdd->query('SELECT id_droit FROM list_droits WHERE groupe = 1');
	while ($donnees = $req->fetch()) {
		$jeton = array();
		$req2 = $bdd->prepare('INSERT INTO groupe_droits(id_droit, id_groupe, valeur) VALUES(:player, :mdp, 1)');
		$req2->execute(array(
			'id_droit' => $donnees['id_droit'],
			'id_groupe' => 1
		));
	}
	$req->closeCursor();
}