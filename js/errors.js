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
        var errorInput = document.getElementById(inputName);
        if(errorContainer === null) {
            //alert(data[inputName]);
        }
        else {
            errorContainer.innerText = data[inputName];
            errorInput.classList.add("red_input");
        }
    }

    return error;
}

/**
 * Supprime toutes les erreurs affichés sur le formulaire
 */
function clearFormErrors() {
    var errors = document.getElementsByClassName("input-error");
    for(var i = 0; i < errors.length; i++) {
        var item = errors.item(i);
        item.innerText = "";
    }
    var errorInputs = document.getElementsByTagName("input");
    for(var i = 0; i < errorInputs.length; i++) {
        errorInputs[i].classList.remove("red_input");
    }
}