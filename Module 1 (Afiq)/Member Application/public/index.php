<?php
// Basic Router
$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';
require_once '../app/controllers/UserController.php';
require_once '../app/models/User.php';
require_once '../app/core/Autoload.php';

use App\Controllers\UserController;

$controller = new UserController();

if ($uri === '' && $method === 'GET') {
    $controller->index();
} elseif ($uri === 'create' && $method === 'GET') {
    $controller->create();
} elseif ($uri === 'store' && $method === 'POST') {
    $controller->store();
} elseif ($uri === 'login' && $method === 'GET') {
    $controller->login();
} elseif ($uri === 'login' && $method === 'POST') {
    $controller->login();
}elseif ($uri === 'logout' && $method === 'GET') {
    $controller->logout();
}elseif ($uri === 'register' && $method === 'GET') {
    $controller->register();
}elseif ($uri === 'register' && $method === 'POST') {
    $controller->register();
}  elseif (preg_match('/edit\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $controller->edit($matches[1]);
} elseif (preg_match('/update\/(\d+)/', $uri, $matches) && $method === 'POST') {
    $controller->update($matches[1]);
} elseif (preg_match('/delete\/(\d+)/', $uri, $matches) && $method === 'POST') {
    $controller->delete($matches[1]);
} elseif ($uri === 'member' && $method === 'GET') {
    $controller->applyForMembership(); // Call the method in your controller to show the form
} elseif ($uri === 'member' && $method === 'POST'){
    $controller->applyForMembership();
} elseif ($uri === 'review_applications' && $method === 'GET') {
    $controller->reviewApplications(); // Admin routes for reviewing applications
} else {
    http_response_code(404);
    echo "Page not found.";
}

session_start();

// Ensure this is done before routing
if (!isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'], ['/login', '/register'])) {
    header('Location: /login');
    exit;
}







