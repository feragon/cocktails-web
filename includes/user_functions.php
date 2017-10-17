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

    if(!empty($name) && !preg_match("#^[a-zA-Z]+$#", $name)) {
        $error['name'] = 'Prenom invalide';
        $continue = false;
    }

    if(!empty($lastname) && !preg_match("#^[a-zA-Z]+$#", $lastname)) {
        $error['lastname'] = 'Nom invalide';
        $continue = false;
    }

    if(!empty($birthdate) && !preg_match("#^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$#", $birthdate)) {
        $error['birthdate'] = 'Date de naissance invalide';
        $continue = false;
    }

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email invalide';
        $continue = false;
    }

    if(!empty($phone) && !preg_match("#\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})#", $phone)) {
        $error['phone'] = 'Numero de telephone invalide';
        $continue = false;
    }

    if(!$continue) {
        return $error;
    }

    $db = getDB();
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