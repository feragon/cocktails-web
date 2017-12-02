document.addEventListener('keyup', function(event) {
	var search = document.getElementById("recherche").value.toLowerCase();
	var items  = document.getElementsByClassName("item");
	var noResults = true;
	
	for(var i = 0; i < items.length; i++) {
		var titre       = items[i].getElementsByTagName("h4")[0].innerHTML.toLowerCase();
		var ingredients = items[i].getElementsByTagName("p")[0].innerHTML.toLowerCase();
		
		if(titre.match(search) || ingredients.match(search)) {
			items[i].classList.remove("hidden");
			noResults = false;
		}
		else
			items[i].classList.add("hidden");
	}
	
	if(noResults) {
		document.getElementById("noResults").classList.remove("hidden");
		document.getElementById("recherche").classList.add("red_input");
	}
	else {
		document.getElementById("noResults").classList.add("hidden");
		document.getElementById("recherche").classList.remove("red_input");
	}
});