<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->user->checkLogin($_POST);
    
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: /');
            } else {
                $error = "Invalid email or password.";
                $this->view('users/login', compact('error'));
            }
        } else {
            $this->view('users/login');
        }
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
    }
    
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->register($_POST);
            header('Location: /login');
        } else {
            $this->view('users/register');
        }
    }

    public function loanApplicationForm(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_merge($_POST, $_FILES);
            $this->user->loan($data);
            header('Location: /');
        }else
        $this->view('users/loan');
    }
    
}
