<main>
    <h1>Nos ingrédients</h1>
	<hr/>

    <?php
	
	$step = isset($_GET['C']) ? $_GET['C'] : "Aliment";
	$path = array();
	
	while($step != "Aliment") {
		if(array_key_exists($step, $Hierarchie)) {
			array_push($path, $step);
			$step = $Hierarchie[$step]['super-categorie'][0];
		}
		else break;
	}
	array_push($path, $step);
	
	for($i = count($path)-1; $i > 0; $i--) {
		echo "<a class='ingrds_path' href=\"?R=Ingredients&C=".$path[$i]."\">".$path[$i]."</a>
	<i class='fa fa-arrow-right'></i>
	";
	}
	echo "<a class='ingrds_path ingrds_path_selected' href=\"?R=Ingredients&C=".$path[0]."\">".$path[0]."</a>
	";
	
?>

	<br/><br/>

    <ul class="liste_ingr"><?php
			
	$categorie = "Aliment";
	if(isset($_GET['C'])) $categorie = $_GET['C'];
	
	if(array_key_exists($categorie, $Hierarchie)) {
		if(array_key_exists('sous-categorie', $Hierarchie[$categorie])) {
		
			foreach($Hierarchie[$categorie]['sous-categorie'] as $key => $value) {
				echo "
		<li><a href=\"?R=Ingredients&C=".str_replace(" ", "%20", $value)."\"><i class='fa fa-tint fa-fw'></i> ".$value."</a></li>";
			}
			
			echo "
			<li class='flex-line-breaker'></li>";
		}
		
		foreach($Recettes as $key => $recette) {
			foreach($recette['index'] as $ingredient) {
				if($ingredient == $categorie)
					echo "
		<li class='li_cocktail'><a href=\"?R=Cocktail&K=".$key."\"><i class='fa fa-glass fa-fw'></i> ".$recette['titre']."</a></li>";
			}
		}
	}
	
?>

    </ul>
</main>