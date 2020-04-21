<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FreshmanMailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data,$new_student_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$new_student_id)
    {
        $this->data = $data;
        $this->new_student_id = $new_student_id;
    }
}
