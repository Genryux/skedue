<?php

//check for inputs

//if no input show error message

//if there's input

//get the value of input

//insert to db

//redirect to the previous page
$config = require(base_path('config.php'));

use Core\Database;

$db = new Database($config);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = "asd";

    $fetchUser = $db->query('SELECT * FROM user_tbl WHERE email = :email', [
        'email' => $email
    ])->find();


    if ($fetchUser) {

        header('Location: /');
        exit();

    } else {
        
        $stmt = $db->query('INSERT INTO user_tbl (name, email, password) VALUES (:name, :email, :password)', [
            'name' => $name, 
            'email' => $email,
            'password' => $password
        ]);
     
        $_SESSION['user'] = [
            'email' => $email
        ];

        header('Location: /');
        exit();
        
    }





}