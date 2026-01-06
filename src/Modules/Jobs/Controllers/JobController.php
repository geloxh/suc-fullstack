<?php
namespace App\Modules\Jobs\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\Jobs\Services\JobService;

class JobController extends BaseController {
    private $jobService;
    
    public function __construct(JobService $jobService) {
        $this->jobService = $jobService;
    }
    
    public function index() {
        $jobs = $this->jobService->getActiveJobs();
        $this->render('jobs/index', compact('jobs'));
    }
    
    public function show($id) {
        $job = $this->jobService->getJobById($id);
        $this->render('jobs/show', compact('job'));
    }
}
