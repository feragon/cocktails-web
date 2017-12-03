<?php
addJS('recherche');
?>
<main>
    <h1>Nos cocktails</h1>
	<hr/>

	<form method="post">
		<input type="text" id="recherche" placeholder="Rechercher..." autocomplete="off"/>
	</form>
	<br/>
	
<?php
	afficherCocktails($Recettes, false);
?>
	
	<p id="noResults" class="hidden"><i class="fa fa-search"></i> Oups, aucun résultat ne correspond à votre recherche...</p>
	
</main>