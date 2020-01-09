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
        <link rel="stylesheet" href="public/css/loginStyle.css" type="text/css"/>
    </head>
    <body>
        <div class="container-fluix">
            <div class="row row-no-gutters">
                <div class="col-xs-3 col-sm-4"></div>
                <div class="col-xs-6 col-sm-4"> 
                    <div class="logo">
                        <img class="imgLogo" src="public/img/fullLogo.png" alt="logo"/>
                    </div>
                    <form action="?page=login" method="POST">
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
                        <input class="textInput" name="email" type="email" placeholder="e-mail"/>
                        <input class="textInput" name="password" type="password" placeholder="hasło" />
                        <input class="submitInput" type="submit" value="Zaloguj się" />
                    </form>
                </div>
                <div class="col-xs-3 col-sm-4"></div>
            </div>
        </div>
    </body>
    
</html>

