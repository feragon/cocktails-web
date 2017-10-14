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
	$db = getDB();
	$query = $db->query("
		INSERT INTO users(login, password, name, lastname, gender, email, birthdate, address, phone) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
	");

	$query->execute(array(
		$login,
		$password,
		$name,
		$lastname,
		$gender,
		$email,
		$birthdate,
		$address,
		$phone
	));
}