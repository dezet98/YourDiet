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
        <link rel="stylesheet" href="public/css/registerStyle.css" type="text/css"/>
    </head>
    <body>
        <div class="container-fluix">
            <div class="row row-no-gutters">
                <div class="col-xs-6 col-sm-4 col-xs-offset-3 col-sm-offset-4"> 
                    <div class="logo">
                        <img class="imgLogo" src="public/img/fullLogo.png" alt="logo"/>
                    </div>
                    <form method="POST">
                        <label>
                            <?php
                                if(isset($messages))
                                {
                                    foreach($messages as $message)
                                    {
                                        echo $message;
                                    }
                                } else {
                                    echo ("Twój e-mail:");
                                }
                            ?>
                        </label>
                        <input class="textInput" name="email" type="email"/>
                        <label>Nazwa użytkownika:</label>
                        <input class="textInput" name="nickname" type="text"/>
                        <label>Hasło:</label>
                        <input class="textInput" name="password" type="password"/>
                        <input class="submitInput" type="submit" value="Zarejestruj się" />
                    </form>
                </div>
            </div>
        </div>

        <script src="public/js/register.js"></script>
    </body>
    
</html>

