<main>
<?php
    global $error;
    $error = array();
    $isRegister = isset($_GET['register']);
    addJS('errors');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($isRegister) {
            require_once(__DIR__ . '/../ajax/user.php');
        }
        else {
            require(__DIR__ . '/../ajax/login.php');
        }
    }


	if(!isset($_SESSION['login'])) {
        require(__DIR__ . '/login.inc.php');
	}
	else {
        require(__DIR__ . '/dashboard.inc.php');
	}
?>
</main>