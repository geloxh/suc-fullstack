<?php
namespace App\Modules\Events\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\Events\Services\CalendarService;

class CalendarController extends BaseController {
    private $calendarService;
    
    public function __construct(CalendarService $calendarService) {
        $this->calendarService = $calendarService;
    }
    
    public function index() {
        $events = $this->calendarService->getCalendarEvents();
        $this->render('events/calendar', compact('events'));
    }
}