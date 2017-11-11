/**
 * Change l'affichage des informations de l'utilisateur en un formulaire pour les éditer
 */
function editInfos() {
	
	var txtsList = document.getElementsByClassName("info_txt");
	var inputsList = document.getElementsByClassName("info_input");
	
	for(var i = 0; i < inputsList.length; i++) {
		inputsList[i].classList.remove("hidden");
		txtsList[i+1].classList.add("hidden");

		if(txtsList[i+1].innerText === "Homme") {
			$('#homme').attr("checked", true);
			$('#femme').attr("checked", false);
		}
		else if(txtsList[i+1].innerText === "Femme") {
            $('#femme').attr("checked", true);
            $('#homme').attr("checked", false);
		}
		if(i != 2) {
            inputsList[i].getElementsByTagName("input")[0].value = txtsList[i + 1].innerText; //TODO: pour le genre il se passe quoi ?
        }
	}
	
	document.getElementById("editer").classList.add("hidden");
	document.getElementById("deconnexion").classList.add("hidden");
	document.getElementById("valider_edit").classList.remove("hidden");
	document.getElementById("annuler_edit").classList.remove("hidden");
}

/**
 * Enlève le formulaire et le soumet s'il faut
 * @param soumettre Vrai si le formulaire doit être traité
 */
function submitInfos(soumettre) {
	
	var txtsList = document.getElementsByClassName("info_txt");
	var inputsList = document.getElementsByClassName("info_input");
	
	if(soumettre) {
		$.post("ajax/register.php", {
				'login': txtsList[0].innerText,
				'gender': $('input[name="gender"]:checked').val(),
				'name': document.getElementById("name").value,
				'lastname': document.getElementById("lastname").value,
				'birthdate': document.getElementById("birthdate").value,
				'email': document.getElementById("email").value,
				'address': document.getElementById("address").value,
				'postal': document.getElementById("postal").value,
				'town': document.getElementById("town").value,
				'phone': document.getElementById("phone").value,
				'update' : true
			})
			.done(function (json) {
				var data = JSON.parse(json);
				if(!showErrors(data)) {
					window.location = window.location.href;
				}
			});
	}
	else {
		for(var i = 0; i < inputsList.length; i++) {
			inputsList[i].classList.add("hidden");
			txtsList[i+1].classList.remove("hidden");
		}
		
		document.getElementById("editer").classList.remove("hidden");
		document.getElementById("deconnexion").classList.remove("hidden");
		document.getElementById("valider_edit").classList.add("hidden");
		document.getElementById("annuler_edit").classList.add("hidden");
	}
}