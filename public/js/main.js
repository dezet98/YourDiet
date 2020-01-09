
// create listener which knows when menu is visible:
var phoneScreen = window.matchMedia("(max-width: 768px)");  
phoneScreen.addListener(hideMenu);
var menuVisible = false; 

function hideMenu(phoneScreen) {
    if(phoneScreen.matches) {
        document.getElementsByClassName("menu")[0].style.transform = "translateX(-100%)";
        menuVisible = false; 
    }  else {
        document.getElementsByClassName("menu")[0].style.transform = "translateX(0)";
        menuVisible = true; 
    }

}

function menuTrigger() {
    var menu = document.getElementsByClassName("menu")[0];
    
    if (menuVisible) {
        menu.style.transform = "translateX(-100%)";
        menu.style.transition = "0.95s";
        menuVisible = false; 
    } else {
        menu.style.transform = "translateX(0)";
        menu.style.transition = "0.7s";
        menuVisible = true; 
        
    }   
}

