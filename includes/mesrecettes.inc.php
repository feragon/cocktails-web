<h1>Mes recettes préférées</h1>
<hr/>

<?php
    global $Recettes;

    if(!isset($_SESSION['Favoris'])) {
        $_SESSION['Favoris'] = array();
    }

	if(empty($_SESSION["Favoris"])) {
	    echo 'Vous n\'avez pas de favoris...';
    }
    else {
        foreach($_SESSION['Favoris'] as $key => $favori) {
            $recette = $Recettes[$key];
            $url_photo = normaliserCaracteres($recette["titre"]);
            $url_photo = ucfirst(strtolower($url_photo));
            $url_photo = "resources/photos/" . strtr($url_photo, ' ', '_') . ".jpg";
            ?>
            <a href='<?php echo "?R=Cocktail&K=" . $key; ?>'>
                <div class="item">
                    <img src="<?php echo file_exists($url_photo) ? $url_photo : "resources/photos/none.jpg"; ?>"/>
                    <h4><?php echo $recette["titre"]; ?></h4>
                </div>
            </a>
            <?php
        }
    }