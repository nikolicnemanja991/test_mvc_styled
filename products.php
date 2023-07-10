<?php

    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if ($controller->isUser()) {
            header('Location: index.php');
        } else {
            $products = $controller->getProducts();
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
        <h1 class="text-center">Products Page</h1>
        <br>
        <h2>List of products:</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Type</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) { ?>
                    <tr>

                        <th scope="row"><?= $product['id']; ?></th>
                        <td><?= $product['name']; ?></td>
                        <td><?= $product['type']; ?></td>
                        <td><?= '$' . $product['price']; ?></td>
                        <td>
                            <form action="product.php" method="GET">
                                <input type="hidden" name="id" value='<?= $product['id'] ?>'>
                                <input type="hidden" name="action" value='update-product'>
                                <input type="submit" value='Edit' class="btn btn-dark">
                            </form>
                        </td>
                        <td>
                            <form action="http-handler.php" method="POST">
                                <input type="hidden" name="id" value='<?= $product['id'] ?>'>
                                <input type="hidden" name="action" value='delete-product'>
                                <input type="submit" value='Delete' class="btn btn-dark">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <br>

        <h2>Add new product:</h2>
        <form action="http-handler.php" method="POST">
            <div class="mb-3">
                <label for="productNameInput1" class="form-label">Product Name:</label>
                <input type="text" name="name" class="form-control" id="productNameInput1">
            </div>
            <div class="mb-3">
                <label for="productTypeInput1" class="form-label">Product Type:</label>
                <input type="text" name="type" class="form-control" id="productTypeInput1">
            </div>
            <div class="mb-3">
                <label for="productPriceInput1" class="form-label">Product Name:</label>
                <input type="text" name="price" class="form-control" id="productPriceInput1">
            </div>
            <input type="hidden" name="action" value="add-product">
            <input type="submit" value="Save Product" class="btn btn-dark">
        </form>

        <br><br><br>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>


