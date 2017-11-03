<main>
    <h1>Mes recettes préférées</h1>
	<hr/>
	
<?php
        global $Recettes;

        if(!isset($_SESSION['Favoris'])) {
            $_SESSION['Favoris'] = array();
        }

        if(empty($_SESSION["Favoris"])) {
?>
	<p id="noResults"><i class='fa fa-star-o'></i> Vous n'avez pas encore de favoris...</p>
<?php
        }
        else {
?>
	<div class="boutonRond">
		<a onclick="cleanFavori()"><i class='fa fa-trash'></i> Supprimer toutes mes recettes</a>
	</div>
	<br/>
	
<?php
            afficherCocktails($_SESSION["Favoris"], true);
        }

?>
</main>