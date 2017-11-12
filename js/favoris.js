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
        remove: i,
        ajax: true
	})
	.done(favorisResponse);
}

/**
 * Ajoute un favori
 * @param i Identifiant du favori
 */
function addFavori(i) {
	$.post("ajax/favori.php", {
        add: i,
        ajax: true
	})
	.done(favorisResponse);
}

/**
 * Supprime tous les favoris
 */
function cleanFavori() {
	$.post("ajax/favori.php", {
        removeAll: null,
        ajax: true
	})
	.done(function () {
        window.location.reload();
    });
}