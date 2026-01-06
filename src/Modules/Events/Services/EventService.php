<?php
namespace App\Modules\Events\Services;

use App\Modules\Events\Repositories\EventRepository;

class EventService {
    private $eventRepository;
    
    public function __construct(EventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }
    
    public function getUpcomingEvents() {
        return $this->eventRepository->getUpcoming();
    }
    
    public function getEventById($id) {
        return $this->eventRepository->findById($id);
    }
}