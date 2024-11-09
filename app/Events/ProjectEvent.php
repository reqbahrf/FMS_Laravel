<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectEvent
{
    use Dispatchable, SerializesModels;

    public $businessId;
    public $enterprise_type;
    public $enterprise_level;
    public $city;
    public $event_type;

    /**
     * Create a new event instance.
     */
    public function __construct($businessId = null, $enterprise_type = null, $enterprise_level = null, $city = null, $event_type)
    {
        $this->businessId = $businessId;
        $this->enterprise_type = $enterprise_type;
        $this->enterprise_level = $enterprise_level;
        $this->city = $city;
        $this->event_type = $event_type;
    }
}
