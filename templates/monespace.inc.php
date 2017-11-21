<main>
<?php
    global $error;
    $error = array();
    $isRegister = isset($_GET['register']);

    if(isset($_GET['logout'])) {
        session_destroy();
		$_SESSION = array();
    }
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
	        echo '<div id="login-', $nomChamp, '" class="input-error';

	        if(array_key_exists($nomChamp, $erreurs)) {
	            echo '">', $erreurs[$nomChamp];
            }
            else {
	            echo ' hidden">';
            }

	        echo '</div>';
        }
?>
    <h1 id='connexion_title'>Connexion</h1>
	<hr/>

    <form method="post" onsubmit="event.preventDefault(); submitLoginForm();">
        <label for="login" class="sr-only">Login</label>
        <input type="text" name="login" id="login" placeholder="Login" required/>
        <?php
        addErrorField('login', $error);
        ?>
        <br/>

        <label for="password" class="sr-only">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required/>
		<?php
		addErrorField('password', $error);
		?>

        <div id='register_fields' <?=($isRegister) ? '' : 'class="hidden"'?>>
            <div class="button-group">
                <input type="radio" class="hidden" name="gender" id="homme" value="Homme"/>
                <label for="homme"><div class="radio_check_color"></div><p>Homme</p></label>

                <input type="radio" class="hidden" name="gender" id="femme" value="Femme"/>
                <label for="femme"><div class="radio_check_color"></div><p>Femme</p></label>
            </div>
			<?php
			addErrorField('gender', $error);
			?>

            <label for="name" class="sr-only">Prénom</label>
            <input type="text" name="name" id="name" placeholder="Prénom"/>
			<?php
			addErrorField('name', $error);
			?>

            <label for="lastname" class="sr-only">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Nom"/>
			<?php
			addErrorField('lastname', $error);
			?>

            <label for="birthdate" class="sr-only">Date de naissance</label>
            <input type="text" name="birthdate" id="birthdate" placeholder="Date de naissance (jj/mm/aaaa)"/>
			<?php
			addErrorField('birthdate', $error);
			?>

            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" placeholder="Email"/>
			<?php
			addErrorField('email', $error);
			?>

            <label for="address" class="sr-only">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Adresse"/>
			<?php
			addErrorField('address', $error);
			?>
            <br/>
			
			<label for="postal" class="sr-only">Code postal</label>
            <input type="text" name="postal" id="postal" placeholder="Code postal" class="postal"/>

			<label for="town" class="sr-only">Ville</label>
            <input type="text" name="town" id="town" placeholder="Ville" class="town"/>
			<?php
            addErrorField('postal', $error);
			addErrorField('town', $error);
			?>

            <label for="phone" class="sr-only">Téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Téléphone"/>
			<?php
			addErrorField('phone', $error);
			?>
        </div>

        <input class="boutonRond" name="submit" type="submit" value="Envoyer"/>

        <a href="?R=MonEspace&register" id="register_button" <?=($isRegister) ? 'class="hidden"' : ''?>
           onclick="event.preventDefault(); toggleLoginMode(false)">
            <button type="button" class="boutonRond plein">S'inscrire</button>
        </a>
        <a href="?R=MonEspace" id="login_button" <?=($isRegister) ? '' : 'class="hidden"'?>
           onclick="event.preventDefault(); toggleLoginMode(true)">
            <button type="button" class="boutonRond plein">Se connecter</button>
        </a>
    </form>

    <script type="text/javascript">
        var isLogin = <?=($isRegister) ? 'false' : 'true'?>;
    </script>
<?php 
	}
	else {
		
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
			<form method="POST" action=".?R=MonEspace">
				<div id="user_edit">
					<div>
						<span class="info_label">Login :</span>
						<span class="info_txt info_colored"><?php echo $user['login']; ?></span>
					</div>
					<div>
						<label for="lastname" class="info_label">Nom :</label>
						<span class="info_txt"><?php echo $user['lastname']; ?></span>
						<div class="info_input hidden">
							<input type="text" name="lastname" id="lastname" />
						</div>
					</div>
					<div>
						<label for="name" class="info_label">Prénom :</label>
						<span class="info_txt"><?php echo $user['name']; ?></span>
						<div class="info_input hidden">
							<input type="text" name="name" id="name" />
						</div>
					</div>
					<div>
						<span class="info_label">Genre :</span>
						<span class="info_txt"><?php echo $user['gender']; ?></span>
						<div class="info_input hidden button-group">
							<input type="radio" class="hidden" name="gender" id="homme" value="Homme"/>
							<label for="homme"><div class="radio_check_color"></div><p>Homme</p></label>

							<input type="radio" class="hidden" name="gender" id="femme" value="Femme"/>
							<label for="femme"><div class="radio_check_color"></div><p>Femme</p></label>
						</div>
					</div>
					<div>
						<label for="birthdate" class="info_label">Date de naissance :</label>
						<span class="info_txt"><?php echo $user['birthdate']; ?></span>
						<div class="info_input hidden">
							<input type="text" name="birthdate" id="birthdate" placeholder="jj/mm/aaaa"/>
						</div>
					</div>
					<div>
						<label for="email" class="info_label">Email :</label>
						<span class="info_txt"><?php echo $user['email']; ?></span>
						<div class="info_input hidden">
							<input type="email" name="email" id="email" />
						</div>
					</div>
					<div>
						<label for="address" class="info_label">Adresse :</label>
						<span class="info_txt"><?php echo $user['address']; ?></span>
						<div class="info_input hidden">
							<input type="text" name="address" id="address" />
						</div>
					</div>
					<div>
						<label for="postal" class="info_label">Code postal :</label>
						<span class="info_txt"><?php if(!empty($user['postal'])) echo str_pad($user['postal'], 5, "0", STR_PAD_LEFT); ?></span>
						<div class="info_input hidden">
							<input type="text" name="postal" id="postal" />
						</div>
					</div>
					<div>
						<label for="town" class="info_label">Ville :</label>
						<span class="info_txt"><?php echo $user['town']; ?></span>
						<div class="info_input hidden">
							<input type="text" name="town" id="town" />
						</div>
					</div>
					<div>
						<label for="phone" class="info_label">Téléphone :</label>
						<span class="info_txt"><?php if(!empty($user['phone'])) echo str_pad($user['phone'], 10, "0", STR_PAD_LEFT); ?></span>
						<div class="info_input hidden">
							<input type="text" name="phone" id="phone" />
						</div>
					</div>
				</div>
				
				<button id="editer" class="boutonRond" type="button" onclick="editInfos()">
					<span class='fa fa-pencil'></span> Editer mes infos
				</button>
				<button id="valider_edit" class="boutonRond plein hidden" type="button" onclick="submitInfos(1)">
					<span class='fa fa-check'></span> Valider
				</button>
				<button id="annuler_edit" class="boutonRond hidden" type="button" onclick="submitInfos(0)">
					<span class='fa fa-times'></span> Annuler
				</button>
			
				<span id="spinner" class="fa fa-spinner fa-spin fa-2x hidden"></span>
                <a href="?R=MonEspace&logout">
                    <button type="button" id="deconnexion" class="boutonRond plein">
                        <span class='fa fa-sign-out'></span> Déconnexion
                    </button>
                </a>
			</form>

		</div>
		
<?php
	}
?>
</main>