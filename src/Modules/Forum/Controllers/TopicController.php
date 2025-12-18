<?php
namespace App\Modules\Forum\Controllers;

use App\Modules\Forum\Services\ForumService;
use App\Modules\Forum\Services\PostService;

class TopicController {
    private $topicService;
    private $postServvice;

    public function __construct(TopicService $topicService, PostService $postService) {
        $this->topicService = $topicService;
        $this->postService = $postService;
    }

    public function show($topic_id) {
        $topic = $this->topicService->getTopicbyId($topic_id);
        if (!$topic) {
            header('Location: index.php');
            exit;
        }

        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $posts = $this->postService->getPosts($topic_id, $limit, $offset);
        $total_posts = $this->postService->getPostCount($topic_id);

        include __DIR__ . '/../Views/topic-detail.php';
    }

    public function create() {
        $forum_id = $_GET['forum_id'] ?? 0;
        $error = '';

        if ($_POST) {
            try {
                $topic_id = $this->topicService->createTopic(
                    $_POST['forum_id'],
                    $_SESSION['user_id'],
                    $_POST['title'],
                    $_POST['content']
                );
                header("Location: topic.php?id=$topic_id");
                exit;
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        include __DIR__ . '/../Views/topic-create.php';
    }
}