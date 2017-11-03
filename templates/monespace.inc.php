<main>

<?php

	if(!isset($_SESSION['login'])) {
?>
    <h1 id='connexion_title'>Connexion</h1>
	<hr/>

    <form method="post" onsubmit="event.preventDefault(); submitLoginForm();">
        <label for="login" class="sr-only">Login</label>
        <input type="text" name="login" id="login" placeholder="Login" required/>
        <div id="login-error" class="input-error hidden"></div>
        <br/>

        <label for="password" class="sr-only">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required/>
        <div id="password-error" class="input-error hidden"></div>
        <br/>

        <div id='register_fields' class="hidden">
            <br/>
            <div class="button-group">
                <input type="radio" class="hidden" name="gender" id="homme" value="Homme" disabled/>
                <label for="homme">Homme</label>

                <input type="radio" class="hidden" name="gender" id="femme" value="Femme" disabled/>
                <label for="femme">Femme</label>
            </div>
            <div id="gender-error" class="input-error hidden"></div>
            <br/>

            <label for="name" class="sr-only">Prénom</label>
            <input type="text" name="name" id="name" placeholder="Prénom" disabled/>
            <div id="name-error" class="input-error hidden"></div>
            <br/>

            <label for="lastname" class="sr-only">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Nom" disabled/>
            <div id="lastname-error" class="input-error hidden"></div>
            <br/>

            <label for="birthdate" class="sr-only">Date de naissance</label>
            <input type="text" name="birthdate" id="birthdate" placeholder="Date de naissance (jj/mm/aaaa)" disabled/>
            <div id="birthdate-error" class="input-error hidden"></div>
            <br/>

            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" disabled/>
            <div id="email-error" class="input-error hidden"></div>
            <br/>

            <label for="address" class="sr-only">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Adresse" disabled/>
            <div id="address-error" class="input-error hidden"></div>
            <br/>
			
			<label for="postal" class="sr-only">Code postal</label>
            <input type="text" name="postal" id="postal" placeholder="Code postal" class="postal" disabled/>
            <div id="postal-error" class="input-error hidden"></div>
			
			<label for="town" class="sr-only">Ville</label>
            <input type="text" name="town" id="town" placeholder="Ville" class="town" disabled/>
            <div id="town-error" class="input-error hidden"></div>
            <br/>

            <label for="phone" class="sr-only">Téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Téléphone" disabled/>
            <div id="phone-error" class="input-error hidden"></div>
            <br/>
        </div>

        <input class="boutonRond" type="submit" value="Envoyer"/>

        <div id="register_button" class="boutonRondPlein" style="width: 106px;">
            <a onclick="toggleLoginMode(false)">S'inscrire</a>
        </div>
        <div id="login_button" class="boutonRondPlein hidden" style="width: 106px;">
            <a onclick="toggleLoginMode(true)">Se connecter</a>
        </div>
    </form>

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
			<form id="user_edit">
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
                        <label for="homme">Homme</label>

                        <input type="radio" class="hidden" name="gender" id="femme" value="Femme"/>
                        <label for="femme">Femme</label>
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
			</form>
			
			<form method="POST" action=".?R=MonEspace">
				<div id="editer" class="boutonRond ">
					<a onclick="editInfos()"><i class='fa fa-pencil'></i> Editer mes infos</a>
				</div>
				<div id="valider_edit" class="boutonRondPlein hidden">
					<a onclick="submitInfos(1)"><i class='fa fa-check'></i> Valider</a>
				</div>
				<div id="annuler_edit" class="boutonRond hidden">
					<a onclick="submitInfos(0)"><i class='fa fa-times'></i> Annuler</a>
				</div>
				<input type="submit" id="deconnexion" name="deconnexion" value="Déconnexion" class="boutonRondPlein"/>
			</form>
		</div>
		
<?php
	}
?>
</main>