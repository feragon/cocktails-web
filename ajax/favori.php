<?php
require_once(__DIR__ . '/../includes/functions.inc.php');
require_once(__DIR__ . '/../includes/user_functions.php');
require_once(__DIR__ . '/../includes/Donnees.inc.php');

init();
$db = getDB();
$success = true;

if(isset($_POST['remove'])) {
    unset($_SESSION['Favoris'][$_POST['remove']]);
}
else if(isset($_POST['add']) && array_key_exists($_POST['add'], $Recettes)) {
    $_SESSION['Favoris'][$_POST['add']] = time();
}
else if(isset($_POST['removeAll'])) {
	$_SESSION['Favoris'] = array();
}
else {
    $success = false;
}

if(isset($_SESSION['login'])) {
	sessionToDB();
}

if(isset($_POST['ajax'])) {
	echo json_encode(['success' => true]);
}