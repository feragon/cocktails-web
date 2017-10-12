<h1>Nos cocktails</h1>
<hr/>

<?php 

	foreach($Recettes as $key => $recette) {
		$url_photo = normaliserCaracteres($recette["titre"]);
		$url_photo = ucfirst(strtolower($url_photo));
		$url_photo = "resources/photos/".strtr($url_photo, ' ', '_').".jpg";
		?>
			<a href='<?php echo "?R=Cocktail&K=".$key; ?>'>
				<div class="item">
					<?php if(array_key_exists($key, $_SESSION['Favoris'])) echo "<i class='fa fa-star-o' aria-hidden='true'></i>"; ?>
					<img src="<?php echo file_exists($url_photo) ? $url_photo : "resources/photos/none.jpg"; ?>" />
					<h4><?php echo $recette["titre"]; ?></h4>
					<div>
						<i class='fa fa-tint' aria-hidden='true'></i>
						<p>
							<?php 
								foreach($recette['index'] as $ing) {
									echo $ing." <br/>";
								}
							?>
						</p>
					</div>
				</div>
			</a>
		<?php
	}
	
?>