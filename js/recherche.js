document.addEventListener('keyup', (event) => {
	var search = document.getElementById("recherche").value;
	var items = document.getElementsByClassName("item");
	
	for(var i = 0; i < items.length; i++) {
		var titres = items[i].getElementsByTagName("h4");
		var ingr = items[i].getElementsByTagName("p");
		if(titres[0].innerHTML.toLowerCase().match(search) || ingr[0].innerHTML.toLowerCase().match(search))
			items[i].classList.remove("hidden");
		else
			items[i].classList.add("hidden");
	}
});