<?php
	session_start();
	require("includes/Donnees.inc.php");
	
	function normaliserCaracteres($s) {
		$normalizeChars = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
			'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
			'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
			'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
			'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
			'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
			'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
		);
		return strtr($s, $normalizeChars);
	}
?>
<?php 
	
	if(!isset($_SESSION['Favoris'])) {
		$_SESSION['Favoris'] = array(3 => 3, 5 => 5); //TODO: virer l'interieur de l'array (debug)
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cocktails</title>
		<meta charset='utf-8'>
		<link rel="stylesheet" href="style.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lobster'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
		<script> //TODO
			function removeFavori($i) {
				unset($_SESSION['Favoris'][$i]);
			}
			function addFavori($i) {
				$_SESSION['Favoris'][$i] = $i;
			}
		</script>
	</head>
	
	<body>
		<header>
			<h1><a href=".">Cocktails</a></h1>
			<h3>Une sélection de cocktails pour vos soirées arrosées.</h3>
		</header>
		
		<nav>
			<ul>
				<li <?php if(!isset($_GET["R"])) echo "class='selected'"; ?>><a href="."><i class="fa fa-home" aria-hidden="true"></i> Accueil</a></li>
				<li <?php if(isset($_GET["R"])) if($_GET["R"] == "Ingredients") echo "class='selected'"; ?>><a href="?R=Ingredients"><i class="fa fa-tint" aria-hidden="true"></i> Ingrédients</a></li>
				<li <?php if(isset($_GET["R"])) if($_GET["R"] == "Cocktails") echo "class='selected'"; ?>><a href="?R=Cocktails"><i class="fa fa-glass" aria-hidden="true"></i> Cocktails</a></li>
				<li <?php if(isset($_GET["R"])) if($_GET["R"] == "MesRecettes") echo "class='selected'"; ?>><a href="?R=MesRecettes"><i class="fa fa-star" aria-hidden="true"></i> Mes recettes préférées</a></li>
				<li class="separator">│</li>
				<li <?php if(isset($_GET["R"])) if($_GET["R"] == "Connexion") echo "class='selected'"; ?>><a href="?R=Connexion"><i class="fa fa-user-circle" aria-hidden="true"></i> Connexion</a></li>
			</ul>
		</nav>
		
		<main>
<?php
			if(isset($_GET["R"])) {
				if($_GET["R"] == "Ingredients")
					require("includes/ingredients.inc.php");
				else if($_GET["R"] == "Cocktails")
					require("includes/cocktails.inc.php");
				else if($_GET["R"] == "MesRecettes")
					require("includes/mesrecettes.inc.php");
				else if($_GET["R"] == "Cocktail")
					require("includes/cocktail.inc.php");
				else
					require("includes/404.inc.php");
			}
			else
				require("includes/home.inc.php");
?>
		</main>
	</body>
</html>