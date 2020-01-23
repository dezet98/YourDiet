
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
var days = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
changeDay()

function nextDay(x) {
    selectedDay.setDate(selectedDay.getDate()+x);


    $(document).ready(function(){



    });



    changeDay();
}

function changeDay() {
    document.getElementById("dayName").innerHTML = days[selectedDay.getDay()-1];
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

        $(".content").find("#dishImg").attr("src", imageSrc);
        $(".content").find("#name").text(name);
        $(".content").find("#preparationTime").text(preparationTime);
        $(".content").find("#calories").text(calories);
        
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

    $(".plus").click(function(){
        var id_dish = $(this).parent().find(".dishId").val();
        var date = formatDate(selectedDay);
        var imageSrc = $(this).parent().find(".dishImg").attr('src');
        var name = $(this).parent().find(".name").text();
        var preparationTime = $(this).parent().find(".preparationTime").text();
        var calories = $(this).parent().find(".calories").text();

        var newDish = $("template").contents().clone(true);
        $("#schedule").append(newDish);    // we have to use contents(), function childrens() doesn't work well
        
        newDish.find(".dishId").val(id_dish);
        newDish.find(".dishImg").attr("src", imageSrc);
        newDish.find(".name").text(name);
        newDish.find(".preparationTime").text(preparationTime);
        newDish.find(".calories").text(calories);

        
        var apiUrl = 'http://localhost/YourDiet';
        $.ajax({
            url : apiUrl + '/?page=addToSchedule',
            method : "POST",
            data : {
                id_dish : id_dish,
                date : date
            }
        })
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });

    });


    $("#schedule").on("click", ".minus", function(){
        
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
        .fail(function (jqXHR, textStatus, error) {
            console.log("Error: " + error);
        });
        
    });



  }); 
  
 