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

            <input type="radio" name="gender" id="homme" value="Homme" disabled/>
            <label for="homme">Homme</label>

            <input type="radio" name="gender" id="femme" value="Femme" disabled/>
            <label for="femme">Femme</label>
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
            <input type="text" name="birthdate" id="birthdate" placeholder="Date de naissance (jj-mm-aaaa)" disabled/>
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

            <label for="phone" class="sr-only">Téléphone</label>
            <input type="text" name="phone" id="phone" placeholder="Téléphone" disabled/>
            <div id="phone-error" class="input-error hidden"></div>
            <br/>
        </div>

        <input class="boutonRond" type="submit" value="Envoyer"/>

        <div id="register_button" class="boutonRondPlein" style="width: 117px;">
            <a onclick="toggleLoginMode(false)">S'inscrire</a>
        </div>
        <div id="login_button" class="boutonRondPlein hidden" style="width: 117px;">
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
			<p style="text-align: center;"><i class='fa fa-star-o'></i> Vous n'avez pas encore de favoris...</p>
<?php
	}
?>
		</div>
		
		<div class="user_box">
			<h2>Mes informations personelles</h2>
			<table>
				<tr><th>Login :</th><td style="font-weight: bold; color: #009688;"><?php echo $user['login']; ?></td></tr>
				<tr><th>Nom :</th><td><?php echo $user['lastname']; ?></td></tr>
				<tr><th>Prénom :</th><td><?php echo $user['name']; ?></td></tr>
				<tr><th>Genre :</th><td><?php echo $user['gender']; ?></td></tr>
				<tr><th>Date de naissance :</th><td><?php echo $user['birthdate']; ?></td></tr>
				<tr><th>Email :</th><td><?php echo $user['email']; ?></td></tr>
				<tr><th>Adresse :</th><td><?php echo $user['address']; ?></td></tr>
				<tr><th>Téléphone :</th><td><?php echo $user['phone']; ?></td></tr>
			</table>
			
			<form method="POST" action=".?R=MonEspace">
				<input type="submit" name="deconnexion" value="Déconnexion" class="boutonRondPlein"/>
			</form>
		</div>
		
<?php
	}
?>
</main>