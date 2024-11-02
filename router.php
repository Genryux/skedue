<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/index' => './controller/index.php',
    '/subject' => './controller/subject.php',
    '/notes' => './controller/notes.php',
    '/tasks' => './controller/tasks.php'
];

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else { 
        abort();
    }
}

function abort($code = 404) {
    http_response_code($code);

    require("./views/$code.php");

    die();
}


routeToController($uri, $routes);
