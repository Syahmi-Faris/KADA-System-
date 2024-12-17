<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * Fetch all users.
     */
    public function all()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    /**
     * Create a new user.
     */
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            ':username' => $data['username'],
            ':email'    => $data['email'],
            ':password' => $data['password']
        ]);
    }

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update an existing user.
     */
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET username = :username, email = :email WHERE id = :id";
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
        $stmt = $this->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}