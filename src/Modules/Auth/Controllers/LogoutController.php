<?php
namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Services\AuthService;

class LogoutController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function index() {
        $this->authService->logout();
        header('Location: index.php');
        exit;
    }
}