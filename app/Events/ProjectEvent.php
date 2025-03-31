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
    public $location;
    public $event_type;

    /**
     * Create a new event instance.
     */
    public function __construct(
        ?int $businessId = null,
        ?string $enterprise_type = null,
        ?string $enterprise_level = null,
        ?array $location = [
            'applicant_region' => null,
            'applicant_province' => null,
            'applicant_city' => null,
            'applicant_barangay' => null,
        ],
        ?string $event_type = null
    ) {
        $this->businessId = $businessId;
        $this->enterprise_type = $enterprise_type;
        $this->enterprise_level = $enterprise_level;
        $this->location = $location;
        $this->event_type = $event_type;
    }
}
