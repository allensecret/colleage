<?php

namespace App\Listeners;

use App\Events\ElectiveEvent;
use App\Mail\ElectiveMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ElectiveListener implements ShouldQueue
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
    public function handle(ElectiveEvent $event)
    {
        try{
//            Log::info($event->data);
            $student = User::find($event->data);
            $curriculas = $student->curriculas()->whereHas('course',function ($query)use($student){
                $query->where('level',$student->data->course_level);
            })->get();
            Mail::to($student->data->email)->send(new ElectiveMail($student,$curriculas));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
