<?php
namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Services\AuthService;

class RegisterController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function index() {
        $error = '';
        $success = '';

        if ($_POST) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $full_name = trim($_POST['full_name']);
            $university = trim($_POST['university']);
            $role = trim($_POST['role']);

            if ($_POST['password'] !== $_POST['confirm_password']) {
                $error = "Passwords do not match.";
            } elseif (strlen($password) < 6) {
                $error = "Password must be at least 6 characters long.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Please enter a valid email address.";
            } elseif ($this->authService->emailExists($email)) {
                $error = "Existing Email User Account.";
            } elseif (empty($username) || empty($full_name) || empty($university) || empty($role)) {
                $error = "Please fill in all required fields.";
            } else {
                if ($this->authService->register($username, $email, $password, $full_name, $university, $role)) {
                    $success = "Registration successful. You can now login.";
                    $_POST = [];
                } else {
                    $error = "Registration failed. Username or email may already exist.";
                }
            }
        }

        include __DIR__ . '/../views/register.php';
    }
}