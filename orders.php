<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if ($controller->isUser()) {
            header('Location: index.php');
        } else {
            // Stay here
            $orders = $controller->getOrders();
            $usersStatistics = $controller->getUsersStatistics();
            $orderTypesStatistics = $controller->getOrderTypesStatistics();
            $orderNamesStatistics = $controller->getOrderNamesStatistics();
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
    <!-- <style>
        form {display: inline}
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style> -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <br><br>
        <h1 class="text-center">Orders Page</h1>
        <br>

        <h2>Orders List:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order's ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order) { ?>
                    <?php if(!empty($order['order_id'])){ ?>
                        <tr>
                            <td><?= $order['order_id']; ?></td>
                            <td><?= $order['username']; ?></td>
                            <td><?= '$' . $order['price']; ?></td>
                            <td><?= $order['time']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <br>

        <h2>User's Statistics:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User's ID</th>
                    <th scope="col">Monay spent per User</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usersStatistics as $userStat) { ?>
                    <tr>
                        <td><?= $userStat['user_id']; ?></td>
                        <td><?= '$' . $userStat['monay_spent']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>

        <h2>Order's Type Statistics:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order's Type</th>
                    <th scope="col">Monay spent per Product Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orderTypesStatistics as $orderTypeStat) { ?>
                    <tr>
                        <td><?= $orderTypeStat['product_type']; ?></td>
                        <td><?= '$' . $orderTypeStat['total_price_per_type']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>

        <h2>Order's Neme Statistics:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order's Type</th>
                    <th scope="col">Total Selled</th>
                    <th scope="col">Monay spent per Product Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orderNamesStatistics as $orderNameStat) { ?>
                    <tr>
                        <td><?= $orderNameStat['product_name']; ?></td>
                        <td><?= $orderNameStat['total_quantity']; ?></td>
                        <td><?= '$' . ($orderNameStat['total_quantity']*$orderNameStat['price']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <br><br><br>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    
</body>
</html>