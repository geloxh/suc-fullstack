<?php
namespace App\Modules\Forum\Controllers;

use App\Web\Controllers\BaseController;

class HomeController extends BaseController {
    public function index() {
        
        $auth = new Auth();
        $forum = new Forum();
        $user = $auth -> getCurrentUser();
        $categories = $forum -> getCategories();
        $this->render('home/index');
    }
}