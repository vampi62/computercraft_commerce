<?php
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
	$dir[0] = 'class/.htpasswd';
	$dir[1] = 'controleur/.htpasswd';
	$dir[2] = 'admin/.htpasswd';
	$dir[3] = 'init/.htpasswd';
	$rand = md5(uniqid(rand(), true));
	for($i = 0; $i < count($dir); $i++) {
		$htaccess = fopen($dir[$i], 'r+');
		fseek($htaccess, 0);
		fputs($htaccess, 'apimc:'. $rand);
	}
}
function SetAdmin($bdd, $pseudo_joueur, $mdp_joueur, $email_joueur) {
	echo "install";
	$req = $bdd->prepare('INSERT INTO joueurs(pseudo_joueur, mdp_joueur, email_joueur, last_login_joueur, id_type_role, max_offres_joueur) VALUES(:pseudo_joueur, :mdp_joueur, :email_joueur, :last_login_joueur, 2, 0)');
	$req->execute(array(
		'pseudo_joueur' => $pseudo_joueur,
		'mdp_joueur' => password_hash($mdp_joueur, PASSWORD_DEFAULT),
		'last_login_joueur' => date("Y-m-d H:i:s"),
		'email_joueur' => $email_joueur
	));
	$req->closeCursor();
}