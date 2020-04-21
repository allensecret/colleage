<?php

namespace App\Console\Commands;

use App\Events\Magazine;
use App\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMagazineMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:magazine_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '寄發雜誌';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = Order::all();
        foreach ($data as $d){
            event(new Magazine($d->email));
        }

    }
}
