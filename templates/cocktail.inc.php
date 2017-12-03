<?php
if(!isset($_GET['K']) || !array_key_exists($_GET['K'], $Recettes)) {
    require(__DIR__ . '/404.inc.php');
    return;
}

require(__DIR__ . '/../ajax/favori.php');
$retirer = array_key_exists($_GET['K'], $_SESSION['Favoris']);
$ingrs = explode("|", $Recettes[$_GET['K']]['ingredients']);
$cocktail_prec = ($_GET['K'] > 0) ? $_GET['K']-1 : $_GET['K'];
$cocktail_suiv = ($_GET['K'] < count($Recettes)-1) ? $_GET['K']+1 : $_GET['K'];
?>
<main>
    <div class="cocktail_desc">
        <h1><?php echo $Recettes[$_GET['K']]['titre'] ?></h1>

        <a class="arrow" href="?R=Cocktail&K=<?php echo $cocktail_prec ?>"><i class='fa fa-arrow-circle-o-left'></i></a>
        <a class="arrow" href="?R=Cocktail&K=<?php echo $cocktail_suiv ?>"><i class='fa fa-arrow-circle-o-right'></i></a>

        <form id="formFavori" method="POST" onsubmit="event.preventDefault();">
            <?php
            if($retirer) {
                echo '<input type="hidden" name="remove" value="', $_GET['K'], '">';
            }
            else {
				echo '<input type="hidden" name="add" value="', $_GET['K'], '">';
            }
            ?>
            <button id="retirer" class="boutonRondPlein <?php echo $retirer ? '' : 'hidden'; ?>" type="submit" onclick="removeFavori(<?=$_GET['K']; ?>)">
                <span id="fav_recette_pref">
					<span class='fa fa-thumbs-up'></span> J'aime cette recette
				</span>
				<span id="fav_retirer_recette">
					<span class='fa fa-thumbs-down'></span> Je n'aime plus cette recette
				</span>
            </button>
            <button id="ajouter" class="boutonRond <?php echo $retirer ? 'hidden' : ''; ?>" type="submit" onclick="addFavori(<?=$_GET['K']; ?>)">
                <span class='fa fa-star'></span> Ajouter à mes recettes
            </button>
        </form>
		
        <?php
			$url = getImageURL($Recettes[$_GET['K']]["titre"], false);
			if(!empty($url)) {
				echo "<img src='" . $url . "' alt='cocktail_image' />";
			}
        ?>
        <br/>
		
        <h3>Ingrédients :</h3>
		<ul>
        <?php
            foreach($ingrs as $ing) {
                echo "<li><i class='fa fa-tint'></i><span>".$ing."</span></li>";
            }
        ?>
		</ul>
		
        <h3>Préparation :</h3>
        <p><?php echo $Recettes[$_GET['K']]['preparation'] ?></p>
    </div>
</main>