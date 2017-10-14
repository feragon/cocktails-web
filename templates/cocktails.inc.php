<?php require(__DIR__ . '/header.inc.php'); ?>

<main>
    <h1>Nos cocktails</h1>
    <hr/>

<?php
	afficherCocktails($Recettes, false);
?>
</main>

<?php require(__DIR__ . '/footer.inc.php'); ?>
