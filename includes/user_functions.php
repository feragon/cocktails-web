<?php

function getDB() {
	global $db;

	if($db == null) {
		$db = new PDO('sqlite:' . __DIR__ . '/../db.sqlite'); //TODO: exception
	}

	return $db;
}

function verifyPassword($login, $password) {
	$db = getDB();
	$query = $db->prepare("SELECT password FROM users WHERE login = ?");
	$query->execute(array($login));

	$user = $query->fetch(PDO::FETCH_ASSOC);

	if($user === false) {
		throw new Exception("Utilisateur introuvable");
	}

	return password_verify($password, $user['password']);
}

function register($login, $password, $name, $lastname, $gender, $email, $birthdate, $address, $phone) {
    $error['login'] = '';
    $error['password'] = '';
    $error['name'] = '';
    $error['lastname'] = '';
    $error['birthdate'] = '';
    $error['email'] = '';
    $error['address'] = '';
    $error['phone'] = '';
    $continue = true;

    if(empty($login)) {
        $error['login'] = 'Login non présent.';
        $continue = false;
    }
    if(empty($password)) {
        $error['password'] = 'Mot de passe non présent.';
        $continue = false;
    }

    if(!$continue) {
        return $error;
    }

	$db = getDB();
	$query = $db->prepare("SELECT login FROM users WHERE login = ?");
	$query->execute(array($login));

	if($query->fetch(PDO::FETCH_ASSOC) !== false) {
		$error['login'] = 'Login déjà utilisé';
		$continue = false;
	}

    if(!empty($name) && !preg_match("#^[a-zA-Z]+$#", $name)) {
        $error['name'] = 'Prenom invalide';
        $continue = false;
    }

    if(!empty($lastname) && !preg_match("#^[a-zA-Z]+$#", $lastname)) {
        $error['lastname'] = 'Nom invalide';
        $continue = false;
    }

    $birthdate = strtr($birthdate, '/', '-');
	$birthdate_parts = explode('-', $birthdate);
    if(!empty($birthdate) && (count($birthdate_parts) != 3 || !checkdate($birthdate_parts[1], $birthdate_parts[0], $birthdate_parts[2]))) {
        $error['birthdate'] = 'Date de naissance invalide';
        $continue = false;
    }

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email invalide';
        $continue = false;
    }

    if(!empty($phone) && !preg_match("#^[0-9]{10}$#", $phone)) {
        $error['phone'] = 'Numero de telephone invalide';
        $continue = false;
    }

    if(!$continue) {
        return $error;
    }

	$query = $db->prepare("
		INSERT INTO users(login, password, name, lastname, gender, email, birthdate, address, phone) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
	");

	$query->execute(array(
		$login,
		password_hash($password, PASSWORD_DEFAULT),
		$name,
		$lastname,
		$gender,
		$email,
		$birthdate,
		$address,
		$phone
	));

	return $error;
}

function sessionToDB() {
	
	$text = "";
	
	if(!empty($_SESSION['Favoris'])) {
		foreach($_SESSION['Favoris'] as $key => $value) {
			$text.= $key.":".$value.",";
		}
	}
	
	$db = getDB();
	$query = $db->prepare("UPDATE users SET favs = ? WHERE login = ?;");
	$query->execute(array($text, $_SESSION['login']));
}

function DBToSession() {
	
	$db = getDB();
	$query = $db->prepare("SELECT favs FROM users WHERE login = ?;");
	$query->execute(array($_SESSION['login']));
	
	$favoris = $query->fetch(PDO::FETCH_ASSOC);
	
	$favs_tab = explode(",", $favoris['favs']);
	array_pop($favs_tab);
	
	foreach($favs_tab as $value) {
		$fav = explode(":", $value);
		$_SESSION['Favoris'] += array($fav[0] => $fav[1]);
	}
}