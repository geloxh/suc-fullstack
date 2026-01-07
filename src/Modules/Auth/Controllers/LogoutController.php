<?php
namespace App\Modules\Auth\Controllers;

use App\Web\Controllers\BaseController;

class LogoutController extends BaseController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_destroy();
        $this->redirect('/login');
    }
}
