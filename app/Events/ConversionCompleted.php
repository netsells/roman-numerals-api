<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ConversionCompleted
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $arabic;
    /**
     * @var string
     */
    public $roman;

    /**
     * Create a new event instance when conversion has been completed.
     *
     * @return void
     */
    public function __construct(int $arabic, string $roman)
    {
        $this->arabic = $arabic;
        $this->roman  = $roman;
    }

}
