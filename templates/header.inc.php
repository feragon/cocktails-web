<!DOCTYPE html>
<html>
<head>
	<title>Cocktails</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1de9b6">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style_mobile.css">
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
		<li <?php if(!isset($_GET["R"])) echo " class='selected'"; ?>>
			<a href="."><i class="fa fa-home"></i> Accueil</a>
		</li>
		<li <?php if(isset($_GET["R"])) if($_GET["R"] == "Ingredients") echo " class='selected'"; ?>>
			<a href="?R=Ingredients"><i class="fa fa-tint"></i> Ingrédients</a>
		</li>
		<li <?php if(isset($_GET["R"])) if($_GET["R"] == "Cocktails") echo " class='selected'"; ?>>
			<a href="?R=Cocktails"><i class="fa fa-glass"></i> Cocktails</a>
		</li>
		<li <?php if(isset($_GET["R"])) if($_GET["R"] == "MesRecettes") echo " class='selected'"; ?>>
			<a href="?R=MesRecettes"><i class="fa fa-star"></i> Mes recettes préférées</a>
		</li>
		<li class="separator">│</li>
		<li <?php if(isset($_GET["R"])) if($_GET["R"] == "MonEspace") echo " class='selected'"; ?>>
			<a href="?R=MonEspace"><i class="fa fa-user-circle"></i> Mon espace</a>
		</li>
	</ul>
</nav>