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

if($uri === 'login' && $method === 'GET') {
    $controller->login();
} elseif ($uri === 'login' && $method === 'POST') {
    $controller->login();
} elseif ($uri === 'logout' && $method === 'GET') {
    $controller->logout();
} elseif ($uri === 'register' && $method === 'GET') {
    $controller->register();
} elseif ($uri === 'register' && $method === 'POST'){
    $controller->register();
}elseif ($uri === 'loan' && $method == 'GET') {
    $controller->loanApplicationForm();
}elseif ($uri === 'loan' && $method == 'POST') {
    $controller->loanApplicationForm();
} else {
    http_response_code(404);
    echo "Page not found.";
}

?>

