

$(document).ready(function() {

    $("button").click(function() {
        $("#allUsers").find("*").not("template").remove();

        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=adminUsers',
            method : "POST",
            dataType : 'json'
        })
        .done(function(res) {
            var users = $.parseJSON(JSON.stringify(res));

            // display components which I found:
            users.forEach(user => {
                var newUser = $("template").contents().clone(true);
                $("#allUsers").append(newUser);    // we have to use contents(), function childrens() doesn't work well
                
                newUser.find("#id_user").text(user.id_user);
                newUser.find("#email").text(user.email);
                newUser.find("#nickname").text(user.nickname);
            });
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });


    });

});

    
