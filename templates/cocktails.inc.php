<main>
    <h1>Nos cocktails</h1>
	
	<script type="text/javascript" src="js/recherche.js"></script>
	
	<form method="post" onsubmit="event.preventDefault();">
		<input type="text" id="recherche" placeholder="Rechercher..." autocomplete="off"/>
	</form>
	
<?php
	afficherCocktails($Recettes, false);
?>
</main>