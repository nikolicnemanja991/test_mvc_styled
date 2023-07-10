<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if ($controller->isUser()) {
            $products = $controller->getProducts();
            $cartItems = $controller->getCartItems();
            $total_sum = 0;
            $page_name = basename(__FILE__, '.php');
        } else {
            header('Location: index.php');  
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
        <h1 class="text-center">Shooping Page</h1>
        <br>

        <h2>List of products:</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) { ?>
                    <tr>
                        
                        <td><?= $product['name']; ?></td>
                        <td><?= $product['type']; ?></td>
                        <td><?= '$' . $product['price']; ?></td>
                        <td>
                            <form action="http-handler.php" method='POST'>
                                <input type='hidden' name='action' value='add-product-into-cart'>
                                <input type='hidden' name='id' value='<?= $product['id'] ?>'>
                                <input type='submit' value='+' class="btn btn-dark">
                            </form>
                            <?php if (isset($cartItems[$product['id']])) { ?>
                                <form action="http-handler.php" method='POST'>
                                    <input type='hidden' name='action' value='remove-product-from-cart'>
                                    <input type='hidden' name='id' value='<?= $product['id'] ?>'>
                                    <input type='submit' value='-' class="btn btn-dark">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>
        <h2>Shooping Cart:</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cartItems as $cartItem) { ?>
                    <tr>
                        <td><?= $cartItem['name'] ?></td>
                        <td><?= $cartItem['type'] ?></td>
                        <td><?= $cartItem['quantity'] ?></td>
                        <td><?= '$' . $cartItem['total_item_price'] ?></td>
                    </tr>
                    <?php 
                        $total_sum += $cartItem['total_item_price'];
                    ?>
                <?php } ?>
            </tbody>
        </table>
        <h3>Total Price: <?= '$' . $total_sum ?></h3>
        
        <br>

        <?php if (!empty($cartItems)) { ?>
            <form method='POST' action='http-handler.php'>
                <input type='hidden' name='total_sum' value='<?= $total_sum ?>]'>
                <input type='hidden' name='action' value='complete-order'>
                <input type='submit' value='Complete order' class="btn btn-dark">
            </form>
        <?php } ?>

        <br><br><br>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>