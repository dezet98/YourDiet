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
    <link rel="stylesheet" href="public/css/createDish.css" type="text/css"/>
</head>

<body>
    <div class="mobileMenu"> 
        <i class="fa fa-bars menu-trigger" onclick="menuTrigger()"></i>
        <label> Twój plan </label>
        <button id="changeContent" onclick="changeBox()">Stwórz Danie</button>
    </div>

    <div class="menu"> 
        <div class="logo">
            <img class="imgLogo" style="width: 100%; height: auto;" src="public/img/fullLogo.png" alt="logo"/>
        </div>
        <div class="subpages">
            <a class="submitInput" href="?page=yourSchedule">Twój plan</a>
            <a class="submitInput" href="#">Lista zakupów</a>
            <a class="submitInput" href="#">Stwórz danie</a>
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
            <div class="col-xs-10 col-sm-6 col-xs-offset-1 leftBox">
                <div id="nameBox">
                    <label> Nazwa dania: </label>
                    <input type="text" id="name" />
                </div>
                <div id="preparationTimeBox">
                    <label> Przypuszczalny czas wykonania: </label>
                    <input type="text" id="preparationTime" />
                </div>
                <div id="imageBox">
                    <label> Możesz załadować zdjęcie dania: </label>
                    <input type="file" id="file" value="Wybierz zdjęcie"/>
                </div>
                <div id="descriptionBox">
                    <label> Opisz sposób przygotowania: </label>
                    <textarea rows="4" cols="40" id="description"> </textarea>
                </div>
                <div id="componentBox">
                    <label> Składniki: </label>
                    <div id="dishComponents">
                        <template>
                            <div class="component">
                                <i class="fa fa-minus minus"> </i>
                                <!--<i class="fa fa-eye eye"> </i>-->
                                <input class="componentId" type="hidden"/>
                                <label class="componentName"> </label>
                                <input type="number" class="amount" min="0" value="0" step="0.01" /> 
                                <label class="componentUnit"> </label>
                            </div>
                        </template> 
                    </div> 
                </div>
                <button id="createDishButton"> "Stwórz danie" </button>
            </div>

            <div class="col-xs-10 col-sm-3 col-xs-offset-1 rightBox">
                <h5> Dodaj składniki: </h5>
                <div class="search"> 
                    <input id="text" type="text" placeholder="Szukaj dania"></input><!--
                    --><button id="searchButton" >Szukaj</button>
                </div>
                <div id="allComponents">
                    <template>
                        <div class="component">
                            <i class="fa fa-plus plus"> </i>
                            <!--<i class="fa fa-eye eye"> </i>-->
                            <input class="componentId" type="hidden" />
                            <input class="componentUnit" type="hidden" />
                            <label class="componentName"> </label>
                        </div>
                    </template> 
                </div>  
            </div>
        </div>
    </div>

    <script src="public/js/createDish.js"></script>
</body>
      
</html>
  
  