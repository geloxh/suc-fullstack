<?php
namespace App\Modules\Forum\Services;

use App\Modules\Forum\Repositories\PostRepository;

class PostService {
    private $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function getPosts($topic_id, $limit = 10, $offset = 0) {
        return $this->postRepository->getPosts($topic_id, $limit, $offset);
    }

    public function getPostCount($topic_id, $user_id, $content) {
        return $this->postRepository->getPostCount($topic_id);
    }

    public function createPost($topic_id, $user_id, $content) {
        $content = trim($content);
        if (empty($content)) {
            throw new \Exception('Post content cannot be empty.');
        }

        return $this->postRepository->create($topic_id, $user_id, $content);
    }

    public function updatePost($post_id, $content) {
        return $this->postRepository->update($post_id, $content);
    }

    public function deletePost($post_id) {
        return $this->postRepository->delete($post_id);
    }
}