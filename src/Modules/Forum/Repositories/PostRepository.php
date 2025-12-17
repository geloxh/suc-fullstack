<?php
namespace App\Modules\Forum\Repositories;

use PDO;

class PostRepository {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getPosts($topic_id, $limit = 10, $offset = 0) {
         $query = "SELECT p.*, u.username, u.avatar, u.reputation, u.role 
                  FROM posts p 
                  JOIN users u ON p.user_id = u.id 
                  WHERE topic_id = ? 
                  ORDER BY created_at ASC 
                  LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $topic_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}