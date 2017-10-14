<?php require(__DIR__ . '/header.inc.php'); ?>

<main>
	<h1>Connexion</h1>

	<form method="post" onsubmit="event.preventDefault(); submitLoginForm();">
		<label for="login" class="sr-only">Login</label>
		<input type="text" name="login" id="login" placeholder="Login" required/>
		<br/>

		<label for="password" class="sr-only">Mot de passe</label>
		<input type="password" name="password" id="password" placeholder="Mot de passe" required/>
		<br/>

		<input class="boutonRond" type="submit"/>
	</form>
</main>

    <script type="text/javascript">
        function submitLoginForm() {
            $.ajax("ajax/login.php", {
                data: {
                    'login': document.getElementById("login").value,
                    'password': document.getElementById("password").value
                }
            });
        }
    </script>

<?php require(__DIR__ . '/footer.inc.php'); ?>