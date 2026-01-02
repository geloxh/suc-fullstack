<?php
namespace App\Web\Middleware;

class AuthMiddleware {
    public static function handle() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.php');
            exit;
        }
        return true;
    }

    public static function guest() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /index.php');
            exit;
        }
        return true;
    }
}