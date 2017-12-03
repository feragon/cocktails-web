/**
 * Traite la réponse du serveur lors de l'ajout ou la suppression d'un favori
 * @param json Réponse du serveur
 */
function favorisResponse(json) {
	var data = JSON.parse(json);
	if(data && data.success === true) {
		document.getElementById("retirer").classList.toggle("hidden");
		document.getElementById("ajouter").classList.toggle("hidden");
	}
}

/**
 * Supprime un favori
 * @param i Identifiant du cocktail
 */
function removeFavori(i) {
	$.post("ajax/favori.php", {
        remove: i
	})
	.done(favorisResponse);
}

/**
 * Ajoute un favori
 * @param i Identifiant du favori
 */
function addFavori(i) {
	$.post("ajax/favori.php", {
        add: i
	})
	.done(favorisResponse);
}

$("#formFavori").on("submit", function (event) {
    event.preventDefault();
});

$("#retirer").on("click", function () {
    removeFavori($(".cocktail_desc").attr('id'));
});

$("#ajouter").on("click", function () {
    addFavori($(".cocktail_desc").attr('id'));
});