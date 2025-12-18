<?php
namespace App\Modules\User\Repositories;

use PDO;

class UserRepository {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getUserStats($user_id) {
        $query = "SELECT
            (SELECT COUNT(*) FROM topic WHERE user_id = ?) as topics_created,
            (SELECT COUNT(*) FROM posts WHERE user_id = ?) as posts_made,
            (SELECT COUNT(*) FROM votes WHERE user_id = ?) as votes_cast,
            (SELECT COUNT(*) FROM messages WHERE sender_id = ?) as messages_sent";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $user_id, $user_id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRecentTopics($user_id, $limit = 5) {
        $query = "SELECT t.*, f.name as forum_name FROM topics t
                JOIN forums f ON t.forum_id = f.id
                WHERE t.user_id = ? ORDER BY t.created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProfile($user_id, $full_name, $email, $university) {
        $query = "UPDATE users SET full_name = ?, email = ?, university = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$full_name, $email, $university, $user_id]);
    }

    public function updateAvatar($user_id, $avatar_filename) {
        $query = "UPDATE users SET avatar = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$avatar_filename, $user_id]);
    }
}
