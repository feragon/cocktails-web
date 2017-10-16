<?php require(__DIR__ . '/header.inc.php'); ?>

<main>
    <h1>Mes recettes préférées</h1>
	
<?php
        global $Recettes;

        if(!isset($_SESSION['Favoris'])) {
            $_SESSION['Favoris'] = array();
        }

        if(empty($_SESSION["Favoris"])) {
?>
	<p style="text-align: center;"><i class='fa fa-star-o'></i> Vous n'avez pas encore de favoris...</p>
<?php
        }
        else {
?>
	<div>
		<a class="vider_favoris boutonRond" onclick="cleanFavori()"><i class='fa fa-trash'></i>&nbsp; Supprimer toutes mes recettes</a>
	</div>
	<br/><br/>
	
<?php
            afficherCocktails($_SESSION["Favoris"], true);
        }

?>
</main>

<?php require(__DIR__ . '/footer.inc.php'); ?>