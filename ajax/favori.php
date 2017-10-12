<?php
session_start();

if(isset($_GET['remove'])) {
    unset($_SESSION['Favoris'][$_GET['remove']]);
    echo json_encode(['success' => true]);
}
else if(isset($_GET['add'])) {
    $_SESSION['Favoris'][$_GET['add']] = true;
    echo json_encode(['success' => true]);
}
else {
    echo json_encode(['success' => false]);
}