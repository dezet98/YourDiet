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
            <table class="table mt-4 text-light">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nickname</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row"><?= $user->getId_user(); ?></th>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= $user->getNickname(); ?></td>
                    </tr>
                </tbody>
                <tbody class="users">
                </tbody>
            </table>
            <button class="btn-primary btn-lg ml-0" type="button">
                Get all users    
            </button>
            <label> <label>
        </div>
    </div>

    <script src="public/js/admin.js"></script>
</body>

</html>