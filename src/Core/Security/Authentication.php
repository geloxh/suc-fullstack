<?php
namespace App\Core\Security;

class Authentication {
    public static function login($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['logged_in'] = true;
    }
    
    public static function logout() {
        session_start();
        session_destroy();
    }

    public static function check() {
        session_start();
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function user() {
        session_start();
        if (!self::check()) {
            return null;
        }
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'role' => $_SESSION['user_role'] ?? null
        ];
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}