<?php

namespace App\Console\Commands;

use App\StudentData;
use App\User;
use Illuminate\Console\Command;

class Transform_studentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transform:studentdata';

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
        foreach ($decode->student_table as $o){
            $data = new StudentData;
            $data->student = User::where('account',$o->s_id)->first()->id;
            $data->gender =  '請輸入性別';
            $data->nationality = '請輸入國籍';
            switch (substr($o->s_id,0,2)){
                case "eb":
                    $data->course_level = 1;
                    break;
                case "ec":
                    $data->course_level = 2;
                    break;
                case "ed":
                    $data->course_level = 3;
                    break;
                case "ee":
                    $data->course_level = 4;
                    break;
                case "ef":
                    $data->course_level = 5;
                    break;
                case "eg":
                    $data->course_level = 6;
                    break;
                case "eh":
                    $data->course_level = 7;
                    break;
                case "ei":
                    $data->course_level = 8;
                    break;
                case "ej":
                    $data->course_level = 9;
                    break;
                default:
                    $data->course_level = 0;
                    break;
            }
            if(substr($o->s_id,0,1) == 'n'){
                $data->stay_in_school = 0;
            }else{
                $data->stay_in_school = 1;
            }
            $data->save();
            $this->info($o->s_id.' input data');
        }
        $this->info('Is done...');
    }
}
