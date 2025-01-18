<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);
$form = new LoginForm();

$email = $_POST['email'];
$password = $_POST['password'];


if ($form->validate($email, $password)) {

    if ((new Authenticator)->attemp($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email and password.');
}


Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $email
]);

redirect('/');

// return view('index.view.php', [
//     'errors' => $form->errors()
// ]);


