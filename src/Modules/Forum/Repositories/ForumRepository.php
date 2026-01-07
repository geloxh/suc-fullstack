<?php
namespace App\Modules\Forum\Repositories;

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

    public function createTopic($forum_id, $user_id, $title, $content) {
        $query = "INSERT INTO topics (forum_id, user_id, title, content) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$forum_id, $user_id, $title, $content]);
        return $this->conn->lastInsertId();
    }

    public function getForumInfo($forum_id) {
        $query = "SELECT name FROM forums WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$forum_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
