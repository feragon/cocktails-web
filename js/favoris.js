function favorisResponse(json) {
	var data = JSON.parse(json);
	if(data && data.success === true) {
		document.getElementById("retirer").classList.toggle("hidden");
		document.getElementById("ajouter").classList.toggle("hidden");
	}
}

function removeFavori(i) {
	$.ajax("ajax/favori.php", {
		data: {
			remove: i
		}
	})
	.done(favorisResponse);
}

function addFavori(i) {
	$.ajax("ajax/favori.php", {
		data: {
			add: i
		}
	})
	.done(favorisResponse);
}

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