document.addEventListener('keyup', (event) => {
	
	var search = document.getElementById("recherche").value.toLowerCase();
	var items  = document.getElementsByClassName("item");
	
	for(var i = 0; i < items.length; i++) {
		var titre       = items[i].getElementsByTagName("h4")[0].innerHTML.toLowerCase();
		var ingredients = items[i].getElementsByTagName("p")[0].innerHTML.toLowerCase();
		
		if(titre.match(search) || ingredients.match(search))
			items[i].classList.remove("hidden");
		else
			items[i].classList.add("hidden");
	}
});