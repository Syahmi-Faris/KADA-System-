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

    public function memberApplicationForm()
    {
        $this->view('users/member_application');
    }

    public function submitApplication()
    {
        // Validate input and file upload
        $fullName = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $errors = [];

        if (empty($fullName)) $errors[] = "Full Name is required.";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid Email is required.";
        if (empty($phone)) $errors[] = "Phone is required.";
        if (empty($address)) $errors[] = "Address is required.";

        // Handle file upload
        if ($_FILES['receipt']['error'] == 0) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $receiptName = time() . '_' . basename($_FILES['receipt']['name']);
            $receiptPath = $uploadDir . $receiptName;

            if (!move_uploaded_file($_FILES['receipt']['tmp_name'], $receiptPath)) {
                $errors[] = "Failed to upload receipt.";
            }
        } else {
            $errors[] = "Receipt upload is required.";
        }

        if (empty($errors)) {
            // Save to database
            $stmt = $this->user->getConnection()->prepare("
                INSERT INTO applications (full_name, email, phone, address, receipt_path)
                VALUES (:full_name, :email, :phone, :address, :receipt_path)
            ");
            $stmt->execute([
                ':full_name' => $fullName,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
                ':receipt_path' => $receiptName
            ]);

            // Success message
            echo "<script>
                alert('You have submitted the member application form. Please kindly wait 2-3 business days.');
                window.location.href = '/';
            </script>";
        } else {
            $this->view('users/member_application', ['errors' => $errors]);
        }
    }
}