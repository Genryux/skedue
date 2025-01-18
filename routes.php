<?php

$router->get('/', 'index.php');
$router->get('/register', 'Register/create.php');

$router->post('/create', 'Register/store.php');
$router->post('/login', 'session/store.php');

$router->delete('/logout', 'session/destroy.php');