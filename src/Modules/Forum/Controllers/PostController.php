<?php
namespace App\Modules\Forum\Controllers;

use App\Modules\Forum\Services\PostService;

class PostController {
    private $postService;

    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }

    public function create() {
        if ($_POST && isset($_POST['action']) && $_POST['action'] == 'create_post') {
            try {
                $post_id = $this->postService->createPost(
                    $_POST['topic_id'],
                    $_SESSION['user_id'],
                    $_POST['content']
                );
                header("Location: topic.php?id={$_POST['topic_id']}#post-$post_id");
                exit;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return '';
    }

    public function delete($post_id) {
        return $this->postService->deletePost($post_id);
    }
}