<?php
require(__DIR__ . '/../ajax/favori.php');
global $Recettes;
?>
<main>
    <h1>Mes recettes préférées</h1>
	<hr/>
	
<?php
        if(empty($_SESSION["Favoris"])) {
?>
	<p id="noResults"><i class='fa fa-star-o'></i> Vous n'avez pas encore de favoris...</p>
<?php
        }
        else {
?>
    <form method="POST" onsubmit="event.preventDefault();">
        <input type="hidden" name="removeAll"/>
        <button type="submit" class="boutonRond" onclick="cleanFavori()">
			<span class='fa fa-trash'></span> Supprimer toutes mes recettes
		</button>
    </form>
	<br/>
	
<?php
            afficherCocktails($_SESSION["Favoris"], true);
        }

?>
</main>