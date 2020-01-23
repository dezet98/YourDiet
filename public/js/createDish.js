
// create listener which observe screen size:
var isPhoneScreen = window.matchMedia("(max-width: 768px)");  
isPhoneScreen.addListener(hideMenu);

var menuOnPage = false; 

function hideMenu(isPhoneScreen) {
    document.getElementsByClassName("menu")[0].style.transition = "0s";
    if(isPhoneScreen.matches) {
        document.getElementsByClassName("menu")[0].style.transform = "translateX(-100%)";
        menuOnPage = false; 
        document.getElementsByClassName("rightBox")[0].style.display = "none";
    }  else {
        document.getElementsByClassName("menu")[0].style.transform = "translateX(0)";
        menuOnPage = true; 
        document.getElementsByClassName("rightBox")[0].style.display = "inline";
        document.getElementsByClassName("leftBox")[0].style.display = "inline";
    }
}


// in mobile screen, click hamburger 
function menuTrigger() {
    var menu = document.getElementsByClassName("menu")[0];
    menu.style.transition = "0.7s";
    if (menuOnPage) {
        menu.style.transform = "translateX(-100%)";
        menuOnPage = false; 
    } else {
        menu.style.transform = "translateX(0)";
        menuOnPage = true; 
    }   
}


// in mobile screen we only can see right or left box, this function switch boxes: 
function changeBox() {
    if (document.getElementById("changeContent").innerHTML == "Plan dnia") {
        document.getElementsByClassName("rightBox")[0].style.display = "inline";
        document.getElementsByClassName("leftBox")[0].style.display = "none";
        document.getElementById("changeContent").innerHTML = "Dodaj danie";
    } else {
        document.getElementsByClassName("rightBox")[0].style.display = "none";
        document.getElementsByClassName("leftBox")[0].style.display = "inline";
        document.getElementById("changeContent").innerHTML = "Plan dnia";
    }   
}

$(document).ready(function(){

    $("#createDishButton").click(function(){
        var name = $("#name").val();
        var preparationTime = $("#preparationTime").val();
        var description = $("#description").val();
        var file = $("#file").val();
        
        var listOfComponents = $("#dishComponents").find(".componentId").map(function() {
                return $(this).val();
            }).get().join(' ');

        alert(listOfComponents);

        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=addDish',
            method : "POST",
            dataType : "json",
            data : {
                name : name,
                preparationTime : preparationTime,
                description : description,
                file : file,
                listOfComponents : listOfComponents
            }
        })
        .done(function(res) {
            // parseJSON convert string of JSON to JS, stringify turns JS object to JSON string 
            var result = $.parseJSON(JSON.stringify(res));  
            alert(result.message);

            if(result.status) {

            } else {
                $("#name").focus();
            }
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });
    });

    $(".container-fluix").on('click', '#searchButton', function(){
        var text = $("#text").val();
        $("#allComponents").find("*").not("template").remove(); 

        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=searchComponents',
            method : "POST",
            dataType : 'json',
            data : {
                text : text
            }
        })
        .done(function(res) {
            var components = $.parseJSON(JSON.stringify(res));

            // display components which I found:
            components.forEach(component => {
                var newComponent = $("#allComponents").find("template").contents().clone(true);
                $("#allComponents").append(newComponent);    // we have to use contents(), function childrens() doesn't work well
                
                newComponent.find(".componentId").val(component.id_component);
                newComponent.find(".componentName").text(component.name);
            });
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });

    });

    $(".container-fluix").on('click', '.plus', function(){
        var id_dish = $(this).parent().find(".componentId").val();
        var name = $(this).parent().find(".componentName").text();

        var component = $("#dishComponents").find("template").contents().clone(true);
        $("#dishComponents").append(component);    // we have to use contents(), function childrens() doesn't work well
        
        component.find(".componentId").val(id_dish);
        component.find(".componentName").text(name);
    });

    $(".container-fluix").on('click', ".minus", function(){
        $(this).parent().remove();
    });


});

