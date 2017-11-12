<?php
	require("includes/Donnees.inc.php");
	require_once("includes/functions.inc.php");
	require_once('includes/user_functions.php');

	init();

	require('templates/header.inc.php');
	
    if(isset($_GET["R"])) 
		require(getFichierTemplate($_GET['R']));
    else 
		require(getFichierTemplate('home'));
	
	require('templates/footer.inc.php');
?>