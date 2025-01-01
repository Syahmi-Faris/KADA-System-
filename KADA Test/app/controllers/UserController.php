<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Loan;

class UserController extends Controller
{
    private $user;
    private $loan;

    public function __construct()
    {
        $this->user = new User();
        $this->loan = new Loan();
    }

    public function index()
    {
        session_start();

        // Fetch accepted member applications
        $stmt = $this->user->getConnection()->prepare("SELECT * FROM member_application WHERE status = 'accepted'");
        $stmt->execute();
        $memberApplications = $stmt->fetchAll();

        // Fetch pending loan applications
        $loanStmt = $this->loan->getConnection()->prepare("SELECT * FROM loan_applications WHERE status = 'pending'");
        $loanStmt->execute();
        $loanApplications = $loanStmt->fetchAll();

        $this->view('users/index', [
            'memberApplications' => $memberApplications,
            'loanApplications' => $loanApplications
        ]);
    }

    public function login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['username']);
            $password = trim($_POST['password']);
            $user = $this->user->checkLogin($identifier, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                header('Location: /');
                exit();
            } else {
                $this->view('users/login', ['error' => 'Invalid credentials']);
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
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($email) || empty($password)) {
                $this->view('users/register', ['error' => 'All fields are required.']);
                return;
            }

            $this->user->register([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            header('Location: /login');
        } else {
            $this->view('users/register');
        }
    }

    // Member Application
    public function memberApplicationPage1()
    {
        $this->view('users/member_application_page1');
    }

    public function memberApplicationPage2()
    {
        session_start();
        $_SESSION['page1'] = $_POST;
        $this->view('users/member_application_page2');
    }

    public function memberApplicationPage3()
    {
        session_start();
        $_SESSION['page2'] = $_POST;
        $this->view('users/member_application_page3');
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

    // Loan Application
    public function loanApplicationForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->loan->createLoanApplication(array_merge($_POST, $_FILES));
            // header('Location: /');
        } else {
            $this->view('users/loan_application');
        }
    }

    // Review Applications
    public function reviewApplications()
    {
        $memberApplications = $this->user->getApplications();
        $loanApplications = $this->loan->getLoanApplications();

        $this->view('users/review_applications', [
            'memberApplications' => $memberApplications,
            'loanApplications' => $loanApplications
        ]);
    }

    public function updateApplicationStatus($id, $status, $type)
    {
        if ($type === 'member') {
            $this->user->updateApplicationStatus($id, $status);
        } elseif ($type === 'loan') {
            $this->loan->updateLoanStatus($id, $status);
        }
        header('Location: /review');
    }

    // User Management
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
        $user = $this->user->find($id);
        $this->view('users/edit', ['user' => $user]);
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
}
