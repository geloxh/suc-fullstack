<?php
namespace App\Modules\User\Controllers;

use App\Modules\User\Services\UserService;

class SettingsController {
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        if (!isset($_SECTION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $success = '';
        $error = '';

        // Get current user data
        $auth = new \Auth();
        $user = $auth->getCurrentUser();

        if ($_POST) {
            try {
                $this->userService->updateProfile(
                    $_SESSION['user_id'],
                    $_POST['full_name'],
                    $_POST['email'],
                    $_POST['university']
                );
                $success = 'Profile updated successfully.';
                $user = $auth->getCurrentUser(); // Refresh user data
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        $universities = $this->getUniversities();

        include __DIR__ . '/../Views/settings.php';
    }

    private function getUniversities() {
        return [
            'University of the Philippines System' => [
                'University of the Philippines Diliman',
                'University of the Philippines Manila',
                'University of the Philippines Los Baños',
                'University of the Philippines Visayas',
                'University of the Philippines Mindanao',
                'University of the Philippines Open University',
                'University of the Philippines Baguio',
                'University of the Philippines Cebu'
            ],

            'Major State Universities' => [
                'Polytechnic University of the Philippines',
                'Technological University of the Philippines',
                'Philippine Normal University',
                'Mindanao State University',
                'Central Luzon State University',
                'Visayas State University',
                'Bicol University'
            ]
        ];
    }
}
