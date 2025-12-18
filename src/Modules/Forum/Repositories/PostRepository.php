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

    public function getPostCount($topic_id) {
        $query = "SELECT COUNT(*) as count FROM posts WHERE topic_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$topic_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function create($topic_id, $user_id, $content) {
        $query = "INSERT INTO posts (topic_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$topic_id, $user_id, $content]);
        return $this->conn->lastInsertId();
    }

    public function update($post_id, $content) {
        $query = "UPDATE posts SET content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$content, $post_id]);
    }

    public function delete($post_id) {
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$post_id]);
    }
}