<?php
namespace App\Modules\Forum\Controllers;

use App\Web\Controllers\BaseController;
use App\Shared\Services\SearchService;

class SearchController extends BaseController {
    private $searchService;
    
    public function __construct(SearchService $searchService) {
        $this->searchService = $searchService;
    }
    
    public function index() {
        $query = $_GET['q'] ?? '';
        $results = $query ? $this->searchService->search($query) : [];
        
        $this->render('search/index', compact('query', 'results'));
    }
}