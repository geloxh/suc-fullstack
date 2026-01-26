<?php
namespace App\Modules\Events\Services;

use App\Modules\Events\Repositories\EventRepository;

class CalendarService {
    private $eventRepository;

    public function __construct(EventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function getCalendarEvents() {
        return $this->eventRepository->getUpcoming();
    }
}