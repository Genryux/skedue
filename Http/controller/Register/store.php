<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$name = $_POST['name'];
$email = $_POST['email'];
$password = "1234567";

$errors = [];

if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (! empty($errors)) {
    return view('Register/create.view.php', [
        'errors' => $errors
    ]);
}

$fetchUser = $db->query('SELECT * FROM user_tbl WHERE email = :email', [
    'email' => $email
])->find();

if ($fetchUser) {

    redirect('/');

} else {
    
    $stmt = $db->query('INSERT INTO user_tbl (name, email, password) VALUES (:name, :email, :password)', [
        'name' => $name, 
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
    
    $_SESSION['user'] = [
        'email' => $email
    ];

    (new Authenticator)->login(['email' => $email]);

    redirect('/');
    
}


