<?php
namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\UserRepository;

class AuthService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login($username, $password) {
        $user = $this->userRepository->findByUsernameOrEmail($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];

            $this->userRepository->updateLastActive($user['id']);
            return true;
        }
        return false;
    }

    public function register($username, $email, $password, $full_name, $university, $role) {
        return  $this->userRepository->create($username, $email, $password, $full_name, $university, $role);
    }

    public function logout() {
        session_destroy();
        return true;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser() {
        if (isset($_SESSION['user_id'])) {
            return $this->userRepository->findById($_SESSION['user_id']);
        }
        return null;
    }

    public function emailExists($email) {
        return $this->userRepository->emailExists($email);
    }

    public function isAdmin() {
        $user = $this->getCurrentUser();
        return $user && $user['role'] === 'admin';
    }
}