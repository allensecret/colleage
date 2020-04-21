<?php

namespace App\Listeners;

use App\Events\FailedEvent;
use App\Mail\FailedMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FailedListener implements ShouldQueue
{
    public $tries = 5;
    public $timeout = 120;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FailedEvent $event)
    {
        try{
            $course = $event->data->course->coursedata;
            Mail::to($event->data->get_student->email)->send(new FailedMail($course));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
