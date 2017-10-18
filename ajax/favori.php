<?php
session_start();

require(__DIR__ . '/../includes/user_functions.php');
$db = getDB();

if(isset($_GET['remove'])) {
    unset($_SESSION['Favoris'][$_GET['remove']]);
    echo json_encode(['success' => true]);
}
else if(isset($_GET['add'])) {
    $_SESSION['Favoris'][$_GET['add']] = time();
    echo json_encode(['success' => true]);
}
else if(isset($_GET['removeAll'])) {
	$_SESSION['Favoris'] = array();
}
else {
    echo json_encode(['success' => false]);
}

if(isset($_SESSION['login']))
	sessionToDB();