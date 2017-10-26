function editInfos() {
	
	var txtsList = document.getElementsByClassName("info_txt");
	var inputsList = document.getElementsByClassName("info_input");
	
	for(var i = 1; i < inputsList.length; i++) {
		inputsList[i].classList.remove("hidden");
		txtsList[i].classList.add("hidden");
		
		inputsList[i].getElementsByTagName("input")[0].value = txtsList[i].innerText;
	}
	
	document.getElementById("editer").classList.add("hidden");
	document.getElementById("deconnexion").classList.add("hidden");
	document.getElementById("valider_edit").classList.remove("hidden");
	document.getElementById("annuler_edit").classList.remove("hidden");
}

function submitInfos(soumettre) {
	
	var txtsList = document.getElementsByClassName("info_txt");
	var inputsList = document.getElementsByClassName("info_input");
	
	if(soumettre) {
		$.post("ajax/register.php", {
				'login': txtsList[0].innerText,
				'gender': document.getElementById("gender").value,
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
		for(var i = 1; i < inputsList.length; i++) {
			inputsList[i].classList.add("hidden");
			txtsList[i].classList.remove("hidden");
		}
		
		document.getElementById("editer").classList.remove("hidden");
	document.getElementById("deconnexion").classList.remove("hidden");
		document.getElementById("valider_edit").classList.add("hidden");
	document.getElementById("annuler_edit").classList.add("hidden");
	}
}