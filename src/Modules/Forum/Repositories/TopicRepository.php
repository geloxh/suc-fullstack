<?php
namespace App\Modules\Forum\Repositories;

use PDO;

class TopicRepository {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getTopics($forum_id, $limit = 20, $offset = 0) {
        $query = "SELECT t.*, u.username, u.avatar,
                (SELECT COUNT(*) FROM posts WHERE topic_id = t.id) as replies_ccount
                FROM topics t
                JOIN users u ON t.user_id = u.id
                WHERE forum_id = ?
                ORDER BY is_pinned DESC, updated_at DESC
                LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $forum_id, PDO::PARAM_INT);
        $stmt->bindValue(2, (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int) $offset, PDO::PARAM_INT);
        return $stmt->fetchAll(PDO::FECTH_ASSOC);
    }
}