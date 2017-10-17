<?php
require __DIR__ . '/../includes/user_functions.php';

/**
 * Initialise une valeur à une chaine vide dans le tableau
 * @param $tableau array Tableau à traiter
 * @param $clef string Indice de la valeur
 */
function init($tableau, $clef) {
    if(!array_key_exists($clef, $tableau)) {
        $tableau[$clef] = '';
    }
}

init($_POST, 'login');
init($_POST, 'password');
init($_POST, 'name');
init($_POST, 'lastname');
init($_POST, 'birthdate');
init($_POST, 'email');
init($_POST, 'address');
init($_POST, 'phone');

$error = register(
    $_POST['login'],
    $_POST['password'],
    $_POST['name'],
    $_POST['lastname'],
    $_POST['gender'],
    $_POST['email'],
    $_POST['birthdate'],
    $_POST['address'],
    $_POST['phone']
);
echo json_encode($error);