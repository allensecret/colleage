<?php

namespace App\Listeners;

use App\Drop;
use App\Events\DropEvent;
use App\Mail\DropMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DropListener implements ShouldQueue
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
    public function handle(DropEvent $event)
    {
        try{
            $student = User::find($event->data);
//            $drop_data = Drop::where('student',$event->data)->where('item',1)->where('term',0)->get()->last();
            Mail::to($student->email)->send(new DropMail());
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
