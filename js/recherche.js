$(document).on("keyup", function() {
	var search = $("#recherche").val().toLowerCase();
	var noResults = true;
	
	$(".item").each(function (index) {
        var titre       = $(this).children("h4").first().text().toLowerCase();
        var ingredients = $(this).children("p").eq(2).text().toLowerCase();

        if(titre.match(search) || ingredients.match(search)) {
            $(this).removeClass("hidden");
            noResults = false;
        }
        else {
            $(this).addClass("hidden");
        }
    });

	if(noResults) {
        $("#noResults").removeClass("hidden");
        $("#recherche").addClass("red_input");
	}
	else {
        $("#noResults").addClass("hidden");
        $("#recherche").removeClass("red_input");
	}
});

$("form").on("submit", function (event) {
	event.preventDefault();
});