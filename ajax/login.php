<?php
require(__DIR__ . '/../includes/functions.inc.php');
require(__DIR__ . '/../includes/user_functions.php');
init();

$error = array();
if(!isset($_GET['login'])) $error['login'] = "Login non défini";
if(!isset($_GET['password'])) $error['password'] = "Mot de passe non défini";

if(!$error) {
	try {
		if(verifyPassword($_GET['login'], $_GET['password'])) {
			$_SESSION['login'] = $_GET['login'];
			DBToSession();
			sessionToDB();
		}
		else $error['password'] = 'Mauvais mot de passe';
	}
	catch(Exception $e) {
		$error['login'] = $e->getMessage();
	}
}

echo json_encode($error);
