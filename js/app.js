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
    var $inserting = insertContextTemplate("/templates/gameboard.html");
    $inserting.promise().done(function() {
        $.ajax({
                url: "/Map.php",
                method: "get",
                dataType: "json",
            })
            .done(function(mapData) {
                var mapTemplate = getMapTemplate(mapData);
                console.log(mapTemplate);
            })
            .fail(function() {
                alert("ERROR: map data not fetched!");
            });
    });
}

function getMapTemplate(mapData) {
    var $mapTemplate = $(".mapWrapper");

    $mapTemplate.find(".row").each(function(yIndex, row) {
        $(row).find(".field").each(function(xIndex, field) {
            console.log(yIndex, row, xIndex, field);
            if (mapData[yIndex][xIndex] === 0) {
                $(field).addClass('water');
            } else {
                $(field).addClass('ground');
            }
        });
    });

    return mapData;
}

function insertContextTemplate(url) {
    return $.ajax({
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
