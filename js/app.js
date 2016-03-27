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
                alert('udało się, robimy dalej!');
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
    var result = JSON.parse(data);
    console.log(result.code);
    alert("KOD:"+result.code+"\n"+"MSG:"+result.message);
}
