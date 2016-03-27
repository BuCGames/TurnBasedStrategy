$(document).foundation();

$(function(){
});

$("form").on("submit", function(e) {
    e.preventDefault();
    var $form = $(this);

    $.ajax({
        url: $form.attr("action"),
        method: $form.attr("method"),
        data: $form.serialize(),
    })
    .done(function(data) {
        console.log(data);
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

function registration(data) {
    alert("KOD:"+data['code']+"\n"+"MSG:"+data['message']);
}
