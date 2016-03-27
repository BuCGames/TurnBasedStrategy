$(document).foundation();

$(function(){
    insertContextTemplate("/templates/registration.html");
});

function registration(data) {
    if (data.code != 1) {
        renderMap();
        return;
    }

    alert("KOD:"+data.code+"\n"+"MSG:"+data.message);
}

function renderMap()
{
    $.ajax({
            url: "/mapa.php",
            method: "get",
            dataType: "json",
        })
        .done(function(mapa) {
            console.log(mapa);
        })
        .fail(function() {
            alert("ERROR: template not found!");
        });
}

function insertContextTemplate(url) {
    $.ajax({
            url: url,
            method: "get",
            dataType: "html",
        })
        .done(function(data) {
            $data = $(data);
            $(".container").html($data);
            submitFormHandler($(".container"));
        })
        .fail(function() {
            alert("ERROR: template not found!");
        });
}

function submitFormHandler($template) {
    $template.on("submit", "form", function(e) {
        e.preventDefault();
        var $form = $(this);

        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType: "json",
        })
        .done(function(data) {
            switch ($form.attr("name")) {
                case "registration":
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
}
