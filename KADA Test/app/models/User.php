<?php
namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class User extends Model
{
    /**
     * Fetch all users.
     */
    public function all()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    /**
     * Create a new user.
     */
    public function create($data)
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);
    }

    /**
     * Register a new user.
     */
    public function register($data)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->execute([':email' => $data['email'], ':username' => $data['username']]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            throw new \Exception("User with this email or username already exists.");
        }

        return $this->create($data);
    }

    /**
     * Check login credentials.
     */
    public function checkLogin($username, $password)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update an existing user.
     */
    public function update($id, $data)
    {
        $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':id' => $id
        ]);
    }

    /**
     * Delete a user.
     */
    public function delete($id)
    {
        $stmt = $this->getConnection()->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Get member applications.
     */
    public function getApplications()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM member_application WHERE status = 'pending' OR status = 'accepted'");
        return $stmt->fetchAll();
    }

    /**
     * Update member application status.
     */
    public function updateApplicationStatus($applicationId, $status)
    {
        $stmt = $this->getConnection()->prepare("UPDATE member_application SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $applicationId]);
    }

    /**
     * Submit member application.
     */
    public function submitMemberApplication($data)
    {
        $stmt = $this->getConnection()->prepare("
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

        return $stmt->execute([
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
            ':receipt_path' => $data['receipt_path']
        ]);
    }
}
