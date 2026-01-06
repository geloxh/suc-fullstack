<?php
namespace App\Modules\Jobs\Repositories;

class JobRepository {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    public function getActive() {
        $query = "SELECT * FROM job_board WHERE status = 'active' ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function findById($id) {
        $query = "SELECT * FROM job_board WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
