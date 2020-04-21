<?php

namespace App\Listeners;

use App\Events\FreshmanMailEvent;
use App\Mail\FreshmanMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FreshmanMailListener implements ShouldQueue
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
    public function handle(FreshmanMailEvent $event)
    {
        try{
            Mail::to($event->data['r_email'])->send(new FreshmanMail($event->data,$event->new_student_id));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
