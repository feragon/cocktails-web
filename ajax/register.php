<?php
require __DIR__ . '/../includes/user_functions.php';

/**
 * Initialise une valeur à une chaine vide dans le tableau
 * @param $tableau array Tableau à traiter
 * @param $clef string Indice de la valeur
 */
function init(&$tableau, $clef) {
    if(!array_key_exists($clef, $tableau)) {
        $tableau[$clef] = '';
    }
}

init($_POST, 'login');
init($_POST, 'password');
init($_POST, 'gender');
init($_POST, 'name');
init($_POST, 'lastname');
init($_POST, 'birthdate');
init($_POST, 'email');
init($_POST, 'address');
init($_POST, 'postal');
init($_POST, 'town');
init($_POST, 'phone');

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