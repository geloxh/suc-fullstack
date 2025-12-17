<?php
namespace App\Modules\Auth\Repositories;

use PDO;

class UserRepository {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function findByUsernameOrEmail($identifier) {
        $query = "SELECT id, username, email, password, role, full_name FROM users WHERE (username = ? OR email = ?) AND status = 'active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$identifier, $identifier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT id, username, email, full_name, role, university, avatar, status, reputation, create_at FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password, $full_name, $university, $role) {
        $query  = "INSERT INTO users (username, email, password, full_name, university, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$username, $email, $hashed_password, $full_name, $university, $role]);
    }

    public function emailExists($email) {
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function updateLastActive($user_id) {
        $query = "UPDATE users SET last_receive = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);
    }
}