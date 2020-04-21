<?php

namespace App\Providers;

use App\CourseLevel;
use App\Page;
use App\StudentData;
use App\User;
//use Dotenv\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

//        Validator::extend('check_course_name',function($attribute, $value, $parameters, $validator){
//            return Course::where('name',$value)->count() == 0;
//        });
//
//        Validator::extend('check_sn',function($attribute, $value, $parameters, $validator){
//            return CourseData::where('sn',$value)->count() == 0;
//        });
//
//        Validator::extend('check_level_code',function($attribute, $value, $parameters, $validator){
//            return CourseLevel::where('code',substr($value,0,2))->count() == 1 && Student_user::where('student_id',$value)->count() == 0;
//        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('check_student_id', function ($attribute, $value, $parameters, $validator) {
            return User::where('account',$value)->count() == 1;
        });

        Validator::extend('check_level_code', function ($attribute, $value, $parameters, $validator) {
            $s = substr($value,0,2);
            return CourseLevel::where('code',$s)->count() == 1;
        });

        Validator::extend('check_email',function ($attribute, $value, $parameters, $validator){
            return User::where('email',$value)->count() == 1;
        });

        Validator::extend('r_check_email',function($attribute, $value, $parameters, $validator){
            return User::where('email',$value)->count() == 0;
        });

        Validator::extend('check_text',function($attribute, $value, $parameters, $validator){
            if(mb_strlen(strip_tags($value),"utf-8") == 1){
                Log::info('is empty');
                return false;
            }

            return true;
//            Log::info(strip_tags($value));
//           return !empty(strip_tags($value));
        });

        Validator::extend('Maximum',function($attribute, $value, $parameters, $validator){
            if(mb_strlen(strip_tags($value),'utf-8') >= $parameters[0]){
                return true;
            }else{
                return false;
            }
        });

        View::share('index_img',Page::where('item','index_image')->get());

        View::share('student_count', count(User::all()) );
    }
}
