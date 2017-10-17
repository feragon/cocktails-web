<main>
	<h1 id='connexion_title'>Connexion</h1>

	<form method="post" onsubmit="event.preventDefault(); submitLoginForm();">
		<label for="login" class="sr-only">Login</label>
		<input type="text" name="login" id="login" placeholder="Login" required/>
		<br/>

		<label for="password" class="sr-only">Mot de passe</label>
		<input type="password" name="password" id="password" placeholder="Mot de passe" required/>
		<br/>
		
		<div id='register_fields' class="hidden">
			<br/>
			
			<input type="radio" name="gender" id="homme" value="Homme" disabled/>
			<label for="homme">Homme</label>
			
			<input type="radio" name="gender" id="femme" value="Femme" disabled/>
			<label for="femme">Femme</label>
			<br/>
			
			<label for="name" class="sr-only">Prénom</label>
			<input type="text" name="name" id="name" placeholder="Prénom" disabled/>
			<br/>

			<label for="lastname" class="sr-only">Nom</label>
			<input type="text" name="lastname" id="lastname" placeholder="Nom" disabled/>
			<br/>
			
			<label for="birthdate" class="sr-only">Date de naissance</label>
			<input type="date" name="birthdate" id="birthdate" placeholder="Date de naissance" disabled/>
			<br/>

			<label for="email" class="sr-only">Email</label>
			<input type="email" name="email" id="email" placeholder="Email" disabled/>
			<br/>
			
			<label for="address" class="sr-only">Adresse</label>
			<input type="text" name="address" id="address" placeholder="Adresse" disabled/>
			<br/>

			<label for="phone" class="sr-only">Téléphone</label>
			<input type="text" name="phone" id="phone" placeholder="Téléphone" disabled/>
			<br/>
		</div>

		<input class="boutonRond" type="submit"/> 

		<div id="register_button" class="boutonRondPlein" style="width: 117px;">
			<a onclick="toggleLoginMode(false)">S'inscrire</a>
		</div>
		<div id="login_button" class="boutonRondPlein hidden" style="width: 117px;">
			<a onclick="toggleLoginMode(true)">Se connecter</a>
		</div>
	</form>
</main>