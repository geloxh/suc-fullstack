<?php
namespace App\Modules\Events\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\Events\Services\EventService;

class EventController extends BaseController {
    private $eventService;
    
    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
    }
    
    public function index() {
        $events = $this->eventService->getUpcomingEvents();
        $this->render('events/index', compact('events'));
    }
    
    public function show($id) {
        $event = $this->eventService->getEventById($id);
        $this->render('events/show', compact('event'));
    }
}
