<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>YourDiet</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="public/css/globalStyle.css" type="text/css"/>
        <link rel="stylesheet" href="public/css/mainStyle.css" type="text/css"/>
    </head>

    <body>
        <div class="mobileMenu"> 
            <button id="menu-trigger" onclick="menuTrigger()"> ham </button>
            <label> Twój plan <label>
        </div>

        <div class="menu"> 
            <div class="menuLogo">
                <img class="imgLogo" style="width: 100%; height: auto;" src="public/img/fullLogo.png" alt="logo"/>
            </div>
            <div class="menuList">
                <a class="submitInput" href="#">Twój plan</a>
                <a class="submitInput" href="#">Lista zakupów</a>
                <a class="submitInput" href="#">Stwórz danie</a>
                <a class="submitInput" href="#">Szukaj dania</a>
                <a class="submitInput" href="#">Porady</a>
            </div>
            <div class="menuLogOut">
                <form action="?page=logOut" method="POST">
                    <input type="submit" value="Wyloguj się"/>
                </form>
            </div> 
        </div>

        <div class="container-fluix">
            <div class="row row-no-gutters" style="height: 15%;">
                <div class="col-xs-1"></div>
                <div class="col-xs-10 daysMenu"> 
                    <a class="submitInput" href="#">Poniedziałek</a>
                    <a class="submitInput" href="#">Wtorek</a>
                    <a class="submitInput" href="#">Środa</a>
                    <a class="submitInput" href="#">Czwartek</a>
                    <a class="submitInput" href="#">Piątek</a>
                    <a class="submitInput" href="#">Sobota</a>
                    <a class="submitInput" href="#">Niedziela</a>
                </div>
                <div class="col-xs-1"></div>
            </div>
            <div class="row row-no-gutters" style="height: 85%;">
                <div class="col-xs-1" style="height: 100%;"></div>
                <div class="col-xs-10 col-sm-3 schedule">
                    <label>Plan na Poniedziałek</label>
                    <div class="dish">
                        <div class="imgDish"></div>
                        <h4> Krewetki w sosie bursztynowym</h4>
                        <h6> 40 minut</h6>
                        <h6> 300 kcal</h6> 
                        <h6> 4 gwiazdki<h3> 
                    </div>
                </div>
                <div class="col-xs-0 col-sm-1"></div>
                <div class="col-xs-10 col-sm-6 content">
                    <div class="contentOption"> 
                        <button class="submitInput"> Pokaż kalorie</button>
                        <button class="submitInput"> Plan</button>
                    </div>
                    <div class="summary">
                        <div class="box">
                            <label id="name">Tłuszcz</label>
                            <label id="amount">4g</label id="amount">
                        </div>
                        <div class="box">
                            <label id="name">Tłuszcz</label id="name">
                            <label id="amount">4g</label id="amount">
                        </div>
                        <div class="box">
                            <label id="name">Tłuszcz</label id="name">
                            <label id="amount">4g</label id="amount">
                        </div>
                        <div class="box">
                            <label id="name">Tłuszcz</label id="name">
                            <label id="amount">4g</label id="amount">
                        </div>
                        <div class="box">
                            <label id="name">Tłuszcz</label id="name">
                            <label id="amount">4g</label id="amount">
                        </div>
                        <div class="box">
                            <label id="name">Tłuszcz</label id="name">
                            <label id="amount">4g</label id="amount">
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-1"></div>
            </div>

            <script src="public/js/main.js"></script>
      </body>
      
  </html>
  
  