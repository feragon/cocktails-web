<main>
    <div class="cocktail_desc">
        <h1><?php echo $Recettes[$_GET['K']]['titre'] ?></h1>

        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] > 0) ? $_GET['K']-1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-left'></i></a>
        <a class="arrow" href="?R=Cocktail&K=<?php echo ($_GET['K'] < count($Recettes)-1) ? $_GET['K']+1 : $_GET['K']; ?>"><i class='fa fa-arrow-circle-o-right'></i></a>
<?php $retirer = array_key_exists($_GET['K'], $_SESSION['Favoris']); ?>

        <div id="retirer" class="boutonRondPlein <?php echo $retirer ? '' : 'hidden'; ?>">
            <a onclick="removeFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i> Retirer de mes recettes</a>
        </div>
        <div id="ajouter" class="boutonRond <?php echo $retirer ? 'hidden' : ''; ?>">
            <a onclick="addFavori(<?php echo $_GET['K']; ?>)"><i class='fa fa-star'></i> Ajouter à mes recettes</a>
        </div>
		
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