<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewApplicant
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $businessId;
    public $enterprise_type;
    public $enterprise_level;
    public $city;
    /**
     * Create a new event instance.
     */
    public function __construct( $businessId, $enterprise_type, $enterprise_level, $city)
    {
        $this->businessId = $businessId;
        $this->enterprise_type = $enterprise_type;
        $this->enterprise_level = $enterprise_level;
        $this->city = $city;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
