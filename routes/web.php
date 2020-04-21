<?php

use App\Admin;
use Illuminate\Support\Facades\Hash;

Route::get('/','IndexPageController@index')->name('index');

Route::post('/order','IndexPageController@order')->name('order');

Route::post('/disorder','IndexPageController@disorder')->name('disorder');

Route::resource('magazine','MagazineController');

Route::get('magazine_download/{magazine}','MagazineController@download')->name('magazine_download');

Route::get('introduction','IntroductionController@introduction')->name('introduction');

Route::get('teacher_introduction','IntroductionController@teacher_introduction')->name('teacher_introduction');

Route::get('teacher_introduction_detail/{teacher}','IntroductionController@teacher_introduction_detail')->name('teacher_introduction_detail');

Route::resource('news','NewsController');

Route::get('guide','AdmissionController@guide')->name('guide');

Route::resource('registration','RegistrationController');

Route::get('course_introduction','AdmissionController@course_introduction')->name('course_introduction');

Route::get('calendar','AdmissionController@calendar')->name('calendar');

Route::resource('gift','GiftController');

Route::get('forget_password','ForgetPasswordController@view')->name('forget_password');

Route::post('forget_password/send','ForgetPasswordController@send')->name('forget_password_send');

Route::prefix('ST')->group(function (){
    Auth::routes();
    Route::post('/',['as'=>'ST.login','uses'=>'StudentLoginController@login']);
    Route::post('logout',['as'=>'ST.logout','uses'=>'StudentLoginController@logout']);

    Route::middleware('auth')->group(function (){
        Route::resource('discussion','DiscussionController');

        Route::resource('discussion_personal','DiscussionPersonalController');

        Route::resource('replies','RepliesController');

        Route::resource('classroom','ClassRoomController');

        Route::get('share_report','ClassRoomController@share')->name('experience');

        Route::get('download_file','ClassRoomController@download_file')->name('download_file');

        Route::resource('report','ReportController');

        Route::resource('material_download','MaterialDownloadController');

        Route::resource('merit','MeritController');

        Route::post('merit_update/{meritGrade}','MeritController@merit_update')->name('merit_update');

        Route::get('merit_rule','MeritController@rule')->name('merit.rule');

        Route::get('merit_explanation','MeritController@explanation')->name('merit.explanation');

        Route::get('merit_ration','MeritController@ration')->name('merit.ration');

        Route::resource('query_history','QueryHistoryController');

        Route::resource('drop_school','DropSchoolController');

        Route::resource('elective_course','ElectiveCourseController');

        Route::resource('personalInfo','PersonalInfoController');

        Route::resource('changePassword','ChangePassword');
    });
});

Route::prefix('MGPlatform')->group(function (){
   Route::get('/','LoginController@showLoginForm')->name('MGPlatform.login');
   Route::post('/',['as'=>'MGPlatform.login','uses'=>'LoginController@login']);
   Route::post('logout','LoginController@logout')->name('MGPlatform.logout');

   Route::middleware('admin.auth:admin')->group(function (){
       Route::resource('dashboard','DashboardController');
       Route::prefix('students')->group(function (){
           Route::resource('data', 'StuDataController',['except'=>['create','store']]);
           Route::resource('black_list','BlackListController');
           Route::resource('drop','DropMGController');
       });

       Route::prefix('Class')->group(function (){
           Route::resource('course','CourseController');
           Route::resource('course_level','CourseLevelController',['only'=>['index','create','destroy']]);
           Route::resource('course_data','CourseDataController');
           Route::resource('subject_class','SubjectClassController');
           Route::resource('sup_elective','SupElectiveController');
       });

       Route::prefix('Grade')->group(function (){
           Route::resource('work_grade','WorkGradeController');
           Route::get('shear_report/{report}','WorkGradeController@shear')->name('shear_report');
           Route::resource('UnReport','UnreportController',['only'=>['index']]);
           Route::post('UnReport_mail','UnreportController@mail_notice')->name('UnReport_mail');
           Route::post('UnReport_all_mail','UnreportController@all_mail_notice')->name('UnReport_all_mail');
           Route::resource('students_grade','StudentGradeController');
//           Route::get('de_sing','GradeController@de_sing')->name('de_sing');
//           Route::get('de_sing_list_grade','GradeController@de_sing_list_grade')->name('de_sing_list_grade');
       });

       Route::prefix('Update')->group(function (){
           Route::resource('students_update','StudentsUpdateController');
           Route::post('all_update','StudentsUpdateController@all_update')->name('update');
           Route::post('exception_update/{id}','StudentsUpdateController@exception_update')->name('exception_update');
           Route::post('keyin_exception_update','StudentsUpdateController@keyin_exception_update')->name('keyin_exception_update');
           Route::resource('recode_update','UpdateRecodeController');
       });

       Route::prefix('announcement')->group(function (){
           Route::resource('bulletin','BulletinController');
           Route::post('create_type','BulletinController@create_type')->name('create_type');
           Route::delete('delete_relies/{replies}','BulletinController@delete_relies')->name('delete_relies');
       });

       Route::resource('magazineMG','MagazineMgController');

       Route::resource('discussionMG','DiscussionMGController');
       Route::delete('discussionMG_delete_replies/{$discussionMG}','DiscussionMGController@delete_replies')->name('discussionMG_delete_replies');

       Route::prefix('email_config')->group(function (){
           Route::prefix('drop')->group(function (){
               Route::any('/','EmailController@drop_show')->name('email_config_drop');
               Route::post('out/{type}','EmailController@email_config')->name('email_config_dropout');
               Route::post('in/{type}','EmailController@email_config')->name('email_config_dropin');
           });
           Route::prefix('update')->group(function (){
               Route::any('/','EmailController@update_show')->name('email_config_update');
               Route::post('save/{type}','EmailController@email_config')->name('email_config_update_save');
           });
           Route::prefix('enrollment')->group(function (){
               Route::any('/','EmailController@enrollment_show')->name('email_config_enrollment');
               Route::post('save/{type}','EmailController@email_config')->name('email_config_enrollment_save');
           });
       });

       Route::prefix('gift_config')->group(function (){
           Route::resource('gift_item','GiftItemConfigController');
           Route::resource('gift_list','GiftConfigController');
           Route::post('update_status','GiftConfigController@update_status')->name('update_status');
           Route::post('export','GiftConfigController@export')->name('export');
       });

       Route::prefix('Edit')->group(function (){
           //首頁輪播圖
           Route::resource('indexImage','IndexImageController');
           //入學指導
           Route::prefix('guidance')->group(function (){
               Route::any('/','EditController@admission_guidance')->name('edit_admission_guidance');
               Route::post('save/{type}','EditController@edit')->name('edit_admission_guidance_save');
           });
           //教學計畫
           Route::prefix('plan')->group(function (){
               Route::any('/','EditController@plan')->name('edit_plan');
               Route::post('save/{type}','EditController@edit')->name('edit_plan_save');
           });
           //認識學院
           Route::prefix('understanding')->group(function (){
               Route::any('/','EditController@understanding')->name('edit_understanding');
               Route::post('save/{type}','EditController@edit')->name('edit_understanding_save');
           });
           //導師介紹
           Route::resource('teacher_introduction','TeacherIntroductionController');

           //年度行事曆
           Route::prefix('calendar')->group(function (){
               Route::any('/','EditCalendarController@calendar')->name('edit_calendar');
               Route::post('/save/{date}','EditCalendarController@calendar_save')->name('calendar_save');
           });
           //說明看板
           Route::prefix('description')->group(function (){
               Route::any('/','EditController@description')->name('edit_description');
               Route::post('save/{type}','EditController@edit')->name('edit_description_save');
           });
           //訊息公告
           Route::prefix('announcement')->group(function (){
               Route::any('/','EditController@announcement')->name('edit_announcement');
               Route::post('/mange/{config}','EditController@announcement_mange')->name('edit_announcement_mange');
               Route::post('/save/{type}','EditController@edit')->name('edit_announcement_save');
           });
           //功過格-修行守則
           Route::prefix('merit_rule')->group(function (){
              Route::any('/','EditController@merit_rule')->name('edit_merit_rule');
               Route::post('save/{type}','EditController@edit')->name('edit_merit_rule_save');
           });
           //功過格-使用說明
           Route::prefix('merit_explanation')->group(function (){
               Route::any('/','EditController@merit_explanation')->name('edit_merit_explanation');
               Route::post('save/{type}','EditController@edit')->name('edit_merit_explanation_save');
           });
       });

       Route::prefix('File')->group(function (){
           Route::resource('scripture','FileScriptureController');
           Route::resource('teaching_material','FileTeachingMaterial');
       });

       Route::prefix('merit')->group(function (){
           Route::resource('merit_MG','MeritMGController');
           Route::resource('merit_item_MG','MeritItemMGController');
           Route::post('/add_group','MeritItemMGController@add_group')->name('merit_item_MG.add_group');
       });

       Route::prefix('administration')->group(function (){
           Route::resource('role','RoleController');
           Route::resource('account','AccountController');
           Route::resource('features','FeaturesController');
           Route::post('features_item_create/{feature}','FeaturesController@item_create')->name('features_item_create');
           Route::patch('features_item_update/{item}','FeaturesController@item_update')->name('features_item_update');
           Route::delete('features_item_delete/{item}','FeaturesController@item_delete')->name('features_item_delete');
           Route::get('login_history','LoginHistoryController@view')->name('login_history.view');
       });
   });

});


Route::get('create','TestController@create');
Route::get('test','TestController@test');
//Route::get('transaction','TestController@transaction');
