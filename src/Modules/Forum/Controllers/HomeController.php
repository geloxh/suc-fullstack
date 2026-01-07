<?php
namespace App\Modules\Forum\Controllers;

use App\Web\Controllers\BaseController;

class HomeController extends BaseController {
    public function index() {
        require_once __DIR__ . '/../../../includes/auth.php';
        require_once __DIR__ . '/../../../includes/forum.php';
        
        $auth = new \Auth();
        $forum = new \Forum();

        $user = $auth->getCurrentUser();
        $categories = $forum->getCategories();
       
        $categoriesWithForums = [];
        foreach ($categories as $category) {
            $category['forums'] = $forum->getForumsByCategory($category['id']);
            $categoriesWithForums[] = $category;
        }

        $this->render('home/index', [
            'title' => 'PSUC Forum - Home',
            'user' => $user,
            'categories' => $categoriesWithForums
        ]);
    }
}