/**
 * Supprime tous les favoris
 */
function cleanFavori() {
    $.post("ajax/favori.php", {
        removeAll: null
    })
        .done(function () {
            window.location.reload();
        });
}

$("#cleanForm").on("submit", function (event) {
    event.preventDefault();
    cleanFavori();
});