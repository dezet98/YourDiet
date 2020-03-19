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
    <link rel="stylesheet" href="public/css/groceryList.css" type="text/css"/>
</head>

<body>
    <div class="mobileMenu"> 
        <i class="fa fa-bars menu-trigger" onclick="menuTrigger()"></i>
        <label> Twój plan </label>
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
            <div class="col-xs-10 col-xs-offset-1 mainBox">
                <div class="days">
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                    <button class="day" data-status="false"> </button>
                </div>
                <div class="meter">
                    <input type="number" class="amountOfPeople" min="1" value="1" step="1"/> 
                </div>

                <table id="table">
                    <tr>
                        <th>Nazwa</th>
                        <th>Ilość</th>
                    </tr>
                    <template>
                        <tr>
                            <input class="id" type="hidden"/>
                            <th class="name"></td>
                            <th class="amount"></td>
                        </tr>
                    </template>
                </table>
            </div> 
        </div>
    </div>

    <script src="public/js/groceryList.js"></script>
</body>
      
</html>
  
  