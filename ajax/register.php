<?php
require_once(__DIR__ . '/../includes/functions.inc.php');
require_once(__DIR__ . '/../includes/user_functions.php');

$included = !(__FILE__ == get_included_files()[0]);

if(!$included) {
	init();
}

/**
 * Initialise une valeur à une chaine vide dans le tableau
 * @param $tableau array Tableau à traiter
 * @param $clef string Indice de la valeur
 */
function initCleTableau(&$tableau, $clef) {
    if(!array_key_exists($clef, $tableau)) {
        $tableau[$clef] = '';
    }
}

initCleTableau($_POST, 'login');
initCleTableau($_POST, 'password');
initCleTableau($_POST, 'gender');
initCleTableau($_POST, 'name');
initCleTableau($_POST, 'lastname');
initCleTableau($_POST, 'birthdate');
initCleTableau($_POST, 'email');
initCleTableau($_POST, 'address');
initCleTableau($_POST, 'postal');
initCleTableau($_POST, 'town');
initCleTableau($_POST, 'phone');
$update = isset($_POST['update']);

$error = register(
	($update) ? $_SESSION['login'] : trim($_POST['login']),
    trim($_POST['password']),
    trim($_POST['name']),
    trim($_POST['lastname']),
    trim($_POST['gender']),
    trim($_POST['email']),
    trim($_POST['birthdate']),
    trim($_POST['address']),
    trim($_POST['postal']),
    trim($_POST['town']),
    trim($_POST['phone']),
    $update
);

if(!$included) {
	echo json_encode($error);
}