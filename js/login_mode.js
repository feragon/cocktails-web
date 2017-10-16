function toggleLoginMode(loginMode) {
	
	var listOfInputs = document.getElementById('register_fields').getElementsByTagName('input');
	
	if(loginMode) {
		document.getElementById('register_fields').classList.add('hidden');
		document.getElementById('login_button').classList.add('hidden');
		document.getElementById('register_button').classList.remove('hidden');
		document.getElementById('connexion_title').innerHTML = "Connexion";
		
		for(var i = 0; i < listOfInputs.length; i++) {
			listOfInputs[i].setAttribute("disabled", "");
		}
	}
	else {
		document.getElementById('register_fields').classList.remove('hidden');
		document.getElementById('register_button').classList.add('hidden');
		document.getElementById('login_button').classList.remove('hidden');
		document.getElementById('connexion_title').innerHTML = "S'inscrire";
		
		for(var i = 0; i < listOfInputs.length; i++) {
			listOfInputs[i].removeAttribute("disabled");
		}
		
		$('html, body').animate({scrollTop:260},'0');
	}
}