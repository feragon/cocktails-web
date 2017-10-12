<h1>Nos ingrédients</h1>
<hr>


<ul style="text-align: left; ">
<?php 
	$categorie = "Aliment";
	if(isset($_GET['C'])) $categorie = $_GET['C'];
	
	if(array_key_exists('sous-categorie', $Hierarchie[$categorie])) {
	
		foreach($Hierarchie[$categorie]['sous-categorie'] as $key => $value) {
			echo "<li><i class='fa fa-tint' aria-hidden='true'></i> <a href='?R=Ingredients&C=".$value."'>".$value."</a></li>\n";
		}
	}
	else {
		
		foreach($Recettes as $key => $recette) {
			foreach($recette['index'] as $ingredient) {
				if($ingredient == $categorie)
					echo "<li class='li_cocktail'><i class='fa fa-glass' aria-hidden='true'></i> <a href='?R=Cocktail&K=".$key."'>".$recette['titre']."</a></li>\n";
			}
		}
	}
	
?>
</ul>