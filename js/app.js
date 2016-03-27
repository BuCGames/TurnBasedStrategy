$(document).foundation();

$(function(){
});

$("form").on("submit", function(e) {
    e.preventDefault();
    var $form = $(this);

    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: $(this).serialize(),
    })
    .done(function(data) {
        switch ($form.attr("name")) {
            case "registration":
                alert('udało się, robimy dalej!')l
                registration(data);
                break;
            default:
                alert("ERROR: handler not defined!");
        }
    })
    .fail(function(data) {
        alert("ERROR: request failed!");
    });
});
