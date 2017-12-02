<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require(__DIR__ . '/../ajax/user.php');
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