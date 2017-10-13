<?php
	$url_photo = normaliserCaracteres($Recettes[$_GET['K']]["titre"]);
	$url_photo = ucfirst(strtolower($url_photo));
	$url_photo = "resources/photos/".strtr($url_photo, ' ', '_').".jpg";
?>

<div class="cocktail_desc">
	<img src="<?php echo file_exists($url_photo) ? $url_photo : ""; ?>" />
	<h1><?php echo $Recettes[$_GET['K']]['titre'] ?></h1>
	
	<a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] > 0) ? $_GET['K']-1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-left'></i></a>
	<a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] < count($Recettes)-1) ? $_GET['K']+1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-right'></i></a>
	
	<?php $retirer = array_key_exists($_GET['K'], $_SESSION['Favoris']); ?>
	
	<div id="retirer"<?php echo $retirer ? '' : ' class="hidden"'; ?>>
		<a class="retirer_favoris" onclick="removeFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i>  Retirer de mes recettes</a>
	</div>
	<div id="ajouter"<?php echo $retirer ? ' class="hidden"' : ''; ?>>
		<a class="favoris" onclick="addFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i>  Ajouter à mes recettes</a>
	</div>
	
	<br/><br/>
	<h3>Ingrédients :</h3>
	<?php 
		$ingrs = explode("|", $Recettes[$_GET['K']]['ingredients']);
		
		foreach($ingrs as $ing) {
			echo "<li><i class='fa fa-tint'></i> ".$ing."</li>\n";
		}
	?>

	<h3>Préparation :</h3>
	<p><?php echo $Recettes[$_GET['K']]['preparation'] ?></p>
</div>