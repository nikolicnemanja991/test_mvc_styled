<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if (!$controller->isAdmin()) {
            header('Location: index.php');
        } else {
            // Stay on this page
            $user = $controller->getUserById($_GET['id']);
        }
    } else {
        header('Location: login.php');
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
        <h2>Update user:</h2>


        <form action="http-handler.php" method="POST">
            <div class="mb-3">
                <label for="usernameInput1" class="form-label">Username:</label>
                <input type="text" name="username" value='<?= $user['username'] ?>' class="form-control" id="usernameInput1">
            </div>
            <div class="mb-3">
                <label for="roleSelect" class="form-label">Role</label>
                <select name="role" id="roleSelect" class="form-select">
                    <option value="user" <?= ($user['role'] === 'user') ? 'selected' : '' ?> >User</option>
                    <option value="moderator" <?= ($user['role'] === 'moderator') ? 'selected' : '' ?> >Moderator</option>
                    <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?> >Admin</option>
                </select>
            </div>
            <input type="hidden" name="id" value='<?= $user['id'] ?>'>
            <input type="hidden" name="action" value="update-user">
            <input type="submit" value="Save User" class="btn btn-dark">
        </form>

        <br><br>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    
</body>
</html>