			<h1>Mes recettes préférées</h1>
			<hr/>

<?php 
	global $Recettes;
	
	if(!isset($_SESSION['Favoris'])) {
		$_SESSION['Favoris'] = array();
	}
	
	if(empty($_SESSION["Favoris"])) { 
?>
			<p style="text-align: center;"><i class='fa fa-star-o'></i> Vous n'avez pas de favoris...</p>
<?php
	}
	else {
		afficherCocktails($_SESSION["Favoris"], true);
	}
	
?>