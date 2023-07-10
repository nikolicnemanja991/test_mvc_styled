<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        header('Location: index.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <br><br>
        <h1>Login page</h1>
        <form action="http-handler.php" method="POST">
            <div class="mb-3">
                <label for="usernameInput1" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="usernameInput1">
            </div>
            <div class="mb-3">
                <label for="passwordInput1" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="passwordInput1">
            </div>
            <input type="hidden" name="action" value="login">
            <input type="submit" name="login" value="Login" class="btn btn-dark">
        </form>

    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>