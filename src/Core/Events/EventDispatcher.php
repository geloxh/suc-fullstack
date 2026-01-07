<?php
namespace App\Core\Events;

class EventDispatcher {
    private $listeners = [];

    public function listen($event, $listener) {
        $this->listeners[$event][] = $listener;
    }

    public function dispatch($event, $data = []) {
        if (!isset($this->listeners[$event])) {
            return;
        }

        foreach ($this->listeners[$event] as $listener) {
            if (is_callable($listener)) {
                call_user_func($listener, $data);
            }
        }
    }

    public function forget($event) {
        unset($this->listeners[$event]);
    }
}
