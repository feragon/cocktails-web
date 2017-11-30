<main>
    <h1>Nos cocktails</h1>
	<hr/>
	
	<script type="text/javascript" src="js/recherche.js"></script>
	
	<form method="post" onsubmit="event.preventDefault();">
		<input type="text" id="recherche" placeholder="Rechercher..." autocomplete="off"/>
	</form>
	<br/>
	
<?php
	afficherCocktails($Recettes, false);
?>
	
	<p id="noResults" class="hidden"><i class="fa fa-search"></i> Oups, aucun résultat ne correspond à votre recherche...</p>
	
</main>