var isLogin = true;

function toggleLoginMode(loginMode) {
	
	var listOfInputs = document.getElementById('register_fields').getElementsByTagName('input');

	isLogin = loginMode;

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

function submitLoginForm() {
    if(isLogin) {
        $.ajax("ajax/login.php", {
            data: {
                'login': document.getElementById("login").value,
                'password': document.getElementById("password").value
            }
        });
    }
    else {
        $.post("ajax/register.php", {
            'login': document.getElementById("login").value,
            'password': document.getElementById("password").value,
            'gender': $('input[name="gender"]:checked').val(),
            'name': document.getElementById("name").value,
            'lastname': document.getElementById("lastname").value,
            'birthdate': document.getElementById("birthdate").value,
            'email': document.getElementById("email").value,
            'address': document.getElementById("address").value,
            'phone': document.getElementById("phone").value
        });
    }
}