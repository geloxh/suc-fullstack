<?php
namespace App\Modules\User\Controllers;

use App\Modules\User\Services\UserService;

class ProfileController {
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $stats = $this->userService->getUserStats($user_id);
        $recent_topics = $this->userService->getRecentTopics($user_id);

        // Get current user data
        $auth = new \Auth();
        $user = $auth->getCurrentUser();

        include __DIR__ . '/../Views/profile.php';
    }

    public function uploadAvatar() {
        if (!isset($_SESSION['user_id']) || !isset($_FILES['avatar'])) {
            header('Location: /profile');
            exit;
        }

        $file = $_FILES['avatar'];
        $userId = $_SESSION['user_id'];

        // Validate file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type';
            header("Location: /profile");
            exit;
        }

        // Generate Filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $userId . '_' . time() . '.' . $extension;
        $uploadPath = __DIR__ . '/../../../../assets/avatars' . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $this->userService->updateAvatar($userId, $filename);
            $_SESSION['success'] = 'Avatar updated successfully';
        } else {
            $_SESSION['error'] = 'Upload failed';
        }

        header('Location: /profile');
        exit;
    }
}