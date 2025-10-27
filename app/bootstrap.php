<?php

use Controllers\URLController;
use Models\URLRepository;

$dbConfig = require_once __DIR__ . '/../config/db.php';
$pdo = new PDO('sqlite:' . $dbConfig['sqlite_path']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$viewsConfig = require_once __DIR__ . '/../config/views.php';

require_once __DIR__ . '/Controllers/Controller.php';
require_once __DIR__ . '/Controllers/URLController.php';
require_once __DIR__ . '/Models/Repository.php';
require_once __DIR__ . '/Models/URLRepository.php';

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(count(explode('/', $uri)) > 2){
    http_response_code(404);
}

$repository = new URLRepository($pdo);
$controller = new URLController($viewsConfig, $repository);

match (true){
    $method=== "GET" && $uri === '/' => $controller->index(),
    $method=== "GET" && $uri === '/create' => $controller->create(),
    $method=== "POST" && $uri === '/store' => $controller->store($_POST),
    $method=== "GET" && preg_match('/^\/redirect\/(\w+)$/', $uri, $matches) => $controller->redirect($matches[1]),
    default => http_response_code(404)
};


