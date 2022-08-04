<?php
error_reporting(0);
ini_set('display_errors', 1);
require_once('../modele/config/yml.class.php');
$configLecture = new Lire('../modele/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();

$installEtape = new Lire('app/data/install.yml');
$installEtape = $installEtape->GetTableau();
$installEtape = $installEtape['etape'];



if (isset($_Serveur_['DataBase']['dbAdress']) && !empty($_Serveur_['DataBase']['dbAdress'])) {
	$tablesretour = verifTables($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);
} else {
	echo 'Inconnues';
}
function verifyPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try {
		$sql = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBase . ';port=' . $port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		$req = $sql->query('SELECT @@GLOBAL.sql_mode AS sql_mode_global, @@SESSION.sql_mode AS sql_mode_session');
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if ((!isset($data['sql_mode_global']) || empty($data['sql_mode_global']) || strpos($data['sql_mode_global'], 'STRICT_ALL_TABLES') === FALSE) && (!isset($data['sql_mode_session']) || empty($data['sql_mode_session']) || strpos($data['sql_mode_session'], 'STRICT_ALL_TABLES') === FALSE) && (!isset($data['sql_mode_global']) || empty($data['sql_mode_global']) || strpos($data['sql_mode_global'], 'STRICT_TRANS_TABLES') === FALSE) && (!isset($data['sql_mode_session']) || empty($data['sql_mode_session']) || strpos($data['sql_mode_session'], 'STRICT_TRANS_TABLES') === FALSE)) {
			return true;
		} else {
			return '([GLOBAL.sql_mode: ' . $data['sql_mode_globall'] . '],[SESSION.sql_mode:' . $data['sql_mode_session'] . '])';
		}
	} catch (Exception $e) {
		return 3;
	}
}


function getPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try {
		$sql = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBase . ';port=' . $port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		return $sql;
	} catch (Exception $e) {
	}
}

function verifTables($hote, $nomBase, $utilisateur, $mdp, $port)
{
	$sql = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBase . ';port=' . $port, $utilisateur, $mdp);

	$req = $sql->prepare('SELECT COUNT(*) AS tables FROM information_schema.tables WHERE table_schema = :db AND TABLE_NAME LIKE "cmw_%"');
	$req->execute(array(
		'db' => $nomBase
	));
	$data = $req->fetch(PDO::FETCH_ASSOC);

	if (isset($data['tables'])) {
		echo $data['tables'];
		return true;
	} else {
		echo 'Inconnues';
	}
}
<?php

if (isset($_GET['action']) and $_GET['action'] == 'sql' and isset($_POST['hote']) and isset($_POST['nomBase']) and isset($_POST['utilisateur']) and isset($_POST['mdp']) and isset($_POST['port'])) {
	if (($testPDO = verifyPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port'])) === TRUE) {
		$sql = getPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']);
		
		$sql->exec(file_get_contents('install.sql'));

		$configLecture = new Lire('../modele/config/config.yml');
		$config = $configLecture->GetTableau();

		$config['DataBase']['dbAdress'] = $_POST['hote'];
		$config['DataBase']['dbName'] = $_POST['nomBase'];
		$config['DataBase']['dbUser'] = $_POST['utilisateur'];
		$config['DataBase']['dbPassword'] = $_POST['mdp'];
		$config['DataBase']['dbPort'] = $_POST['port'];

		$ecriture = new Ecrire('../modele/config/config.yml', $config);

		$installLecture = new Lire('app/data/install.yml');
		$installLecture = $installLecture->GetTableau();
		$installLecture['etape'] = 2;

		$ecriture = new Ecrire('app/data/install.yml', $installLecture);



	} else if ($testPDO == 3) {
		$erreur['type'] = 'pass';
	} else {
		$erreur['type'] = 'sql_mode';
		$erreur['data'] = $testPDO;
	}
}


	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 1;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);


	$sql = getPDO($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);

	$config = new Lire('../modele/config/config.yml');
	$config = $config->GetTableau();
	$config['installation'] = true;
	$ecriture = new Ecrire('../modele/config/config.yml', $config);

	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 4;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);

	header('Location: index.php');
}
?>
<?php
require_once ('app/plugins/chmod.php');
function SetHtpasswd() {
	$dir[0] = '../modele/.htpasswd';
	$dir[1] = '../controleur/.htpasswd';
	$dir[2] = '../theme/.htpasswd';
	$rand = md5(uniqid(rand(), true)); 

	for($i = 0; $i < count($dir); $i++)
	{
		$htaccess = fopen($dir[$i], 'r+');
		fseek($htaccess, 0);
		fputs($htaccess, 'cms:'. $rand);
	}
}

<?php
$config = new Lire('../modele/config/config.yml');
$config = $config->GetTableau();

$config['General']['url'] = $_POST['adresse'];
$config['General']['name'] = $_POST['nom'];
$config['General']['description'] = $_POST['description'];
$config['General']['ipTexte'] = $_POST['ipTexte'];
$config['General']['ip'] = $_POST['ip'];
$config['General']['port'] = $_POST['port'];

$config = new Ecrire('../modele/config/config.yml', $config);



$installLecture = new Lire('app/data/install.yml');
$installLecture = $installLecture->GetTableau();
$installLecture['etape'] = 3;

$ecriture = new Ecrire('app/data/install.yml', $installLecture);

header('Location: index.php');
?>

<?php

