<?php

namespace App\Providers;

use App\Policies\DataPolicy;
use App\StudentData;
use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('data','App\Policies\DataPolicy');

        Gate::resource('blacklist','App\Policies\BlackListPolicy');

        Gate::resource('drop','App\Policies\DropPolicy');

        Gate::resource('drop_in','App\Policies\DropInPolicy');

        Gate::resource('course','App\Policies\CoursePolicy');

        Gate::resource('course_level', 'App\Policies\CourseLevelPolicy');

        Gate::resource('course_data','App\Policies\CourseDataPolicy');

        Gate::resource('subject_class','App\Policies\SubjectClassPolicy');

        Gate::resource('sup_elective','App\Policies\SupElectivePolicy');

        Gate::resource('work_grade','App\Policies\WorkGradePolicy');

        Gate::resource('students_grade','App\Policies\StudentGradePolicy');

        Gate::resource('students_update','App\Policies\StudentUpdatePolicy');

        Gate::resource('recode_update','App\Policies\RecodeUpdatePolicy');

        Gate::resource('bulletin','App\Policies\BulletinPolicy');

        Gate::resource('discussion','App\Policies\DiscussionPolicy');

        Gate::resource('gift_apply','App\Policies\GiftApplyPolicy');

        Gate::resource('gift_item','App\Policies\GiftItemPolicy');

        Gate::resource('magazine','App\Policies\MagazinePolicy');

        Gate::resource('email_config_drop','App\Policies\EmailConfigDropPolicy');

        Gate::resource('email_config_update','App\Policies\EmailConfigUpdatePolicy');

        Gate::resource('email_config_enrollment','App\Policies\EmailConfigEnrollmentPolicy');

        Gate::resource('edit_index_image','App\Policies\IndexImagePolicy');

        Gate::resource('edit_admission_guidance','App\Policies\EditAdmissionGuidancePolicy');

        Gate::resource('edit_plan','App\Policies\EditPlanPolicy');

        Gate::resource('edit_understanding','App\Policies\EditUnderstandPolicy');

        Gate::resource('edit_teacher','App\Policies\TeacherPolicy');

        Gate::resource('edit_calendar','App\Policies\EditCalendarPolicy');

        Gate::resource('edit_description','App\Policies\EditDescriptionPolicy');

        Gate::resource('edit_announcement','App\Policies\EditAnnouncementPolicy');

        Gate::resource('edit_merit_rule','App\Policies\EditMeritRulePolicy');

        Gate::resource('edit_merit_explanation','App\Policies\EditMeritExplanationPolicy');

        Gate::resource('scripture','App\Policies\ScripturePolicy');

        Gate::resource('teaching_material','App\Policies\TeachingMaterialPolicy');

        Gate::resource('merit','App\Policies\MeritPolicy');

        Gate::resource('merit_item','App\Policies\MeritItemPolicy');

        Gate::resource('features','App\Policies\FeaturesPolicy');

        Gate::resource('role','App\Policies\RolePolicy');

        Gate::resource('account','App\Policies\AccountPolicy');

        Gate::resource('classroom','App\Policies\Classroom');

        Gate::resource('report','App\Policies\Report');

        Gate::resource('st_merit','App\Policies\ST_merit');

        Gate::resource('elective_course','App\Policies\elective_course');
    }
}
