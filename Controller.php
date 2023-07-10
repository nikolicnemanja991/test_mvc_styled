<?php

session_start();
require_once 'DbUsers.php';
require_once 'DbProducts.php';

class Controller {

    private DbUsers $usersDb;
    private DbProducts $productsDb;

    function __construct() {
        $this->usersDb = new DbUsers();
        $this->productsDb = new DbProducts();
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ------------------------------------------- USERS METHODS ------------------------------------------- //
    // ----------------------------------------------------------------------------------------------------- //

    function loginUser(array $userData) {
        if(isset($userData['username']) && isset($userData['password']) 
            && $user = $this->usersDb->getDbUser($userData['username'], sha1($userData['password']))
        ){            
            $_SESSION['logged'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            if($user['role'] === 'admin'){
                header('Location: index.php');
            } else {
                header('Location: index.php');
            }
        } else {
            header('Location: login.php');
        }
    }

    function logoutUser(){
        session_unset();
        session_destroy();
        header('Location: login.php');
    }

    function isLogged(){
        return isset($_SESSION['logged']);
    }

    function isAdmin(){
        if($_SESSION['role'] === 'admin'){
            return true;
        } else {
            return false;
        }
    }

    function isUser(){
        if($_SESSION['role'] === 'user'){
            return true;
        } else {
            return false;
        }
    }

    function getUsers(){
        return $this->usersDb->getDbUsers();
    }

    function deleteUser($id){
        $this->usersDb->deleteDbUser($id);
        header('Location: admin.php');
    }

    function addUser(array $userData){
        $this->usersDb->addDbUser($userData);
        header('Location: admin.php');
    }

    function updateUser(array $userData){
        $this->usersDb->updateDbUser($userData);
        header('Location: admin.php');
    }

    function getUserById($id) {
        return $this->usersDb->getDbUserById($id);
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ------------------------------------------ PRODUCTS METHODS ----------------------------------------- //
    // ----------------------------------------------------------------------------------------------------- //

    function getProducts(){
        return $this->productsDb->getDbProducts();
    }

    function deleteProduct($id){
        $this->productsDb->deleteDbProduct($id);
        header('Location: products.php');
    }

    function addProduct(array $productData){
        $this->productsDb->addDbProduct($productData);
        header('Location: products.php');
    }

    function updateProduct(array $productData){
        $this->productsDb->updateDbProduct($productData);
        header('Location: products.php');
    }

    function getProductById($id) {
        return $this->productsDb->getDbProductById($id);
    }

    function getLogs() {
        return $this->productsDb->getDbLogs();
    }

    // ----------------------------------------------------------------------------------------------------- //
    // -------------------------------------------- CART METHODS ------------------------------------------- //
    // ----------------------------------------------------------------------------------------------------- //

    function getCartItems() {
        $items = isset($_COOKIE['order']) ? unserialize($_COOKIE['order']) : [];
        $products = $this->getProducts();
        $itemsData = [];
        foreach($items as $productId => $quantity) {
            foreach ($products as $product) {
                if ($product['id'] == $productId) {
                    $itemsData[$productId] = [
                        'name' => $product['name'],
                        'type' => $product['type'],
                        'quantity' => $quantity,
                        'total_item_price' => ($quantity*$product['price'])
                    ];
                    break;
                }
            }
        }
        return $itemsData;
    }

    function addProductToCart(array $data) {
        $productId = $data['id'];
        if (!isset($_COOKIE['order'])) {
            $order = [];
        } else {
            $order = unserialize($_COOKIE['order']);
        }
        if (!isset($order[$productId])) {
            $order[$productId] = 1;
        } else {
            $order[$productId]++;
        }
        setcookie('order', serialize($order), time() + 86400);
        header('Location: shopping.php');
    }

    function removeProductFromCart(array $data) {
        $productId = $data['id'];
        if (!isset($_COOKIE['order'])) {
            $order = [];
        } else {
            $order = unserialize($_COOKIE['order']);
        }
        if (isset($order[$productId])) {
            $order[$productId]--;
            if ($order[$productId] === 0) {
                unset($order[$productId]);
            }
        }
        setcookie('order', serialize($order), time() + 86400);
        header('Location: shopping.php');
    }

    function completeOrder($total_price) {
        if ($this->isLogged() && $this->isUser()) {
            $this->productsDb->addDbOrder(
                unserialize($_COOKIE['order']),
                $_SESSION['logged'],
                $total_price
            );
        }
        $msg="ORDER STATUS: Order completed.";
        setcookie('order', serialize([]));
        header('Location: index.php?msg=' . $msg);
    }

    function getOrders() {
        return $this->productsDb->getDbOrders();
    }

    // ----------------------------------------------------------------------------------------------------- //
    // ----------------------------------------- STATISTICS METHODS ---------------------------------------- //
    // ----------------------------------------------------------------------------------------------------- //
    
    function getUsersStatistics(){
        return $this->productsDb->getDbUsersStatistics();
    }

    function getOrderTypesStatistics(){
        return $this->productsDb->getDbOrderTypesStatistics();
    }

    function getOrderNamesStatistics(){
        return $this->productsDb->getDbOrderNamesStatistics();
    }    

}

?>