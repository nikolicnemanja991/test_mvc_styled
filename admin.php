<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if (!$controller->isAdmin()) {
            header('Location: index.php');
        } else {
            $users = $controller->getUsers();
            $page_name = basename(__FILE__, '.php');
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
    <style>
        form {display: inline}
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <br><br>
        <h1 class="text-center">Admin Page</h1>
        <br>
        <h2>List of users:</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user) { ?>
                    <tr>
                        <th scope="row"><?= $user['id']; ?></th>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td>
                            <form action="user.php" method="GET">
                                <input type="hidden" name="id" value='<?= $user['id'] ?>'>
                                <input type="hidden" name="action" value='update-user'>
                                <input type="submit" value='Edit' class="btn btn-dark">
                            </form>
                        </td>
                        <td>
                            <form action="http-handler.php" method="POST">
                                <input type="hidden" name="id" value='<?= $user['id'] ?>'>
                                <input type="hidden" name="action" value='delete-user'>
                                <input type="submit" value='Delete' class="btn btn-dark">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br><br>

        <h2>Add new user:</h2>
        <form action="http-handler.php" method="POST">
            <div class="mb-3">
                <label for="usernameInput1" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="usernameInput1">
            </div>
            <div class="mb-3">
                <label for="passwordInput1" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="passwordInput1">
            </div>
            <div class="mb-3">
                <label for="roleSelect" class="form-label">Role</label>
                <select name="role" id="roleSelect" class="form-select">
                    <option value="user">User</option>
                    <option value="moderator">Moderator</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <input type="hidden" name="action" value="add-user">
            <input type="submit" value="Save User" class="btn btn-dark">
        </form>

        <br><br>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>