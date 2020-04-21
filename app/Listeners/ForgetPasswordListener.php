<?php

namespace App\Listeners;

use App\Events\ForgetPasswordEvent;
use App\Mail\ForgetPasswordEmail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordListener implements ShouldQueue
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
    public function handle(ForgetPasswordEvent $event)
    {
        try{
            $student = User::find($event->data);
            $student->password = Hash::make('amtbamtb');
            $student->save();
            Mail::to($student->email)->send(new ForgetPasswordEmail($student));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
