<?php

include_once 'Controller.php';

$controller = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'login') {
        $controller->loginUser($_POST);
    } else if ($_POST['action'] === 'logout') {
        $controller->logoutUser($_POST);
    } else if ($_POST['action'] === 'add-user') {
        $controller->addUser($_POST);
    } else if ($_POST['action'] === 'update-user') {
        $controller->updateUser($_POST);
    } else if ($_POST['action'] === 'delete-user') {
        $controller->deleteUser($_POST['id']);
    } else if ($_POST['action'] === 'add-product') {
        $controller->addProduct($_POST);
    } else if ($_POST['action'] === 'update-product') {
        $controller->updateProduct($_POST);
    } else if ($_POST['action'] === 'delete-product') {
        $controller->deleteProduct($_POST['id']);
    } else if ($_POST['action'] === 'add-product-into-cart') {
        $controller->addProductToCart($_POST);
    } else if ($_POST['action'] === 'remove-product-from-cart') {
        $controller->removeProductFromCart($_POST);
    } else if ($_POST['action'] === 'complete-order') {
        $controller->completeOrder($_POST['total_sum']);
    }



}



?>