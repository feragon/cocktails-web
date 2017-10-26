<?php
    function init() {
		session_start();

        if(!array_key_exists('Favoris', $_SESSION)) {
            $_SESSION['Favoris'] = array();
        }
		if(isset($_POST['deconnexion'])) {
			$_SESSION = array();
			$_SESSION['Favoris'] = array();
			$_POST = array();
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
	
	function getImageURL($key, $boolRenvoyerImageParDefaut) {
		$url_photo = normaliserCaracteres($key);
		$url_photo = ucfirst(strtolower($url_photo));
		$url_photo = "resources/photos/".strtr($url_photo, ' ', '_').".jpg";
		
		if($boolRenvoyerImageParDefaut)
			return file_exists($url_photo) ? $url_photo : "resources/photos/none.jpg";
		else
			return file_exists($url_photo) ? $url_photo : "";
	}
	
	function calculerTemps($t) {
		$temps = time() - $t;
		
		if(floor($temps / 604800))
			return floor($temps / 604800)." sem.";
		else if(floor($temps / 86400))
			return floor($temps / 86400)." jour";
		else if(floor($temps / 3600))
			return floor($temps / 3600)." h.";
		else if(floor($temps / 60))
			return floor($temps / 60)." min.";
		else
			return $temps." sec.";
	}
	
	function afficherCocktails($tab, $isFavoris) {
		
		global $Recettes;
		
		foreach($tab as $key => $value) {
			$recette = ($isFavoris ? $Recettes[$key] : $value);
?>
			<a href='<?php echo "?R=Cocktail&K=".$key; ?>'>
				<div class="item"><?php if(array_key_exists($key, $_SESSION['Favoris'])) echo "
					<i class='fa fa-star-o'></i>"; ?>
					
					<img src="<?php echo getImageURL($recette["titre"], true); ?>" />
					<h4><?php echo $recette["titre"]; ?></h4>
					<div>
						<i class='fa fa-tint'></i>
						<p><?php 
								foreach($recette['index'] as $ing) {
									echo $ing." <br/>";
								}
						?></p>
					</div>
					<span class="time"><?php if(array_key_exists($key, $_SESSION['Favoris'])) {$t = calculerTemps($_SESSION['Favoris'][$key]); echo "<i class='fa fa-star-half-o'></i> il y a ".$t;} ?></span>
				</div>
			</a>
<?php
		}
	}

    function getFichierTemplate($nom) {
        $chemin = __DIR__ . '/../templates/' . strtolower($nom) . '.inc.php';

        if(file_exists($chemin)) {
            return $chemin;
        }
        else {
            http_response_code(404);
            return __DIR__ . '/../templates/404.inc.php';
        }
    }
?>