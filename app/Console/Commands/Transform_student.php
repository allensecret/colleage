<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class Transform_student extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transform:student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '資料遷移';

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
        set_time_limit(0);

        $feed = file_get_contents($this->laravel->publicPath().'/student_table.xml');
        $xml = simplexml_load_string($feed);
        $encode = json_encode($xml);
        $decode = json_decode($encode);
        foreach ($decode->student_table as $d){
            $data = new User;
            $data->name = "請輸入名稱";
            $data->account =  $d->s_id;
            $data->email = '請輸入電子郵件'.$d->s_id;
            $data->password = \Illuminate\Support\Facades\Hash::make($d->s_pwd);
            $data->save();
            $this->info($d->s_id.' input data');
        }

        $this->info('Is done...');
//        $this->info($this->laravel->publicPath());
    }
}
