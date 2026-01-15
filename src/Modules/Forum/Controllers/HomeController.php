<?php
namespace App\Modules\Forum\Controllers;

use App\Web\Controllers\BaseController;
use App\Core\Database\Connection;

class HomeController extends BaseController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        require_once __DIR__ . '/../Repositories/ForumRepository.php';
        require_once __DIR__ . '/../../Auth/Services/AuthService.php';
        
        $database = Connection::getInstance();
        $forumRepository = new \App\Modules\Forum\Repositories\ForumRepository($database->getConnection());
        $authService = new \App\Modules\Auth\Services\AuthService($database->getConnection());

        $user = $authService->getCurrentUser();
        $categories = $forumRepository->getCategories();

        // Get forums for each category
        foreach ($categories as &$category) {
            $category['forums'] = $forumRepository->getForumsByCategory($category['id']);
        }

        $recentTopics = $forumRepository->getRecentTopics(10);
        $stats = $forumRepository->getForumStats();

        $this->render('forum/home', [
            'title' => 'SUC Forum - Home',
            'user' => $user,
            'categories' => $categories,
            'recentTopics' => $recentTopics,
            'stats' => $stats
        ]);
    }
}
