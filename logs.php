<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if (!$controller->isAdmin()) {
            header('Location: index.php');
        } else {
            $logs = $controller->getLogs();
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <br><br>
        <h1 class="text-center">Logs Page</h1>
        <br>
        <h2>List of logs:</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Log</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log) { ?>
                    <tr>
                        <th scope="row"><?= $log['id']; ?></th>
                        <td><?= $log['log']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>




    
</body>
</html>