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
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $users = $this->user->all();
        $this->view('users/index', compact('users'));
    }

    public function login()
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['email']); // Accepts email or username
            $password = trim($_POST['password']);

            if (!empty($identifier) && !empty($password)) {
                $stmt = $this->user->getConnection()->prepare("
                    SELECT * FROM users WHERE email = :identifier OR username = :identifier
                ");
                $stmt->execute([':identifier' => $identifier]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['username'];
                    header('Location: /');
                    exit();
                }
            }

            $this->view('users/login', ['error' => 'Invalid credentials.']);
        } else {
            $this->view('users/login');
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $errors = [];

            if (empty($username)) $errors[] = "Username is required.";
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
            if (empty($password)) $errors[] = "Password is required.";

            if (empty($errors)) {
                $stmt = $this->user->getConnection()->prepare("
                    SELECT id FROM users WHERE email = ? OR username = ?
                ");
                $stmt->execute([$email, $username]);
                if ($stmt->fetch()) {
                    $errors[] = "Email or username already exists.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $this->user->create([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashedPassword
                    ]);
                    header('Location: /login');
                    exit();
                }
            }

            $this->view('users/register', ['errors' => $errors]);
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

    public function create()
    {
        // Simply load the view for creating a user
        $this->view('users/create');
    }

    public function store()
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $defaultPassword = password_hash('default', PASSWORD_BCRYPT);

        if (!empty($username) && !empty($email)) {
            $this->user->create([
                'username' => $username,
                'email'    => $email,
                'password' => $defaultPassword
            ]);
            header('Location: /');
            exit();
        } else {
            $this->view('users/create', ['error' => "All fields are required."]);
        }
    }


    public function edit($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            die("User not found.");
        }
        $this->view('users/edit', compact('user'));
    }

    public function update($id)
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (!empty($username) && !empty($email)) {
            $this->user->update($id, ['username' => $username, 'email' => $email]);
            header('Location: /');
            exit();
        } else {
            echo "All fields are required.";
        }
    }

    public function delete($id)
    {
        $this->user->delete($id);
        header('Location: /');
        exit();
    }

    public function memberApplicationPage1()
    {
        session_start();
        $data = $_SESSION['page1'] ?? [];
        $this->view('users/member_application_page1', ['data' => $data]);
    }

    public function memberApplicationPage2()
    {
        session_start();
        $_SESSION['page1'] = $_POST; 
        $data = $_SESSION['page2'] ?? [];
        $this->view('users/member_application_page2', ['data' => $data]);
    }

    public function memberApplicationPage3()
    {
        session_start();
        $_SESSION['page2'] = $_POST; 
        $data = $_SESSION['page3'] ?? [];
        $this->view('users/member_application_page3', ['data' => $data]);
    }

    public function submitApplication()
    {
        session_start();
        $_SESSION['page3'] = $_POST; 

        $data = array_merge($_SESSION['page1'], $_SESSION['page2'], $_SESSION['page3']);
        $errors = [];

        // File upload handling
        $receiptPath = '';
        if ($_FILES['receipt']['error'] === 0) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $fileName = time() . '_' . basename($_FILES['receipt']['name']);
            $receiptPath = $fileName;

            if (!move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadDir . $fileName)) {
                $errors[] = "Failed to upload receipt.";
            }
        }

        if (empty($errors)) {
            // Insert data into 'member_application' table
            $stmt = $this->user->getConnection()->prepare("
                INSERT INTO member_application (
                    nama, no_kp, jantina, agama, bangsa, 
                    alamat_rumah, poskod, negeri, no_tel_bimbit, no_tel_rumah, 
                    gaji_bulanan, nama_pewaris, hubungan_pewaris, no_kp_pewaris, 
                    fee_masuk, modah_syer, receipt_path
                ) VALUES (
                    :nama, :no_kp, :jantina, :agama, :bangsa, 
                    :alamat_rumah, :poskod, :negeri, :no_tel_bimbit, :no_tel_rumah, 
                    :gaji_bulanan, :nama_pewaris, :hubungan_pewaris, :no_kp_pewaris, 
                    :fee_masuk, :modah_syer, :receipt_path
                )
            ");
            $stmt->execute([
                ':nama' => $data['nama'],
                ':no_kp' => $data['no_kp'],
                ':jantina' => $data['jantina'],
                ':agama' => $data['agama'],
                ':bangsa' => $data['bangsa'],
                ':alamat_rumah' => $data['alamat_rumah'],
                ':poskod' => $data['poskod'],
                ':negeri' => $data['negeri'],
                ':no_tel_bimbit' => $data['no_tel_bimbit'],
                ':no_tel_rumah' => $data['no_tel_rumah'],
                ':gaji_bulanan' => $data['gaji_bulanan'],
                ':nama_pewaris' => $data['nama_pewaris'],
                ':hubungan_pewaris' => $data['hubungan_pewaris'],
                ':no_kp_pewaris' => $data['no_kp_pewaris'],
                ':fee_masuk' => $data['fee_masuk'],
                ':modah_syer' => $data['modah_syer'],
                ':receipt_path' => $receiptPath
            ]);

            // Clear session and show success
            
            echo "<script>
                alert('Permohonan berjaya dihantar.Sila menunggu 2-3 hari bekerja untuk kelulusan.');
                window.location.href = '/';
            </script>";
        } else {
            $this->view('users/member_application_page3', ['errors' => $errors]);
        }
    }
    public function reviewApplications()
    {
        $user = $this->model('User');
        $applications = $user->getApplications(); // Get all pending applications
        $this->view('users/review_applications', ['applications' => $applications]);
    }

    public function updateApplicationStatus($applicationId, $status)
    {
        $user = $this->model('User');
        $user->updateApplicationStatus($applicationId, $status);
        ob_clean();
        header('Location: users/review_applications'); // Redirect back to review page
        exit;
    }

}