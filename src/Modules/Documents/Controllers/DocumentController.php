<?php
namespace App\Modules\Documents\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\Documents\Services\DocumentService;

class DocumentController extends BaseController {
    private $documentService;
    
    public function __construct(DocumentService $documentService) {
        $this->documentService = $documentService;
    }
    
    public function index() {
        $documents = $this->documentService->getApprovedDocuments();
        $this->render('documents/index', compact('documents'));
    }
    
    public function download($id) {
        $this->documentService->downloadDocument($id);
    }
}
