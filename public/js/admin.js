

$(document).ready(function() {

    $("button").click(function() {
        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=adminUsers',
            method : "POST",
            data : {
                idDZ : 69
            }
        })
        .done(function(response) { //funkcje srzałkowe jak najbardziej na propsie
            alert("response : " + response);
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });

    });

});

    
