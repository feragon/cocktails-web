<?php
function afficherElementMenu($nom, $page, $icone, $actif = false) {
    echo '<li';
    if($actif) {
        echo ' class="selected"';
    }
    echo '>';

	echo '<a href="', $page, '"><i class="fa fa-', $icone, ' fa-fw"></i> ', $nom, '</a>';

    echo '</li>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Cocktails</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1de9b6">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_mobile.css">
	<link rel="stylesheet" href="resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
<header>
	<h1><a href=".">Cocktails</a></h1>
	<h3>Une sélection de cocktails pour vos soirées arrosées.</h3>
	<div id="bubbles_box"></div>
</header>

<nav id="menu">
	<div class="menu">
		<a href="#menu" class="open_menu"><i class="fa fa-bars"></i></a>
		<a href="#" class="close_menu"><i class="fa fa-times"></i></a>
	</div>
	<ul>
        <?php
        afficherElementMenu('Accueil', '.', 'home', !isset($_GET['R']));
        afficherElementMenu('Ingredients', '?R=Ingredients', 'tint', isset($_GET["R"]) && $_GET["R"] == "Ingredients");
        afficherElementMenu('Cocktails', '?R=Cocktails', 'glass', isset($_GET['R']) && preg_match("/^Cocktail[s]?$/", $_GET['R']));
        afficherElementMenu('Mes recettes préférées', '?R=MesRecettes', 'tint', isset($_GET["R"]) && $_GET["R"] == "MesRecettes");
        ?>
		<li class="separator">│</li>
        <?php
        afficherElementMenu(
            isset($_SESSION['login']) ? $_SESSION['login'] : 'Connexion',
			'?R=MonEspace',
			isset($_SESSION['login']) ? 'user-circle' : 'sign-in',
			isset($_GET["R"]) && $_GET["R"] == "MonEspace"
        )
        ?>
	</ul>
</nav>

