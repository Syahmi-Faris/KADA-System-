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

    public function index()
    {
         // Fetch all users from the database
         $users = $this->user->all();

         // Pass the data to the 'users/index' view
         $this->view('users/index', compact('users'));
    }

    public function create()
    {
        $this->view('users/create');
    }

    public function store()
    {
        $this->user->create($_POST);
        header('Location: /');
    }

    public function edit($id)
    {
        // Fetch the user data using the ID
        $user = $this->user->find($id);

        // Pass the user data to the 'users/edit' view
        $this->view('users/edit', compact('user'));
    }

    public function update($id)
    {
        $this->user->update($id, $_POST);
        header('Location: /');
    }

    public function delete($id)
    {
        $this->user->delete($id);
        header('Location: /');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['passsword'];

            $user = $this->model('User');
            $loggedInUser = $user->login($username, $password);

            if ($loggedInUser) {
                // Start a session and store user data
                session_start();
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['username'] = $loggedInUser['username'];
                header('Location: /');

                // Redirect based on role
            /*switch ($loggedInUser['role']) {
                case 'admin':
                    header('Location: /admin/dashboard');
                    break;
                case 'board_member':
                    header('Location: /board/dashboard');
                    break;
                default:
                    header('Location: /member/dashboard');
                    break;
            }
                exit;*/
            } else {
                $this->view('users/login', ['error' => 'Invalid username or password']);
            }
        } else {
            $this->view('users/login');
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login'); // Redirect to the homepage or login page
        exit;
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

    public function model($model)
    {
        // Path to the model file
        $modelFile = '../app/models/' . $model . '.php';
    
        // Check if the model file exists
        if (file_exists($modelFile)) {
            require_once $modelFile;
    
            // Include the namespace when instantiating the class
            $fullyQualifiedClassName = 'App\Models\\' . $model;
            if (class_exists($fullyQualifiedClassName)) {
                return new $fullyQualifiedClassName();
            } else {
                die("Class '$fullyQualifiedClassName' not found.");
            }
        } else {
            // If model file does not exist, throw an error
            die("Model file '$modelFile' not found.");
        }
    }

    // Method for applicants to apply
    public function applyForMembership()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $user = $this->model('User');
            $applicationStatus = $user->applyMembership($name, $email, $phone, $address);

            header('Location: /');

            /*if ($applicationStatus) {
                $this->view('users/application_status', ['message' => 'Application submitted successfully, please wait for approval']);
            } else {
                $this->view('users/application_status', ['message' => 'Something went wrong, please try again']);
            }*/
        } else {
            $this->view('users/member');
        }
    }

    public function reviewApplications()
    {
        $user = $this->model('User');
        $applications = $user->getApplications(); // Get all pending applications
        $this->view('users/review_applications', ['applications' => $applications]);
    }

    /*public function updateApplicationStatus($applicationId, $status)
    {
        $user = $this->model('User');
        $user->updateApplicationStatus($applicationId, $status);
        header('Location: /users/review_applications'); // Redirect back to review page
    }*/

}


