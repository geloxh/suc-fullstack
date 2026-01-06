<?php
namespace App\Modules\Research\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\Research\Services\ResearchService;

class ResearchController extends BaseController {
    private $researchService;
    
    public function __construct(ResearchService $researchService) {
        $this->researchService = $researchService;
    }
    
    public function index() {
        $collaborations = $this->researchService->getOpenCollaborations();
        $this->render('research/index', compact('collaborations'));
    }
}
