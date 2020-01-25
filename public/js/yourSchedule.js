
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

// when user click arrow for change day:
var selectedDay = new Date();
var today = new Date();
var days = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
changeDay()

function nextDay(x) {
    selectedDay.setDate(selectedDay.getDate()+x);
    
    $(document).ready(function(){
        $("#schedule").find("*").not("template").remove(); 
        var date = formatDate(selectedDay);

        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=updateSchedule',
            method : "POST",
            dataType : 'json',
            data : {
                date : date
            }
        })
        .done(function(res) {
            var dishesFromDay = $.parseJSON(JSON.stringify(res));

            // display dishes which I found:
            dishesFromDay.forEach(dish => {
                var newDish = $("#schedule").find("template").contents().clone(true);
                $("#schedule").append(newDish);    // we have to use contents(), function childrens() doesn't work well
                
                newDish.find(".dishId").val(dish.id_dish);
                newDish.find(".dishImg").attr("src", "public/img/uploads/" + dish.image);
                newDish.find(".name").text(dish.name);
                newDish.find(".preparationTime").text(dish.preparationTime);
                newDish.find(".calories").text("350kcal");
                newDish.find(".description").val(dish.description);
            });
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });


    });

    changeDay();
}

function changeDay() {
    document.getElementById("dayName").innerHTML = days[selectedDay.getDay()] + "  " + formatDate(selectedDay);
}

function hoverDay() {
  
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


// this funtion change tab in right box:
function openTab(name) {
    if (name == "statistics") {
        document.getElementById("statistics").style.display = "inline";
        document.getElementById("schedule").style.display = "none";
        document.getElementById("statisticsButton").className = "on";
        document.getElementById("scheduleButton").className = "off";
    } else {
        document.getElementById("schedule").style.display = "inline";
        document.getElementById("statistics").style.display = "none";
        document.getElementById("scheduleButton").className = "on";
        document.getElementById("statisticsButton").className = "off";  
    }
}


// this is for show plus, eye icons when user has a cursor on dish. 
// Here we have too functions to react when user click plus or eye and more
$(document).ready(function(){
    $(".container-fluix").on("mouseenter", ".dish", function(){     // function "on" is necessary
        $(this).find(".imgBox, .textBox").css("opacity", "0.4");
        $(this).find(".plus, .eye, .minus").show();
    });
    
    $(".container-fluix").on("mouseleave", ".dish", function(){
        $(this).find(".imgBox, .textBox").css("opacity", "1");
        $(this).find(".plus, .eye, .minus").hide();
    });

    $(".container-fluix").on("click", ".eye", function(){
        var imageSrc = $(this).parent().find(".dishImg").attr('src');
        var name = $(this).parent().find(".name").text();
        var preparationTime = $(this).parent().find(".preparationTime").text();
        var calories = $(this).parent().find(".calories").text();
        var description = $(this).parent().find(".description").val();

        $(".modal .content").find("#dishImg").attr("src", imageSrc);
        $(".modal .content").find("#name").text(name);
        $(".modal .content").find("#preparationTime").text(preparationTime);
        $(".modal .content").find("#calories").text(calories);
        $(".modal .content").find("#description").text(description);

        $(".modal").show();
    });

    $(".closeModal").click(function(){
        $(".modal").hide();
    });

    $(window).on("click", function(e){
        if (e.target.id == $("#modalId").prop('id')) {
            $(".modal").hide();
        }
    });

    $(".container-fluix").on("click", ".plus", function(){
        var todayTime = today.getTime();
        if(todayTime <= selectedDay.getTime())
        {
            $("#status").text("Dodaje do dnia...");

            var id_dish = $(this).parent().find(".dishId").val();
            var date = formatDate(selectedDay);
            var imageSrc = $(this).parent().find(".dishImg").attr('src');
            var name = $(this).parent().find(".name").text();
            var preparationTime = $(this).parent().find(".preparationTime").text();
            var calories = $(this).parent().find(".calories").text();
            var description = $(this).parent().find(".description").val();

            var newDish = $("#schedule").find("template").contents().clone(true);
            $("#schedule").append(newDish);    // we have to use contents(), function childrens() doesn't work well
            
            newDish.find(".dishId").val(id_dish);
            newDish.find(".dishImg").attr("src", imageSrc);
            newDish.find(".name").text(name);
            newDish.find(".preparationTime").text(preparationTime);
            newDish.find(".calories").text(calories);
            newDish.find(".description").val(description);
            
            var apiUrl = 'http://localhost/YourDiet';
            $.ajax({
                url : apiUrl + '/?page=addToSchedule',
                method : "POST",
                data : {
                    id_dish : id_dish,
                    date : date
                }
            })
            .done(function(res) {
                $("#status").text("Zapisano!");
                setTimeout(function(){$("#status").text("");}, 500);
            })
            .fail(function (jqXHR, textStatus, error) {
                console.log("Error: " + error);
            });
        }  else {
            alert("Nie możesz dodać dań do dni które już mineły");
        }
    });


    $("#schedule").on("click", ".minus", function(){
        var todayTime = today.getTime();
        if(todayTime <= selectedDay.getTime())
        {
            $("#status").text("Usuwam z dnia...");
            var id_dish = $(this).parent().find(".dishId").val();
            $(this).parent().remove();  // in this case $(this).parent() give us ".dish"

            var date = formatDate(selectedDay);
            var apiUrl = 'http://localhost/YourDiet';
            $.ajax({
                url : apiUrl + '/?page=removeFromSchedule',
                method : "POST",
                data : {
                    id_dish : id_dish,
                    date : date
                }
            })
            .done(function(){
                $("#status").text("Usunięto!");
                setTimeout(function(){$("#status").text("");}, 500);
            })
            .fail(function (jqXHR, textStatus, error) {
                console.log("Error: " + error);
            });
        }  else{
            alert("Nie możesz usunąć dań w dniach które już mineły");
        }
    });

    $(".container-fluix").on('click', '#searchButton', function(){
        var text = $("#text").val();
        $("#results").find("*").not("template").remove(); 

        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=searchDishes',
            method : "POST",
            dataType : 'json',
            data : {
                text : text
            }
        })
        .done(function(res) {
            var dishes = $.parseJSON(JSON.stringify(res));

            dishes.forEach(dish => {
                var newDish = $("#results").find("template").contents().clone(true);
                $("#results").append(newDish);    // we have to use contents(), function childrens() doesn't work well
                
                newDish.find(".dishId").val(dish.id_dish);
                newDish.find(".dishImg").attr("src", "public/img/uploads/" + dish.image);
                newDish.find(".name").text(dish.name);
                newDish.find(".preparationTime").text(dish.preparationTime);
                newDish.find(".calories").text("350kcal");
                newDish.find(".description").val(dish.description);
            });
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });

    });


    // IMPORTAND:
    $("#searchButton").trigger("click");
    nextDay(0);

  }); 
  
 