<main>
<?php
    global $error;
    $error = array();
    $isRegister = isset($_GET['register']);

    if (!isset($_GET['logout']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if($isRegister) {
            require(__DIR__ . '/../ajax/register.php');
        }
        else {
            require(__DIR__ . '/../ajax/login.php');
        }
    }


	if(!isset($_SESSION['login'])) {
		/**
		 * Ajoute un champ contenant l'erreur
         * @param $nomChamp string ID HTML du champ
         * @param $erreurs array Tableau contenant les erreurs
		 */
	    function addErrorField($nomChamp, $erreurs) {
	        echo '<div id="', $nomChamp, '-error" class="input-error">';

	        if(array_key_exists($nomChamp, $erreurs)) {
	            echo $erreurs[$nomChamp];
            }

	        echo '</div>';
        }

		/**
         * Affiche le placeholder s'il existe
		 * @param $post_index string Indice de l'élement dans le tableau $_POST
		 */
        function addValue($post_index) {
	        if(isset($_POST[$post_index])) {
	            echo 'value="', htmlspecialchars($_POST[$post_index]), '"';
            }
        }
?>
    <h1 id='connexion_title'>Connexion</h1>
	<hr/>

    <form method="post" action="?R=MonEspace" onsubmit="event.preventDefault(); submitLoginForm();">
        <label for="login" class="sr-only">Login</label>
        <input type="text" name="login" id="login" placeholder="Login" <?php addValue("login"); ?> required/>
        <?php
        addErrorField('login', $error);
        ?>

        <label for="password" class="sr-only">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required/>
		<?php
		addErrorField('password', $error);
		?>

        <div id='register_fields' <?=($isRegister) ? '' : 'class="hidden"'?>>
            <div class="button-group">
                <input type="radio" class="hidden" name="gender" id="homme" value="Homme"/>
                <label for="homme"><span class="radio_check_color"></span><span class="radio_p">Homme</span></label>

                <input type="radio" class="hidden" name="gender" id="femme" value="Femme"/>
                <label for="femme"><span class="radio_check_color"></span><span class="radio_p">Femme</span></label>
            </div>
			<?php
			addErrorField('gender', $error);
			?>

            <label for="name" class="sr-only">Prénom</label>
            <input type="text" name="name" id="name" placeholder="Prénom" <?php addValue("name"); ?>/>
			<?php
			addErrorField('name', $error);
			?>

            <label for="lastname" class="sr-only">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Nom" <?php addValue("lastname"); ?>/>
			<?php
			addErrorField('lastname', $error);
			?>

            <label for="birthdate" class="sr-only">Date de naissance</label>
            <input type="text" name="birthdate" id="birthdate" placeholder="Date de naissance (jj/mm/aaaa)" <?php addValue("birthdate"); ?>/>
			<?php
			addErrorField('birthdate', $error);
			?>

            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" <?php addValue("email"); ?>/>
			<?php
			addErrorField('email', $error);
			?>

            <label for="address" class="sr-only">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Adresse" <?php addValue("address"); ?>/>
			<?php
			addErrorField('address', $error);
			?>
			
			<label for="postal" class="sr-only">Code postal</label>
            <input type="text" name="postal" id="postal" placeholder="Code postal" class="postal" <?php addValue("postal"); ?>/>

			<label for="town" class="sr-only">Ville</label>
            <input type="text" name="town" id="town" placeholder="Ville" class="town" <?php addValue("town"); ?>/>
			<?php
            addErrorField('postal', $error);
			addErrorField('town', $error);
			?>

            <label for="phone" class="sr-only">Téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Téléphone" <?php addValue("phone"); ?>/>
			<?php
			addErrorField('phone', $error);
			?>
        </div>

        <input class="boutonRond" name="submit" type="submit" value="Envoyer"/>

		<button type="button" id="register_button" class="boutonRond plein <?=($isRegister) ? 'hidden' : ''?>" onclick="event.preventDefault(); toggleLoginMode(false)">
			S'inscrire
		</button>
       
		<button type="button" id="login_button" class="boutonRond plein <?=($isRegister) ? '' : 'hidden'?>" onclick="event.preventDefault(); toggleLoginMode(true)">
			 Se connecter
		</button>
    </form>

    <script type="text/javascript">
        var isLogin = <?=($isRegister) ? 'false' : 'true'?>;
    </script>
<?php 
	}
	else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require(__DIR__ . '/../ajax/register.php');
		}
        /**
         * Ajoute un champ
         * @param $name string Nom du champ
         * @param $label string Label du champ
         * @param $value string Valeur du champ
         */
        function addTextField($name, $label, $value) {
        ?>
            <div>
                <label for="<?=$name?>" class="info_label"><?=$label?> :</label>
                <span class="info_txt <?=(isset($_GET['edit'])) ? 'hidden' : '' ?>"><?php echo $value; ?></span>
                <div class="info_input <?=(isset($_GET['edit'])) ? '' : 'hidden'?>">
                    <input type="text" name="<?=$name?>" id="<?=$name?>" value="<?php echo $value; ?>" />
                </div>
            </div>
        <?php
        }
		
		$db = getDB();
		$query = $db->prepare("SELECT * FROM users WHERE login = ?");
		$query->execute(array($_SESSION['login']));
		
		$user = $query->fetch(PDO::FETCH_ASSOC);
?>
		<h1>Bonjour @<?php echo $user['login'];?> !</h1>
		<hr/>
		
		<div class="user_box">
			<h2>Ma dernière recette préférée</h2>
<?php
		if(!empty($_SESSION['Favoris'])) {
			$keyFavoriRecent = array_keys($_SESSION['Favoris'], max($_SESSION['Favoris']))[0];
			$tabFavorisRecent = array($keyFavoriRecent => "");
			
			afficherCocktails($tabFavorisRecent, true);
		}
		else {
?>
			<p id="noResults"><i class='fa fa-star-o'></i> Vous n'avez pas encore de favoris...</p>
<?php
		}
?>
		</div>
		
		<div class="user_box">
			<h2>Mes informations personelles</h2>
			<form method="POST" action="?R=MonEspace" onsubmit="event.preventDefault(); submitInfos(1);">
				<div id="user_edit">
					<div>
						<span class="info_label">Login :</span>
						<span class="info_txt info_colored"><?php echo $user['login']; ?></span>
					</div>
                    <?php
                    addTextField('lastname', 'Nom', $user['lastname']);
                    addTextField('name', 'Prénom', $user['name']);
                    ?>
					<div>
						<span class="info_label">Genre :</span>
						<span class="info_txt <?=(isset($_GET['edit'])) ? 'hidden' : '' ?>"><?php echo $user['gender']; ?></span>
						<div class="info_input button-group <?=(isset($_GET['edit'])) ? '' : 'hidden'?>">
							<input type="radio" class="hidden" name="gender" id="homme" value="Homme" <?=($user['gender'] == 'Homme') ? 'checked' : ''?>/>
							<label for="homme"><span class="radio_check_color"></span><span class="radio_p">Homme</span></label>

							<input type="radio" class="hidden" name="gender" id="femme" value="Femme" <?=($user['gender'] == 'Femme') ? 'checked' : ''?>/>
							<label for="femme"><span class="radio_check_color"></span><span class="radio_p">Femme</span></label>
						</div>
					</div>
					<?php
                        addTextField('birthdate', 'Date de naissance', $user['birthdate']);
                        addTextField('email', 'Email', $user['email']);
                        addTextField('address', 'Adresse', $user['address']);
                        addTextField('postal', 'Code postal',
                            (!empty($user['postal'])) ?
                                str_pad($user['postal'], 5, "0", STR_PAD_LEFT) :
                                '');
                        addTextField('town', 'Ville', $user['town']);
                        addTextField('phone', 'Téléphone',
                            (!empty($user['phone'])) ?
                                str_pad($user['phone'], 10, "0", STR_PAD_LEFT) :
                                ''
                        );
					?>
				</div>

                <input type="hidden" name="update" value="1"/>

                <a href="?R=MonEspace&edit" onclick="event.preventDefault(); editInfos()">
                    <button id="editer" class="boutonRond <?=(isset($_GET['edit'])) ? 'hidden' : '' ?>" type="button" >
                        <span class='fa fa-pencil'></span> Editer mes infos
                    </button>
                </a>

				<button id="valider_edit" class="boutonRond plein <?=(isset($_GET['edit'])) ? '' : 'hidden'?>" type="submit">
					<span class='fa fa-check'></span> Valider
				</button>

                <a href="?R=MonEspace" onclick="event.preventDefault(); submitInfos(0)">
                    <button id="annuler_edit" class="boutonRond <?=(isset($_GET['edit'])) ? '' : 'hidden'?>" type="button">
                        <span class='fa fa-times'></span> Annuler
                    </button>
                </a>
			
				<span id="spinner" class="fa fa-spinner fa-spin fa-2x hidden"></span>
                <a href="?logout">
                    <button type="button" id="deconnexion" class="boutonRond plein <?=(isset($_GET['edit'])) ? 'hidden' : '' ?>">
                        <span class='fa fa-sign-out'></span> Déconnexion
                    </button>
                </a>
			</form>

		</div>
		
<?php
	}
?>
</main>