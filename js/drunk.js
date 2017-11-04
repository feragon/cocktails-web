var drunk_count = 1;

function drunk() {
	
	if(drunk_count < 15)
		drunk_count++;
	else if(drunk_count == 15) {
		document.getElementsByTagName("body")[0].classList.add("drunk");
		drunk_count++;
	}
	
}