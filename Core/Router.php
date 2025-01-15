<?php

// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// $routes = [
//     '/index' => './controller/index.php',
//     '/subject' => './controller/subject.php',
//     '/notes' => './controller/notes.php',
//     '/tasks' => './controller/tasks.php'
// ];

// function routeToController($uri, $routes) {
//     if (array_key_exists($uri, $routes)) {
//         require $routes[$uri];
//     } else { 
//         abort();
//     }
// }

// function abort($code = 404) {
//     http_response_code($code);

//     require("./views/$code.php");

//     die();
// }


// routeToController($uri, $routes);
namespace Core;

class Router {

    public $routes = [];

    public function add($method, $uri, $controller) {
        //push the uri, controller, and method in routes array when this object gets called
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        $this->add('GET', $uri, $controller);
    }

    public function patch($uri, $controller) {
        $this->add('GET', $uri, $controller);
    }

    public function route($uri, $method) {
        //if requested uri in route array exist and method in route array matches the requested method, 
        //then require the equivalent controller
        foreach($this->routes as $route) {

            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
            
        }

        $this->abort();
    }

    protected function abort($code = 404) {

        http_response_code($code);
        require base_path("views/{$code}.php");

    }

}
