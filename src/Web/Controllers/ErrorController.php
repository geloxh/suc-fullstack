<?php
namespace App\Web\Controllers;

class ErrorController extends BaseController {
    public function notFound() {
        http_response_code(404);
        $this->render('errors/404', [
            'title' => 'Page Not Found',
            'message' => 'The page you are looking for could not be found.'
            ]);
    }

    public function serverError($message = 'Internal Server Error') {
        http_response_code(500);
        $this->render('errors/500', [
            'title' => 'Internal Server Error',
            'message' => $message
        ]);
    }

    public function forbidden() {
        http_response_code(403);
        $this->render('errors/403'. [
            'title' => 'Access Forbidden',
            'message' => 'You do not have permission to access this page.'
        ]);
    }
}