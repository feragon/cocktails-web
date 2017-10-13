<?php
	session_start();
	require("includes/Donnees.inc.php");
	require("includes/functions.inc.php");

	init();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cocktails</title>
		<meta charset='utf-8'>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<header>
			<h1><a href=".">Cocktails</a></h1>
			<h3>Une sélection de cocktails pour vos soirées arrosées.</h3>
			<div id="bubbles_box"></div>
		</header>
		
		<nav>
			<ul>
				<li<?php if(!isset($_GET["R"])) echo " class='selected'"; ?>><a href="."><i class="fa fa-home" aria-hidden="true"></i> Accueil</a></li>
				<li<?php if(isset($_GET["R"])) if($_GET["R"] == "Ingredients") echo " class='selected'"; ?>><a href="?R=Ingredients"><i class="fa fa-tint"></i> Ingrédients</a></li>
				<li<?php if(isset($_GET["R"])) if($_GET["R"] == "Cocktails") echo " class='selected'"; ?>><a href="?R=Cocktails"><i class="fa fa-glass"></i> Cocktails</a></li>
				<li<?php if(isset($_GET["R"])) if($_GET["R"] == "MesRecettes") echo " class='selected'"; ?>><a href="?R=MesRecettes"><i class="fa fa-star"></i> Mes recettes préférées</a></li>
				<li class="separator">│</li>
				<li<?php if(isset($_GET["R"])) if($_GET["R"] == "Connexion") echo " class='selected'"; ?>><a href="?R=Connexion"><i class="fa fa-user-circle"></i> Connexion</a></li>
			</ul>
		</nav>
		
		<main>
<?php
			if(isset($_GET["R"])) {
				require(getFichierTemplate($_GET['R']));
			}
			else
				require(__DIR__ . '/includes/home.inc.php');
?>
		</main>
		
		<footer>
			<h2>Cocktails</h2><p>&copy; ROMEO Florian <em>&amp;</em> WEBERT Chris</p>
		</footer>
	</body>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/favoris.js"></script>
	<script type="text/javascript" src="js/bubbles.js"></script>
</html>