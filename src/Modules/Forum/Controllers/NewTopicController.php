<?php
namespace App\Modules\Forum\Controllers;

use App\web\Controllers\BaseController;

class NewTopicController extends BaseController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->render('forum/new-topic', [
            'title' => 'Create New Topic -SUC Forum'
        ]);
    }

    public function store() {
        // Handle form submission
        $this->redirect('/suc-fullstack/new-topic');
    }
}