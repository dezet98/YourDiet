<?php
    if(!isset($_SESSION['id'], $_SESSION['role'])) {
        die("Nie jesteś zalogowany!");
    }

    if(!in_array('ROLE_USER', $_SESSION['role'])) {
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
    <link rel="stylesheet" href="public/css/yourSchedule.css" type="text/css"/>
</head>

<body>
    <div class="mobileMenu"> 
        <button id="menu-trigger" onclick="menuTrigger()"> ham </button>
        <label> Twój plan <label>
        <button id="changeContent" onclick="changeBox()">Plan dnia</button>
    </div>

    <div class="menu"> 
        <div class="logo">
            <img class="imgLogo" style="width: 100%; height: auto;" src="public/img/fullLogo.png" alt="logo"/>
        </div>
        <div class="subpages">
            <a class="submitInput" href="#">Twój plan</a>
            <a class="submitInput" href="#">Lista zakupów</a>
            <a class="submitInput" href="?page=createDish">Stwórz danie</a>
            <a class="submitInput" href="#">Szukaj dania</a>
            <a class="submitInput" href="#">Porady</a>
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
                    <img id="dishImg" alt="img" onerror="this.src='public/img/uploads/food10.jpg'" style="width: 30%; height: auto;"> </img>
                    <h1 id="name"> </h1>
                    <h4 id="preparationTime"> </h4>
                    <h4 id="calories"> </h4>
                    <label> </label>
                </div>
            </div>
            <div class="col-xs-10 col-sm-6 col-xs-offset-1 leftBox">
                <div class="search"> 
                    <input id="text" type="text" placeholder="Szukaj dania"></input><!--
                    --><button id="searchButton" >Szukaj</button>
                </div>
                <div id="checkbox">
                    <input type="checkbox">Podstawowe produkty</button>
                </div>
                <div id="results">

                    <?php if(isset($dishes)) foreach($dishes as $dish) { ?>
                        <div class="dish">
                            <i class="fa fa-plus plus"> </i>
                            <i class="fa fa-eye eye"> </i>
                            <input class="dishId" type="hidden" name="dishId" value="<?= $dish->getId_dish() ?>" />
                            <div class="imgBox">
                                <img class="dishImg" src="public/img/uploads/<?= $dish->getImage(); ?>" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                            </div>
                            <div class="textBox">
                                <h3 class="name"> <?= $dish->getName(); ?> </h3>
                                <h5 class="preparationTime"> <?= $dish->getPreparationTime(); ?> </h5>
                                <h5 class="calories"> *350cal </h5>
                            </div>
                        </div>
                    <?php } ?>

                </div>       
            </div>

            <div class="col-xs-10 col-sm-3 col-xs-offset-1 rightBox">
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

                    <?php if(isset($dishesOfDay)) foreach($dishesOfDay as $dishOfDay) { ?>
                        <div class="dish">
                            <i class="fa fa-minus minus"> </i>
                            <i class="fa fa-eye eye"> </i>
                            <input class="dishId" type="hidden" name="dishId" value="<?= $dishOfDay->getId_dish() ?>" />
                            <div class="imgBox">
                                <img class="dishImg" src="public/img/uploads/<?= $dishOfDay->getImage(); ?>" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                            </div>
                            <div class="textBox">
                                <h3 class="name"> <?= $dishOfDay->getName(); ?> </h3>
                                <h5 class="preparationTime"> <?= $dishOfDay->getPreparationTime(); ?> </h5>
                                <h5 class="calories"> *350cal </h5>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- we use this template for create dynamically new divs:   --> 
                    <template>
                        <div class="dish">
                            <i class="fa fa-minus minus"> </i>
                            <i class="fa fa-eye eye"> </i>
                            <input class="dishId" type="hidden" name="dishId" />
                            <div class="imgBox">
                                <img class="dishImg" src="public/img/uploads/nazwa" alt="img" onerror="this.src='public/img/uploads/food10.jpg'"> </img>
                            </div>
                            <div class="textBox">
                                <h3 class="name"> Name </h3>
                                <h5 class="preparationTime"> proparationTime </h5>
                                <h5 class="calories"> calories</h5>
                            </div>
                        </div>
                    </template>
                </div>
                <div id="statistics" class="tab" style="display: none;">
                    <h5> tluszcze </h5>
                </div>
            </div>

        </div>
    </div>

    <script src="public/js/yourSchedule.js"></script>
</body>
      
</html>
  
  