<?php require(__DIR__ . '/header.inc.php'); ?>

<main>
    <div class="cocktail_desc">
        <h1><?php echo $Recettes[$_GET['K']]['titre'] ?></h1>

        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] > 0) ? $_GET['K']-1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-left'></i></a>
        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] < count($Recettes)-1) ? $_GET['K']+1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-right'></i></a>
<?php $retirer = array_key_exists($_GET['K'], $_SESSION['Favoris']); ?>

        <div id="retirer"<?php echo $retirer ? '' : ' class="hidden"'; ?>>
            <a class="retirer_favoris" onclick="removeFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i>  Retirer de mes recettes</a>
        </div>
        <div id="ajouter"<?php echo $retirer ? ' class="hidden"' : ''; ?>>
            <a class="favoris" onclick="addFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i>  Ajouter à mes recettes</a>
        </div>
		
        <img src="<?php echo getImageURL($Recettes[$_GET['K']]["titre"], false); ?>" />
        <br/><br/>
		
        <h3>Ingrédients :</h3>
<?php
            $ingrs = explode("|", $Recettes[$_GET['K']]['ingredients']);

            foreach($ingrs as $ing) {
                echo "
		<li><i class='fa fa-tint'></i> ".$ing."</li>";
            }
?>

		
        <h3>Préparation :</h3>
        <p><?php echo $Recettes[$_GET['K']]['preparation'] ?></p>
    </div>
</main>

<?php require(__DIR__ . '/footer.inc.php'); ?>