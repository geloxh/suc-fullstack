<?php
namespace App\Modules\Documents\Services;

use App\Modules\Documents\Repositories\DocumentRepository;

class DocumentService {
    private $documentRepository;
    
    public function __construct(DocumentRepository $documentRepository) {
        $this->documentRepository = $documentRepository;
    }
    
    public function getApprovedDocuments() {
        return $this->documentRepository->getApproved();
    }
    
    public function downloadDocument($id) {
        $document = $this->documentRepository->findById($id);
        if ($document) {
            $this->documentRepository->incrementDownloads($id);
            // Handle file download
        }
    }
}
