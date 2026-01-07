<?php
namespace App\Modules\Forum\Services;

use App\Modules\Forum\Repositories\ForumRepository;

class ForumService {
    private $forumRepository;

    public function __construct(ForumRepository $forumRepository) {
        $this->forumRepository = $forumRepository;
    }

    public function getCategories() {
        return $this->forumRepository->getCategories();
    }

    public function getForumsByCategory($category_id) {
        return $this->forumRepository->getForumsByCategory($category_id);
    }

    public function createTopic($forum_id, $user_id, $title, $content) {
        return $this->forumRepository->createTopic($forum_id, $user_id, $title, $content);
    }

    public function getForumInfo($forum_id) {
        return $this->forumRepository->getForumInfo($forum_id);
    }
}
