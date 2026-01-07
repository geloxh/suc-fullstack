<?php
    session_start();

    $router = require_once __DIR__ . '/../bootstrap/app.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $router->dispatch($method, $uri);

?>