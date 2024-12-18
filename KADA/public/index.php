<?php
require_once '../app/core/Autoload.php';

use App\Controllers\UserController;

// Parse the URI and request method
$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

// Initialize the controller
$controller = new UserController();

// Routing Logic
switch (true) {
    case ($uri === '' && $method === 'GET'):
        $controller->index();
        break;

    case ($uri === 'login' && $method === 'GET'):
    case ($uri === 'login' && $method === 'POST'):
        $controller->login();
        break;

    case ($uri === 'logout' && $method === 'GET'):
        $controller->logout();
        break;

    case ($uri === 'register' && $method === 'GET'):
    case ($uri === 'register' && $method === 'POST'):
        $controller->register();
        break;

    case ($uri === 'create' && $method === 'GET'):
        $controller->create();
        break;

    case ($uri === 'store' && $method === 'POST'):
        $controller->store();
        break;

    case (preg_match('/edit\/(\d+)/', $uri, $matches) && $method === 'GET'):
        $controller->edit($matches[1]);
        break;

    case (preg_match('/update\/(\d+)/', $uri, $matches) && $method === 'POST'):
        $controller->update($matches[1]);
        break;

    case (preg_match('/delete\/(\d+)/', $uri, $matches) && $method === 'POST'):
        $controller->delete($matches[1]);
        break;

    case ($uri === 'member-application' && $method === 'GET'):
        $controller->memberApplicationPage1();
        break;
        
    case ($uri === 'member-application/page2' && $method === 'POST'):
        $controller->memberApplicationPage2();
        break;
        
    case ($uri === 'member-application/page3' && $method === 'POST'):
        $controller->memberApplicationPage3();
        break;
        
    case ($uri === 'member-application/submit' && $method === 'POST'):
        $controller->submitApplication();
        break;
        
    default:
        // Fallback for 404 error
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}
