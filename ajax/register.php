<?php
$error['login'] = '';
$error['password'] = '';
$error['name'] = '';
$error['lastname'] = '';
$error['birthdate'] = '';
$error['email'] = '';
$error['address'] = '';
$error['phone'] = '';
$continue = true;

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

if(!isset($_POST['login']) || empty($_POST['login'])) {
    $error['login'] = 'Login non présent.';
    $continue = false;
}
if(!isset($_POST['password']) || empty($_POST['password'])) {
    $error['password'] = 'Mot de passe non présent.';
    $continue = false;
}

if($continue) {
    init($_POST, 'name');
    init($_POST, 'lastname');
    init($_POST, 'birthdate');
    init($_POST, 'address');
    init($_POST, 'phone');
}

echo json_encode($error);