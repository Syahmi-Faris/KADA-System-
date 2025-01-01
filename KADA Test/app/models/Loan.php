<?php
namespace App\Models;

use App\Core\Model;
class Loan extends Model
{
    public function createLoanApplication($data)
{
    try {
        $uploadDir = __DIR__ . '/../../uploads/';
        // $payslipFile = time() . '_' . basename($data['payslip_file']['name']);
        // $bankStatementFile = time() . '_' . basename($data['bank_statement_file']['name']);

        // Attempt to move uploaded files
            
            // Ensure the directory exists
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new \Exception("Failed to create upload directory.");
                }
            }

            $payslipFile = time() . '_' . basename($data['payslip_file']['name']);
        $bankStatementFile = time() . '_' . basename($data['bank_statement_file']['name']);

        // Attempt to move uploaded files
        if (!move_uploaded_file($data['payslip_file']['tmp_name'], $uploadDir . $payslipFile)) {
            throw new \Exception("Failed to upload payslip file.");
        }
        if (!move_uploaded_file($data['bank_statement_file']['tmp_name'], $uploadDir . $bankStatementFile)) {
            throw new \Exception("Failed to upload bank statement file.");
        }


        // Prepare and execute the SQL statement
        $stmt = $this->getConnection()->prepare("
            INSERT INTO loan_applications (
                name, ic_number, email, phone_number, postcode, address, 
                loan_type, loan_amount, loan_duration, payslip_file, bank_statement_file
            ) VALUES (
                :name, :ic_number, :email, :phone_number, :postcode, :address, 
                :loan_type, :loan_amount, :loan_duration, :payslip_file, :bank_statement_file
            )
        ");

        $stmt->execute([
            ':name' => $data['name'],
            ':ic_number' => $data['ic_number'],
            ':email' => $data['email'],
            ':phone_number' => $data['phone_number'],
            ':postcode' => $data['postcode'],
            ':address' => $data['address'],
            ':loan_type' => $data['loan_type'],
            ':loan_amount' => $data['loan_amount'],
            ':loan_duration' => $data['loan_duration'],
            ':payslip_file' => $payslipFile,
            ':bank_statement_file' => $bankStatementFile,
        ]);

        // Check if the row was inserted successfully
        if ($stmt->rowCount() === 0) {
            throw new \Exception("Failed to insert loan application into the database.");
        }

        return "Loan application submitted successfully.";

    } catch (\Exception $e) {
        // Handle any exceptions and return the error message
        return "Error: " . $e->getMessage();
    }
}

    

    public function getLoanApplications()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM loan_applications WHERE status = 'pending'");
        return $stmt->fetchAll();
    }

    public function updateLoanStatus($id, $status)
    {
        $stmt = $this->getConnection()->prepare("UPDATE loan_applications SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }
}
