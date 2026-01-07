<?php
namespace App\Core\Events;

abstract class Event {
    public $data;

    public function __construct($data = []) {
        $this->data = $data;
    }
}
