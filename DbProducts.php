<?php

require_once 'pdo.php';


class DbProducts {

    function getDbProducts(){
        global $pdo;
        $sql = 'SELECT * FROM products';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteDbProduct($id){
        $product = $this->getDbProductById($id);
        global $pdo;
        $sql = 'DELETE FROM products WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);

        // Logs
        $log = $_SESSION['role'] . ' deleted Product ' . $product['name'] . ' with id ' . $product['id'];
        $statement = $pdo->prepare('INSERT INTO logs (log) VALUE (:log)');
        $statement->execute([
            'log' => $log
        ]);
    }

    function addDbProduct(array $productData){
        global $pdo;
        $sql = 'INSERT INTO products (name, type, price) VALUES (:name, :type, :price)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'name' => $productData['name'],
            'type' => $productData['type'],
            'price' => $productData['price']
        ]);

        // Logs
        $productId = $pdo->lastInsertId();
        $log = $_SESSION['role'] . ' added Product ' . $productData['name'] . ' with id ' . $productId;
        $statement = $pdo->prepare('INSERT INTO logs (log) VALUE (:log)');
        $statement->execute([
            'log' => $log
        ]);
    }

    function updateDbProduct(array $productData){
        global $pdo;
        $sql = 'UPDATE products SET name=:name, type=:type, price=:price WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'name' => $productData['name'],
            'type' => $productData['type'],
            'price' => $productData['price'],
            'id' => $productData['id']
        ]);

        // Logs
        $log = $_SESSION['role'] . ' updated Product ' . $product['name'] . ' with id ' . $productData['id'];
        $statement = $pdo->prepare('INSERT INTO logs (log) VALUE (:log)');
        $statement->execute([
            'log' => $log
        ]);
    } 

    function getDbProductById($id) {
        global $pdo;
        $sql = 'SELECT * FROM products WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function addDbOrder(array $orderData, int $userId, $total_price) {
        global $pdo;
        try {
            $pdo->beginTransaction();
            $statement = $pdo->prepare('INSERT INTO orders (user_id, price) VALUES (:user_id, :price)');
            $statement->execute([
                'user_id' => $userId,
                'price' => $total_price
            ]);
            $orderId = $pdo->lastInsertId();
    
            $statement = $pdo->prepare('INSERT INTO order_items(order_id, product_id, quantity)
                                        VALUES (:order_id, :product_id, :quantity)');
            foreach($orderData as $productId => $quantity) {
                $statement->execute([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
            $pdo->commit();
        } catch (\PDOException $e) {
            $pdo->rollBack();
            die($e->getMessage());
        }
    }

    function getDbOrders() {
        global $pdo;
        $sql = 'SELECT 
                o.order_id as order_id,
                u.username as username,
                o.price as price,
                o.time as time  
                FROM users u 
                LEFT JOIN orders o ON u.id = o.user_id';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getDbLogs(){
        global $pdo;
        $sql = 'SELECT * FROM logs';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getDbUsersStatistics() {
        global $pdo;
        $sql = 'SELECT user_id, SUM(price) as monay_spent FROM orders GROUP BY user_id';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getDbOrderTypesStatistics() {
        global $pdo;


        $sql = 'SELECT product_type, SUM(total_price_per_name) as total_price_per_type FROM
                (SELECT p.price as price, p.name as product_name, p.type as product_type,
                SUM(oi.quantity) as total_quantity_per_name,
                SUM(oi.quantity)*p.price as total_price_per_name
                FROM orders o 
                LEFT JOIN order_items oi ON o.order_id = oi.order_id
                LEFT JOIN products p ON oi.product_id = p.id GROUP BY p.name) as table1 GROUP BY product_type';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);  
    }

    function getDbOrderNamesStatistics() {
        global $pdo;
        $sql = 'SELECT
            p.price as price, 
            p.name as product_name,
            SUM(oi.quantity) as total_quantity
            FROM orders o 
            LEFT JOIN order_items oi ON o.order_id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            GROUP BY p.name';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);  
    }

}




?>