<?php
$uri = $_GET['uri'] ;
if ($uri === '' || $uri === '/') {
    // Jika diakses root ("/"), tampilkan halaman home
    include 'Views/index.php';
    exit;
}

list($controllerName, $method) = explode('/', $uri);
$controllerClass = ucfirst($controllerName) . 'Controller';
if ($method === '') $method = 'index';
require_once "Controllers/{$controllerClass}.php";

$controller = new $controllerClass;
$controller->$method();
