<?php
    function init() {
        if(!array_key_exists('Favoris', $_SESSION)) {
            $_SESSION['Favoris'] = array();
        }
    }

	function normaliserCaracteres($s) {
		$normalizeChars = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
			'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
			'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
			'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
			'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
			'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
			'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
		);
		return strtr($s, $normalizeChars);
	}
	
	function afficherCocktails($tab, $isFavoris) {
		
		global $Recettes;
		
		foreach($tab as $key => $value) {
			$recette = ($isFavoris ? $Recettes[$key] : $value);
			
			$url_photo = normaliserCaracteres($recette["titre"]);
			$url_photo = ucfirst(strtolower($url_photo));
			$url_photo = "resources/photos/".strtr($url_photo, ' ', '_').".jpg";
			?>
			<a href='<?php echo "?R=Cocktail&K=".$key; ?>'>
				<div class="item"><?php if(array_key_exists($key, $_SESSION['Favoris'])) echo "
					<i class='fa fa-star-o'></i>"; ?>
					
					<img src="<?php echo file_exists($url_photo) ? $url_photo : "resources/photos/none.jpg"; ?>" />
					<h4><?php echo $recette["titre"]; ?></h4>
					<div>
						<i class='fa fa-tint'></i>
						<p><?php 
								foreach($recette['index'] as $ing) {
									echo $ing." <br/>";
								}
						?></p>
					</div>
				</div>
			</a>
<?php
		}
	}

    function getFichierTemplate($nom) {
        $chemin = __DIR__ . '/' . strtolower($nom) . '.inc.php';

        if(file_exists($chemin)) {
            return $chemin;
        }
        else {
            return __DIR__ . '/404.inc.php';
        }
    }
?>