<?php
    if(!isset($_SESSION['id'], $_SESSION['role'])) {
        die("Nie jesteś zalogowany!");
    }

    if($_SESSION['role'] != 'ROLE_USER' && $_SESSION['role'] != 'ROLE_ADMIN') {
        echo($_SESSION['role']);
        die("Nie masz uprawnień aby być na tej stronie!");
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourDiet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/globalStyle.css" type="text/css"/>
    <link rel="stylesheet" href="public/css/menuStyle.css" type="text/css"/>
    <link rel="stylesheet" href="public/css/yourSchedule.css" type="text/css"/>
</head>

<body>
    <div class="mobileMenu"> 
        <i class="fa fa-bars menu-trigger" onclick="menuTrigger()"></i>
        <label> Twój plan </label>
        <button id="changeContent" onclick="changeBox()">Plan dnia</button>
    </div>
    
    <div class="menu"> 
        <div class="logo">
            <img class="imgLogo" style="width: 100%; height: auto;" src="public/img/fullLogo.png" alt="logo"/>
        </div>
        <div class="subpages">
            <a class="submitInput" href="?page=yourSchedule">Twój plan</a>
            <a class="submitInput" href="?page=groceryList">Lista zakupów</a>
            <a class="submitInput" href="?page=createDish">Stwórz danie</a>
            <a class="submitInput" href="#">Szukaj dania</a>
            <?php if ($_SESSION['role'] == 'ROLE_ADMIN')
                echo "<a class='submitInput' href='?page=admin'>Panel admina</a>";
            ?>
        </div>
        <div class="logOut">
            <form action="?page=logOut" method="POST">
                <input type="submit" value="Wyloguj się"/>
            </form>
        </div> 
    </div>



    <div class="container-fluix">
        <div class="row" style="height: 85%;">
            <div id="modalId" class="modal">
                <div class="content">
                    <i class="fa fa-times closeModal"> </i>
                    <div id="photo">
                        <img id="dishImg" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                    </div>
                    <div id="names">
                        <label id="name"> </label>
                        <label id="preparationTime"> </label>
                        <label id="calories"> </label>
                    </div>
                    <div id="des">
                        <p id="description"> </p>
                    </div>
                </div>
            </div>

            <div class="col-xs-10 col-sm-6 col-xs-offset-1 leftBox">
                <div class="search"> 
                    <input id="text" type="text" placeholder="Szukaj dania"></input><!--
                    --><button id="searchButton" >Szukaj</button>
                </div>
                <div id="checkbox">
                    <input type="checkbox">Nasze dania</button>
                </div>
                <div id="results">
                    <template>
                        <div class="dish">
                                <i class="fa fa-plus plus"> </i>
                                <i class="fa fa-eye eye"> </i>
                                <input class="dishId" type="hidden"/>
                                <div class="imgBox">
                                    <img class="dishImg" src="public/img/uploads/" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                                </div>
                                <div class="textBox">
                                    <label class="name"> </label>
                                    <label class="preparationTime"> </label>
                                    <label class="calories"> *350cal </label>
                                    <input class="description" type="hidden"/>
                                </div>
                        </div>
                    </template>
                </div>       
            </div>

            <div class="col-xs-10 col-sm-3 col-xs-offset-1 rightBox">
                <label id="status"> </label> 
                <div class="daysSlider">
                    <i class="fa fa-angle-left arrow" onclick="nextDay(-1)" style="font-size: 40px;"> </i>
                    <label id="dayName" mouseover="hoverDay()"> </label>
                    <i class="fa fa-angle-right arrow" onclick="nextDay(+1)" style="font-size: 40px;"> </i>
                </div>
                <div class="tabButtons">
                    <button id="scheduleButton" class="on" type="submit" onclick="openTab('schedule')">Plan dnia</button><!--
                    --><button id="statisticsButton" class="off" type="submit" onclick="openTab('statistics')">Statystyka</button>
                </div>
                <div id="schedule"  class="tab">
                    <template>
                        <div class="dish">
                            <i class="fa fa-minus minus"> </i>
                            <i class="fa fa-eye eye"> </i>
                            <input class="dishId" type="hidden" name="dishId" />
                            <div class="imgBox">
                                <img class="dishImg" src="public/img/uploads/" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                            </div>
                            <div class="textBox">
                                <label class="name"> </label>
                                <label class="preparationTime"> </label>
                                <label class="calories"> </label>
                                <input class="description" type="hidden"/>
                            </div>
                        </div>
                    </template>
                </div>
                <div id="statistics" class="tab" style="display: none;">
                    <h5> Kalorie: </h5>
                    <h5> Tłuszcze: </h5>
                    <h5> Białka: </h5>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/yourSchedule.js"></script>
</body>   
</html>
  
  