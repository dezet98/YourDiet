<?php
    if(!isset($_SESSION['id'], $_SESSION['role'])) {
        die("Nie jesteś zalogowany!");
    }

    if($_SESSION['role'] != 'ROLE_ADMIN') {
        die("Nie masz uprawnień aby być na tej stronie!");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourDiet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

</head>

<body>
    <div class="container">
        <div class="col-6">
            <button class="btn-primary btn-lg ml-0" type="button">
                Get all users    
            </button>
            
            <a href="?page=yourSchedule" style="text-decoration: none;">
                <button class="btn-primary btn-lg ml-0">Wróć do YourSchedule</button>
            </a>
            
            <table class="table mt-4 text-light">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nickname</th>
                    </tr>
                </thead>
                <tbody id="allUsers">
                    <template>
                        <tr id="row">
                        <th id="id_user"> </th>
                        <td id="email"> </td>
                        <td id="nickname"> </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <script src="public/js/admin.js"></script>
</body>

</html>