<?php

function base_path($path){
    return BASE_PATH . $path;
}

function view($path, $attributes) {

    extract($attributes);

    require base_path('views/'.$path);
}

function abort($code = 404) {

    http_response_code($code);
    require base_path("views/{$code}.php");

}

function redirect($path) {
    header("Location: {$path}");
    exit();
}

function old($key, $default = '') {
    return Core\Session::get('old')[$key] ?? $default;
}