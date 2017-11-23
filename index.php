<?php
    require("includes/Donnees.inc.php");
	require_once("includes/functions.inc.php");
	require_once('includes/user_functions.php');

	init();

    try {
        if(isset($_GET["R"])) {
            $template = getFichierTemplate($_GET['R']);
        }
        else {
            $template = getFichierTemplate('home');
        }
    }
    catch (Exception $e) {
        http_response_code(404);
        $template = __DIR__ . '/templates/404.inc.php';
    }

	require('templates/header.inc.php');
	
    include($template);
	
	require('templates/footer.inc.php');
?>