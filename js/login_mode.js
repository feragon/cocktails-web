var isLogin = true;

/**
 * Bascule entre le mode Connexion et Enregistrement
 * @param loginMode Vrai si on doit afficher le mode Connexion
 */
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
		
		$('html, body').animate({scrollTop:360},'0');
	}
}

/**
 * Supprime toutes les erreurs affichés sur le formulaire
 */
function clearFormErrors() {
    var errors = document.getElementsByClassName("input-error");
    for(var i = 0; i < errors.length; i++) {
        var item = errors.item(i);
        item.innerText = "";
        item.classList.add("hidden");
    }
}

/**
 * Traite les erreurs renvoyées par le serveur
 * @param data Erreurs du serveur
 * @returns {boolean} Vrai si une erreur est survenue
 */
function showErrors(data) {
    var error = false;

    clearFormErrors();

    for(var inputName in data) {
        if(data[inputName] === '') {
            continue;
        }

        error = true;

        var errorContainer = document.getElementById(inputName + "-error");
        if(errorContainer === null) {
            alert(data[inputName]);
        }
        else {
            errorContainer.classList.remove("hidden");
            errorContainer.innerText = data[inputName];
        }
    }

    return error;
}

/**
 * Soumet le formulaire de connexion ou d'enregistrement au serveur
 */
function submitLoginForm() {
    if(isLogin) {
        $.ajax("ajax/login.php", {
            data: {
                'login': document.getElementById("login").value,
                'password': document.getElementById("password").value
            }
        })
        .done(function (json) {
            var data = JSON.parse(json);
            if(!showErrors(data)) {
				window.location = window.location.href;
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
            'postal': document.getElementById("postal").value,
            'town': document.getElementById("town").value,
            'phone': document.getElementById("phone").value
        })
        .done(function (json) {
            var data = JSON.parse(json);
            if(!showErrors(data)) {
				window.location = window.location.href;
            }
        });
    }
}