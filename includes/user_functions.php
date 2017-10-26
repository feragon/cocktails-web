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

/**
 * Vérifie un login
 * @param $login string à vérifier
 * @return string Erreur ou '' s'il y en a pas
 */
function verifyLogin($login) {
    if(empty($login)) {
        return 'Login non présent.';
    }

    if(!preg_match("#^[a-zA-Z0-9]{3,30}$#", $login)) {
        return 'Le login doit contenir entre 3 et 30 lettres minuscules, majuscules ou chiffres';
    }

    $db = getDB();
    $query = $db->prepare("SELECT login FROM users WHERE login = ?");
    $query->execute(array($login));

    if($query->fetch(PDO::FETCH_ASSOC) !== false) {
        return 'Login déjà utilisé';
    }

    return '';
}

/**
 * Vérifie le mot de passe
 * @param $password string Mot de passe à vérifier
 * @return string Erreur ou '' s'il n'y en a pas
 */
function verifyNewPassword($password) {
    if(empty($password)) {
        return 'Mot de passe non présent.';
    }

    if(strlen($password) < 6 || strlen($password) > 64) {
        return 'Le mot de passe doit être compris entre 6 et 64 caractères';
    }

    return '';
}

/**
 * Vérifie un champ qui ne doit contenir que des lettres
 * @param $name string Nom du champ
 * @return string Erreur ou '' s'il n'y en a pas
 */
function verifyChampLettres($name) {
    if(!empty($name) && !preg_match("#^[a-zA-Z]+$#", normaliserCaracteres($name))) {
        return 'Le champ ne doit contenir que des lettres';
    }

    return '';
}

/**
 * Vérifie un champ qui ne doit contenir que des lettres
 * @param $name string Nom du champ
 * @return string Erreur ou '' s'il n'y en a pas
 */
function verifyGender($gender) {
    if(!empty($gender) && $gender != "Homme" && $gender != "Femme") {
        return 'Le genre doit être Homme ou Femme';
    }

    return '';
}

/**
 * Vérifie la date de naissance
 * @param $birthdate string Date de naissance, elle sera modifiée pour respecter le bon format
 * @return string Erreur ou '' s'il n'y en a pas
 */
function verifyBirthdate(&$birthdate) {
    if(empty($birthdate)) {
        return '';
    }

    $birthdate = strtr($birthdate, '/', '-');

    $time = strtotime($birthdate);

    if($time === false) {
        return 'Date de naissance invalide';
    }

    $birthdate = date("d/m/Y", $time);

    return '';
}

/**
 * Vérifie une adresse email
 * @param $email string Email à vérifier
 * @return string Erreur ou '' si le champ est valide
 */
function verifyEmail($email) {
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email invalide';
    }

    return '';
}

/**
 * Vérifie le numéro de téléphone
 * @param $phone string numéro de téléphone
 * @return string Erreur ou '' si le champ est valide
 */
function verifyPhone($phone) {
    if(!empty($phone) && !preg_match("#^[0-9]{10}$#", $phone)) {
        return 'Numero de telephone invalide';
    }

    return '';
}

/**
 * Vérifie le code postal
 * @param $postal string code postal à vérifier
 * @return string Erreur ou '' si le champ est valide
 */
function verifyPostal($postal) {
    if(!empty($postal) && !preg_match("#^[0-9]{5}$#", $postal)) {
        return 'Code postal invalide';
    }

    return '';
}

function register($login, $password, $name, $lastname, $gender, $email, $birthdate, $address, $postal, $town, $phone, $update = false) {
    
	if(!$update) {
		$error['login'] = verifyLogin($login);
		$error['password'] = verifyNewPassword($password);
	}
    $error['name'] = verifyChampLettres($name);
    $error['lastname'] = verifyChampLettres($lastname);
	$error['gender'] = verifyGender($gender);
    $error['birthdate'] = verifyBirthdate($birthdate);
    $error['email'] = verifyEmail($email);
    $error['phone'] = verifyPhone($phone);
    $error['postal'] = verifyPostal($postal);
    $error['town'] = verifyChampLettres($town);

    foreach ($error as $message) {
        if(!empty($message)) {
            return $error;
        }
    }

    $db = getDB();

	
    if($update) {
		
		$query = $db->prepare("
            UPDATE users 
            SET name = :name,
                lastname = :lastname,
                gender = :gender,
                email = :email,
                birthdate = :birthdate,
                address = :address,
                postal = :postal,
                town = :town,
                phone = :phone
            WHERE login = :login
        ");
		$query->execute(array(
			'name' => $name,
			'lastname' => $lastname,
			'gender' => $gender,
			'email' => $email,
			'birthdate' => $birthdate,
			'address' => $address,
			'postal' => $postal,
			'town' => $town,
			'phone' => $phone,
			'login' => $login
		));
    }
    else {
		
        $query = $db->prepare("
            INSERT INTO users(login, password, name, lastname, gender, email, birthdate, address, postal, town, phone) 
            VALUES(:login, :password, :name, :lastname, :gender, :email, :birthdate, :address, :postal, :town, :phone)
        ");
		$query->execute(array(
			'login' => $login,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'name' => $name,
			'lastname' => $lastname,
			'gender' => $gender,
			'email' => $email,
			'birthdate' => $birthdate,
			'address' => $address,
			'postal' => $postal,
			'town' => $town,
			'phone' => $phone
		));
    }

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