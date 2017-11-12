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
	$.ajax("ajax/favori.php", {
		data: {
			remove: i
		}
	})
	.done(favorisResponse);
}

/**
 * Ajoute un favori
 * @param i Identifiant du favori
 */
function addFavori(i) {
	$.ajax("ajax/favori.php", {
		data: {
			add: i
		}
	})
	.done(favorisResponse);
}

/**
 * Supprime tous les favoris
 */
function cleanFavori() {
	$.ajax("ajax/favori.php", {
		data: {
			removeAll: null
		}
	})
	.done(function () {
        window.location.reload();
    });
}