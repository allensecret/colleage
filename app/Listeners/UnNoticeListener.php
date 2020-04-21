<?php

namespace App\Listeners;

use App\Events\UnreportMailEvent;
use App\Mail\NoticeFormMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UnNoticeListener implements ShouldQueue
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
    public function handle(UnreportMailEvent $event)
    {
        try{
            $mail_to = User::where('account',$event->data['student'])->first()->email;
            Mail::to($mail_to)->send(new NoticeFormMail($event->data));
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }
    }
}
