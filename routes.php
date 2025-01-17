<?php

$router->get('/', 'controller/index.php')->only('auth');
$router->get('/register', 'controller/Register/show.php')->only('guest');
$router->post('/create', 'controller/Register/create.php');