<?php
require(__DIR__ . '/../ajax/favori.php');
$retirer = array_key_exists($_GET['K'], $_SESSION['Favoris']);
//TODO: si la recette n'existe pas ?
?>
<main>
    <div class="cocktail_desc">
        <h1><?php echo $Recettes[$_GET['K']]['titre'] ?></h1>

        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] > 0) ? $_GET['K']-1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-left'></i></a>
        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] < count($Recettes)-1) ? $_GET['K']+1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-right'></i></a>

        <form id="formFavori" method="POST" onsubmit="event.preventDefault();">
            <?php
            if($retirer) {
            ?>
                <input type="hidden" name="remove" value="<?=$_GET['K']?>">
            <?php
            }
            else {
            ?>
                <input type="hidden" name="add" value="<?=$_GET['K']?>">
            <?php
            }
            ?>
            <button id="retirer" class="boutonRondPlein <?php echo $retirer ? '' : 'hidden'; ?>" type="submit" onclick="removeFavori(<?=$_GET['K']; ?>)">
                <span id="fav_recette_pref">
					<span class='fa fa-star'></span> Dans mes favoris !
				</span>
				<span id="fav_retirer_recette">
					<span class='fa fa-star-o'></span> Retirer de mes recettes
				</span>
            </button>
            <button id="ajouter" class="boutonRond <?php echo $retirer ? 'hidden' : ''; ?>" type="submit" onclick="addFavori(<?=$_GET['K']; ?>)">
                <span class='fa fa-star'></span> Ajouter à mes recettes
            </button>
        </form>
		
<?php 
			$url = getImageURL($Recettes[$_GET['K']]["titre"], false);
			if(!empty($url))
				echo "
		<img src='" . $url . "' alt='cocktail_image' />";
?>
        <br/>
		
        <h3>Ingrédients :</h3>
		<ul>
<?php
            $ingrs = explode("|", $Recettes[$_GET['K']]['ingredients']);

            foreach($ingrs as $ing) {
                echo "
			<li><i class='fa fa-tint'></i> ".$ing."</li>";
            }
?>
		</ul>
		
        <h3>Préparation :</h3>
        <p><?php echo $Recettes[$_GET['K']]['preparation'] ?></p>
    </div>
</main>