<?php
	require("includes/Donnees.inc.php");
	require("includes/functions.inc.php");

	init();

	require('templates/header.inc.php');
	
    if(isset($_GET["R"])) 
		require(getFichierTemplate($_GET['R']));
    else 
		require(getFichierTemplate('home'));
	
	require('templates/footer.inc.php');
?>