<?php

$router->get('/', 'controller/index.php');
$router->get('/register', 'controller/Register/show.php');
$router->post('/create', 'controller/Register/create.php');