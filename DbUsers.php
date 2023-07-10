<?php

require_once 'pdo.php';


class DbUsers {
    
    function getDbUser($username, $password){
        global $pdo;
        $sql = 'SELECT * FROM users WHERE username=:username AND password=:password';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'username' => $username,
            'password' => $password
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function getDbUsers(){
        global $pdo;
        $sql = 'SELECT * FROM users';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } 

    function deleteDbUser($id){
        global $pdo;
        $sql = 'DELETE FROM users WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
    }

    function addDbUser(array $userData){
        global $pdo;
        $sql = 'INSERT INTO users (username, password, role) VALUES (:username, :password, :role)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'username' => $userData['username'],
            'password' => sha1($userData['password']),
            'role' => $userData['role']
        ]);
    }

    function updateDbUser(array $userData){
        global $pdo;
        $sql = 'UPDATE users SET username=:username, password=:password, role=:role WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'username' => $userData['username'],
            'password' => sha1($userData['password']),
            'role' => $userData['role'],
            'id' => $userData['id']
        ]);
    } 

    function getDbUserById($id) {
        global $pdo;
        $sql = 'SELECT * FROM users WHERE id=:id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }



}




?>