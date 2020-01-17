
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
        document.getElementById("changeContent").innerHTML = "Dodaj danie"
    } else {
        document.getElementsByClassName("rightBox")[0].style.display = "none";
        document.getElementsByClassName("leftBox")[0].style.display = "inline";
        document.getElementById("changeContent").innerHTML = "Plan dnia"
    }   
}

// when user click arrow for change day:
var date = new Date();
var days = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
changeDay()

function nextDay(x) {
  date.setDate(date.getDate()+x);
  changeDay();
}

function changeDay() {
  document.getElementById("dayName").innerHTML = days[date.getDay()];
}

function hoverDay() {
  
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
// Here we have too functions to react when user click plus or eye
$(document).ready(function(){
    $(".dish").mouseenter(function(){
        $(this).find(".imgBox img").css("opacity", "0.4");
        $(this).find(".plus").css("display", "inline"); 
        $(this).find(".textBox").css("opacity", "0.4");
        $(this).find(".eye").css("display", "inline");
       
        $(".plus").click(function(){
            var nazwa = $(this).find("h3").text();   //musze znalezc rodzica bo tylko wtedy zadziala
            alert("Nazwa= " + nazwa);

        });
        
        $(".eye").click(function(){
            alert("wyswietl");
        });

    });
    
    $(".dish").mouseleave(function(){
        $(this).find(".imgBox img").css("opacity", "1");
        $(this).find(".plus").css("display", "none"); 
        $(this).find(".textBox").css("opacity", "1");
        $(this).find(".eye").css("display", "none"); 
    });
    


  });
  