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
	$path = array_reverse($path);
	
	for($i = 0; $i < count($path) - 1; $i++) {
		echo "<a class='ingrds_path' href=\"?R=Ingredients&C=".$path[$i]."\">".$path[$i]."</a> &#129094; ";
	}
	echo "<a class='ingrds_path ingrds_path_selected' href=\"?R=Ingredients&C=".$path[$i]."\">".$path[$i]."</a>";
	
?>
<br/><br/>


<ul>
<?php 
	$categorie = "Aliment";
	if(isset($_GET['C'])) $categorie = $_GET['C'];
	
	if(array_key_exists($categorie, $Hierarchie)) {
		if(array_key_exists('sous-categorie', $Hierarchie[$categorie])) {
		
			foreach($Hierarchie[$categorie]['sous-categorie'] as $key => $value) {
				echo "<li><a href=\"?R=Ingredients&C=".$value."\"><i class='fa fa-tint' aria-hidden='true'></i> ".$value."</a></li>\n";
			}
		}
		else {
			
			foreach($Recettes as $key => $recette) {
				foreach($recette['index'] as $ingredient) {
					if($ingredient == $categorie)
						echo "<li class='li_cocktail'><a href=\"?R=Cocktail&K=".$key."\"><i class='fa fa-glass' aria-hidden='true'></i> ".$recette['titre']."</a></li>\n";
				}
			}
		}
	}
	
?>
</ul>