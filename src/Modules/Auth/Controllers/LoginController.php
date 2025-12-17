<?php
namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Services\AuthService;

class LoginController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function index() {
        $error = '';

        if ($_POST) {
            if ($this->authService->login($_POST['username'], $_POST['password'])) {
                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid credentials.';
            }
        }

        include __DIR__ . '/../Views/login.php';
    }
}