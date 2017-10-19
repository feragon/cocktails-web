<?php
require __DIR__ . '/../includes/functions.inc.php';
require __DIR__ . '/../includes/user_functions.php';

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

$error = register(
    trim($_POST['login']),
    trim($_POST['password']),
    trim($_POST['name']),
    trim($_POST['lastname']),
    trim($_POST['gender']),
    trim($_POST['email']),
    trim($_POST['birthdate']),
    trim($_POST['address']),
    trim($_POST['postal']),
    trim($_POST['town']),
    trim($_POST['phone'])
);
echo json_encode($error);