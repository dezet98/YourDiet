
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

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

var date = new Date();
var days = [
    "Poniedziałek",
    "Wtorek",
    "Środa",
    "Czwartek",
    "Piątek",
    "Sobota",
    "Niedziela"
];
displayDays();

function displayDays() {
    var i;
    var newDate = date.setDate(date.getDate());
    for (i = 0; i < 7; i++) {
        document.getElementsByClassName("day")[i].innerHTML = formatDate(newDate);
        newDate = date.setDate(date.getDate()+1);
    }
}

var amountOfPeople = 1;

$(document).ready(function() {
    $(".day").click(function() {

        if ($(this).data('status') == false) 
        {
            $(this).css('color', 'red');
            $(this).data('status', true);

            var date = $(this).text();
            
            var apiUrl = 'http://localhost/YourDiet';
            $.ajax({
                url : apiUrl + '/?page=addToGroceryList',
                method : "POST",
                dataType : "json",
                data : {
                    date : date
                }
            })
            .done(function(res) {
                var componentsFromDay = $.parseJSON(JSON.stringify(res));

                componentsFromDay.forEach(componentFromDay => {

                    var listOfComponents = $(".id").map(function() {
                        return ($(this).text() + ':' + $(this).parent().find(".amount").text());
                    }).get().join(' ');
                    console.log(listOfComponents);
                    // create array, so we have:  (componentId1:amount, componentId2:amount2, componentId3:amount3 ...)
                    var array = listOfComponents.split(" ");

                    // now I create final assosiative array like: key => value
                    var i = 0;
                    var components = {};
                    for (i=0; i<array.length; i++)
                    {
                        var id_amount = array[i].split(":");
                        components[id_amount[0]] = id_amount[1];
                    }
                    
                    // check if components are repeat:
                    if (componentFromDay.id_dishComponent in components)
                    {
                        $(".id").each(function() {
                            if($(this).text() == componentFromDay.id_dishComponent)
                            {
                                increaseAmount = parseInt($(this).siblings(".amount").text()) + parseInt(componentFromDay.amount) * amountOfPeople;
                                $(this).siblings(".amount").text(increaseAmount);
                            }
                        });

                    } else {
                        var newItem = $("#table").find("template").contents().clone(true);
                        $("#table").append(newItem);    
                        
                        newItem.find(".id").text(componentFromDay.id_dishComponent);
                        newItem.find(".name").text(componentFromDay.id_dish);
                        newItem.find(".amount").text(parseInt(componentFromDay.amount) * amountOfPeople);
                    }
                });
            })
            .fail(function (jqXHR, textStatus, error) {
                alert("Nie ok!");
                console.log("Error: " + error);
            });

        } else  {
            $(this).css('color', 'black');
            $(this).data('status', false);

            var date = $(this).text();
            
            var apiUrl = 'http://localhost/YourDiet';
            $.ajax({
                url : apiUrl + '/?page=addToGroceryList',
                method : "POST",
                dataType : "json",
                data : {
                    date : date
                }
            })
            .done(function(res) {
                var componentsFromDay = $.parseJSON(JSON.stringify(res));

                componentsFromDay.forEach(componentFromDay => {

                    $(".id").each(function() {
                        if($(this).text() == componentFromDay.id_dishComponent)
                        {
                            decreaseAmount = parseInt($(this).siblings(".amount").text()) - parseInt(componentFromDay.amount) * amountOfPeople;
                            if (decreaseAmount == 0)
                            {
                                $(this).parent().remove();
                            } else {
                                $(this).siblings(".amount").text(decreaseAmount);
                            } 
                        }
                    });
                });
            })
            .fail(function (jqXHR, textStatus, error) {
                alert("Nie ok!");
                console.log("Error: " + error);
            });
        }  
    });

    $(".amountOfPeople").change(function() {
        var newAmountOfPeople = parseInt($(".amountOfPeople").val());

        $(".id").each(function() {
            newAmount = parseInt($(this).siblings(".amount").text()) * newAmountOfPeople / amountOfPeople;   //DIVIDE BY 0 !!!
            $(this).siblings(".amount").text(newAmount); 
     
        });
        amountOfPeople = newAmountOfPeople;
    });


    $(".day").first().trigger("click");
});
 