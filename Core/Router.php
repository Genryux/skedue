<?php

namespace Core;

use Core\Middleware\Middleware;

class Router {

    public $routes = [];

    public function add($method, $uri, $controller) {
        //push the uri, controller, and method in routes array when this object gets called
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;

    }

    public function get($uri, $controller) {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller) {
        return $this->add('PATCH', $uri, $controller);
    }

    public function only($key) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method) {
        //if requested uri in route array exist and method in route array matches the requested method, 
        //then require the equivalent controller
        foreach($this->routes as $route) {

            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                Middleware::resolve($route['middleware']);

                return require base_path('Http/controller/'.$route['controller']);
                
            }
            
        }

        $this->abort();
    }

    protected function abort($code = 404) {

        http_response_code($code);
        require base_path("views/{$code}.php");

    }

}
