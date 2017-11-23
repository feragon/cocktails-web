<?php
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