<?php
namespace App\Modules\Jobs\Services;

use App\Modules\Jobs\Repositories\JobRepository;

class JobService {
    private $jobRepository;
    
    public function __construct(JobRepository $jobRepository) {
        $this->jobRepository = $jobRepository;
    }
    
    public function getActiveJobs() {
        return $this->jobRepository->getActive();
    }
    
    public function getJobById($id) {
        return $this->jobRepository->findById($id);
    }
}
