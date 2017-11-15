<?php
require_once(__DIR__ . '/../includes/functions.inc.php');
require_once(__DIR__ . '/../includes/user_functions.php');

$included = !(__FILE__ == get_included_files()[0]);

if(!$included) {
	init();
}

$error = array();
if(!isset($_POST['login'])) $error['login'] = "Login non défini";
if(!isset($_POST['password'])) $error['password'] = "Mot de passe non défini";

if(empty($error)) {
	try {
		if(verifyPassword($_POST['login'], $_POST['password'])) {
			$_SESSION['login'] = $_POST['login'];
			DBToSession();
			sessionToDB();
		}
		else $error['password'] = 'Mauvais mot de passe';
	}
	catch(Exception $e) {
		$error['login'] = $e->getMessage();
	}
}

if(!$included) {
	echo json_encode($error);
}