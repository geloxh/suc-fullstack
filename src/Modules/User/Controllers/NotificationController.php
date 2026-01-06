<?php
namespace App\Modules\User\Controllers;

use App\Web\Controllers\BaseController;
use App\Shared\Services\NotificationService;

class NotificationController extends BaseController {
    private $notificationService;
    
    public function __construct(NotificationService $notificationService) {
        $this->notificationService = $notificationService;
    }
    
    public function index() {
        $this->requireAuth();
        $notifications = $this->notificationService->getByUser($_SESSION['user_id']);
        $this->render('user/notifications', compact('notifications'));
    }
}
