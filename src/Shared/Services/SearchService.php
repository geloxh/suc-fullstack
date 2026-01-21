<?php
namespace App\Shared\Services;

class SearchService {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function search($query, $limit = 20) {
        $searchQuery = "SELECT 'topic' as type, t.id, t.title, t.content, t.created_at, u.username, f.name as forum_name
        FROM topics t
        JOIN users u ON t.user_id = u.id
        JOIN forums f ON t.forum_id = f.id
        WHERE t.title LIKE ? OR t.content LIKE ?
        UNION ALL
        SELECT 'post' as type, p.id, t.title, p.content, p.created_at, u.username, f.name as forum_name
        FROM posts p
        JOIN topics t ON p.topic_id = t.id
        JOIN users u ON p.user_id = u.id
        JOIN forum f ON t.forum_id = f.id
        WHERE p.content LIKE ?
        ORDER BY created_at DESC
        LIMIT ?";

    $searchTerm = "%$query%";
    $stmt = $this->conn->prepare($searchQuery);
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $limit]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}