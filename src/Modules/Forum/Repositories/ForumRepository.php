<?php
namespace App\Mpdules\Forum\Repositories;

use PDO;

class ForumRepository {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getCategories() {
        $query = "SELECT * FROM categories ORDER BY position, name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getForumsByCategory($category_id) {
        $query = "SELECT f.*,
                (SELECT COUNT(*) FROM topics WHERE forum_id = f.id) as topics_count,
                (SELECT COUNT(*) FROM posts p JOIN topics t ON p.topic_id = t.id WHERE t.forum_id = f.id) as posts_count
                FROM forums f WHERE category_id = ? ORDER BY position, name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getForumById($forum_id) {
        $query = "SELECT f.*, c.name as category_name FROM forums f JOIN categories c ON f.category_id = c.id WHERE f.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$forum_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}