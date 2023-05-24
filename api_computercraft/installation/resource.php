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
	$dir[0] = '../class/.htpasswd';
	$dir[1] = '../controleur/.htpasswd';
	$dir[2] = '../admin/.htpasswd';
	$rand = md5(uniqid(rand(), true));
	for($i = 0; $i < count($dir); $i++) {
		$htaccess = fopen($dir[$i], 'r+');
		fseek($htaccess, 0);
		fputs($htaccess, 'apimc:'. $rand);
	}
}
function SetAdmin($pseudo, $mdp, $email, $bdd) {
	$req = $bdd->prepare('INSERT INTO joueurs(pseudo, mdp, email, last_login, id_table_select_role, max_offres) VALUES(:player, :mdp, :email, :last_login, 1, 0)');
	$req->execute(array(
		'player' => $pseudo,
		'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
		'last_login' => date("Y-m-d H:i:s"),
		'email' => $email
	));
	$req->closeCursor();
}