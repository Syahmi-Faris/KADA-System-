<?php
require_once '../app/core/Autoload.php';

use App\Controllers\UserController;

$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

$controller = new UserController();

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

    case ($uri === 'member-application/page1' && $method === 'GET'):
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

    case ($uri === 'loan' && $method === 'GET'):
        $controller->loanApplicationForm();
        break;
        
    case ($uri === 'loan' && $method === 'POST'):
         $controller->loanApplicationForm();
         break;
        

    case ($uri === 'review' && $method === 'GET'):
        $controller->reviewApplications();
        break;

    case (preg_match('/update-application-status\/(\d+)\/(accepted|rejected)\/(member|loan)/', $uri, $matches) && $method === 'POST'):
        $controller->updateApplicationStatus($matches[1], $matches[2], $matches[3]);
        break;

    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
