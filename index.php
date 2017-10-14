<?php
	require("includes/Donnees.inc.php");
	require("includes/functions.inc.php");

	init();

    if(isset($_GET["R"])) {
        require(getFichierTemplate($_GET['R']));
    }
    else {
        require(getFichierTemplate('home'));
    }