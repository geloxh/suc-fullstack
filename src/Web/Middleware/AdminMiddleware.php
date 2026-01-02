<?php
namespace App\Web\Middleware;

class AdminMiddleware {
    public static function handle() {
        AuthMidlleware::handle();

        $auth = new \Auth();
        if (!$auth->isAdmin()) {
            header('Location: /index.php');
            exit;
        }
        return true;
    }
}