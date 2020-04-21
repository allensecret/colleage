<?php

namespace App\Listeners;

use App\Mail\MagazineMail;
use App\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MagazineListener implements ShouldQueue
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
    public function handle($event)
    {
        try{
            Mail::to($event->data)->send(new MagazineMail());
        }catch (\Exception $e){
            Log::error("郵件錯誤".$e->getMessage());
        }

    }
}
