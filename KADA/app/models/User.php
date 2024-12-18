<?php
namespace App\Models;

use App\Core\Model;

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
        $sql = "INSERT INTO users (username, password,email) VALUES (:username, :password, :email)";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':email'    => $data['email']
        ]);
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
            ':email'    => $data['email'],
            ':id'       => $id
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

    public function getApplications()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM member_application WHERE status = 'pending' || status = 'accepted'");
        return $stmt->fetchAll();
    }

    public function updateApplicationStatus($applicationId, $status)
    {
        $stmt = $this->getConnection()->prepare("UPDATE member_application SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $applicationId
        ]);
    }

}