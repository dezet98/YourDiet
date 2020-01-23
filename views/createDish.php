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
    <link rel="stylesheet" href="public/css/createDish.css" type="text/css"/>
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
            <label>
                    <?php
                        if(isset($messages))
                        {
                            foreach($messages as $message)
                            {
                                echo $message;
                            }
                        }
                    ?>
            </label>
            <div class="col-xs-10 col-sm-6 col-xs-offset-1 leftBox">
               <!-- <form action="?page=addDish" method="POST"> -->
                    <label> Nazwa: </label>
                    <input type="text" id="name" />
                    <label> Czas wykonania: </label>
                    <input type="text" id="preparationTime" />
                    <label> Załaduj zdjęcie: </label>
                    <input type="file" id="file"/>
                    <label> Składniki: </label>
                    <div id="dishComponents">
                        <template>
                            <div class="component">
                                <i class="fa fa-minus minus"> </i>
                                <!--<i class="fa fa-eye eye"> </i>-->
                                <input class="componentId" type="hidden"/>
                                <h3 class="componentName"> </h3>
                            </div>
                        </template> 
                    </div> 
                    <label> Sposób przygotowania: </label>
                    <textarea rows="4" cols="40" id="description"> </textarea>
                    <button id="createDishButton"> "Stwórz danie" </button>
                <!--</form>-->
            </div>

            <div class="col-xs-10 col-sm-3 col-xs-offset-1 rightBox">
                <label> Dodaj składniki: </label>
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
                            <h3 class="componentName"> </h3>
                        </div>
                    </template> 
                </div>  

            </div>
        </div>
    </div>


    <script src="public/js/createDish.js"></script>
</body>
      
</html>
  
  