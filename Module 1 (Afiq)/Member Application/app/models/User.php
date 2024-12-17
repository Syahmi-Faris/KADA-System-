<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function all() 
    {
        $stmt = $this->getConnection()->query("SELECT * FROM users"); // Use query() for SELECT statements
        return $stmt->fetchAll(); // Use fetchAll() to get all records
    }

    public function find($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt->fetch(); // Use fetch() to get a single record
    }

    public function create($data)
    {
        $stmt = $this->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function update($id, $data)
    {
        $stmt = $this->getConnection()->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->execute([ // Use execute() to run the query
            ':name' => $data['name'], // Use named placeholders to prevent SQL injection
            ':email' => $data['email'], // Use named placeholders to prevent SQL injection
            ':id' => $id, // Use named placeholders to prevent SQL injection
        ]);
        return $stmt; // Return the PDOStatement object
    }

    public function delete($id)
    {
        $stmt = $this->getConnection()->prepare("DELETE FROM users WHERE id = :id"); // Use prepare() for SQL statements with variables
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT); // Use bindParam() to bind variables
        $stmt->execute(); // Use execute() to run the query
        return $stmt; // Return the PDOStatement object
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users_reg WHERE username = :username";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['passsword'])) {
            return $user;
        }
        return false;
    }

    public function register($data)
    {
    $stmt = $this->getConnection()->prepare("INSERT INTO users_reg (username, passsword) VALUES (:username, :passsword)");
    $stmt->execute([
        ':username' => $data['username'],
        ':passsword' => password_hash($data['passsword'], PASSWORD_DEFAULT),
    ]);
    return $stmt;
    }

    public function applyMembership($name, $email, $phone, $address)
    {
        $stmt = $this->getConnection()->prepare("INSERT INTO membership_applications (name, email, phone, address) VALUES (:name, :email, :phone, :address)");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address
        ]);
    }

    public function getApplications()
    {
        $stmt = $this->getConnection()->query("SELECT * FROM membership_applications WHERE status = 'pending'");
        return $stmt->fetchAll();
    }

    /*public function updateApplicationStatus($applicationId, $status)
    {
        $stmt = $this->getConnection()->prepare("UPDATE membership_applications SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $applicationId
        ]);
    }*/
}


