<?php
	require("includes/Donnees.inc.php");
	require("includes/functions.inc.php");

	session_start();
	if(!array_key_exists('Favoris', $_SESSION)) {
		$_SESSION['Favoris'] = array();
	}

	require('templates/header.inc.php');
	
    if(isset($_GET["R"])) {
        require(getFichierTemplate($_GET['R']));
    }
    else {
        require(getFichierTemplate('home'));
    }
	
	require('templates/footer.inc.php');
?>