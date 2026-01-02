<?php
namespace App\Web\Controllers;

abstract class BaseController {
    protected function render($view, $data = []) {
        extract($data);
        include __DIR__ . "/../views/{$view}.php";
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login.php');
        }
    }

    protected function requireAdmin() {
        $this->requireAuth();
        $auth = new \Auth();
        if (!$auth->isAdmin()) {
            $this->redirect('/index.php');
        }
    }
}