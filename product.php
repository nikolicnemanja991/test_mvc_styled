<?php
    require_once 'Controller.php';

    $controller = new Controller();
    if ($controller->isLogged()) {
        if (!$controller->isAdmin()) {
            header('Location: index.php');
        } else {
            // Stay on this page
            $product = $controller->getProductById($_GET['id']);
            
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
        <h2>Update product:</h2>
        
        <form action="http-handler.php" method="POST">
            <div class="mb-3">
                <label for="productNameInput1" class="form-label">Product Name:</label>
                <input type="text" name="name" class="form-control" id="productNameInput1" value='<?= $product['name'] ?>'>
            </div>
            <div class="mb-3">
                <label for="productTypeInput1" class="form-label">Product Type:</label>
                <input type="text" name="type" class="form-control" id="productTypeInput1" value='<?= $product['type'] ?>'>
            </div>
            <div class="mb-3">
                <label for="productPriceInput1" class="form-label">Product Name:</label>
                <input type="text" name="price" class="form-control" id="productPriceInput1" value='<?= $product['price'] ?>'>
            </div>
            <input type="hidden" name="id" value='<?= $product['id'] ?>'>
            <input type="hidden" name="action" value="update-product">
            <input type="submit" value="Save Product" class="btn btn-dark">
        </form>


    </div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
</body>
</html>