<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>YourDiet</title>
        <link rel="stylesheet" href="public/css/globalStyle.css" type="text/css"/>
        <link rel="stylesheet" href="public/css/startStyle.css" type="text/css"/>
    </head>

    <body>
        <div id="logoAndOption">
            <div id="logo"> 
                <img class="imgLogo" src="public/img/fullLogo.png" alt="logo"/>
            </div>
            <div id="option">
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
                <a href="?page=login">
                    <input class="submitInput" type="submit" value="Zaloguj się"/>
                </a>
                <a href="?page=register">
                    <input class="submitInput" type="submit" value="Zarejestruj się"/>
                </a>
                <a href="?page=register">
                    <input class="submitInput" type="submit" value="Zaloguj się jako gość"/>
                </a>
            </div>
        </div>
        <div id="content">
        </div>
    </body>
    
</html>

